<?php
// fetch_user_data.php

require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Utilisez l'ID de l'utilisateur pour récupérer les données depuis la base de données
    $selectQuery = "SELECT * FROM user WHERE idUser = '$userId'";
    $selectResult = mysqli_query($con, $selectQuery);

    if ($selectResult && mysqli_num_rows($selectResult) > 0) {
        $userData = mysqli_fetch_assoc($selectResult);

        // Convertissez les données en format JSON et renvoyez-les
        echo json_encode($userData);
    } else {
        echo json_encode(['error' => 'Utilisateur non trouvé']);
    }
} else {
    echo json_encode(['error' => 'Requête invalide']);
}
?>
