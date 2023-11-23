function mostrarSeccion(id) {
    var seccion = document.getElementById(id);
    var secciones = document.querySelectorAll('.imagen-fondo');
    
    for (var i = 0; i < secciones.length; i++) {
      secciones[i].style.display = 'none';
    }
    
    seccion.style.display = 'block';
  }

  function mostrarSeccion(seccion) {
    // Oculta todas las secciones
    document.querySelectorAll('.seccion').forEach(function(seccion) {
        seccion.style.display = 'none';
    });

    // Muestra la sección correspondiente
    document.getElementById(seccion + '-seccion').style.display = 'block';
}
