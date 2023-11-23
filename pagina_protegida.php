<?php
session_start();

// Verificar si el agente está autenticado
if (!isset($_SESSION['correo'])) {
    header('Location: inicio.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agente de ventas</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['correo']; ?></h1>

    <!-- Enlace para ir a la página de productos -->
    <p><a href="productos.html">Ir a la página de productos</a></p>
    

    <!-- Enlaces para agregar y borrar casas -->
    <p><a href="agregar_casa.php">Agregar Casa</a></p>
    <p><a href="borrar_casa.php">Borrar Casa</a></p>
    <!-- Formulario para agregar una casa -->
    <form action="procesar_casas.php" method="post" enctype="multipart/form-data">
        <label for="id_municipio">ID del Municipio:</label>
        <input type="text" id="id_municipio" name="id_municipio" required>

        <label for="precio">Precio:</label>
    <input type="text" id="precio" name="precio" required>

    <label for="categoria">Categoría:</label>
    <input type="text" id="categoria" name="categoria" required>

    <label for="ubicacion">Ubicación:</label>
    <input type="text" id="ubicacion" name="ubicacion" required>

    <label for="distribucion">Distribución:</label>
    <textarea id="distribucion" name="distribucion" required></textarea>

    <label for="equipamiento">Equipamiento:</label>
    <textarea id="equipamiento" name="equipamiento" required></textarea>

    <label for="formas_compra">Formas de Compra:</label>
    <textarea id="formas_compra" name="formas_compra" required></textarea>

    <label for="fotos">Fotos:</label>
    <input type="file" id="fotos" name="fotos[]" multiple accept="image/*">

    <label for="coordenadas">Coordenadas para el mapa:</label>
    <input type="text" id="coordenadas" name="coordenadas" required>

    <input type="hidden" name="accion" value="guardar_casa">

    <input type="submit" value="Guardar Casa">
    </form>

    <!-- Enlace para cerrar sesión -->
    <p><a href="cerrar_sesion.php">Cerrar Sesión</a></p>
</body>
</html>