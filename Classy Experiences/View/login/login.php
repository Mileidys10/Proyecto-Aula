


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../../Css/login.css">
</head>
<body>
    
    <div class="form">
        <form action="../../Controller/UsuarioController.php" method="post">
            <h2>Iniciar Sesión</h2>
        
            <div class="form-group">
            <input type="hidden" name="accion" value="login">
            </div>
            <div class="form-group">
                <input type="email" name="email"  class="form-control" required placeholder="Ingresa tu correo" >
            </div>
            <div class="form-group">
                <input type="password" name="password"  class="form-control" required placeholder="Ingresa tu contraseña" >
            </div>
            
            <button class="btn font-weight-bold" name="submit">Iniciar sesión ahora</button>
            <br><br>
            <p>No tienes una cuenta? <a href="../login/registro.php">Registrate ahora</a></p>
        </form>
    </div>
    <script>
    // Solo ejecuta si hay carrito de visitante
    const visitanteKey = 'carrito_usuario_0';
    const userId = <?php echo (int)$_SESSION['id']; ?>;
    const userKey = `carrito_usuario_${userId}`;
    const carritoVisitante = localStorage.getItem(visitanteKey);
    if (carritoVisitante && !localStorage.getItem(userKey)) {
        localStorage.setItem(userKey, carritoVisitante);
        localStorage.removeItem(visitanteKey);
    }
</script>
</body>
</html>
