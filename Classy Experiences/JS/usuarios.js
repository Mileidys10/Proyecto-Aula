document.addEventListener('DOMContentLoaded', () => {
// Hacer las celdas editables al hacer doble clic
        document.querySelectorAll('.editable').forEach(cell => {
            cell.addEventListener('dblclick', function () {
                const originalValue = this.textContent;
                const input = document.createElement('input');
                input.type = this.dataset.field === 'password' ? 'password' : 'text';
                input.value = this.dataset.field === 'password' ? '' : originalValue;
                input.placeholder = this.dataset.field === 'password' ? 'Nueva contraseña' : '';
                input.addEventListener('blur', function () {
    if (cell.dataset.field === 'password') {
        if (input.value.trim() !== '') {
            cell.textContent = '********';
            cell.dataset.newValue = input.value;
        } else {
            cell.textContent = originalValue;
            delete cell.dataset.newValue;
        }
    } else {
        cell.textContent = input.value || originalValue;
        cell.dataset.newValue = input.value;
    }
});
                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') {
                        input.blur();
                    }
                });
                this.textContent = '';
                this.appendChild(input);
                input.focus();
            });
        });

        // Enviar los cambios al servidor al hacer clic en "Guardar Cambios"
document.getElementById('guardarCambios').addEventListener('click', function () {
    const cambios = [];
    document.querySelectorAll('.editable').forEach(cell => {
        // Solo agrega a cambios si existe data-newValue (es decir, si fue editado)
        if (cell.dataset.newValue !== undefined) {
            cambios.push({
                id: cell.dataset.id,
                field: cell.dataset.field,
                value: cell.dataset.newValue
            });
        }
    });

    if (cambios.length > 0) {
        console.log('Cambios a enviar:', cambios);

        fetch('/Controller/UsuarioController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(cambios)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cambios guardados exitosamente.');
                location.reload();
            } else {
                alert('Error al guardar los cambios.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } else {
        alert('No hay cambios para guardar.');
    }
});

});
  


