# Script para verificar el estado del entorno de desarrollo
# GestionComunidad - Verificacion de Entorno

Write-Host "================================================" -ForegroundColor Cyan
Write-Host "   VERIFICACION DE ENTORNO" -ForegroundColor Cyan
Write-Host "   GestionComunidad" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""

# Funcion para verificar si un comando existe
function Test-Command($cmdname) {
    return [bool](Get-Command -Name $cmdname -ErrorAction SilentlyContinue)
}

# Funcion para mostrar el estado
function Show-Status($name, $installed, $version) {
    $status = if ($installed) { "[OK]" } else { "[NO]" }
    $color = if ($installed) { "Green" } else { "Red" }
    $statusText = if ($installed) { "INSTALADO" } else { "NO INSTALADO" }
    
    Write-Host "$status $name : " -NoNewline -ForegroundColor $color
    Write-Host "$statusText" -NoNewline -ForegroundColor $color
    
    if ($version) {
        Write-Host " - $version" -ForegroundColor Gray
    } else {
        Write-Host ""
    }
}

Write-Host "HERRAMIENTAS DEL SISTEMA:" -ForegroundColor Yellow
Write-Host ""

# Verificar PHP
if (Test-Command "php") {
    $phpVersion = php -r "echo PHP_VERSION;"
    Show-Status "PHP" $true $phpVersion
    
    # Verificar version minima
    $majorVersion = [int]($phpVersion.Split('.')[0])
    $minorVersion = [int]($phpVersion.Split('.')[1])
    
    if ($majorVersion -lt 8 -or ($majorVersion -eq 8 -and $minorVersion -lt 2)) {
        Write-Host "  ADVERTENCIA: Se requiere PHP 8.2 o superior" -ForegroundColor Yellow
    }
} else {
    Show-Status "PHP" $false
}

# Verificar Composer
if (Test-Command "composer") {
    $composerVersion = composer --version 2>&1 | Select-String -Pattern "(\d+\.\d+\.\d+)" | ForEach-Object { $_.Matches.Groups[1].Value }
    Show-Status "Composer" $true $composerVersion
} else {
    Show-Status "Composer" $false
}

# Verificar Node.js
if (Test-Command "node") {
    $nodeVersion = node --version
    Show-Status "Node.js" $true $nodeVersion
} else {
    Show-Status "Node.js" $false
}

# Verificar npm
if (Test-Command "npm") {
    $npmVersion = npm --version
    Show-Status "npm" $true $npmVersion
} else {
    Show-Status "npm" $false
}

Write-Host ""
Write-Host "EXTENSIONES PHP:" -ForegroundColor Yellow
Write-Host ""

if (Test-Command "php") {
    $extensions = @(
        'mbstring', 'openssl', 'pdo', 'pdo_sqlite', 'sqlite3',
        'tokenizer', 'xml', 'ctype', 'json', 'bcmath',
        'fileinfo', 'curl', 'zip'
    )
    
    foreach ($ext in $extensions) {
        $result = php -r "echo extension_loaded('$ext') ? 'yes' : 'no';"
        $installed = $result -eq "yes"
        Show-Status $ext $installed
    }
} else {
    Write-Host "No se puede verificar (PHP no instalado)" -ForegroundColor Red
}

Write-Host ""
Write-Host "ESTADO DEL PROYECTO:" -ForegroundColor Yellow
Write-Host ""

$projectPath = Join-Path $PSScriptRoot "gestion-comunidad"

# Verificar carpeta del proyecto
if (Test-Path $projectPath) {
    Show-Status "Carpeta del proyecto" $true $projectPath
    
    # Verificar archivos importantes
    Push-Location $projectPath
    
    # .env
    $envExists = Test-Path ".env"
    Show-Status "Archivo .env" $envExists
    
    # vendor (dependencias de Composer)
    $vendorExists = Test-Path "vendor"
    Show-Status "Dependencias Composer (vendor/)" $vendorExists
    
    # node_modules
    $nodeModulesExists = Test-Path "node_modules"
    Show-Status "Dependencias npm (node_modules/)" $nodeModulesExists
    
    # Base de datos SQLite
    $dbExists = Test-Path "database\database.sqlite"
    Show-Status "Base de datos SQLite" $dbExists
    
    # Verificar si Laravel esta instalado
    if ($vendorExists -and (Test-Command "php")) {
        $laravelVersion = php artisan --version 2>&1 | Out-String
        if ($laravelVersion -match "Laravel Framework (\d+\.\d+\.\d+)") {
            Show-Status "Laravel Framework" $true $matches[1]
        }
    }
    
    Pop-Location
} else {
    Show-Status "Carpeta del proyecto" $false
}

Write-Host ""
Write-Host "================================================" -ForegroundColor Cyan

# Determinar si el entorno esta listo
$allReady = (Test-Command "php") -and (Test-Command "composer") -and (Test-Command "node") -and (Test-Command "npm")

if ($allReady) {
    $projectReady = (Test-Path $projectPath) -and (Test-Path (Join-Path $projectPath ".env")) -and (Test-Path (Join-Path $projectPath "vendor"))
    
    if ($projectReady) {
        Write-Host ""
        Write-Host "[OK] El entorno esta COMPLETO y listo para desarrollar!" -ForegroundColor Green
        Write-Host ""
        Write-Host "Para iniciar el proyecto:" -ForegroundColor Cyan
        Write-Host "  cd GestionComunidad\gestion-comunidad" -ForegroundColor White
        Write-Host "  composer dev" -ForegroundColor White
        Write-Host ""
    } else {
        Write-Host ""
        Write-Host "[!] El entorno basico esta instalado, pero falta configurar el proyecto" -ForegroundColor Yellow
        Write-Host ""
        Write-Host "Ejecuta el script de configuracion:" -ForegroundColor Cyan
        Write-Host "  .\setup-proyecto.ps1" -ForegroundColor White
        Write-Host ""
    }
} else {
    Write-Host ""
    Write-Host "[X] Faltan herramientas por instalar" -ForegroundColor Red
    Write-Host ""
    Write-Host "Consulta la guia de instalacion:" -ForegroundColor Cyan
    Write-Host "  GUIA_INSTALACION.md" -ForegroundColor White
    Write-Host ""
}

Write-Host "================================================" -ForegroundColor Cyan
