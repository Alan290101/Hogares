<?php
include('conexion.php');

// Mensaje por defecto
$mensaje = '';

// Verifica si es una solicitud POST válida y si se ha establecido la acción
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    switch ($accion) {
        case 'guardar_casa':
            // Lógica para guardar una casa en la base de datos
            $idMunicipio = $_POST['id_municipio'];
            $precio = $_POST['precio'];
            $categoria = $_POST['categoria'];
            $ubicacion = $_POST['ubicacion'];
            $distribucion = $_POST['distribucion'];
            $equipamiento = $_POST['equipamiento'];
            $formas_compra = $_POST['formas_compra'];

            // Procesar fotos
            $fotos = [];

            if (!empty($_FILES['fotos']['name'][0])) {
                $carpeta_destino = 'imgTultepec/';

                
                if (!file_exists($carpeta_destino)) {
                    mkdir($carpeta_destino, 0777, true);
                }

                foreach ($_FILES['fotos']['tmp_name'] as $key => $tmp_name) {
                    $nombre_archivo = $_FILES['fotos']['name'][$key];
                    $ruta_destino = $carpeta_destino . $nombre_archivo;
                    move_uploaded_file($tmp_name, $ruta_destino);
                    $fotos[] = $ruta_destino;
                }
            }

            // Procesar coordenadas
            $coordenadas = $_POST['coordenadas'];

            // Realiza la inserción en la base de datos
            $sql = "INSERT INTO casas (id_municipio, precio, categoria, ubicacion, distribucion, equipamiento, formas_compra, fotos, coordenadas) 
                    VALUES ('$idMunicipio', '$precio', '$categoria', '$ubicacion', '$distribucion', '$equipamiento', '$formas_compra', '" . implode(",", $fotos) . "', '$coordenadas')";
                    
            if ($conn->query($sql)) {
                $mensaje = 'La casa se ha guardado correctamente.';
            } else {
                $mensaje = 'Error al guardar la casa: ' . $conn->error;
            }
            break;

        case 'eliminar_casa':
            // Lógica para eliminar una casa de la base de datos
            $idCasa = $_POST['id_casa'];

            // Realiza la eliminación en la base de datos
            $sql = "DELETE FROM casas WHERE id_casa = $idCasa";
            if ($conn->query($sql)) {
                $mensaje = 'La casa se ha eliminado correctamente.';
            } else {
                $mensaje = 'Error al eliminar la casa: ' . $conn->error;
            }
            break;

        case 'guardar_municipio':
            // Lógica para guardar un municipio en la base de datos
            $nombre = $_POST['nombre'];
            // Recoge otros campos del formulario

            // Realiza la inserción en la base de datos
            $sql = "INSERT INTO municipios (nombre, ...) VALUES ('$nombre', ...)";
            if ($conn->query($sql)) {
                $mensaje = 'El municipio se ha guardado correctamente.';
            } else {
                $mensaje = 'Error al guardar el municipio: ' . $conn->error;
            }
            break;

        case 'eliminar_municipio':
            // Lógica para eliminar un municipio de la base de datos
            $idMunicipio = $_POST['id_municipio'];

            // Realiza la eliminación en la base de datos
            $sql = "DELETE FROM municipios WHERE id_municipio = $idMunicipio";
            if ($conn->query($sql)) {
                $mensaje = 'El municipio se ha eliminado correctamente.';
            } else {
                $mensaje = 'Error al eliminar el municipio: ' . $conn->error;
            }
            break;

        // Puedes agregar más casos según tus necesidades

        default:
            // Acción no reconocida
            $mensaje = 'Acción no reconocida';
            break;
    }

    // Devuelve la respuesta en formato JSON
    echo json_encode(['mensaje' => $mensaje]);
} else {
    // Si no es una solicitud POST válida
    echo json_encode(['mensaje' => 'Solicitud no válida']);
}

// Cierra la conexión a la base de datos
$conn->close();
?>