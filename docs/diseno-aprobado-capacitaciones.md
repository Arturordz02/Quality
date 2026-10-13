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

    // 5. Beneficios y materiales + PDU + Brochure integrado
    'benefits'             => [
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'Bolsa laboral',
            'text'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions.',
        ],
    ],
    'pdu_title'            => 'Unidades de desarrollo profesional (16 PDU)', // Dinámico según cada brochure (ej. 'Unidades de desarrollo profesional (6 PDU)'). Dejar en '' si no otorga PDU.
    'pdu_text'             => 'Explicación oficial del brochure sobre las PDU (dejar en "" si el curso no otorga PDU).',
    'brochure_url'         => 'brochures/calidad/archivo-del-brochure.pdf',
    'brochure_download'    => 'Nombre-Descarga-Amigable.pdf',
    'brochure_thumb'       => 'img/brochures/portada-real-extraida-del-pdf.png',

    // 6. Información e inscripción
    'enroll_bg_image'      => 'img/ISO1.webp', // Opcional: imagen temática para el lado izquierdo del panel oscuro ('' usa solo el degradado)
    'whatsapp_url'         => 'https://api.whatsapp.com/send?phone=51993463118&text=...',
    'modal_service'        => 'Nombre del curso para el modal #modalSolicitarInfo',
    'paypal_slug'          => 'slug-del-curso',

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
  - Se renderiza únicamente cuando `$course['pdu_text']` o `$course['pdu_title']` tiene contenido. Si el curso no otorga PDU, el bloque completo no se muestra.
  - Título dinámico configurado en `$course['pdu_title']` (por ejemplo: **«Unidades de desarrollo profesional (16 PDU)»** o **«Unidades de desarrollo profesional (6 PDU)»** según cada brochure; nunca presentarlo como «Acreditación institucional PMI»).
  - Conserva la explicación completa del brochure sobre categoría CCR y horas netas en `$course['pdu_text']`.
- **Tarjeta de Brochure Integrada (`.qcs-cd-brochure-integrated-card`, `#brochure-curso`):**
  - Ubicada dentro del bloque marfil, inmediatamente debajo de la franja de PDU. Es el **único** bloque de brochure en toda la página.
  - Muestra la **miniatura real de la primera página del PDF** (`.qcs-cd-brochure-thumb-img`, proporción `893 / 1148`, carga inmediata sin `loading="lazy"`), textos **«Consulta el brochure»**, *«Revisa el programa completo del curso.»*, nota *«Consulta la disponibilidad y las condiciones actuales.»*, y los botones **«Ver PDF»** (`target="_blank"`) y **«Descargar PDF»** (`download`).

### 5.5 Información e Inscripción (`#informacion-inscripcion`)
- Panel oscuro amplio con bordes redondeados y degradado carbón/dorado (`.qcs-cd-enroll-panel`).
- Si el curso define `'enroll_bg_image'`, la clase `.qcs-cd-enroll-panel--has-bg` proyecta esa imagen temática en la mitad izquierda con superposición oscura gradual para garantizar el contraste del texto blanco. Si no existe una imagen adecuada para el curso, se deja `''` y el panel muestra el degradado institucional sin repetir fotos de otros cursos ni inventar fondos.
- **Columna izquierda:** Píldora `CAPACITACIÓN ESPECIALIZADA`, título blanco **«Información e inscripción»**, texto de orientación y línea de acento dorada.
- **Columna derecha:**
  1. Botón principal dorado **«Solicitar información»** (abre `#modalSolicitarInfo` con `data-service`).
  2. Botón secundario **«Consultar por WhatsApp»** con borde claro e ícono verde de WhatsApp.
  3. Subbloque diferenciado (`.qcs-cd-first-class-box`) con etiqueta `PRIMERA CLASE`, precio `US$ 10`, botón azul PayPal **«Pagar primera clase»** (`/pagar-primera-clase?curso=...`) y condición explícita:
     > *«US$10 únicamente por la primera clase. No incluye el curso completo.»*
- **Debajo del panel (fuera de la tarjeta oscura):** Enlaces discretos centrados **«Volver al Área de Calidad»** (`/capacitacion-calidad`) y **«Ver catálogo general»** (`/capacitacion`).

### 5.6 Sección Opcional de Videos (`#videos-curso`)
- Solo se renderiza si `!empty($course['videos'])`.
- Presenta las conferencias de YouTube en tarjetas `.qcs-iso-video-card` con cabecera oscura `.qcs-iso-video-header`, contenedor `.ratio.ratio-16x9` y pie descriptivo `.qcs-iso-video-caption`.

---

## 6. Inventario de Recursos del Bloque 1 (Calidad)

| Curso | Ruta de Detalle | PDF Oficial (`public_html/`) | Miniatura Portada Real (`public_html/`) | Imagen de Tarjeta en Catálogo (`public_html/`) |
| :--- | :--- | :--- | :--- | :--- |
| **Gerencia de la Calidad en la Construcción** | `/gerencia-de-calidad` | `brochures/calidad/gerencia-de-la-calidad-en-la-construccion.pdf` | `img/brochures/portada-gerencia-de-la-calidad.png` | `img/capacitaciones/gerencia-de-la-calidad-construccion.webp` (`.png`) |
| **ISO 9001 para la Construcción usando IA** | `/iso-9001` | `brochures/calidad/iso-9001-para-la-construccion-usando-ia.pdf` | `img/brochures/portada-iso-9001-construccion-ia.png` | `img/capacitaciones/iso-9001-construccion-usando-ia.webp` (`.png`) |
| **Control de Calidad en Tunelería** | `/control-de-calidad-en-tuneleria` | `brochures/calidad/control-de-calidad-en-tuneleria.pdf` | `img/brochures/portada-control-calidad-tuneleria.png` | `img/capacitaciones/control-de-calidad-en-tuneleria.webp` (`.png`) |

---

## 7. Procedimiento de Respaldo, Compilación Estática y Verificación

1. **Respaldo previo obligatorio:**
   - Antes de editar cualquier archivo, crear una carpeta con fecha en `respaldos/AAAA-MM-DD_nombre-descriptivo/` (fuera de `public_html/` y `_site/`).
   - Copiar los archivos originales respetando sus rutas relativas e incluir un `README.md` con los comandos PowerShell de restauración.
2. **Extracción de miniatura real de portada PDF:**
   - Renderizar la página 1 del archivo PDF oficial a PNG en `public_html/img/brochures/` conservando su proporción original (usando `pdf.js` en navegador headless). Nunca usar portadas ilustrativas o genéricas.
3. **Generación estática (`_site/`):**
   - Ejecutar desde la raíz del proyecto:
     ```powershell
     & "C:\xampp\php\php.exe" build_static.php
     ```
   - `build_static.php` copia los recursos de `public_html/` y compila todas las rutas MVC a archivos `.html` en `_site/`.
4. **Verificación multi-dispositivo:**
   - Comprobar en `1440px`, `768px`, `390px` y `360px` mediante emulación de métricas de dispositivo (CDP `Emulation.setDeviceMetricsOverride`) que `document.documentElement.scrollWidth <= document.documentElement.clientWidth` y que ningún elemento exceda `window.innerWidth`.

---

## 8. Lista de Comprobación (Checklist) para Integrar Futuros Brochures

- [ ] **1. Respaldo:** Crear carpeta `respaldos/AAAA-MM-DD_descripcion/` con copia de los archivos a modificar y su `README.md`.
- [ ] **2. Archivo PDF intacto:** Copiar el PDF original sin alterarlo a `public_html/brochures/<area>/nombre-limpio-sin-espacios.pdf`.
- [ ] **3. Portada real en miniatura:** Extraer la primera página real del PDF a `public_html/img/brochures/portada-<slug>.png` manteniendo su relación de aspecto.
- [ ] **4. Extracción fiel de datos:** Revisar texto y páginas visuales del PDF para extraer título, resumen, objetivo, módulos del temario, perfil docente, beneficios y PDU sin inventar datos ni copiar fechas/precios de ediciones pasadas.
- [ ] **5. Vista del curso:** Configurar el arreglo `$course` en `private_app/app/Views/pages/<slug>.php` e invocar `$this->partial('course_detail_unified', ['course' => $course])`.
- [ ] **6. Ruta y controlador:** Verificar que la ruta esté registrada en `private_app/config/routes.php`, en `TrainingController.php`, en `build_static.php` y en el registro correspondiente de `CoursesCatalog.php`.
- [ ] **7. Compilación y pruebas:** Incrementar versión de `styles.css?v=...` si hubo ajustes CSS, ejecutar `build_static.php` y verificar visual y funcionalmente en `1440px`, `768px`, `390px` y `360px`.

