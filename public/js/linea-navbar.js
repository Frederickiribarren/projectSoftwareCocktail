document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelector(".nav-links");
    // Excluir enlaces del dropdown Y enlaces de autenticación (login/register)
    const links = document.querySelectorAll(".nav-link-main:not(.dropdown .nav-link-main)");

    if (!navLinks || links.length === 0) return;

    function updateIndicator(targetLink) {
        // Verificar que el enlace no esté dentro de un dropdown
        if (targetLink.closest('.dropdown')) {
            return; // No hacer nada si es un enlace de dropdown
        }
        
        // Verificar que no sea un enlace de autenticación
        const href = targetLink.getAttribute('href');
        if (href && (href.includes('login') || href.includes('register'))) {
            return; // No hacer nada si es un enlace de login o register
        }

        const navRect = navLinks.getBoundingClientRect();
        const linkRect = targetLink.getBoundingClientRect();

        // Calcular posición relativa del enlace dentro del nav
        const left = linkRect.left - navRect.left;
        const width = linkRect.width;

        // Aplicar estilos al indicador
        navLinks.style.setProperty("--indicator-left", left + "px");
        navLinks.style.setProperty("--indicator-width", width + "px");

        // Mostrar el indicador con animación
        navLinks.classList.add("show-indicator");
    }

    function hideIndicator() {
        navLinks.classList.remove("show-indicator");
    }

    // Eventos para cada enlace (excluyendo los de dropdown y autenticación)
    links.forEach((link) => {
        const href = link.getAttribute('href');
        // Solo agregar event listener si NO es un enlace de autenticación
        if (!href || (!href.includes('login') && !href.includes('register'))) {
            link.addEventListener("mouseenter", function () {
                updateIndicator(this);
            });
        }
    });

    // Ocultar cuando el mouse sale del navbar
    navLinks.addEventListener("mouseleave", hideIndicator);

    // También ocultar cuando se entra en un dropdown
    const dropdowns = document.querySelectorAll(".dropdown");
    dropdowns.forEach((dropdown) => {
        dropdown.addEventListener("mouseenter", hideIndicator);
    });

    // Ocultar cuando se hace hover en enlaces de autenticación
    const authLinks = document.querySelectorAll('a[href*="login"], a[href*="register"], .cta-button');
    authLinks.forEach((authLink) => {
        authLink.addEventListener("mouseenter", hideIndicator);
    });

    // Marcar enlace activo según la página actual
    const currentPath = window.location.pathname;
    links.forEach((link) => {
        const href = link.getAttribute("href");
        // Solo aplicar lógica de activo a enlaces que NO sean de autenticación
        if (href && !href.includes('login') && !href.includes('register')) {
            if (
                href === currentPath ||
                (currentPath === "/" && href === '{{ route("inicio") }}') ||
                (currentPath.includes("dashboard") &&
                    href === '{{ route("dashboard") }}')
            ) {
                link.classList.add("active");
                // Mostrar indicador en el enlace activo por defecto
                setTimeout(() => updateIndicator(link), 100);
            }
        }
    });
});
