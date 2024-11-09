<?php
if (isset($_GET['error'])) {
    $popupMessage = htmlspecialchars($_GET['error']);
    $popupType = 'error';
}
if (isset($_GET['success'])) {
    $popupMessage = htmlspecialchars($_GET['success']);
    $popupType = 'success';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cuenta - Dragon Ball Online</title>
    <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>

    function showPopup(message, type) {
        var popup = document.getElementById("popup");
        var popupMessage = document.getElementById("popupMessage");
        var popupContainer = document.getElementById("popupContainer");

        popupMessage.innerText = message;

        if (type === "error") {
            popupContainer.style.borderColor = "red";
            popupContainer.style.backgroundColor = "#f8d7da";
        } else if (type === "success") {
            popupContainer.style.borderColor = "green";
            popupContainer.style.backgroundColor = "#d4edda";
        }

        popup.style.display = "block";
    }

    function closePopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "none"; 
    }

    window.onload = function() {
        <?php if (isset($popupMessage)): ?>
            showPopup("<?php echo $popupMessage; ?>", "<?php echo $popupType; ?>");
        <?php endif; ?>
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
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <button type="button" id="toggle-password" class="toggle-btn">👁️</button>
            </div>

            <div id="password-strength-status"></div>
            <br>

            <label for="confirm_password">Confirmar Contraseña:</label>
            <div class="password-container">
                <input type="password" id="confirm_password" name="confirm_password" required>
                <button type="button" id="toggle-confirm-password" class="toggle-btn">👁️</button>
            </div>

            <script src="password-strength.js"></script>

            <button type="submit">Registrar</button>
			<br>
			<br>
			<button type="button" onclick="window.location.href='index.php';">Volver al Inicio</button>
        </form>
    </div>

<div id="popup" class="popup">
    <div id="popupContainer" class="popup-container">
        <span onclick="closePopup()" class="close-btn"><i class="fas fa-times"></i></span>
        <p id="popupMessage"></p>
    </div>
</div>
</body>
</html>
