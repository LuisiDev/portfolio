// Ejemplo de uso del Smooth Scroll con GSAP
// Importa las funciones que necesites desde smooth-scroll.js

import { scrollToSection, toggleSmoothScroll, getScrollProgress } from './smooth-scroll.js';

// Ejemplo de uso después de que el DOM esté cargado
document.addEventListener('DOMContentLoaded', () => {
    
    // Ejemplo 1: Botón para ir a una sección específica
    const scrollToProjectsBtn = document.createElement('button');
    scrollToProjectsBtn.textContent = 'Ir a Proyectos';
    scrollToProjectsBtn.className = 'px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors';
    scrollToProjectsBtn.addEventListener('click', () => {
        scrollToSection('#projects');
    });
    
    // Ejemplo 2: Toggle del smooth scroll (útil para debugging)
    const toggleBtn = document.createElement('button');
    toggleBtn.textContent = 'Toggle Smooth Scroll';
    toggleBtn.className = 'px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition-colors ml-2';
    toggleBtn.addEventListener('click', () => {
        toggleSmoothScroll();
    });
    
    // Ejemplo 3: Mostrar progreso del scroll
    const progressBar = document.createElement('div');
    progressBar.className = 'scroll-progress';
    document.body.appendChild(progressBar);
    
    // Actualizar barra de progreso
    const updateProgress = () => {
        const progress = getScrollProgress();
        progressBar.style.width = `${progress * 100}%`;
        requestAnimationFrame(updateProgress);
    };
    updateProgress();
    
    // Agregar botones al DOM (opcional)
    // document.body.appendChild(scrollToProjectsBtn);
    // document.body.appendChild(toggleBtn);
    
    // Ejemplo 4: Scroll automático con delay
    setTimeout(() => {
        // Esto hará scroll automático a la sección "about" después de 3 segundos
        // scrollToSection('#about');
    }, 3000);
    
    // Ejemplo 5: Detección de sección activa
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav a[href^="#"]');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const activeSection = entry.target.id;
                
                // Actualizar navegación activa
                navLinks.forEach(link => {
                    link.classList.remove('text-blue-500', 'font-bold');
                    if (link.getAttribute('href') === `#${activeSection}`) {
                        link.classList.add('text-blue-500', 'font-bold');
                    }
                });
            }
        });
    }, {
        threshold: 0.5 // Activar cuando el 50% de la sección esté visible
    });
    
    sections.forEach(section => {
        observer.observe(section);
    });
    
    // Ejemplo 6: Efectos adicionales basados en scroll
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        const documentHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = scrollY / documentHeight;
        
        // Cambiar opacidad del nav basado en scroll
        const nav = document.querySelector('nav');
        if (nav) {
            nav.style.backgroundColor = `rgba(255, 255, 255, ${Math.min(scrollPercent * 2, 0.9)})`;
        }
    });
});

// Función de utilidad para smooth scroll a coordenadas específicas
export function smoothScrollTo(x = 0, y = 0, duration = 1000) {
    const startX = window.pageXOffset;
    const startY = window.pageYOffset;
    const distanceX = x - startX;
    const distanceY = y - startY;
    const startTime = Date.now();
    
    function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t--;
        return -c / 2 * (t * (t - 2) - 1) + b;
    }
    
    function animation() {
        const elapsed = Date.now() - startTime;
        const fraction = elapsed / duration;
        
        if (fraction < 1) {
            const easeY = ease(elapsed, startY, distanceY, duration);
            const easeX = ease(elapsed, startX, distanceX, duration);
            window.scrollTo(easeX, easeY);
            requestAnimationFrame(animation);
        } else {
            window.scrollTo(x, y);
        }
    }
    
    animation();
}

// Exportar para uso global si es necesario
window.smoothScrollUtils = {
    scrollToSection,
    toggleSmoothScroll,
    getScrollProgress,
    smoothScrollTo
};
