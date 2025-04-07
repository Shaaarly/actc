import * as bootstrap from 'bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    // Inicializa todos los tooltips de la página
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });

    const toggleButton = document.getElementById('toggleMode');

    toggleButton.addEventListener('click', function() {
        // Alterna la clase 'dark-mode' en el <body>
        document.body.classList.toggle('dark-mode');

        // Obtén la instancia del tooltip de este botón
        const tooltip = bootstrap.Tooltip.getInstance(toggleButton);
        
        // Si el body tiene la clase 'dark-mode', significa que ya estás en modo oscuro,
        // por lo que el tooltip debe indicar que se puede cambiar a modo claro.
        if (document.body.classList.contains('dark-mode')) {
            toggleButton.setAttribute('data-bs-original-title', 'Cambiar a modo claro');
            toggleButton.classList = 'btn btn-outline-light btn-lg';
            // También puedes cambiar el icono, por ejemplo, a una 'sun' (sol)
            toggleButton.innerHTML = '<i class="fa-solid fa-sun"></i>';
        } else {
            toggleButton.setAttribute('data-bs-original-title', 'Cambiar a modo oscuro');
            toggleButton.innerHTML = '<i class="fa-solid fa-moon"></i>';
            toggleButton.classList = 'btn btn-outline-dark btn-lg';
        }

        // Para actualizar inmediatamente el tooltip (en caso de que ya esté visible)
        tooltip.hide();
        tooltip.show();
    });
});