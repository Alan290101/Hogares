<?php
header("X-Content-Type-Options: nosniff");
session_start();

include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT * FROM agentes WHERE correo = '$correo' AND contraseña = '$contraseña'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Credenciales válidas
        $_SESSION['correo'] = $correo;
        header('Location: pagina_protegida.php'); // Redirige a la página protegida
        exit();
    } else {
        // Credenciales inválidas
        $error_message = "Credenciales inválidas. Por favor, inténtalo de nuevo.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Inicio de Sesión</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <?php
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }

    // Verificar si el agente ha iniciado sesión
    $mostrarFormulario = isset($_SESSION['correo']);
    ?>

    <!-- Agrega el formulario aquí -->
    <?php if ($mostrarFormulario): ?>
        <form action="procesar_casas.php" method="post" enctype="multipart/form-data">
            <!-- ... (contenido del formulario) ... -->
        </form>
    <?php endif; ?>

    <p><a href="inicio.html">Volver al inicio de sesión</a></p>
</body>
</html>