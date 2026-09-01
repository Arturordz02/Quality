<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Módulo de Envío de Correo Electrónico (SMTP Puro y HTML Templates)
 * 
 * Implementación autocontenida sin librerías externas para máxima compatibilidad.
 */

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class SmtpMailer {
    private array $config;
    private ?string $lastError = null;

    public function __construct(array $config) {
        $this->config = $config;
    }

    public function getLastError(): ?string {
        return $this->lastError;
    }

    /**
     * Envía un correo electrónico en formato HTML
     */
    public function send(string $toEmail, string $subject, string $htmlBody, ?string $replyTo = null): bool {
        $mailConfig = $this->config['mail'] ?? [];
        $driver = strtolower($mailConfig['driver'] ?? 'smtp');

        if ($driver === 'mail') {
            return $this->sendNativeMail($toEmail, $subject, $htmlBody, $replyTo);
        }

        return $this->sendSmtpSocket($toEmail, $subject, $htmlBody, $replyTo);
    }

    /**
     * Envío vía Socket SMTP nativo
     */
    private function sendSmtpSocket(string $toEmail, string $subject, string $htmlBody, ?string $replyTo = null): bool {
        $cfg = $this->config['mail'] ?? [];
        $host = $cfg['host'] ?? 'localhost';
        $port = (int)($cfg['port'] ?? 465);
        $encryption = strtolower($cfg['encryption'] ?? 'ssl');
        $timeout = 15;

        $fromEmail = $cfg['from_email'] ?? 'contacto@quality-consulting.org';
        $fromName  = $cfg['from_name'] ?? 'Quality Consulting Solutions';
        $username  = $cfg['username'] ?? $fromEmail;
        $password  = $cfg['password'] ?? '';
        $useAuth   = !empty($cfg['auth']);

        $socketHost = ($encryption === 'ssl') ? "ssl://{$host}" : "tcp://{$host}";

        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        $socket = @stream_socket_client($socketHost . ':' . $port, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $context);

        if (!$socket) {
            $this->lastError = "No se pudo conectar al servidor SMTP ($host:$port): $errstr ($errno)";
            error_log('[QCS SMTP Error] ' . $this->lastError);
            return false;
        }

        stream_set_timeout($socket, $timeout);

        $response = $this->readSocket($socket);
        if (!$this->checkResponse($response, '220')) {
            $this->closeSocket($socket);
            return false;
        }

        // Enviar EHLO
        $clientHost = $_SERVER['SERVER_NAME'] ?? 'localhost';
        $this->writeSocket($socket, "EHLO $clientHost\r\n");
        $response = $this->readSocket($socket);

        // Si se usa TLS (STARTTLS en puerto 587)
        if ($encryption === 'tls' || $port === 587) {
            $this->writeSocket($socket, "STARTTLS\r\n");
            $response = $this->readSocket($socket);
            if ($this->checkResponse($response, '220')) {
                if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                    $this->lastError = "Fallo en la negociación TLS con el servidor SMTP";
                    $this->closeSocket($socket);
                    return false;
                }
                // Repetir EHLO tras STARTTLS
                $this->writeSocket($socket, "EHLO $clientHost\r\n");
                $response = $this->readSocket($socket);
            }
        }

        // Autenticación SMTP
        if ($useAuth) {
            $this->writeSocket($socket, "AUTH LOGIN\r\n");
            $response = $this->readSocket($socket);
            if (!$this->checkResponse($response, '334')) {
                $this->closeSocket($socket);
                return false;
            }

            $this->writeSocket($socket, base64_encode($username) . "\r\n");
            $response = $this->readSocket($socket);
            if (!$this->checkResponse($response, '334')) {
                $this->closeSocket($socket);
                return false;
            }

            $this->writeSocket($socket, base64_encode($password) . "\r\n");
            $response = $this->readSocket($socket);
            if (!$this->checkResponse($response, '235')) {
                $this->lastError = "Error de autenticación SMTP. Verifique usuario y contraseña en backend/config.php";
                $this->closeSocket($socket);
                return false;
            }
        }

        // MAIL FROM
        $this->writeSocket($socket, "MAIL FROM: <$fromEmail>\r\n");
        $response = $this->readSocket($socket);
        if (!$this->checkResponse($response, '250')) {
            $this->closeSocket($socket);
            return false;
        }

        // RCPT TO
        $this->writeSocket($socket, "RCPT TO: <$toEmail>\r\n");
        $response = $this->readSocket($socket);
        if (!$this->checkResponse($response, '250')) {
            $this->closeSocket($socket);
            return false;
        }

        // DATA
        $this->writeSocket($socket, "DATA\r\n");
        $response = $this->readSocket($socket);
        if (!$this->checkResponse($response, '354')) {
            $this->closeSocket($socket);
            return false;
        }

        // Construir Encabezados MIME
        $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $encodedFromName = '=?UTF-8?B?' . base64_encode($fromName) . '?=';

        $headers = [];
        $headers[] = "From: $encodedFromName <$fromEmail>";
        $headers[] = "To: <$toEmail>";
        if ($replyTo) {
            $headers[] = "Reply-To: <$replyTo>";
        }
        $headers[] = "Subject: $encodedSubject";
        $headers[] = "Date: " . date('r');
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/html; charset=UTF-8";
        $headers[] = "Content-Transfer-Encoding: 8bit";
        $headers[] = "X-Mailer: QCS-Backend-Mailer/1.0";

        $messagePayload = implode("\r\n", $headers) . "\r\n\r\n" . $htmlBody . "\r\n.\r\n";
        $this->writeSocket($socket, $messagePayload);

        $response = $this->readSocket($socket);
        if (!$this->checkResponse($response, '250')) {
            $this->closeSocket($socket);
            return false;
        }

        // QUIT
        $this->writeSocket($socket, "QUIT\r\n");
        $this->closeSocket($socket);

        return true;
    }

    /**
     * Fallback con mail() nativo de PHP
     */
    private function sendNativeMail(string $toEmail, string $subject, string $htmlBody, ?string $replyTo = null): bool {
        $cfg = $this->config['mail'] ?? [];
        $fromEmail = $cfg['from_email'] ?? 'contacto@quality-consulting.org';
        $fromName  = $cfg['from_name'] ?? 'Quality Consulting Solutions';

        $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $encodedFromName = '=?UTF-8?B?' . base64_encode($fromName) . '?=';

        $headers = [];
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/html; charset=UTF-8";
        $headers[] = "From: $encodedFromName <$fromEmail>";
        if ($replyTo) {
            $headers[] = "Reply-To: <$replyTo>";
        }
        $headers[] = "X-Mailer: PHP/" . phpversion();

        $success = @mail($toEmail, $encodedSubject, $htmlBody, implode("\r\n", $headers));
        if (!$success) {
            $this->lastError = "Fallo al enviar correo con mail() nativo.";
        }
        return $success;
    }

    private function writeSocket($socket, string $data): void {
        fwrite($socket, $data);
    }

    private function readSocket($socket): string {
        $data = '';
        while ($str = fgets($socket, 515)) {
            $data .= $str;
            if (substr($str, 3, 1) === ' ') {
                break;
            }
        }
        return $data;
    }

    private function checkResponse(string $response, string $expectedCode): bool {
        if (substr(trim($response), 0, 3) !== $expectedCode) {
            $this->lastError = "Respuesta SMTP inesperada: " . trim($response);
            error_log('[QCS SMTP Error] ' . $this->lastError);
            return false;
        }
        return true;
    }

    private function closeSocket($socket): void {
        if ($socket) {
            @fclose($socket);
        }
    }

    // ==========================================================================
    // PLANTILLAS HTML DE CORREO CORPORATIVO
    // ==========================================================================

    /**
     * Plantilla para Notificación de Nueva Consulta a la Empresa
     */
    public static function templateContactNotification(array $data): string {
        $nombre = htmlspecialchars($data['nombre'], ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars($data['telefono'], ENT_QUOTES, 'UTF-8');
        $empresa = htmlspecialchars($data['empresa'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');
        $consulta = nl2br(htmlspecialchars($data['consulta'], ENT_QUOTES, 'UTF-8'));
        $fecha = date('d/m/Y H:i:s');
        $ip = $data['ip_origen'] ?? '0.0.0.0';

        // Enlace directo a WhatsApp
        $cleanPhone = preg_replace('/[^0-9]/', '', $telefono);

        return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Consulta Web</title>
</head>
<body style="margin: 0; padding: 20px; background-color: #f1f5f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e293b;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
        <!-- Header -->
        <tr>
            <td style="background-color: #0f3460; padding: 25px 30px; text-align: center; border-bottom: 4px solid #f59e0b;">
                <h1 style="color: #ffffff; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: 0.5px;">QUALITY CONSULTING SOLUTIONS</h1>
                <p style="color: #cbd5e1; margin: 6px 0 0 0; font-size: 13px;">Notificación de Nueva Consulta Web</p>
            </td>
        </tr>
        <!-- Body -->
        <tr>
            <td style="padding: 30px;">
                <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 12px 16px; border-radius: 4px; margin-bottom: 25px;">
                    <strong style="color: #92400e; font-size: 14px;">Has recibido un nuevo mensaje desde el formulario de contacto web.</strong>
                </div>

                <table width="100%" border="0" cellspacing="0" cellpadding="8" style="font-size: 14px; border-collapse: collapse;">
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td width="35%" style="color: #64748b; font-weight: 600;">Nombre y Apellido:</td>
                        <td style="color: #0f172a; font-weight: bold;">{$nombre}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="color: #64748b; font-weight: 600;">Correo Electrónico:</td>
                        <td><a href="mailto:{$email}" style="color: #0284c7; text-decoration: none; font-weight: bold;">{$email}</a></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="color: #64748b; font-weight: 600;">Teléfono / WhatsApp:</td>
                        <td>
                            <span style="font-weight: bold;">{$telefono}</span>
                            <a href="https://wa.me/{$cleanPhone}" style="display: inline-block; margin-left: 8px; background-color: #22c55e; color: #ffffff; padding: 2px 8px; border-radius: 12px; font-size: 11px; text-decoration: none; font-weight: bold;" target="_blank">WhatsApp</a>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="color: #64748b; font-weight: 600;">Empresa:</td>
                        <td style="color: #0f172a;">{$empresa}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="color: #64748b; font-weight: 600;">Fecha y Hora:</td>
                        <td style="color: #64748b;">{$fecha}</td>
                    </tr>
                </table>

                <div style="margin-top: 25px;">
                    <h3 style="color: #0f3460; font-size: 15px; margin: 0 0 10px 0; border-bottom: 2px solid #e2e8f0; padding-bottom: 6px;">Detalle de la Consulta:</h3>
                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; color: #334155; font-size: 14px; line-height: 1.6;">
                        {$consulta}
                    </div>
                </div>

                <div style="margin-top: 25px; text-align: center;">
                    <a href="mailto:{$email}?subject=Respuesta%20a%20su%20consulta%20-%20Quality%20Consulting%20Solutions" style="background-color: #0f3460; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 25px; font-weight: bold; font-size: 14px; display: inline-block;">
                        Responder por Correo
                    </a>
                </div>
            </td>
        </tr>
        <!-- Footer -->
        <tr>
            <td style="background-color: #f8fafc; padding: 16px 30px; text-align: center; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 12px;">
                IP de origen: {$ip} | Formulario Web Oficial Quality Consulting Solutions
            </td>
        </tr>
    </table>
</body>
</html>
HTML;
    }

    /**
     * Plantilla para Notificación de Hoja de Reclamación a la Administración
     */
    public static function templateClaimAdminNotification(array $data, array $company): string {
        $codigo = htmlspecialchars($data['codigo_reclamacion'], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($data['nombre'], ENT_QUOTES, 'UTF-8');
        $documento = htmlspecialchars($data['documento'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars($data['telefono'], ENT_QUOTES, 'UTF-8');
        $tipo = strtoupper(htmlspecialchars($data['tipo'], ENT_QUOTES, 'UTF-8'));
        $servicio = htmlspecialchars($data['servicio'], ENT_QUOTES, 'UTF-8');
        $detalle = nl2br(htmlspecialchars($data['detalle'], ENT_QUOTES, 'UTF-8'));
        $fecha = date('d/m/Y H:i:s');
        $ip = $data['ip_origen'] ?? '0.0.0.0';

        $badgeColor = ($tipo === 'QUEJA') ? '#ea580c' : '#dc2626';

        return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Reclamaciones - Nuevo Registro</title>
</head>
<body style="margin: 0; padding: 20px; background-color: #f1f5f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e293b;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 650px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
        <tr>
            <td style="background-color: #0f3460; padding: 25px 30px; text-align: center; border-bottom: 4px solid #f59e0b;">
                <h1 style="color: #ffffff; margin: 0; font-size: 20px; font-weight: 700;">LIBRO DE RECLAMACIONES VIRTUAL</h1>
                <p style="color: #cbd5e1; margin: 6px 0 0 0; font-size: 13px;">Conforme a Ley N° 29571 - Notificación Administrativa</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; padding: 14px 18px; border-radius: 4px; margin-bottom: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #991b1b; font-weight: bold; font-size: 14px;">NUEVO REGISTRO: <span style="background-color: {$badgeColor}; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 12px;">{$tipo}</span></span>
                    </div>
                    <div style="margin-top: 6px; font-size: 13px; color: #7f1d1d;">
                        <strong>Código de Hoja:</strong> <span style="font-family: monospace; font-size: 14px; background: #fff; padding: 2px 6px; border-radius: 3px; border: 1px solid #fca5a5;">{$codigo}</span>
                    </div>
                </div>

                <h3 style="color: #0f3460; font-size: 15px; margin: 0 0 12px 0; border-bottom: 2px solid #e2e8f0; padding-bottom: 6px;">1. Identificación del Consumidor Reclamante</h3>
                <table width="100%" border="0" cellspacing="0" cellpadding="6" style="font-size: 13px; margin-bottom: 20px;">
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td width="35%" style="color: #64748b; font-weight: 600;">Nombre Completo:</td>
                        <td style="color: #0f172a; font-weight: bold;">{$nombre}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="color: #64748b; font-weight: 600;">Doc. Identidad (DNI/CE/RUC):</td>
                        <td style="color: #0f172a;">{$documento}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="color: #64748b; font-weight: 600;">Correo Electrónico:</td>
                        <td><a href="mailto:{$email}" style="color: #0284c7; text-decoration: none;">{$email}</a></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="color: #64748b; font-weight: 600;">Teléfono / Celular:</td>
                        <td>{$telefono}</td>
                    </tr>
                </table>

                <h3 style="color: #0f3460; font-size: 15px; margin: 0 0 12px 0; border-bottom: 2px solid #e2e8f0; padding-bottom: 6px;">2. Detalle de la Reclamación</h3>
                <table width="100%" border="0" cellspacing="0" cellpadding="6" style="font-size: 13px; margin-bottom: 20px;">
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td width="35%" style="color: #64748b; font-weight: 600;">Tipo:</td>
                        <td style="color: #0f172a; font-weight: bold;">{$tipo}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="color: #64748b; font-weight: 600;">Servicio o Producto:</td>
                        <td style="color: #0f172a;">{$servicio}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="color: #64748b; font-weight: 600;">Fecha de Registro:</td>
                        <td style="color: #64748b;">{$fecha}</td>
                    </tr>
                </table>

                <h3 style="color: #0f3460; font-size: 15px; margin: 0 0 10px 0;">3. Descripción de los Hechos:</h3>
                <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; color: #334155; font-size: 13px; line-height: 1.6; margin-bottom: 20px;">
                    {$detalle}
                </div>

                <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; padding: 12px; border-radius: 6px; font-size: 12px; color: #166534;">
                    <strong>Plazo Legal de Atención:</strong> Según el Código de Protección y Defensa del Consumidor (Ley N° 29571), la empresa cuenta con un plazo máximo de <strong>15 días hábiles</strong> para dar respuesta formal al reclamante.
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f8fafc; padding: 16px 30px; text-align: center; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 12px;">
                IP de registro: {$ip} | Sistema Central Quality Consulting Solutions
            </td>
        </tr>
    </table>
</body>
</html>
HTML;
    }

    /**
     * Plantilla para Hoja de Reclamación enviada como Copia al Consumidor
     */
    public static function templateClaimCustomerReceipt(array $data, array $company): string {
        $codigo = htmlspecialchars($data['codigo_reclamacion'], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($data['nombre'], ENT_QUOTES, 'UTF-8');
        $documento = htmlspecialchars($data['documento'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars($data['telefono'], ENT_QUOTES, 'UTF-8');
        $tipo = strtoupper(htmlspecialchars($data['tipo'], ENT_QUOTES, 'UTF-8'));
        $servicio = htmlspecialchars($data['servicio'], ENT_QUOTES, 'UTF-8');
        $detalle = nl2br(htmlspecialchars($data['detalle'], ENT_QUOTES, 'UTF-8'));
        $fecha = date('d/m/Y H:i:s');
        $companyName = htmlspecialchars($company['name'] ?? 'Quality Consulting Solutions', ENT_QUOTES, 'UTF-8');
        $companyAddress = htmlspecialchars($company['address'] ?? 'Av. Javier Prado 757, piso 10 Magdalena, Lima 17', ENT_QUOTES, 'UTF-8');
        $days = (int)($company['legal_response_days'] ?? 15);

        return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Hoja de Reclamación</title>
</head>
<body style="margin: 0; padding: 20px; background-color: #f1f5f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1e293b;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 650px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
        <tr>
            <td style="background-color: #0f3460; padding: 25px 30px; text-align: center; border-bottom: 4px solid #f59e0b;">
                <h1 style="color: #ffffff; margin: 0; font-size: 20px; font-weight: 700;">{$companyName}</h1>
                <p style="color: #cbd5e1; margin: 6px 0 0 0; font-size: 13px;">Libro de Reclamaciones Virtual - Constancia de Registro</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <p style="font-size: 14px; line-height: 1.6; margin-top: 0; color: #334155;">
                    Estimado(a) <strong>{$nombre}</strong>,<br><br>
                    Confirmamos que su registro en nuestro <strong>Libro de Reclamaciones Virtual</strong> ha sido procesado exitosamente conforme a las disposiciones establecidas en la Ley N° 29571 (Código de Protección y Defensa del Consumidor).
                </p>

                <div style="background-color: #f0fdf4; border: 2px dashed #22c55e; padding: 15px 20px; border-radius: 8px; text-align: center; margin: 20px 0;">
                    <span style="color: #166534; font-size: 13px; text-transform: uppercase; font-weight: bold;">Código Único de Reclamación</span>
                    <div style="font-family: monospace; font-size: 22px; font-weight: bold; color: #0f3460; letter-spacing: 1.5px; margin-top: 4px;">
                        {$codigo}
                    </div>
                    <p style="margin: 6px 0 0 0; font-size: 12px; color: #15803d;">Guarde este código para el seguimiento de su solicitud.</p>
                </div>

                <h3 style="color: #0f3460; font-size: 14px; margin: 20px 0 10px 0; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px;">Resumen de la Hoja de Reclamación:</h3>
                <table width="100%" border="0" cellspacing="0" cellpadding="6" style="font-size: 13px; margin-bottom: 15px;">
                    <tr style="border-bottom: 1px solid #f8fafc;">
                        <td width="40%" style="color: #64748b;">Razón Social:</td>
                        <td style="color: #0f172a; font-weight: bold;">{$companyName}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f8fafc;">
                        <td style="color: #64748b;">Sede Central:</td>
                        <td style="color: #0f172a;">{$companyAddress}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f8fafc;">
                        <td style="color: #64748b;">Documento de Identidad:</td>
                        <td style="color: #0f172a;">{$documento}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f8fafc;">
                        <td style="color: #64748b;">Tipo de Registro:</td>
                        <td style="color: #0f172a; font-weight: bold;">{$tipo}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f8fafc;">
                        <td style="color: #64748b;">Servicio / Curso:</td>
                        <td style="color: #0f172a;">{$servicio}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f8fafc;">
                        <td style="color: #64748b;">Fecha y Hora de Emisión:</td>
                        <td style="color: #64748b;">{$fecha}</td>
                    </tr>
                </table>

                <h4 style="color: #0f3460; font-size: 13px; margin: 15px 0 6px 0;">Detalle Registrado:</h4>
                <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 12px; border-radius: 6px; color: #475569; font-size: 13px; line-height: 1.5; margin-bottom: 20px;">
                    {$detalle}
                </div>

                <div style="background-color: #f8fafc; border-left: 4px solid #0f3460; padding: 12px; border-radius: 4px; font-size: 12px; color: #334155; line-height: 1.6;">
                    <strong>Información Legal al Consumidor:</strong><br>
                    • De acuerdo a la normativa vigente, se le remitirá una respuesta formal al correo electrónico ingresado en un plazo no mayor a <strong>{$days} días hábiles</strong>.<br>
                    • La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante INDECOPI.
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f8fafc; padding: 16px 30px; text-align: center; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 12px;">
                © 2026 {$companyName}. Todos los derechos reservados.
            </td>
        </tr>
    </table>
</body>
</html>
HTML;
    }
}

