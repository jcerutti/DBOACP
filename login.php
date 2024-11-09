<?php
// Inicia la sesión al principio del archivo
session_start();

// Conexión a la base de datos
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password_hash = md5($password);

    $stmt = $conn_acc->prepare("SELECT username, password_hash, mallpoints, AccountID FROM accounts WHERE username = :username AND password_hash = :password_hash");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password_hash', $password_hash);
    
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['username'] = $user['username'];
        $_SESSION['mallpoints'] = $user['mallpoints'];
        $_SESSION['user_id'] = $user['AccountID'];  // Usa AccountID como identificador único
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
		header("Location: index.php");
    }
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
