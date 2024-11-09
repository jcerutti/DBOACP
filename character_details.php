<?php
require_once 'db_connection.php';

if (isset($_GET['charId'])) {
    $charId = $_GET['charId'];

    $query = "SELECT * FROM characters WHERE CharID = ?";
    $stmt = $conn_char->prepare($query);
    $stmt->bindParam(1, $charId, PDO::PARAM_INT);
    $stmt->execute();
    $character = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($character) {
        $race = '';
        $raceImage = '';

        switch ($character['Race']) {
            case 0:
                $race = 'Humano';
                $raceImage = 'images/humano.png';
                break;
            case 1:
                $race = 'Namek';
                $raceImage = 'images/namek.png';
                break;
            case 2:
                $race = 'Majin';
                $raceImage = 'images/majin.png';
                break;
            default:
                $race = 'Desconocida';
                $raceImage = '';
        }

        $gender = $character['Gender'] == 0 ? 'Hombre' : 'Mujer';

        $class = '';
        if ($character['Level'] >= 30) {
            switch ($character['ClassID']) {
                case 7:
                    $class = 'Fighter';
                    break;
                case 8:
                    $class = 'Swordsman';
                    break;
                case 9:
                    $class = 'Crane Hermit';
                    break;
                case 10:
                    $class = 'Turtle Hermit';
                    break;
                case 13:
                    $class = 'Dark Warrior';
                    break;
                case 14:
                    $class = 'Shadow Knight';
                    break;
                case 15:
                    $class = 'Dende Priest';
                    break;
                case 16:
                    $class = 'Poco Priest';
                    break;
                case 17:
                    $class = 'Ultimate Majin';
                    break;
                case 18:
                    $class = 'Grand Chef Majin';
                    break;
                case 19:
                    $class = 'Plasma Majin';
                    break;
                case 20:
                    $class = 'Karma Majin';
                    break;
                default:
                    $class = 'Clase desconocida';
            }
        } else {
            $class = 'Ninguna';
        }

        echo "<h4>Detalles del Personaje</h4>";
        echo "<p><strong>Nombre:</strong> " . htmlspecialchars($character['CharName']) . "</p>";
        echo "<p><strong>Nivel:</strong> " . htmlspecialchars($character['Level']) . "</p>";
        echo "<p><strong>Raza:</strong> " . $race . "</p>";
        echo "<p><strong>Clase:</strong> " . $class . "</p>";
        echo "<p><strong>Género:</strong> " . $gender . "</p>";
        echo "<p><strong>Zeni:</strong> " . htmlspecialchars($character['Money']) . "</p>";

        if ($raceImage != '') {
            echo "<p><img src='" . $raceImage . "' alt='" . $race . "' width='80' height='80'></p>";
        }

    } else {
        echo "<p>No se encontró el personaje.</p>";
    }
} else {
    echo "<p>Parámetro de personaje no válido.</p>";
}
?>
