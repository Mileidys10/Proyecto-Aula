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

    // Simular pago
    const btnSimular = document.getElementById('btn-simular-pago');
    if (btnSimular) {
        btnSimular.addEventListener('click', () => {
            let carrito = getCarrito();
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

            fetch('../controller/guardar_factura.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nombre_cliente: nombre,
                    items: carrito.map(item => ({
                        id: item.id || 0,
                        nombre: item.nombre,
                        precio: item.precio,
                        cantidad: item.cantidad || 1
                    }))
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Factura guardada correctamente (simulada)');
                } else {
                    console.error('Error al guardar la factura:', data.error);
                    alert('Error al guardar la factura.');
                }
            })
            .catch(error => {
                console.error('Error en la conexión:', error);
                alert('Error de conexión al guardar factura.');
            });

            localStorage.removeItem(carritoKey);
            renderCarrito();
            renderListaCarrito();
        });
    }

    // PayPal
    if (window.paypal) {
        paypal.Buttons({
            createOrder: function (data, actions) {
                let carrito = getCarrito();
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
                let carrito = getCarrito();
                return actions.order.capture().then(function (details) {
                    alert('Pago completado por ' + details.payer.name.given_name);

                    const nombre = details.payer.name.given_name + ' ' + details.payer.name.surname;
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

                    fetch('../controller/guardar_factura.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            nombre_cliente: nombre,
                            items: carrito.map(item => ({
                                id: item.id || 0,
                                nombre: item.nombre,
                                precio: item.precio,
                                cantidad: item.cantidad || 1
                            }))
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Factura guardada correctamente');
                        } else {
                            console.error('Error al guardar la factura:', data.error);
                            alert('Error al guardar la factura.');
                        }
                    })
                    .catch(error => {
                        console.error('Error en la conexión:', error);
                        alert('Error de conexión al guardar factura.');
                    });

                    localStorage.removeItem(carritoKey);
                    renderCarrito();
                    renderListaCarrito();
                });
            },
            onCancel: function (data) {
                alert('El pago fue cancelado');
            }
        }).render('#paypal-button-container');
    }

});