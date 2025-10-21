# Smooth Scroll con GSAP - Guía de Implementación

## 📋 Resumen

Esta implementación utiliza **GSAP (GreenSock Animation Platform)** con los plugins **ScrollTrigger** y **ScrollSmoother** para crear un efecto de scroll suave y profesional en tu sitio web.

## 🚀 Características Implementadas

- ✅ Smooth scroll suave y responsivo
- ✅ Efectos de parallax automáticos
- ✅ Animaciones al hacer scroll
- ✅ Navegación suave entre secciones
- ✅ Compatibilidad con dispositivos móviles
- ✅ Soporte para `prefers-reduced-motion`
- ✅ Optimizado para rendimiento

## 📁 Archivos Creados/Modificados

1. **`src/smooth-scroll.js`** - Implementación principal del smooth scroll
2. **`src/styles/smooth-scroll.css`** - Estilos específicos para el smooth scroll
3. **`src/smooth-scroll-examples.js`** - Ejemplos de uso y utilidades adicionales
4. **`src/index.js`** - Importación del smooth scroll
5. **`src/index.php`** - Estructura HTML modificada

## 🛠️ Configuración Aplicada

### Configuración Básica del ScrollSmoother:
```javascript
ScrollSmoother.create({
    wrapper: "#smooth-wrapper",
    content: "#smooth-content", 
    smooth: 1.5,              // Intensidad (0-2)
    effects: true,            // Habilita parallax
    smoothTouch: 0.1,         // Smooth en móviles
    normalizeScroll: true,    // Compatibilidad navegadores
    ignoreMobileResize: true  // Optimización móviles
});
```

## 🎯 Funciones Disponibles

### 1. `scrollToSection(selector)`
Navega suavemente a una sección específica:
```javascript
import { scrollToSection } from './smooth-scroll.js';
scrollToSection('#projects'); // Ir a la sección de proyectos
```

### 2. `toggleSmoothScroll()`
Pausa/reanuda el smooth scroll:
```javascript
import { toggleSmoothScroll } from './smooth-scroll.js';
toggleSmoothScroll(); // Alternar smooth scroll
```

### 3. `getScrollProgress()`
Obtiene el progreso del scroll (0-1):
```javascript
import { getScrollProgress } from './smooth-scroll.js';
const progress = getScrollProgress(); // 0.5 = 50% del scroll
```

## 🎨 Efectos Implementados

### 1. Parallax en SVG de Fondo
```javascript
ScrollTrigger.create({
    trigger: "#about",
    scrub: 1,
    animation: gsap.to(".bg-svg", {
        yPercent: -50,
        ease: "none"
    })
});
```

### 2. Animaciones de Aparición
Para elementos con clase `.animate-on-scroll`:
```javascript
gsap.fromTo(element, 
    { opacity: 0, y: 100 },
    { 
        opacity: 1, 
        y: 0,
        scrollTrigger: {
            trigger: element,
            start: "top 80%",
            toggleActions: "play none none reverse"
        }
    }
);
```

### 3. Efecto de Escala en Título
```javascript
ScrollTrigger.create({
    trigger: "#about-content h2",
    scrub: 1,
    animation: gsap.to("#about-content h2", {
        scale: 1.1
    })
});
```

## 📱 Compatibilidad y Accesibilidad

### Dispositivos Móviles
- `smoothTouch: 0.1` para suavidad controlada en táctiles
- Fallback a scroll nativo en pantallas pequeñas

### Accesibilidad
- Respeta `prefers-reduced-motion`
- Deshabilita animaciones si el usuario lo prefiere
- Mantiene navegación por teclado funcional

## 🔧 Personalización

### Cambiar Intensidad del Smooth Scroll
En `src/smooth-scroll.js`, modifica:
```javascript
smooth: 1.5, // Cambia este valor (0 = sin smooth, 2 = muy smooth)
```

### Agregar Nuevas Animaciones
```javascript
// Ejemplo: Fade in desde la izquierda
gsap.fromTo(".fade-left", 
    { opacity: 0, x: -100 },
    { 
        opacity: 1, 
        x: 0,
        scrollTrigger: {
            trigger: ".fade-left",
            start: "top 80%"
        }
    }
);
```

### Crear Efectos de Parallax Personalizados
```javascript
ScrollTrigger.create({
    trigger: ".mi-elemento",
    start: "top bottom",
    end: "bottom top",
    scrub: true,
    animation: gsap.to(".mi-elemento", {
        yPercent: -30,
        rotation: 5
    })
});
```

## 🚨 Resolución de Problemas

### El smooth scroll no funciona:
1. Verifica que GSAP esté correctamente instalado: `npm list gsap`
2. Asegúrate de que los elementos `#smooth-wrapper` y `#smooth-content` existan
3. Revisa la consola del navegador por errores

### Rendimiento lento:
1. Reduce el valor de `smooth` (ej: de 1.5 a 1.0)
2. Limita el número de elementos con `will-change`
3. Usa `transform` en lugar de cambiar propiedades de layout

### Conflictos con otros scripts:
1. Asegúrate de que el smooth scroll se inicialice después del DOM
2. Evita múltiples librerías de scroll simultáneas
3. Usa `ScrollTrigger.refresh()` después de cambios dinámicos

## 📊 Optimización de Rendimiento

### CSS Aplicado:
```css
.animate-on-scroll {
    will-change: transform, opacity;
}

.parallax-element {
    will-change: transform;
    transform: translateZ(0); /* Fuerza aceleración por hardware */
}
```

### JavaScript:
- Usa `scrub: true` para animaciones vinculadas al scroll
- Evita animaciones en propiedades que causen reflow
- Utiliza `requestAnimationFrame` para actualizaciones suaves

## 🎉 Uso Básico

1. **Instalado automáticamente**: El smooth scroll se activa al cargar la página
2. **Navegación**: Los enlaces internos (`href="#seccion"`) funcionan automáticamente
3. **Animaciones**: Agrega la clase `animate-on-scroll` a elementos que quieras animar

## 📞 Soporte

Para más información sobre GSAP:
- [Documentación oficial de GSAP](https://greensock.com/docs/)
- [ScrollSmoother Docs](https://greensock.com/docs/v3/Plugins/ScrollSmoother)
- [ScrollTrigger Docs](https://greensock.com/docs/v3/Plugins/ScrollTrigger)

---

¡El smooth scroll está listo para usar! 🎨✨
