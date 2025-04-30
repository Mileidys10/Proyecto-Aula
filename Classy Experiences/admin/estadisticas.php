<h2>Estadísticas del sistema</h2>
<ul>
    <li>Total de servicios publicados: <?php
        $conn = new mysqli("localhost:3307", "root", "contraseña", "classy");
        $res = $conn->query("SELECT COUNT(*) AS total FROM servicios");
        $row = $res->fetch_assoc();
        echo $row['total'];
    ?></li>

    <li>Total de imágenes subidas: <?php
        $res2 = $conn->query("SELECT COUNT(*) AS total FROM imagenes_servicio");
        $row2 = $res2->fetch_assoc();
        echo $row2['total'];
    ?></li>
</ul>
