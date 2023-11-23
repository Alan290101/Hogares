<?php
session_start();
include('conexion.php');

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Agrega aquí tus enlaces a CSS, JavaScript, etc. -->
</head>

<body>
    <div class="menu container">
        <a href="#">
            <img src="imagenes/Img.jpg" alt="Logo" class="logo-img">
        </a>
        <nav class="navbar">
            <ul>
                <li><a href="Index.html">Inicio</a></li>
                <li><a href="Servicios.html">Servicios</a></li>
                <li><a href="Productos.html">Productos</a></li>
                <li><a href="Aviso de privacidad.html">Aviso de Privacidad</a></li>
                <li><a href="ClientesS.html">Clientes Satisfechos</a></li>
            </ul>
        </nav>
    </div>

    <div class="container">
        <!-- Menú desplegable -->
        <nav class="menu-desplegable">
            <ul>
                <?php
                // Consulta para obtener todos los municipios
                $sql_municipios = "SELECT * FROM municipios";
                $result_municipios = $conn->query($sql_municipios);

                if ($result_municipios->num_rows > 0) {
                    while ($row_municipio = $result_municipios->fetch_assoc()) {
                        $id_municipio = $row_municipio['id_municipio'];
                        $nombre_municipio = $row_municipio['nombre'];

                        echo '<li class="menu-item"><a href="#" onclick="mostrarSeccion(' . $id_municipio . ')">' . $nombre_municipio . '</a></li>';
                    }
                }
                ?>
            </ul>
        </nav>

        <!-- Contenido dinámico de productos -->
        <?php
        // Consulta para obtener todas las casas
        $sql_casas = "SELECT * FROM casas";
        $result_casas = $conn->query($sql_casas);

        if ($result_casas->num_rows > 0) {
            while ($row = $result_casas->fetch_assoc()) {
                $id_casa = $row['id_casa'];

                // Puedes ajustar esto según tu estructura de imágenes
                $fotos = [
                    'imgTultepec/imgCasa1/img1.jpeg',
                    'imgTultepec/imgCasa1/img2.jpeg',
                    'imgTultepec/imgCasa1/img3.jpeg',
                    'imgTultepec/imgCasa1/img4.jpeg',
                    'imgTultepec/imgCasa1/img5.jpeg',
                    // ... más rutas de imágenes ...
                ];
        ?>

                <!-- Sección de una casa -->
                <section class="seccion" id="casa-<?php echo $id_casa; ?>">
                    <div class="casa">
                        <div class="carrusel-casa">
                            <?php
                            // Muestra las fotos de la casa
                            foreach ($fotos as $foto) {
                                echo '<img src="' . $foto . '" alt="Casa ' . $id_casa . '" class="casa-imagen">';
                            }
                            ?>
                        </div>

                        <!-- Características de la casa -->
                        <div class="caracteristicas">
                            <h3>Características:</h3>
                            <ul>
                                <li><strong>Precio de venta:</strong> <?php echo '$' . number_format($row['precio'], 2); ?></li>
                                <li><strong>Categoría:</strong> <?php echo $row['categoria']; ?></li>
                                <li><strong>Ubicación:</strong> <?php echo $row['ubicacion']; ?></li>
                                <!-- ... (resto de las características) ... -->
                            </ul>
                        </div>

                        <!-- Mapa de la casa -->
                        <div class="map-container">
                            <?php
                            // Muestra el mapa de la casa (puedes ajustar esto según tu implementación)
                            echo '<div class="small-map">' . $row['mapa'] . '</div>';
                            ?>
                        </div>

                        <!-- Botones de administrador (mostrar solo si el usuario ha iniciado sesión como agente) -->
                        <?php
                        if (isset($_SESSION['correo']) && $_SESSION['correo'] == 'correo_del_agente@dominio.com') {
                        ?>
                            <div class="admin-buttons" id="admin-buttons-<?php echo $id_casa; ?>">
                                <button onclick="editarCasa(<?php echo $id_casa; ?>)">Editar</button>
                                <button onclick="eliminarCasa(<?php echo $id_casa; ?>)">Eliminar</button>
                                <button onclick="agregarFotosCasa(<?php echo $id_casa; ?>)">Agregar Fotos</button>
                                <button onclick="agregarMapaCasa(<?php echo $id_casa; ?>)">Agregar Mapa</button>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </section>

        <?php
            }
        } else {
            echo "No hay casas disponibles.";
        }
        ?>

    </div>

    <script>
    // Esta función muestra la sección correspondiente al municipio seleccionado
    function mostrarSeccion(municipio) {
        // Lógica para mostrar la sección correspondiente
        console.log(`Mostrar sección de ${municipio}`);
    }

    // Esta función permite editar una casa
    function editarCasa(idCasa) {
        // Lógica para editar la casa con el ID proporcionado
        console.log(`Editar casa con ID ${idCasa}`);
    }

    // Esta función permite eliminar una casa
    function eliminarCasa(idCasa) {
        // Lógica para eliminar la casa con el ID proporcionado
        console.log(`Eliminar casa con ID ${idCasa}`);
    }

    // Esta función permite agregar fotos a una casa
    function agregarFotosCasa(idCasa) {
        // Lógica para agregar fotos a la casa con el ID proporcionado
        console.log(`Agregar fotos a casa con ID ${idCasa}`);
    }

    // Esta función permite agregar un mapa a una casa
    function agregarMapaCasa(idCasa) {
        // Lógica para agregar un mapa a la casa con el ID proporcionado
        console.log(`Agregar mapa a casa con ID ${idCasa}`);
    }
</script>
    <!-- Agrega aquí tus enlaces a scripts de JavaScript, jQuery, etc. -->

</body>

</html>