<?php


include("con_db.php");

if ($conex) {
    //echo "Todo Correcto";
}
if (isset($_POST["resenar"])) {

    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['comentario']) >= 1 && strlen($_POST['puntuacion']) >= 1) {

//  int numero de vueltas = 10;
        $nombre = trim($_POST["nombre"]);
        $comentario = trim($_POST["comentario"]);
        $puntuacion = trim($_POST["puntuacion"]);
        $fecha = date("d/m/y");
        $resenar = "INSERT INTO resenas_usuarios(nombre, comentario, puntuacion, fecha) VALUES ('$nombre','$comentario','$puntuacion','$fecha')";
        $resultado = mysqli_query($conex, $resenar);
        if ($resultado) {
        
            header("Location: gracias.php");
            exit(); 
        } else {

            ?>
            <h4 class="bad">Ups ha ocurrido un error, comuniquese con el administrador.</h4>
            <?php
        }
    } else {

        ?>
        <h4 class="bad">¡Por favor complete los campos para poder enviar su comentario!</h4>
        <?php
    }


}



?>