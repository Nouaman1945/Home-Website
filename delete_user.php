<?php
session_start();
require_once('connect.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userId'])) {
        $userId = $_POST['userId'];

        // Perform the delete operation here (e.g., using mysqli)
        $deleteQuery = "DELETE FROM `user` WHERE idUser = $userId";
        $result = mysqli_query($con, $deleteQuery);

        if ($result) {
            echo 'User deleted successfully';
            header("Location: admin-user.php"); // Redirect to your page
            exit();
        } else {
            echo 'Error deleting user: ' . mysqli_error($con);
        }
    } else {
        echo 'Invalid request';
    }
} else {
    echo 'Invalid request method';
}
?>
