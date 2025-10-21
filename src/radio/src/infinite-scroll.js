document.addEventListener('DOMContentLoaded', () => {
    const scrollTexts = document.getElementById('scroll-about-texts');
    const scrollSpeed = 1; // Velocidad del scroll (ajusta según sea necesario)

    // Duplica el contenido si no es suficiente para llenar el contenedor
    function duplicateContent() {
        const contentWidth = scrollTexts.scrollWidth;
        const containerWidth = scrollTexts.clientWidth;

        if (contentWidth < containerWidth * 2) {
            const clone = scrollTexts.innerHTML; // Clona el contenido actual
            scrollTexts.innerHTML += clone; // Añade el contenido clonado
            duplicateContent(); // Llama recursivamente hasta que sea suficiente
        }
    }

    duplicateContent(); // Asegúrate de que haya suficiente contenido

    // Función para el scroll automático
    function autoScroll() {
        if (scrollTexts.scrollLeft >= scrollTexts.scrollWidth / 2) {
            scrollTexts.scrollLeft = 0; // Reinicia el scroll al inicio
        } else {
            scrollTexts.scrollLeft += scrollSpeed; // Incrementa el scroll
        }
    }

    setInterval(autoScroll, 20); // Ajusta el intervalo para controlar la fluidez
});