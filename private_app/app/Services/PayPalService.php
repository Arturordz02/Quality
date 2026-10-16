<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Servicio de Integración con PayPal Checkout v2 (Orders API)
 *
 * Responsabilidad:
 * - Gestionar la comunicación con la API REST v2 de PayPal de forma segura en el backend.
 * - Restringir de forma rígida cualquier orden a USD 10.00 para la compra exclusiva de la primera clase.
 * - Validar órdenes en el servidor para impedir cualquier manipulación de datos desde JavaScript o el navegador.
 */

declare(strict_types=1);

namespace App\Services;

class PayPalService
{
    private string $clientId;
    private string $clientSecret;
    private string $mode;
    private string $currency;
    private float $price;
    private string $apiBaseUrl;
    private array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
        $paypalCfg = $config['paypal'] ?? [];

        $this->mode = strtolower((string)($paypalCfg['mode'] ?? getenv('PAYPAL_MODE') ?: 'sandbox'));
        
        // Resolución separada para Sandbox vs Live
        if ($this->mode === 'sandbox') {
            $this->clientId = (string)($paypalCfg['sandbox_client_id'] ?: ($paypalCfg['client_id'] ?: getenv('PAYPAL_SANDBOX_CLIENT_ID') ?: getenv('PAYPAL_CLIENT_ID') ?: ''));
            $this->clientSecret = (string)($paypalCfg['sandbox_client_secret'] ?: ($paypalCfg['client_secret'] ?: getenv('PAYPAL_SANDBOX_CLIENT_SECRET') ?: getenv('PAYPAL_CLIENT_SECRET') ?: ''));
        } else {
            $this->clientId = (string)($paypalCfg['client_id'] ?? getenv('PAYPAL_CLIENT_ID') ?: '');
            $this->clientSecret = (string)($paypalCfg['client_secret'] ?? getenv('PAYPAL_CLIENT_SECRET') ?: '');
        }

        $this->currency = (string)($paypalCfg['currency'] ?? getenv('PAYPAL_CURRENCY') ?: 'USD');
        $this->price = (float)($paypalCfg['first_class_price'] ?? getenv('PAYPAL_FIRST_CLASS_PRICE') ?: 10.00);

        $this->apiBaseUrl = ($this->mode === 'live')
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getMode(): string
    {
        return $this->mode;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function isConfigured(): bool
    {
        return !empty($this->clientId) &&
               !empty($this->clientSecret) &&
               !str_contains($this->clientId, 'TU_PAYPAL_CLIENT_ID');
    }

    /**
     * Obtiene un token de acceso OAuth2 de PayPal (Bearer token).
     */
    public function getAccessToken(): ?string
    {
        if (!$this->isConfigured()) {
            return null;
        }

        $ch = curl_init("{$this->apiBaseUrl}/v1/oauth2/token");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => 'grant_type=client_credentials',
            CURLOPT_USERPWD        => "{$this->clientId}:{$this->clientSecret}",
            CURLOPT_HTTPHEADER     => [
                'Accept: application/json',
                'Accept-Language: es_PE',
            ],
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false || $httpCode !== 200) {
            error_log("[QCS PayPal OAuth Error] HTTP {$httpCode}: {$error} | Response: {$response}");
            return null;
        }

        $data = json_decode((string)$response, true);
        return $data['access_token'] ?? null;
    }

    /**
     * Crea una orden en PayPal v2 con monto fijo de USD 10.00 para la primera clase del curso.
     */
    public function createOrder(string $courseSlug, string $courseTitle): array
    {
        $priceFormatted = number_format($this->price, 2, '.', '');
        $shortTitle = mb_substr($courseTitle, 0, 80);

        // Si estamos en entorno de prueba o credenciales simuladas
        if (!$this->isConfigured()) {
            $isDev = ($this->config['app']['env'] ?? getenv('APP_ENV') ?: 'production') === 'development';
            if ($isDev) {
                $mockOrderId = 'TEST_ORDER_' . strtoupper(substr(md5(uniqid((string)mt_rand(), true)), 0, 16));
                return [
                    'success'  => true,
                    'order_id' => $mockOrderId,
                    'status'   => 'CREATED',
                    'mock'     => true,
                ];
            }
            return [
                'success' => false,
                'message' => 'Las credenciales de PayPal no están configuradas en el entorno del servidor.',
            ];
        }

        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return [
                'success' => false,
                'message' => 'No se pudo autenticar con el servicio de PayPal en el servidor.',
            ];
        }

        $payload = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $courseSlug,
                    'description'  => "Primera clase del curso – {$shortTitle}",
                    'custom_id'    => "FIRST_CLASS_{$courseSlug}",
                    'amount'       => [
                        'currency_code' => $this->currency,
                        'value'         => $priceFormatted,
                        'breakdown'     => [
                            'item_total' => [
                                'currency_code' => $this->currency,
                                'value'         => $priceFormatted,
                            ],
                        ],
                    ],
                    'items' => [
                        [
                            'name'        => "Primera clase del curso – {$shortTitle}",
                            'description' => 'Pago exclusivo por la primera clase. No incluye el curso completo ni matrícula integral.',
                            'unit_amount' => [
                                'currency_code' => $this->currency,
                                'value'         => $priceFormatted,
                            ],
                            'quantity'    => '1',
                            'category'    => 'DIGITAL_GOODS',
                        ],
                    ],
                ],
            ],
            'application_context' => [
                'brand_name'          => 'Quality Consulting Solutions',
                'locale'              => 'es-PE',
                'landing_page'        => 'NO_PREFERENCE',
                'user_action'         => 'PAY_NOW',
                'shipping_preference' => 'NO_SHIPPING',
            ],
        ];

        $ch = curl_init("{$this->apiBaseUrl}/v2/checkout/orders");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                "Authorization: Bearer {$accessToken}",
                'Prefer: return=representation',
            ],
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false || !in_array($httpCode, [200, 201], true)) {
            error_log("[QCS PayPal Create Order Error] HTTP {$httpCode}: {$error} | Response: {$response}");
            return [
                'success' => false,
                'message' => 'Error al generar la orden de pago en PayPal.',
                'raw'     => $response,
            ];
        }

        $orderData = json_decode((string)$response, true);
        return [
            'success'  => true,
            'order_id' => $orderData['id'] ?? '',
            'status'   => $orderData['status'] ?? 'CREATED',
            'raw'      => $orderData,
        ];
    }

    /**
     * Captura una orden aprobada por el usuario en PayPal v2.
     */
    public function captureOrder(string $orderId): array
    {
        // Soporte de mock en desarrollo
        if (!$this->isConfigured()) {
            $isDev = ($this->config['app']['env'] ?? getenv('APP_ENV') ?: 'production') === 'development';
            if ($isDev && str_starts_with($orderId, 'TEST_ORDER_')) {
                $mockCaptureId = 'TEST_CAPTURE_' . substr($orderId, 11);
                return [
                    'success'    => true,
                    'order_id'   => $orderId,
                    'capture_id' => $mockCaptureId,
                    'status'     => 'COMPLETED',
                    'amount'     => $this->price,
                    'currency'   => $this->currency,
                    'mock'       => true,
                ];
            }
            return [
                'success' => false,
                'message' => 'Servicio de PayPal no configurado en el servidor.',
            ];
        }

        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return [
                'success' => false,
                'message' => 'No se pudo conectar con el servidor de PayPal para capturar el pago.',
            ];
        }

        $ch = curl_init("{$this->apiBaseUrl}/v2/checkout/orders/{$orderId}/capture");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => '{}',
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                "Authorization: Bearer {$accessToken}",
                'Prefer: return=representation',
            ],
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false || !in_array($httpCode, [200, 201], true)) {
            error_log("[QCS PayPal Capture Order Error] HTTP {$httpCode}: {$error} | Response: {$response}");
            return [
                'success' => false,
                'message' => 'No fue posible capturar el pago en PayPal.',
                'raw'     => $response,
            ];
        }

        $data = json_decode((string)$response, true);
        $status = $data['status'] ?? '';
        $captures = $data['purchase_units'][0]['payments']['captures'] ?? [];
        $captureItem = $captures[0] ?? [];
        $captureId = $captureItem['id'] ?? '';
        $amount = (float)($captureItem['amount']['value'] ?? $this->price);
        $currency = $captureItem['amount']['currency_code'] ?? $this->currency;

        return [
            'success'    => ($status === 'COMPLETED'),
            'order_id'   => $data['id'] ?? $orderId,
            'capture_id' => $captureId,
            'status'     => $status,
            'amount'     => $amount,
            'currency'   => $currency,
            'raw'        => $data,
        ];
    }

    /**
     * Verifica si una transacción, orden o captura de PayPal ya fue utilizada en un registro previo.
     */
    public static function isTransactionAlreadyUsed(string $identifier, array $config = []): bool
    {
        $cleanId = trim($identifier);
        if (empty($cleanId)) {
            return false;
        }

        $backendDir = dirname(__DIR__, 2) . '/backend';
        $queueDir = $backendDir . '/storage/fallback_queue';

        if (is_dir($queueDir)) {
            // 1. Comprobación directa por nombre de archivo estándar de la cola
            $safeId = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $cleanId);
            $directFile = $queueDir . '/paypal_first_class_' . $safeId . '.json';
            if (file_exists($directFile) && filesize($directFile) > 0) {
                return true;
            }

            // 2. Escaneo de archivos json de la cola por coincidencia de paypal_order_id o paypal_capture_id
            $files = glob($queueDir . '/paypal_first_class_*.json');
            if ($files) {
                foreach ($files as $file) {
                    if (!is_file($file)) continue;
                    $content = @file_get_contents($file);
                    if ($content && (str_contains($content, '"paypal_order_id"') || str_contains($content, '"paypal_capture_id"'))) {
                        $decoded = json_decode($content, true);
                        $data = $decoded['data'] ?? $decoded;
                        $savedOrderId = $data['paypal_order_id'] ?? $decoded['id'] ?? '';
                        $savedCaptureId = $data['paypal_capture_id'] ?? '';
                        if (strcasecmp((string)$savedOrderId, $cleanId) === 0 || 
                            (!empty($savedCaptureId) && strcasecmp((string)$savedCaptureId, $cleanId) === 0)) {
                            return true;
                        }
                    }
                }
            }
        }

        // 3. Comprobación en base de datos MySQL si está activa
        if (class_exists(\Database::class, false) && !empty($config)) {
            try {
                return \Database::isPayPalTransactionUsed($config, $cleanId);
            } catch (\Throwable $e) {
                // Silencioso, fallback a comprobación en cola
            }
        }

        return false;
    }

    /**
     * Valida de manera estricta en el backend que una orden de PayPal exista,
     * esté en estado COMPLETED, en moneda USD, por el importe exacto de USD 10.00,
     * hacia la cuenta receptora de Quality, asociada al curso correspondiente y no reutilizada.
     */
    public function verifyOrder(
        string $orderId,
        float $expectedAmount = 10.00,
        string $expectedCurrency = 'USD',
        string $expectedCourse = ''
    ): array {
        $cleanOrderId = trim($orderId);
        if (empty($cleanOrderId)) {
            return ['valid' => false, 'error' => 'Código de orden de PayPal no proporcionado.'];
        }

        if (empty($expectedCourse) || !CourseCatalog::isValid($expectedCourse)) {
            return ['valid' => false, 'error' => 'El curso asociado al pago no es válido.'];
        }

        // 1. Verificación de Transacción no utilizada previamente
        if (self::isTransactionAlreadyUsed($cleanOrderId)) {
            return [
                'valid' => false,
                'error' => "El código de transacción {$cleanOrderId} ya fue utilizado en un registro previo. No se permiten registros duplicados con el mismo pago.",
                'code'  => 'TRANSACTION_ALREADY_USED',
            ];
        }

        $isDev = ($this->config['app']['env'] ?? getenv('APP_ENV') ?: 'production') === 'development';

        // 2. Manejo controlado para entorno de desarrollo / pruebas automáticas
        if (!$this->isConfigured()) {
            if ($isDev && str_starts_with($cleanOrderId, 'TEST_ORDER_')) {
                // Simulación determinista de casos de prueba
                if (str_contains($cleanOrderId, 'NOT_COMPLETED')) {
                    return [
                        'valid' => false,
                        'error' => 'El estado de la orden en PayPal es PENDING, no COMPLETED.',
                        'status'=> 'PENDING',
                    ];
                }
                if (str_contains($cleanOrderId, 'WRONG_AMT')) {
                    return [
                        'valid' => false,
                        'error' => 'El monto del pago no corresponde a la primera clase (USD 10.00).',
                    ];
                }
                if (str_contains($cleanOrderId, 'WRONG_CURR')) {
                    return [
                        'valid' => false,
                        'error' => 'La moneda del pago no es USD.',
                    ];
                }
                if (str_contains($cleanOrderId, 'WRONG_RECEIVER')) {
                    return [
                        'valid' => false,
                        'error' => 'La cuenta receptora del pago no corresponde a Quality Consulting Solutions.',
                    ];
                }
                if (str_contains($cleanOrderId, 'WRONG_COURSE')) {
                    return [
                        'valid' => false,
                        'error' => 'La transacción no corresponde a la capacitación seleccionada.',
                    ];
                }

                $mockCaptureId = 'TEST_CAPTURE_' . substr($cleanOrderId, 11);

                return [
                    'valid'        => true,
                    'order_id'     => $cleanOrderId,
                    'capture_id'   => $mockCaptureId,
                    'status'       => 'COMPLETED',
                    'amount'       => 10.00,
                    'currency'     => 'USD',
                    'receiver'     => 'comercial@quality-consulting.org',
                    'course_slug'  => $expectedCourse,
                    'mock'         => true,
                ];
            }

            return [
                'valid'        => false,
                'error'        => 'Credenciales de PayPal pendientes de configuración en el servidor privado (.env / env.php). La verificación automática en línea requiere configurar PAYPAL_CLIENT_ID y PAYPAL_CLIENT_SECRET.',
                'unconfigured' => true,
            ];
        }

        // 3. Consulta en vivo a la API REST v2 de PayPal
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return ['valid' => false, 'error' => 'Fallo de autenticación con el servidor de PayPal.'];
        }

        $ch = curl_init("{$this->apiBaseUrl}/v2/checkout/orders/{$cleanOrderId}");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPGET        => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                "Authorization: Bearer {$accessToken}",
            ],
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false || $httpCode !== 200) {
            error_log("[QCS PayPal Verify Error] HTTP {$httpCode}: {$error} | Response: {$response}");
            return ['valid' => false, 'error' => "No se pudo consultar la orden {$cleanOrderId} en PayPal (HTTP {$httpCode})."];
        }

        $data = json_decode((string)$response, true);
        $status = $data['status'] ?? '';

        // A. Estado de pago completado
        if ($status !== 'COMPLETED') {
            return [
                'valid' => false,
                'error' => "El estado del pago en PayPal no es 'COMPLETED' (Estado actual: {$status}).",
                'status' => $status,
            ];
        }

        $units = $data['purchase_units'] ?? [];
        if (empty($units)) {
            return ['valid' => false, 'error' => 'La orden no contiene unidades de compra en PayPal.'];
        }

        $unit = $units[0];
        $currency = $unit['amount']['currency_code'] ?? '';
        $amount = (float)($unit['amount']['value'] ?? 0.0);

        // B. Moneda USD
        if (strtoupper($currency) !== strtoupper($expectedCurrency)) {
            return [
                'valid' => false,
                'error' => "Moneda no coincide. Esperado: {$expectedCurrency}, Recibido: {$currency}.",
            ];
        }

        // C. Importe exacto de US$ 10.00
        if (abs($amount - $expectedAmount) > 0.01) {
            return [
                'valid' => false,
                'error' => "El monto no corresponde a la primera clase. Esperado: USD {$expectedAmount}, Recibido: USD {$amount}.",
            ];
        }

        // D. Cuenta receptora configurada de Quality (Diferenciando Sandbox y Live)
        $isSandbox = ($this->mode === 'sandbox');
        $configuredReceiver = strtolower((string)($this->config['paypal']['receiver_email'] ?? 'comercial@quality-consulting.org'));
        $sandboxReceiver = strtolower((string)($this->config['paypal']['sandbox_receiver_email'] ?? ''));
        $payeeEmail = strtolower((string)($unit['payee']['email_address'] ?? ''));

        if (!$isSandbox) {
            // En producción: comprobación estricta contra la cuenta comercial confirmada
            if (!empty($configuredReceiver) && !empty($payeeEmail) && $payeeEmail !== $configuredReceiver) {
                $allowedReceivers = [$configuredReceiver, 'comercial@quality-consulting.org', 'contacto@quality-consulting.org'];
                if (!in_array($payeeEmail, $allowedReceivers, true)) {
                    return [
                        'valid' => false,
                        'error' => "La cuenta receptora ({$payeeEmail}) no coincide con la cuenta oficial de Quality Consulting Solutions.",
                    ];
                }
            }
        } else {
            // En sandbox: si se configuró un receptor sandbox específico, validarlo
            if (!empty($sandboxReceiver) && !empty($payeeEmail) && $payeeEmail !== $sandboxReceiver) {
                return [
                    'valid' => false,
                    'error' => "La cuenta receptora sandbox ({$payeeEmail}) no coincide con la cuenta de prueba configurada ({$sandboxReceiver}).",
                ];
            }
        }

        // E. Capacitación y compra asociada
        if (!empty($expectedCourse)) {
            $customId = (string)($unit['custom_id'] ?? '');
            $referenceId = (string)($unit['reference_id'] ?? '');
            $desc = (string)($unit['description'] ?? '');
            $matchedCourse = str_contains($customId, $expectedCourse) ||
                             str_contains($referenceId, $expectedCourse) ||
                             str_contains(strtolower($desc), strtolower($expectedCourse));

            if (!$matchedCourse) {
                return [
                    'valid' => false,
                    'error' => 'La orden de PayPal no está asociada al curso seleccionado.',
                ];
            }

            // Si la orden traía un curso diferente expresamente registrado
            if (!empty($customId) && str_starts_with($customId, 'FIRST_CLASS_') && !str_contains($customId, $expectedCourse)) {
                return [
                    'valid' => false,
                    'error' => "El pago registrado en PayPal corresponde a otra capacitación y no a la seleccionada.",
                ];
            }
        }

        // F. Extracción del Capture ID y verificación de no reutilización de la captura
        $captures = $unit['payments']['captures'] ?? [];
        $captureItem = $captures[0] ?? [];
        $captureId = $captureItem['id'] ?? '';

        if (!empty($captureId) && self::isTransactionAlreadyUsed($captureId)) {
            return [
                'valid' => false,
                'error' => "El código de captura {$captureId} ya fue registrado previamente en el sistema.",
                'code'  => 'TRANSACTION_ALREADY_USED',
            ];
        }

        return [
            'valid'        => true,
            'order_id'     => $data['id'] ?? $cleanOrderId,
            'capture_id'   => $captureId,
            'status'       => $status,
            'amount'       => $amount,
            'currency'     => $currency,
            'receiver'     => $payeeEmail ?: $configuredReceiver,
            'course_slug'  => $expectedCourse,
            'raw'          => $data,
        ];
    }
}

