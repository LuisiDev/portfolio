import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollSmoother } from "gsap/ScrollSmoother";

// Registrar los plugins de GSAP
gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

// Inicializar smooth scroll cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    // Verificar si la página actual debe ser excluida del smooth scroll
    const currentPath = window.location.pathname;
    const excludedPages = ['login.php', 'radio.php'];
    
    const isExcludedPage = excludedPages.some(page => currentPath.includes(page));
    
    if (isExcludedPage) {
        console.log('Smooth scroll deshabilitado para:', currentPath);
        return; // Salir sin inicializar smooth scroll
    }
    
    console.log('Inicializando smooth scroll para:', currentPath);
    initSmoothScroll();
});

function initSmoothScroll() {
    // Verificar que los elementos necesarios existan
    const smoothWrapper = document.querySelector("#smooth-wrapper");
    const smoothContent = document.querySelector("#smooth-content");
    
    if (!smoothWrapper || !smoothContent) {
        console.warn("Elementos para smooth scroll no encontrados. Agregando estructura HTML...");
        setupSmoothScrollHTML();
    }

    // Configurar ScrollSmoother
    let smoother = ScrollSmoother.create({
        wrapper: "#smooth-wrapper",
        content: "#smooth-content",
        smooth: 1.2,              // Reducir intensidad para mejor interacción
        effects: true,            // Habilita efectos de parallax
        smoothTouch: 0.1,         // Smooth scroll en dispositivos táctiles (0-1)
        normalizeScroll: true,    // Normaliza el scroll en diferentes navegadores
        ignoreMobileResize: true, // Ignora cambios de tamaño en móviles
        onUpdate: self => {
            // Asegurar que elementos fijos mantengan su posición
            const nav = document.querySelector('nav');
            const cursor = document.getElementById('cursor');
            const cursorBorder = document.getElementById('cursor-border');
            
            if (nav) {
                nav.style.position = 'fixed';
                nav.style.zIndex = '1000';
            }
            
            if (cursor) {
                cursor.style.position = 'fixed';
                cursor.style.zIndex = '10000';
            }
            
            if (cursorBorder) {
                cursorBorder.style.position = 'fixed';
                cursorBorder.style.zIndex = '9999';
            }
        }
    });

    // Efectos adicionales con ScrollTrigger
    addScrollEffects();

    // Navegación suave para enlaces internos
    setupSmoothNavigation(smoother);
}

function setupSmoothScrollHTML() {
    // Obtener el contenido actual del body, excluyendo cursor y loading screen
    const loadingScreen = document.getElementById('loading-screen');
    const cursor = document.getElementById('cursor');
    const cursorBorder = document.getElementById('cursor-border');
    
    // Remover temporalmente elementos que no deben estar dentro del smooth scroll
    const elementsToPreserve = [];
    if (loadingScreen) {
        elementsToPreserve.push({ element: loadingScreen, parent: loadingScreen.parentNode });
        loadingScreen.remove();
    }
    if (cursor) {
        elementsToPreserve.push({ element: cursor, parent: cursor.parentNode });
        cursor.remove();
    }
    if (cursorBorder) {
        elementsToPreserve.push({ element: cursorBorder, parent: cursorBorder.parentNode });
        cursorBorder.remove();
    }
    
    // Obtener el contenido restante del body
    const bodyContent = document.body.innerHTML;
    
    // Crear la estructura necesaria para ScrollSmoother
    document.body.innerHTML = `
        <div id="smooth-wrapper">
            <div id="smooth-content">
                ${bodyContent}
            </div>
        </div>
    `;
    
    // Restaurar elementos preservados fuera del smooth scroll
    elementsToPreserve.forEach(({ element, parent }) => {
        document.body.appendChild(element);
    });
}

function addScrollEffects() {
    // Efecto parallax para el SVG de fondo
    gsap.set(".bg-svg", { 
        transformOrigin: "center center" 
    });

    ScrollTrigger.create({
        trigger: "#about",
        start: "top bottom",
        end: "bottom top",
        scrub: 1,
        animation: gsap.to(".bg-svg", {
            yPercent: -50,
            ease: "none"
        })
    });

    // Animación de aparición para elementos
    gsap.utils.toArray(".animate-on-scroll").forEach((element) => {
        gsap.fromTo(element, 
            {
                opacity: 0,
                y: 100
            },
            {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: element,
                    start: "top 80%",
                    end: "bottom 20%",
                    toggleActions: "play none none reverse"
                }
            }
        );
    });

    // Efecto para el título principal
    ScrollTrigger.create({
        trigger: "#about-content h2",
        start: "top 70%",
        end: "bottom 30%",
        scrub: 1,
        animation: gsap.to("#about-content h2", {
            scale: 1.1,
            ease: "none"
        })
    });
}

function setupSmoothNavigation(smoother) {
    // Navegación suave para enlaces que apuntan a secciones
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                smoother.scrollTo(targetElement, true, "top top");
            }
        });
    });
}

// Función para pausar/reanudar el smooth scroll
export function toggleSmoothScroll() {
    const smoother = ScrollSmoother.get();
    if (smoother) {
        if (smoother.paused()) {
            smoother.resume();
        } else {
            smoother.pause();
        }
    }
}

// Función para scrollear a una sección específica
export function scrollToSection(selector) {
    const smoother = ScrollSmoother.get();
    const target = document.querySelector(selector);
    
    if (smoother && target) {
        smoother.scrollTo(target, true, "top top");
    }
}

// Función para obtener el progreso del scroll
export function getScrollProgress() {
    const smoother = ScrollSmoother.get();
    return smoother ? smoother.progress() : 0;
}
