<?php
$inc = include("con_db.php");
if ($inc) {
    $consulta = "SELECT * FROM resenas_usuarios ORDER BY fecha desc";
    $resultado = mysqli_query($conex, $consulta);
    if ($resultado) {
        while ($row = $resultado->fetch_array()) {
            $nombre = $row['nombre'];
            $comentario = $row['comentario'];
            $puntuacion = $row['puntuacion'];
            $fecha = $row['fecha']; 
            ?>
            <div class="resena">
                <div class="resena-header">
                    <img src="avatar.png" alt="Avatar" class="avatar">
                    <div>
                        <h3><?php echo htmlspecialchars($nombre); ?></h3>
                        <p class="fecha"><?php echo htmlspecialchars($fecha); ?></p>
                    </div>
                    <div class="estrellas">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $puntuacion ? "&#9733;" : "&#9734;";
                        }
                        ?>
                    </div>
                </div>
                <p class="comentario"><?php echo htmlspecialchars("\"" . $comentario . "\""); ?></p>

            </div>
            <?php
        }
    }
}
?>

