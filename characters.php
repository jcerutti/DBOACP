<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['charId'])) {
    $charId = $_GET['charId'];
} else {
    header("Location: dashboard.php");
    exit;
}

require_once 'db_connection.php';

$query = "SELECT * FROM characters WHERE CharID = ?";
$stmt = $conn_char->prepare($query);
$stmt->bindParam(1, $charId, PDO::PARAM_INT);
$stmt->execute();
$character = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$character) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Detalles del Personaje</title>
</head>
<body>
    <h1>Detalles del Personaje</h1>
    
    <div class="character-info">
        <h2><?php echo $character['CharName']; ?></h2>
        <p><strong>Raza:</strong> <?php echo $character['Race']; ?></p>
        <p><strong>Clase:</strong> <?php echo $character['Class']; ?></p>
        <p><strong>Nivel:</strong> <?php echo $character['Level']; ?></p>
        <p><strong>Dinero:</strong> <?php echo $character['Money']; ?></p>
        <p><strong>Género:</strong> <?php echo $character['Gender']; ?></p>
        <p><strong>Estado Adulto:</strong> <?php echo $character['AdultStatus'] ? 'Sí' : 'No'; ?></p>
    </div>
    
    <a href="dashboard.php">Volver al Panel de Usuario</a>
</body>
</html>
