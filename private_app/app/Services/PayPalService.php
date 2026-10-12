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

        $this->mode = (string)($paypalCfg['mode'] ?? getenv('PAYPAL_MODE') ?: 'sandbox');
        $this->clientId = (string)($paypalCfg['client_id'] ?? getenv('PAYPAL_CLIENT_ID') ?: '');
        $this->clientSecret = (string)($paypalCfg['client_secret'] ?? getenv('PAYPAL_CLIENT_SECRET') ?: '');
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
                return [
                    'success'  => true,
                    'order_id' => $orderId,
                    'status'   => 'COMPLETED',
                    'amount'   => $this->price,
                    'currency' => $this->currency,
                    'mock'     => true,
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

        return [
            'success'  => ($status === 'COMPLETED'),
            'order_id' => $data['id'] ?? $orderId,
            'status'   => $status,
            'raw'      => $data,
        ];
    }

    /**
     * Valida de manera estricta en el backend que una orden de PayPal exista,
     * esté en estado COMPLETED, en moneda USD y por el importe exacto de USD 10.00.
     */
    public function verifyOrder(string $orderId, float $expectedAmount = 10.00, string $expectedCurrency = 'USD'): array
    {
        $cleanOrderId = trim($orderId);
        if (empty($cleanOrderId)) {
            return ['valid' => false, 'error' => 'Código de orden de PayPal no proporcionado.'];
        }

        // Mock en desarrollo
        if (!$this->isConfigured()) {
            $isDev = ($this->config['app']['env'] ?? getenv('APP_ENV') ?: 'production') === 'development';
            if ($isDev && str_starts_with($cleanOrderId, 'TEST_ORDER_')) {
                return [
                    'valid'    => true,
                    'order_id' => $cleanOrderId,
                    'status'   => 'COMPLETED',
                    'amount'   => 10.00,
                    'currency' => 'USD',
                    'mock'     => true,
                ];
            }
            return [
                'valid' => false,
                'error' => 'Credenciales de PayPal pendientes de configuración en el servidor.',
            ];
        }

        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return ['valid' => false, 'error' => 'Fallo al autenticar contra la API de PayPal.'];
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

        if ($status !== 'COMPLETED') {
            return [
                'valid' => false,
                'error' => "El estado de la orden en PayPal no es 'COMPLETED' (Estado actual: {$status}).",
                'status' => $status,
            ];
        }

        // Validar importe y moneda en purchase_units
        $units = $data['purchase_units'] ?? [];
        if (empty($units)) {
            return ['valid' => false, 'error' => 'La orden no contiene unidades de compra.'];
        }

        $unit = $units[0];
        $currency = $unit['amount']['currency_code'] ?? '';
        $amount = (float)($unit['amount']['value'] ?? 0.0);

        if (strtoupper($currency) !== strtoupper($expectedCurrency)) {
            return [
                'valid' => false,
                'error' => "Moneda no coincide. Esperado: {$expectedCurrency}, Recibido: {$currency}.",
            ];
        }

        if (abs($amount - $expectedAmount) > 0.01) {
            return [
                'valid' => false,
                'error' => "El monto no corresponde a la primera clase. Esperado: USD {$expectedAmount}, Recibido: USD {$amount}.",
            ];
        }

        return [
            'valid'    => true,
            'order_id' => $data['id'] ?? $cleanOrderId,
            'status'   => $status,
            'amount'   => $amount,
            'currency' => $currency,
            'raw'      => $data,
        ];
    }
}
