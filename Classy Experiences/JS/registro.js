document.getElementById('tipo_usuario').addEventListener('change', function() {
    // Oculta todos los campos extra primero
    document.getElementById('conductor_fields').style.display = 'none';
    document.getElementById('guia_fields').style.display = 'none';
    document.getElementById('admin_fields').style.display = 'none';

    // Muestra solo los campos correspondientes
    if (this.value === 'conductor') {
        document.getElementById('conductor_fields').style.display = 'block';
    } else if (this.value === 'guia_turistico') {
        document.getElementById('guia_fields').style.display = 'block';
    } else if (this.value === 'admin') {
        document.getElementById('admin_fields').style.display = 'block';
    }
});