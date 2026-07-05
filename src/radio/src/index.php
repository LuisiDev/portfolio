<!DOCTYPE html>
<html lang="es" dir="ltr" data-theme="dark">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome!</title>
  <link rel="stylesheet" href="styles/main.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
</head>
<style>
  .playball-regular {
    font-family: "Playball", cursive;
    font-weight: 400;
    font-style: normal;
  }

  .container {
    max-width: 800px;
    padding: 20px;
  }

  .player {
    background-color: #ecf0f1;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    margin-bottom: 20px;
  }

  audio {
    width: 100%;
    max-width: 400px;
  }

  /* Menu container */
  .transition-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none;
    flex-direction: row;
    z-index: 9996;
  }

  .transition-panel {
    flex: 1;
    background: #000;
    transform: translateY(-100%);
    transition: transform 0.5s ease-in-out;
  }

  .transition-screen.show {
    display: flex;
  }

  .transition-screen.show.down .transition-panel {
    transform: translateY(0);
  }

  .transition-screen.show.up .transition-panel {
    transform: translateY(-100%);
  }

  .transition-panel:nth-child(1) {
    transition-delay: 0s
  }

  .transition-panel:nth-child(2) {
    transition-delay: 0.1s
  }

  .transition-panel:nth-child(3) {
    transition-delay: 0.2s
  }

  .transition-panel:nth-child(4) {
    transition-delay: 0.3s
  }

  .transition-panel:nth-child(5) {
    transition-delay: 0.4s
  }

  .transition-screen.from-bottom .transition-panel {
    transform: translateY(100%);
  }

  .transition-screen.rise .transition-panel {
    transform: translateY(0);
  }

  .menu-container {
    /* position: absolute; */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
    text-align: center;
    z-index: 9997;
  }

  .menu-option {
    font-size: 2.2rem;
    margin: 15px 0;
    padding-bottom: 5px;
    border-bottom: 2px solid white;
    cursor: pointer;
    transition: color 0.3s;
  }

  .close-btn {
    /* position: absolute; */
    top: 25px;
    right: 25px;
    background: white;
    color: black;
    border: none;
    padding: 12px 18px;
    /* cursor: pointer; */
    font-size: 16px;
    border-radius: 10px;
    display: none;
    z-index: 9997;
  }

  .circulo {
    width: 20px;
    height: 20px;
    background-color: red;
    border-radius: 50%;
    animation: parpadeo 1s infinite;
  }

  @keyframes parpadeo {

    0%,
    100% {
      opacity: 1;
    }

    50% {
      opacity: 0;
    }
  }

  /* Radio Active */
  .spinner {
    background-image: linear-gradient(rgb(0, 255, 100) 35%, rgb(0, 255, 100));
    width: 20px;
    height: 20px;
    animation: spinning82341 1.7s linear infinite;
    text-align: center;
    border-radius: 10px;
    filter: blur(1px);
    box-shadow: 0px -5px 20px 0px rgb(50, 210, 120), 0px 5px 20px 0px rgb(50, 210, 120);
    position: relative;
  }

  .spinner1 {
    background-color: rgb(50, 210, 120);
    width: 20px;
    height: 20px;
    border-radius: 10px;
    filter: blur(5px);
    animation: flickeringGlow 2s linear infinite;
  }

  @keyframes spinning82341 {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes flickeringGlow {
    0% {
      box-shadow: 0px -10px 40px 0px rgb(0, 255, 255), 0px 10px 40px 0px rgb(50, 210, 120), 0px 0px 20px 0px white;
    }
  }

  /* Request Button */

  button:hover {
    animation: rotate624 0.7s ease-in-out both;
  }

  button:hover span {
    animation: storm1261 0.7s ease-in-out both;
    animation-delay: 0.06s;
  }

  @keyframes rotate624 {
    0% {
      transform: rotate(0deg) translate3d(0, 0, 0);
    }

    25% {
      transform: rotate(3deg) translate3d(0, 0, 0);
    }

    50% {
      transform: rotate(-3deg) translate3d(0, 0, 0);
    }

    75% {
      transform: rotate(1deg) translate3d(0, 0, 0);
    }

    100% {
      transform: rotate(0deg) translate3d(0, 0, 0);
    }
  }

  @keyframes storm1261 {
    0% {
      transform: translate3d(0, 0, 0) translateZ(0);
    }

    25% {
      transform: translate3d(4px, 0, 0) translateZ(0);
    }

    50% {
      transform: translate3d(-3px, 0, 0) translateZ(0);
    }

    75% {
      transform: translate3d(2px, 0, 0) translateZ(0);
    }

    100% {
      transform: translate3d(0, 0, 0) translateZ(0);
    }
  }

  /* Animation */
  .waves {
    position: relative;
    width: 100%;
    height: 15vh;
    margin-bottom: -7px;
    /*Fix for safari gap*/
    min-height: 100px;
    max-height: 150px;
  }

  .parallax>use {
    animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
  }

  .parallax>use:nth-child(1) {
    animation-delay: -2s;
    animation-duration: 7s;
  }

  .parallax>use:nth-child(2) {
    animation-delay: -3s;
    animation-duration: 10s;
  }

  .parallax>use:nth-child(3) {
    animation-delay: -4s;
    animation-duration: 13s;
  }

  .parallax>use:nth-child(4) {
    animation-delay: -5s;
    animation-duration: 20s;
  }

  @keyframes move-forever {
    0% {
      transform: translate3d(-90px, 0, 0);
    }

    100% {
      transform: translate3d(85px, 0, 0);
    }
  }

  /*Shrinking for mobile*/
  @media (max-width: 768px) {
    .waves {
      height: 40px;
      min-height: 40px;
    }

    .content {
      height: 30vh;
    }

    h1 {
      font-size: 24px;
    }
  }
</style>
<style
  data-emotion="css 1xejwb6 animation-uruema animation-1vy81ht animation-18joj06 animation-1rcj4m5">
  .css-1xejwb6 {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 141%;
    height: 141%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
  }

  .css-1xejwb6::before,
  .css-1xejwb6::after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    width: 50%;
    height: 100%;
    background-color: #000000;
    pointer-events: auto;
    /* Para que las cortinas bloqueen clics mientras están cerradas */
  }

  .css-1xejwb6::before {
    left: -1px;
    -webkit-animation:
      animation-1rcj4m5 0.45s ease-out calc(var(--d, 0s) + var(--delay, 0s) + 0.4s) both,
      animation-18joj06 0.9s ease-in-out calc(var(--d, 0s) + var(--delay, 0s) + 0.5s) forwards;
    animation:
      animation-1rcj4m5 0.45s ease-out calc(var(--d, 0s) + var(--delay, 0s) + 0.4s) both,
      animation-18joj06 0.9s ease-in-out calc(var(--d, 0s) + var(--delay, 0s) + 0.5s) forwards;
  }

  .css-1xejwb6::after {
    right: -1px;
    -webkit-animation:
      animation-1vy81ht 0.45s ease-out calc(var(--d, 0s) + var(--delay, 0s) + 0.4s) both,
      animation-uruema 0.9s ease-in-out calc(var(--d, 0s) + var(--delay, 0s) + 0.5s) forwards;
    animation:
      animation-1vy81ht 0.45s ease-out calc(var(--d, 0s) + var(--delay, 0s) + 0.4s) both,
      animation-uruema 0.9s ease-in-out calc(var(--d, 0s) + var(--delay, 0s) + 0.5s) forwards;
  }

  @-webkit-keyframes animation-uruema {
    from {
      -webkit-transform: translateX(0);
      -moz-transform: translateX(0);
      -ms-transform: translateX(0);
      transform: translateX(0);
    }

    to {
      -webkit-transform: translateX(101%);
      -moz-transform: translateX(101%);
      -ms-transform: translateX(101%);
      transform: translateX(101%);
    }
  }

  @keyframes animation-uruema {
    from {
      -webkit-transform: translateX(0);
      -moz-transform: translateX(0);
      -ms-transform: translateX(0);
      transform: translateX(0);
    }

    to {
      -webkit-transform: translateX(101%);
      -moz-transform: translateX(101%);
      -ms-transform: translateX(101%);
      transform: translateX(101%);
    }
  }

  @-webkit-keyframes animation-1vy81ht {
    from {
      border-bottom-left-radius: 0%;
    }

    to {
      border-bottom-left-radius: 100%;
    }
  }

  @keyframes animation-1vy81ht {
    from {
      border-bottom-left-radius: 0%;
    }

    to {
      border-bottom-left-radius: 100%;
    }
  }

  @-webkit-keyframes animation-18joj06 {
    from {
      -webkit-transform: translateX(0);
      -moz-transform: translateX(0);
      -ms-transform: translateX(0);
      transform: translateX(0);
    }

    to {
      -webkit-transform: translateX(-101%);
      -moz-transform: translateX(-101%);
      -ms-transform: translateX(-101%);
      transform: translateX(-101%);
    }
  }

  @keyframes animation-18joj06 {
    from {
      -webkit-transform: translateX(0);
      -moz-transform: translateX(0);
      -ms-transform: translateX(0);
      transform: translateX(0);
    }

    to {
      -webkit-transform: translateX(-101%);
      -moz-transform: translateX(-101%);
      -ms-transform: translateX(-101%);
      transform: translateX(-101%);
    }
  }

  @-webkit-keyframes animation-1rcj4m5 {
    from {
      border-bottom-right-radius: 0%;
    }

    to {
      border-bottom-right-radius: 100%;
    }
  }

  @keyframes animation-1rcj4m5 {
    from {
      border-bottom-right-radius: 0%;
    }

    to {
      border-bottom-right-radius: 100%;
    }
  }

  :root {
    --icon-color: #414856;
    --shape-color-01: #b8cbee;
    --shape-color-02: #7691e8;
    --shape-color-03: #fdd053;
  }

  .socials-row {
    display: flex;
    gap: 40px;
  }

  /* 1. CONTENEDOR PRINCIPAL INDEPENDIENTE */
  .icon-wrapper {
    position: relative;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    border-radius: 50%;
  }

  /* 2. ICONO VISIBLE PRINCIPAL */
  .icon-wrapper .btn-icon {
    width: 28px;
    height: 28px;
    position: relative;
    z-index: 10;
    overflow: visible;
    transition: transform 0.2s ease;
  }

  .icon-wrapper:hover .btn-icon {
    transform: scale(1.15);
    /* Crece al hacer hover */
  }

  /* ======================================================= */
  /* 3. TOOLTIP (LA CAJA FLOTANTE QUE SE OCULTA/MUESTRA)     */
  /* ======================================================= */
  .icon-wrapper .tooltip {
    width: 90px;
    height: 75px;
    border-radius: 70px;
    position: absolute;
    background: #fff;
    z-index: 2;
    padding: 0 15px;
    box-shadow: 0 10px 30px rgba(65, 72, 86, 0.05);
    opacity: 0;
    top: 0;
    display: flex;
    justify-content: space-around;
    align-items: center;
    transition: opacity 0.15s ease-in, top 0.15s ease-in, width 0.15s ease-in;
    pointer-events: none;
  }

  .icon-wrapper .tooltip::after {
    content: "";
    width: 20px;
    height: 20px;
    background: #fff;
    border-radius: 3px;
    position: absolute;
    left: 50%;
    margin-left: -10px;
    bottom: -8px;
    transform: rotate(45deg);
    z-index: 0;
  }

  .icon-wrapper .tooltip>svg {
    width: 100%;
    height: 26px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    cursor: pointer;
    pointer-events: auto;
  }

  .icon-wrapper .tooltip>svg .icon {
    fill: none;
    stroke: var(--icon-color);
    stroke-width: 2px;
    stroke-linecap: round;
    stroke-linejoin: round;
    opacity: 0.4;
    transition: opacity 0.3s ease;
  }

  .icon-wrapper .tooltip>svg:hover .icon {
    opacity: 1;
  }

  .icon-wrapper:hover .tooltip {
    width: 190px;
    height: 70px;
    animation: stretch-animation 1s ease-out forwards 0.15s;
    top: -90px;
    opacity: 1;
  }

  @keyframes stretch-animation {
    0% {
      transform: scale(1, 1);
    }

    10% {
      transform: scale(1.1, 0.9);
    }

    30% {
      transform: scale(0.9, 1.1);
    }

    50% {
      transform: scale(1.05, 0.95);
    }

    100% {
      transform: scale(1, 1);
    }
  }

  /* ======================================================= */
  /* 5. EFECTOS DE DIBUJO AL CARGAR (Sin requerir hover)     */
  /* ======================================================= */

  /* LINKEDIN - Inicia oculto y se dibuja inmediatamente */
  .li-c {
    opacity: 0;
    animation: show-opacity 0.2s forwards;
  }

  .li-p1 {
    stroke-dasharray: 12;
    stroke-dashoffset: 12;
    animation: draw-line 0.2s forwards 0.2s;
  }

  .li-p2 {
    stroke-dasharray: 12;
    stroke-dashoffset: 12;
    animation: draw-line 1.5s forwards 0.4s;
  }

  .li-p3 {
    stroke-dasharray: 24;
    stroke-dashoffset: 24;
    animation: draw-line 1.5s forwards 0.6s;
  }

  /* GITHUB - Inicia oculto y se dibuja inmediatamente */
  .gh-p1 {
    stroke-dasharray: 32;
    stroke-dashoffset: 32;
    animation: draw-line 1.5s forwards;
  }

  .gh-p2 {
    stroke-dasharray: 10;
    stroke-dashoffset: 10;
    animation: draw-line 1.5s forwards 0.6s;
  }

  /* FACEBOOK - Inicia oculto y se dibuja inmediatamente */
  .fb-p1 {
    stroke-dasharray: 24;
    stroke-dashoffset: 24;
    animation: draw-line 1.5s forwards;
  }

  .fb-p2 {
    stroke-dasharray: 10;
    stroke-dashoffset: 10;
    animation: draw-line 1.5s forwards 0.5s;
  }

  /* KEYFRAMES BASE PARA DIBUJAR */
  @keyframes draw-line {
    to {
      stroke-dashoffset: 0;
    }
  }

  @keyframes show-opacity {
    to {
      opacity: 1;
    }
  }

  /* Contenedor padre del Grid */
  .bento-grid {
    position: relative;
  }

  /* Las tarjetas del Bento */
  .magic-bento-card {
    position: relative;
    overflow: hidden;
    background: rgba(15, 23, 19, 0.1);
    /* Color degrado con transparencia para el efecto de glassmorphism */
    backdrop-filter: blur(10px);
    /* Efecto de desenfoque para el fondo */
    background-clip: padding-box;
    /* Para que el fondo no se extienda al borde */
    background-origin: border-box;
    /* Para que el fondo se dibuje dentro del borde */
    border: 1px solid #2F293A;
    border-radius: 2rem;
    /* rounded-4xl */
    --glow-x: 50%;
    --glow-y: 50%;
    --glow-intensity: 0;
    cursor: pointer;
    transition: box-shadow 0.3s ease;
  }

  /* El efecto de Borde Brillante */
  .magic-bento-card::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: inherit;
    padding: 1px;
    background: radial-gradient(200px circle at var(--glow-x) var(--glow-y),
        rgba(240, 240, 240, calc(var(--glow-intensity) * 0.9)) 0%,
        transparent 100%);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    mask-composite: exclude;
    pointer-events: none;
    opacity: var(--glow-intensity);
  }

  /* Valores por defecto (Modo Oscuro) */
  :root {
    --background-card: #120f1785;
    --border-card: #2F293A;
    --glow-opacity: 0.8;
  }

  /* Ajustes para Modo Claro */
  [data-theme='light'] {
    --background-card: #ffffff;
    --border-card: #424b5e;
    --glow-opacity: 0.8;
    /* El resplandor se vuelve muy sutil en claro */
  }

  .magic-bento-card {
    background: var(--background-card);
    border: 1px solid var(--border-card);
    transition: background 0.3s ease, border-color 0.3s ease;
  }

  /* Ajuste del borde brillante para modo claro */
  [data-theme='light'] .magic-bento-card--border-glow::after {
    background: radial-gradient(200px circle at var(--glow-x) var(--glow-y),
        rgba(132, 0, 255, 0.2) 0%,
        transparent 70%);
  }

  /* Aseguramos que el texto sea visible en modo claro */
  [data-theme='light'] .magic-bento-card__title,
  [data-theme='light'] .magic-bento-card__description,
  [data-theme='light'] .magic-bento-card__label {
    color: #111827 !important;
  }

  @keyframes bounce-custom {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-10px);
    }
  }

  .hover-bounce-card {
    transition: transform 0.8s ease;
  }

  .hover-bounce-card:hover {
    transform: translateY(-10px);
  }
</style>

<body class="bg-black p-3 md:p-6 font-sans bg-gray-50 dark:bg-gray-900 hide-scrollbar">
  <div class="fixed inset-3 md:inset-6 z-[9990] pointer-events-none rounded-[2rem] md:rounded-[2.5rem] shadow-[0_0_0_100vmax_black]"></div>

  <header class="fixed top-3 md:top-6 left-1/2 -translate-x-1/2 w-[calc(100%-1.5rem)] md:w-[calc(100%-3rem)] max-w-4xl z-[9995] pointer-events-none">
    <nav class="bg-black text-white pointer-events-auto w-full h-16 md:h-20 px-6 flex items-center justify-between rounded-b-[2rem] mx-auto relative shadow-2xl">
      <div class="absolute top-0 -left-6 w-6 h-6 bg-transparent" style="border-top-right-radius: 1.5rem; box-shadow: 10px -10px 0 10px black;"></div>
      <div class="absolute top-0 -right-6 w-6 h-6 bg-transparent" style="border-top-left-radius: 1.5rem; box-shadow: -10px -10px 0 10px black;"></div>
      <div class="font-bold text-lg flex items-center gap-2">
        <svg width="36" height="39" viewBox="-20 -20 296 299" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g filter="url(#filter_nav)" data-figma-bg-blur-radius="10.5213">
            <rect x="64.1191" width="180" height="180" rx="42.83" transform="rotate(15 64.1191 0)" fill="url(#paint0_nav)" shape-rendering="crispEdges" />
            <rect x="64.4624" y="0.594585" width="179.029" height="179.029" rx="42.3445" transform="rotate(15 64.4624 0.594585)" stroke="url(#paint1_nav)" stroke-width="0.970954" shape-rendering="crispEdges" />
            <path d="M74.867 104.978L77.0462 96.8448L113.417 91.2365L110.91 100.594L86.2402 103.568L86.6705 103.163L86.361 104.318L86.1906 103.753L106.068 118.663L103.561 128.02L74.867 104.978ZM146.285 86.9433L115.855 139.512L107.376 137.239L137.806 84.6711L146.285 86.9433ZM175.395 131.914L139.024 137.523L141.531 128.165L166.201 125.191L165.771 125.596L166.08 124.441L166.25 125.006L146.373 110.097L148.88 100.739L177.574 123.781L175.395 131.914Z" fill="white" />
          </g>
          <defs>
            <filter id="filter_nav" x="-10.8495" y="-10.5213" width="277.217" height="280.16" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
              <feFlood flood-opacity="0" result="BackgroundImageFix" />
              <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
              <feOffset dy="20.8034" />
              <feGaussianBlur stdDeviation="14.1906" />
              <feComposite in2="hardAlpha" operator="out" />
              <feColorMatrix type="matrix" values="0 0 0 0 0.00753472 0 0 0 0 0.00920856 0 0 0 0 0.129167 0 0 0 0.1 0" />
              <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_nav" />
              <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_nav" result="shape" />
            </filter>
            <linearGradient id="paint0_nav" x1="103.924" y1="19.7599" x2="208.688" y2="179.742" gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.1" />
              <stop offset="1" stop-color="white" stop-opacity="0.4" />
            </linearGradient>

            <linearGradient id="paint1_nav" x1="103.924" y1="-0.285138" x2="216.63" y2="179.742" gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.12" />
              <stop offset="1" stop-color="white" stop-opacity="0.36" />
            </linearGradient>
          </defs>
        </svg>
        <span class="hidden sm:block playball-regular">Luis Flores</span>
      </div>

      <ul class="hidden md:flex gap-8 font-medium text-sm text-gray-300">
        <li><a href="#home" class="hover:text-white transition-colors">Home</a></li>
        <li><a href="#projects" class="hover:text-white transition-colors">Projects</a></li>
        <li><a href="#blog" class="hover:text-white transition-colors">Blog</a></li>
      </ul>

      <div class="flex items-center gap-4">
        <a href="#" data-animation="circle" class="theme-toggle flex items-center justify-center p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-full transition-all duration-200">
          <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
          <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
          </svg>
        </a>
        <button id="contactBtn" class="bg-white text-black px-5 py-2 rounded-full text-sm font-bold hover:bg-gray-200 transition-colors">Contact me</button>
      </div>
    </nav>
  </header>

  <!-- Loading Screen -->
  <div id="loading-screen" style="background-color: transparent; pointer-events: none;">
    <div class="css-1xejwb6"></div>
  </div>

  <!-- Cursor personalizado (fuera del smooth scroll) -->
  <div id="cursor" class="hidden sm:block bg-white dark:border-white"></div>
  <div id="cursor-border" class="hidden sm:block border-2 border-solid border-white dark:border-white"></div>
  <!-- Estructura para Smooth Scroll -->
  <div id="smooth-wrapper">
    <div id="smooth-content">
      <main class="px-15 md:px-30 xl:px-60">
        <section id="home" class="relative w-full min-h-[100dvh] grid place-items-center overflow-hidden">
          <div class="absolute inset-0 z-0 flex items-center justify-center pointer-events-none opacity-25 dark:opacity-50">
            <div class="absolute -inset-50 backdrop-blur-sm dark:backdrop-blur-md z-10"></div>
            <svg class="w-[600px] h-[600px] md:w-[800px] md:h-[800px] max-w-[150vw] object-contain overflow-visible mb-58" viewBox="-20 -20 296 299" fill="none" xmlns="http://www.w3.org/2000/svg">
              <foreignObject x="-10.8495" y="-10.5213" width="277.217" height="280.16">
                <div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(5.26px);clip-path:url(#bgblur_0_34_2_clip_path);height:100%;width:100%"></div>
              </foreignObject>
              <g filter="url(#filter0_d_34_2)" data-figma-bg-blur-radius="10.5213">
                <rect x="64.1191" width="180" height="180" rx="42.83" transform="rotate(15 64.1191 0)" fill="url(#paint0_linear_34_2)" shape-rendering="crispEdges" />
                <rect x="64.4624" y="0.594585" width="179.029" height="179.029" rx="42.3445" transform="rotate(15 64.4624 0.594585)" stroke="url(#paint1_linear_34_2)" stroke-width="0.970954" shape-rendering="crispEdges" />
                <path d="M74.867 104.978L77.0462 96.8448L113.417 91.2365L110.91 100.594L86.2402 103.568L86.6705 103.163L86.361 104.318L86.1906 103.753L106.068 118.663L103.561 128.02L74.867 104.978ZM146.285 86.9433L115.855 139.512L107.376 137.239L137.806 84.6711L146.285 86.9433ZM175.395 131.914L139.024 137.523L141.531 128.165L166.201 125.191L165.771 125.596L166.08 124.441L166.25 125.006L146.373 110.097L148.88 100.739L177.574 123.781L175.395 131.914Z" class="fill-gray-800 dark:fill-white" />
              </g>
              <defs>
                <filter id="filter0_d_34_2" x="-10.8495" y="-10.5213" width="277.217" height="280.16" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                  <feFlood flood-opacity="0" result="BackgroundImageFix" />
                  <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                  <feOffset dy="20.8034" />
                  <feGaussianBlur stdDeviation="14.1906" />
                  <feComposite in2="hardAlpha" operator="out" />
                  <feColorMatrix type="matrix" values="0 0 0 0 0.00753472 0 0 0 0 0.00920856 0 0 0 0 0.129167 0 0 0 0.1 0" />
                  <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_34_2" />
                  <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_34_2" result="shape" />
                </filter>
                <clipPath id="bgblur_0_34_2_clip_path" transform="translate(10.8495 10.5213)">
                  <rect x="64.1191" width="180" height="180" rx="42.83" transform="rotate(15 64.1191 0)" />
                </clipPath>
                <linearGradient id="paint0_linear_34_2" x1="103.924" y1="19.7599" x2="208.688" y2="179.742" gradientUnits="userSpaceOnUse">
                  <stop class="text-gray-800 dark:text-white" stop-color="currentColor" stop-opacity="0.1" />
                  <stop offset="1" class="text-gray-800 dark:text-white" stop-color="currentColor" stop-opacity="0.4" />
                </linearGradient>
                <linearGradient id="paint1_linear_34_2" x1="103.924" y1="-0.285138" x2="216.63" y2="179.742" gradientUnits="userSpaceOnUse">
                  <stop class="text-gray-800 dark:text-white" stop-color="currentColor" stop-opacity="0.12" />
                  <stop offset="1" class="text-gray-800 dark:text-white" stop-color="currentColor" stop-opacity="0.36" />
                </linearGradient>
              </defs>
            </svg>
          </div>

          <div id="about-content" class="relative inset-0 z-20 flex flex-col items-center justify-center text-center text-shadow-lg px-4 mt-12 md:mt-16 tracking-wide">
            <h2 class="text-5xl md:text-8xl lg:text-9xl bg-gradient-to-tl from-white via-slate-400 to-slate-600 bg-clip-text text-transparent font-bold">
              Luis Flores
            </h2>
            <p class="text-gray-900 dark:text-gray-200 mt-4 md:text-2xl lg:text-4xl">
              Welcome, nice to meet you!
            </p>

            <div class="socials-row mt-4">
              <div class="icon-wrapper">
                <div class="tooltip">
                  <p>Wanna talk? Let's connect!</p>
                </div>
                <a id="linkedin" href="https://www.linkedin.com/in/luis-flores" target="_blank" rel="noopener noreferrer">
                  <svg class="btn-icon text-gray-500 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <circle cx="4" cy="4" r="2" fill="currentColor" class="li-c"></circle>
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4">
                      <path d="M4 10v10" class="li-p1"></path>
                      <path d="M10 10v10" class="li-p2"></path>
                      <path d="M10 15c0 -2.76 2.24 -5 5 -5c2.76 0 5 2.24 5 5v5" class="li-p3"></path>
                    </g>
                  </svg>
                </a>
              </div>
              <div class="icon-wrapper">
                <div class="tooltip">
                  <p>Checkout to some of my github projects!</p>
                </div>
                <a id="github" href="#" target="_blank" rel="noopener noreferrer">
                  <svg class="btn-icon text-gray-500 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M12 4c1.67 0 2.61 0.4 3 0.5c0.53 -0.43 1.94 -1.5 3.5 -1.5c0.34 1 0.29 2.22 0 3c0.75 1 1 2 1 3.5c0 2.19 -0.48 3.58 -1.5 4.5c-1.02 0.92 -2.11 1.37 -3.5 1.5c0.65 0.54 0.5 1.87 0.5 2.5c0 0.73 0 3 0 3M12 4c-1.67 0 -2.61 0.4 -3 0.5c-0.53 -0.43 -1.94 -1.5 -3.5 -1.5c-0.34 1 -0.29 2.22 0 3c-0.75 1 -1 2 -1 3.5c0 2.19 0.48 3.58 1.5 4.5c1.02 0.92 2.11 1.37 3.5 1.5c-0.65 0.54 -0.5 1.87 -0.5 2.5c0 0.73 0 3 0 3" class="gh-p1"></path>
                      <path d="M9 19c-1.41 0 -2.84 -0.56 -3.69 -1.19c-0.84 -0.63 -1.09 -1.66 -2.31 -2.31" class="gh-p2"></path>
                    </g>
                  </svg>
                </a>
              </div>
              <div class="icon-wrapper">
                <div class="tooltip">
                  <p>Follow me throught my Facebook Page!</p>
                </div>
                <a id="facebook" href="#" target="_blank" rel="noopener noreferrer">
                  <svg class="btn-icon text-gray-500 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4">
                      <path d="M17 4l-2 0c-2.5 0 -4 1.5 -4 4v12" class="fb-p1"></path>
                      <path d="M8 12h7" class="fb-p2"></path>
                    </g>
                  </svg>
                </a>
              </div>

            </div>
          </div>
        </section>
        <section id="projects" class="relative w-full min-h-[100dvh] mt-4 justify-center animate-on-scroll">
          <div class="text-gray-900 dark:text-gray-200 text-center font-light uppercase mb-8 md:text-2xl lg:text-4xl underline underline-offset-8 decoration-1">
            <h2>Projects</h2>
          </div>

          <div class="bento-grid">
            <div class="grid grid-cols-16 grid-rows-12 gap-4">
              <div class="magic-bento-card hover-bounce-card col-start-1 col-span-4 row-start-1 row-span-5 bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-10 border border-gray-100 rounded-4xl">
                Block 1
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-5 col-span-8 row-start-1 row-span-4 bg-blue-300 rounded-4xl">
                Block 2
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-13 col-span-4 row-start-1 row-span-5 bg-blue-300 rounded-4xl">
                Block 3
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-1 col-span-4 row-start-6 row-span-5 bg-blue-300 rounded-4xl">
                Block 4
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-5 col-span-4 row-start-5 row-span-3 bg-blue-300 rounded-4xl">
                Block 5
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-9 col-span-4 row-start-5 row-span-3 bg-blue-300 rounded-4xl">
                Block 6
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-5 col-span-4 row-start-8 row-span-3 bg-blue-300 rounded-4xl">
                Block 7
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-13 col-span-4 row-start-6 row-span-5 bg-blue-300 rounded-4xl">
                Block 8
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-9 col-span-4 row-start-8 row-span-3 bg-blue-300 rounded-4xl">
                Block 9
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-1 col-span-2 row-start-11 row-span-2 bg-blue-300 rounded-4xl">
                <svg width="144" height="162" viewBox="0 0 304 322" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M53 0H54V58H102V0H103V58H151V0H152V58H200V0H201V58H249V0H250V58H304V59H250V108H304V109H250V157H304V158H250V206H304V207H250V266H249V207H201V266H200V207H152V266H151V207H103V266H102V207H54V266H53V207H0V206H53V158H0V157H53V109H0V108H53V59H0V58H53V0ZM54 206H102V158H54V206ZM103 206H151V158H103V206ZM152 206H200V158H152V206ZM201 206H249V158H201V206ZM249 109V157H201V109H249ZM200 109V157H152V109H200ZM151 109V157H103V109H151ZM102 109V157H54V109H102ZM54 108H102V59H54V108ZM103 108H151V59H103V108ZM152 108H200V59H152V108ZM201 108H249V59H201V108Z" fill="url(#paint0_radial_3712_107)" />
                  <path d="M196.436 27.5788C196.149 28.0637 197.626 31.9654 199.611 36.0213C201.706 40.2756 202.345 41.7525 202.102 41.7525C201.794 41.7525 200.802 41.0912 198.53 39.3718C196.171 37.5863 195.951 37.4761 194.782 37.3879C193.15 37.2777 191.871 37.7627 191.871 38.4901C191.871 39.6143 192.356 43.053 192.687 44.3976C193.172 46.3815 194.231 48.7622 195.686 51.231C196.392 52.3772 196.943 53.3912 196.943 53.4794C196.943 53.7218 196.039 53.4794 194.473 52.8401C191.959 51.8261 191.651 52.2229 192.202 55.7718C192.93 60.4229 194.12 64.0379 196.259 68.0939C197.274 70.0557 198.089 71.3562 201.882 77.2417C204.285 80.967 205.851 84.1191 206.446 86.3896C207.086 88.8584 207.24 93.0466 206.777 95.6917C205.763 101.577 201.728 110.593 196.414 118.903C195.598 120.182 194.231 122.628 193.393 124.37C191.695 127.875 191.21 128.646 187.351 133.892C174.165 151.813 169.755 161.137 166.823 177.251C165.059 186.928 163.581 190.543 159.987 193.805C157.65 195.965 155.401 196.957 149.205 198.611C143.648 200.065 140.495 200.374 121.311 201.234C105.766 201.939 98.181 202.38 95.4027 202.777C93.9474 202.975 90.5958 203.107 85.5905 203.151L77.9832 203.218L77.5422 202.292C76.55 200.242 74.8521 199.14 72.6471 199.14C70.3319 199.14 68.4356 200.352 67.5977 202.358C67.1567 203.416 67.2008 205.532 67.708 206.678C68.149 207.736 69.4058 208.949 70.5083 209.412C71.5667 209.852 73.6835 209.808 74.8301 209.301C75.8885 208.861 77.1012 207.604 77.5643 206.524L77.8509 205.819L91.4558 205.686C98.9527 205.598 108.258 205.532 112.161 205.532C118.754 205.532 119.283 205.554 119.614 205.929C120.099 206.458 120.077 206.921 119.614 207.34C119.261 207.626 117.32 207.692 105.325 207.825C97.6959 207.891 91.3676 208.045 91.2573 208.155C90.9486 208.464 93.1757 209.941 95.3366 210.866C99.4379 212.63 102.062 213.027 112.932 213.468C129.183 214.151 134.255 215.011 148.543 219.507C156.79 222.13 168.763 225.106 175.576 226.23C182.566 227.421 183.382 227.465 193.966 227.465H203.889L207.262 226.737C214.649 225.15 217.978 223.607 225.056 218.449C229.18 215.451 232.487 213.842 236.875 212.674C239.102 212.101 239.389 212.079 246.004 211.969C254.317 211.858 255.419 212.013 260.425 213.886C263.997 215.231 265.254 215.54 267.789 215.782L269.267 215.914L270.898 214.79C271.802 214.195 272.596 213.6 272.662 213.49C272.728 213.379 271.758 212.299 270.479 211.087C267.9 208.596 266.466 207.78 262.872 206.744C257.095 205.069 253.082 203.372 250.37 201.432C249.576 200.859 247.79 199.316 246.401 198.015C241.395 193.254 240.028 192.703 230.789 191.865C228.011 191.601 225.586 191.358 225.409 191.292C224.99 191.16 225.211 179.477 225.718 175.333C227.195 163.232 230.657 152.651 236.037 143.701C237.801 140.77 239.676 138.08 242.63 134.267C246.754 128.955 248.451 126.133 249.708 122.43C250.899 118.925 251.075 117.492 251.053 111.298C251.053 105.501 250.789 102.238 249.642 93.1127C247.503 76.2277 242.277 61.9879 234.384 51.4734C232.179 48.5417 231.429 47.7482 230.613 47.5939C229.643 47.3734 229.378 47.131 228.827 45.8304C228.21 44.4858 227.107 43.4498 222.41 39.9229C215.707 34.875 209.754 31.2379 205.167 29.4084C201.794 28.0638 196.766 27.0277 196.436 27.5788ZM73.485 201.145C74.5434 201.498 75.6459 202.622 75.9105 203.614C76.55 205.973 74.0363 208.464 71.7431 207.714C69.8909 207.141 68.7664 205.223 69.2956 203.592C69.7366 202.204 71.1257 201.035 72.4928 200.925C72.6251 200.903 73.0661 201.013 73.485 201.145Z" fill="white" />
                  <path d="M25.0636 52.0916C24.0493 52.5545 22.8366 53.8109 22.3956 54.8911C21.9546 55.9491 21.9987 58.0652 22.5058 59.2115C22.9468 60.2695 24.2037 61.4819 25.3062 61.9448C26.3646 62.3857 28.4813 62.3416 29.6279 61.8346C30.6863 61.3937 31.8991 60.1373 32.3621 59.0131L32.6708 58.2857H46.9813C60.542 58.2857 61.2917 58.3077 61.6224 58.6824C62.1075 59.2115 62.0855 59.6744 61.6004 60.1152C61.2476 60.4459 60.5861 60.49 56.8376 60.49C53.4639 60.49 52.4938 60.5561 52.5599 60.7545C52.6261 60.9088 53.3537 61.504 54.1916 62.0771C55.0295 62.6502 55.7351 63.2233 55.7792 63.3556C55.8233 63.4658 55.5587 64.2373 55.1838 65.0308C54.809 65.8464 54.5003 66.5959 54.5003 66.7282C54.5003 66.8825 55.2059 67.698 56.0658 68.5577L57.6314 70.1448L57.036 70.5416C56.7053 70.762 55.691 71.1588 54.7649 71.4233C53.8167 71.6878 50.0462 73.1206 46.3639 74.5755L39.6607 77.2206L38.8889 76.5373C37.8085 75.5894 36.8603 75.2588 35.3389 75.2588C33.6851 75.2588 32.3401 75.8319 31.3699 76.912C30.3556 78.0583 30.0248 78.9841 30.0248 80.5271C30.0248 82.1803 30.5981 83.5249 31.6786 84.4948C32.8252 85.5088 33.7513 85.8394 35.2727 85.8394C38.2715 85.8394 40.3442 83.9658 40.5868 81.0341L40.7191 79.6233L47.3341 77.0002C50.9723 75.5674 54.1255 74.2889 54.3239 74.1566C54.5885 74.0023 60.6743 73.9362 73.1987 73.9362C90.8386 73.9362 91.7206 73.9583 92.0514 74.333C92.5365 74.862 92.5144 75.3249 92.0293 75.7658C91.6545 76.0964 90.4197 76.1405 78.9096 76.1405C71.3906 76.1405 66.1868 76.2287 66.1868 76.3389C66.1868 76.5814 70.3101 79.0502 74.3453 81.2104C76.7487 82.5109 87.2004 87.6029 87.465 87.6029C87.487 87.6029 88.5013 88.0437 89.67 88.5948C91.7427 89.5647 91.8088 89.6088 91.3678 89.9394C91.1032 90.1158 90.3315 90.4685 89.6479 90.711C88.4793 91.1077 87.7296 91.1298 79.8136 91.1298H71.2583L69.362 89.7411C67.7082 88.5287 67.5098 88.3083 67.62 87.8233C67.9949 86.3023 67.9949 84.2964 67.62 83.3265C67.179 82.2023 65.9001 80.9018 64.7315 80.4169C63.6731 79.976 61.5563 80.0201 60.4097 80.5271C59.3513 80.9679 58.1385 82.2244 57.6755 83.3265C57.2345 84.3846 57.2786 86.5007 57.7857 87.647C58.2708 88.7932 59.7702 90.1599 60.8948 90.4905C61.6886 90.733 63.7613 90.6669 64.9079 90.3583C65.415 90.226 65.834 90.4464 67.7964 91.8792L70.1117 93.5545H98.2474H126.383V94.6567V95.7588H115.799C109.559 95.7588 105.215 95.847 105.215 95.9572C105.215 96.0674 105.877 96.5303 106.715 96.9932C109.956 98.8007 114.917 102.195 114.917 102.614C114.917 102.724 114.52 103.011 114.035 103.253C113.396 103.584 112.734 103.694 111.499 103.694H109.824L109.427 102.746C108.986 101.71 107.729 100.498 106.626 100.035C105.568 99.5943 103.451 99.6384 102.305 100.145C101.246 100.586 100.033 101.843 99.5704 102.945C99.1294 104.003 99.1735 106.119 99.6807 107.265C100.122 108.323 101.379 109.536 102.481 109.999C103.539 110.439 105.656 110.395 106.803 109.888C107.927 109.403 108.743 108.566 109.471 107.221L110 106.229L130.462 106.163C152.777 106.119 151.961 106.075 151.961 107.331C151.961 108.566 152.248 108.544 136.813 108.544C129.029 108.544 122.613 108.61 122.569 108.698C122.502 108.808 123.186 109.668 124.09 110.638C124.994 111.608 125.722 112.534 125.722 112.688C125.722 112.842 125.06 113.283 124.222 113.68L122.745 114.385L112.58 114.451L102.437 114.517L99.1515 110.858C97.3434 108.83 95.6676 107.045 95.425 106.868C95.0502 106.626 93.7272 106.56 88.3029 106.56H81.6217L81.3351 105.832C80.9823 104.995 79.6372 103.76 78.6229 103.342C77.5646 102.901 75.4478 102.945 74.3012 103.452C73.2428 103.893 72.03 105.149 71.567 106.251C71.126 107.309 71.1701 109.425 71.6772 110.572C72.1182 111.63 73.3751 112.842 74.4776 113.305C75.536 113.746 77.6528 113.702 78.7994 113.195C79.968 112.71 81.313 111.211 81.6658 110.043L81.9084 109.205H87.9942H94.08L96.6819 112.115C98.1151 113.702 99.2397 115.113 99.1956 115.245C99.1515 115.377 96.5496 116.501 93.4185 117.736L87.7296 119.984L86.9578 119.301C85.8774 118.353 84.9292 118.022 83.4078 118.022C81.754 118.022 80.409 118.595 79.4388 119.675C78.4245 120.822 78.0938 121.748 78.0938 123.291C78.0938 124.944 78.667 126.288 79.7475 127.258C80.8941 128.272 81.8202 128.603 83.3416 128.603C86.3404 128.603 88.4131 126.729 88.6557 123.798L88.788 122.387L95.403 119.764C99.0412 118.331 102.194 117.052 102.393 116.92C102.657 116.766 108.743 116.7 121.268 116.7C138.908 116.7 139.79 116.722 140.12 117.096C140.605 117.625 140.583 118.088 140.098 118.529C139.745 118.86 139.084 118.904 135.38 118.904C133.02 118.904 131.036 118.97 130.948 119.036C130.881 119.124 131.102 119.587 131.433 120.094C132.447 121.549 134.983 126.024 134.983 126.332C134.983 126.487 134.387 126.906 133.66 127.28L132.359 127.942H125.832H119.305L118.908 126.994C118.467 125.958 117.21 124.745 116.108 124.282C115.049 123.842 112.933 123.886 111.786 124.393C110.728 124.834 109.515 126.09 109.052 127.192C108.611 128.25 108.655 130.366 109.162 131.513C109.603 132.571 110.86 133.783 111.962 134.246C113.021 134.687 115.138 134.643 116.284 134.136C117.409 133.651 118.225 132.813 118.952 131.468L119.482 130.477L139.944 130.41C162.258 130.366 161.443 130.322 161.443 131.579C161.443 132.791 161.443 132.791 149.492 132.791C142.965 132.791 138.489 132.879 138.4 132.989C138.334 133.1 138.599 133.981 138.974 134.929C140.429 138.566 141.818 142.534 141.708 142.732C141.443 143.129 139.569 144.099 138.048 144.606L136.482 145.135H120.738H104.995L103.098 143.746C101.445 142.534 101.246 142.314 101.356 141.829C101.731 140.308 101.731 138.302 101.356 137.332C100.915 136.208 99.6366 134.907 98.4679 134.422C97.4095 133.981 95.2927 134.025 94.1461 134.532C93.0877 134.973 91.875 136.23 91.4119 137.332C90.9709 138.39 91.015 140.506 91.5222 141.652C92.0073 142.799 93.5067 144.165 94.6312 144.496C95.425 144.738 97.4977 144.672 98.6443 144.364C99.1515 144.231 99.5925 144.474 101.687 145.995L104.157 147.78H106.119C107.2 147.78 108.082 147.846 108.082 147.935C108.082 148.023 107.663 148.75 107.178 149.588L106.274 151.087H99.9894H93.7272L93.3303 150.139C92.8893 149.103 91.6324 147.891 90.5299 147.428C89.4715 146.987 87.3547 147.031 86.2081 147.538C85.1497 147.979 83.937 149.235 83.4739 150.337C83.0329 151.395 83.077 153.511 83.5842 154.658C84.0252 155.716 85.282 156.928 86.3845 157.391C87.4429 157.832 89.5597 157.788 90.7063 157.281C91.7647 156.84 92.9775 155.584 93.4405 154.459L93.7492 153.732H100.695C107.354 153.732 107.663 153.71 108.082 153.291C108.324 153.049 108.523 152.762 108.523 152.652C108.523 152.277 111.191 148.111 111.676 147.736C112.117 147.384 113.55 147.339 132.359 147.339C151.652 147.339 152.579 147.361 152.909 147.736C153.394 148.265 153.372 148.728 152.887 149.169C152.534 149.5 151.873 149.544 148.367 149.544C146.118 149.544 144.222 149.632 144.155 149.72C144.089 149.83 144.288 150.734 144.596 151.77C145.39 154.459 145.346 154.548 143.273 155.606L141.509 156.487L136.041 156.553L130.573 156.62L130.154 155.672C129.713 154.614 128.456 153.401 127.353 152.938C126.295 152.498 124.178 152.542 123.032 153.049C121.973 153.489 120.76 154.746 120.297 155.848C119.856 156.906 119.9 159.022 120.408 160.168C120.849 161.227 122.105 162.439 123.208 162.902C124.266 163.343 126.383 163.299 127.53 162.792C128.654 162.307 129.47 161.469 130.198 160.124L130.727 159.132L143.692 159.066C157.804 159.022 157.694 159 157.694 160.213C157.694 161.249 157.297 161.337 152.093 161.447L147.22 161.557L147.287 162.681C147.353 163.739 147.309 163.872 146.713 164.291C146.338 164.533 145.434 165.04 144.663 165.415L143.251 166.076H127.089H110.926L110.529 165.128C110.088 164.092 108.831 162.88 107.729 162.417C106.67 161.976 104.554 162.02 103.407 162.527C102.349 162.968 101.136 164.224 100.673 165.327C100.232 166.385 100.276 168.501 100.783 169.647C101.224 170.705 102.481 171.917 103.584 172.38C104.642 172.821 106.759 172.777 107.905 172.27C109.03 171.785 109.846 170.948 110.573 169.603L111.103 168.611H132.028H152.953V169.713V170.815L151.079 170.881C150.043 170.925 149.139 171.014 149.028 171.124C148.94 171.212 149.028 172.358 149.227 173.637C149.425 174.915 149.536 176.128 149.469 176.304C149.403 176.48 148.477 177.053 147.419 177.582L145.5 178.53L132.315 178.641C123.076 178.707 119.063 178.817 118.886 178.993C118.754 179.125 118.07 180.228 117.387 181.418L116.13 183.6L114.697 183.71C112.889 183.865 111.918 184.306 110.97 185.364C109.956 186.51 109.625 187.436 109.625 188.979C109.625 191.227 110.86 193.145 112.844 193.982C113.903 194.423 116.02 194.379 117.166 193.872C118.225 193.431 119.437 192.175 119.9 191.073C120.562 189.486 120.077 186.356 119.018 185.496C118.82 185.342 118.666 185.055 118.666 184.879C118.666 184.526 120.099 181.837 120.606 181.22C120.915 180.867 122.105 180.845 139.812 180.845C156.548 180.845 158.753 180.889 159.193 181.198C159.789 181.594 159.811 182.189 159.282 182.674C158.951 182.983 158.201 183.049 154.695 183.093L150.528 183.159L150.594 183.931C150.726 185.562 151.322 189.927 151.542 190.963C151.917 192.726 152.071 192.836 153.483 192.285C155.225 191.624 155.842 191.271 156.856 190.367C159.216 188.251 160.494 184.901 161.906 177.274C163.736 167.156 165.5 161.469 169.16 153.842C172.049 147.802 176.988 139.889 182.566 132.416C186.161 127.589 187.77 125.164 188.829 122.96C189.711 121.152 189.711 121.108 189.336 120.535C188.762 119.653 185.058 116.082 181.971 113.437C174.584 107.067 166.867 101.755 152.512 93.1357C141.068 86.2583 134.012 82.555 124.288 78.2567C111.698 72.6798 83.3196 62.1212 68.2815 57.3819C63.2321 55.7948 64.1361 55.8609 47.6207 55.8609H32.7149L32.318 54.869C31.8991 53.7669 30.5981 52.4663 29.4515 51.9814C28.4372 51.5626 26.1441 51.6066 25.0636 52.0916ZM28.2829 53.6787C29.3413 54.0314 30.4438 55.1556 30.7084 56.1475C31.3478 58.5061 28.8341 60.997 26.541 60.2475C24.6888 59.6744 23.5642 57.7567 24.0934 56.1255C24.5344 54.7368 25.9236 53.5685 27.2906 53.4583C27.4229 53.4362 27.8639 53.5464 28.2829 53.6787ZM36.2209 77.2647C37.2793 77.6174 38.3818 78.7416 38.6464 79.7335C39.2858 82.0921 36.7721 84.583 34.4789 83.8335C32.6267 83.2604 31.5022 81.3427 32.0314 79.7115C32.4724 78.3228 33.8615 77.1545 35.2286 77.0443C35.3609 77.0222 35.8019 77.1325 36.2209 77.2647ZM63.5628 82.1142C64.6212 82.4669 65.7237 83.5911 65.9883 84.583C66.6278 86.9416 64.1141 89.4325 61.8209 88.683C59.9687 88.1099 58.8441 86.1921 59.3733 84.561C59.8143 83.1722 61.2035 82.004 62.5706 81.8937C62.7029 81.8717 63.1439 81.9819 63.5628 82.1142ZM133.704 93.9292C134.211 94.3921 134.211 94.9212 133.682 95.4061C133.351 95.7147 132.888 95.7588 130.992 95.7147L128.698 95.6486L128.632 94.9212C128.5 93.5986 128.566 93.5545 131.036 93.5545C132.822 93.5545 133.373 93.6206 133.704 93.9292ZM105.458 101.732C106.516 102.085 107.619 103.209 107.883 104.201C108.523 106.56 106.009 109.051 103.716 108.301C101.864 107.728 100.739 105.81 101.268 104.179C101.709 102.791 103.098 101.622 104.465 101.512C104.598 101.49 105.039 101.6 105.458 101.732ZM77.4543 105.039C78.5127 105.392 79.6152 106.516 79.8798 107.508C80.5192 109.866 78.0056 112.357 75.7124 111.608C73.8602 111.035 72.7356 109.117 73.2648 107.486C73.7058 106.097 75.095 104.929 76.4621 104.818C76.5944 104.796 77.0354 104.907 77.4543 105.039ZM84.2898 120.028C85.3482 120.381 86.4507 121.505 86.7153 122.497C87.3547 124.856 84.841 127.346 82.5478 126.597C80.6956 126.024 79.5711 124.106 80.1003 122.475C80.5413 121.086 81.9304 119.918 83.2975 119.808C83.4298 119.786 83.8708 119.896 84.2898 120.028ZM114.939 125.98C115.998 126.332 117.1 127.457 117.365 128.449C118.004 130.807 115.49 133.298 113.197 132.549C111.345 131.975 110.221 130.058 110.75 128.427C111.191 127.038 112.58 125.87 113.947 125.759C114.079 125.737 114.52 125.848 114.939 125.98ZM97.2993 136.12C98.3577 136.472 99.4602 137.596 99.7248 138.588C100.364 140.947 97.8505 143.438 95.5573 142.688C93.7051 142.115 92.5806 140.198 93.1098 138.566C93.5508 137.178 94.9399 136.009 96.307 135.899C96.4393 135.877 96.8803 135.987 97.2993 136.12ZM165.897 147.714C166.404 148.177 166.404 148.706 165.897 149.191C165.522 149.5 164.882 149.544 160.318 149.5L155.158 149.434L155.092 148.706C154.96 147.295 154.761 147.339 160.362 147.339C164.816 147.339 165.544 147.384 165.897 147.714ZM89.3613 149.125C90.4197 149.478 91.5222 150.602 91.7868 151.594C92.4262 153.952 89.9125 156.443 87.6193 155.694C85.7671 155.121 84.6426 153.203 85.1718 151.572C85.6128 150.183 87.0019 149.015 88.369 148.905C88.5013 148.882 88.9423 148.993 89.3613 149.125ZM126.185 154.636C127.243 154.988 128.346 156.113 128.61 157.105C129.25 159.463 126.736 161.954 124.443 161.205C122.591 160.631 121.466 158.714 121.995 157.082C122.436 155.694 123.825 154.525 125.192 154.415C125.325 154.393 125.766 154.503 126.185 154.636ZM106.56 164.114C107.619 164.467 108.721 165.591 108.986 166.583C109.625 168.942 107.111 171.432 104.818 170.683C102.966 170.11 101.842 168.192 102.371 166.561C102.812 165.172 104.201 164.004 105.568 163.894C105.7 163.872 106.141 163.982 106.56 164.114ZM161.266 168.875C161.773 169.338 161.773 169.867 161.244 170.352C160.913 170.661 160.45 170.705 158.554 170.661L156.261 170.595L156.195 169.867C156.062 168.545 156.129 168.501 158.598 168.501C160.384 168.501 160.935 168.567 161.266 168.875ZM115.821 185.716C116.88 186.069 117.982 187.193 118.247 188.185C118.886 190.544 116.372 193.035 114.079 192.285C112.227 191.712 111.103 189.794 111.632 188.163C112.073 186.774 113.462 185.606 114.829 185.496C114.961 185.474 115.402 185.584 115.821 185.716Z" fill="white" />
                  <path d="M95.592 274.2H102.2V312H95.592V274.2ZM111.23 274.2H131.726C140.238 274.2 143.878 279.464 143.878 285.512C143.878 290.216 141.638 295.256 135.87 296.88L144.662 312H137.326L128.702 297.384H118.846C118.23 297.384 117.894 297.664 117.894 298.336V312H111.286V297.048C111.286 292.792 113.078 291.056 117.222 291.056H131.95C135.702 291.056 137.214 288.48 137.214 285.792C137.214 283.104 135.59 280.808 131.95 280.808H111.23V274.2ZM151.319 274.2H157.927V312H151.319V274.2ZM177.093 274.2H196.245V280.808H176.869C173.453 280.808 171.941 282.656 171.941 285.288C171.941 287.584 173.117 289.768 177.541 289.768H186.389C196.693 289.768 199.101 295.48 199.101 300.912C199.101 307.296 195.685 312 187.061 312H166.005V305.392H187.285C190.869 305.392 192.493 303.432 192.493 300.688C192.493 298.224 191.205 295.984 186.557 295.984H177.765C167.685 295.984 165.333 290.328 165.333 285.064C165.333 278.792 168.693 274.2 177.093 274.2Z" fill="url(#paint1_linear_3712_107)" />
                  <defs>
                    <radialGradient id="paint0_radial_3712_107" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(152 133) rotate(90) scale(133 152)">
                      <stop stop-color="white" stop-opacity="0.65" />
                      <stop offset="1" stop-color="#838AA7" stop-opacity="0" />
                    </radialGradient>
                    <linearGradient id="paint1_linear_3712_107" x1="147" y1="346.5" x2="146.288" y2="253.805" gradientUnits="userSpaceOnUse">
                      <stop stop-color="#8AA6FF" />
                      <stop offset="1" stop-color="white" />
                    </linearGradient>
                  </defs>
                </svg>
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-3 col-span-2 row-start-11 row-span-2 bg-blue-300 rounded-4xl">
                <svg width="144" height="162" viewBox="0 0 80 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_2466_1133)">
                    <path d="M32.7154 0.192372C32.8357 0.751559 32.986 1.11834 33.443 2.00221C33.7196 2.54336 33.936 3.00033 33.918 3.01837C33.8999 3.03641 33.6474 2.86204 33.3588 2.63356C33.0702 2.39906 32.7695 2.1826 32.6974 2.14051C32.529 2.05633 32.1262 2.05633 31.9278 2.14652C31.7774 2.21266 31.7774 2.21867 31.8135 2.6997C31.8856 3.61364 32.0901 4.18486 32.6493 5.07473C32.7635 5.25511 32.8477 5.41146 32.8357 5.4235C32.8297 5.43549 32.6252 5.36334 32.3907 5.26715C31.9819 5.09881 31.9638 5.09277 31.8676 5.201C31.7714 5.30323 31.7714 5.35734 31.8556 5.93457C32.054 7.23933 32.487 8.24347 33.5512 9.83085C33.942 10.4081 34.3509 11.0815 34.4651 11.322C35.0424 12.5606 35.0544 13.7512 34.4952 15.2724C34.0563 16.463 33.461 17.6294 32.6914 18.8199C32.4749 19.1507 32.2224 19.6076 32.1262 19.8421C31.8737 20.4554 31.7233 20.6899 30.8154 21.9165C28.1758 25.4761 27.1776 27.6106 26.6425 30.8215C26.3539 32.5411 26.0412 33.3408 25.4159 33.9721C24.977 34.4171 24.5982 34.6275 23.8466 34.85C22.2051 35.337 21.688 35.4092 19.0304 35.5295C12.2359 35.8361 12.0916 35.8481 11.4242 36.0766C11.1596 36.1668 10.9251 36.257 10.9011 36.281C10.8289 36.3472 11.0755 36.9484 11.2498 37.1349C11.5625 37.4656 12.4584 37.8444 13.2761 38.0007C13.5587 38.0488 14.4847 38.1149 15.4227 38.151C18.8259 38.2773 20.0886 38.4757 22.5178 39.2634C24.2554 39.8286 26.7086 40.4599 28.1998 40.7305C29.7271 41.0011 30.4847 41.0672 32.2284 41.0672C33.7015 41.0672 34.0022 41.0492 34.6335 40.9349C36.275 40.6343 37.1348 40.2735 38.3133 39.3776C39.1551 38.7403 39.8225 38.3675 40.5561 38.133C41.3498 37.8744 41.8188 37.8203 43.1716 37.8263C44.6388 37.8263 44.9334 37.8804 46.0035 38.3074C46.5749 38.5298 46.8152 38.596 47.1882 38.62L47.6513 38.6501L48.4103 38.133L47.6513 37.3754L47.4587 37.2311C47.1462 36.9966 46.9356 36.9064 46.1419 36.6779C44.5125 36.2029 43.803 35.806 42.871 34.868C42.0352 34.0202 41.5783 33.8339 39.9789 33.7015C39.5219 33.6655 39.0288 33.6174 38.8845 33.6054L38.626 33.5753L38.638 32.4509C38.65 31.1101 38.7523 30.0879 38.9928 28.8432C39.5279 26.1495 40.4899 24.0871 42.2337 21.9165C42.9672 21.0026 43.334 20.4013 43.5986 19.6978C44.0856 18.405 44.0976 17.2566 43.6767 13.7091C43.2258 9.93908 42.1074 6.95071 40.2675 4.64785C39.9668 4.26903 39.8646 4.18485 39.7083 4.16681C39.5399 4.14878 39.5039 4.1127 39.4257 3.89624C39.3295 3.5956 39.107 3.38515 38.0006 2.55539C36.0345 1.08226 34.5854 0.31864 33.3167 0.0961666C32.7335 -0.0120632 32.6733 -3.63719e-05 32.7154 0.192372Z" fill="white" />
                    <path d="M28.188 5.56786C24.6645 5.79032 21.1651 6.63213 17.9783 8.02707C17.1726 8.38184 16.421 8.74861 16.4511 8.77264C16.4631 8.78468 16.9321 8.98311 17.4912 9.2236L18.5134 9.65652L19.2229 9.31984C22.3917 7.82266 25.9032 6.85458 29.2823 6.55393C31.1222 6.38559 31.002 6.40363 30.9719 6.2954C30.9539 6.24128 30.9238 6.03686 30.8998 5.84444L30.8637 5.50171L29.8896 5.50771C29.3605 5.51375 28.5909 5.53779 28.188 5.56786Z" fill="white" />
                    <path d="M2.14511 6.28256C2.34246 6.67471 2.88227 7.15333 3.56719 7.55123C3.5788 7.55703 3.50915 7.71848 3.41047 7.90879L3.23634 8.25479L3.65426 8.6527C5.05893 10.0021 6.86411 11.0517 10.5441 12.6779C13.5566 14.0043 15.2283 15.0481 16.6968 16.5128C18.3336 18.139 19.4365 20.0248 20.4406 22.9082C21.3577 25.5609 21.9556 28.3635 22.298 31.6679C22.3503 32.1581 22.4316 32.654 22.478 32.7751L22.5709 33L22.8088 32.9135C23.8362 32.5502 24.2193 31.8697 24.5618 29.7821C25.0784 26.6623 26.2218 24.2691 28.8338 20.8321C29.4491 20.0306 29.809 19.4423 29.9831 18.9867C30.0353 18.8483 29.9947 18.7964 29.4491 18.2601C27.8703 16.7204 26.0825 15.4287 22.7566 13.4449C20.2317 11.9282 18.7806 11.1901 16.2905 10.129C14.0151 9.16016 9.61541 7.54548 6.185 6.42671C5.09375 6.07495 4.79194 6.02305 4.45525 6.1384C4.31016 6.1903 4.27533 6.23066 4.27533 6.36906C4.27533 6.46131 4.26954 6.53631 4.25792 6.53631C4.24629 6.53631 3.93867 6.43251 3.573 6.29986C3.10284 6.13261 2.7836 6.05765 2.45855 6.0346L2 6L2.14511 6.28256Z" fill="white" />
                    <path d="M8.74838 14.3826C7.52782 15.6092 6.73413 16.5292 5.88633 17.6776C2.5372 22.2232 0.625137 27.286 0.083987 33.0402C-0.0182301 34.0744 -0.0182301 37.0447 0.083987 38.0609C0.468804 42.1256 1.48497 45.733 3.16253 49.0341C3.77583 50.2426 4.10653 50.8081 4.82807 51.9202C6.64994 54.7283 9.01296 57.2898 11.6345 59.3222C18.8498 64.9078 28.1576 66.9042 37.0866 64.7757C37.5135 64.6796 37.8502 64.5894 37.8382 64.5772C37.8262 64.5651 37.4774 64.6075 37.0686 64.6733C35.0062 64.9863 32.1381 65.1125 30.184 64.9741C23.63 64.4929 17.7555 62.124 12.6868 57.9089C11.7788 57.1513 9.91487 55.2934 9.16326 54.3856C6.65593 51.3732 4.88818 48.1984 3.70969 44.5848C2.97613 42.348 2.55524 40.1654 2.36884 37.6701C2.28466 36.5337 2.33277 33.7437 2.45903 32.7096C2.50713 32.3127 2.56726 31.8317 2.59131 31.6392L2.6334 31.2965H12.4523H22.2771V31.1282C22.2771 30.9658 22.1569 30.1601 22.0306 29.4446L21.9645 29.0718H12.5304C7.34139 29.0718 3.09639 29.0538 3.09639 29.0357C3.09639 28.9876 3.32487 28.0857 3.4331 27.7009L3.5233 27.3882H12.5725C17.5451 27.3882 21.6157 27.3702 21.6157 27.3401C21.6157 27.3161 21.4955 26.8291 21.3452 26.2578C21.1948 25.6806 21.0746 25.1996 21.0746 25.1876C21.0746 25.1755 17.3046 25.1575 12.6928 25.1515L4.31097 25.1335L4.58153 24.5021C4.72583 24.1533 4.88818 23.7806 4.9363 23.6723L5.02049 23.4799H12.7469C17.7375 23.4799 20.4733 23.4619 20.4733 23.4198C20.4733 23.3356 20.2148 22.6562 19.8901 21.9046L19.6135 21.2552H12.9213C9.23542 21.2552 6.22302 21.2432 6.22302 21.2191C6.22302 21.2011 6.42748 20.8584 6.68002 20.4555C7.93666 18.4532 9.56011 16.451 11.2257 14.8576L11.9953 14.112L11.1716 13.7392C10.7146 13.5348 10.2516 13.3243 10.1373 13.2762L9.92691 13.186L8.74838 14.3826Z" fill="white" />
                    <path d="M46.8215 48.2526C46.2141 48.4149 45.7753 48.6796 45.2761 49.1784C44.783 49.6717 44.4163 50.345 44.2178 51.1085C44.0555 51.7101 44.0254 53.1531 44.1577 53.8142C44.5124 55.5942 45.631 56.7667 47.2242 57.0314C48.3065 57.2118 49.5029 56.8569 50.2605 56.1412C50.6754 55.7443 51.0786 55.0291 51.2346 54.4158C51.2707 54.2652 51.2707 54.2652 50.8738 54.2652C50.495 54.2652 50.477 54.2715 50.4409 54.4275C50.3809 54.6801 50.1523 55.1071 49.9358 55.3777C49.3586 56.0992 48.3304 56.4781 47.3627 56.3098C46.16 56.1114 45.2883 55.2275 44.9454 53.8747C44.7951 53.2794 44.777 52.0465 44.9153 51.4093C45.1079 50.5074 45.751 49.5694 46.4305 49.2027C47.1462 48.8176 48.1262 48.7455 48.8599 49.0341C49.5512 49.3047 50.1225 49.8882 50.3688 50.5795L50.5072 50.9583H50.8802C51.0903 50.9583 51.259 50.9344 51.259 50.9042C51.259 50.874 51.2048 50.6756 51.1386 50.4654C50.808 49.3831 49.7437 48.4271 48.6254 48.1985C48.1383 48.0961 47.3203 48.1204 46.8215 48.2526Z" fill="white" />
                    <path d="M75.2862 48.2286C74.4321 48.4328 73.5604 49.0944 73.0914 49.8881C72.6166 50.6998 72.3821 51.8241 72.4479 52.9424C72.5381 54.5537 73.1397 55.7744 74.1859 56.4721C74.829 56.905 75.3584 57.061 76.1818 57.0552C77.2885 57.0552 77.9979 56.7666 78.7496 56.0089C79.4711 55.2815 79.8197 54.4518 79.9401 53.2008C80.1746 50.7115 79.0139 48.6732 77.1018 48.2222C76.6328 48.114 75.7552 48.114 75.2862 48.2286ZM76.8254 48.9199C77.9077 49.1485 78.7374 50.0324 79.0802 51.319C79.2425 51.9323 79.2245 53.3632 79.0499 53.9945C78.7316 55.107 78.07 55.8705 77.1501 56.1893C76.116 56.5442 74.9855 56.2917 74.2337 55.5458C73.813 55.1251 73.4283 54.3796 73.2957 53.7361C73.1758 53.1589 73.1816 52.0405 73.302 51.4511C73.5546 50.2128 74.3902 49.2324 75.4364 48.9501C75.8333 48.8419 76.3983 48.8297 76.8254 48.9199Z" fill="white" />
                    <path d="M19.1509 52.612V56.9709H19.5116H19.8724V53.4115C19.8724 51.343 19.8964 49.876 19.9265 49.9062C19.9566 49.9423 20.636 51.5414 21.4417 53.4656L22.8969 56.9709H23.2456C23.462 56.9709 23.6004 56.9412 23.6184 56.8929C23.6965 56.7067 26.3301 50.4113 26.4384 50.1646C26.5045 50.0081 26.5827 49.8941 26.6128 49.9121C26.6428 49.9301 26.6669 51.4936 26.6669 53.4598V56.9709H27.0276H27.3884V52.612V48.2526H26.9254H26.4564L24.8871 52.0284C23.9912 54.1872 23.2877 55.7984 23.2396 55.7984C23.1975 55.7984 22.494 54.1813 21.5981 52.0226L20.0227 48.2526H19.5898H19.1509V52.612Z" fill="white" />
                    <path d="M29.7334 52.612V56.9709H32.2888H34.8442V56.6102V56.2494H32.6556H30.467L30.4609 54.5962L30.4549 52.9425H32.4692H34.4835V52.612C34.4835 52.3892 34.4594 52.281 34.4113 52.2751C34.3693 52.2751 33.4673 52.2693 32.4091 52.2629L30.485 52.2512V50.5975V48.9439L32.6376 48.9258L34.7841 48.9141V48.5831V48.2526H32.2588H29.7334V52.612Z" fill="white" />
                    <path d="M36.8403 52.612V56.9709H37.2251H37.6099V55.1973V53.4237H38.8125H40.009L40.1594 53.6762C40.2375 53.8205 40.6645 54.5962 41.0974 55.4079C41.5303 56.2196 41.9091 56.9051 41.9331 56.929C41.9572 56.9529 42.1736 56.9709 42.4021 56.9592L42.823 56.9412L41.8429 55.1373C41.3018 54.1452 40.8568 53.3213 40.8568 53.2974C40.8568 53.2794 40.9951 53.2009 41.1695 53.1171C42.0895 52.69 42.6066 51.5897 42.4322 50.4172C42.3059 49.5274 41.861 48.8898 41.1395 48.5534C40.5803 48.2886 40.2676 48.2526 38.4818 48.2526H36.8463L36.8403 52.612ZM40.5382 49.0643C40.947 49.2027 41.3018 49.5094 41.5062 49.8999C41.6505 50.1768 41.6686 50.267 41.6686 50.8379C41.6686 51.4273 41.6566 51.4936 41.4882 51.8003C41.386 51.9806 41.1936 52.2151 41.0493 52.3234C40.6163 52.6539 40.3337 52.7022 38.8907 52.7022H37.6099V50.8501C37.6099 49.8278 37.628 48.9741 37.6521 48.9502C37.6821 48.9258 38.2654 48.9141 38.9628 48.9258C39.991 48.9502 40.2857 48.9741 40.5382 49.0643Z" fill="white" />
                    <path d="M53.1826 51.3673C53.1826 54.7946 53.1889 54.8546 53.5556 55.54C53.6638 55.7385 53.8983 56.0393 54.1026 56.2255C54.752 56.8266 55.4735 57.0913 56.4719 57.0913C58.0471 57.0913 59.2016 56.3035 59.6525 54.9267C59.7486 54.6323 59.7608 54.2715 59.7847 51.4214L59.8027 48.2526H59.4122H59.0212L59.0031 51.361C58.9792 54.8366 58.9792 54.8126 58.558 55.3836C58.1012 56.0032 57.5118 56.3035 56.6703 56.3518C55.5096 56.4239 54.6379 55.9671 54.1928 55.0589L53.9943 54.6562L53.9763 51.4575L53.9583 48.2526H53.5736H53.1826V51.3673Z" fill="white" />
                    <path d="M62.1421 52.612V56.9709H62.5029H62.8636L62.8758 55.2095L62.8938 53.4535L64.0961 53.4417L65.2988 53.4237L66.2007 55.113C66.6999 56.0451 67.1328 56.8447 67.1626 56.8929C67.2109 56.9529 67.3313 56.9709 67.656 56.9592L68.0826 56.9412L67.0968 55.1373C66.5556 54.1452 66.1105 53.3155 66.1105 53.2974C66.1105 53.2794 66.2246 53.2072 66.3631 53.1468C67.283 52.7319 67.7881 51.8003 67.7159 50.6575C67.656 49.6835 67.2591 49.016 66.5132 48.6075C65.918 48.2886 65.6415 48.2526 63.7836 48.2526H62.1421V52.612ZM65.8039 49.0584C66.0384 49.1364 66.2129 49.2505 66.4352 49.4733C66.8018 49.8458 66.9525 50.2368 66.9525 50.832C66.9525 51.6496 66.6458 52.1849 66.0023 52.5037C65.6596 52.672 65.6537 52.672 64.2647 52.69L62.8636 52.7139V50.8501C62.8636 49.8278 62.8817 48.9741 62.9119 48.9502C62.9358 48.9258 63.5252 48.9141 64.2165 48.9322C65.1964 48.9502 65.5513 48.98 65.8039 49.0584Z" fill="white" />
                    <path d="M69.7183 52.612V56.9709H70.1092H70.4998V52.612V48.2526H70.1092H69.7183V52.612Z" fill="white" />
                    <path d="M45.673 59.3944C45.7691 59.4846 45.7871 59.5865 45.7871 60.1457C45.7871 60.5547 45.7573 60.8433 45.7091 60.9393L45.6311 61.09L46.1118 61.1017C46.6169 61.1139 46.7675 61.0719 46.8635 60.8852C46.9235 60.777 46.9177 60.777 46.7071 60.8852C46.5808 60.9515 46.3643 60.9998 46.2263 60.9998H45.9675V60.2358C45.9675 59.6649 45.9918 59.4543 46.0518 59.3822C46.1298 59.2979 46.1059 59.2861 45.8475 59.2861C45.5648 59.2861 45.5589 59.2861 45.673 59.3944Z" fill="white" />
                    <path d="M47.6211 59.5985C47.5309 59.7911 47.3627 60.1636 47.2481 60.4283C47.1282 60.693 46.9956 60.9573 46.9415 61.0114C46.8576 61.1138 46.8693 61.1196 47.116 61.1196C47.3266 61.1137 47.3564 61.1016 47.2784 61.0538C47.1462 60.9753 47.1399 60.8793 47.2725 60.6087C47.3744 60.3922 47.3744 60.3922 47.7352 60.4103L48.0901 60.4283L48.1744 60.6687C48.2285 60.8251 48.2403 60.9392 48.2042 61.0055C48.1564 61.0835 48.1861 61.0957 48.4387 61.0957C48.6912 61.0957 48.7156 61.0898 48.6132 61.0177C48.5532 60.9753 48.3607 60.5785 48.1925 60.1397C48.0179 59.7068 47.8556 59.3221 47.8317 59.2977C47.8073 59.268 47.7113 59.406 47.6211 59.5985ZM47.8556 59.815C48.0481 60.284 48.0481 60.2781 47.7474 60.2781C47.5972 60.2781 47.4709 60.2538 47.4709 60.224C47.4709 60.1519 47.7113 59.6166 47.7415 59.6166C47.7595 59.6166 47.8073 59.7068 47.8556 59.815Z" fill="white" />
                    <path d="M48.8837 59.406C49.028 59.5445 49.0339 59.5927 49.0339 60.2241C49.0339 60.7291 49.01 60.9212 48.95 60.9934C48.8716 61.0836 48.8837 61.0899 49.1061 61.0958C49.3225 61.1016 49.3406 61.0958 49.2567 61.0295C49.1665 60.9636 49.1543 60.8671 49.1665 60.3621L49.1845 59.7731L49.7856 60.4586L50.3868 61.144L50.4048 60.2782C50.4111 59.8029 50.4472 59.388 50.4711 59.3519C50.5072 59.3041 50.4409 59.2861 50.2546 59.2798C49.9841 59.2739 49.9841 59.2739 50.1405 59.3582C50.2966 59.4362 50.2966 59.4484 50.2966 60.0676C50.2966 60.4162 50.2907 60.6989 50.2785 60.6989C50.2668 60.6989 49.9719 60.3742 49.6292 59.9774C49.1904 59.4723 48.9617 59.2559 48.8716 59.2559C48.7394 59.2559 48.7394 59.2559 48.8837 59.406Z" fill="white" />
                    <path d="M53.0505 59.3339C53.1768 59.3943 53.1827 59.4241 53.1827 60.1939C53.1827 60.8915 53.1709 60.9997 53.0808 61.0539C52.9964 61.1017 53.0564 61.1138 53.3333 61.1197C53.676 61.1197 53.6819 61.1138 53.5556 61.0236C53.4293 60.9393 53.4235 60.8915 53.4235 60.1578C53.4235 59.4845 53.4352 59.3763 53.5254 59.3222C53.6039 59.2798 53.5376 59.2681 53.2729 59.2681C52.9725 59.2681 52.9364 59.2798 53.0505 59.3339Z" fill="white" />
                    <path d="M54.0009 59.3822C54.0667 59.4543 54.0848 59.6586 54.0848 60.2358C54.0848 60.8974 54.0731 60.9998 53.9829 61.0539C53.9044 61.0958 54.0428 61.108 54.4577 61.1017C54.9389 61.09 55.0652 61.0656 55.2032 60.9637C55.7804 60.5366 55.7867 59.7429 55.2212 59.4061C55.0589 59.31 54.9087 59.2861 54.4636 59.2861C53.9585 59.2861 53.9166 59.292 54.0009 59.3822ZM54.9267 59.4124C55.5098 59.6469 55.6424 60.5849 55.131 60.9213C54.9389 61.0476 54.4997 61.0597 54.3554 60.9393C54.2832 60.8794 54.2652 60.7229 54.2652 60.152C54.2652 59.5387 54.2773 59.4363 54.3734 59.3822C54.5177 59.292 54.6503 59.3042 54.9267 59.4124Z" fill="white" />
                    <path d="M56.1656 60.0495C55.9672 60.4883 55.7566 60.9095 55.6903 60.9817L55.5703 61.1197H55.8287C56.0632 61.1197 56.0812 61.1138 55.9852 61.0417C55.877 60.9636 55.877 60.9515 55.9969 60.6809L56.1232 60.3981H56.4542C56.8086 60.3981 56.8628 60.4405 56.971 60.8252C57.0071 60.9515 57.0012 61.0114 56.9349 61.0475C56.8808 61.0777 56.9651 61.0958 57.1577 61.1016C57.458 61.1079 57.4702 61.1016 57.3498 61.0056C57.2776 60.9515 57.0855 60.5488 56.911 60.0798C56.7365 59.6288 56.5741 59.2559 56.5561 59.2559C56.5322 59.2559 56.3577 59.6166 56.1656 60.0495ZM56.6283 59.8994C56.6824 60.0617 56.7306 60.206 56.7306 60.2299C56.7306 60.2601 56.6044 60.2782 56.4542 60.2782C56.2558 60.2782 56.1836 60.2538 56.2075 60.1997C56.3879 59.7429 56.4479 59.6166 56.484 59.6166C56.5083 59.6166 56.5741 59.7429 56.6283 59.8994Z" fill="white" />
                    <path d="M42.2457 59.7488C42.1074 59.9896 41.9631 60.2422 41.921 60.308C41.5302 60.9393 41.464 61.0597 41.5062 61.0656C41.8428 61.1197 42.1495 61.0656 41.9992 60.9695C41.909 60.9154 42.1796 60.4045 42.2818 60.4406C42.3359 60.4645 42.36 60.5245 42.3419 60.5907C42.3118 60.6931 42.3299 60.7048 42.4682 60.6688C42.5584 60.6449 42.6786 60.5786 42.7388 60.5127C42.8891 60.3504 42.9673 60.3923 43.0634 60.6688C43.1356 60.8794 43.1356 60.9154 43.0514 60.9754C42.9191 61.0778 42.9372 61.09 43.1837 61.0778C43.5324 61.0597 43.5384 61.0597 43.4242 60.9935C43.2799 60.9096 43.0454 60.4406 43.1356 60.4104C43.1777 60.3982 43.1536 60.3504 43.0815 60.29C43.0153 60.23 42.8831 60.0013 42.7869 59.7668C42.6906 59.5387 42.5824 59.3402 42.5524 59.3281C42.5163 59.3159 42.378 59.5084 42.2457 59.7488ZM42.7748 59.8994C42.823 60.0257 42.871 60.1578 42.8831 60.1998C42.9011 60.2422 42.823 60.3143 42.7087 60.3562C42.5343 60.4284 42.4983 60.4284 42.4081 60.3504C42.3058 60.2661 42.3118 60.2422 42.4682 59.9716C42.5584 59.8092 42.6426 59.6767 42.6606 59.6767C42.6846 59.6767 42.7328 59.779 42.7748 59.8994Z" fill="white" />
                    <path d="M43.7909 59.5085C43.7609 59.701 43.7609 59.701 43.8511 59.5685C43.9172 59.4665 43.9954 59.4363 44.1998 59.4363H44.4644V60.2178C44.4644 60.8916 44.4523 60.9998 44.3621 61.0539C44.278 61.1017 44.3321 61.1139 44.5846 61.1139C44.8372 61.1139 44.8913 61.1017 44.8131 61.0539C44.7169 60.9998 44.7049 60.8916 44.7049 60.2178V59.4363H45.0055C45.222 59.4363 45.318 59.4665 45.3604 59.5387C45.4145 59.6289 45.4204 59.6226 45.4263 59.4783V59.3159H44.6207H43.815L43.7909 59.5085Z" fill="white" />
                    <path d="M50.7178 59.4422C50.7178 59.5085 50.7475 59.6167 50.7836 59.6889C50.844 59.803 50.8558 59.7971 50.946 59.6045C51.0303 59.4363 51.0785 59.4061 51.2589 59.4061C51.4393 59.4061 51.4691 59.4305 51.4993 59.5928C51.5232 59.6947 51.5232 60.0677 51.5051 60.4163C51.4871 60.7712 51.4754 61.0598 51.4871 61.0598C51.4934 61.0598 51.5295 60.9998 51.5593 60.9213C51.6016 60.8194 51.6134 60.8131 51.6134 60.8916C51.6197 60.9515 51.6616 60.9998 51.7099 60.9998C51.7577 60.9998 51.8001 60.9515 51.8059 60.8916C51.8059 60.8131 51.8181 60.8194 51.86 60.9213C51.8903 60.9998 51.9263 61.0598 51.9322 61.0598C51.9805 61.0598 51.902 60.0014 51.8542 59.9473C51.8181 59.9175 51.8001 59.9234 51.8001 59.9653C51.8001 60.0077 51.7577 60.0375 51.7099 60.0375C51.6134 60.0375 51.6016 59.9536 51.6738 59.7732C51.7157 59.665 51.7216 59.665 51.7577 59.7552C51.8181 59.9175 51.8961 59.8751 51.9083 59.665C51.9263 59.4183 51.9863 59.3642 52.1969 59.3881C52.3232 59.4003 52.4012 59.4602 52.4675 59.6045C52.5757 59.821 52.6596 59.7791 52.7317 59.4783L52.7741 59.3159H51.746C50.7475 59.3159 50.7178 59.3222 50.7178 59.4422ZM51.746 60.2963C51.6494 60.3924 51.5895 60.2963 51.6855 60.1818C51.7396 60.1159 51.7757 60.1096 51.7879 60.1579C51.8001 60.1939 51.782 60.2602 51.746 60.2963ZM51.7699 60.681C51.7036 60.7229 51.6377 60.759 51.6075 60.759C51.5232 60.759 51.5593 60.6449 51.6616 60.5849C51.8118 60.5064 51.902 60.5786 51.7699 60.681Z" fill="white" />
                  </g>
                  <defs>
                    <clipPath id="clip0_2466_1133">
                      <rect width="80" height="65.6144" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-9 col-span-4 row-start-11 row-span-2 bg-blue-300 rounded-4xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 64 64">
                  <path fill="currentColor" d="M32 0C14 0 0 14 0 32c0 21 19 30 22 30c2 0 2-1 2-2v-5c-7 2-10-2-11-5c0 0 0-1-2-3c-1-1-5-3-1-3c3 0 5 4 5 4c3 4 7 3 9 2c0-2 2-4 2-4c-8-1-14-4-14-15q0-6 3-9s-2-4 0-9c0 0 5 0 9 4c3-2 13-2 16 0c4-4 9-4 9-4c2 7 0 9 0 9q3 3 3 9c0 11-7 14-14 15c1 1 2 3 2 6v8c0 1 0 2 2 2c3 0 22-9 22-30C64 14 50 0 32 0" />
                </svg>
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-13 col-span-4 row-start-11 row-span-2 bg-blue-300 rounded-4xl">
                Block
              </div>
              <div class="magic-bento-card hover-bounce-card col-start-5 col-span-4 row-start-11 row-span-2 bg-blue-300 rounded-4xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128">
                  <path fill="#0acf83" d="M45.5 129c11.9 0 21.5-9.6 21.5-21.5V86H45.5C33.6 86 24 95.6 24 107.5S33.6 129 45.5 129m0 0" />
                  <path fill="#a259ff" d="M24 64.5C24 52.6 33.6 43 45.5 43H67v43H45.5C33.6 86 24 76.4 24 64.5m0 0" />
                  <path fill="#f24e1e" d="M24 21.5C24 9.6 33.6 0 45.5 0H67v43H45.5C33.6 43 24 33.4 24 21.5m0 0" />
                  <path fill="#ff7262" d="M67 0h21.5C100.4 0 110 9.6 110 21.5S100.4 43 88.5 43H67zm0 0" />
                  <path fill="#1abcfe" d="M110 64.5c0 11.9-9.6 21.5-21.5 21.5S67 76.4 67 64.5S76.6 43 88.5 43S110 52.6 110 64.5m0 0" />
                </svg>
              </div>
            </div>
          </div>

        </section>
        <section id="contact" class="relative w-full min-h-[100dvh] mt-32 justify-center animate-on-scroll">
          <h2 class="text-gray-900 dark:text-gray-200 text-center md:text-2xl lg:text-4xl font-light underline underline-offset-8 decoration-1 uppercase">Contact me</h2>
          <div class="gap-4 mt-14 text-base text-gray-800 dark:text-gray-200">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
              <div class="shrink-0">
                <img class="w-16 h-16 rounded-full" src="./img/1778170987136.jpg" alt="Luis Flores">
              </div>
              <div class="flex-1 min-w-0 mr-8 lg:mr-0">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Who am I?</h3>
                <h2
                  class="md:text-4xl bg-gradient-to-tl from-white via-slate-400 to-slate-700 bg-clip-text text-transparent font-bold">
                  Hi, my name is Luis Flores!
                </h2>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-2 sm:grid-cols-2 text-wrap">
            <div class="mt-6 sm:w-full lg:w-3/4">
              <p class="text-gray-600 dark:text-gray-400 text-justify indent-8">I’m a software developer engineer with a solid technical background and excellent project management, planning, and development skills. My ability to manage multiple projects simultaneously was demonstrated during my professional practices and work at various companies, where I contributed to projects that benefited both the organizations and my own skill set. Moreover, I possess fluent English conversational skills, developed through interactions both at the University and within professional environments. Additionally, I greatly enjoy learning and discovering new technologies within the world of programming. I have the ability to work in a team, support, and propose new efficient ideas for the company and projects.</p>
              <div>
                <p class="text-lg font-semibold text-gray-800 dark:text-gray-300 mt-4">Experience</p>
                <p class="text-gray-600 dark:text-gray-400 text-justify indent-8">I’m a</p>
              </div>
            </div>
            <div class="sm:w-full lg:w-3/4 block justify-self-center">
              <div class="grid grid-cols-2 gap-4 border-b-1 border-gray-300 dark:border-gray-600 pb-2 ml-8 lg:ml-0">
                <div class="w-12">
                  <p class="font-medium text-gray-700 dark:text-gray-300">Technology to use</p>
                </div>
                <div class="">
                  <p class="font-normal text-gray-600 dark:text-gray-400">CSS, SVG, HTML, JavaScript, React, PHP, <span class="text-xs">and so on...</span></p>
                </div>
              </div>
              <div class="grid grid-cols-2 gap-4 border-b-1 border-gray-300 dark:border-gray-600 pb-2 ml-8 lg:ml-0 my-2">
                <div class="w-12">
                  <p class="font-medium text-gray-700 dark:text-gray-300">Design tools</p>
                </div>
                <div class="">
                  <p class="font-normal text-gray-600 dark:text-gray-400">Figma, Adobe Potoshop, Adobe XD, Canva</p>
                </div>
              </div>
              <div class="grid grid-cols-2 gap-4 border-b-1 border-gray-300 dark:border-gray-600 pb-2 ml-8 lg:ml-0 my-2">
                <div class="w-12">
                  <p class="font-medium text-gray-700 dark:text-gray-300">Primary role</p>
                </div>
                <div class="">
                  <p class="text-gray-600 dark:text-gray-400">Data analyst, Front-end engineer, UI and Web Designer, Back-end engineer</p>
                </div>
              </div>
              <div class="grid grid-cols-2 gap-4 border-b-1 border-gray-300 dark:border-gray-600 pb-2 ml-8 lg:ml-0 my-2">
                <div class="w-12">
                  <p class="font-medium text-gray-700 dark:text-gray-300">Certificates</p>
                </div>
                <div class="">
                  <p class="text-gray-600 dark:text-gray-400">CSS, SVG, HTML, JavaScript, React, PHP, <span class="text-xs">and so on...</span></p>
                </div>
              </div>
              <div class="grid grid-cols-2 gap-4 border-b-1 border-gray-300 dark:border-gray-600 pb-2 ml-8 lg:ml-0 my-2">
                <div class="w-12">
                  <p class="font-medium text-gray-700 dark:text-gray-300">Liked</p>
                </div>
                <div class="">
                  <p class="text-gray-600 dark:text-gray-400">Web, coding, design, cats, horror games, mangas, <span class="text-xs">and so on...</span></p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section id="blog" class="relative w-full min-h-[100dvh] mt-32 justify-center animate-on-scroll">
          <h2 class="text-gray-900 dark:text-gray-200 text-center md:text-2xl lg:text-4xl font-light underline underline-offset-8 decoration-1 uppercase mb-18">Personal blog</h2>
          <div class="flex justify-center card-swiper">
            <div class="card-groups">
              <div class="card-group" data-index="0" data-status="active">
                <div class="little-card card">
                </div>
                <div class="big-card card">
                </div>
                <div class="little-card card">
                </div>
                <div class="big-card card">
                </div>
                <div class="little-card card">
                </div>
                <div class="big-card card">
                </div>
                <div class="little-card card">
                </div>
                <div class="big-card card">
                </div>
              </div>
            </div>
          </div>
          <p class="text-gray-600 dark:text-gray-400 text-center mt-10">
            Hey there! Watch some of my latest blog posts here!
          </p>
          <div class="flex justify-center mt-4">
            <button class="outline-2 outline-offset-2 outline-solid outline-gray-900 dark:outline-gray-200 text-black dark:text-gray-300 px-5 py-2 rounded-full text-sm font-bold transition-colors">Sure! Take me to the blog!</button>
          </div>
        </section>
      </main>

      <div id="end-message" class="flex flex-col items-center justify-center py-10 opacity-0 translate-y-12 transition-all duration-1000 ease-out">
        <p class="text-2xl font-bold dark:text-white">The end.</p>
        <p class="text-gray-500 mb-4 mt-1">Back to the top?</p>
        <a href="#home" class="hover-bounce-card outline-2 outline-offset-2 outline-solid outline-gray-900 dark:outline-gray-200 text-black dark:text-gray-300 px-2 py-2 rounded-full text-sm font-bold transition-colors">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 4L19 11H13V19H11V11H5L12 4Z" fill="currentColor" />
          </svg>
        </a>
      </div>
      <!--Waves Container-->
      <div id="wave-trigger" class="relative w-full">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
          <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
          </defs>
          <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(0,0,0,0.7)" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(0,0,0,0.5)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(0,0,0,0.3)" />
            <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(0,0,0)" q />
          </g>
        </svg>
      </div>
      <!--Waves end-->
      <footer class="bg-black rounded-lg shadow-sm">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
          <div class="sm:flex sm:items-center sm:justify-between">
            <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
              <div class="font-bold text-lg flex items-center gap-2">
                <svg width="36" height="39" viewBox="-20 -20 296 299" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g filter="url(#filter_nav)" data-figma-bg-blur-radius="10.5213">
                    <rect x="64.1191" width="180" height="180" rx="42.83" transform="rotate(15 64.1191 0)" fill="url(#paint0_nav)" shape-rendering="crispEdges" />
                    <rect x="64.4624" y="0.594585" width="179.029" height="179.029" rx="42.3445" transform="rotate(15 64.4624 0.594585)" stroke="url(#paint1_nav)" stroke-width="0.970954" shape-rendering="crispEdges" />
                    <path d="M74.867 104.978L77.0462 96.8448L113.417 91.2365L110.91 100.594L86.2402 103.568L86.6705 103.163L86.361 104.318L86.1906 103.753L106.068 118.663L103.561 128.02L74.867 104.978ZM146.285 86.9433L115.855 139.512L107.376 137.239L137.806 84.6711L146.285 86.9433ZM175.395 131.914L139.024 137.523L141.531 128.165L166.201 125.191L165.771 125.596L166.08 124.441L166.25 125.006L146.373 110.097L148.88 100.739L177.574 123.781L175.395 131.914Z" fill="white" />
                  </g>
                  <defs>
                    <filter id="filter_nav" x="-10.8495" y="-10.5213" width="277.217" height="280.16" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                      <feFlood flood-opacity="0" result="BackgroundImageFix" />
                      <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                      <feOffset dy="20.8034" />
                      <feGaussianBlur stdDeviation="14.1906" />
                      <feComposite in2="hardAlpha" operator="out" />
                      <feColorMatrix type="matrix" values="0 0 0 0 0.00753472 0 0 0 0 0.00920856 0 0 0 0 0.129167 0 0 0 0.1 0" />
                      <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_nav" />
                      <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_nav" result="shape" />
                    </filter>
                    <linearGradient id="paint0_nav" x1="103.924" y1="19.7599" x2="208.688" y2="179.742" gradientUnits="userSpaceOnUse">
                      <stop stop-color="white" stop-opacity="0.1" />
                      <stop offset="1" stop-color="white" stop-opacity="0.4" />
                    </linearGradient>

                    <linearGradient id="paint1_nav" x1="103.924" y1="-0.285138" x2="216.63" y2="179.742" gradientUnits="userSpaceOnUse">
                      <stop stop-color="white" stop-opacity="0.12" />
                      <stop offset="1" stop-color="white" stop-opacity="0.36" />
                    </linearGradient>
                  </defs>
                </svg>
                <span class="hidden sm:block playball-regular text-white">Luis Flores</span>
              </div>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
              <li>
                <a href="#" class="hover:underline me-4 md:me-6">Home</a>
              </li>
              <li>
                <a href="#" class="hover:underline me-4 md:me-6">Projects</a>
              </li>
              <li>
                <a href="#" class="hover:underline me-4 md:me-6">Blog</a>
              </li>
              <li>
                <a href="#" class="hover:underline">Contact</a>
              </li>
            </ul>
          </div>
          <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
          <div class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
            <p>2026. <a href="#"
                class="hover:underline">Luis Flores - Personal Portfolio</a></p>
            <p class="">Hey! You reached the end 👀</p>
          </div>
        </div>
      </footer>

    </div> <!-- Cierre de smooth-content -->
  </div> <!-- Cierre de smooth-wrapper -->

  <!-- Menu container -->
  <div data-dial-init class="fixed top-8 end-9 group z-10">
    <div
      class="group relative flex justify-center items-center text-zinc-600 text-sm font-bold">
      <button type="button" id="openBtn"
        class="shadow-md flex items-center group-hover:gap-2 bg-white p-3 text-black rounded-full cursor-pointer duration-300">
        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 6H20M4 12H20M4 18H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span class="text-[0px] group-hover:text-sm duration-300">Menu</span>
    </div>
  </div>

  <button class="close-btn block fixed justify-self-end" id="closeBtn">Close</button>

  <div class="menu-container inline-block sticky text-white" id="menu">
    <div class="menu-option"><button type="button" id="radioHomeBtn">Home</a></div>
    <div class="menu-option"><button type="button" id="profileBtn">Projects</a></div>
    <div class="menu-option"><button type="button" id="requestsBtn">Blog</a></div>
    <div class="menu-option"><button type="button" id="loginBtn">Contact</a></div>
  </div>

  <div class="transition-screen" id="transition">
    <div class="transition-panel"></div>
    <div class="transition-panel"></div>
    <div class="transition-panel"></div>
    <div class="transition-panel"></div>
    <div class="transition-panel"></div>
  </div>
  <!-- Close menu container -->

  <script src="../dist/bundle.js"></script>
  <script>
    // Seleccionamos elementos
    const openBtn = document.getElementById("openBtn");
    const closeBtn = document.getElementById("closeBtn");
    const transition = document.getElementById("transition");
    const menu = document.getElementById("menu");

    const radioHomeBtn = document.getElementById("radioHomeBtn");
    const profileBtn = document.getElementById("profileBtn");
    const requestsBtn = document.getElementById("requestsBtn");
    const contactBtn = document.getElementById("contactBtn");

    const homeBtnNavbar = document.getElementById("homeBtnNavbar");
    const profileBtnNavbar = document.getElementById("profileBtnNavbar");
    const requestsBtnNavbar = document.getElementById("requestsBtnNavbar");
    const loginBtnNavbar = document.getElementById("loginBtnNavbar");

    const radioHome = document.getElementById("radio-home");
    const myProfile = document.getElementById("my-profile");
    const myRequests = document.getElementById("my-requests");

    const siriNavbar = document.getElementById("siri-container-2");

    // ==========================================
    // SEGURO DE VIDA: Solo agregamos eventos si el elemento existe
    // ==========================================
    if (openBtn && transition && closeBtn && menu) {
      openBtn.addEventListener("click", () => {
        transition.classList.add("show");
        transition.classList.remove("up", "down");
        setTimeout(() => {
          transition.classList.add("down");
        }, 20);
        setTimeout(() => {
          closeBtn.style.display = "block";
          menu.style.display = "inline-block";
        }, 900);
      });

      closeBtn.addEventListener("click", () => {
        closeBtn.style.display = "none";
        menu.style.display = "none";
        transition.classList.remove("down");
        transition.classList.add("up");
        setTimeout(() => {
          transition.classList.remove("show");
        }, 900);
      });
    }

    // Opciones del Menú (comprobamos que existan)
    if (radioHomeBtn && radioHome) {
      radioHomeBtn.addEventListener("click", () => {
        closeBtn.style.display = "none";
        menu.style.display = "none";
        transition.classList.remove("down");
        transition.classList.add("up");
        setTimeout(() => {
          transition.classList.remove("show");
        }, 900);
        if (myProfile) myProfile.style.display = "none";
        if (myRequests) myRequests.style.display = "none";
        radioHome.style.display = "block";
        if (siriNavbar) siriNavbar.classList.add("hidden");
      });
    }

    if (profileBtn && myProfile) {
      profileBtn.addEventListener("click", () => {
        closeBtn.style.display = "none";
        menu.style.display = "none";
        transition.classList.remove("down");
        transition.classList.add("up");
        setTimeout(() => {
          transition.classList.remove("show");
        }, 900);
        if (radioHome) radioHome.style.display = "none";
        if (myRequests) myRequests.style.display = "none";
        myProfile.style.display = "block";
        if (siriNavbar) siriNavbar.classList.remove("hidden");
      });
    }

    if (requestsBtn && myRequests) {
      requestsBtn.addEventListener("click", () => {
        closeBtn.style.display = "none";
        menu.style.display = "none";
        transition.classList.remove("down");
        transition.classList.add("up");
        setTimeout(() => {
          transition.classList.remove("show");
        }, 900);
        if (radioHome) radioHome.style.display = "none";
        if (myProfile) myProfile.style.display = "none";
        myRequests.style.display = "block";
        if (siriNavbar) siriNavbar.classList.remove("hidden");
      });
    }

    // Navbar options (¡Aquí es donde fallaba tu código antes!)
    if (homeBtnNavbar) {
      homeBtnNavbar.addEventListener("click", () => {
        /* tu logica */
      });
    }
    if (profileBtnNavbar) {
      profileBtnNavbar.addEventListener("click", () => {
        /* tu logica */
      });
    }
    if (requestsBtnNavbar) {
      requestsBtnNavbar.addEventListener("click", () => {
        /* tu logica */
      });
    }
    if (contactBtn) {
      contactBtn.addEventListener("click", () => {
        /* Go to contact section */
        document.getElementById("contact").scrollIntoView();
      });
    }

    // ==========================================
    // ANIMACIÓN FINAL (¡Ahora sí llegará hasta aquí!)
    // ==========================================
    document.documentElement.style.overflow = 'hidden';

    window.addEventListener('DOMContentLoaded', () => {
      document.body.style.display = '';

      setTimeout(() => {
        // 1. Quitamos la pantalla de carga
        const loading = document.getElementById('loading-screen');
        if (loading) loading.remove();

        // 2. Restauramos el scroll
        document.documentElement.style.overflow = '';

        // 3. EFECTO RADAR REPETIBLE
        const endMessage = document.getElementById('end-message');

        if (endMessage) {
          // El radar ahora se quedará encendido siempre
          setInterval(() => {
            const rect = endMessage.getBoundingClientRect();
            const windowHeight = window.innerHeight || document.documentElement.clientHeight;

            // Si el mensaje entra en la pantalla
            if (rect.top < windowHeight - 50) {

              // Entra: Se hace visible y sube
              endMessage.classList.remove('opacity-0', 'translate-y-12');
              endMessage.classList.add('opacity-100', 'translate-y-0');

            } else {

              // Sale (el usuario subió el scroll): Se vuelve a ocultar y bajar
              // Así estará listo para volver a animarse cuando bajes de nuevo
              endMessage.classList.add('opacity-0', 'translate-y-12');
              endMessage.classList.remove('opacity-100', 'translate-y-0');

            }
          }, 100); // Revisa la posición 10 veces por segundo
        }

      }, 1500);
    });
  </script>
</body>

</html>