<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
            color: #333;
        }

        #carrito-container {
            max-width: 600px;
            margin: auto;
        }

        .item {
            background-color: #fff;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item p {
            margin: 0;
            font-size: 16px;
        }

        .item button {
            background-color: #a65b4b;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }

        .item button:hover {
            background-color: #843f33;
        }

        #total {
            max-width: 600px;
            margin: 30px auto 10px;
            font-size: 20px;
            font-weight: bold;
            text-align: right;
        }

        #paypal-button-container {
            max-width: 600px;
            margin: 20px auto;
        }
    </style>
</head>

<body>



    <div id="carrito-container"></div>
    <h3 id="total">Total: $0</h3>
    <div id="paypal-button-container"></div>

    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>
    <script>
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
    </script>

    <div id="factura" style="display:none; max-width:600px; margin: 40px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1);">
        <h2>Factura de Compra</h2>
        <p id="factura-nombre"></p>
        <p id="factura-fecha"></p>
        <ul id="factura-items"></ul>
        <p id="factura-total" style="font-weight: bold;"></p>
        <button onclick="descargarPDF()" style="margin-top: 20px; background-color: #a65b4b; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer;">Descargar PDF</button>

    </div>

    <script>
        function descargarPDF() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            let y = 20;
            doc.setFontSize(16);
            doc.text("Factura de Compra", 20, y);

            y += 10;
            doc.setFontSize(12);
            doc.text(document.getElementById('factura-nombre').textContent, 20, y);
            y += 8;
            doc.text(document.getElementById('factura-fecha').textContent, 20, y);
            y += 10;

            const items = document.querySelectorAll('#factura-items li');
            items.forEach(item => {
                doc.text(item.textContent, 20, y);
                y += 8;
            });

            y += 5;
            doc.text(document.getElementById('factura-total').textContent, 20, y);

            doc.save("factura.pdf");
        }
    </script>
</body>

</html>