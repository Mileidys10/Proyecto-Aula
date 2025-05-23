<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuarioActivo = isset($_SESSION['id']); // Verifica si hay un usuario activo
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contacto - Atención al Cliente</title>
   <link rel="stylesheet" href="../../Css/atencion-cliente.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>


        <style>

            .form-contacto {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.07);
    padding: 40px 32px 32px 32px;
    max-width: 420px;
    width: 100%;
    margin: 40px auto 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.form-contacto h2 {
    color: #222;
    margin-bottom: 28px;
    font-size: 2em;
    letter-spacing: 1px;
}

.form-contacto label {
    font-weight: bold;
    color: #333;
    margin-top: 16px;
    margin-bottom: 6px;
    align-self: flex-start;
}

.form-contacto input[type="text"],
.form-contacto input[type="email"],
.form-contacto textarea {
    width: 100%;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #bbb;
    font-size: 1em;
    background: #f9f9f9;
    color: #222;
    margin-bottom: 14px;
    transition: border 0.2s;
    resize: none;
}

.form-contacto input[type="text"]:focus,
.form-contacto input[type="email"]:focus,
.form-contacto textarea:focus {
    border: 1.5px solid #111;
    outline: none;
}

.form-contacto input[type="submit"] {
    padding: 10px 22px;
    background: #111;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    font-size: 1em;
    cursor: pointer;
    margin-top: 18px;
    transition: background 0.2s;
}

.form-contacto input[type="submit"]:hover {
    background: #ff6347;
}

@media (max-width: 600px) {
    .form-contacto {
        padding: 18px 4vw;
        max-width: 98vw;
    }
    .form-contacto h2 {
        font-size: 1.2em;
    }
}
        </style>
</head>
<body>
    <header>
        <a class="logo" href="../View/index.php">
            <img src="../../img/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>
    
                 <nav>
            <a href="../../View/atencionCliente/contacto.php">Atención al cliente</a>
            <a href="../../View/index.php">Home</a>
            <a href="../../View/servicios.php">Servicios</a>
            <a href="../../View/conocenos.php">Conócenos</a>
            <a href="../../View/redes.php">Redes Sociales</a>
            <a href="../../View/reseñas/resenas.php">Reseñas</a>
                     <?php if (!$usuarioActivo): ?>
    <a href="../../View/login/login.php">Iniciar Sesion</a>
<?php else: ?>
    <a href="../../Controller/LogoutController.php" title="Cerrar sesión">
        <i class="fas fa-sign-out-alt"></i>
    </a>
<?php endif; ?>

<a href="../../View/login/perfil.php" title="Perfil">
    <i class="fas fa-user"></i>
</a>
        </nav>
    </header>

  <center><h2>Formulario de Atención al Cliente</h2></center>

<form action="../atencionCliente/enviar_contacto.php" method="post" class="form-contacto">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="mensaje">Mensaje:</label>
    <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

    <input type="submit" value="Enviar" name="enviar">
</form>

 
</body>
</html>

