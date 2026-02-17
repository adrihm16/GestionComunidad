# 📂 Estructura del Proyecto - GestionComunidad

Este documento explica la estructura de carpetas y archivos del proyecto para ayudar a nuevos desarrolladores a entender cómo está organizado.

## 🌲 Árbol de Directorios

```
GestionComunidad/
│
├── 📁 GestionComunidad/
│   └── 📁 gestion-comunidad/              ← Aplicación Laravel principal
│       │
│       ├── 📁 app/                         ← Código de la aplicación
│       │   ├── 📁 Http/
│       │   │   ├── 📁 Controllers/         ← Controladores (lógica de rutas)
│       │   │   ├── 📁 Middleware/          ← Middleware (filtros de peticiones)
│       │   │   └── Kernel.php              ← Configuración de middleware
│       │   │
│       │   ├── 📁 Models/                  ← Modelos Eloquent (BD)
│       │   │   ├── User.php
│       │   │   ├── Inmueble.php
│       │   │   ├── Recibo.php
│       │   │   └── ...
│       │   │
│       │   └── 📁 Providers/               ← Proveedores de servicios
│       │
│       ├── 📁 bootstrap/                   ← Inicialización de Laravel
│       │   ├── app.php                     ← Configuración de arranque
│       │   └── cache/                      ← Cache de configuración
│       │
│       ├── 📁 config/                      ← Archivos de configuración
│       │   ├── app.php                     ← Configuración general
│       │   ├── database.php                ← Configuración de BD
│       │   ├── mail.php                    ← Configuración de email
│       │   └── ...
│       │
│       ├── 📁 database/                    ← Base de datos
│       │   ├── 📁 migrations/              ← Migraciones (estructura de tablas)
│       │   │   ├── 2026_02_16_100000_create_inmuebles_table.php
│       │   │   ├── 2026_02_16_100001_create_recibos_table.php
│       │   │   └── ...
│       │   │
│       │   ├── 📁 seeders/                 ← Seeders (datos de prueba)
│       │   │   └── DatabaseSeeder.php
│       │   │
│       │   └── 📄 database.sqlite          ← Archivo de base de datos SQLite
│       │
│       ├── 📁 public/                      ← Archivos públicos (accesibles desde web)
│       │   ├── 📁 build/                   ← Assets compilados por Vite
│       │   │   ├── manifest.json
│       │   │   └── assets/                 ← CSS y JS compilados
│       │   │
│       │   ├── index.php                   ← Punto de entrada de la aplicación
│       │   └── ...
│       │
│       ├── 📁 resources/                   ← Recursos sin compilar
│       │   ├── 📁 views/                   ← Plantillas Blade (HTML)
│       │   │   ├── layouts/                ← Layouts principales
│       │   │   ├── auth/                   ← Vistas de autenticación
│       │   │   ├── dashboard.blade.php     ← Panel principal
│       │   │   └── ...
│       │   │
│       │   ├── 📁 css/                     ← Archivos CSS (Tailwind)
│       │   │   └── app.css
│       │   │
│       │   └── 📁 js/                      ← Archivos JavaScript
│       │       ├── app.js                  ← Punto de entrada JS
│       │       └── bootstrap.js            ← Configuración de Axios, Alpine
│       │
│       ├── 📁 routes/                      ← Definición de rutas
│       │   ├── web.php                     ← Rutas web (navegador)
│       │   ├── api.php                     ← Rutas API (JSON)
│       │   ├── console.php                 ← Comandos de consola personalizados
│       │   └── auth.php                    ← Rutas de autenticación (Breeze)
│       │
│       ├── 📁 storage/                     ← Almacenamiento de archivos
│       │   ├── 📁 app/                     ← Archivos de la aplicación
│       │   ├── 📁 framework/               ← Cache, sesiones, vistas compiladas
│       │   └── 📁 logs/                    ← Logs de la aplicación
│       │       └── laravel.log             ← Log principal
│       │
│       ├── 📁 tests/                       ← Tests automatizados
│       │   ├── 📁 Feature/                 ← Tests de funcionalidad
│       │   └── 📁 Unit/                    ← Tests unitarios
│       │
│       ├── 📁 vendor/                      ← Dependencias de Composer (NO tocar)
│       │
│       ├── 📄 .env                         ← Configuración del entorno (SECRET!)
│       ├── 📄 .env.example                 ← Plantilla de .env (versionado)
│       ├── 📄 artisan                      ← CLI de Laravel
│       ├── 📄 composer.json                ← Dependencias PHP
│       ├── 📄 composer.lock                ← Versiones exactas de dependencias PHP
│       ├── 📄 package.json                 ← Dependencias JavaScript
│       ├── 📄 package-lock.json            ← Versiones exactas de dependencias JS
│       ├── 📄 vite.config.js               ← Configuración de Vite
│       ├── 📄 tailwind.config.js           ← Configuración de Tailwind CSS
│       └── 📄 phpunit.xml                  ← Configuración de PHPUnit (tests)
│
├── 📄 GUIA_INSTALACION.md                  ← Guía de instalación detallada
├── 📄 INICIO_RAPIDO.md                     ← Guía rápida
├── 📄 README.md                            ← Documentación principal
├── 📄 LEEME_PRIMERO.txt                    ← Archivo de bienvenida
├── 📄 ESTRUCTURA_PROYECTO.md               ← Este archivo
│
├── 📜 setup-proyecto.ps1                   ← Script de configuración automática
├── 📜 verificar-entorno.ps1                ← Script de verificación
└── 📜 iniciar-proyecto.ps1                 ← Script para iniciar el proyecto
```

---

## 📋 Archivos Importantes

### Archivos de Configuración Principal

| Archivo | Descripción |
|---------|-------------|
| `.env` | Configuración del entorno (NO subir a git) |
| `composer.json` | Dependencias PHP y scripts |
| `package.json` | Dependencias JavaScript y scripts npm |
| `vite.config.js` | Configuración del bundler Vite |
| `tailwind.config.js` | Configuración de Tailwind CSS |

### Scripts de Ayuda (Raíz del Proyecto)

| Script | Propósito |
|--------|-----------|
| `verificar-entorno.ps1` | Verifica herramientas instaladas |
| `setup-proyecto.ps1` | Configura el proyecto automáticamente |
| `iniciar-proyecto.ps1` | Inicia el servidor de desarrollo |

---

## 🎯 Flujos de Trabajo Comunes

### 1. Crear una nueva funcionalidad

```
1. Crear modelo:          php artisan make:model NombreModelo -m
2. Editar migración:      database/migrations/XXXX_create_nombre_table.php
3. Ejecutar migración:    php artisan migrate
4. Crear controlador:     php artisan make:controller NombreController
5. Definir rutas:         routes/web.php
6. Crear vistas:          resources/views/nombre.blade.php
```

### 2. Modificar el diseño (CSS/JS)

```
1. Editar CSS:            resources/css/app.css
2. Editar JS:             resources/js/app.js
3. Ver cambios:           npm run dev (hot reload automático)
4. Compilar producción:   npm run build
```

### 3. Trabajar con la base de datos

```
1. Ver tablas:            php artisan migrate:status
2. Crear migración:       php artisan make:migration nombre_descriptivo
3. Ejecutar migraciones:  php artisan migrate
4. Revertir última:       php artisan migrate:rollback
5. Recrear BD:            php artisan migrate:fresh
6. Recrear con datos:     php artisan migrate:fresh --seed
```

---

## 📁 Carpetas por Tipo de Desarrollo

### Frontend (Vistas y Assets)

```
resources/
├── views/          ← Plantillas Blade (HTML + PHP)
├── css/            ← Estilos (Tailwind CSS)
└── js/             ← JavaScript (Alpine.js, Axios)

public/build/       ← Assets compilados (generado automáticamente)
```

### Backend (Lógica de Negocio)

```
app/
├── Http/
│   ├── Controllers/    ← Lógica de las rutas
│   └── Middleware/     ← Filtros de peticiones
└── Models/             ← Modelos de base de datos

routes/
├── web.php             ← Rutas web
└── api.php             ← Rutas API
```

### Base de Datos

```
database/
├── migrations/         ← Definición de tablas
├── seeders/            ← Datos de prueba
└── database.sqlite     ← Archivo de BD
```

---

## 🔒 Archivos que NO debes modificar

- `vendor/` - Dependencias de Composer (se regenera con `composer install`)
- `node_modules/` - Dependencias de npm (se regenera con `npm install`)
- `public/build/` - Assets compilados (se regenera con `npm run build`)
- `storage/framework/` - Cache del framework
- `bootstrap/cache/` - Cache de configuración
- `.env` - (NO versionar, pero sí modificar localmente)

---

## 🔐 Archivos Sensibles (NO subir a Git)

Estos archivos contienen información sensible y están en `.gitignore`:

- `.env` - Contraseñas, claves de API, etc.
- `database/database.sqlite` - Base de datos local
- `storage/logs/` - Logs que pueden contener datos sensibles
- `node_modules/` - Pesa mucho
- `vendor/` - Pesa mucho

---

## 📝 Convenciones de Nombres

### Modelos
- **Singular, PascalCase**: `User`, `Inmueble`, `Recibo`
- Archivo: `app/Models/NombreModelo.php`

### Controladores
- **Singular + "Controller"**: `UserController`, `InmuebleController`
- Archivo: `app/Http/Controllers/NombreController.php`

### Migraciones
- **Timestamp + snake_case**: `2026_02_16_create_inmuebles_table.php`
- Crear tabla: `create_nombre_plural_table`
- Modificar tabla: `add_campo_to_nombre_plural_table`

### Rutas
- **Plural, kebab-case**: `/inmuebles`, `/recibos`, `/noticias`
- RESTful: `/inmuebles/{id}`, `/recibos/{id}/editar`

### Vistas
- **kebab-case, extensión .blade.php**
- `dashboard.blade.php`, `inmuebles-index.blade.php`

---

## 🛠️ Comandos Rápidos por Carpeta

### Trabajar con `app/Models/`

```powershell
php artisan make:model NombreModelo        # Crear modelo
php artisan make:model NombreModelo -m     # Crear modelo + migración
php artisan make:model NombreModelo -mfs   # Modelo + migración + factory + seeder
```

### Trabajar con `app/Http/Controllers/`

```powershell
php artisan make:controller NombreController              # Controlador vacío
php artisan make:controller NombreController --resource   # Controlador con CRUD
php artisan make:controller NombreController --api        # Controlador API
```

### Trabajar con `database/migrations/`

```powershell
php artisan make:migration nombre_descriptivo   # Crear migración
php artisan migrate                            # Ejecutar migraciones
php artisan migrate:rollback                   # Revertir última
php artisan migrate:fresh                      # Recrear todas
```

### Trabajar con `resources/views/`

Las vistas no tienen comando de creación, se crean manualmente:
- Crear archivo `.blade.php` en `resources/views/`
- Usar sintaxis Blade: `@extends`, `@section`, `{{ $variable }}`

---

## 💡 Consejos Finales

1. **Usa Artisan**: Laravel tiene comandos para casi todo (`php artisan list`)
2. **Respeta la estructura**: No muevas archivos de lugar sin razón
3. **Lee los comentarios**: Los archivos de configuración tienen comentarios útiles
4. **Usa `.env.example`**: Copia este archivo a `.env` para configurar tu entorno
5. **Consulta los logs**: `storage/logs/laravel.log` es tu amigo cuando algo falla
6. **No toques `vendor/` ni `node_modules/`**: Se regeneran automáticamente

---

## 🔗 Recursos Relacionados

- **README.md** - Documentación general del proyecto
- **GUIA_INSTALACION.md** - Cómo instalar todo lo necesario
- **Documentación de Laravel** - https://laravel.com/docs

---

¿Tienes dudas sobre alguna carpeta o archivo? Consulta la documentación o pregunta al equipo.
