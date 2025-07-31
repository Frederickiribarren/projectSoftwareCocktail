# Project Software Cocktail

Una aplicación web para descubrir, crear y compartir recetas de cócteles. Este proyecto está diseñado para ser una plataforma central para entusiastas de la coctelería y bartenders profesionales.

## Tabla de Contenidos

- [Descripción](#descripción)
- [Características](#características)
- [Stack Tecnológico](#stack-tecnológico)
- [Prerrequisitos](#prerrequisitos)
- [Instalación](#instalación)
- [Uso](#uso)
- [Contribuciones](#contribuciones)
- [Licencia](#licencia)
- [Contacto](#contacto)

## Descripción

**Software Cocktail** es una plataforma que permite a los usuarios explorar una vasta colección de recetas de cócteles. Los usuarios pueden buscar por ingrediente, nombre o tipo de cóctel. Además, ofrece la posibilidad de que los usuarios registrados guarden sus recetas favoritas y suban las suyas propias.

## Características

-   🔍 **Búsqueda Avanzada:** Filtra cócteles por ingredientes, nombre, o categoría.
-   👤 **Perfiles de Usuario:** Guarda tus cócteles favoritos y gestiona tus propias recetas.
-   🍹 **Base de Datos Extensa:** Accede a cientos de recetas de cócteles de todo el mundo.
-   📱 **Diseño Responsivo:** Disfruta de la aplicación en cualquier dispositivo, ya sea de escritorio, tableta o móvil.
-   ➕ **Añadir Recetas:** Los usuarios registrados pueden contribuir añadiendo nuevas recetas a la plataforma.

## Stack Tecnológico

Este proyecto está construido utilizando las siguientes tecnologías:

-   **Backend:** PHP 8.1 con [Laravel](https://laravel.com/) 10
-   **Frontend:** [Vue.js](https://vuejs.org/) con [Vite](https://vitejs.dev/)
-   **Base de Datos:** MySQL
-   **Servidor Web:** Nginx (gestionado a través de [Laragon](https://laragon.org/))
-   **Estilos:** [Tailwind CSS](https://tailwindcss.com/)

## Prerrequisitos

Antes de empezar, asegúrate de tener instalado el siguiente software:

-   [Laragon](https://laragon.org/download.html) o un entorno de desarrollo local equivalente (XAMPP, WAMP).
-   [Composer](https://getcomposer.org/download/)
-   [Node.js y npm](https://nodejs.org/en/)

## Instalación

Sigue estos pasos para configurar el proyecto en tu entorno local:

1.  **Clona el repositorio:**
    ```bash
    git clone https://github.com/tu-usuario/projectSoftwareCocktail.git
    cd projectSoftwareCocktail
    ```

2.  **Instala las dependencias de PHP:**
    ```bash
    composer install
    ```

3.  **Instala las dependencias de JavaScript:**
    ```bash
    npm install
    ```

4.  **Configura el entorno:**
    Copia el archivo `.env.example` a `.env` y configura tus variables de entorno, especialmente la conexión a la base de datos.
    ```bash
    copy .env.example .env
    ```
    Luego, genera la clave de la aplicación:
    ```bash
    php artisan key:generate
    ```

5.  **Ejecuta las migraciones y seeders:**
    Esto creará la estructura de la base de datos y la llenará con datos iniciales.
    ```bash
    php artisan migrate --seed
    ```

6.  **Compila los assets del frontend:**
    ```bash
    npm run dev
    ```

7.  **Accede a la aplicación:**
    Si usas Laragon, la URL debería ser algo como `http://projectsoftwarecocktail.test`.

## Uso

Una vez instalado, puedes navegar a la URL de tu proyecto.
-   **Visitante:** Explora y busca cócteles.
-   **Usuario Registrado:** Inicia sesión para guardar favoritos y añadir tus propias recetas.

## Contribuciones

Las contribuciones son bienvenidas. Si deseas colaborar, por favor sigue estos pasos:

1.  Haz un **Fork** de este repositorio.
2.  Crea una nueva rama (`git checkout -b feature/nueva-caracteristica`).
3.  Realiza tus cambios y haz **Commit** (`git commit -m 'Añade nueva característica'`).
4.  Haz **Push** a tu rama (`git push origin feature/nueva-caracteristica`).
5.  Abre un **Pull Request**.

## Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo `LICENSE` para más detalles.

## Contacto

-   **Autor del Proyecto:** [Tu Nombre] - [tu-email@example.com]
-   **Enlace del Proyecto:** [https://github.com/tu-usuario/projectSoftwareCocktail](https://github.com/tu-usuario/projectSoftwareCocktail)
