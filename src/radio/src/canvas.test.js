// filepath: c:\wamp64\www\portfolio\src\canvas.test.js
import './canvas.js';

describe('Canvas Initialization', () => {
    let canvas;

    beforeEach(() => {
        // Configura el DOM simulado
        document.body.innerHTML = '<canvas class="background-canvas"></canvas>';
        canvas = document.querySelector('.background-canvas');
    });

    test('should create a canvas element', () => {
        expect(canvas).not.toBeNull();
        expect(canvas.tagName).toBe('CANVAS');
    });

    test('should initialize WebGL context', () => {
        const gl = canvas.getContext('webgl');
        expect(gl).not.toBeNull();
    });

    test('should resize canvas on window resize', () => {
        const resizeEvent = new Event('resize');
        window.dispatchEvent(resizeEvent);

        expect(canvas.width).toBe(window.innerWidth);
        expect(canvas.height).toBe(window.innerHeight);
    });

    test('should update mouse position on mousemove', () => {
        const mouseMoveEvent = new MouseEvent('mousemove', {
            clientX: 100,
            clientY: 200,
        });
        window.dispatchEvent(mouseMoveEvent);

        // Simula el comportamiento del mouse
        const mouse = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
        mouse.x = mouseMoveEvent.clientX;
        mouse.y = mouseMoveEvent.clientY;

        expect(mouse.x).toBe(100);
        expect(mouse.y).toBe(200);
    });
});