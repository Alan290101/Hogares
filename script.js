function guardarCasa() {
    $.ajax({
        url: 'procesar_operaciones.php',
        method: 'POST',
        data: {
            accion: 'guardar_casa',
            id_municipio: $('#id_municipio').val(),
            precio: $('#precio').val(),
            categoria: $('#categoria').val(),
            ubicacion: $('#ubicacion').val(),
            distribucion: $('#distribucion').val(),
            equipamiento: $('#equipamiento').val(),
            formas_compra: $('#formas_compra').val(),
            // ... (otros campos del formulario)
        },
        success: function(response) {
            // Analizar la respuesta JSON si es necesario
            var jsonResponse = JSON.parse(response);

            // Lógica para manejar la respuesta exitosa
            console.log(jsonResponse);

            // Puedes mostrar un mensaje al usuario, recargar la página, etc.
        },
        error: function(xhr, status, error) {
            // Lógica para manejar errores
            console.error('Error en la solicitud AJAX:', status, error);

            // Puedes mostrar un mensaje de error al usuario, registrar el error, etc.
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Escuchar el evento de desplazamiento de la página
    window.addEventListener('scroll', function () {
        // Calcular el valor de opacidad basado en el desplazamiento
        let opacidad = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight);

        // Ajustar la opacidad entre 0 y 0.8 según tus preferencias
        opacidad = Math.min(opacidad, 0.8);

        // Aplicar el color de fondo con opacidad al body
        document.body.style.backgroundColor = `rgba(255, 165, 0, ${opacidad})`;
    });
});

// Ejemplo de cómo puedes llamar a la función en respuesta a algún evento, por ejemplo, un clic en un botón
$('#botonGuardarCasa').on('click', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe automáticamente
    guardarCasa();
});

