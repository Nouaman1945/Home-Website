<?php
session_start();
$iduser = $_SESSION['idUser'];


require_once('connect.php');
if (!isset($_SESSION['idUser'])) {
    echo "<script>alert('You are not login in')</script>";
    header("Location: login.php");
}

// Vérifiez si le formulaire de mise à jour est soumis
if (isset($_POST['update'])) {
    // Récupérez les données du formulaire
    $productId = $_POST['productId'];
    $newProductName = $_POST['newProductName'];
    $newQuantity = $_POST['newQuantity'];
    $newPrice = $_POST['newPrice'];

    // Mettez à jour les informations du produit dans la base de données
    $updateQuery = "UPDATE produit SET Nomprod='$newProductName', qte='$newQuantity', prix='$newPrice' WHERE idP='$productId'";
    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        // Redirigez vers la page des produits avec un message de succès
        echo "<script>alert('Product updated successfully')</script>";
        
        exit();
    } else {
        echo "<script>alert('Error updating product')</script>";
    }
}

// Récupérez l'ID du produit à mettre à jour depuis l'URL
if (isset($_GET['edit'])) {
    $productId = $_GET['edit'];

    // Récupérez les informations actuelles du produit depuis la base de données
    $selectQuery = "SELECT * FROM produit WHERE idP='$productId'";
    $selectResult = mysqli_query($con, $selectQuery);

    if ($selectResult && mysqli_num_rows($selectResult) > 0) {
        $productData = mysqli_fetch_assoc($selectResult);
        $currentProductName = $productData['Nomprod'];
        $currentQuantity = $productData['qte'];
        $currentPrice = $productData['prix'];
    } else {
        // Redirigez si le produit n'est pas trouvé
        header('Location: products.php');
        exit();
    }
} else {
    // Redirigez si l'ID du produit n'est pas fourni dans l'URL
    header('Location: products.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Mettez ici vos balises meta, title, liens CSS, etc. -->
    <title>Modifier le produit</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        form {
            max-width: 400px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #495057;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <h1>Modifier le produit</h1>

    <!-- Formulaire de mise à jour du produit -->
    <form action="" method="post">
        <input type="hidden" name="productId" value="<?php echo $productId; ?>">

        <label for="newProductName">Nouveau nom du produit:</label>
        <input type="text" name="newProductName" value="<?php echo $currentProductName; ?>" required>

        <label for="newQuantity">Nouvelle quantité:</label>
        <input type="text" name="newQuantity" value="<?php echo $currentQuantity; ?>" required>

        <label for="newPrice">Nouveau prix:</label>
        <input type="text" name="newPrice" value="<?php echo $currentPrice; ?>" required>

        <button type="submit" name="update">Mettre à jour</button>
    </form>

</body>

</html>
