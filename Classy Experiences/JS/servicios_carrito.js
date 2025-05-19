
    document.addEventListener('DOMContentLoaded', () => {
        const botones = document.querySelectorAll('.agregar-carrito');
        const contadorCarrito = document.getElementById('contador-carrito');

        // Cargar la cantidad del carrito al iniciar
        const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        contadorCarrito.textContent = carrito.length;

        botones.forEach(btn => {
            btn.addEventListener('click', () => {
                const nombre = btn.getAttribute('data-nombre');
                const precio = parseFloat(btn.getAttribute('data-precio'));

                const servicio = { nombre, precio };
                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

                const existe = carrito.some(item => item.nombre === servicio.nombre);
                if (existe) {
                    alert(`"${nombre}" ya está en el carrito.`);
                } else {
                    carrito.push(servicio);
                    localStorage.setItem('carrito', JSON.stringify(carrito));
                    alert(`"${nombre}" agregado al carrito.`);
                }

                // Actualizar el contador
                contadorCarrito.textContent = carrito.length;
            });
        });
    });
