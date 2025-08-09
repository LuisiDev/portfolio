<?php
session_start();
if (!isset($_SESSION['session_id'])) {
    $_SESSION['session_id'] = uniqid();
}

if (isset($_SESSION['user'])) {
    header("Location: ./sesion");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es" data-theme="dark" class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de accesos</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/output.css">
    <link rel="manifest" href="./manifest.json">
    <link rel="icon" href="./assets/web/favicon.ico" type="image/x-icon">
    <style>
        .mask1 {
            -webkit-mask-image: linear-gradient(to right, transparent 25%, black 75%);
            mask-image: linear-gradient(to right, transparent 2.5%, black 40%);
        }
    </style>
</head>

<body>
    <div id="cursor" class="bg-gray-900 dark:fill-white dark:bg-white dark:text-white"></div>
    <div id="cursor-border" class="border-2 border-solid border-gray-900 dark:border-white"></div>

    <section>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
            <div class="flex justify-center items-start h-screen">
                <div class="p-8 w-[33rem]">
                    <div
                        class="flex z-40 items-center mt-7 mb-10 md:mb-20 lg:mb-34">
                        <svg class="w-18" viewBox="0 0 350 350" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M215 175L155 209.641V140.359L215 175Z" fill="white" />
                            <path d="M119.69 270.402L119.69 79.8767L284.69 175.139L119.69 270.402Z" stroke="white"
                                stroke-width="15" />
                            <path d="M95 313.564L95 36.4355L335.001 175L95 313.564Z" stroke="white" stroke-width="15" />
                        </svg>

                        <p class="w-28">TCS Radio</p>
                    </div>

                    <div class="hidden justify-center flex" id="loginValidation" role="alert">
                        <span
                            class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Autorización
                            valida, ingresando...</span>
                    </div>

                    <div class="mx-auto w-full px-4 py-8 sm:px-6 lg:px-8">

                        <form id="loginForm" class="slide-in" method="POST" autocomplete="off">
                            <div>

                                <h2 class="text-2xl font-bold mb-4">Iniciar sesión</h2>
                                <div class="mb-4">
                                    <label for="username"
                                        class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Usuario</label>
                                    <input type="text" id="usuario" name="username" autocomplete="off"
                                        class="w-full p-2.5 border bg-gray-100 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-[#903F98] focus:border-[#903F98] dark:bg-gray-700 dark:placeholder-gray-500"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="password"
                                        class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Contraseña</label>
                                    <input type="password" id="password" name="password" autocomplete="off"
                                        class="w-full p-2.5 border bg-gray-100 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-[#903F98] focus:border-[#903F98] dark:bg-gray-700 dark:placeholder-gray-500"
                                        required>
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="rememberUser" value="true"
                                            class="w-4 h-4 text-[#903F98] bg-white border-gray-300 rounded focus:ring-[#903F98] focus:ring-2">
                                        <label for="rememberUser"
                                            class="ms-2 text-xs font-normal text-gray-900 dark:text-gray-50 cursor-pointer">Recordar
                                            contraseña</label>
                                    </div>
                                    <a class="text-xs text-[#903F98] hover:underline cursor-pointer"
                                        onclick="showForgotPasswordForm()">¿Olvidaste tu contraseña?</a>
                                </div>
                                <button type="submit"
                                    class="w-full bg-gray-700 text-white py-2 px-4 rounded hover:bg-[#7c4481] focus:ring-purple-300 cursor-pointer">Iniciar
                                    sesión</button>
                            </div>
                        </form>

                    </div>

                    <div class="mx-auto w-full px-4 py-8 sm:px-6 lg:px-8">

                        <form id="forgotPasswordForm" style="display: none;" class="slide-in" method="POST">
                            <h2 class="text-2xl font-bold mb-4">Recuperar contraseña</h2>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Correo
                                    electrónico:</label>
                                <input type="email" id="recoveryEmail" name="email"
                                    class="w-full p-2.5 border border-gray-300 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-[#903F98] focus:border-[#903F98] dark:bg-gray-700 dark:placeholder-gray-500"
                                    value=""
                                    pattern="[a-zA-Z0-9]+([.][a-zA-Z0-9]+)*@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}(\.[a-zA-Z]{2})?"
                                    required>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <a class="text-xs text-[#903F98] hover:underline cursor-pointer"
                                    onclick="showLoginForm()">Iniciar sesión</a>
                            </div>
                            <button type="submit" name="send" id="recuperacionSubmitBtn"
                                class="w-full bg-gray-700 text-white py-2 px-4 rounded hover:bg-[#7c4481] cursor-pointer">Recuperar
                                contraseña</button>
                        </form>

                    </div>

                    <div class="flex justify-center items-center mt-16 lg:mt-24 slide-in">
                        <a href="#" class="text-sm font-light text-[#903F98] hover:underline">Términos y
                            condiciones</a>
                    </div>

                    <div class="flex justify-center items-center mt-4 lg:mt-4 slide-in">
                        <button type="button" data-animation="circle-blur-top-left"
                            class="cursor-pointer theme-toggle text-sm font-light text-[#903F98] hover:underline">Modo
                            oscuro</button>
                    </div>
                </div>

            </div>
            <div class="hidden lg:flex h-dvh rounded-l-4xl">
                <div class="">
                    <div class="h-full">
                        <div class="transition-opacity duration-1000">
                            <div class="flex h-dvh justify-center p-6">
                                <video autoplay loop muted playsinline class="mask1 rounded-r-4xl p-5 relative w-full object-cover object-center">
                                    <source src="https://videos.pexels.com/video-files/29485423/12691871_1920_1080_30fps.mp4" type="video/mp4">
                                    Tu navegador no soporta la reproducción de video.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Modal Error Inicio de sesión -->
    <div id="errorModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-[#000000d4] bg-opacity-50 hidden">
        <div
            class="bg-white rounded-lg shadow-lg w-96 px-6 py-3 animate-fade-up animate-once animate-ease-out animate-duration-900">
            <img id="modalImage" class="w-100 mx-auto mb-4">
            <h2 id="modalTitle" class="text-lg font-bold text-center text-gray-500 mb-2"></h2>
            <p id="modalMessage" class="text-sm text-center text-gray-500 mb-6"></p>
            <div class="flex justify-center">
                <button type="button" id="closeModalButton"
                    class="focus:outline-none text-white bg-[#903F98] hover:bg-[#7c4481] focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 cursor-pointer">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal Recuperación de contraseña -->
    <div id="recuperacionModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-[#000000d4] bg-opacity-50 hidden">
        <div
            class="bg-white rounded-lg shadow-lg w-96 px-6 py-3 animate-fade-up animate-once animate-ease-out animate-duration-900">
            <img id="modalRecuperacionImage" class="w-100 mx-auto mb-4">
            <h2 id="modalRecuperacionTitle" class="text-lg font-bold text-center text-gray-500 mb-2"></h2>
            <p id="modalRecuperacionMessage" class="text-sm text-center text-gray-500 mb-6"></p>
            <div class="flex justify-center">
                <button type="button" id="closeModalRecuperacionButton"
                    class="focus:outline-none text-white bg-[#903F98] hover:bg-[#7c4481] focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 cursor-pointer">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        // Remember user functionality
        const rememberUserCheckbox = document.getElementById('rememberUser');
        const usernameInput = document.getElementById('usuario');
        const passwordInput = document.getElementById('password');

        // Cargar credenciales almacenadas al cargar la página
        window.addEventListener('DOMContentLoaded', () => {
            const remember = localStorage.getItem('rememberCredentials') === 'true';
            const savedUsername = localStorage.getItem('rememberedUsername');
            const savedPassword = localStorage.getItem('rememberedPassword');

            rememberUserCheckbox.checked = remember;

            if (remember && savedUsername) {
                usernameInput.value = savedUsername;
            }

            if (remember && savedPassword) {
                passwordInput.value = savedPassword;
            }
        });

        // Actualizar almacenamiento cuando cambian los campos
        usernameInput.addEventListener('input', () => {
            if (rememberUserCheckbox.checked) {
                localStorage.setItem('rememberedUsername', usernameInput.value);
            }
        });

        passwordInput.addEventListener('input', () => {
            if (rememberUserCheckbox.checked) {
                localStorage.setItem('rememberedPassword', passwordInput.value);
            }
        });

        // Manejar cambios en el checkbox
        rememberUserCheckbox.addEventListener('change', (e) => {
            if (e.target.checked) {
                localStorage.setItem('rememberCredentials', 'true');
                localStorage.setItem('rememberedUsername', usernameInput.value);
                localStorage.setItem('rememberedPassword', passwordInput.value);
            } else {
                localStorage.removeItem('rememberCredentials');
                localStorage.removeItem('rememberedUsername');
                localStorage.removeItem('rememberedPassword');
            }
        });
    </script>
    <script>
        // Función para mostrar el modal Inicio de sesión
        function showModal(title, message) {
            const modal = document.getElementById('errorModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');

            modalTitle.textContent = title;
            modalImage.src = './assets/img/w193m3d.svg';
            modalMessage.textContent = message;

            modal.classList.remove('hidden'); // Mostrar el modal
        }

        // Función para mostrar el modal Recuperación de contraseña
        function showModalRecuperacion(title, message) {
            const modalRecuperacion = document.getElementById('recuperacionModal');
            const modalRecuperacionImage = document.getElementById('modalRecuperacionImage');
            const modalRecuperacionTitle = document.getElementById('modalRecuperacionTitle');
            const modalRecuperacionMessage = document.getElementById('modalRecuperacionMessage');

            modalRecuperacionTitle.textContent = title;
            modalRecuperacionImage.src = './assets/img/am15fv3g.svg';
            modalRecuperacionMessage.textContent = message;

            modalRecuperacion.classList.remove('hidden'); // Mostrar el modal
        }

        // Función para ocultar el modal Inicio de sesión
        function closeModal() {
            const modal = document.getElementById('errorModal');
            modal.classList.add('hidden'); // Ocultar el modal
        }

        // Función para ocultar el modal Recuperación de contraseña
        function closeModalRecuperacion() {
            const modalRecuperacion = document.getElementById('recuperacionModal');
            modalRecuperacion.classList.add('hidden'); // Ocultar el modal
        }

        // Agregar evento al botón de cerrar Inicio de sesión
        document.getElementById('closeModalButton').addEventListener('click', closeModal);

        // Agregar evento al botón de cerrar Recuperación de contraseña
        document.getElementById('closeModalRecuperacionButton').addEventListener('click', closeModalRecuperacion);

        // Manejar el envío del formulario de inicio de sesión
        document.getElementById('loginForm').addEventListener('submit', async function (e) {
            e.preventDefault(); // Evitar el envío tradicional del formulario

            const formData = new FormData(this); // Obtener los datos del formulario

            fetch('./procesos/login.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => {
                    // Primero obtener como texto
                    return response.text().then(text => {
                        // console.log('Respuesta cruda:', text);

                        try {
                            // Eliminar posibles caracteres no JSON
                            const cleanText = text.trim();

                            // Verificar si es JSON válido
                            if (!/^[\{\[]/.test(cleanText)) {
                                throw new Error('Respuesta no comienza como JSON');
                            }

                            return JSON.parse(cleanText);
                        } catch (e) {
                            console.error('Error parseando:', e);
                            throw new Error(`Respuesta inválida: ${text.substring(0, 50)}`);
                        }
                    });
                })
                .then(data => {
                    console.log('Parsed Response:', data);
                    if (data.success) {
                        if (data.tfa) {
                            // Normalización de la ruta de redirección
                            const redirectUrl = new URL(data.redirect, window.location.origin);
                            window.location.href = redirectUrl.href;
                        } else {
                            // Mostrar el mensaje de autorización válida
                            document.getElementById('loginValidation').classList.remove('hidden');
                            setTimeout(() => {
                                document.getElementById('loginValidation').classList.add('hidden');
                            }, 3000);
                            // Redirigir al usuario si las credenciales son correctas y no tiene 2FA
                            setTimeout(() => {
                                window.location.href = './software/inicio';
                            }, 1000); // Esperar 3 segundos antes de redirigir
                        }
                    } else {
                        // Mostrar el modal con el mensaje de error
                        showModal('Usuario o contraseña incorrectos', data.message || 'Usuario o contraseña incorrectos.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showModal('Error', 'Ocurrió un error al procesar la solicitud.');
                });
        });

        // Manejar el envío del formulario de recuperación de contraseña
        document.getElementById('forgotPasswordForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const email = document.getElementById('recoveryEmail').value;
            const formData = new FormData(this);

            try {
                // Mostrar loader o estado de carga
                document.getElementById('recuperacionSubmitBtn').disabled = true;
                document.getElementById('recuperacionSubmitBtn').innerHTML = 'Enviando...';

                const response = await fetch('./procesos/recuperacion.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    showModalRecuperacion(
                        'Correo enviado',
                        'Se ha enviado un enlace de recuperación a tu correo electrónico. Por favor revisa tu bandeja de entrada.'
                    );

                    // Opcional: Ocultar formulario después de éxito
                    setTimeout(() => {
                        showLoginForm();
                    }, 3000);
                } else {
                    showModalRecuperacion('Error', data.message || 'Ocurrió un error al procesar tu solicitud');
                }
            } catch (error) {
                console.error('Error:', error);
                showModalRecuperacion('Error', 'No se pudo conectar con el servidor');
            } finally {
                document.getElementById('recuperacionSubmitBtn').disabled = false;
                document.getElementById('recuperacionSubmitBtn').innerHTML = 'Recuperar contraseña';
            }
        });
    </script>
    <script src="../dist/bundle.js"></script>
</body>

</html>