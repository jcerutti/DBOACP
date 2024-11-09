<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once 'db_connection.php';

$userId = $_SESSION['user_id'];

$query1 = "SELECT username, mallpoints FROM accounts WHERE AccountID = ?";
$stmt1 = $conn_acc->prepare($query1);
$stmt1->bindParam(1, $userId, PDO::PARAM_INT);
$stmt1->execute();
$userData = $stmt1->fetch(PDO::FETCH_ASSOC);

$query2 = "SELECT * FROM characters WHERE AccountID = ?";
$stmt2 = $conn_char->prepare($query2);
$stmt2->bindParam(1, $userId, PDO::PARAM_INT);
$stmt2->execute();
$characters = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="style2.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Bienvenido al Panel</h1>
        <div class="account-info">
            <p><strong>Cuenta:</strong> <?php echo htmlspecialchars($userData['username']); ?></p>
            <p><strong>Mallpoints:</strong> <?php echo htmlspecialchars($userData['mallpoints']); ?></p>
            <form action="logout.php" method="POST">
                <button type="submit" class="logout-button">Cerrar sesión</button>
            </form>
        </div>

        <div class="dashboard">
            <div class="character-list">
                <h3>Mis Personajes</h3>
                <ul>
                    <?php foreach ($characters as $character): ?>
                        <li>
                            <a href="javascript:void(0);" class="character-link" data-charid="<?php echo $character['CharID']; ?>">
                                <?php echo htmlspecialchars($character['CharName']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div id="character-details" class="character-details">
            </div>
        </div>
    </div>

    <script>
        $('.character-link').click(function() {
            var charId = $(this).data('charid');
            
            $.ajax({
                url: 'character_details.php',
                type: 'GET',
                data: { charId: charId },
                success: function(response) {
                    $('#character-details').html(response);
                },
                error: function() {
                    alert("Error al cargar los detalles del personaje.");
                }
            });
        });
    </script>
</body>
</html>