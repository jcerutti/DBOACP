<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbo_acc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        header("Location: index.php?error=Todos%20los%20campos%20son%20obligatorios.");
        exit();
    }
    if (strlen($username) < 4 || strlen($username) > 16) {
        header("Location: index.php?error=El%20nombre%20de%20usuario%20debe%20tener%20entre%204%20y%2016%20caracteres.");
        exit();
    }
    if (strlen($password) < 5 || strlen($password) > 24 || !preg_match('/[a-zA-Z]/', $password) || !preg_match('/\d/', $password)) {
        header("Location: index.php?error=La%20contraseña%20debe%20tener%20letras%20y%20números%20sin%20símbolos%20y%20tener%20entre%205%20y%2024%20caracteres.");
        exit();
    }
    if ($password != $confirm_password) {
        header("Location: index.php?error=Las%20contraseñas%20no%20coinciden.");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=Correo%20electrónico%20inválido.");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM accounts WHERE Username = ?");
    $stmt->bind_param("s", $username);  // "s" para string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: index.php?error=El%20nombre%20de%20usuario%20ya%20está%20en%20uso.");
        exit();
    }

    $password_hash = md5($password);

    $stmt = $conn->prepare("INSERT INTO accounts (Username, Password_hash, acc_status, email, reg_date, last_ip) 
                            VALUES (?, ?, 'active', ?, NOW(), '127.0.0.1')");
    $stmt->bind_param("sss", $username, $password_hash, $email);

    if ($stmt->execute()) {
        echo "Cuenta registrada exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
