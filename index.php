<?php
if (isset($_GET['error'])) {
    echo '<div class="error-msg">' . htmlspecialchars($_GET['error']) . '</div>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cuenta - Dragon Ball Online</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function checkPasswordStrength() {
            var password = document.getElementById("password").value;
            var strengthBar = document.getElementById("passwordStrength");
            var strength = 0;
            var message = "";

            if (password.length >= 5) {
                strength += 1;
            }

            if (/[a-zA-Z]/.test(password) && /\d/.test(password)) {
                strength += 1;
            }

            if (password.length <= 24) {
                strength += 1;
            }

            switch(strength) {
                case 0:
                    strengthBar.style.width = "0%";
                    message = "Contraseña muy débil";
                    strengthBar.style.backgroundColor = "red";
                    break;
                case 1:
                    strengthBar.style.width = "50%";
                    message = "Contraseña débil";
                    strengthBar.style.backgroundColor = "orange";
                    break;
                case 2:
                    strengthBar.style.width = "75%";
                    message = "Contraseña aceptable";
                    strengthBar.style.backgroundColor = "yellow";
                    break;
                case 3:
                    strengthBar.style.width = "100%";
                    message = "Contraseña segura";
                    strengthBar.style.backgroundColor = "green";
                    break;
                default:
                    strengthBar.style.width = "0%";
                    message = "Contraseña no válida";
                    strengthBar.style.backgroundColor = "red";
            }

            document.getElementById("passwordMessage").innerHTML = message;
        }
    </script>
</head>
<body>
    <div class="registro-container">
        <h1>Registro de Cuenta</h1>

        <form action="registro.php" method="post">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <div id="password-strength-status"></div>
            <div id="password-strength-status-text"></div>

            <br>

            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <script src="password-strength.js"></script>

            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
