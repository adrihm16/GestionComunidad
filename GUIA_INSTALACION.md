# 🚀 Guía de Instalación - Entorno de Desarrollo Laravel

## 📋 Requisitos del Sistema

Este proyecto requiere las siguientes herramientas:

- ✅ Node.js v18+ y npm
- ⚠️ PHP 8.2+
- ⚠️ Composer
- ⚠️ Extensiones PHP necesarias

---

## 1️⃣ INSTALACIÓN DE PHP 8.2+ en Windows

### Opción A: Instalación Manual (Recomendada)

#### 1. Descargar PHP

Ve a: **https://windows.php.net/download/**

Descarga: **PHP 8.3 VS16 x64 Thread Safe** (archivo .zip)
- Ejemplo: `php-8.3.x-Win32-vs16-x64.zip`

#### 2. Instalar PHP

```powershell
# Crea la carpeta para PHP (puede ser cualquier ubicación, pero recomendamos C:\php)
New-Item -ItemType Directory -Path C:\php -Force

# Extrae el contenido del .zip descargado a C:\php
# Puedes usar el Explorador de Windows:
# - Click derecho en el archivo .zip → Extraer todo
# - Selecciona C:\php como destino
```

#### 3. Configurar PHP

```powershell
# Copia el archivo de configuración
cd C:\php
Copy-Item php.ini-development php.ini
```

#### 4. Habilitar extensiones necesarias para Laravel

Abre el archivo `C:\php\php.ini` con un editor de texto (Notepad, VSCode, etc.)

Busca y **descomenta** (quita el `;` al inicio) las siguientes líneas:

```ini
extension=curl
extension=fileinfo
extension=gd
extension=mbstring
extension=openssl
extension=pdo_mysql
extension=pdo_sqlite
extension=sqlite3
extension=zip
```

**Nota:** Descomentar significa cambiar `;extension=curl` por `extension=curl`

#### 5. Agregar PHP al PATH del sistema

**Método 1: Interfaz gráfica**

1. Presiona `Win + X` y selecciona "Sistema"
2. Click en "Configuración avanzada del sistema"
3. Click en "Variables de entorno"
4. En "Variables del sistema", busca `Path` y haz click en "Editar"
5. Click en "Nuevo" y agrega: `C:\php`
6. Click en "Aceptar" en todas las ventanas

**Método 2: PowerShell (como Administrador)**

```powershell
[Environment]::SetEnvironmentVariable("Path", $env:Path + ";C:\php", [EnvironmentVariableTarget]::Machine)
```

#### 6. Verificar instalación

Abre un **nuevo** PowerShell (importante: debe ser nuevo para cargar el PATH) y ejecuta:

```powershell
php --version
```

Deberías ver algo como: `PHP 8.3.x ...`

### Opción B: Usando Chocolatey (Si lo tienes instalado)

```powershell
choco install php --version=8.3.0
```

---

## 2️⃣ INSTALACIÓN DE COMPOSER

### Método Recomendado: Instalador oficial

#### 1. Descargar Composer

Ve a: **https://getcomposer.org/download/**

Descarga: **Composer-Setup.exe**

#### 2. Ejecutar el instalador

1. Ejecuta `Composer-Setup.exe`
2. El instalador detectará automáticamente tu instalación de PHP
3. En la pantalla de proxy:
   - Si NO usas proxy (caso más común): **desmarca** la casilla
   - Si usas proxy (empresas): ingresa la URL del proxy
4. Deja todas las demás opciones por defecto
5. Click en "Install"

#### 3. Verificar instalación

Abre un **nuevo** PowerShell y ejecuta:

```powershell
composer --version
```

Deberías ver algo como: `Composer version 2.x.x`

### Método Alternativo: Instalación Manual

```powershell
# Descargar Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# Verificar el instalador (opcional pero recomendado)
php -r "if (hash_file('sha384', 'composer-setup.php') === file_get_contents('https://composer.github.io/installer.sig')) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

# Instalar Composer globalmente
php composer-setup.php --install-dir=C:\php --filename=composer.bat

# Limpiar
php -r "unlink('composer-setup.php');"
```

---

## 3️⃣ CONFIGURACIÓN DEL PROYECTO LARAVEL

Una vez que tengas PHP y Composer instalados, usa el script de configuración automática.

### Navega a la carpeta del proyecto

```powershell
# Sustituye [RUTA_PROYECTO] por la ubicación donde clonaste/descargaste el proyecto
cd [RUTA_PROYECTO]

# Ejemplo:
# cd C:\proyectos\GestionComunidad
# cd $HOME\Desktop\GestionComunidad
```

### Ejecuta el script de configuración

```powershell
.\setup-proyecto.ps1
```

Este script automáticamente:
- ✅ Verifica que PHP y Composer estén instalados
- ✅ Copia el archivo .env.example a .env
- ✅ Instala las dependencias de Composer (~112 paquetes)
- ✅ Instala las dependencias de npm (~157 paquetes)
- ✅ Genera la clave de la aplicación
- ✅ Crea la base de datos SQLite
- ✅ Ejecuta las migraciones (crea las tablas)
- ✅ Compila los assets del frontend

---

## 4️⃣ EJECUTAR EL PROYECTO

Después de la instalación, para ejecutar el proyecto:

```powershell
cd GestionComunidad\gestion-comunidad

# Opción 1: Usando el script de composer (recomendado)
composer dev

# Opción 2: Manual (en terminales separadas)
# Terminal 1: Servidor PHP
php artisan serve

# Terminal 2: Vite (compilación de assets)
npm run dev
```

El proyecto estará disponible en: **http://localhost:8000**

---

## 🔧 COMANDOS ÚTILES

### Artisan (CLI de Laravel)

```powershell
php artisan list                           # Ver todos los comandos disponibles
php artisan migrate                        # Ejecutar migraciones
php artisan migrate:fresh --seed           # Recrear BD con datos de prueba
php artisan tinker                         # Consola interactiva
php artisan make:model NombreModelo        # Crear modelo
php artisan make:controller NombreCtrl     # Crear controlador
php artisan make:migration nombre          # Crear migración
php artisan route:list                     # Listar todas las rutas
php artisan cache:clear                    # Limpiar caché
```

### Composer

```powershell
composer install              # Instalar dependencias
composer update              # Actualizar dependencias
composer dump-autoload       # Regenerar autoload
composer require paquete     # Instalar nuevo paquete
```

### NPM

```powershell
npm install                  # Instalar dependencias
npm run dev                 # Modo desarrollo (hot reload)
npm run build               # Compilar para producción
```

---

## ❌ SOLUCIÓN DE PROBLEMAS COMUNES

### Error: "php no se reconoce..."

**Causa:** PHP no está en el PATH del sistema

**Solución:**
1. Asegúrate de haber agregado `C:\php` al PATH (ver paso 5 arriba)
2. Cierra y abre un **nuevo** PowerShell
3. Verifica con: `echo $env:Path`
4. Deberías ver `C:\php` en la lista

### Error: "composer no se reconoce..."

**Causa:** Composer no está en el PATH del sistema

**Solución:**
1. Reinicia el PowerShell después de instalar Composer
2. Si usaste el método manual, asegúrate de que `composer.bat` esté en `C:\php`
3. Verifica el PATH con: `echo $env:Path`

### Error al instalar dependencias de Composer

**Solución:**

```powershell
# Limpiar cache de composer
composer clear-cache

# Intentar de nuevo
composer install
```

### Error: Extensión PHP no está habilitada

**Síntomas:** Mensajes como "ext-mbstring is missing" o similar

**Solución:**
1. Abre `C:\php\php.ini`
2. Busca la línea de la extensión (ejemplo: `;extension=mbstring`)
3. Quita el `;` al inicio: `extension=mbstring`
4. Guarda el archivo
5. Reinicia el servidor con `php artisan serve`

### Error: No se puede crear la base de datos

**Solución:**

```powershell
cd GestionComunidad\gestion-comunidad

# Crear manualmente el archivo de base de datos
New-Item -ItemType File -Path "database\database.sqlite" -Force

# Ejecutar migraciones
php artisan migrate
```

### Error de permisos en Windows

**Síntomas:** "Permission denied" o "Access denied"

**Solución:**
1. Ejecuta PowerShell como Administrador
2. O cambia los permisos de la carpeta del proyecto:

```powershell
# Click derecho en la carpeta → Propiedades → Seguridad
# Asegúrate de que tu usuario tenga permisos de "Control total"
```

### Los cambios CSS/JS no se reflejan

**Solución:**
1. Asegúrate de que `npm run dev` esté corriendo
2. Limpia la caché del navegador (Ctrl + Shift + R o Ctrl + F5)
3. Si aún no funciona, recompila:

```powershell
npm run build
```

### Error: "Call to undefined function..."

**Causa:** Falta una extensión PHP

**Solución:**
1. Identifica qué extensión falta en el mensaje de error
2. Edita `C:\php\php.ini`
3. Descomenta la extensión correspondiente
4. Reinicia el servidor

---

## 📚 RECURSOS ADICIONALES

- **Documentación Laravel:** https://laravel.com/docs
- **Documentación PHP:** https://www.php.net/manual/es/
- **Documentación Composer:** https://getcomposer.org/doc/
- **Laravel Breeze:** https://laravel.com/docs/starter-kits#breeze
- **Tailwind CSS:** https://tailwindcss.com/docs
- **Alpine.js:** https://alpinejs.dev/

---

## ✅ VERIFICACIÓN FINAL

Para verificar que todo está instalado correctamente, ejecuta:

```powershell
# Verifica las herramientas
php --version          # Debe mostrar PHP 8.2+
composer --version     # Debe mostrar Composer 2.x
node --version         # Debe mostrar Node.js v18+
npm --version          # Debe mostrar npm

# Verifica el proyecto
cd GestionComunidad\gestion-comunidad
php artisan --version  # Debe mostrar Laravel 12.x

# Verifica extensiones PHP
php -m                 # Muestra todas las extensiones habilitadas
```

---

## 🔍 ESTRUCTURA DE ARCHIVOS DEL PROYECTO

```
GestionComunidad/
├── GestionComunidad/
│   └── gestion-comunidad/        # Proyecto Laravel principal
│       ├── app/                   # Código de la aplicación
│       ├── database/              # Migraciones, seeders y SQLite
│       ├── public/                # Archivos públicos
│       ├── resources/             # Vistas, CSS, JS
│       ├── routes/                # Definición de rutas
│       ├── storage/               # Logs, cache, archivos
│       ├── .env                   # Configuración (se crea automáticamente)
│       ├── artisan                # CLI de Laravel
│       ├── composer.json          # Dependencias PHP
│       └── package.json           # Dependencias JavaScript
├── GUIA_INSTALACION.md           # Esta guía
├── README.md                      # Documentación del proyecto
├── INICIO_RAPIDO.md              # Guía rápida
├── LEEME_PRIMERO.txt             # Archivo de bienvenida
├── setup-proyecto.ps1            # Script de configuración
├── verificar-entorno.ps1         # Script de verificación
└── iniciar-proyecto.ps1          # Script para iniciar
```

---

## 💡 CONSEJOS FINALES

1. **Usa el script de verificación** antes de empezar: `.\verificar-entorno.ps1`
2. **Lee los mensajes de error** cuidadosamente, suelen indicar qué falta
3. **Mantén PowerShell abierto** mientras trabajas en el proyecto
4. **Usa `composer dev`** para tener todo corriendo en una sola ventana
5. **Consulta los logs** en `storage/logs/laravel.log` si algo falla

---

¡Ya estás listo para comenzar a desarrollar! 🚀
