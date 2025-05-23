document.addEventListener('DOMContentLoaded', () => {
    const userId = typeof USER_ID !== 'undefined' ? USER_ID : 0;
    const carritoKey = `carrito_usuario_${userId}`;
    const botones = document.querySelectorAll('.agregar-carrito');
    const contadorCarrito = document.getElementById('contador-carrito');
    const lista = document.getElementById('lista-carrito');
    const totalSpan = document.getElementById('total');

    function getCarrito() {
        return JSON.parse(localStorage.getItem(carritoKey)) || [];
    }
    function setCarrito(carrito) {
        localStorage.setItem(carritoKey, JSON.stringify(carrito));
    }

    function renderCarrito() {
        if (contadorCarrito) {
            const carrito = getCarrito();
            contadorCarrito.textContent = carrito.length;
        }
    }

    function renderListaCarrito() {
        const carrito = getCarrito();
        let total = 0;
        if (lista) {
            lista.innerHTML = '';
            if (carrito.length === 0) {
                lista.innerHTML = '<li>El carrito está vacío.</li>';
            } else {
                carrito.forEach((item, index) => {
                    const li = document.createElement('li');
                    li.innerHTML = `${item.nombre} - $${item.precio.toFixed(2)} 
                        <button class="eliminar-item" data-index="${index}">Eliminar</button>`;
                    lista.appendChild(li);
                    total += item.precio;
                });
            }
        }
        if (totalSpan) {
            totalSpan.textContent = `Total: $${total.toFixed(2)}`;
        }
        document.querySelectorAll('.eliminar-item').forEach(btn => {
            btn.addEventListener('click', function () {
                const idx = parseInt(this.dataset.index);
                let carrito = getCarrito();
                carrito.splice(idx, 1);
                setCarrito(carrito);
                renderCarrito();
                renderListaCarrito();
            });
        });
    }

    // Inicializar contador y lista de carrito
    renderCarrito();
    renderListaCarrito();

    // Agregar productos al carrito (solo si hay botones en la página)
    if (botones.length > 0) {
        botones.forEach(btn => {
            btn.addEventListener('click', () => {
             
                const nombre = btn.getAttribute('data-nombre');
                const precio = parseFloat(btn.getAttribute('data-precio'));
                const servicio = { nombre, precio };
                let carrito = getCarrito();

                if (carrito.some(item => item.nombre === servicio.nombre)) {
                    alert(`"${nombre}" ya está en el carrito.`);
                } else {
                    carrito.push(servicio);
                    setCarrito(carrito);
                    alert(`"${nombre}" agregado al carrito.`);
                }

                renderCarrito();
                renderListaCarrito();
            });
        });
    }
});