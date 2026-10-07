# GUÍA DE DESPLIEGUE EN PRODUCCIÓN (GoDaddy cPanel)
**Quality Consulting Solutions**  
*Versión:* Release 2026-10-07 (Arquitectura MVC Resiliente)

---

## 📁 Estructura del Paquete

```text
├── public_html/       --> Todo el contenido público accesible vía web (CSS, JS, imágenes, front-controller .htaccess)
├── private_app/      --> Núcleo protegido PHP (Controladores, Vistas, Configuración, Router, Backend Seguro)
├── database_setup/   --> Scripts SQL para la base de datos MySQL (Tablas de contactos, logs y rate-limit)
└── docs/             --> Documentación técnica y respaldo de pasarelas de pago
```

---

## 🚀 Pasos para Desplegar en cPanel / GoDaddy:

### 1. Ubicación de Archivos en el Servidor:
* **`public_html/`**: Subir el contenido directamente a la raíz web `/home/tu_usuario/public_html/`.
* **`private_app/`**: Subir la carpeta al nivel superior protegido `/home/tu_usuario/private_app/` (fuera de `public_html` para máxima seguridad).

### 2. Configuración de Base de Datos (Opcional si usa MySQL):
* En cPanel > *Bases de datos MySQL*, crear la base de datos y usuario.
* Importar el script `database_setup/schema.sql`.
* Ajustar credenciales en `private_app/config/database.php` o `.env`.

### 3. Permisos de Carpetas:
* Carpetas: `755`
* Archivos: `644`
* Carpeta `private_app/storage/` (si existe para logs): `775` o permisos de escritura para PHP.

---

## 🛠️ Resumen de Cambios Incluidos en este Release:
* ✅ Imagen del Home panorámica y despejada (alta definición).
* ✅ Término "In-House" estandarizado en toda la plataforma.
* ✅ Pasarelas de pago retiradas de la vista pública (respaldadas en `docs/PASARELAS_DE_PAGO_BACKUP.md`).
* ✅ Modal interactivo de captura y solicitud de asesoría en 1 solo clic con bloqueo de scroll.
* ✅ Depuración y retiro total de servicios inactivos (*Homologaciones, Permisología y LEGO Serious Play*).
* ✅ Corrección y modernización completa de la vista *Riesgo del Plazo (Síndrome del 90%)*.
