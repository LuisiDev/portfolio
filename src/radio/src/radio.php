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
    <title>Radio | TCS Radio</title>
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
              <h3 class="text-md">TCS Employee</h3>
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
                      placeholder="name@tcs.com" disabled>
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
                  <p class="text-lg">TCS Employee</p>
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
              <h3 class="text-md">TCS Employee</h3>
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
                      placeholder="name@tcs.com" disabled>
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
          <a href="https://tcs.com/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"

              class="h-8" viewBox="0 0 5510.000000 1550.000000"
              preserveAspectRatio="xMidYMid meet">
              <g transform="translate(0.000000,1550.000000) scale(0.100000,-0.100000)"
                class="fill-gray-700 dark:fill-white" stroke="none">
                <path d="M2720 13794 c-159 -31 -315 -104 -415 -196 -148 -136 -237 -316 -264
-533 -15 -120 -16 -8467 -1 -8700 32 -511 129 -905 315 -1280 366 -740 1037
-1197 1969 -1339 513 -79 1027 -67 1468 34 277 63 453 126 698 250 431 219
797 550 1065 964 l67 103 113 -113 c672 -667 1565 -1095 2600 -1243 330 -48
443 -55 875 -55 425 -1 521 4 800 45 784 114 1468 414 2084 915 153 125 460
431 595 593 553 664 999 1510 1371 2596 34 99 158 497 276 885 118 388 217
711 219 718 3 9 31 -19 72 -70 84 -106 398 -419 528 -527 179 -149 390 -301
1025 -741 939 -651 1055 -734 1225 -877 172 -145 294 -372 340 -639 27 -149
25 -398 -4 -532 -80 -380 -305 -667 -655 -838 -433 -210 -944 -225 -1606 -44
-80 22 -282 84 -450 139 -439 142 -455 146 -635 146 -166 0 -204 -8 -325 -71
-176 -92 -282 -255 -311 -480 -35 -274 78 -507 328 -674 371 -248 1223 -488
1923 -541 199 -15 651 -7 820 15 570 74 1020 231 1430 500 567 372 948 960
1064 1646 55 322 45 758 -24 1096 -74 362 -246 719 -496 1034 -96 121 -397
417 -544 536 -188 151 -253 198 -1060 759 -410 284 -797 556 -860 603 -67 50
-180 151 -271 241 -222 222 -324 383 -387 611 -24 85 -27 112 -27 265 0 138 4
182 19 235 46 156 127 293 235 393 82 75 132 109 243 162 199 95 396 131 678
122 338 -11 526 -54 1011 -233 338 -124 398 -138 599 -139 169 0 199 5 304 50
65 28 151 91 200 147 51 57 117 185 134 258 32 132 23 313 -20 427 -28 75
-109 193 -171 249 -117 106 -296 204 -568 310 -299 116 -640 196 -1036 240
-191 21 -722 30 -894 15 -783 -71 -1429 -382 -1872 -901 -361 -422 -653 -933
-922 -1610 -134 -338 -187 -498 -466 -1420 -268 -881 -324 -1055 -426 -1330
-318 -849 -701 -1489 -1173 -1960 -482 -482 -1051 -765 -1729 -860 -471 -67
-1002 -37 -1447 80 -1161 306 -1946 1194 -2174 2460 -73 407 -84 920 -30 1345
106 823 429 1505 953 2011 415 402 931 651 1542 746 122 19 183 22 465 22 208
1 363 -4 430 -12 468 -57 804 -151 1271 -356 220 -96 366 -129 574 -128 143 0
236 18 339 67 166 78 291 233 341 420 23 84 30 246 16 330 -41 233 -212 432
-498 578 -1064 544 -2643 690 -3858 356 -1248 -342 -2223 -1143 -2780 -2284
-299 -612 -458 -1240 -506 -1995 -13 -201 -7 -662 11 -865 45 -508 144 -964
302 -1393 l61 -164 -46 -91 c-241 -486 -596 -842 -993 -997 -217 -85 -407
-115 -672 -107 -262 7 -437 45 -629 137 -134 64 -230 131 -332 232 -169 169
-285 386 -354 663 -40 157 -58 294 -67 510 -5 110 -10 1292 -10 2628 l0 2427
1048 0 c671 0 1078 4 1132 11 125 15 194 35 299 86 78 37 109 59 176 127 131
131 185 266 185 462 0 326 -194 566 -533 656 -82 22 -85 22 -1194 25 l-1113 4
0 957 c0 626 -4 979 -11 1018 -57 327 -275 573 -584 659 -59 17 -337 30 -395
19z" />
                <path d="M24220 13365 l0 -435 425 0 425 0 0 -1075 0 -1075 605 0 605 0 0
1075 0 1075 425 0 425 0 0 435 0 435 -1455 0 -1455 0 0 -435z" />
                <path d="M27425 12309 c-313 -821 -571 -1500 -573 -1510 -3 -19 14 -19 585
-17 l588 3 305 897 c168 493 308 891 311 885 4 -7 140 -405 303 -885 164 -481
300 -880 303 -888 4 -12 96 -14 594 -14 324 0 589 2 589 4 0 2 -255 669 -566
1482 -311 813 -571 1491 -576 1507 l-10 27 -641 0 -642 0 -570 -1491z" />
                <path d="M30140 13365 l0 -435 430 0 430 0 0 -1075 0 -1075 600 0 600 0 0
1075 0 1075 430 0 430 0 0 435 0 435 -1460 0 -1460 0 0 -435z" />
                <path d="M33909 13773 c-6 -16 -263 -687 -571 -1493 -308 -806 -563 -1473
-566 -1482 -4 -17 29 -18 585 -18 l590 0 304 895 c167 492 306 895 309 895 3
0 142 -403 309 -895 l305 -895 589 0 589 0 -6 23 c-3 12 -262 690 -575 1507
l-568 1485 -642 3 -641 2 -11 -27z" />
                <path d="M25635 9314 c-748 -82 -1259 -541 -1391 -1251 -24 -134 -30 -440 -10
-589 94 -711 555 -1164 1276 -1253 109 -14 413 -14 538 0 180 19 431 79 478
114 17 12 15 25 -25 221 -24 115 -45 212 -47 215 -1 3 -47 -9 -101 -27 -136
-45 -261 -65 -448 -71 -367 -12 -628 83 -836 305 -120 128 -205 302 -246 508
-22 112 -25 412 -4 524 32 180 105 354 202 483 263 350 802 468 1323 291 55
-18 101 -32 103 -31 1 2 29 99 61 217 l59 215 -56 26 c-71 33 -188 64 -316 85
-97 15 -474 27 -560 18z" />
                <path d="M27920 9305 c-307 -49 -564 -184 -776 -408 -274 -290 -413 -677 -414
-1154 0 -266 37 -477 121 -688 230 -577 758 -897 1397 -846 356 29 636 148
866 371 324 313 480 787 445 1350 -15 250 -65 445 -169 657 -194 397 -543 652
-983 717 -127 19 -368 19 -487 1z m398 -445 c143 -34 245 -94 353 -206 111
-117 184 -245 238 -419 51 -167 65 -269 65 -470 -1 -211 -22 -350 -80 -515
-62 -180 -124 -283 -238 -395 -136 -133 -280 -194 -478 -203 -146 -6 -238 13
-363 73 -284 136 -472 474 -504 907 -34 462 121 897 394 1105 167 127 400 174
613 123z" />
                <path d="M33845 9309 c-262 -35 -465 -129 -625 -289 -79 -78 -104 -111 -143
-187 -68 -131 -89 -220 -90 -373 -1 -151 14 -215 79 -350 39 -79 62 -109 138
-186 147 -148 272 -221 607 -354 229 -90 318 -139 403 -219 120 -115 153 -260
94 -418 -23 -62 -99 -150 -161 -186 -222 -130 -634 -105 -990 61 -53 25 -99
43 -101 41 -2 -2 -31 -104 -63 -227 l-60 -223 41 -23 c105 -61 355 -132 546
-156 125 -15 386 -12 507 6 372 55 647 231 779 499 65 132 86 223 87 380 1
163 -18 257 -80 382 -106 218 -316 376 -711 533 -348 139 -462 211 -521 333
-90 183 -15 372 182 462 190 87 522 66 795 -52 46 -19 85 -34 87 -32 1 2 32
102 68 223 l65 218 -62 28 c-78 36 -213 74 -331 96 -107 19 -438 27 -540 13z" />
                <path d="M49275 9309 c-557 -68 -1001 -368 -1220 -824 -125 -261 -182 -588
-156 -903 33 -410 161 -712 406 -957 203 -204 457 -331 780 -391 82 -16 149
-19 365 -19 285 0 388 11 578 60 77 21 192 62 192 70 0 1 -20 98 -45 215 -25
117 -45 214 -45 215 0 2 -37 -10 -82 -26 -174 -59 -369 -84 -578 -76 -299 13
-522 99 -696 272 -201 199 -295 458 -295 815 0 413 138 723 408 916 283 203
723 246 1128 110 55 -19 103 -31 106 -28 4 4 33 101 64 216 53 193 56 211 40
222 -31 23 -208 74 -330 95 -139 24 -487 34 -620 18z" />
                <path d="M30040 7760 l0 -1510 255 0 255 0 0 768 c0 710 -10 1303 -26 1515 -3
48 -2 87 3 87 4 0 28 -44 53 -97 170 -378 293 -600 851 -1542 l433 -731 283 0
283 0 0 1510 0 1510 -257 0 -256 0 6 -827 c6 -793 13 -1020 38 -1326 6 -76 9
-140 7 -142 -2 -3 -35 64 -72 148 -89 198 -249 511 -364 712 -50 88 -264 446
-474 795 l-383 635 -317 3 -318 2 0 -1510z" />
                <path d="M35393 8268 c3 -981 4 -1006 25 -1118 90 -470 306 -754 671 -879 315
-108 772 -83 1056 59 353 175 548 508 594 1010 7 70 11 467 11 1023 l0 907
-274 0 -275 0 -4 -967 c-4 -1062 -3 -1051 -66 -1237 -36 -109 -81 -185 -151
-256 -66 -66 -122 -100 -215 -132 -94 -31 -300 -33 -385 -4 -188 65 -310 196
-380 409 -54 166 -53 146 -57 1205 l-4 982 -275 0 -275 0 4 -1002z" />
                <path d="M38380 7760 l0 -1510 895 0 895 0 0 235 0 235 -620 0 -620 0 0 1275
0 1275 -275 0 -275 0 0 -1510z" />
                <path d="M39860 9040 l0 -230 435 0 435 0 0 -1280 0 -1280 275 0 275 0 0 1280
0 1280 435 0 435 0 0 230 0 230 -1145 0 -1145 0 0 -230z" />
                <path d="M42435 7774 c-264 -823 -481 -1502 -483 -1510 -3 -12 42 -14 282 -14
l285 0 35 113 c19 61 62 204 96 317 34 113 77 256 96 318 l35 112 474 0 c261
0 476 -4 479 -8 3 -5 65 -197 139 -428 l135 -419 297 -3 c286 -2 297 -2 293
16 -3 10 -223 690 -489 1510 l-484 1492 -355 0 -355 0 -480 -1496z m825 1043
c0 -40 136 -516 243 -852 69 -214 128 -400 131 -412 l7 -23 -386 0 c-355 0
-387 1 -381 16 45 117 261 839 308 1032 34 138 66 252 70 252 5 0 8 -6 8 -13z" />
                <path d="M45020 7760 l0 -1510 255 0 255 0 0 778 c0 720 -11 1329 -26 1515 -3
43 -2 77 3 77 5 0 35 -57 67 -127 68 -149 247 -500 336 -658 34 -60 258 -442
498 -847 l437 -738 288 0 287 0 0 1510 0 1510 -255 0 -255 0 0 -802 c0 -772 6
-1020 31 -1341 6 -81 9 -150 7 -152 -2 -2 -30 55 -63 128 -66 149 -221 462
-296 600 -28 51 -249 424 -492 829 l-442 737 -317 1 -318 0 0 -1510z" />
                <path d="M50423 9263 c2 -5 217 -400 476 -879 l471 -871 0 -632 0 -631 275 0
275 0 0 633 0 632 496 864 c272 474 498 869 501 877 4 12 -41 14 -307 12
l-311 -3 -228 -485 c-125 -267 -265 -573 -311 -680 -46 -107 -84 -196 -85
-198 -1 -1 -28 60 -60 135 -48 113 -210 469 -526 1151 l-38 82 -316 0 c-174 0
-314 -3 -312 -7z" />
                <path d="M25160 4784 c-151 -19 -315 -66 -425 -122 -206 -103 -361 -279 -431
-487 -22 -66 -28 -103 -32 -211 -5 -156 11 -250 64 -360 113 -239 329 -399
755 -562 311 -119 437 -206 501 -348 18 -40 22 -67 22 -144 0 -123 -24 -189
-97 -263 -106 -106 -235 -149 -447 -150 -84 0 -173 7 -235 18 -121 21 -313 82
-417 133 -43 21 -78 37 -78 36 0 -1 -27 -102 -60 -225 -33 -123 -60 -226 -60
-230 0 -12 154 -77 255 -108 194 -59 350 -81 573 -81 536 0 917 204 1070 573
47 113 65 229 59 377 -3 69 -13 152 -22 185 -38 139 -132 287 -241 381 -133
115 -259 184 -529 294 -281 115 -365 160 -451 245 -82 81 -105 134 -105 237 0
180 129 310 351 354 104 21 291 14 420 -15 87 -20 242 -72 293 -98 16 -8 31
-12 34 -9 3 2 31 91 62 198 32 106 61 203 65 216 7 20 1 25 -56 52 -79 36
-215 76 -333 96 -87 15 -429 27 -505 18z" />
                <path d="M36653 4779 c-361 -42 -684 -187 -921 -413 -291 -278 -441 -635 -459
-1091 -19 -491 120 -891 411 -1181 230 -230 512 -358 889 -405 126 -15 496 -6
632 15 128 21 254 52 331 83 l61 24 -44 217 c-25 119 -46 218 -47 218 0 1 -46
-13 -101 -31 -132 -44 -259 -65 -431 -72 -501 -21 -857 179 -1027 576 -75 175
-109 422 -89 641 35 372 179 639 437 808 289 190 748 221 1130 77 37 -14 70
-23 73 -20 3 2 31 100 63 217 51 185 57 214 44 224 -49 36 -296 96 -474 114
-119 12 -373 11 -478 -1z" />
                <path d="M41117 4774 c-351 -54 -620 -230 -750 -490 -105 -209 -109 -491 -10
-689 115 -229 351 -404 733 -545 241 -89 412 -189 473 -278 56 -80 72 -131 71
-227 0 -76 -4 -99 -26 -147 -36 -79 -70 -120 -132 -162 -217 -150 -642 -131
-1025 46 -47 21 -88 35 -92 31 -7 -8 -119 -421 -119 -440 0 -13 137 -76 235
-108 100 -32 240 -61 370 -76 143 -17 443 -6 567 21 401 85 669 313 759 645
32 114 32 345 1 458 -44 159 -141 306 -273 411 -131 104 -254 169 -522 277
-410 164 -529 269 -531 469 -1 66 3 84 32 142 55 112 161 183 316 213 194 37
471 -3 692 -101 31 -14 58 -23 60 -22 1 2 32 100 67 218 75 248 79 222 -47
271 -99 38 -258 74 -388 88 -131 15 -353 12 -461 -5z" />
                <path d="M26670 3230 l0 -1510 915 0 915 0 0 230 0 230 -635 0 -635 0 0 440 0
440 565 0 565 0 0 225 0 225 -565 0 -565 0 0 390 0 390 600 0 600 0 0 225 0
225 -880 0 -880 0 0 -1510z" />
                <path d="M29313 4725 c-131 -13 -267 -32 -310 -42 l-23 -5 0 -1479 0 -1479
275 0 275 0 0 621 0 622 188 -6 c198 -6 263 -17 351 -61 93 -48 174 -154 222
-293 11 -32 49 -177 85 -323 67 -275 111 -431 146 -512 l20 -48 279 0 c154 0
279 2 279 4 0 2 -18 57 -40 122 -21 66 -79 277 -129 469 -94 370 -108 412
-174 540 -51 98 -164 216 -250 261 l-59 31 78 37 c208 99 360 265 430 471 36
106 45 308 19 436 -75 372 -364 582 -877 638 -131 15 -622 12 -785 -4z m781
-420 c77 -21 165 -66 211 -106 144 -127 185 -364 96 -555 -55 -118 -158 -202
-305 -251 -77 -25 -94 -27 -323 -31 l-243 -4 0 475 0 475 73 10 c110 16 419 8
491 -13z" />
                <path d="M31270 4730 c0 -9 797 -2481 916 -2843 l56 -167 316 2 317 3 521
1508 521 1507 -296 -2 -296 -3 -192 -605 c-355 -1114 -439 -1394 -514 -1707
-19 -79 -36 -143 -39 -143 -3 0 -25 82 -49 183 -66 276 -140 536 -407 1427
-135 448 -247 823 -250 833 -5 16 -28 17 -305 17 -191 0 -299 -4 -299 -10z" />
                <path d="M34240 3230 l0 -1510 275 0 275 0 0 1510 0 1510 -275 0 -275 0 0
-1510z" />
                <path d="M38060 3230 l0 -1510 910 0 910 0 0 230 0 230 -635 0 -635 0 0 440 0
440 570 0 570 0 0 225 0 225 -567 2 -568 3 -3 388 -2 387 605 0 605 0 0 225 0
225 -880 0 -880 0 0 -1510z" />
              </g>
            </svg>
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
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://tcs.com/"
            class="hover:underline">TATA Consultancy Services</a>. All Rights Reserved.</span>
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
