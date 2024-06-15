<?php

require_once('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $userId = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];

    // Ajoutez ces lignes pour afficher les données reçues dans la réponse HTTP
    

    $sql = "UPDATE user SET Nom='$nom', Prenom='$prenom', address='$adresse', Email='$email' WHERE idUser= '$userId' ";
    

    if ($con->query($sql) === TRUE) {
        // La mise à jour a réussi
        echo "Utilisateur mis à jour avec succès";
        
    } else {
        // La mise à jour a échoué
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $con->error;
        echo "Requête SQL : $sql";
    }

    // Fermez la connexion à la base de données
    $con->close();
} else {
    // Si la requête n'est pas de type POST, renvoyez une erreur
    echo "Erreur : Méthode non autorisée";
}
?>
