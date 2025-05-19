document.querySelectorAll('.editable').forEach(cell => {
    cell.addEventListener('dblclick', function () {
        const originalValue = this.textContent;
        const input = document.createElement('input');
        input.type = 'text';
        input.value = originalValue;
        input.addEventListener('blur', function () {
            cell.textContent = input.value || originalValue;
            cell.dataset.newValue = input.value;
        });
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                input.blur();
            }
        });
        cell.textContent = '';
        cell.appendChild(input);
        input.focus();
    });
});

document.getElementById('guardarCambios').addEventListener('click', function () {
    const cambios = [];
    document.querySelectorAll('.editable').forEach(cell => {
        if (cell.dataset.newValue !== undefined) {
            cambios.push({
                id: cell.dataset.id,
                field: cell.dataset.field,
                value: cell.dataset.newValue
            });
        }
    });

    if (cambios.length > 0) {
        fetch('../Controller/RutaController.php', {
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

document.getElementById('guardarCambios').addEventListener('click', function () {
    const cambios = [];
    document.querySelectorAll('.editable').forEach(cell => {
        if (cell.dataset.newValue !== undefined) {
            cambios.push({
                id: cell.dataset.id,
                field: cell.dataset.field,
                value: cell.dataset.newValue
            });
        }
    });

    if (cambios.length > 0) {
        fetch('../Controller/UsuarioController.php', {
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