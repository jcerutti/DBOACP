<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Bienvenida</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Bienvenido a Dragon Ball Online</h1>
        
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <form id="loginForm" method="POST" action="login.php">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
        
        <p>Si no tienes una cuenta, <a href="registrar.php">regístrate aquí</a>.</p>
        
    </div>
</body>
</html>
