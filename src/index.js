// Este archivo es el punto de entrada de la aplicación. Aquí puedes importar módulos, inicializar tu aplicación y manejar la lógica de JavaScript.
import 'flowbite';
import 'flowbite/dist/flowbite.min.css';
import './styles/main.css';
import './styles/input.css';
import './canvas.js';
import './infinite-scroll.js';
import './cursor.js';
import './dark-light.js';
import './animation-toggle.js';
import 'prismjs';
import 'prismjs/themes/prism.css';

// Aquí puedes agregar la lógica de tu portafolio
document.addEventListener('DOMContentLoaded', () => {
    const app = document.createElement('div');
    app.innerHTML = '<h1>Bienvenido a mi portafolio</h1>';
    document.body.appendChild(app);
});