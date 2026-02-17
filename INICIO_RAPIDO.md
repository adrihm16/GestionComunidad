# ⚡ Inicio Rápido - GestionComunidad

## 🎯 Guía express en 4 pasos

### Paso 1: Verificar qué tienes instalado

Abre PowerShell en la carpeta del proyecto y ejecuta:

```powershell
.\verificar-entorno.ps1
```

Este script te mostrará exactamente qué tienes y qué te falta.

---

### Paso 2: Instalar lo que falta

#### ¿Qué necesitas?

- **PHP 8.2+** ❌
- **Composer** ❌
- **Node.js** (probablemente ya lo tienes ✅)

#### Instalación rápida de PHP:

1. **Descargar PHP 8.3:**
   - Ve a: https://windows.php.net/download/
   - Descarga: `PHP 8.3 VS16 x64 Thread Safe` (archivo .zip)

2. **Extraer a `C:\php`:**
   - Crea la carpeta `C:\php`
   - Extrae todo el contenido del .zip ahí

3. **Configurar:**
   ```powershell
   cd C:\php
   copy php.ini-development php.ini
   ```

4. **Editar `C:\php\php.ini`** - Descomentar (quitar `;` al inicio):
   ```ini
   extension=curl
   extension=fileinfo
   extension=mbstring
   extension=openssl
   extension=pdo_sqlite
   extension=sqlite3
   extension=zip
   ```

5. **Agregar al PATH:**
   - Método rápido con PowerShell (como Administrador):
   ```powershell
   [Environment]::SetEnvironmentVariable("Path", $env:Path + ";C:\php", [EnvironmentVariableTarget]::Machine)
   ```
   
   - O método manual:
     - Win + X → Sistema → Configuración avanzada
     - Variables de entorno → Path → Nuevo → `C:\php`

6. **Verificar:**
   - Abre un **nuevo** PowerShell
   - `php --version`

#### Instalación rápida de Composer:

1. **Descargar:**
   - Ve a: https://getcomposer.org/download/
   - Descarga: `Composer-Setup.exe`

2. **Instalar:**
   - Ejecuta el instalador
   - En "Proxy Settings": **desmarca** la casilla (a menos que uses proxy)
   - Sigue los pasos (detectará PHP automáticamente)

3. **Verificar:**
   - Abre un **nuevo** PowerShell
   - `composer --version`

---

### Paso 3: Configurar el proyecto

Una vez que tengas PHP y Composer:

```powershell
.\setup-proyecto.ps1
```

Este script hace todo automáticamente:
- ✅ Crea el archivo .env
- ✅ Instala todas las dependencias (Composer + npm)
- ✅ Configura la base de datos
- ✅ Ejecuta las migraciones
- ✅ Compila los assets

**Tiempo estimado:** 2-5 minutos

---

### Paso 4: ¡Ejecutar!

```powershell
cd GestionComunidad\gestion-comunidad
composer dev
```

Abre tu navegador en: **http://localhost:8000**

---

## 🆘 ¿Problemas?

### "php no se reconoce..."
1. Cierra y abre un **nuevo** PowerShell
2. Verifica el PATH con: `echo $env:Path`
3. Debe incluir `C:\php`

### "composer no se reconoce..."
1. Cierra y abre un **nuevo** PowerShell
2. Si instalaste manualmente, asegúrate de que `composer.bat` esté en `C:\php`

### Otros problemas
Consulta: `GUIA_INSTALACION.md` - Sección "Solución de problemas"

---

## 📊 Resumen Visual

```
┌─────────────────────────────────────────┐
│  1. ¿Qué tengo instalado?              │
│     .\verificar-entorno.ps1            │
└─────────────────────────────────────────┘
              ↓
┌─────────────────────────────────────────┐
│  2. Instalar PHP y Composer            │
│     Ver instrucciones arriba           │
└─────────────────────────────────────────┘
              ↓
┌─────────────────────────────────────────┐
│  3. Configurar proyecto                │
│     .\setup-proyecto.ps1               │
└─────────────────────────────────────────┘
              ↓
┌─────────────────────────────────────────┐
│  4. Ejecutar                           │
│     composer dev                       │
└─────────────────────────────────────────┘
              ↓
        🎉 ¡Listo!
   http://localhost:8000
```

---

## 📝 Tiempo estimado total

- **Si ya tienes PHP y Composer:** 5-10 minutos
- **Si necesitas instalar todo:** 20-30 minutos

---

## ✅ Checklist

- [ ] Node.js instalado
- [ ] PHP 8.2+ instalado
- [ ] Composer instalado
- [ ] PHP agregado al PATH
- [ ] Extensiones PHP habilitadas
- [ ] Script setup-proyecto.ps1 ejecutado
- [ ] Servidor corriendo con `composer dev`
- [ ] Navegador abierto en http://localhost:8000

---

## 🚀 Comandos importantes

```powershell
# Verificar instalación
php --version
composer --version
node --version

# Configurar proyecto (solo primera vez)
.\setup-proyecto.ps1

# Iniciar servidor
composer dev

# Ver rutas de la aplicación
php artisan route:list

# Crear nuevo modelo
php artisan make:model NombreModelo

# Ejecutar migraciones
php artisan migrate
```

---

**¿Listo? ¡Comencemos!** 🚀

Para más detalles, consulta:
- **README.md** - Documentación completa
- **GUIA_INSTALACION.md** - Guía detallada con solución de problemas
