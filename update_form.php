<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>

<?php
require_once('connect.php');

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    // Fetch user data based on the user ID
    $selectQuery = "SELECT * FROM `user` WHERE idUser = $userId";
    $result = mysqli_query($con, $selectQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);

        // Now you can use $userData to populate the update form
        $nom = $userData['Nom'];
        $prenom = $userData['Prenom'];
        $address = $userData['address'];
        $email = $userData['Email'];

        // Display the update form
        ?>
        <h2>Update User Information</h2>

        <form action="update_process.php" method="post">
            <input type="hidden" name="userId" value="<?php echo $userId; ?>">
            
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" required><br>
            
            <label for="prenom">Prenom:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>" required><br>

            <label for="address">Adresse:</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>

            <button type="submit">Update User</button>
        </form>
        <?php
    } else {
        echo 'User not found';
    }
} else {
    echo 'Invalid request';
}
?>

</body>
</html>
