<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <link rel="stylesheet" href="../Css/carrito.css">
</head>

<body>



    <div id="carrito-container"></div>
    <h3 id="total">Total: $0</h3>
    <div id="paypal-button-container"></div>

    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>
    <script src="../JS/carrito.js"></script>

    <div id="factura" style="display:none; max-width:600px; margin: 40px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1);">
        <h2>Factura de Compra</h2>
        <p id="factura-nombre"></p>
        <p id="factura-fecha"></p>
        <ul id="factura-items"></ul>
        <p id="factura-total" style="font-weight: bold;"></p>
        <button onclick="descargarPDF()" style="margin-top: 20px; background-color: #a65b4b; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer;">Descargar PDF</button>

    </div>

   <script src="../JS/factura.js"></script>
</body>

</html>