<?php
// Desactivar TODOS los errores y advertencias
error_reporting(0);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

// filepath: c:\wamp64\www\Impala\Control-Accesos\config\config.php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "root";
$database = "tata_radio";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}