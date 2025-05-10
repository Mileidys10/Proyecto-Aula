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
            itemDiv.innerHTML = `
                <p><strong>${item.nombre}</strong> - $${item.precio.toFixed(2)}
                <button onclick="eliminar(${index})">Eliminar</button></p>
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
            localStorage.removeItem('carrito');
            renderCarrito();
        });
    },
    onCancel: function(data) {
        alert('El pago fue cancelado');
    }
}).render('#paypal-button-container');
});
</script>