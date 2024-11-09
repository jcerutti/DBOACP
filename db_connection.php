<?php
// Autor Mayhem / jcerutti
$host = 'localhost'; // dirección de tu servidor
$dbname_acc = 'dbo_acc'; // Base de datos para cuentas
$dbname_char = 'dbo_char'; // Base de datos para personajes
$username = 'root'; // Tu usuario de la base de datos
$password = ''; // Tu contraseña de la base de datos

try {
    $conn_acc = new PDO("mysql:host=$host;dbname=$dbname_acc", $username, $password);
    $conn_acc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn_char = new PDO("mysql:host=$host;dbname=$dbname_char", $username, $password);
    $conn_char->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}
?>
