<?php
$servername = "localhost"; //  dirección del servidor de la base de datos
$username = "root";  // nombre de usuario de la base de datos
$password = "";  // contraseña de la base de datos
$dbname = "hogares_en_concreto";  // nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conectado";
}
?>