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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broken Minds</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 1em;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
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
        .programas {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
        }
        .programas h2 {
            margin-top: 0;
        }
        .programas ul {
            list-style: none;
            padding: 0;
        }
        .programas li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .programas li:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Radio Online</h1>
        <p>¡Sintoniza tu música favorita!</p>
    </header>
    <div class="container">
        <div class="player">
            <h2>Escucha en vivo</h2>
            <!-- Reemplaza la URL con la de tu servidor de streaming (Icecast/Shoutcast) -->
            <audio controls>
                <source src="http://localhost:8000/stream" type="audio/mpeg">
                Tu navegador no soporta el elemento de audio.
            </audio>
        </div>
        <div class="programas">
            <h2>Programación</h2>
            <ul>
                <?php foreach ($programas as $programa): ?>
                    <li><?php echo htmlspecialchars($programa['nombre']) . " - " . htmlspecialchars($programa['horario']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <script>
        // Control básico del reproductor
        const audio = document.querySelector('audio');
        audio.addEventListener('play', () => {
            console.log('Reproduciendo stream...');
        });
        audio.addEventListener('error', () => {
            alert('Error al conectar con el stream. Verifica la URL o el servidor.');
        });
    </script>
</body>
</html>