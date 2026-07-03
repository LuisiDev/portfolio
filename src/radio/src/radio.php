<!-- // radio.html

<?php
// Conexión a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "radio_online";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Consulta para obtener los programas
    $stmt = $conn->prepare("SELECT nombre, horario FROM programas ORDER BY horario");
    $stmt->execute();
    $programas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> -->

<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Radio | Luis Flores</title>
    <link rel="stylesheet" href="styles/main.css" />
    <script src="https://cdn.jsdelivr.net/npm/siriwave"></script>
    <link rel="icon" href="img/logo-b.svg" type="image/x-icon" />
    <style>
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

        .transition-screen.show{
            display: flex;
        }

        .transition-screen.show.down .transition-panel {
            transform: translateY(0);
        }

        .transition-screen.show.up .transition-panel {
            transform: translateY(-100%);
        }

        .transition-panel:nth-child(1) { transition-delay: 0s }
        .transition-panel:nth-child(2) { transition-delay: 0.1s }
        .transition-panel:nth-child(3) { transition-delay: 0.2s }
        .transition-panel:nth-child(4) { transition-delay: 0.3s }
        .transition-panel:nth-child(5) { transition-delay: 0.4s }

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
            top: 15px;
            right: 20px;
            background: crimson;
            color: white;
            border: none;
            padding: 8px 14px;
            /* cursor: pointer; */
            font-size: 16px;
            border-radius: 4px;
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
          0%, 100% {
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

        .btn-shine {
          border: 1px solid;
          overflow: hidden;
          position: relative;
          margin: 0;
          padding: 17px 35px;
          outline: none;
          text-decoration: none;
          display: flex;
          justify-content: center;
          align-items: center;
          cursor: pointer;
          text-transform: uppercase;
          background-color: #fff;
          border: 1px solid rgba(22, 76, 167, 0.6);
          border-radius: 10px;
          color: #1d89ff;
          font-weight: 400;
          font-family: inherit;
          z-index: 0;
          overflow: hidden;
          transition: all 0.3s cubic-bezier(0.02, 0.01, 0.47, 1);
        }

        .btn-shine span {
          z-index: 20;
          color: #164ca7;
          font-size: 14px;
          font-weight: 500;
          letter-spacing: 0.7px;
        }

        .btn-shine:after {
          background: #38ef7d;
          content: "";
          height: 155px;
          left: -75px;
          opacity: 0.4;
          position: absolute;
          top: -50px;
          transform: rotate(35deg);
          transition: all 550ms cubic-bezier(0.19, 1, 0.22, 1);
          width: 50px;
          z-index: -10;
        }

        .btn-shine:hover:after {
          left: 120%;
          transition: all 550ms cubic-bezier(0.19, 1, 0.22, 1);
        }
    </style>
  </head>

  <div id="cursor" class="hidden sm:block bg-white dark:border-white"></div>
  <div
    id="cursor-border"
    class="hidden sm:block border-2 border-solid border-white dark:border-white"
  ></div>

  <body class="bg-gray-50 dark:bg-gray-900 w-full overscroll-none">
    <div class="fixed bottom-0 left-1/2 -translate-x-1/2 z-20 justify-center">
      <div class="place-items-center hidden" id="siri-container-2"></div>
      <nav
        class="flex rounded-full mx-4 mb-4 p-4 bg-white bg-clip-padding backdrop-filter backgrop-blur-2xl bg-opacity-10 border-t border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-600"
      >
        <ul
          class="flex flex-wrap items-center text-sm font-medium text-gray-500 dark:text-gray-400"
        >
          <li>
            <button type="button" class="hover:underline me-4 md:me-6" id="homeBtnNavbar">Home</a>
          </li>
          <li>
            <button type="button" class="hover:underline me-4 md:me-6 navbarBtns" id="profileBtnNavbar">My profile</a>
          </li>
          <li>
            <a
              href="#"
              data-animation="circle"
              class="theme-toggle hover:bg-gray-100 dark:hover:bg-gray-700"
            >
              <span
                class="relative w-full text-left transition-colors duration-200 ease-in-out group-hover:text-white"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                >
                  <defs>
                    <mask id="IconifyId1968823e0a75c869b140-unique">
                      <circle cx="7.5" cy="7.5" r="5.5" fill="#fff" />
                      <circle cx="7.5" cy="7.5" r="5.5">
                        <animate
                          fill="freeze"
                          attributeName="cx"
                          dur="0.4s"
                          values="7.5;11"
                        />
                        <animate
                          fill="freeze"
                          attributeName="r"
                          dur="0.4s"
                          values="5.5;6.5"
                        />
                      </circle>
                    </mask>
                    <mask id="IconifyId1968823e0a75c869b141-unique">
                      <g fill="#fff">
                        <circle cx="12" cy="9" r="5.5">
                          <animate
                            fill="freeze"
                            attributeName="cy"
                            begin="1s"
                            dur="0.5s"
                            values="9;15"
                          />
                        </circle>
                        <g fill-opacity="0">
                          <use
                            href="#IconifyId1968823e0a75c869b142-unique"
                            transform="rotate(-75 12 15)"
                          />
                          <use
                            href="#IconifyId1968823e0a75c869b142-unique"
                            transform="rotate(-25 12 15)"
                          />
                          <use
                            href="#IconifyId1968823e0a75c869b142-unique"
                            transform="rotate(25 12 15)"
                          />
                          <use
                            href="#IconifyId1968823e0a75c869b142-unique"
                            transform="rotate(75 12 15)"
                          />
                          <set
                            fill="freeze"
                            attributeName="fill-opacity"
                            begin="1.5s"
                            to="1"
                          />
                          <animateTransform
                            attributeName="transform"
                            dur="5s"
                            repeatCount="indefinite"
                            type="rotate"
                            values="0 12 15;50 12 15"
                          />
                        </g>
                      </g>
                      <path d="M0 10h26v5h-26z" />
                      <path
                        stroke="#fff"
                        stroke-dasharray="26"
                        stroke-dashoffset="26"
                        stroke-width="2"
                        d="M22 12h-22"
                      >
                        <animate
                          attributeName="d"
                          dur="6s"
                          repeatCount="indefinite"
                          values="M22 12h-22;M24 12h-22;M22 12h-22"
                        />
                        <animate
                          fill="freeze"
                          attributeName="stroke-dashoffset"
                          begin="0.5s"
                          dur="0.4s"
                          values="26;0"
                        />
                      </path>
                    </mask>
                    <symbol id="IconifyId1968823e0a75c869b142-unique">
                      <path d="M11 18h2L12 20z" opacity="0">
                        <animate
                          fill="freeze"
                          attributeName="d"
                          begin="1.5s"
                          dur="0.4s"
                          values="M11 18h2L12 20z;M10.5 21.5h3L12 24z"
                        />
                        <set
                          fill="freeze"
                          attributeName="opacity"
                          begin="1.5s"
                          to="1"
                        />
                      </path>
                    </symbol>
                  </defs>
                  <g fill="currentColor">
                    <rect
                      width="13"
                      height="13"
                      x="1"
                      y="1"
                      mask="url(#IconifyId1968823e0a75c869b140-unique)"
                    />
                    <path
                      d="M-2 11h28v13h-28z"
                      mask="url(#IconifyId1968823e0a75c869b141-unique)"
                      transform="rotate(-45 12 12)"
                    />
                  </g>
                </svg>
              </span>
            </a>
          </li>
          <li>
            <button type="button" class="hover:underline mx-4 md:me-6" id="requestsBtnNavbar">My requests</a>
          </li>
          <li>
            <!-- <a href="logout.php" class="hover:underline">Logout</a> -->
            <button type="button" class="hover:underline" id="logoutBtnNavbar">Logout</a>
          </li>
        </ul>
      </nav>
    </div>

    <!-- Menu container -->

    <div data-dial-init class="fixed top-6 end-6 group z-10">
      <div
        class="group relative flex justify-center items-center text-zinc-600 text-sm font-bold"
      >
        <button type="button" id="openBtn"
          class="shadow-md flex items-center group-hover:gap-2 bg-white p-3 text-black rounded-full cursor-pointer duration-300"
        >
        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 6H20M4 12H20M4 18H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span class="text-[0px] group-hover:text-sm duration-300">Menu</span>
        </div>
      </div>

    <button class="close-btn block sticky justify-self-end" id="closeBtn">Close</button>

    <div class="menu-container inline-block sticky text-white" id="menu">
      <div class="menu-option"><button type="button" id="radioHomeBtn">Home</a></div>
      <div class="menu-option"><button type="button" id="profileBtn">My profile</a></div>
      <div class="menu-option"><button type="button" id="requestsBtn">My requests</a></div>
      <div class="menu-option"><button type="button" id="logoutBtn">Logout</a></div>
    </div>

  <div class="transition-screen" id="transition">
      <div class="transition-panel"></div>
      <div class="transition-panel"></div>
      <div class="transition-panel"></div>
      <div class="transition-panel"></div>
      <div class="transition-panel"></div>
  </div>

    <!-- Close menu container -->

    <section class="" style="display: block;" id="radio-home">
      <div class="w-full h-96 md:h-[30rem] lg:h-[35rem] relative">
      <canvas class="background-canvas rounded-2xl"></canvas>
      <div
        class="absolute inset-0 flex flex-col justify-center text-white md:text-2xl lg:text-4xl text-center text-shadow-lg py-4 px-10 tracking-wide">
        <div>
          <div class="">
            <div class="flex gap-2 justify-center items-center place-self-center-4 mb-4">
              <h2 class="text-4xl text-white">On live</h2>
              <div class="spinner">
                <div class="spinner1"></div>
                <div class="circle"></div>
              </div>
            </div>
            <div class="place-items-center" id="siri-container"></div>
            <!-- Reemplazar la URL con la del servidor de streaming (Icecast) -->
            <!-- <audio class="justify-self-center" controls>
              <source
                src="https://radio.luispf.com:8000/stream"
                type="audio/mpeg"
              />
              Tu navegador no soporta el elemento de audio.
            </audio> -->
            <div class="flex items-center justify-center gap-8">
              <button type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z" clip-rule="evenodd"/>
                </svg>
              </button>

              <button type="button">
                <svg class="w-14 h-14 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M8 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8Zm7 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1Z" clip-rule="evenodd"/>
                </svg>
              </button>

              <button type="button">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M13 6.037c0-1.724-1.978-2.665-3.28-1.562L5.638 7.933H4c-1.105 0-2 .91-2 2.034v4.066c0 1.123.895 2.034 2 2.034h1.638l4.082 3.458c1.302 1.104 3.28.162 3.28-1.562V6.037Z"/>
                  <path fill-rule="evenodd" d="M14.786 7.658a.988.988 0 0 1 1.414-.014A6.135 6.135 0 0 1 18 12c0 1.662-.655 3.17-1.715 4.27a.989.989 0 0 1-1.414.014 1.029 1.029 0 0 1-.014-1.437A4.085 4.085 0 0 0 16 12a4.085 4.085 0 0 0-1.2-2.904 1.029 1.029 0 0 1-.014-1.438Z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M17.657 4.811a.988.988 0 0 1 1.414 0A10.224 10.224 0 0 1 22 12c0 2.807-1.12 5.35-2.929 7.189a.988.988 0 0 1-1.414 0 1.029 1.029 0 0 1 0-1.438A8.173 8.173 0 0 0 20 12a8.173 8.173 0 0 0-2.343-5.751 1.029 1.029 0 0 1 0-1.438Z" clip-rule="evenodd"/>
                </svg>
              </button>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Programation Drawer -->
    <div id="drawer-example" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label">
      <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
       <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
     </svg>Info</h5>
      <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
         <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
         </svg>
         <span class="sr-only">Close menu</span>
      </button>

      <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Supercharge your hiring by taking advantage of our <a href="#" class="text-blue-600 underline dark:text-blue-500 hover:no-underline">limited-time sale</a> for Flowbite Docs + Job Board. Unlimited access to over 190K top-ranked candidates and the #1 design job board.</p>
      <div class="grid grid-cols-2 gap-4">
         <a href="#" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Learn more</a>
         <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Get access <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
     </svg></a>
      </div>
   </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-4">
        <div class="bg-white sm:w-full lg:w-1/2 rounded-4xl m-8 shadow-lg p-8 place-self-center">
          <h2>Programación</h2>
          <ul class="list-none p-0">
            <!-- <?php foreach ($programas as $programa): ?> -->
            <!-- <li> -->
              <!-- <?php echo htmlspecialchars($programa['nombre']) . " - " . htmlspecialchars($programa['horario']); ?> -->
              <li class="py-3 border border-t-transparent border-x-transparent border-b-gray-300">
                Text - 10:00 AM (CST)
              </li>
              <li class="py-3 border border-t-transparent border-x-transparent border-b-gray-300">
                Text - 11:00 AM (CST)
              </li>
              <li class="py-3 border border-t-transparent border-x-transparent border-b-gray-300">
                Text - 12:00 PM (CST)
              </li>
              <li class="py-3 border border-t-transparent border-x-transparent border-b-gray-300">
                Text - 13:00 PM (CST)
              </li>
              <li class="py-3">
                Text - 14:00 PM (CST)
              </li>
            <!-- </li> -->
            <!-- <?php endforeach; ?> -->
          </ul>
        </div>

        <div class="bg-white sm:w-full lg:w-1/2 rounded-4xl p-8 shadow-lg place-self-center w-full" id="radioChat">
            <div>
              <h2 class="text-gray-800 dark:text-gray-100 text-2xl font-bold mb-4">
                Radio Chat
              </h2>
              <div class="w-full h-96 p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg mb-4">
                <div class="flex place-items-center text-base gap-2">
                  <span class="text-xs font-normal">(12:23)</span>
                  <img class="rounded-full w-7 h-7" src="//thf.bing.com/th/id/OIP.2N3yUqpMYG6VHxj1maGVpAHaEo?cb=thfc1&rs=1&pid=ImgDetMain&o=7&rm=3" alt="template">
                  <p class="font-bold">Pedro Perez Flores:</p>
                  <span class="">Hola</span>
                </div>
              </div>
                <form>
                  <label for="chat-input" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Chat</label>
                  <div class="relative">
                      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                          <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z"/>
                          </svg>
                      </div>
                      <input type="text" id="chat-input" name="chat-input" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Say hi!..." required />
                      <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        <svg class="w-4 h-4 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5"/>
                        </svg>
                      </button>
                  </div>
              </form>
            </div>
        </div>

      </div>

      <button type="button" class="btn-shine" id="requestFormBtn">
        <span>Request song</span>
      </button>

        <div class="bg-white container place-self-center mb-24 hidden" id="requests">
          <form id="registrationForm" method="POST" autocomplete="off">
            <div>
              <h2 class="text-gray-800 dark:text-gray-100 text-2xl font-bold mb-4">
                Request song
              </h2>
              <div class="mb-4 grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                  <label
                    for="title"
                    class="block text-gray-700 dark:text-gray-200 text-sm mb-2"
                    >Name/Title *</label
                  >
                  <input
                    type="text"
                    id="title"
                    name="title"
                    autocomplete="off"
                    class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                    required
                  />
                </div>
                <div>
                  <label
                    for="username"
                    class="block text-gray-700 dark:text-gray-200 text-sm mb-2"
                    >Artist/Band *</label
                  >
                  <input
                    type="text"
                    id="artist"
                    name="artist"
                    autocomplete="off"
                    class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                    required
                  />
                </div>
              </div>
              <div class="mb-4">
                <label
                  for="label"
                  class="block text-gray-700 dark:text-gray-200 text-sm mb-2"
                  >Album (Optional)</label
                >
                <input
                  type="text"
                  id="album"
                  name="album"
                  autocomplete="off"
                  class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                />
              </div>
              <div class="mb-4">
                <label
                  for="message"
                  class="block text-gray-700 dark:text-gray-200 text-sm mb-2"
                  >Message (Optional)</label
                >
                <textarea
                  type="text"
                  id="message"
                  name="message"
                  autocomplete="off"
                  class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500">
                </textarea>
              </div>
              <button
                type="button"
                onclick="showLoginForm()"
                id="sendRequest"
                class="w-full bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:ring-gray-300 cursor-pointer"
              >
                Send request
              </button>
            </div>
          </form>
        </div>
    </section>

    <section class="h-dvh" style="display: none;" id="my-profile">
      <div class="h-1/2 w-full">
        <div>
          <div class="absolute w-full h-96 bg-black text-white">
            <div class="p-10">
              <h3 class="text-sm">Radio > My Profile</h3>
              <h1 class="text-3xl font-bold mt-2">{Name}</h1>
              <h3 class="text-md">ID</h3>
            </div>
          </div>

          <div class="grid lg:flex relative pt-44 lg:justify-evenly">
            <div class="bg-white lg:w-1/2 rounded-4xl m-8 shadow-lg p-8 order-2 lg:order-1">

              <h2 class="text-gray-800 dark:text-gray-100 text-2xl font-bold mb-4">My profile</h2>
              <div class="mb-4 grid grid-cols-1 lg:grid-cols-2 gap-4">
                  <div>
                      <label for="username"
                          class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Name(s)</label>
                      <input type="text" id="nombre" name="name" autocomplete="off"
                          class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                          placeholder="Nombre" disabled>
                  </div>
                  <div>
                      <label for="username"
                          class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Surnames</label>
                      <input type="text" id="apellidos" name="surname" autocomplete="off"
                          class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                          placeholder="Apellido" disabled>
                  </div>
              </div>
              <div class="mb-4">
                  <label for="email"
                      class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Email</label>
                  <input type="email" id="email" name="email" autocomplete="off"
                      class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                      placeholder="name@test.com" disabled>
              </div>
              <h2 class="text-gray-800 dark:text-gray-100 text-2xl font-bold mb-4">Password</h2>
              <button type="button" class="block w-auto bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:ring-gray-300 cursor-pointer" id="changePswBtn">Change password?</button>
              <form class="hidden" id="formChangePsw">
                <div class="mb-4">
                    <label for="password"
                        class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Password</label>
                    <input type="password" id="password" name="password" autocomplete="off"
                        class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                        required>
                </div>
                <div class="mb-4">
                    <label for="passwordConfirm"
                        class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Confirm password</label>
                    <input type="password" id="passwordConfirm" name="passwordConfirm" autocomplete="off"
                        class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                        required>
                </div>
                <div class="flex gap-4">
                  <button type="button" class="block w-auto bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-900 focus:ring-gray-300 cursor-pointer" id="#">Change</button>
                  <button type="button" class="block w-auto bg-gray-50 border border-gray-200 text-black py-2 px-4 rounded hover:bg-gray-100 focus:ring-gray-200 cursor-pointer" id="cancelChangePswBtn">Cancel</button>
                </div>
              </form>

            </div>

            <div class="h-96 mb-8 lg:mb-0 lg:w-1/3 order-1 lg:order-2">
              <div class="absolute justify-self-center">
                <img class="rounded-full w-36 h-36 shadow-lg" src="https://thf.bing.com/th/id/OIP.2N3yUqpMYG6VHxj1maGVpAHaEo?cb=thfc1&rs=1&pid=ImgDetMain&o=7&rm=3" alt="template">
              </div>

              <div class="h-96 w-auto bg-white rounded-4xl m-8 shadow-lg">
                <div class="text-center pt-32">
                  <h3 class="text-xl">{Name}</h1>
                  <p class="text-lg">ID</p>
                </div>
                <div class="grid grid-cols-2 justify-items-center pt-8">
                  <div class="text-center">
                    <h3 class="text-xl">Hours listening</h1>
                    <p class="text-lg">00</p>
                  </div>
                  <div class="text-center">
                    <h3 class="text-xl">My requests</h1>
                    <p class="text-lg">00</p>
                    <button type="button" class="text-xs text-gray-600 underline" id="requestsBtnNavbar">See my requests</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="h-dvh" style="display: none;" id="my-requests">
      <div class="h-1/2 w-full">
        <div>
          <div class="absolute w-full h-96 bg-black text-white">
            <div class="p-10">
              <h3 class="text-sm">Radio > My Requests</h3>
              <h1 class="text-3xl font-bold mt-2">{Name}</h1>
              <h3 class="text-md">ID</h3>
            </div>
          </div>

          <div class="flex relative pt-44">
            <div class="bg-white w-full rounded-4xl m-8 shadow-lg p-8">

              <h2 class="text-gray-800 dark:text-gray-100 text-2xl font-bold mb-4">My profile</h2>
              <div class="mb-4 grid grid-cols-1 lg:grid-cols-2 gap-4">
                  <div>
                      <label for="name"
                          class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Name(s)</label>
                      <input type="text" id="name" name="name" autocomplete="off"
                          class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                          placeholder="Nombre" disabled>
                  </div>
                  <div>
                      <label for="surname"
                          class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Surnames</label>
                      <input type="text" id="surname" name="surname" autocomplete="off"
                          class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                          placeholder="Apellido" disabled>
                  </div>
              </div>
              <div class="mb-4">
                  <label for="email"
                      class="block text-gray-700 dark:text-gray-200 text-sm mb-2">Email</label>
                  <input type="email" id="email" name="email" autocomplete="off"
                      class="w-full p-2.5 border bg-gray-50 border-gray-300 text-gray-700 dark:border-gray-600 dark:text-white rounded-lg focus:outline-none focus:ring-gray-600 focus:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-500"
                      placeholder="name@test.com" disabled>
              </div>
              <h2 class="text-gray-800 dark:text-gray-100 text-2xl font-bold mb-4">Password</h2>

            </div>

          </div>
        </div>
      </div>
    </section>

    <div data-dial-init class="fixed end-6 bottom-5 group">
      <button
        type="button"
        aria-expanded="false"
        class="flex items-center justify-center text-white bg-gray-700 rounded-full w-14 h-14 hover:bg-gray-800 dark:bg-gray-600 dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-800"
      >
        <svg
          class="w-5 h-5"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 16 16"
        >
          <path
            fill="currentColor"
            d="M6.5 1.5a.5.5 0 0 0-1 0V2h-2A1.5 1.5 0 0 0 2 3.5v3A1.5 1.5 0 0 0 3.5 8h2.588q.064-.172.172-.325c.17-.24.41-.42.69-.521L7.43 7H3.5a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v1.877l.133-.407c.11-.3.29-.54.53-.71q.159-.114.337-.177V3.5A1.5 1.5 0 0 0 8.5 2h-2zm-4 8h3.913a1.4 1.4 0 0 0 .558.348l1.06.35c.151.051.291.131.471.291l.01.011H2.5a.5.5 0 0 0-.5.5v.35c0 .945.408 1.575 1.082 1.994C3.786 13.782 4.805 14 6 14c1.203 0 2.222-.219 2.923-.656c.282-.175.517-.388.695-.646l.055.045q.21.15.45.21a1.3 1.3 0 0 0-.097.797a3.5 3.5 0 0 1-.574.443C8.528 14.77 7.297 15 6 15c-1.29 0-2.521-.232-3.446-.807C1.599 13.6 1 12.655 1 11.35V11a1.5 1.5 0 0 1 1.5-1.5M5.25 5a.75.75 0 1 1-1.5 0a.75.75 0 0 1 1.5 0m2.25.75a.75.75 0 1 0 0-1.5a.75.75 0 0 0 0 1.5m3.378-.468l.348 1.071a2.2 2.2 0 0 0 1.398 1.397l1.072.348l.021.006a.423.423 0 0 1 0 .798l-1.071.348a2.2 2.2 0 0 0-1.399 1.397l-.348 1.07a.423.423 0 0 1-.798 0l-.348-1.07A2.2 2.2 0 0 0 9.1 9.67a2.2 2.2 0 0 0-.747-.426l-1.072-.348a.423.423 0 0 1 0-.798l1.072-.348A2.2 2.2 0 0 0 9.73 6.353l.348-1.07a.423.423 0 0 1 .799 0m4.905 7.931l-.765-.248a1.58 1.58 0 0 1-1-.998l-.248-.765a.302.302 0 0 0-.57 0l-.25.765a1.58 1.58 0 0 1-.983.998l-.765.248a.303.303 0 0 0-.146.46c.036.05.087.09.146.11l.765.249a1.58 1.58 0 0 1 1 1.002l.248.764a.302.302 0 0 0 .57 0l.249-.764a1.58 1.58 0 0 1 .999-.999l.765-.248a.302.302 0 0 0 0-.57z"
          />
        </svg>
        <span class="sr-only">Open actions menu</span>
      </button>
    </div>

    <footer class="bg-white rounded-lg shadow-sm dark:bg-gray-900 pb-12">
      <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
          <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
            <p class="text-white">Logo goes here</p>
          </a>
          <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
            <li>
              <a href="#" class="hover:underline me-4 md:me-6">About</a>
            </li>
            <li>
              <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
            </li>
            <li>
              <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
            </li>
            <li>
              <a href="#" class="hover:underline">Contact</a>
            </li>
          </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2026 <a href="#"
            class="hover:underline">Luis Flores</a>.</span>
      </div>
    </footer>

    <script>
      // Control básico del reproductor
      const audio = document.querySelector("audio");
      audio.addEventListener("play", () => {
        console.log("Reproduciendo stream...");
      });
      audio.addEventListener("error", () => {
        alert(
          "Error al conectar con el stream. Verifica la URL o el servidor."
        );
      });
    </script>
        <script>
          const openBtn = document.getElementById("openBtn");
          const closeBtn = document.getElementById("closeBtn");
          const transition = document.getElementById("transition");
          const menu = document.getElementById("menu");

          const radioHomeBtn = document.getElementById("radioHomeBtn");
          const profileBtn = document.getElementById("profileBtn");
          const requestsBtn = document.getElementById("requestsBtn");
          const logoutBtn = document.getElementById("logoutBtn");

          const homeBtnNavbar = document.getElementById("homeBtnNavbar");
          const profileBtnNavbar = document.getElementById("profileBtnNavbar");
          const requestsBtnNavbar = document.getElementById("requestsBtnNavbar");
          const logoutBtnNavbar = document.getElementById("logoutBtnNavbar");

          const radioHome = document.getElementById("radio-home");
          const myProfile = document.getElementById("my-profile");
          const myRequests = document.getElementById("my-requests");

          const siriNavbar = document.getElementById("siri-container-2");

          document.addEventListener("DOMContentLoaded", function () {

            if (!transition) return;

            transition.classList.add("show", "rise");
            transition.classList.remove("down", "up", "from-bottom");

            window.addEventListener("load", function() {
              requestAnimationFrame(() => {
                transition.classList.add("up");
              });

              const panels = transition.querySelectorAll(".transition-panel");
              const last = panels[panels.length - 1];

              const cleanup = () => {
                transition.classList.remove("show", "from-bottom", "rise");
              };

              if (last) {
                last.addEventListener("transitionend", cleanup, { once: true });
              } else {
                setTimeout(cleanup, 900);
              }

            }, { once: true });
        });

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

          // ---Menu Options---

          // Radio option
          radioHomeBtn.addEventListener("click", () => {
            closeBtn.style.display = "none";
            menu.style.display = "none";
            transition.classList.remove("down");
            transition.classList.add("up");

            setTimeout(() => {
                transition.classList.remove("show");
            }, 900);

            myProfile.style.display = "none";
            myRequests.style.display = "none";
            radioHome.style.display = "block";
            siriNavbar.classList.add("hidden");
          });

          // Profile option
          profileBtn.addEventListener("click", () => {
            closeBtn.style.display = "none";
            menu.style.display = "none";
            transition.classList.remove("down");
            transition.classList.add("up");

            setTimeout(() => {
                transition.classList.remove("show");
            }, 900);

            radioHome.style.display = "none";
            myRequests.style.display = "none";
            myProfile.style.display = "block";
            siriNavbar.classList.remove("hidden");
          });

          // Requests option
          requestsBtn.addEventListener("click", () => {
            closeBtn.style.display = "none";
            menu.style.display = "none";
            transition.classList.remove("down");
            transition.classList.add("up");

            setTimeout(() => {
                transition.classList.remove("show");
            }, 900);

            radioHome.style.display = "none";
            myProfile.style.display = "none";
            myRequests.style.display = "block";
            siriNavbar.classList.remove("hidden");
          });

          // --- Navbar options ---
          // Radio Btn
          homeBtnNavbar.addEventListener("click", () => {
            transition.classList.add("show");
            transition.classList.remove("up", "down");

            setTimeout(() => {
              transition.classList.add("down");
            }, 20);

            setTimeout(() => {
              transition.classList.remove("down");
              myProfile.style.display = "none";
              myRequests.style.display = "none";
              radioHome.style.display = "block";
              siriNavbar.classList.add("hidden");
            }, 900);

            setTimeout(() => {
              transition.classList.remove("show");
            }, 1800);
          });

          // Profile Btn
          profileBtnNavbar.addEventListener("click", () => {
            transition.classList.add("show");
            transition.classList.remove("up", "down");

            setTimeout(() => {
              transition.classList.add("down");
            }, 20);

            setTimeout(() => {
              transition.classList.remove("down");
              radioHome.style.display = "none";
              myRequests.style.display = "none";
              myProfile.style.display = "block";
              siriNavbar.classList.remove("hidden");
            }, 900);

            setTimeout(() => {
              transition.classList.remove("show");
            }, 1800);
          });

          // Requests Btn
          requestsBtnNavbar.addEventListener("click", () => {
            transition.classList.add("show");
            transition.classList.remove("up", "down");

            setTimeout(() => {
              transition.classList.add("down");
            }, 20);

            setTimeout(() => {
              transition.classList.remove("down");
              radioHome.style.display = "none";
              myProfile.style.display = "none";
              myRequests.style.display = "block";
              siriNavbar.classList.remove("hidden");
            }, 900);

            setTimeout(() => {
              transition.classList.remove("show");
            }, 1800);
          });

          // Logout Btn
          logoutBtnNavbar.addEventListener("click", () => {
            transition.classList.add("show");
            transition.classList.remove("up", "down");

            setTimeout(() => {
              transition.classList.add("down");
            }, 20);

            setTimeout(() => {
              radioHome.style.display = "none";
              myRequests.style.display = "none";
              myProfile.style.display = "none";

              // !!!THIS IS FOR LOCAL/TESTING ONLY:!!!
              window.location.href = "login.html";
            }, 900);
          });
      </script>
      <script>
        const changePswBtn = document.getElementById("changePswBtn");
        const cancelChangePswBtn = document.getElementById("cancelChangePswBtn");
        const formChangePsw = document.getElementById("formChangePsw")

        changePswBtn.addEventListener("click", () => {
          changePswBtn.classList.add("hidden");
          formChangePsw.classList.remove("hidden");
        });

        cancelChangePswBtn.addEventListener("click", () => {
          formChangePsw.classList.add("hidden");
          changePswBtn.classList.remove("hidden");
        });
      </script>
      <script>
        const requestFormBtn = document.getElementById("requestFormBtn");
        const requestForm = document.getElementById("requests");

        requestFormBtn.addEventListener("click", () => {
          requestFormBtn.classList.add("hidden");
          requestForm.classList.remove("hidden");
        });
      </script>
    <script>
      const siriWave = new SiriWave({
          container: document.getElementById('siri-container'),
          width: 800,
          height: 200,
          style: 'ios9',
          speed: 0.3,
          amplitude: 1.5,
          autostart: true
      });

      const siriWave2 = new SiriWave({
          container: document.getElementById('siri-container-2'),
          width: 300,
          height: 50,
          style: 'ios9',
          speed: 0.3,
          amplitude: 1.5,
          autostart: true
      });
  </script>
  <script src="../dist/bundle.js"></script>
  </body>
</html>
