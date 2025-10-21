const cursor = document.getElementById('cursor');
const cursorBorder = document.getElementById('cursor-border');

let cursorX = 0,
  cursorY = 0,
  borderX = 0,
  borderY = 0;
let deviceType = '';

// Inicializar posiciones en el centro de la pantalla
cursorX = window.innerWidth / 2;
cursorY = window.innerHeight / 2;
borderX = cursorX;
borderY = cursorY;

//check if it is a touch device
const isTouchDevice = () => {
  try {
    document.createEvent('TouchEvent');
    deviceType = 'touch';
    return true;
  } catch (e) {
    deviceType = 'mouse';
    return false;
  }
};

//move
const move = (e) => {
  if (!isTouchDevice()) {
    cursorX = e.clientX;
    cursorY = e.clientY;
  } else if (e.touches && e.touches.length > 0) {
    cursorX = e.touches[0].clientX;
    cursorY = e.touches[0].clientY;
  }
  
  // Asegurar que el cursor esté siempre visible y no se vea afectado por el smooth scroll
  if (cursor) {
    cursor.style.position = 'fixed';
    cursor.style.left = `${cursorX}px`;
    cursor.style.top = `${cursorY}px`;
    cursor.style.transform = 'translate(-50%, -50%)'; // Centrar correctamente
    cursor.style.zIndex = '10000';
    cursor.style.pointerEvents = 'none';
  }
};

// Mejorar la detección de hover para elementos clickeables
const handleHover = (e) => {
  const target = e.target;
  const isClickable = target.matches('a, button, [role="button"], input, textarea, select') || 
                     target.closest('a, button, [role="button"], input, textarea, select');
  
  if (cursor && cursorBorder) {
    if (isClickable) {
      cursor.classList.add('hover');
      cursorBorder.classList.add('hover');
    } else {
      cursor.classList.remove('hover');
      cursorBorder.classList.remove('hover');
    }
  }
};

document.addEventListener('mousemove', (e) => {
  move(e);
  handleHover(e);
});

document.addEventListener('touchmove', (e) => {
  move(e);
});

document.addEventListener('touchend', (e) => {
  if (cursor) {
    cursor.style.left = `${cursorX}px`;
    cursor.style.top = `${cursorY}px`;
  }
});

//animate border
const borderAnimation = () => {
  const gapValue = 8; // Aumentar el gap para un seguimiento más suave
  borderX += (cursorX - borderX) / gapValue;
  borderY += (cursorY - borderY) / gapValue;
  
  if (cursorBorder) {
    cursorBorder.style.position = 'fixed';
    cursorBorder.style.left = `${borderX}px`;
    cursorBorder.style.top = `${borderY}px`;
    cursorBorder.style.transform = 'translate(-50%, -50%)'; // Asegurar centrado
    cursorBorder.style.zIndex = '9998';
    cursorBorder.style.pointerEvents = 'none';
  }
  
  requestAnimationFrame(borderAnimation);
};

// Inicializar la animación solo si los elementos existen
if (cursor && cursorBorder) {
  // Inicializar las posiciones del border
  borderX = cursorX;
  borderY = cursorY;
  requestAnimationFrame(borderAnimation);
}

// Asegurar que el cursor funcione correctamente después de que se cargue el smooth scroll
document.addEventListener('DOMContentLoaded', () => {
  setTimeout(() => {
    const cursorElement = document.getElementById('cursor');
    const cursorBorderElement = document.getElementById('cursor-border');
    
    if (cursorElement) {
      cursorElement.style.position = 'fixed';
      cursorElement.style.zIndex = '10000';
      cursorElement.style.pointerEvents = 'none';
      cursorElement.style.transform = 'translate(-50%, -50%)';
    }
    
    if (cursorBorderElement) {
      cursorBorderElement.style.position = 'fixed';
      cursorBorderElement.style.zIndex = '9999';
      cursorBorderElement.style.pointerEvents = 'none';
      cursorBorderElement.style.transform = 'translate(-50%, -50%)';
    }
  }, 100);
});