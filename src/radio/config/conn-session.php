<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ./../");
    exit();
}

include './config/config.php';

$tipo = $_SESSION['tipo'];
$userId = $_SESSION['userId'];
$user = $_SESSION['user'];
$username = $_SESSION['username'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$email = $_SESSION['email'];
$instancia = $_SESSION['instancia'];
$municipio = $_SESSION['municipio'];
$estado = $_SESSION['estado'];
$pais = $_SESSION['pais'];

$sql = "SELECT userId, nombre, apellido, imagen, tipo, instancia, municipio, estado, pais, email FROM users";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error al preparar: (" . $stmt->errno . ") " . $stmt->error);
}

if (!$stmt->execute()) {
    die("Error al ejecutar: (" . $stmt->errno . ") " . $stmt->error);
}

$userResult = $stmt->get_result();

if (!$userResult) {
    die("Error al obtener resultados (" . $stmt->errno . ") " . $stmt->error);
}

function userType($tipo)
{
    switch ($tipo) {
        //Super administrador
        case '1':
            return 'Seguridad Patrimonial';
        //Primer nivel
        case '2':
            return 'Validador';
        case '3':
            return 'Control de acceso';
        case '4':
            return 'Anfitrión';
        case '5':
            return 'Administrador de contratos';
        case '6':
            return 'Administrador de contratos';
        case '7':
            return 'Compras';
        case '8':
            return 'Cliente interno';
        // Segundo nivel
        case '9':
            return 'Interno';
        case '10':
            return 'Tercero';
        case '11':
            return 'Proveedor';
        case '12':
            return 'Contratista';
        // Tercer nivel
        case '13':
            return 'Elemento de proveedor';
        case '14':
            return 'Elemento de contratista';
        default:
            return 'Desconocido';
    }
}
