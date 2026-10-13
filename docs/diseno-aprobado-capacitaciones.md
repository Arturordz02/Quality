# Diseño Aprobado para Páginas de Detalle de Capacitaciones

**Proyecto:** Quality Consulting Solutions  
**Archivo de documentación:** `docs/diseno-aprobado-capacitaciones.md`  
**Estado:** Aprobado en producción local (Bloque 1 – Área de Calidad)

---

## 1. Propósito y Alcance

Este documento registra la arquitectura, estructura de datos, clases CSS, recursos gráficos y reglas editoriales del diseño aprobado para las páginas de detalle de capacitaciones de **Quality Consulting Solutions**, implementado inicialmente en los tres primeros cursos con brochure oficial del Área de Calidad:

1. **Gerencia de la Calidad en la Construcción** (`/gerencia-de-calidad`)
2. **ISO 9001 para la Construcción usando IA** (`/iso-9001`)
3. **Control de Calidad en Tunelería** (`/control-de-calidad-en-tuneleria`)

Cualquier integración futura de nuevos brochures deberá reutilizar esta plantilla y sus reglas sin rediseñar la interfaz ni inventar contenidos no respaldados por el documento oficial de cada curso.

---

## 2. Ubicación de la Plantilla Compartida y Vistas

- **Plantilla parcial compartida:** `private_app/app/Views/partials/course_detail_unified.php`
- **Vistas de página que la invocan:**
  - `private_app/app/Views/pages/gerencia-de-calidad.php`
  - `private_app/app/Views/pages/iso-9001.php`
  - `private_app/app/Views/pages/control-de-calidad-en-tuneleria.php`
- **Controlador:** `private_app/app/Controllers/TrainingController.php`
- **Repositorio centralizado del catálogo (48 cursos):** `private_app/app/Services/CoursesCatalog.php`
- **Layout maestro:** `private_app/app/Views/layouts/main.php`

Cada vista de curso define únicamente el arreglo asociativo `$course` con los datos reales extraídos de su brochure y delega el renderizado completo mediante:

```php
echo $this->partial('course_detail_unified', ['course' => $course]);
```

---

## 3. Estructura Completa del Arreglo `$course`

```php
$course = [
    // 1. Hero Banner (Composición estilo ISO 9001)
    'hero_badge'           => 'TEXTO EN MAYÚSCULAS DE LA ETIQUETA SUPERIOR',
    'hero_badge_icon'      => 'fa-solid fa-graduation-cap',
    'title'                => 'TÍTULO OFICIAL DEL CURSO EN MAYÚSCULAS',
    'summary'              => 'Resumen centrado con ancho de lectura controlado (máx. 860px).',
    'hero_cards'           => [
        // 3 o 4 tarjetas según los beneficios reales del curso (no inventar tarjetas para completar 4)
        [
            'icon'  => 'fa-solid fa-award',
            'title' => 'TÍTULO CORTO EN MAYÚSCULAS',
            'desc'  => 'Descripción puntual respaldada por el brochure.',
        ],
    ],

    // 2. Objetivo del curso (Columna izquierda en escritorio)
    'objective'            => 'Texto íntegro del objetivo del curso según el brochure (admite <strong> y <em>).',
    'objective_image'      => 'img/GERCA1.png',      // Opcional ('' si no aplica)
    'objective_image_webp' => 'img/GERCA1.webp',     // Opcional ('' si no aplica)
    'objective_image_alt'  => 'Texto alternativo descriptivo',
    'objective_highlights' => [                      // Opcional: puntos de enfoque y alcance técnico
        'Punto clave 1 extraído del brochure.',
        'Punto clave 2 extraído del brochure.',
    ],

    // 3. Temario del curso (Acordeón desplegable enriquecido)
    'syllabus_intro'       => 'Introducción breve del temario según el brochure.',
    'syllabus'             => [
        [
            'title'   => 'Título del módulo',
            'icon'    => 'fa-solid fa-building',     // Ícono temático discreto
            'clause'  => 'Cláusula 4 ISO 9001',      // Opcional: solo cuando el curso referencia cláusulas normativas
            'content' => '<p>Contenido HTML del módulo (párrafos <p>, subtítulos <p class="qcs-cd-syllabus-subhead"> o listas <ul><li>).</p>',
        ],
    ],

    // 4. Perfil docente (Columna derecha en escritorio)
    'docente'              => [
        'photo'          => 'img/Omar_Samaniego.png',  // Opcional ('' si el docente no tiene foto en el proyecto)
        'photo_webp'     => 'img/Omar_Samaniego.webp', // Opcional
        'name'           => 'Nombre y grado académico del docente',
        'experience_tag' => '+25 años de experiencia',
        'credentials'    => ['Credencial 1', 'Credencial 2'],
        'summary'        => 'Resumen profesional del docente según el brochure.',
        'highlights'     => [
            '<strong>Empresa / Institución:</strong> Cargo desempeñado.',
        ],
        'full_bio_items' => [                          // Opcional: se muestra dentro del desplegable "Ver trayectoria completa"
            '<strong>Hito adicional:</strong> Detalle curricular.',
        ],
        'recognition'    => 'Reconocimiento o mención destacada del brochure.', // Opcional
    ],

    // 5. Beneficios y materiales + PDU (sin brochure público)
    'benefits'             => [
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'Bolsa laboral',
            'text'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions.',
        ],
    ],
    'pdu_heading'          => 'Unidades de desarrollo profesional (16 PDU)', // Opcional (04 PDU, 06 PDU, etc.)
    'pdu_text'             => 'Explicación oficial del brochure sobre las PDU (dejar en "" si el curso no otorga PDU).',

    // 6. Información e inscripción
    'enroll_bg_image'      => 'img/ISO1.webp', // Opcional: imagen temática para el lado izquierdo del panel oscuro ('' usa solo el degradado)
    'whatsapp_url'         => 'https://api.whatsapp.com/send?phone=51993463118&text=...',
    'modal_service'        => 'Nombre del curso para el modal #modalSolicitarInfo',
    'paypal_slug'          => 'slug-del-curso', // Habilitado para los 6 cursos autorizados; vacío en los demás

    // 7. Sección opcional de videos y conferencias
    'videos'               => [ // Arreglo vacío [] si el curso no tiene videos asociados
        [
            'header'    => 'Título corto de la tarjeta de video',
            'embed_url' => 'https://www.youtube.com/embed/...',
            'title'     => 'Atributo title accesible del iframe',
            'caption'   => '<strong>Tema:</strong> Descripción breve.',
        ],
    ],
];
```

---

## 4. Sistema de Estilos, Tipografía, Colores y Comportamiento Responsive

### 4.1 Archivo de estilos y encapsulamiento
- **Hoja de estilos global:** `public_html/styles.css` (Sección 16: `PLANTILLA UNIFICADA DE DETALLE DE CAPACITACIÓN (.qcs-course-detail)`).
- **Control de caché CSS:** En `private_app/app/Views/layouts/main.php`, el enlace `<link rel="stylesheet" href="styles.css?v=3.5">` debe incrementar su parámetro `?v=` cada vez que se modifique `styles.css`.
- **Encapsulamiento:** Todas las reglas están acotadas bajo `.qcs-course-detail`, `.qcs-iso-*` y `.qcs-cd-*` para no afectar el inicio ni otras secciones del sitio.

### 4.2 Fuentes y paleta cromática
- **Títulos y etiquetas (`--font-heading`):** `'Montserrat', sans-serif` (pesos `600`, `700`, `800`).
- **Cuerpo de lectura (`--font-body`):** `'Open Sans', sans-serif` (pesos `400`, `600`, alineación izquierda sin justificado forzado).
- **Colores principales:**
  - Negro / Carbón profundo: `#0F1113` y `#121518`
  - Pizarra oscura institucional: `#1A1D20` y `#16191D`
  - Dorado institucional Quality: `#E5A813` (acento claro `#fef08a`, hover `#C9910D`, texto dorado sobre fondo claro `#C48B0C` / `#9a6b00`)
  - Fondo marfil cálido (sección Beneficios y materiales): `linear-gradient(180deg, #FCF9F2 0%, #F7EFE0 100%)` con círculos de ícono `#F8E9C4`
  - Fondo general de página de detalle: `#F4F5F7` alternado con bloques `#ffffff`

### 4.3 Comportamiento Responsive y Prevención de Desbordamientos
- **Puntos de quiebre (Breakpoints):**
  - **Escritorio (`>= 992px`):**
    - Tarjetas del Hero: 4 columnas (`col-lg-3`) cuando hay 4 tarjetas, o 3 columnas (`col-md-4`) cuando hay 3 tarjetas.
    - Objetivo del curso y Perfil docente: 2 columnas (`col-lg-6`) alineadas en la parte superior (`align-items-start`) para evitar estirar artificialmente la tarjeta de menor altura.
    - Beneficios abiertos: 3 columnas (`col-lg-4`) centradas (`justify-content-center`).
    - Panel de inscripción: 2 columnas (`grid-template-columns: 0.92fr 1.08fr`).
  - **Tablet (`768px – 991.98px`):**
    - Objetivo y Perfil docente apilados a ancho completo.
    - Beneficios abiertos en 2 columnas (`col-md-6`) con última fila centrada si es impar.
    - Panel de inscripción en 1 columna con divisor horizontal sutil.
  - **Móvil (`<= 767.98px`, verificado en `430px`, `390px` y `360px`):**
    - 1 columna en todas las grillas.
    - En el acordeón del temario, la píldora de cláusula baja debajo del título del módulo con `white-space: normal`, y en `<= 480px` se oculta el ícono secundario `.qcs-cd-syllabus-icon` para priorizar el ancho de lectura del título.
    - Tarjeta integrada de brochure y subbloque de primera clase apilados limpiamente sin recortes ni scroll horizontal (`scrollWidth === clientWidth`, sin usar `overflow-x: hidden` indiscriminado).

---

## 5. Especificación Visual por Sección

### 5.1 Banner Hero (`.qcs-iso-hero-banner`)
- Basado en la composición aprobada de **ISO 9001**:
  - Fondo oscuro con resplandor radial dorado (`.qcs-iso-hero-banner` y `::before`).
  - Etiqueta superior centrada tipo píldora dorada (`.qcs-iso-hero-pill`).
  - Título principal `<h1>` centrado, en mayúsculas y peso `800` (`.qcs-iso-hero-title`).
  - Resumen centrado con ancho controlado de `860px` (`.qcs-iso-hero-summary`).
  - Tarjetas informativas inferiores con efecto glassmorphism oscuro, borde dorado e ícono circular dorado (`.qcs-iso-benefit-card`).
  - **Regla estricta:** No colocar botones de brochure dentro del Hero ni inventar una cuarta tarjeta cuando el curso solo tenga tres bloques de beneficios destacados (ej. Tunelería).

### 5.2 Objetivo del Curso y Perfil Docente (`#objetivo-y-docente`)
- Ambas tarjetas utilizan la clase `.qcs-iso-audit-card` (borde superior oscuro de `4px` que cambia a `#E5A813` en hover, esquinas de `16px`).
- Títulos uniformes: **«Objetivo del curso»** y **«Perfil docente»** con línea decorativa dorada inferior (`.qcs-iso-heading-line`).
- Si el curso tiene imagen de objetivo (`objective_image`), se muestra con `<picture>` dentro de `.qcs-iso-objective-media`. Si no existe (ej. Tunelería), no queda espacio vacío.
- Si el docente tiene fotografía (`docente.photo`), se presenta en el sello circular con borde dorado `.qcs-iso-auditor-seal`. Si no existe fotografía (ej. Ing. Mag. Roxana Monje), el encabezado del docente alinea directamente su insignia de experiencia y su nombre sin mostrar avatares genéricos ni espacios vacíos.
- La trayectoria extensa se agrupa dentro del desplegable nativo `<details class="qcs-cd-bio-details">` («Ver trayectoria completa»).

### 5.3 Temario del Curso (`#temario-curso`)
- Encabezado centrado con insignia oscura/dorada «Estructura curricular oficial» (`.qcs-iso-section-badge`), título **«Temario del curso»** y subrayado dorado (`.qcs-iso-title-underline`).
- Acordeón vertical de ancho controlado (`max-width: 980px`, `.qcs-cd-syllabus-accordion`) construido con elementos nativos `<details class="qcs-cd-syllabus-item">` (el primer módulo inicia abierto con `open`).
- Cada encabezado `<summary class="qcs-cd-syllabus-summary">` incluye:
  1. Indicador oscuro con número dorado de dos dígitos (`.qcs-cd-syllabus-num`: `01`, `02`, etc.).
  2. Ícono temático discreto (`.qcs-cd-syllabus-icon`) que invierte sus colores a fondo dorado en estado `[open]`.
  3. Título del módulo en negrita (`.qcs-cd-syllabus-title`) y píldora opcional de cláusula normativa (`.qcs-cd-syllabus-clause`).
  4. Flecha circular derecha (`.qcs-cd-syllabus-chevron`) que gira `180deg` al abrirse.

### 5.4 Beneficios y Materiales + Franja Oscura PDU + Brochure Integrado (`#beneficios-materiales`)
- **Fondo marfil cálido:** `.qcs-cd-section--ivory`.
- **Encabezado centrado:** Etiqueta dorada `ALCANCE DEL PROGRAMA` (`.qcs-cd-ivory-eyebrow`), título **«Beneficios y materiales»** y subrayado dorado.
- **Bloques abiertos de beneficios:** Sin bordes de tarjeta ni cajas que compitan con el temario. Cada elemento (`.qcs-cd-benefit-open-item`) presenta un círculo claro (`.qcs-cd-benefit-circle-icon`) con ícono dorado, título corto en negrita (`.qcs-cd-benefit-open-title`) y descripción fiel al brochure (`.qcs-cd-benefit-open-desc`).
  - **Regla editorial:** *«Ingreso a la base de datos laboral de Quality Consulting Solutions»* se titula **«Bolsa laboral»** y conserva su texto exacto sin prometer empleo ni vacantes garantizadas.
- **Franja oscura de PDU (`.qcs-cd-pdu-dark-bar`):**
  - Se renderiza únicamente cuando `$course['pdu_text']` tiene contenido.
  - Título fijo: **«Unidades de desarrollo profesional (16 PDU)»** (nunca presentarlo como «Acreditación institucional PMI»).
  - Conserva la explicación completa del brochure sobre categoría CCR y horas netas.
- **Retiro de Visualización y Descarga de Brochures:**
  - Por disposición directiva, los brochures técnicos se utilizan exclusivamente como fuentes internas de consulta y **no se publican ni se ofrecen para descarga en la web**.
  - La tarjeta de brochure (`.qcs-cd-brochure-integrated-card`, `#brochure-curso`) y los botones asociados («Ver PDF», «Descargar PDF», «Info & Brochure») han sido **retirados de todas las páginas de capacitación**.
  - La sección marfil finaliza de forma limpia y equilibrada tras los bloques de beneficios y la franja de PDU, conservando el espaciado y márgenes armónicos sin huecos vacíos.
  - Beneficios documentados como «Entrega de material digital» o «Libro oficial incluido» se mantienen 100% intactos en la grilla de beneficios.

### 5.5 Información e Inscripción (`#informacion-inscripcion`)
- Panel oscuro amplio con bordes redondeados y degradado carbón/dorado (`.qcs-cd-enroll-panel`).
- Si el curso define `'enroll_bg_image'`, la clase `.qcs-cd-enroll-panel--has-bg` proyecta esa imagen temática en la mitad izquierda con superposición oscura gradual para garantizar el contraste del texto blanco. Si no existe una imagen adecuada para el curso, se deja `''` y el panel muestra el degradado institucional sin repetir fotos de otros cursos ni inventar fondos.
- **Columna izquierda:** Píldora `CAPACITACIÓN ESPECIALIZADA`, título blanco **«Información e inscripción»**, texto de orientación y línea de acento dorada.
- **Columna derecha:**
  1. Botón principal dorado **«Solicitar información»** (abre `#modalSolicitarInfo` con `data-service`).
  2. Botón secundario **«Consultar por WhatsApp»** con borde claro e ícono verde de WhatsApp.
  3. Subbloque diferenciado (`.qcs-cd-first-class-box`) con etiqueta `PRIMERA CLASE`, precio `US$ 10`, botón azul PayPal **«Pagar primera clase»** (`.btn.qcs-cd-btn-paypal-fc.btn-paypal-first-class` con enlace oficial a `https://www.paypal.com/paypalme/qualityconsulting/10` y `data-course-slug="slug-del-curso"`), junto a la nota explícita:
     > *«US$10 únicamente por la primera clase. No incluye el curso completo.»*
- **Debajo del panel (fuera de la tarjeta oscura):** Enlaces discretos centrados **«Volver al Área de Calidad»** (`/capacitacion-calidad`) y **«Ver catálogo general»** (`/capacitacion`).

### 5.6 Sección Opcional de Videos (`#videos-curso`)
- Solo se renderiza si `!empty($course['videos'])`.
- Presenta las conferencias de YouTube en tarjetas `.qcs-iso-video-card` con cabecera oscura `.qcs-iso-video-header`, contenedor `.ratio.ratio-16x9` y pie descriptivo `.qcs-iso-video-caption`.

---

## 6. Inventario de Capacitaciones y Almacenamiento Privado

Los documentos originales (PDFs) y sus portadas extraídas han sido retirados de los directorios públicos (`public_html/` y `_site/`) y reubicados en el almacenamiento privado del servidor:
- **Brochures técnicos privados:** `private_app/storage/brochures/calidad/`
- **Portadas extraídas privadas:** `private_app/storage/brochures/portadas/`

| N° | Capacitación en Catálogo | Ruta Web | Almacenamiento Privado del PDF | Bloque PayPal US$10 |
|:--:|:---|:---:|:---|:---:|
| **1** | **Gerencia de la Calidad en la Construcción** | `/gerencia-de-calidad` | `private_app/storage/brochures/calidad/gerencia-de-la-calidad-en-la-construccion.pdf` | **Habilitado** (`gerencia-de-calidad`) |
| **2** | **ISO 9001 para la Construcción usando IA** | `/iso-9001` | `private_app/storage/brochures/calidad/iso-9001-para-la-construccion-usando-ia.pdf` | **Habilitado** (`iso-9001`) |
| **4** | **Control de Calidad en Tunelería** | `/control-de-calidad-en-tuneleria` | `private_app/storage/brochures/calidad/control-de-calidad-en-tuneleria.pdf` | **Habilitado** (`control-de-calidad-en-tuneleria`) |
| **8** | **Seminario Completion - Evita el Síndrome del 90%** | `/sindrome-del-90` | `private_app/storage/brochures/calidad/seminario-completion-sindrome-del-90.pdf` | **Habilitado** (`sindrome-del-90`) |
| **9** | **Seminario ISO 9001:2026** | `/seminario-iso-9001-2026` | `private_app/storage/brochures/calidad/seminario-iso-9001-2026.pdf` | **Habilitado** (`seminario-iso-9001-2026`) |
| **10** | **Seminario Indicadores Avanzados de Calidad** | `/indicadores-de-calidad` | `private_app/storage/brochures/calidad/indicadores-avanzados-de-calidad-en-la-construccion.pdf` | **Habilitado** (`indicadores-de-calidad`) |

> [!IMPORTANT]
> Los cursos #3 (*Calidad y PMI*), #5 (*Dirección de la Calidad Enfoque PMI*), #6 (*Herramientas de Calidad*) y #7 (*Seminario Ishikawa*) no forman parte de este lote autorizado para pasarela en línea y conservan su canal exclusivo de consulta mediante modal y WhatsApp.

---

## 7. Mecanismos de Privacidad y Exclusión del Despliegue

La privacidad de los documentos técnicos se garantiza en cuatro capas independientes:
1. **Separación de raíz web:** `private_app/storage/` se encuentra un nivel por encima del DocumentRoot de producción (`public_html/`), haciéndolo inaccesible por el servidor web Apache de GoDaddy/cPanel.
2. **Regla HTTP Apache (`private_app/.htaccess`):** Configurado con `Require all denied` (Apache 2.4+) y `Deny from all` (Apache 2.2-), bloqueando cualquier acceso directo por protocolo HTTP/HTTPS.
3. **Exclusión en Git (`.gitignore`):** Se agregó la regla `private_app/storage/` para que los nuevos archivos privados no sean rastreados por Git.
   > *Nota sobre historial:* Excluir archivos del seguimiento actual no altera ni reescribe el historial de commits anteriores de Git, los cuales preservan su registro histórico inalterado sin recurrir a reescrituras disruptivas.
4. **Exclusión en compilador estático (`build_static.php`):** La función `copyDirectory()` descarta expresamente las carpetas `backend`, `storage` y `brochures`, asegurando que `_site/` nunca contenga copias públicas ni enlaces huérfanos a los PDFs.

---

## 8. Diagnóstico de Infraestructura y Hosting Disponible

### 8.1 Diagnóstico Técnico del Dominio en Producción
Se auditó la conectividad directa y cabeceras HTTP del dominio de producción mediante solicitudes cURL:
```bash
curl -i -s -L -k "https://quality-consulting.org/mvc-health"
```
**Hallazgos técnicos comprobados:**
1. `https://quality-consulting.org` responde con redirección HTTP `301 Moved Permanently` hacia `https://www.quality-consulting.org/`.
2. `https://www.quality-consulting.org/` se encuentra actualmente apuntando a través de Cloudflare hacia **Weebly** (`server: cloudflare`, cabecera `X-Host: blu25.sf2p.intern.weebly.net` y recursos de `cdn1.editmysite.com`).
3. Al consultar cualquier ruta dinámica (como `/mvc-health` o `/registro-primera-clase`), Weebly responde con una página HTML genérica `404 Not Found` de Weebly.
4. **Conclusión:** El dominio público `quality-consulting.org` no está apuntando todavía a un servidor Apache/cPanel con PHP 8+. La aplicación completa PHP MVC (`private_app/`, `public_html/`) reside en el repositorio local y compila páginas estáticas a `_site/` para la previsualización en GitHub Pages (`https://arturordz02.github.io/Quality/`).

### 8.2 Requisitos y Datos Necesarios para el Despliegue del Backend PHP
Para que el backend dinámico de pagos y correo opere en vivo bajo el dominio institucional, se requiere:
1. **Apuntamiento DNS:** Configurar el registro `A` o `CNAME` en el panel de Cloudflare o DNS de `quality-consulting.org` hacia la dirección IP del servidor Apache/cPanel asignado.
2. **Estructura de Directorios en cPanel:**
   - La carpeta `private_app/` debe ubicarse en la raíz del usuario cPanel (`/home/usuario/private_app/`), fuera de `public_html/`.
   - La carpeta `public_html/` del repositorio debe desplegarse en el DocumentRoot público (`/home/usuario/public_html/`).
3. **Credenciales en `private_app/env.php`:**
   - Credenciales SMTP activas (`SMTP_HOST`, `SMTP_PORT=465`, `SMTP_USER`, `SMTP_PASSWORD`).
   - Credenciales de PayPal en modo producción (`PAYPAL_MODE=live`, `PAYPAL_CLIENT_ID`, `PAYPAL_CLIENT_SECRET`).
   - Receptor oficial: `PAYPAL_RECEIVER_EMAIL=comercial@quality-consulting.org` y `OMAR_SAMANIEGO_EMAIL=comercial@quality-consulting.org`.
4. **Tarea Cron en cPanel:** Configurar la ejecución periódica cada 15 minutos:
   ```bash
   /usr/local/bin/php /home/usuario/private_app/backend/cron/process-fallback-queue.php >/dev/null 2>&1
   ```

---

## 9. Arquitectura Oficial PayPal Checkout (Orders v2 vs PayPal.Me)

### 9.1 Incompatibilidad Técnica de PayPal.Me con la API REST
- Los enlaces o códigos de transacción generados mediante transferencias personales `PayPal.Me` corresponden a identificadores de billetera P2P.
- **La API REST oficial de PayPal (`/v2/checkout/orders/{id}`) NO permite consultar, validar ni capturar transacciones de PayPal.Me**; responderá invariablemente con HTTP `404 Resource Not Found`.
- Para una integración automatizada y segura en el backend, es imprescindible utilizar el estándar **PayPal Checkout Orders v2**.

### 9.2 Implementación Oficial PayPal Orders v2 (Client + Server)
1. **Inicialización dinámica en cliente (`registro-primera-clase.php`):**
   - El cliente consulta `GET /api/paypal/config` (con cabeceras CORS y credenciales).
   - Si la pasarela está configurada, inyecta dinámicamente el SDK oficial:
     `https://www.paypal.com/sdk/js?client-id={client_id}&currency=USD&locale=es_PE`
   - Si no está configurada (o en GitHub Pages estático sin `QCS_API_BASE_URL`), muestra limpiamente el bloque `#paypalUnconfiguredNotice` con botones directos de contacto a `comercial@quality-consulting.org` y WhatsApp institucional.
2. **Creación de Orden Server-to-Server (`POST /api/paypal/create-order`):**
   - El backend invoca `POST https://api-m.paypal.com/v2/checkout/orders` (o `api-m.sandbox.paypal.com`).
   - Bloquea el importe estricto a **`USD 10.00`** con `intent: CAPTURE`.
   - Vincula metadatos inviolables: `custom_id = FIRST_CLASS_{curso_slug}`, `reference_id = {curso_slug}` y descripción de primera clase.
3. **Captura Server-to-Server (`POST /api/paypal/capture-order`):**
   - El cliente aprueba en la ventana emergente de PayPal y envía el `orderID` al backend.
   - El backend captura los fondos mediante `POST /v2/checkout/orders/{order_id}/capture`.
   - Extrae tanto el **`order_id`** como el **`capture_id`** individual de la transacción.
   - Valida que el receptor coincida con `comercial@quality-consulting.org` (en modo producción) o el vendedor asignado en sandbox.
   - Genera una firma criptográfica de sesión (`HMAC-SHA256`) ligando la orden, captura, monto y slug del curso.
   - Desbloquea los campos del formulario del Paso 2 en el navegador.

### 9.3 Protección Atómica contra Concurrencia (Mutex Locking)
Para evitar condiciones de carrera donde dos envíos simultáneos del formulario utilicen la misma orden de PayPal:
1. `FallbackQueue::acquireTransactionLock(string $orderId): bool` implementa un candado atómico a nivel del sistema de archivos utilizando `fopen($lockFile, 'x')`.
2. Si dos peticiones intentan procesar la misma transacción en el mismo milisegundo, la segunda falla inmediatamente con código `409 Conflict`.
3. Cuenta con liberación automática ante bloqueos huérfanos con expiración configurable (45 segundos).
4. El bloqueo se libera en el bloque `finally` tras la persistencia exitosa.

### 9.4 Protección contra Reutilización de Transacciones (Anti-Reuse)
- `PayPalService::isTransactionAlreadyUsed(string $id): bool` verifica tanto el `order_id` como el `capture_id`.
- Busca en la base de datos MySQL (si está activa) y en todos los registros persistidos en `private_app/backend/storage/queue/`.
- Cualquier intento posterior de reutilizar un código de pago genera un rechazo inmediato.

---

## 10. Persistencia, Notificaciones y Transparencia en la Entrega

### 10.1 Registro Garantizado de 8 Campos Obligatorios
El registro se guarda atómicamente en disco en `private_app/backend/storage/queue/` con los 8 datos obligatorios antes de reportar éxito al usuario:
1. `nombres`: Nombres y apellidos completos del participante.
2. `email`: Correo electrónico verificado del participante.
3. `telefono`: Número de teléfono / WhatsApp con código de país.
4. `curso_slug` / `curso_titulo`: Slug y título oficial del curso seleccionado.
5. `concepto`: *«Primera clase del curso (no incluye el curso completo)»*.
6. `paypal_order_id`: Identificador de la orden de PayPal Orders v2.
7. `paypal_capture_id`: Identificador de captura de fondos en PayPal.
8. `monto` / `moneda`: `10.00 USD`.

### 10.2 Transparencia en el Estado de los Correos (No Declarar Entrega Falsa)
- Si el servidor SMTP acepta el mensaje (código `250 OK`), el registro se marca como `mail_status = 'aceptado_por_servidor_smtp'`.
- La aceptación por el servidor SMTP confirma que el servidor de salida admitió el mensaje para su transporte, no garantiza la recepción en la bandeja de entrada del usuario (la cual depende de filtros antispam del destinatario).
- Si la conexión SMTP no está disponible o falla, el registro se marca como `mail_status = 'pendiente_en_cola'`.
- El cron worker `private_app/backend/cron/process-fallback-queue.php` reintenta automáticamente el envío de correos pendientes sin duplicar aquellos ya aceptados.

### 10.3 Destinatario Oficial Confirmado
- Tanto la cuenta receptora de PayPal como el destinatario de notificaciones de coordinación comercial corresponden a:
  `comercial@quality-consulting.org` (Ing. Omar Samaniego).

---

## 11. Procedimiento de Verificación Local y Compilación

1. **Ejecución de la suite completa de pruebas automáticas (16 pruebas):**
   ```powershell
   & "C:\xampp\php\php.exe" tests/PaymentFlowTest.php
   ```
2. **Ejecución del cron worker de contingencia (Dry run):**
   ```powershell
   & "C:\xampp\php\php.exe" private_app/backend/cron/process-fallback-queue.php
   ```
3. **Compilación del sitio estático:**
   ```powershell
   & "C:\xampp\php\php.exe" build_static.php
   ```
4. **Verificación de seguridad en despliegue estático:**
   - Cero archivos PDF en `public_html/` y `_site/`:
     ```powershell
     Get-ChildItem -Path public_html, _site -Recurse -Filter "*.pdf"
     ```
   - Credenciales sensibles excluidas del control de versiones.

