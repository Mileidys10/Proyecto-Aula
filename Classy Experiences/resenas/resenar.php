<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Classy Experiences - Reseñar</title>
</head>

<body>

    <header>
        <a class="logo" href="../index.php">
            <img src="../img/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>

        <nav>
            <a href="../index.php">Home</a>
            <a href="../servicios/servicios.html">Servicios</a>
            <a href="../conocenos/conocenos.html">Conócenos</a>
            <a href="../redes\redes.html">Redes Sociales</a>
            <a href="../resenas/resenas.php">Reseñas</a>
        </nav>
    </header>

    <form method="post">
        <h1>Classy Experiences</h1>
        <h2>En este espacio podrás crear reseñas sobre nuestros servicios.</h2>

        <input type="text" name="nombre" placeholder="Tu nombre">

        
        <input type="text" name="comentario" placeholder="Comentario">
        



        
        <div class="rating">
            <h3>Puntuanos</h3>
<input type="radio" name="puntuacion" value="5" id="sel-rating-5" checked><label for="sel-rating-5">5</label>
<input type="radio" name="puntuacion" value="4" id="sel-rating-4"><label for="sel-rating-4">4</label>
<input type="radio" name="puntuacion" value="3" id="sel-rating-3"><label for="sel-rating-3">3</label>
<input type="radio" name="puntuacion" value="2" id="sel-rating-2"><label for="sel-rating-2">2</label>
<input type="radio" name="puntuacion" value="1" id="sel-rating-1"><label for="sel-rating-1">1</label>
</div>

        <input type="submit" name="resenar">
    </form>


    <script>
function disableButton() {
    document.getElementById("submitButton").disabled = true;
    document.getElementById("submitButton").value = "Enviando..."; 
}
</script>



    <?php


    include("registrarresena.php");

    ?>



</body>

</html>