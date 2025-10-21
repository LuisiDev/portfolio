import { ANIMATIONS } from './animation-toggle.js';

// Función para inicializar el tema
function initTheme() {
  const savedTheme = localStorage.getItem('theme');
  const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  
  let theme = 'light';
  if (savedTheme) {
    theme = savedTheme;
  } else if (systemPrefersDark) {
    theme = 'dark';
  }
  
  applyTheme(theme);
  return theme;
}

// Función para aplicar el tema
function applyTheme(theme) {
  if (theme === 'dark') {
    document.documentElement.classList.add('dark');
    document.documentElement.setAttribute('data-theme', 'dark');
  } else {
    document.documentElement.classList.remove('dark');
    document.documentElement.setAttribute('data-theme', 'light');
  }
}

// Inicializar tema
let currentTheme = initTheme();

// Elemento para animaciones CSS
const styleElement = document.createElement('style');
document.head.appendChild(styleElement);

const injectCSS = (css) => {
  styleElement.textContent = css;
};

// Función para cambiar el tema
const toggleTheme = (button, animation) => {
  const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
  
  localStorage.setItem('theme', newTheme);
  
  const applyThemeChange = () => {
    applyTheme(newTheme);
    currentTheme = newTheme;
    
    if (animation) {
      injectCSS(animation.css);
    }
    
    updateButtonState(button, newTheme);
  };

  if (document.startViewTransition) {
    document.startViewTransition(() => {
      applyThemeChange();
    });
  } else {
    applyThemeChange();
  }
};

// Actualizar estado del botón
function updateButtonState(button, theme) {
  button.setAttribute('aria-pressed', theme === 'dark');
  // No necesitamos updateButtonIcon ya que usaremos el SVG animado original
}

// Inicialización
document.addEventListener('DOMContentLoaded', () => {
  const themeButtons = document.querySelectorAll('.theme-toggle');
  
  themeButtons.forEach(button => {
    updateButtonState(button, currentTheme);
    
    button.addEventListener('click', (e) => {
      e.preventDefault();
      const animationName = button.dataset.animation;
      const animation = ANIMATIONS.find(a => a.name === animationName);
      toggleTheme(button, animation);
    });
  });
  
  // Escuchar cambios en la preferencia del sistema
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
    if (!localStorage.getItem('theme')) {
      currentTheme = e.matches ? 'dark' : 'light';
      applyTheme(currentTheme);
      document.querySelectorAll('.theme-toggle').forEach(btn => {
        updateButtonState(btn, currentTheme);
      });
    }
  });
});