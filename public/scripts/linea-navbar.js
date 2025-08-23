document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelector(".nav-links");
    const links = document.querySelectorAll(".nav-link-main");

    if (!navLinks || links.length === 0) return;

    function updateIndicator(targetLink) {
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

    // Eventos para cada enlace
    links.forEach((link) => {
        link.addEventListener("mouseenter", function () {
            updateIndicator(this);
        });
    });

    // Ocultar cuando el mouse sale del navbar
    navLinks.addEventListener("mouseleave", hideIndicator);

    // Marcar enlace activo según la página actual
    const currentPath = window.location.pathname;
    links.forEach((link) => {
        const href = link.getAttribute("href");
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
    });
});
