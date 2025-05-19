        document.addEventListener('DOMContentLoaded', () => {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            const container = document.getElementById('carrito-container');
            const totalElement = document.getElementById('total');

            function renderCarrito() {
                container.innerHTML = '';
                let total = 0;

                carrito.forEach((item, index) => {
                    const itemDiv = document.createElement('div');
                    itemDiv.classList.add('item');
                    itemDiv.innerHTML = `
                        <p><strong>${item.nombre}</strong> - $${item.precio.toFixed(2)}</p>
                        <button onclick="eliminar(${index})">🗑️ Eliminar</button>
                    `;
                    container.appendChild(itemDiv);
                    total += item.precio;
                });

                totalElement.textContent = `Total: $${total.toFixed(2)}`;
            }

            window.eliminar = function(index) {
                carrito.splice(index, 1);
                localStorage.setItem('carrito', JSON.stringify(carrito));
                renderCarrito();
            }

            renderCarrito();

            // PayPal
            paypal.Buttons({
                createOrder: function(data, actions) {
                    let total = carrito.reduce((sum, item) => sum + item.precio, 0);
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: total.toFixed(2)
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Pago completado por ' + details.payer.name.given_name);

                        const nombre = details.payer.name.given_name + ' ' + details.payer.name.surname;
                        const fecha = new Date().toLocaleString();

                        // Preparar datos para mostrar factura
                        const lista = document.getElementById('factura-items');
                        lista.innerHTML = '';
                        let total = 0;

                        carrito.forEach(item => {
                            const li = document.createElement('li');
                            li.textContent = `${item.nombre} - $${item.precio.toFixed(2)}`;
                            lista.appendChild(li);
                            total += item.precio;
                        });

                        document.getElementById('factura-nombre').textContent = `Cliente: ${nombre}`;
                        document.getElementById('factura-fecha').textContent = `Fecha: ${fecha}`;
                        document.getElementById('factura-total').textContent = `Total pagado: $${total.toFixed(2)}`;
                        document.getElementById('factura').style.display = 'block';

                        // Enviar datos al backend para guardar factura
                        fetch('../controller/guardar_factura.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    nombre_cliente: nombre,
                                    items: carrito.map(item => ({
                                        id: item.id, // Asegúrate que cada item en carrito tenga el id del servicio
                                        nombre: item.nombre,
                                        precio: item.precio,
                                        cantidad: item.cantidad || 1
                                    }))
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log('Factura guardada correctamente');
                                } else {
                                    console.error('Error al guardar la factura:', data.error);
                                }
                            })
                            .catch(error => {
                                console.error('Error en la conexión:', error);
                            });

                        // Limpiar carrito
                        localStorage.removeItem('carrito');
                        carrito = [];
                        renderCarrito();
                    });
                },
                onCancel: function(data) {
                    alert('El pago fue cancelado');
                }
            }).render('#paypal-button-container');



        });
