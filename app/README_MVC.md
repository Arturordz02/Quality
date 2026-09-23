# Documentación Técnica de la Arquitectura y Migración MVC
## Quality Consulting Solutions

Este documento técnico describe en detalle la arquitectura **Modelo - Vista - Controlador (MVC)** implementada en el proyecto, documentando su diseño, funcionamiento interno, inventario completo de componentes, compatibilidad con la infraestructura preexistente (conservando intactos los **45 archivos HTML originales** y sus servicios), reglas de enrutamiento y directrices para su mantenimiento y despliegue en producción.

---

## 1. Filosofía y Principios de Diseño

1. **Migración Gradual y No Disruptiva**: El sistema existente continúa operando con normalidad. Ninguna ruta pública, archivo HTML físico ni endpoint preexistente del backend ha sido eliminado o alterado.
2. **Separación de Responsabilidades (SoC)**:
   - **Controlador (`app/Controllers/`)**: Orquesta el flujo de las peticiones HTTP, sanitiza entradas y delega hacia vistas o modelos (**4 controladores**).
   - **Modelo (`app/Models/` y `app/Core/Model.php`)**: Encapsula la persistencia, interacción con bases de datos MySQL mediante PDO y reglas de datos.
   - **Vista (`app/Views/`)**: Renderiza exclusivamente marcado HTML5 semántico y accesible, reutilizando componentes mediante layouts maestros y parciales modulares (**37 vistas PHP individuales**).
3. **Cero Dependencias Externas (Zero-Dependencies Core)**: El núcleo MVC funciona de forma nativa sobre PHP 8.0+ utilizando un autocargador PSR-4 propio (`App\Core\Autoloader`), prescindiendo de Composer u otras dependencias externas para su ejecución base.
4. **Reutilización de Infraestructura Existente**: Aprovecha la configuración de variables de entorno en `.env`, el gestor de errores y logging de `backend/core/ErrorHandler.php`, y las capas de resiliencia (Rate Limiting, Circuit Breaker y Cola Fallback).
5. **Optimización de Rendimiento y Assets Modernos**: Integración de imágenes en formato WebP con respaldo PNG mediante la etiqueta estándar `<picture>`, logrando reducciones de hasta un 97% en ancho de banda de imágenes sin pérdida de compatibilidad.

---

## 2. Estructura Final de Directorios

```text
Quality-main/
├── app/                                    # Arquitectura de la aplicación MVC (51 archivos PHP)
│   ├── Controllers/                        # 4 Controladores HTTP (Namespace App\Controllers)
│   │   ├── LegalController.php             # Normativas y términos legales
│   │   ├── PageController.php              # Páginas institucionales, formularios, test y error 404
│   │   ├── ServiceController.php           # Servicios de consultoría e ingeniería
│   │   └── TrainingController.php          # Catálogo general y cursos de capacitación
│   ├── Core/                               # 5 Clases fundacionales del framework MVC (Namespace App\Core)
│   │   ├── Autoloader.php                  # Autocargador PSR-4 nativo sin dependencias
│   │   ├── Controller.php                  # Clase base para controladores (render, json, getPost, isAjax)
│   │   ├── Model.php                       # Clase base para acceso a datos PDO con consultas preparadas
│   │   ├── Router.php                      # Enrutador HTTP (GET/POST, normalización de URIs y fallback 404)
│   │   └── View.php                        # Motor de renderizado con soporte para layouts, partials y escape XSS
│   ├── Models/                             # Entidades de dominio y acceso a datos
│   ├── Views/                              # Plantillas y capas de presentación (42 archivos PHP)
│   │   ├── layouts/
│   │   │   └── main.php                    # Layout maestro HTML5 (head, assets, scripts y contenedor)
│   │   ├── pages/                          # 37 Vistas PHP individuales (36 de contenido + 1 de error 404)
│   │   │   ├── 404.php                     # Página de error 404 personalizada
│   │   │   ├── bim-revit-architecture.php  # Curso BIM Revit Architecture
│   │   │   ├── calidad-y-pmi.php           # Curso Calidad con Enfoque PMI
│   │   │   ├── capacitacion.php            # Hub principal de Capacitación
│   │   │   ├── clientes.php                # Página institucional de Clientes
│   │   │   ├── consultoria.php             # Hub principal de Consultoría Técnica
│   │   │   ├── contacto.php                # Formulario corporativo de Contacto
│   │   │   ├── contratos-estado.php        # Curso Adicionales y Ampliaciones con el Estado
│   │   │   ├── contratos.php               # Curso Gestión Contractual en Construcción
│   │   │   ├── costos.php                  # Curso Control de Costos en Obras
│   │   │   ├── cronograma-forense.php      # Servicio de Análisis Forense de Cronogramas
│   │   │   ├── evaluacion-habilidades.php  # Test interactivo de competencias blandas
│   │   │   ├── fidic.php                   # Curso Contratos Internacionales FIDIC
│   │   │   ├── gerencia-de-calidad.php     # Curso Gerencia de Calidad para Infraestructura
│   │   │   ├── gestion-de-la-calidad.php   # Servicio de Gestión de Calidad en Obra
│   │   │   ├── gestion-de-pmo.php          # Servicio de Estructuración y Gestión de PMO
│   │   │   ├── gestion-de-riesgos.php      # Servicio de Gestión Integral de Riesgos
│   │   │   ├── gruas-torre.php             # Curso Planificación con Grúas Torre
│   │   │   ├── headhunting.php             # Servicio de Headhunting Especializado
│   │   │   ├── herramientas.php            # Curso Herramientas de Calidad
│   │   │   ├── homologaciones.php          # Servicio de Preparación para Homologaciones
│   │   │   ├── iso-9001.php                # Curso Norma ISO 9001:2015 en Construcción
│   │   │   ├── lean-last-planner.php       # Curso Lean Construction y Last Planner
│   │   │   ├── lego-serious-play.php       # Curso Metodología LEGO® SERIOUS PLAY®
│   │   │   ├── libro-de-reclamaciones.php  # Formulario del Libro de Reclamaciones
│   │   │   ├── nec.php                     # Curso Contratos Colaborativos NEC3/NEC4
│   │   │   ├── nosotros.php                # Página institucional Nosotros
│   │   │   ├── oficina-tecnica.php         # Servicio de Gestión de Oficina Técnica
│   │   │   ├── permisologia.php            # Servicio de Gestión de Permisos y Licencias
│   │   │   ├── proyectos-pmi.php           # Curso Gestión de Proyectos bajo Enfoque PMI
│   │   │   ├── riesgo-del-plazo.php        # Curso Taller Riesgo del Plazo (Síndrome del 90%)
│   │   │   ├── riesgos-cadena-produccion.php # Curso Riesgos en la Cadena de Producción
│   │   │   ├── riesgos-pmi.php             # Curso Gestión de Riesgos con Enfoque PMI
│   │   │   ├── riesgos-tecnicos.php        # Curso Riesgos Técnicos en Construcción
│   │   │   ├── terminos-y-condiciones.php  # Términos y Condiciones Legales
│   │   │   ├── universidad-corporativa.php # Programa de Formación In-Company
│   │   │   └── valor-ganado.php            # Curso Control con Método del Valor Ganado (EVM)
│   │   └── partials/                       # 4 Componentes reutilizables compartidos
│   │       ├── footer.php                  # Pie de página corporativo con enlaces y redes
│   │       ├── header.php                  # Barra superior de marca e información
│   │       ├── navbar.php                  # Menú responsive con navegación limpia MVC
│   │       └── whatsapp_float.php          # Widget flotante interactivo de WhatsApp
│   └── README_MVC.md                       # Este documento técnico oficial
├── config/                                 # Ajustes y configuración del entorno MVC (2 archivos PHP)
│   ├── app.php                             # Puente unificado con backend/config.php y autoloader
│   └── routes.php                          # Tabla centralizada de 39 rutas HTTP registradas
├── public/                                 # Punto de entrada HTTP del entorno MVC (1 archivo PHP)
│   ├── .gitkeep
│   └── index.php                           # Front Controller principal
├── backend/                                # Servicios preexistentes y APIs de negocio (100% intactos)
│   ├── api/                                # Endpoints REST/JSON (ej. soft-skills.php)
│   ├── config/                             # Ajustes de base de datos, SMTP y seguridad
│   ├── core/                               # Manejador de errores, Rate Limiting, Circuit Breaker
│   ├── tests/                              # Suite de pruebas automatizadas (run_tests.php)
│   ├── send-contact.php                    # Endpoint legacy de procesamiento de contacto
│   └── submit-claim.php                    # Endpoint legacy de recepción de reclamaciones
├── css/                                    # Hojas de estilo globales (styles.css, plugins)
├── js/                                     # Scripts de comportamiento client-side (script.js)
├── img/                                    # Recursos gráficos en formatos PNG y WebP
├── .htaccess                               # Reglas de Apache, seguridad, compresión, 301 y MVC
├── index.html                              # Portada principal institucional (activo temporalmente)
└── *.html                                  # 45 archivos HTML originales (preservados al 100%)
```

---

## 3. Controladores y Vistas Creadas

Se implementaron **4 controladores modulares** que heredan de `App\Core\Controller`, los cuales gestionan un total de **37 vistas PHP individuales** ubicadas en `app/Views/pages/`:

### Resumen Numérico por Categoría:
- **Páginas Institucionales y de Sistema**: **4 vistas** (`nosotros.php`, `clientes.php`, `terminos-y-condiciones.php`, `404.php`).
- **Servicios y Consultoría Técnica**: **9 vistas** (hub `consultoria.php` + 8 servicios especializados).
- **Capacitación y Programas**: **21 vistas** (hub `capacitacion.php` + 20 cursos especializados).
- **Páginas con Formularios e Interacción**: **3 vistas** (`contacto.php`, `libro-de-reclamaciones.php`, `evaluacion-habilidades.php`).
- **Total de Vistas PHP en `app/Views/pages/`**: **37 vistas**.

---

### 3.1 `LegalController` (`app/Controllers/LegalController.php`) - 1 Método / 1 Vista
- **`terminos()`**: Renderiza `pages/terminos-y-condiciones.php` configurando los metadatos SEO (`title`, `metaDescription`, `canonicalUrl`) y habilitando el marcado semántico de protección legal al consumidor.

### 3.2 `PageController` (`app/Controllers/PageController.php`) - 6 Métodos / 6 Vistas
- **`nosotros()`**: Renderiza `pages/nosotros.php` (misión, visión, pilares estratégicos, métricas históricas y perfil directivo).
- **`clientes()`**: Renderiza `pages/clientes.php` (panel de marcas corporativas, testimonios y matriz de 10 soluciones de ingeniería).
- **`contacto()`**: Renderiza `pages/contacto.php` (formulario corporativo de contacto con validación en cliente, honeypot y enlace al endpoint `/backend/send-contact.php`).
- **`libroDeReclamaciones()`**: Renderiza `pages/libro-de-reclamaciones.php` (formulario oficial conforme a la Ley N° 29571 con enlace a `/backend/submit-claim.php`).
- **`evaluacionHabilidades()`**: Renderiza `pages/evaluacion-habilidades.php` (evaluación psicométrica situacional en 4 dimensiones conectada a `/backend/api/soft-skills.php`).
- **`notFound()`**: Renderiza `pages/404.php` emitiendo cabecera HTTP 404, metadato `robots: noindex, follow` e interfaz de navegación asistida.

### 3.3 `ServiceController` (`app/Controllers/ServiceController.php`) - 9 Métodos / 9 Vistas
- Gestiona el catálogo de consultoría e ingeniería técnica especializada:
  1. `consultoria()` → `pages/consultoria.php` (Hub general de consultoría técnica y diagnóstico)
  2. `gestionCalidad()` → `pages/gestion-de-la-calidad.php` (Planes de inspección, control y aseguramiento PIE)
  3. `gestionPmo()` → `pages/gestion-de-pmo.php` (Estructuración y gobernanza de PMO bajo estándares PMI)
  4. `gestionRiesgos()` → `pages/gestion-de-riesgos.php` (Análisis probabilístico cuantitativo y cualitativo de riesgos)
  5. `cronogramaForense()` → `pages/cronograma-forense.php` (Metodología Collapse As-Built y análisis CPM)
  6. `homologaciones()` → `pages/homologaciones.php` (Auditorías técnicas y preparación para homologación)
  7. `headhunting()` → `pages/headhunting.php` (Atracción y selección de talento especializado en construcción)
  8. `oficinaTecnica()` → `pages/oficina-tecnica.php` (Administración técnica, valorizaciones y control de proyectos)
  9. `permisologia()` → `pages/permisologia.php` (Licencias de edificación, habilitaciones urbanas y saneamiento)

### 3.4 `TrainingController` (`app/Controllers/TrainingController.php`) - 21 Métodos / 21 Vistas
- Gestiona el hub general y los 20 cursos y programas de formación técnica:
  1. `capacitacion()` → `pages/capacitacion.php` (Hub interactivo con 12 áreas principales de especialización)
  2. `bimRevitArchitecture()` → `pages/bim-revit-architecture.php`
  3. `calidadPmi()` → `pages/calidad-y-pmi.php`
  4. `contratos()` → `pages/contratos.php`
  5. `contratosEstado()` → `pages/contratos-estado.php`
  6. `costos()` → `pages/costos.php`
  7. `fidic()` → `pages/fidic.php`
  8. `gerenciaCalidad()` → `pages/gerencia-de-calidad.php`
  9. `gruasTorre()` → `pages/gruas-torre.php`
  10. `herramientas()` → `pages/herramientas.php`
  11. `iso9001()` → `pages/iso-9001.php`
  12. `leanLastPlanner()` → `pages/lean-last-planner.php`
  13. `legoSeriousPlay()` → `pages/lego-serious-play.php`
  14. `nec()` → `pages/nec.php`
  15. `proyectosPmi()` → `pages/proyectos-pmi.php`
  16. `riesgoDelPlazo()` → `pages/riesgo-del-plazo.php`
  17. `riesgosCadenaProduccion()` → `pages/riesgos-cadena-produccion.php`
  18. `riesgosPmi()` → `pages/riesgos-pmi.php`
  19. `riesgosTecnicos()` → `pages/riesgos-tecnicos.php`
  20. `universidadCorporativa()` → `pages/universidad-corporativa.php`
  21. `valorGanado()` → `pages/valor-ganado.php`

---

## 4. Rutas MVC Disponibles

En [`config/routes.php`](config/routes.php) se encuentran registradas un total de **39 rutas HTTP (método GET)**:
- **37 rutas de páginas y vistas** (36 páginas de contenido migrado + 1 página de error 404).
- **2 rutas del sistema** (diagnóstico `/mvc-health` e informativa `/`).

| N° | Ruta Limpia MVC | Método | Controlador y Acción | Categoría |
|:---:|:---|:---:|:---|:---|
| 1 | `/mvc-health` | GET | `Closure (Diagnóstico JSON)` | Monitoreo del Framework |
| 2 | `/` | GET | `Closure (Info Front Controller)` | Raíz MVC informativa |
| 3 | `/terminos-y-condiciones` | GET | `LegalController::terminos` | Legal e Institucional |
| 4 | `/nosotros` | GET | `PageController::nosotros` | Institucional |
| 5 | `/clientes` | GET | `PageController::clientes` | Institucional |
| 6 | `/contacto` | GET | `PageController::contacto` | Formulario e Interacción |
| 7 | `/libro-de-reclamaciones` | GET | `PageController::libroDeReclamaciones` | Formulario e Interacción |
| 8 | `/evaluacion-habilidades` | GET | `PageController::evaluacionHabilidades` | Evaluación Psicométrica |
| 9 | `/404` | GET | `PageController::notFound` | Manejador de Error 404 |
| 10 | `/consultoria` | GET | `ServiceController::consultoria` | Servicios (Hub General) |
| 11 | `/gestion-de-la-calidad` | GET | `ServiceController::gestionCalidad` | Servicios / Consultoría |
| 12 | `/gestion-de-pmo` | GET | `ServiceController::gestionPmo` | Servicios / Consultoría |
| 13 | `/gestion-de-riesgos` | GET | `ServiceController::gestionRiesgos` | Servicios / Consultoría |
| 14 | `/cronograma-forense` | GET | `ServiceController::cronogramaForense` | Servicios / Consultoría |
| 15 | `/homologaciones` | GET | `ServiceController::homologaciones` | Servicios / Consultoría |
| 16 | `/headhunting` | GET | `ServiceController::headhunting` | Servicios / Consultoría |
| 17 | `/oficina-tecnica` | GET | `ServiceController::oficinaTecnica` | Servicios / Consultoría |
| 18 | `/permisologia` | GET | `ServiceController::permisologia` | Servicios / Consultoría |
| 19 | `/capacitacion` | GET | `TrainingController::capacitacion` | Capacitación (Hub General) |
| 20 | `/bim-revit-architecture` | GET | `TrainingController::bimRevitArchitecture` | Capacitación (Curso) |
| 21 | `/calidad-y-pmi` | GET | `TrainingController::calidadPmi` | Capacitación (Curso) |
| 22 | `/contratos` | GET | `TrainingController::contratos` | Capacitación (Curso) |
| 23 | `/contratos-estado` | GET | `TrainingController::contratosEstado` | Capacitación (Curso) |
| 24 | `/costos` | GET | `TrainingController::costos` | Capacitación (Curso) |
| 25 | `/fidic` | GET | `TrainingController::fidic` | Capacitación (Curso) |
| 26 | `/gerencia-de-calidad` | GET | `TrainingController::gerenciaCalidad` | Capacitación (Curso) |
| 27 | `/gruas-torre` | GET | `TrainingController::gruasTorre` | Capacitación (Curso) |
| 28 | `/herramientas` | GET | `TrainingController::herramientas` | Capacitación (Curso) |
| 29 | `/iso-9001` | GET | `TrainingController::iso9001` | Capacitación (Curso) |
| 30 | `/lean-last-planner` | GET | `TrainingController::leanLastPlanner` | Capacitación (Curso) |
| 31 | `/lego-serious-play` | GET | `TrainingController::legoSeriousPlay` | Capacitación (Curso) |
| 32 | `/nec` | GET | `TrainingController::nec` | Capacitación (Curso) |
| 33 | `/proyectos-pmi` | GET | `TrainingController::proyectosPmi` | Capacitación (Curso) |
| 34 | `/riesgo-del-plazo` | GET | `TrainingController::riesgoDelPlazo` | Capacitación (Curso) |
| 35 | `/riesgos-cadena-produccion` | GET | `TrainingController::riesgosCadenaProduccion` | Capacitación (Curso) |
| 36 | `/riesgos-pmi` | GET | `TrainingController::riesgosPmi` | Capacitación (Curso) |
| 37 | `/riesgos-tecnicos` | GET | `TrainingController::riesgosTecnicos` | Capacitación (Curso) |
| 38 | `/universidad-corporativa` | GET | `TrainingController::universidadCorporativa` | Capacitación (Curso) |
| 39 | `/valor-ganado` | GET | `TrainingController::valorGanado` | Capacitación (Curso) |

*Cualquier URI que no coincida con estas rutas es capturada automáticamente por el manejador global de error 404 (`PageController::notFound`).*

---

## 5. Funcionamiento del Front Controller

El ciclo de vida de una petición HTTP en la arquitectura MVC sigue un flujo unificado y predecible:

```
[Petición del Cliente] 
       │
       ▼
[Apache .htaccess] ─── (¿Es archivo/directorio físico, asset estático o backend/?) ──► [Servir Directo]
       │ (No, es URL limpia MVC)
       ▼
[public/index.php] (Front Controller)
       │
       ├─► Carga config/app.php (Registra Autoloader PSR-4 para namespace App\)
       ├─► Instancia App\Core\Router
       ├─► Carga config/routes.php (Registra la tabla de 39 rutas)
       └─► Ejecuta $router->dispatch()
                 │
                 ├─► Normaliza REQUEST_URI (elimina query string y trailing slashes)
                 ├─► Busca coincidencia en la tabla de rutas (Método + URI)
                 │
                 ├─► [Coincidencia Encontrada]
                 │        │
                 │        ▼
                 │   Instancia Controlador correspondiente (1 de los 4 controladores)
                 │   Ejecuta Acción solicitada
                 │        │
                 │        ▼
                 │   App\Core\View::render()
                 │        ├─ Carga app/Views/pages/[vista].php (1 de las 37 vistas)
                 │        ├─ Inyecta componentes app/Views/partials/ (header, navbar, footer, whatsapp)
                 │        └─ Envuelve dentro de app/Views/layouts/main.php
                 │        │
                 │        ▼
                 │   Emite HTML al navegador (HTTP 200 OK)
                 │
                 └─► [Sin Coincidencia]
                          │
                          ▼
                     Ejecuta $notFoundHandler -> PageController::notFound()
                     Emite app/Views/pages/404.php con cabecera HTTP 404 Not Found
```

### Características Principales de las Clases del Núcleo:
- **`App\Core\Autoloader`**: Mapea automáticamente prefijos de espacio de nombres `App\` al directorio físico `app/`. Detecta clases en subdirectorios sin necesidad de generar mapas de clases estáticos.
- **`App\Core\Router`**: Soporta rutas parametrizadas, closures y arreglos de controlador `[Clase::class, 'metodo']`. Normaliza la URL solicitada descartando query strings y barras redundantes.
- **`App\Core\View`**: Implementa aislamiento de ámbito para variables locales (`extract($data, EXTR_SKIP)`), buffering de salida mediante `ob_start()` / `ob_get_clean()` y función de sanitización estricta para mitigar ataques XSS (`View::e()`).

---

## 6. Compatibilidad con URLs `.html` y Redirecciones 301

Para preservar el posicionamiento orgánico en motores de búsqueda (SEO) y garantizar que ningún enlace externo antiguo o marcador quede roto, se configuró una regla de normalización canónica:

### Comportamiento:
1. **Detección vía `%{THE_REQUEST}`**: En lugar de evaluar `REQUEST_URI` (que puede alterarse en reescrituras internas de Apache), se examina la cabecera original enviada por el navegador:
   ```apache
   RewriteCond %{THE_REQUEST} \.html[\s?] [NC]
   RewriteCond %{REQUEST_URI} !index\.html$ [NC]
   RewriteRule ^(bim-revit-architecture|calidad-y-pmi|capacitacion|...|valor-ganado)\.html$ /$1 [R=301,L,QSA]
   ```
2. **Respuesta HTTP 301 (Moved Permanently)**: Los buscadores indexan de inmediato la URL limpia (ej. `/contacto`) y transfieren todo el valor de enlace (Link Juice) a través de las **36 rutas de contenido** migradas.
3. **Prevención de Bucles Infinitos**: Dado que la redirección 301 solo se dispara ante peticiones externas directas conteniendo la extensión `.html`, cuando Apache posteriormente reescribe internamente `/contacto` hacia `public/index.php`, no se produce ningún ciclo de reescritura.
4. **Excepción Explícita de `index.html`**: La raíz `/` y el archivo `index.html` están exentos de la redirección 301 en esta etapa para garantizar la máxima estabilidad del home institucional preexistente.

---

## 7. Formularios y Endpoints Conservados

Los formularios del sistema fueron migrados a las vistas MVC conservando íntegramente sus contratos de interfaz, nombres de campos, llamadas AJAX y endpoints en el backend:

### 7.1 Formulario de Contacto Corporativo (`/contacto`)
- **Vista**: `app/Views/pages/contacto.php`
- **Formulario**: `<form id="contactForm" action="/backend/send-contact.php" method="POST" novalidate>`
- **Campos**: `nombre`, `correo`, `telefono`, `tipo_documento`, `numero_documento`, `interes`, `mensaje`, `honeypot_hp` (campo oculto antispam).
- **Procesamiento**: Interceptado en cliente por `script.js`. Emite una petición `fetch()` asíncrona hacia `/backend/send-contact.php`.
- **Respuesta JSON**: Recibe `{ "status": "ok"|"error", "message": "...", "ticket_id": "..." }` y despliega alertas flotantes Bootstrap sin recargar la página.

### 7.2 Libro de Reclamaciones Oficial (`/libro-de-reclamaciones`)
- **Vista**: `app/Views/pages/libro-de-reclamaciones.php`
- **Formulario**: `<form id="claimForm" action="/backend/submit-claim.php" method="POST" novalidate>`
- **Campos**: Conforme al D.S. N° 011-2011-PCM (datos del consumidor, apoderado si es menor, bien contratado producto/servicio, detalle y pedido del reclamo/queja).
- **Procesamiento**: Interceptado por `script.js` con validaciones client-side. Envía datos a `/backend/submit-claim.php`.
- **Generación de Código**: Emite el correlativo legal de seguimiento (ej. `QCS-LR-202609-XXXXX`) notificando formalmente el plazo máximo legal de 15 días hábiles.

### 7.3 Evaluación de Competencias Blandas (`/evaluacion-habilidades`)
- **Vista**: `app/Views/pages/evaluacion-habilidades.php`
- **Endpoints**:
  - `GET /backend/api/soft-skills.php?action=questions`: Retorna en formato JSON las 8 preguntas situacionales y sus opciones ponderadas en las 4 dimensiones (Liderazgo, Comunicación, Manejo de Conflictos, Trabajo en Equipo).
  - `POST /backend/api/soft-skills.php?action=submit`: Envía las respuestas, calcula el perfil y retorna el resumen de fortalezas y gráfico radar SVG reactivo.

---

## 8. Reglas de Apache y `.htaccess`

La activación del enrutador MVC y la normalización SEO se encuentran concentradas en la **Sección 8** de `.htaccess`:

```apache
# ==============================================================================
# 8. ENRUTAMIENTO CONTROLADO AL FRONT CONTROLLER MVC Y NORMALIZACIÓN SEO
# Dirige peticiones hacia public/index.php y normaliza URLs .html migradas mediante 301.
# Preserva index.html, páginas .html no migradas, endpoints de backend y assets estáticos.
# ==============================================================================
DirectoryIndex index.html index.php

<IfModule mod_rewrite.c>
    RewriteEngine On

    # 8.1 Exclusión explícita: Backend, estilos, scripts, imágenes, fuentes y assets
    RewriteCond %{REQUEST_URI} ^/(backend|css|js|img|fonts|assets|vendor)/ [NC]
    RewriteRule ^ - [L]

    # 8.2 Normalización SEO 301: Redirigir URLs .html migradas hacia sus rutas limpias MVC
    # Detecta la solicitud original del cliente mediante THE_REQUEST para prevenir bucles de redirección.
    # Excluye index.html y se aplica únicamente a las 36 páginas migradas a la arquitectura MVC.
    RewriteCond %{THE_REQUEST} \.html[\s?] [NC]
    RewriteCond %{REQUEST_URI} !index\.html$ [NC]
    RewriteRule ^(bim-revit-architecture|calidad-y-pmi|capacitacion|clientes|consultoria|contacto|contratos-estado|contratos|costos|cronograma-forense|evaluacion-habilidades|fidic|gerencia-de-calidad|gestion-de-la-calidad|gestion-de-pmo|gestion-de-riesgos|gruas-torre|headhunting|herramientas|homologaciones|iso-9001|lean-last-planner|lego-serious-play|libro-de-reclamaciones|nec|nosotros|oficina-tecnica|permisologia|proyectos-pmi|riesgo-del-plazo|riesgos-cadena-produccion|riesgos-pmi|riesgos-tecnicos|terminos-y-condiciones|universidad-corporativa|valor-ganado)\.html$ /$1 [R=301,L,QSA]

    # 8.3 Preservar archivos y directorios físicos existentes (ej. index.html, páginas .html no migradas, styles.css)
    RewriteCond %{REQUEST_FILENAME} -f [OR]
    RewriteCond %{REQUEST_FILENAME} -d
    RewriteRule ^ - [L]

    # 8.4 Despachar URLs limpias hacia el Front Controller MVC
    RewriteRule ^(.*)$ public/index.php [QSA,L]
</IfModule>
```

---

## 9. Pruebas Realizadas y Resultados

Durante el proceso de verificación integral y auditoría se ejecutaron las siguientes suites de validación automatizada:

### 9.1 Verificación de Sintaxis PHP (`php -l`)
- **Alcance**: **51 archivos PHP** pertenecientes a `app/Controllers/` (4), `app/Core/` (5), `app/Views/layouts/` (1), `app/Views/partials/` (4), `app/Views/pages/` (37).
- **Resultado**: **100% Aprobado (0 errores de sintaxis)**.

### 9.2 Suite de Pruebas de Arquitectura y Resiliencia (`php backend/tests/run_tests.php`)
- **Pruebas ejecutadas**:
  1. *Circuit Breaker*: Estado CLOSED, transición a OPEN tras 3 fallas, ejecución inmediata de fallback y reset manual.
  2. *Rate Limiter*: Tolerancia de solicitudes permitidas y bloqueo estricto con código 429 tras exceder umbral.
  3. *Motor de Habilidades Blandas*: Carga de preguntas, cobertura de dimensiones, degradación agraciada (fallback queue) y cálculo de planes de acción.
  4. *Caché Multicapa*: Almacenamiento serializado, recuperación de estructuras complejas y clausuras *remember*.
  5. *Paginador Anti-DoS*: Limitador máximo de 50 registros, cálculo de offsets y metadatos de navegación.
  6. *Rotador y Compresor Gzip*: Detección, compresión e integridad de registros de logs.
- **Resultado**: **27 pruebas ejecutadas, 27 pasadas (100% OK)**.

### 9.3 Auditoría Visual y Funcional en Navegador Real (Chrome Headless vía CDP)
- **Entorno**: Resoluciones Desktop (1920×1080) y Mobile (375×812).
- **Resultados**:
  - **0 errores** en la consola de JavaScript (`console.error`).
  - **0 fallos de red** (cero códigos HTTP 404 en imágenes, CSS, fuentes o scripts).
  - **Cero desbordamiento horizontal** (`overflow-x: hidden`), garantizando diseño 100% responsive.
  - Botón flotante de WhatsApp verificado y plenamente operativo en todas las vistas.
  - Validación de envío y recepción de folios en el Formulario de Contacto y en el Libro de Reclamaciones.
  - Validación del flujo interactivo y registro de la Evaluación de Habilidades Blandas.
  - Verificación de la Redirección 301: `/contacto.html` redirige con HTTP 301 hacia `/contacto` resolviendo en HTTP 200.
  - Verificación de Error 404: Petición a `/ruta-inexistente-404` retorna código HTTP 404 con layout institucional.

### 9.4 Optimización de Peso y Transferencia de Datos (WebP)
- Reemplazo de imágenes PNG de alta resolución por versiones WebP optimizadas con respaldo PNG en `<picture>`:
  - Logotipo institucional (`img/Logo.png` → `Logo.webp`): **1.78 MB → 49 KB (-97.3%)**.
  - Catálogo de capacitación (`/capacitacion`, 12 tarjetas): **10.4 MB → 0.78 MB (-92.5%)**.
  - Logotipos de clientes (`img/ClientesQuality.png` → `ClientesQuality.webp`): **2.16 MB → 162 KB (-92.7%)**.
  - Páginas de consultoría y cursos técnicos: **Reducción promedio superior al 91%**.
- **Ahorro total estimado**: **Más de 25 MB de ahorro de ancho de banda** por sesión de navegación completa.

---

## 10. Archivos que Todavía Permanecen como HTML Estático

En el proyecto existen un total de **45 archivos HTML originales** en la raíz. De ellos, **8 archivos** permanecen operando como archivos HTML estáticos independientes (sin vista MVC asociada):

1. **`index.html`**: Portada y página principal del portal (se mantiene en la raíz hasta la fase final de consolidación).
2. **`press.html`**: Sala de prensa y comunicados de la empresa.
3. **`medios.html`**: Medios de comunicación y podcasts especializados.
4. **`pmo.html`**: Página histórica informativa sobre PMO.
5. **`investigacion.html`**: Publicaciones, artículos técnicos e investigación.
6. **`encuestas-proyectos.html`**: Instrumentos de recolección de proyectos.
7. **`noticias.html`**: Sección de noticias y novedades de ingeniería.
8. **`sindrome-del-90.html`**: Página estática alternativa sobre el síndrome del 90%.

*Los otros **37 archivos HTML** de la raíz (`nosotros.html`, `capacitacion.html`, `contacto.html`, `404.html`, etc.) cuentan ya con su correspondiente vista PHP migrada en `app/Views/pages/` y continúan existiendo físicamente en el repositorio para servir como respaldo absoluto e inalterable.*

---

## 11. Recomendaciones para Despliegue en Producción

Al momento de sincronizar estos cambios con el servidor web productivo (Apache / LiteSpeed en cPanel o VPS Linux), seguir estas pautas:

1. **Módulo `mod_rewrite`**:
   - Asegurarse de que `mod_rewrite` esté activo en Apache.
   - Verificar que la directiva `AllowOverride All` esté configurada en el bloque `<Directory>` correspondiente al DocumentRoot del VirtualHost.
2. **Versión de PHP y Extensiones Requeridas**:
   - PHP 8.0 o superior (recomendado PHP 8.1 o 8.2).
   - Extensiones necesarias: `pdo`, `pdo_mysql`, `mbstring`, `json`, `curl`, `zlib`.
3. **Permisos de Archivos y Carpetas en Linux/Unix**:
   - Directorios de lectura de código (`app/`, `config/`, `public/`): Permisos `755`.
   - Archivos de código (`.php`, `.css`, `.js`): Permisos `644`.
   - Directorios con permisos de escritura para el usuario del servidor web (`www-data` o usuario cPanel):
     - `backend/logs/` (para rotación de logs de auditoría y errores).
     - `backend/cache/` (para caché de consultas del Circuit Breaker y Rate Limiter).
4. **Archivo de Configuración `.env`**:
   - Mantener el archivo `.env` en la raíz con permisos restrictivos (`600` o `640`).
   - Confirmar que las reglas de protección de `.htaccess` sigan bloqueando cualquier acceso directo por HTTP a archivos que comiencen por punto (`^\.`).
5. **Ajuste para Instalaciones en Subdirectorios (si aplica)**:
   - Si el proyecto se publica en la raíz del dominio (`https://quality-consulting.org/`), no se requiere ningún cambio adicional.
   - Si se publica temporalmente en un subdirectorio (ej. `https://quality-consulting.org/nuevo/`), configurar en `.htaccess`:
     ```apache
     RewriteBase /nuevo/
     ```
     y en `config/app.php` actualizar `'base_url' => '/nuevo'`.

---

## 12. Procedimiento de Reversión Inmediata (Plan de Contingencia / Rollback)

En caso de requerir suspender el funcionamiento del enrutamiento MVC de manera inmediata sin afectar la continuidad operativa del portal:

### Paso 1: Desactivar el Enrutamiento MVC en `.htaccess`
- Abrir el archivo `.htaccess` en la raíz.
- Localizar la **Sección 8** (al final del archivo).
- Comentar o eliminar el bloque de la Sección 8:
  ```apache
  # Desactivar comentando las líneas o retirando el bloque:
  # RewriteRule ^(.*)$ public/index.php [QSA,L]
  ```
- **Efecto Inmediato**: Apache dejará de despachar tráfico a `public/index.php`. Los usuarios y motores de búsqueda continuarán accediendo de manera 100% transparente a los archivos físicos `index.html`, `contacto.html`, `nosotros.html`, etc., y los formularios seguirán apuntando a sus scripts de `backend/`.

### Paso 2: Retirar Redirecciones 301 (opcional)
- Si se desea que las solicitudes a URLs `.html` no redirijan a las rutas limpias, comentar la regla de redirección 301 de la Sección 8 en `.htaccess`.

### Paso 3: Aislamiento del Código MVC
- Dado que todo el código nuevo de la migración se encuentra confinado exclusivamente dentro de `app/`, `config/` y `public/`, no existe ningún impacto residual en las carpetas preexistentes (`backend/`, `css/`, `js/`, `img/`).
