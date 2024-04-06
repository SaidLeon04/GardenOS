<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesíón en GardenOS</title>
    <link rel="stylesheet" href="/proyectos/garden_os/dev/login/css/login.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">

</head>
<body>
<center>
    <h1>Bienvenido al sistema operativo del jardín</h1>
</center>
    
<div class="container">
    <div class="side-l">
        <h1>Iniciar Sesión</h1>
        <div>
            <img src="/proyectos/garden_os/dev/assets/img/logo.png" alt="logo" class="logo-registro">
        </div>
        
    </div>
    <div class="side-r">
        <form action="/proyectos/garden_os/login_action" method="POST">
            <label for="nombre" class="text">Nombre o Correo: </label>
            <input type="text" placeholder="Nombre o correo" name="nombre" required minlength="5" maxlength="50">
            <label for="passwd" class="text">Contraseña: </label>
            <input type="password" placeholder="Contraseña" name="passwd" minlength="8" required>
            <input type="submit" value="Entrar" name="Acceder">
            <input type="hidden" name="redirect_to" value="/bienvenida">
            <br><br>
            <a href="http://localhost/proyectos/garden_os/sign_up">¿Eres nuevo?</a><br><br>
            <a href="../passwd/recuperacion.html">¿Olvidaste tu contraseña?</a>
        </form>
    </div>
</div>

</body>
</html>
