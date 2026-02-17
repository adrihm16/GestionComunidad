# 🏘️ GestionComunidad

Sistema de gestión de comunidades de vecinos desarrollado con Laravel 12.

## 📋 Descripción

GestionComunidad es una aplicación web moderna para la gestión integral de comunidades de vecinos. Permite administrar inmuebles, recibos, incidencias, noticias y eventos de forma eficiente y colaborativa.

## 🛠️ Tecnologías Utilizadas

### Backend
- **Laravel 12.0** - Framework PHP moderno (requiere PHP 8.2+)
- **SQLite** - Base de datos ligera y fácil de configurar
- **Laravel Breeze** - Sistema de autenticación

### Frontend
- **Vite** - Build tool ultrarrápido
- **Tailwind CSS 3** - Framework de utilidades CSS
- **Alpine.js** - Framework JavaScript reactivo y ligero
- **Axios** - Cliente HTTP

## 🚀 Instalación Rápida

### Prerequisitos

Antes de comenzar, necesitas tener instalado:

- **PHP 8.2 o superior**
- **Composer** (gestor de dependencias de PHP)
- **Node.js** (v18 o superior) y npm

### 1. Verificar tu entorno

Ejecuta el script de verificación para comprobar qué tienes instalado:

```powershell
.\verificar-entorno.ps1
```

### 2. Instalar herramientas faltantes

Si no tienes PHP y/o Composer instalados, sigue la guía detallada:

📖 **[GUIA_INSTALACION.md](GUIA_INSTALACION.md)** - Guía completa paso a paso

O consulta:

⚡ **[INICIO_RAPIDO.md](INICIO_RAPIDO.md)** - Guía rápida

### 3. Configuración automática del proyecto

Una vez que tengas PHP y Composer instalados, ejecuta:

```powershell
.\setup-proyecto.ps1
```

Este script automáticamente:
- ✅ Configura el archivo .env
- ✅ Instala dependencias de Composer (~112 paquetes)
- ✅ Instala dependencias de npm (~157 paquetes)
- ✅ Genera la clave de la aplicación
- ✅ Crea la base de datos SQLite
- ✅ Ejecuta las migraciones (crea 9 tablas)
- ✅ Compila los assets del frontend

## 🎯 Uso

### Iniciar el servidor de desarrollo

**Opción 1: Todo en uno (Recomendada)**

```powershell
cd GestionComunidad\gestion-comunidad
composer dev
```

Esto iniciará automáticamente:
- ✅ Servidor PHP (http://localhost:8000)
- ✅ Cola de trabajos
- ✅ Logs en tiempo real
- ✅ Vite dev server (hot reload para CSS/JS)

**Opción 2: Manual (en terminales separadas)**

```powershell
# Terminal 1: Servidor PHP
cd GestionComunidad\gestion-comunidad
php artisan serve

# Terminal 2: Vite (compilación de assets)
cd GestionComunidad\gestion-comunidad
npm run dev
```

Luego abre tu navegador en: **http://localhost:8000**

## 📁 Estructura del Proyecto

```
GestionComunidad/
├── GestionComunidad/
│   └── gestion-comunidad/        # Proyecto Laravel principal
│       ├── app/                   # Lógica de la aplicación
│       │   ├── Http/              # Controladores y Middleware
│       │   ├── Models/            # Modelos Eloquent
│       │   └── ...
│       ├── database/              # Migraciones, seeders y BD SQLite
│       │   ├── migrations/        # Definiciones de tablas
│       │   └── database.sqlite    # Archivo de base de datos
│       ├── public/                # Archivos públicos (punto de entrada)
│       ├── resources/             # Vistas, CSS, JS sin compilar
│       │   ├── views/             # Plantillas Blade
│       │   ├── css/               # Archivos CSS
│       │   └── js/                # Archivos JavaScript
│       ├── routes/                # Definición de rutas
│       │   ├── web.php            # Rutas web
│       │   └── api.php            # Rutas API
│       ├── storage/               # Logs, cache, archivos subidos
│       ├── .env                   # Configuración (se crea automáticamente)
│       ├── composer.json          # Dependencias PHP
│       └── package.json           # Dependencias JavaScript
├── GUIA_INSTALACION.md           # Guía de instalación detallada
├── INICIO_RAPIDO.md              # Guía rápida
├── LEEME_PRIMERO.txt             # Archivo de bienvenida
├── README.md                      # Este archivo
├── setup-proyecto.ps1            # Script de configuración automática
├── verificar-entorno.ps1         # Script de verificación
└── iniciar-proyecto.ps1          # Script para iniciar el proyecto
```

## 💾 Base de Datos

### Tablas principales

El proyecto incluye las siguientes tablas:

- **users** - Usuarios del sistema
- **inmuebles** - Propiedades/viviendas de la comunidad
- **recibos** - Recibos y pagos
- **incidencias** - Incidencias reportadas
- **comentarios_incidencia** - Comentarios en incidencias
- **noticias** - Noticias de la comunidad
- **eventos** - Eventos programados
- **cache**, **jobs** - Tablas del sistema

### Cambiar a MySQL u otra base de datos

Si prefieres usar MySQL u otra base de datos, edita el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_comunidad
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

Luego ejecuta las migraciones:

```powershell
php artisan migrate
```

## 🔧 Comandos Útiles

### Artisan (CLI de Laravel)

```powershell
# Ver todos los comandos disponibles
php artisan list

# Gestión de base de datos
php artisan migrate                        # Ejecutar migraciones
php artisan migrate:fresh                  # Recrear BD desde cero
php artisan migrate:fresh --seed           # Recrear BD con datos de prueba

# Interacción con la aplicación
php artisan tinker                         # Consola interactiva

# Generar código
php artisan make:model NombreModelo        # Crear modelo
php artisan make:controller NombreCtrl     # Crear controlador
php artisan make:migration nombre          # Crear migración
php artisan make:seeder NombreSeeder       # Crear seeder

# Información y mantenimiento
php artisan route:list                     # Listar todas las rutas
php artisan cache:clear                    # Limpiar caché
php artisan config:clear                   # Limpiar caché de configuración
php artisan view:clear                     # Limpiar caché de vistas
```

### Composer (Gestión de dependencias PHP)

```powershell
composer install                # Instalar dependencias
composer update                # Actualizar dependencias
composer dump-autoload         # Regenerar autoload
composer require paquete       # Instalar nuevo paquete
composer remove paquete        # Eliminar paquete
composer show                  # Listar paquetes instalados
```

### NPM (Gestión de dependencias JavaScript)

```powershell
npm install                    # Instalar dependencias
npm run dev                   # Modo desarrollo (hot reload)
npm run build                 # Compilar para producción
npm run lint                  # Verificar código
npm update                    # Actualizar dependencias
```

## 🔐 Autenticación

El proyecto utiliza **Laravel Breeze**, que proporciona:

- ✅ Registro de usuarios
- ✅ Inicio de sesión
- ✅ Recuperación de contraseña
- ✅ Verificación de email
- ✅ Gestión de perfiles de usuario

### Rutas de autenticación

- `/register` - Registro de nuevos usuarios
- `/login` - Inicio de sesión
- `/forgot-password` - Recuperar contraseña
- `/dashboard` - Panel principal (requiere autenticación)

## 🧪 Testing

```powershell
# Ejecutar todos los tests
php artisan test

# Ejecutar tests con coverage
php artisan test --coverage

# Ejecutar un test específico
php artisan test --filter=NombreDelTest

# Ejecutar tests en paralelo
php artisan test --parallel
```

## 📝 Variables de Entorno

Las principales variables de entorno están en el archivo `.env`:

```env
# Aplicación
APP_NAME=GestionComunidad    # Nombre de la aplicación
APP_ENV=local                # Entorno (local, production)
APP_DEBUG=true              # Modo debug (desactivar en producción)
APP_URL=http://localhost    # URL base

# Base de datos
DB_CONNECTION=sqlite        # Tipo de base de datos
# Si usas MySQL, configura estos:
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=nombre_bd
# DB_USERNAME=usuario
# DB_PASSWORD=contraseña

# Mail (para emails)
MAIL_MAILER=log            # log, smtp, etc.
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 🐛 Solución de Problemas

### Error 500 al acceder a la aplicación

1. Verifica que el archivo `.env` existe
2. Genera la clave de aplicación: `php artisan key:generate`
3. Revisa los logs: `storage/logs/laravel.log`

### Los cambios CSS/JS no se reflejan

1. Asegúrate de que `npm run dev` esté corriendo
2. Limpia la caché del navegador (Ctrl + Shift + R o Ctrl + F5)
3. Si persiste, recompila: `npm run build`

### Error de permisos

En Windows, ejecuta PowerShell como Administrador o ajusta los permisos de la carpeta del proyecto.

### Base de datos no se encuentra

```powershell
# Crea el archivo manualmente
New-Item -ItemType File -Path "database\database.sqlite" -Force

# Ejecuta las migraciones
php artisan migrate
```

### Error "Class not found"

```powershell
# Regenera el autoload de Composer
composer dump-autoload

# Limpia la caché de configuración
php artisan config:clear
```

## 📚 Recursos y Documentación

- [Documentación de Laravel](https://laravel.com/docs)
- [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)
- [Tailwind CSS](https://tailwindcss.com/docs)
- [Alpine.js](https://alpinejs.dev/)
- [Vite](https://vitejs.dev/)

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto usa Laravel, que está bajo la licencia [MIT](https://opensource.org/licenses/MIT).

## 🆘 ¿Necesitas Ayuda?

Si encuentras algún problema:

1. **Ejecuta** `.\verificar-entorno.ps1` para revisar tu configuración
2. **Consulta** la sección de [Solución de Problemas](#-solución-de-problemas)
3. **Revisa** los logs: `GestionComunidad/gestion-comunidad/storage/logs/laravel.log`
4. **Lee** la documentación completa en `GUIA_INSTALACION.md`

---

## 📞 Contacto

**Proyecto:** GestionComunidad  
**Framework:** Laravel 12  
**Año:** 2026

---

**¡Feliz desarrollo! 🚀**
