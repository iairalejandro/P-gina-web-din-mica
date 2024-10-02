<?php
$servername = "localhost"; // Cambia según tu configuración
$username = "root";
$password = ""; 
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
