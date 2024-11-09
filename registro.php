<?php
session_start();

require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: registrar.php?error=" . urlencode($_SESSION['error']));
        exit();
    }

    if (strlen($username) < 4 || strlen($username) > 16) {
        $_SESSION['error'] = "El nombre de usuario debe tener entre 4 y 16 caracteres.";
        header("Location: registrar.php?error=" . urlencode($_SESSION['error']));
        exit();
    }

    if (strlen($password) < 5 || strlen($password) > 24 || !preg_match('/[a-zA-Z]/', $password) || !preg_match('/\d/', $password)) {
        $_SESSION['error'] = "La contraseña debe tener letras y números sin símbolos y tener entre 5 y 24 caracteres.";
        header("Location: registrar.php?error=" . urlencode($_SESSION['error']));
        exit();
    }

    if ($password != $confirm_password) {
        $_SESSION['error'] = "Las contraseñas no coinciden.";
        header("Location: registrar.php?error=" . urlencode($_SESSION['error']));
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Correo electrónico inválido.";
        header("Location: registrar.php?error=" . urlencode($_SESSION['error']));
        exit();
    }

    try {
        $stmt = $conn_acc->prepare("SELECT * FROM accounts WHERE Username = ?");
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['error'] = "El nombre de usuario ya está en uso.";
            header("Location: registrar.php?error=" . urlencode($_SESSION['error']));
            exit();
        }

        $password_hash = md5($password);

        $stmt = $conn_acc->prepare("INSERT INTO accounts (Username, Password_hash, acc_status, email, reg_date, last_ip) 
                                    VALUES (?, ?, 'active', ?, NOW(), '127.0.0.1')");
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $password_hash, PDO::PARAM_STR);
        $stmt->bindParam(3, $email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $_SESSION['success'] = "¡Te has registrado correctamente!";
            header("Location: registrar.php?success=" . urlencode($_SESSION['success']));
            exit();
        } else {
            $_SESSION['error'] = "Error al registrar la cuenta.";
            header("Location: registrar.php?error=" . urlencode($_SESSION['error']));
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error de conexión o consulta: " . $e->getMessage();
        header("Location: registrar.php?error=" . urlencode($_SESSION['error']));
        exit();
    }
}
?>
