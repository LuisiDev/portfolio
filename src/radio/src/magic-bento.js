import { gsap } from 'gsap';

export function initMagicBento(selector) {
    const cards = document.querySelectorAll(selector);
    
    cards.forEach(card => {
        card.classList.add('magic-bento-card');

// Dentro de tu archivo magic-bento.js, en el evento 'mousemove'
card.addEventListener('mousemove', (e) => {
    const rect = card.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width) * 100;
    const y = ((e.clientY - rect.top) / rect.height) * 100;

    card.style.setProperty('--glow-x', `${x}%`);
    card.style.setProperty('--glow-y', `${y}%`);
    
    // Si estamos en modo claro, bajamos la intensidad a 0.3, si no, 1
    const isLight = document.documentElement.getAttribute('data-theme') === 'light';
    card.style.setProperty('--glow-intensity', isLight ? '0.3' : '1');
});

        card.addEventListener('mouseleave', () => {
            card.style.setProperty('--glow-intensity', '0');
        });
    });
}