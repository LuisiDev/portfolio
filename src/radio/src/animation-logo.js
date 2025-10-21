function setTextAnimation(delay, duration, strokeWidth, timingFunction, strokeColor, repeat) {
    // Seleccionar solo el SVG del logo usando su ID específico
    const logo = document.querySelector("#svgGroup");
    if (!logo) return;
    
    // Seleccionar solo los paths dentro de este SVG
    let paths = logo.querySelectorAll("path");
    let mode = repeat ? 'infinite' : 'forwards';
    
    for (let i = 0; i < paths.length; i++) {
        const path = paths[i];
        const length = path.getTotalLength();
        path.style["stroke-dashoffset"] = `${length}px`;
        path.style["stroke-dasharray"] = `${length}px`;
        path.style["stroke-width"] = `${strokeWidth}px`;
        path.style["stroke"] = `${strokeColor}`;
        path.style["animation"] = `${duration}s svg-text-anim ${mode} ${timingFunction}`;
        path.style["animation-delay"] = `${i * delay}s`;
    }
}

// Llamar a la función después de que el DOM esté cargado
document.addEventListener('DOMContentLoaded', () => {
    setTextAnimation(0.1, 1.1, 1, 'linear', '#ffffff', false);
});