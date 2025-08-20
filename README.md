# Project Software Cocktail

![Version](https://img.shields.io/badge/version-v1.2.0-blue.svg)
![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

Una aplicación web para descubrir, crear y compartir recetas de cócteles. Este proyecto está diseñado para ser una plataforma central para entusiastas de la coctelería y bartenders profesionales.

## 📋 Tabla de Contenidos

- [Versionado](#-versionado)
- [Descripción](#-descripción)
- [Características Principales](#-características-principales)
- [Stack Tecnológico](#-stack-tecnológico)
- [Instalación](#-instalación)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Changelog](#-changelog)
- [Contribuciones](#-contribuciones)
- [Licencia](#-licencia)

## 🏷️ Versionado

Este proyecto sigue el estándar de [Semantic Versioning](https://semver.org/) (SemVer):

- **MAJOR.MINOR.PATCH** (ej: 1.2.0)
- Las versiones se basan en commits hacia la rama `main`
- Cada versión incluye un changelog detallado

### Versión Actual: **v1.2.0** 
*Última actualización: 20 de agosto de 2025*

## 📖 Descripción

**Software Cocktail** es una plataforma completa de gestión de cócteles que permite a los usuarios explorar, crear y administrar recetas. Con funcionalidades avanzadas de administración de base de datos, gestión de inventario personal y un sistema de viajes optimizado para bartenders.

## ✨ Características Principales

### 🔥 Funcionalidades Core
-   🔍 **Búsqueda Avanzada:** Filtrado inteligente por ingredientes, nombre, categoría y tipo de preparación
-   👤 **Gestión de Usuarios:** Sistema completo de perfiles con autenticación Laravel Breeze
-   🍹 **Base de Datos Extensa:** Catálogo completo de cócteles con integración de APIs externas
-   📱 **Diseño Responsivo:** Interfaz optimizada para desktop, tablet y móvil con CSS Grid/Flexbox

### 🚀 Funcionalidades Avanzadas *(v1.2.0)*
-   🏠 **Mi Bar Personal:** Gestión completa de inventario de ingredientes con control de stock
-   ✈️ **Modo Viaje:** Optimización de recetas basada en ingredientes disponibles localmente
-   🛠️ **Panel de Administración:** CRUD completo para gestión de base de datos con interfaz AJAX
-   📊 **Dashboard Inteligente:** Estadísticas personalizadas y análisis de uso
-   🎨 **Sistema de Temas:** Variables CSS centralizadas con resetHtml.css

## 🛠️ Stack Tecnológico

### Backend
-   **Framework:** Laravel 10.x con PHP 8.1+
-   **Base de Datos:** MySQL con Eloquent ORM
-   **Autenticación:** Laravel Breeze
-   **APIs:** Integración con The Cocktail DB API

### Frontend
-   **CSS Framework:** Sistema personalizado con variables CSS
-   **JavaScript:** ES6+ con AJAX para funcionalidades dinámicas
-   **Icons:** Font Awesome 6.x
-   **Build Tool:** Vite para compilación de assets

### Desarrollo
-   **Entorno Local:** Laragon (recomendado)
-   **Control de Versiones:** Git con estructura GitFlow
-   **Package Manager:** Composer (PHP) + NPM (JavaScript)

## 🚀 Instalación

### Prerrequisitos
- [Laragon](https://laragon.org/) o equivalente (XAMPP, WAMP)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (v16 o superior)
- MySQL 8.0+

### Pasos de Instalación

1.  **Clona el repositorio:**
    ```bash
    git clone https://github.com/Frederickiribarren/projectSoftwareCocktail.git
    cd projectSoftwareCocktail
    ```

2.  **Instala dependencias PHP:**
    ```bash
    composer install
    ```

3.  **Instala dependencias JavaScript:**
    ```bash
    npm install
    ```

4.  **Configura el entorno:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Configura la base de datos:**
    Edita `.env` con tus credenciales de MySQL y ejecuta:
    ```bash
    php artisan migrate --seed
    ```

6.  **Compila assets:**
    ```bash
    npm run dev
    # o para producción: npm run build
    ```

7.  **Accede a la aplicación:**
    URL: `http://projectsoftwarecocktail.test` (Laragon)

## 📁 Estructura del Proyecto

```
projectSoftwareCocktail/
├── app/
│   ├── Http/Controllers/
│   │   ├── DatabaseAdminController.php    # Administración de BD
│   │   ├── IngredientsController.php      # Gestión de inventario
│   │   └── RecipeController.php           # CRUD de recetas
│   └── Models/                            # Modelos Eloquent
├── resources/
│   ├── views/
│   │   ├── pages/
│   │   │   ├── dashboard.blade.php        # Panel principal
│   │   │   ├── database-admin.blade.php   # Admin de BD
│   │   │   ├── inventory.blade.php        # Mi Bar
│   │   │   └── travel.blade.php           # Modo Viaje
│   │   └── layouts/
│   │       └── app.blade.php              # Layout principal
│   └── css/
│       ├── resetHtml.css                  # Variables CSS globales
│       ├── dashboard.css                  # Estilos del dashboard
│       └── database-admin.css             # Estilos de administración
└── routes/
    └── web.php                            # Rutas de la aplicación
```

## 📝 Changelog

### v1.2.0 *(20 de agosto de 2025)*
#### 🚀 Nuevas Funcionalidades
- **Panel de Administración de BD:** CRUD completo con interfaz AJAX
- **Sistema de Variables CSS:** Implementación de resetHtml.css para consistencia
- **Gestión de Inventario:** Mi Bar con control de stock y categorías
- **Modo Viaje:** Optimización de recetas por disponibilidad de ingredientes

#### 🔧 Mejoras Técnicas
- Refactorización de vistas para extender layout principal
- Implementación de AJAX para operaciones dinámicas
- Sistema de paginación y búsqueda en tiempo real
- Optimización de rutas y controladores

#### 🎨 Mejoras de UI/UX
- Interfaz unificada con variables CSS centralizadas
- Modales mejorados con mejor UX
- Cards estadísticas en dashboard
- Navegación sidebar comentada para futuras mejoras

### v1.1.0 *(Commit anterior)*
#### 🔧 Funcionalidades Base
- Sistema de autenticación con Laravel Breeze
- CRUD básico de recetas
- Gestión de usuarios
- Integración con APIs externas

### v1.0.0 *(Release inicial)*
#### 🎯 MVP
- Estructura básica del proyecto
- Configuración inicial de Laravel
- Diseño responsivo base
- Sistema de rutas fundamental

## 🤝 Contribuciones

### Workflow de Desarrollo
1. **Fork** el repositorio
2. Crea una rama desde `develop`: `git checkout -b feature/nueva-funcionalidad`
3. Realiza tus cambios con commits descriptivos
4. Ejecuta tests: `php artisan test`
5. Push a tu rama: `git push origin feature/nueva-funcionalidad`
6. Abre un **Pull Request** hacia `develop`

### Estándares de Código
- Seguir PSR-12 para PHP
- Usar convenciones de Laravel
- Mantener consistencia en CSS con variables centralizadas
- Documentar cambios en el CHANGELOG

### Versionado de Commits
- **feat:** Nueva funcionalidad
- **fix:** Corrección de bugs
- **refactor:** Refactorización de código
- **style:** Cambios de estilo/CSS
- **docs:** Actualización de documentación

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo `LICENSE` para más detalles.

---

**Proyecto desarrollado con ❤️ para la comunidad de coctelería**

*Última actualización del README: 20 de agosto de 2025*
