# Guía de Despliegue en Producción — Quality Consulting Solutions

Esta guía detalla el procedimiento oficial para desplegar `Quality-Produccion.zip` en un servidor de alojamiento web administrado con **cPanel** (ej. **GoDaddy**) bajo **Apache 2.4** y **PHP 8.0+**.

---

## 1. Requisitos del Servidor

* **Servidor Web**: Apache 2.4 o superior con módulos activos:
  * `mod_rewrite` (imprescindible para el Front Controller MVC y redirecciones 301).
  * `mod_headers` (cabeceras de seguridad y caché).
  * `mod_deflate` (compresión Gzip).
  * `mod_expires` (política de caché de navegador).
  * `mod_mime` (negociación de tipos MIME y WebP).
* **PHP**: Versión 8.0.30 o superior (compatible hasta PHP 8.3):
  * Extensiones requeridas: `pdo`, `pdo_mysql`, `curl`, `mbstring`, `json`, `openssl`, `filter`, `zlib`.
* **Base de Datos**: MySQL 5.7+ o MariaDB 10.3+ con cotejamiento `utf8mb4_unicode_ci`.

---

## 2. Despliegue de Archivos

1. Acceda al **Administrador de Archivos** de cPanel.
2. Navegue al directorio raíz público de su dominio (habitualmente `public_html` o la carpeta asignada a `quality-consulting.org`).
3. Suba el archivo [`Quality-Produccion.zip`](Quality-Produccion.zip) y extráigalo directamente en la raíz.
4. Verifique que la estructura descomprimida contenga:
   * `public/index.php` (Front Controller).
   * `app/` (Controladores, Core y Vistas MVC).
   * `backend/` (Endpoints, seguridad, servicios y almacenamiento).
   * `config/` (`app.php` y `routes.php`).
   * `img/`, `styles.css`, `script.js`, `favicon.ico`.
   * `.htaccess`, `robots.txt`, `sitemap.xml`, `404.html`, `.env.example`.

---

## 3. Permisos de Archivos y Directorios

En entornos cPanel con suPHP o FastCGI, los permisos recomendados son:
* **Directorios en general**: `0755` (`drwxr-xr-x`).
* **Archivos en general**: `0644` (`-rw-r--r--`).
* **Estructura de almacenamiento `backend/storage/`**:
  Asegúrese de que el usuario del proceso PHP tenga permisos de escritura (`0755`) sobre:
  * `backend/storage/cache/`
  * `backend/storage/circuit_breaker/`
  * `backend/storage/fallback_queue/`
  * `backend/storage/logs/`
  * `backend/storage/rate_limits/`

*(Cada subcarpeta contiene archivos `.htaccess` e `index.php` protectores que impiden el listado y acceso público).*

---

## 4. Configuración de Base de Datos y Correo SMTP

El portal cuenta con **degradación elegante**: si no se configura la base de datos o el correo, la navegación de las 44 rutas públicas opera al 100% y los formularios se almacenan temporalmente en `backend/storage/fallback_queue/`.

Para habilitar la persistencia en MySQL y el envío de correos:

1. **Crear Base de Datos en cPanel**:
   * Cree una base de datos MySQL (ej. `quality_web`) y un usuario con privilegios completos.
2. **Importar Esquemas SQL**:
   * En phpMyAdmin, importe sucesivamente:
     1. `backend/schema.sql` (tablas de contactos y reclamaciones).
     2. `backend/schema_soft_skills.sql` (tablas del evaluador situacional).
     3. `backend/migrations/001_add_queue_id_contactos.sql`.
3. **Crear Archivo `.env`**:
   * En la raíz del sitio (`public_html/`), copie o renombre `.env.example` como `.env`.
   * Complete sus credenciales reales:
     ```ini
     APP_ENV=production
     APP_DEBUG=false

     DB_ENABLED=true
     DB_HOST=localhost
     DB_PORT=3306
     DB_NAME=nombre_de_su_base_de_datos
     DB_USER=usuario_de_su_base_de_datos
     DB_PASSWORD=su_contraseña_segura
     DB_CHARSET=utf8mb4

     SMTP_DRIVER=smtp
     SMTP_HOST=mail.quality-consulting.org
     SMTP_PORT=465
     SMTP_ENCRYPTION=ssl
     SMTP_AUTH=true
     SMTP_USER=contacto@quality-consulting.org
     SMTP_PASSWORD=su_contraseña_smtp
     ```
   * *Nota de Seguridad*: La directiva de `.htaccess` bloquea cualquier acceso web al archivo `.env` (`Require all denied`).

---

## 5. Tareas Programadas (Cron Jobs en cPanel)

Para procesar periódicamente los registros encolados en caso de caídas temporales de base de datos o rotar logs:

1. Ingrese a **Trabajos de Cron** en cPanel.
2. Agregue el procesador de cola cada 15 minutos:
   ```bash
   */15 * * * * /usr/local/bin/php /home/USUARIO/public_html/backend/cron/process-fallback-queue.php >/dev/null 2>&1
   ```
3. *(Opcional)* Rotación diaria de logs a las 00:00:
   ```bash
   0 0 * * * /usr/local/bin/php /home/USUARIO/public_html/backend/maintenance/rotate_logs.php >/dev/null 2>&1
   ```

---

## 6. Verificación Post-Despliegue y Forzado HTTPS

1. **Verificación de Salud MVC**:
   * Acceda a `https://quality-consulting.org/mvc-health`.
   * Debe responder `{"status":"ok","service":"Quality Consulting Solutions",...}`. En producción no expone versiones de PHP ni rutas internas.
2. **Prueba de Redirección 301**:
   * Ingrese a `https://quality-consulting.org/index.html` → Debe redirigir con 301 a `https://quality-consulting.org/`.
   * Ingrese a `https://quality-consulting.org/contacto.html` → Debe redirigir con 301 a `https://quality-consulting.org/contacto`.
3. **Forzado HTTPS (Producción GoDaddy)**:
   * Una vez instalado el certificado SSL, en `.htaccess` (sección 7) descomente:
     ```apache
     RewriteCond %{HTTPS} off
     RewriteCond %{HTTP:X-Forwarded-Proto} !https
     RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
     ```
