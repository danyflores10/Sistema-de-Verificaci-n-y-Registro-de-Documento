<p align="center">
  <img src="public/images/logoCorreos.png" width="120" alt="Logo Correos">
</p>

<h1 align="center">📬 AGBC Documentos</h1>

<p align="center">
  <strong>Sistema de Verificación y Registro de Documentos</strong><br>
  Gestión documental para Correos: notas internas, cajas de archivo,
  verificación, aprobación y reportes.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/PostgreSQL-DB-4169E1?logo=postgresql&logoColor=white" alt="PostgreSQL">
  <img src="https://img.shields.io/badge/Vite-Tailwind-646CFF?logo=vite&logoColor=white" alt="Vite + Tailwind">
  <img src="https://img.shields.io/badge/license-MIT-green" alt="MIT License">
</p>

---

## 📖 ¿Qué es?

**AGBC Documentos** es una aplicación web para el **registro, verificación y
control de documentos** dentro de un archivo central. Permite organizar
documentos en cajas, registrar notas internas, llevar el flujo de aprobación
(borrador → enviado → verificado/rechazado), generar reportes en PDF/Excel y
auditar todas las acciones de los usuarios.

## ✨ Características principales

- 📦 **Gestión de cajas** de archivo y su contenido.
- 📝 **Notas internas** con tipo de documento, número de folios, tipología y estado de conservación.
- ✅ **Flujo de verificación** con aprobación / rechazo (incluye selección múltiple).
- 👥 **Control de roles y permisos** por módulos.
- 📎 **Adjuntos** de documentos a cada nota.
- 📊 **Reportes y exportación** a PDF (DomPDF) y Excel (Maatwebsite).
- 📥 **Importación** masiva de registros.
- 🔐 **Inicio de sesión** con correo o cuenta de Google (Socialite) y recuperación por código.
- 🕵️ **Auditoría** de acciones (audit logs) y monitoreo con Laravel Pulse.

## 👥 Roles del sistema

| Rol              | Descripción                                                        |
| ---------------- | ------------------------------------------------------------------ |
| **Super Admin**  | Control total del sistema y de usuarios.                           |
| **Administrador**| Gestión de usuarios, cajas, notas y verificación.                  |
| **Verificador**  | Registra y gestiona la documentación.                              |
| **Operador**     | Revisa y aprueba/rechaza documentos.                               |
| **Visualizador** | Acceso de solo lectura.                                            |

## 🛠️ Tecnologías

- **Backend:** Laravel 12 · PHP 8.2+
- **Base de datos:** PostgreSQL
- **Frontend:** Vite · Tailwind CSS · Alpine.js · SweetAlert2
- **Librerías:** DomPDF · Laravel Excel · Socialite · Pulse · Log Viewer

---

## 🚀 Instalación rápida

```bash
git clone https://github.com/danyflores10/Sistema-de-Verificaci-n-y-Registro-de-Documento.git system-correos
cd system-correos
composer install
cp .env.example .env          # En Windows: Copy-Item .env.example .env
# (edita .env con tus datos de PostgreSQL)
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Luego abre 👉 **http://localhost:8000**

> 📚 **Guía detallada paso a paso:** consulta [INSTALACION.md](INSTALACION.md)
> (requisitos, configuración de PostgreSQL y solución de problemas).

## 👤 Usuarios de prueba

Creados automáticamente con `php artisan migrate --seed`:

| Rol           | Correo                      | Contraseña      |
| ------------- | --------------------------- | --------------- |
| Super Admin   | `superadmin@correos.bo`     | `Super2026*`    |
| Administrador | `admin@correos.bo`          | `Admin2026*`    |
| Verificador   | `juan.perez@correos.bo`     | `Usuario2026*`  |
| Operador      | `maria.lopez@correos.bo`    | `Operador2026*` |
| Visualizador  | `visualizador@correos.bo`   | `Visual2026*`   |

> 🔒 **Cambia estas contraseñas antes de poner el sistema en producción.**

---

## 📄 Licencia

Proyecto basado en el framework [Laravel](https://laravel.com), software de código abierto bajo licencia [MIT](https://opensource.org/licenses/MIT).
