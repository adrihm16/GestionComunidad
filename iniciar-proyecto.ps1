# Script para iniciar el proyecto Laravel de manera facil
# GestionComunidad - Inicio rapido

$ErrorActionPreference = "Stop"

Write-Host "================================================" -ForegroundColor Cyan
Write-Host "   INICIANDO GESTIONCOMUNIDAD" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""

# Funcion para verificar si un comando existe
function Test-Command($cmdname) {
    return [bool](Get-Command -Name $cmdname -ErrorAction SilentlyContinue)
}

# Verificar requisitos basicos
if (-not (Test-Command "php")) {
    Write-Host "[ERROR] PHP no esta instalado" -ForegroundColor Red
    Write-Host ""
    Write-Host "Por favor, ejecuta primero:" -ForegroundColor Yellow
    Write-Host "  .\verificar-entorno.ps1" -ForegroundColor Cyan
    Write-Host ""
    exit 1
}

if (-not (Test-Command "composer")) {
    Write-Host "[ERROR] Composer no esta instalado" -ForegroundColor Red
    Write-Host ""
    Write-Host "Por favor, ejecuta primero:" -ForegroundColor Yellow
    Write-Host "  .\verificar-entorno.ps1" -ForegroundColor Cyan
    Write-Host ""
    exit 1
}

# Navegar al directorio del proyecto
$projectPath = Join-Path $PSScriptRoot "gestion-comunidad"

if (-not (Test-Path $projectPath)) {
    Write-Host "[ERROR] No se encuentra el directorio del proyecto" -ForegroundColor Red
    Write-Host ""
    Write-Host "Ubicacion esperada:" -ForegroundColor Yellow
    Write-Host "  $projectPath" -ForegroundColor Gray
    Write-Host ""
    exit 1
}

Set-Location $projectPath

# Verificar que el proyecto este configurado
if (-not (Test-Path ".env")) {
    Write-Host "[ERROR] El proyecto no esta configurado" -ForegroundColor Red
    Write-Host ""
    Write-Host "Por favor, ejecuta primero:" -ForegroundColor Yellow
    Write-Host "  .\setup-proyecto.ps1" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "(Desde la carpeta raiz del proyecto)" -ForegroundColor Gray
    Write-Host ""
    exit 1
}

if (-not (Test-Path "vendor")) {
    Write-Host "[ERROR] Faltan las dependencias de Composer" -ForegroundColor Red
    Write-Host ""
    Write-Host "Por favor, ejecuta primero:" -ForegroundColor Yellow
    Write-Host "  .\setup-proyecto.ps1" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "(Desde la carpeta raiz del proyecto)" -ForegroundColor Gray
    Write-Host ""
    exit 1
}

# Mostrar opciones
Write-Host "Selecciona como deseas iniciar el proyecto:" -ForegroundColor Yellow
Write-Host ""
Write-Host "  [1] Todo en uno (Recomendado)" -ForegroundColor Cyan
Write-Host "      Inicia servidor, cola, logs y Vite en una ventana" -ForegroundColor Gray
Write-Host ""
Write-Host "  [2] Solo servidor PHP" -ForegroundColor Cyan
Write-Host "      Inicia solo el servidor de Laravel en http://localhost:8000" -ForegroundColor Gray
Write-Host ""
Write-Host "  [3] Solo Vite (dev)" -ForegroundColor Cyan
Write-Host "      Inicia solo el servidor de desarrollo de Vite" -ForegroundColor Gray
Write-Host ""
Write-Host "  [4] Compilar assets (build)" -ForegroundColor Cyan
Write-Host "      Compila los assets para produccion" -ForegroundColor Gray
Write-Host ""

$option = Read-Host "Ingresa tu opcion (1-4)"

Write-Host ""
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""

switch ($option) {
    "1" {
        Write-Host "[OK] Iniciando proyecto completo..." -ForegroundColor Green
        Write-Host ""
        Write-Host "El proyecto estara disponible en:" -ForegroundColor Yellow
        Write-Host "  http://localhost:8000" -ForegroundColor Cyan
        Write-Host ""
        Write-Host "Servicios que se iniciaran:" -ForegroundColor Gray
        Write-Host "  - Servidor PHP Laravel" -ForegroundColor Gray
        Write-Host "  - Cola de trabajos" -ForegroundColor Gray
        Write-Host "  - Logs en tiempo real" -ForegroundColor Gray
        Write-Host "  - Vite dev server (hot reload)" -ForegroundColor Gray
        Write-Host ""
        Write-Host "Presiona Ctrl+C para detener todos los servicios" -ForegroundColor Gray
        Write-Host ""
        
        composer dev
    }
    "2" {
        Write-Host "[OK] Iniciando servidor PHP..." -ForegroundColor Green
        Write-Host ""
        Write-Host "El servidor estara disponible en:" -ForegroundColor Yellow
        Write-Host "  http://localhost:8000" -ForegroundColor Cyan
        Write-Host ""
        Write-Host "[NOTA] Los cambios de CSS/JS no se recargaran automaticamente" -ForegroundColor Yellow
        Write-Host "Para hot reload, ejecuta 'npm run dev' en otra terminal" -ForegroundColor Gray
        Write-Host ""
        Write-Host "Presiona Ctrl+C para detener el servidor" -ForegroundColor Gray
        Write-Host ""
        
        php artisan serve
    }
    "3" {
        Write-Host "[OK] Iniciando Vite dev server..." -ForegroundColor Green
        Write-Host ""
        Write-Host "[NOTA] Esto solo compila los assets con hot reload" -ForegroundColor Yellow
        Write-Host "Necesitas tambien ejecutar 'php artisan serve' en otra terminal" -ForegroundColor Gray
        Write-Host "O usa la opcion 1 para iniciar todo junto" -ForegroundColor Gray
        Write-Host ""
        Write-Host "Presiona Ctrl+C para detener Vite" -ForegroundColor Gray
        Write-Host ""
        
        npm run dev
    }
    "4" {
        Write-Host "[OK] Compilando assets para produccion..." -ForegroundColor Green
        Write-Host ""
        
        npm run build
        
        if ($LASTEXITCODE -eq 0) {
            Write-Host ""
            Write-Host "[OK] Assets compilados correctamente" -ForegroundColor Green
            Write-Host ""
            Write-Host "Los archivos compilados estan en:" -ForegroundColor Gray
            Write-Host "  public/build/" -ForegroundColor Gray
            Write-Host ""
        } else {
            Write-Host ""
            Write-Host "[ERROR] Error al compilar assets" -ForegroundColor Red
            Write-Host "Revisa los mensajes de error arriba" -ForegroundColor Yellow
            Write-Host ""
        }
    }
    default {
        Write-Host "[ERROR] Opcion no valida" -ForegroundColor Red
        Write-Host ""
        Write-Host "Ejecuta el script nuevamente y selecciona 1, 2, 3 o 4" -ForegroundColor Yellow
        Write-Host ""
        exit 1
    }
}
