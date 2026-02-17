# Script de configuracion automatica para el proyecto Laravel
# GestionComunidad - Setup Script

Write-Host "================================================" -ForegroundColor Cyan
Write-Host "   CONFIGURACION DEL PROYECTO LARAVEL" -ForegroundColor Cyan
Write-Host "   GestionComunidad" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""

# Funcion para verificar si un comando existe
function Test-Command($cmdname) {
    return [bool](Get-Command -Name $cmdname -ErrorAction SilentlyContinue)
}

# Funcion para mostrar mensajes de exito
function Write-Success($message) {
    Write-Host "[OK] $message" -ForegroundColor Green
}

# Funcion para mostrar mensajes de error
function Write-Error-Custom($message) {
    Write-Host "[ERROR] $message" -ForegroundColor Red
}

# Funcion para mostrar mensajes de informacion
function Write-Info($message) {
    Write-Host "[INFO] $message" -ForegroundColor Yellow
}

# Paso 1: Verificar requisitos
Write-Host "Paso 1: Verificando requisitos..." -ForegroundColor Cyan
Write-Host ""

$allRequirementsMet = $true

# Verificar PHP
if (Test-Command "php") {
    $phpVersion = php -r "echo PHP_VERSION;"
    Write-Success "PHP instalado - Version: $phpVersion"
    
    # Verificar que sea al menos PHP 8.2
    $majorVersion = [int]($phpVersion.Split('.')[0])
    $minorVersion = [int]($phpVersion.Split('.')[1])
    
    if ($majorVersion -lt 8 -or ($majorVersion -eq 8 -and $minorVersion -lt 2)) {
        Write-Error-Custom "Se requiere PHP 8.2 o superior. Version actual: $phpVersion"
        $allRequirementsMet = $false
    }
} else {
    Write-Error-Custom "PHP no esta instalado o no esta en el PATH"
    $allRequirementsMet = $false
}

# Verificar Composer
if (Test-Command "composer") {
    $composerVersion = composer --version 2>&1 | Select-String -Pattern "Composer version" | ForEach-Object { $_.Line }
    Write-Success "Composer instalado - $composerVersion"
} else {
    Write-Error-Custom "Composer no esta instalado o no esta en el PATH"
    $allRequirementsMet = $false
}

# Verificar Node.js
if (Test-Command "node") {
    $nodeVersion = node --version
    Write-Success "Node.js instalado - Version: $nodeVersion"
} else {
    Write-Error-Custom "Node.js no esta instalado o no esta en el PATH"
    $allRequirementsMet = $false
}

# Verificar npm
if (Test-Command "npm") {
    $npmVersion = npm --version
    Write-Success "npm instalado - Version: $npmVersion"
} else {
    Write-Error-Custom "npm no esta instalado o no esta en el PATH"
    $allRequirementsMet = $false
}

Write-Host ""

if (-not $allRequirementsMet) {
    Write-Host "================================================" -ForegroundColor Red
    Write-Host "   FALTAN REQUISITOS" -ForegroundColor Red
    Write-Host "================================================" -ForegroundColor Red
    Write-Host ""
    Write-Host "Por favor, instala los requisitos faltantes siguiendo la guia:" -ForegroundColor Yellow
    Write-Host "GUIA_INSTALACION.md" -ForegroundColor Cyan
    Write-Host ""
    exit 1
}

# Paso 2: Navegar al directorio del proyecto
Write-Host "Paso 2: Navegando al directorio del proyecto..." -ForegroundColor Cyan
$projectPath = Join-Path $PSScriptRoot "gestion-comunidad"

if (Test-Path $projectPath) {
    Set-Location $projectPath
    Write-Success "Directorio del proyecto: $projectPath"
} else {
    Write-Error-Custom "No se encuentra el directorio del proyecto: $projectPath"
    exit 1
}

Write-Host ""

# Paso 3: Configurar archivo .env
Write-Host "Paso 3: Configurando archivo .env..." -ForegroundColor Cyan

if (-not (Test-Path ".env")) {
    if (Test-Path ".env.example") {
        Copy-Item ".env.example" ".env"
        Write-Success "Archivo .env creado desde .env.example"
    } else {
        Write-Error-Custom "No se encuentra el archivo .env.example"
        exit 1
    }
} else {
    Write-Info "El archivo .env ya existe, no se sobrescribira"
}

Write-Host ""

# Paso 4: Instalar dependencias de Composer
Write-Host "Paso 4: Instalando dependencias de Composer..." -ForegroundColor Cyan
Write-Info "Esto puede tardar varios minutos..."

composer install --no-interaction
if ($LASTEXITCODE -eq 0) {
    Write-Success "Dependencias de Composer instaladas correctamente"
} else {
    Write-Error-Custom "Error al instalar dependencias de Composer"
    exit 1
}

Write-Host ""

# Paso 5: Generar clave de aplicacion
Write-Host "Paso 5: Generando clave de aplicacion..." -ForegroundColor Cyan

php artisan key:generate
if ($LASTEXITCODE -eq 0) {
    Write-Success "Clave de aplicacion generada"
} else {
    Write-Error-Custom "Error al generar la clave de aplicacion"
}

Write-Host ""

# Paso 6: Crear base de datos SQLite
Write-Host "Paso 6: Configurando base de datos SQLite..." -ForegroundColor Cyan

$dbPath = Join-Path $projectPath "database\database.sqlite"
if (-not (Test-Path $dbPath)) {
    New-Item -ItemType File -Path $dbPath -Force | Out-Null
    Write-Success "Archivo de base de datos SQLite creado: database\database.sqlite"
} else {
    Write-Info "El archivo de base de datos ya existe"
}

Write-Host ""

# Paso 7: Ejecutar migraciones
Write-Host "Paso 7: Ejecutando migraciones de base de datos..." -ForegroundColor Cyan

php artisan migrate --force
if ($LASTEXITCODE -eq 0) {
    Write-Success "Migraciones ejecutadas correctamente"
} else {
    Write-Error-Custom "Error al ejecutar migraciones"
    Write-Info "Puedes ejecutarlas manualmente mas tarde con: php artisan migrate"
}

Write-Host ""

# Paso 8: Instalar dependencias de npm
Write-Host "Paso 8: Instalando dependencias de npm..." -ForegroundColor Cyan
Write-Info "Esto puede tardar varios minutos..."

npm install
if ($LASTEXITCODE -eq 0) {
    Write-Success "Dependencias de npm instaladas correctamente"
} else {
    Write-Error-Custom "Error al instalar dependencias de npm"
    exit 1
}

Write-Host ""

# Paso 9: Compilar assets
Write-Host "Paso 9: Compilando assets del frontend..." -ForegroundColor Cyan

npm run build
if ($LASTEXITCODE -eq 0) {
    Write-Success "Assets compilados correctamente"
} else {
    Write-Error-Custom "Error al compilar assets"
    Write-Info "Puedes compilarlos manualmente mas tarde con: npm run build"
}

Write-Host ""

# Verificar extensiones PHP necesarias
Write-Host "Paso 10: Verificando extensiones PHP..." -ForegroundColor Cyan

$requiredExtensions = @('mbstring', 'openssl', 'pdo', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath')
$missingExtensions = @()

foreach ($ext in $requiredExtensions) {
    $result = php -r "echo extension_loaded('$ext') ? 'yes' : 'no';"
    if ($result -eq "yes") {
        Write-Success "Extension $ext habilitada"
    } else {
        Write-Error-Custom "Extension $ext no esta habilitada"
        $missingExtensions += $ext
    }
}

Write-Host ""

# Resumen final
Write-Host "================================================" -ForegroundColor Green
Write-Host "   CONFIGURACION COMPLETADA" -ForegroundColor Green
Write-Host "================================================" -ForegroundColor Green
Write-Host ""

if ($missingExtensions.Count -gt 0) {
    Write-Host "[!] ADVERTENCIA: Faltan algunas extensiones PHP:" -ForegroundColor Yellow
    foreach ($ext in $missingExtensions) {
        Write-Host "  - $ext" -ForegroundColor Yellow
    }
    Write-Host ""
    Write-Host "Para habilitarlas, edita el archivo php.ini y descomenta las lineas:" -ForegroundColor Yellow
    foreach ($ext in $missingExtensions) {
        Write-Host "  extension=$ext" -ForegroundColor Cyan
    }
    Write-Host ""
}

Write-Host "El proyecto esta listo para usar!" -ForegroundColor Green
Write-Host ""
Write-Host "Para iniciar el servidor de desarrollo:" -ForegroundColor Cyan
Write-Host ""
Write-Host "  Opcion 1 (Recomendada) - Todo en uno:" -ForegroundColor Yellow
Write-Host "    composer dev" -ForegroundColor White
Write-Host ""
Write-Host "  Opcion 2 - Manual (en terminales separadas):" -ForegroundColor Yellow
Write-Host "    Terminal 1: php artisan serve" -ForegroundColor White
Write-Host "    Terminal 2: npm run dev" -ForegroundColor White
Write-Host ""
Write-Host "Luego visita: http://localhost:8000" -ForegroundColor Cyan
Write-Host ""
Write-Host "================================================" -ForegroundColor Green
