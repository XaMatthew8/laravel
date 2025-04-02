// Función simple para el scroll
function scrollCarousel(carouselId, direction) {
    const container = document.getElementById(carouselId);
    if (!container) return;
    
    // Scroll suave
    const scrollAmount = 300;
    const currentScroll = container.scrollLeft;
    const targetScroll = currentScroll + (direction * scrollAmount);
    
    container.scrollTo({
        left: targetScroll,
        behavior: 'smooth'
    });
}

// Función para inicializar los carruseles
function initCarousels() {
    // Buscar todos los botones
    const buttons = document.querySelectorAll('button[data-carousel]');
    
    // Agregar eventos de click
    buttons.forEach(button => {
        const carouselId = button.getAttribute('data-carousel');
        const direction = parseInt(button.getAttribute('data-direction'));
        
        // Agregar evento de click
        button.addEventListener('click', function(e) {
            e.preventDefault();
            scrollCarousel(carouselId, direction);
        });
    });
}

// Inicializar cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCarousels);
} else {
    initCarousels();
} 
