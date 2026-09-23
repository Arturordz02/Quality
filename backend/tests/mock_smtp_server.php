<?php
/**
 * Mock SMTP Server for automated testing of TLS and authentication fail-closed logic
 * Usage: php mock_smtp_server.php <port> <mode> <logFile> [certFile]
 */

if ($argc < 4) {
    exit(1);
}

$port = (int)$argv[1];
$mode = $argv[2]; // 'reject_starttls', 'crypto_fail', 'tls_success'
$logFile = $argv[3];
$certFile = $argv[4] ?? null;

$serverContext = stream_context_create();
if ($certFile && file_exists($certFile)) {
    stream_context_set_option($serverContext, 'ssl', 'local_cert', $certFile);
    stream_context_set_option($serverContext, 'ssl', 'allow_self_signed', true);
    stream_context_set_option($serverContext, 'ssl', 'verify_peer', false);
}

$server = @stream_socket_server("tcp://127.0.0.1:{$port}", $errno, $errstr, STREAM_SERVER_BIND | STREAM_SERVER_LISTEN, $serverContext);
if (!$server) {
    file_put_contents($logFile, json_encode(['error' => "Cannot bind port: {$errstr}"]));
    exit(1);
}

// Timeout de espera para cliente: 4 segundos
$client = @stream_socket_accept($server, 4);
if (!$client) {
    file_put_contents($logFile, json_encode(['error' => 'Accept timeout']));
    fclose($server);
    exit(1);
}

stream_set_timeout($client, 3);

$transcript = [];
$authLoginSeen = false;
$usernameSeen = false;
$passwordSeen = false;

function writeMsg($sock, $msg, &$transcript) {
    $transcript[] = ['dir' => 'SERVER', 'msg' => trim($msg)];
    @fwrite($sock, $msg);
}

function readMsg($sock, &$transcript) {
    $line = @fgets($sock, 2048);
    if ($line !== false && $line !== '') {
        $transcript[] = ['dir' => 'CLIENT', 'msg' => trim($line)];
        return trim($line);
    }
    return false;
}

// 1. Saludo inicial
writeMsg($client, "220 mail.quality-mock.local ESMTP Mock\r\n", $transcript);

// 2. Esperar EHLO
$ehlo = readMsg($client, $transcript);
writeMsg($client, "250-mail.quality-mock.local\r\n250-STARTTLS\r\n250 OK\r\n", $transcript);

// 3. Esperar comando
$cmd = readMsg($client, $transcript);

if ($mode === 'reject_starttls') {
    // Si el cliente pide STARTTLS, responder con rechazo (ej: 454 o 500)
    if (stripos((string)$cmd, 'STARTTLS') !== false) {
        writeMsg($client, "454 TLS not available due to temporary reason\r\n", $transcript);
    }
    
    // Leer cualquier intento posterior por 1 segundo
    $subsequent = readMsg($client, $transcript);
    if ($subsequent) {
        if (stripos($subsequent, 'AUTH') !== false) {
            $authLoginSeen = true;
        }
    }
} elseif ($mode === 'crypto_fail') {
    // Aceptar STARTTLS pero forzar fallo cerrando el socket del servidor
    if (stripos((string)$cmd, 'STARTTLS') !== false) {
        writeMsg($client, "220 2.0.0 Ready to start TLS\r\n", $transcript);
        @stream_set_blocking($client, false);
        @fwrite($client, "NOT_TLS_DATA\r\n");
    }
    
    // Verificar si el cliente intenta enviar algo más (ej. AUTH LOGIN)
    usleep(100000);
    $subsequent = readMsg($client, $transcript);
    if ($subsequent && stripos($subsequent, 'AUTH') !== false) {
        $authLoginSeen = true;
    }
} elseif ($mode === 'tls_success') {
    if (stripos((string)$cmd, 'STARTTLS') !== false) {
        writeMsg($client, "220 2.0.0 Ready to start TLS\r\n", $transcript);
        
        // Habilitar criptografía en el servidor
        $cryptoOk = @stream_socket_enable_crypto($client, true, STREAM_CRYPTO_METHOD_TLS_SERVER);
        if ($cryptoOk) {
            // Leer EHLO post-TLS
            $ehlo2 = readMsg($client, $transcript);
            writeMsg($client, "250-mail.quality-mock.local\r\n250-AUTH LOGIN PLAIN\r\n250 OK\r\n", $transcript);

            // Leer AUTH LOGIN
            $authCmd = readMsg($client, $transcript);
            if ($authCmd && stripos($authCmd, 'AUTH LOGIN') !== false) {
                $authLoginSeen = true;
                writeMsg($client, "334 VXNlcm5hbWU6\r\n", $transcript);
                $u = readMsg($client, $transcript);
                if ($u) $usernameSeen = true;
                writeMsg($client, "334 UGFzc3dvcmQ6\r\n", $transcript);
                $p = readMsg($client, $transcript);
                if ($p) $passwordSeen = true;
                writeMsg($client, "235 2.7.0 Authentication successful\r\n", $transcript);
                // Esperar MAIL FROM / QUIT
                $next = readMsg($client, $transcript);
                writeMsg($client, "250 OK\r\n", $transcript);
            }
        }
    }
}

@fclose($client);
@fclose($server);

$summary = [
    'mode' => $mode,
    'transcript' => $transcript,
    'authLoginSeen' => $authLoginSeen,
    'usernameSeen' => $usernameSeen,
    'passwordSeen' => $passwordSeen
];

file_put_contents($logFile, json_encode($summary, JSON_PRETTY_PRINT));
exit(0);
