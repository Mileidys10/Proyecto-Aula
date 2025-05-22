document.addEventListener('DOMContentLoaded', () => {
    // Variable global USER_ID definida en el HTML
    const userId = typeof USER_ID !== 'undefined' ? USER_ID : 0;
    const carritoKey = `carrito_usuario_${userId}`;

    // Elementos del DOM
    const botones = document.querySelectorAll('.agregar-carrito');
    const contadorCarrito = document.getElementById('contador-carrito');
    const lista = document.getElementById('lista-carrito');
    const totalSpan = document.getElementById('total');

    // Obtener carrito del localStorage
    function getCarrito() {
        return JSON.parse(localStorage.getItem(carritoKey)) || [];
    }

    // Guardar carrito en localStorage
    function setCarrito(carrito) {
        localStorage.setItem(carritoKey, JSON.stringify(carrito));
    }

    // Renderizar el contador del carrito (en el menú)
    function renderCarrito() {
        if (contadorCarrito) {
            const carrito = getCarrito();
            contadorCarrito.textContent = carrito.length;
        }
    }

    // Renderizar la lista de productos en carrito.php
    function renderListaCarrito() {
        const carrito = getCarrito();
        let total = 0;
        if (lista) {
            lista.innerHTML = '';
            if (carrito.length === 0) {
                lista.innerHTML = '<li>El carrito está vacío.</li>';
            } else {
                carrito.forEach(item => {
                    const li = document.createElement('li');
                    li.textContent = `${item.nombre} - $${item.precio.toFixed(2)}`;
                    lista.appendChild(li);
                    total += item.precio;
                });
            }
        }
        if (totalSpan) {
            totalSpan.textContent = `Total: $${total.toFixed(2)}`;
        }
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

    // PayPal integration
    if (window.paypal && document.getElementById('paypal-button-container')) {
        paypal.Buttons({
            createOrder: function (data, actions) {
                const carrito = getCarrito();
                let total = carrito.reduce((sum, item) => sum + item.precio, 0);
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: total.toFixed(2)
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    const carrito = getCarrito();
                    alert('Pago completado por ' + details.payer.name.given_name);

                    const nombre = details.payer.name.given_name + ' ' + details.payer.name.surname;
                    const fecha = new Date().toLocaleString();

                    // Mostrar factura en la UI
                    const listaFactura = document.getElementById('factura-items');
                    listaFactura.innerHTML = '';
                    let total = 0;

                    carrito.forEach(item => {
                        const li = document.createElement('li');
                        li.textContent = `${item.nombre} - $${item.precio.toFixed(2)}`;
                        listaFactura.appendChild(li);
                        total += item.precio;
                    });

                    document.getElementById('factura-nombre').textContent = `Cliente: ${nombre}`;
                    document.getElementById('factura-fecha').textContent = `Fecha: ${fecha}`;
                    document.getElementById('factura-total').textContent = `Total pagado: $${total.toFixed(2)}`;
                    document.getElementById('factura').style.display = 'block';

                    // Limpiar carrito y actualizar UI
                    localStorage.removeItem(carritoKey);
                    renderCarrito();
                    renderListaCarrito();
                });
            },
            onCancel: function () {
                alert('El pago fue cancelado');
            }
        }).render('#paypal-button-container');
    }

    // Botón simular pago
    const btnSimularPago = document.getElementById('btn-simular-pago');
    if (btnSimularPago) {
        btnSimularPago.addEventListener('click', () => {
            const carrito = getCarrito();
            if (carrito.length === 0) {
                alert('El carrito está vacío');
                return;
            }

            const nombre = prompt("Nombre del cliente para la factura:", "Cliente Simulado");
            if (!nombre) {
                alert("Nombre requerido");
                return;
            }

            const fecha = new Date().toLocaleString();

            const listaFactura = document.getElementById('factura-items');
            listaFactura.innerHTML = '';
            let total = 0;

            carrito.forEach(item => {
                const li = document.createElement('li');
                li.textContent = `${item.nombre} - $${item.precio.toFixed(2)}`;
                listaFactura.appendChild(li);
                total += item.precio;
            });

            document.getElementById('factura-nombre').textContent = `Cliente: ${nombre}`;
            document.getElementById('factura-fecha').textContent = `Fecha: ${fecha}`;
            document.getElementById('factura-total').textContent = `Total pagado: $${total.toFixed(2)}`;
            document.getElementById('factura').style.display = 'block';

            // Limpiar carrito y actualizar UI
            localStorage.removeItem(carritoKey);
            renderCarrito();
            renderListaCarrito();
        });
    }
});