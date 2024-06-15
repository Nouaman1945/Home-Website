<?php
session_start();
include 'connect.php';


if(isset($_POST['submit'])){
  $Emaill = $_POST['Email'];
  $_SESSION['Email'] = $_POST['Email'];
  $psswrd = $_POST['psswrd'];
  $sql = "SELECT * FROM user WHERE Email = '$Emaill' AND MDP = '$psswrd' AND statue = 'user'";
  $row = mysqli_query($con,$sql);
  if($row->num_rows > 0 ){
    $rows = mysqli_fetch_assoc($row);
    $_SESSION['idUser'] = $rows['idUser'];
    header("Location: shop.php");
  }else if(isset($_POST['submit'])){
    $Emaill = $_POST['Email'];
    $_SESSION['Email'] = $_POST['Email'];
    $psswrd = $_POST['psswrd'];
      $s = "SELECT * FROM user WHERE Email = '$Emaill' AND MDP = '$psswrd' AND statue = 'admin'";
      
      $row = mysqli_query($con,$s);
      if($row->num_rows >0 ){
        $rows = mysqli_fetch_assoc($row);
       
        $_SESSION['idUser'] = $rows['idUser'];

        header("Location: admin-user.php");
      
  }else {
    echo "<script>alert('Utilisateur ou le mot de passe est fausse')</script>";
  }

  }}
?>