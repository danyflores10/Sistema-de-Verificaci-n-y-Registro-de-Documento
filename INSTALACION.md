# 📦 AGBC Documentos — Guía de Clonado e Instalación

Sistema de **gestión documental de Correos** (notas internas, cajas de archivo,
verificación y aprobación de documentos, exportación a PDF/Excel, control de
roles y auditoría).

Construido con **Laravel 12**, **PostgreSQL** y **Vite + Tailwind**.

---

## 🧰 Requisitos previos

Antes de empezar, asegúrate de tener instalado en tu equipo:

| Herramienta   | Versión mínima | Para qué sirve                          |
| ------------- | -------------- | --------------------------------------- |
| **PHP**       | 8.2 o superior | Ejecutar el backend de Laravel          |
| **Composer**  | 2.x            | Instalar dependencias de PHP            |
| **PostgreSQL**| 13 o superior  | Base de datos del sistema               |
| **Node.js**   | 18 o superior  | Compilar el frontend (CSS/JS)           |
| **npm**       | 9 o superior   | Gestor de paquetes de Node              |
| **Git**       | cualquiera     | Clonar el repositorio                   |

> 💡 En Windows lo más sencillo es instalar **[Laragon](https://laragon.org/)**
> o **[XAMPP](https://www.apachefriends.org/)** (que ya traen PHP y consola),
> más **PostgreSQL** por separado.

Extensiones de PHP necesarias (normalmente vienen activadas):
`pdo_pgsql`, `pgsql`, `mbstring`, `openssl`, `fileinfo`, `gd`, `zip`, `curl`.

---

## 1️⃣ Clonar el repositorio

Abre una terminal en la carpeta donde quieras guardar el proyecto y ejecuta:

```bash
git clone <URL-DEL-REPOSITORIO> system-correos
cd system-correos
```

> Reemplaza `<URL-DEL-REPOSITORIO>` por la URL real de tu repositorio
> (por ejemplo `https://github.com/usuario/system-correos.git`).

---

## 2️⃣ Instalar dependencias de PHP

```bash
composer install
```

Esto descarga todas las librerías de Laravel y los paquetes del proyecto
(DomPDF, Excel, Socialite, Pulse, etc.) dentro de la carpeta `vendor/`.

---

## 3️⃣ Configurar el archivo de entorno (`.env`)

Copia el archivo de ejemplo:

```bash
# Windows (PowerShell)
Copy-Item .env.example .env

# Linux / macOS
cp .env.example .env
```

Luego **edita el archivo `.env`** y configura tu conexión a PostgreSQL:

```env
APP_NAME="AGBC Documentos"
APP_URL=http://localhost:8000
APP_LOCALE=es

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=Correos_documentos
DB_USERNAME=postgres
DB_PASSWORD=tu_contraseña_de_postgres
```

> ⚠️ **Importante:** crea primero la base de datos vacía en PostgreSQL con el
> nombre que pusiste en `DB_DATABASE` (por ejemplo `Correos_documentos`).
>
> ```sql
> CREATE DATABASE "Correos_documentos";
> ```

---

## 4️⃣ Generar la clave de la aplicación

```bash
php artisan key:generate
```

Esto rellena el valor `APP_KEY` en tu `.env` (necesario para cifrar sesiones y datos).

---

## 5️⃣ Crear las tablas y datos de ejemplo

Ejecuta las migraciones (crea todas las tablas) junto con los datos iniciales:

```bash
php artisan migrate --seed
```

Esto crea las tablas de usuarios, cajas, notas internas, adjuntos, auditoría, etc.
y carga **usuarios y datos de ejemplo** para que puedas entrar de inmediato.

> Si solo quieres las tablas sin datos de ejemplo, usa `php artisan migrate`.
> Para reiniciar todo desde cero: `php artisan migrate:fresh --seed`.

### 🗝️ Crear el enlace de almacenamiento (archivos adjuntos)

```bash
php artisan storage:link
```

---

## 6️⃣ Instalar y compilar el frontend

```bash
npm install
npm run build
```

- `npm install` descarga las dependencias de la interfaz (Tailwind, Alpine, etc.).
- `npm run build` compila el CSS y JS para producción.

> Para **desarrollo** (con recarga automática mientras editas), usa `npm run dev`
> en lugar de `npm run build`.

---

## 7️⃣ Iniciar el sistema

```bash
php artisan serve
```

Abre tu navegador en 👉 **http://localhost:8000**

> 💡 Alternativa para desarrollo: `composer run dev` levanta a la vez el
> servidor, la cola de trabajos, los logs en vivo y Vite.

---

## 👥 Usuarios de prueba (creados por el seeder)

| Rol           | Correo                      | Contraseña      |
| ------------- | --------------------------- | --------------- |
| Super Admin   | `superadmin@correos.bo`     | `Super2026*`    |
| Administrador | `admin@correos.bo`          | `Admin2026*`    |
| Verificador   | `juan.perez@correos.bo`     | `Usuario2026*`  |
| Operador      | `maria.lopez@correos.bo`    | `Operador2026*` |
| Visualizador  | `visualizador@correos.bo`   | `Visual2026*`   |

> 🔒 **Cambia estas contraseñas antes de poner el sistema en producción.**

---

## ⚡ Resumen rápido (copiar y pegar)

```bash
git clone <URL-DEL-REPOSITORIO> system-correos
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

---

## 🛠️ Solución de problemas comunes

| Problema                                          | Solución                                                                 |
| ------------------------------------------------- | ------------------------------------------------------------------------ |
| `could not find driver` (PostgreSQL)              | Activa las extensiones `pdo_pgsql` y `pgsql` en tu `php.ini`.            |
| `SQLSTATE... database does not exist`             | Crea la base de datos en PostgreSQL antes de migrar.                     |
| La página se ve sin estilos                       | Ejecuta `npm run build` (o `npm run dev`).                              |
| `Permission denied` en logs/cache                 | Da permisos de escritura a las carpetas `storage/` y `bootstrap/cache/`.|
| Cambié el `.env` y no toma los cambios            | Ejecuta `php artisan config:clear`.                                     |

---

¿Dudas? Revisa la [documentación oficial de Laravel](https://laravel.com/docs).
