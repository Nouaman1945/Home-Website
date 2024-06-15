	<?php

session_start();
  $iduser = $_SESSION['idUser'];

require_once ('connect.php');
if (!isset($_SESSION['idUser'])) {
  echo"<script>alert('You are not login in')</script>";
  header("Location: login.php");
  
}

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $qte=$_POST['qte'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'images/'.$product_image;
   
   if(empty($product_name) || empty($product_price) || empty($product_image)){
      
      echo"<script>alert('please fill out all')</script>";
      
   }else {
      $insert = "INSERT INTO produit(Nomprod,qte, prix, imageP) VALUES('$product_name','$qte', '$product_price','$product_image')";
      $upload = mysqli_query($con,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         echo"<script>alert('new product added successfully')</script>";
      }else{
         echo"<script>alert('could not add the product')</script>";
         
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($con, "DELETE FROM produit WHERE idP = $id");
   header('location:product.php');
};

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>admin</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
   <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   
     
   
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
function redirectToUpdateForm(button) {
    var userId = $(button).data('id');
    
    // Redirect to the update form with the user ID
    window.location.href = 'update_form.php?userId=' + userId;
}
</script>
<style>
    /* Style for the Modifier button */
/* Style for the Modifier button */
/* Style commun pour les boutons */
button.custom-button {
    background-color: #28a745; /* Couleur verte, ajustez selon vos besoins */
    color: #fff; /* Couleur du texte blanc, ajustez selon vos besoins */
    border: none;
    border-radius: 5px;
    padding: 10px 15px; /* Ajustez le rembourrage selon vos besoins */
    cursor: pointer;
}

/* Style spécifique pour le bouton Modifier */
button.modifier {
    width: 100px; /* Largeur spécifique pour le bouton Modifier, ajustez selon vos besoins */
}

/* Style spécifique pour le bouton Annuler */
button.annuler {
    width: 80px; /* Largeur spécifique pour le bouton Annuler, ajustez selon vos besoins */
}



/* Add more styles as needed */

    /* Style for the modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
        padding-top: 60px;
    }

    /* Style for the modal content */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px; /* Set a maximum width for responsiveness */
    }

    /* Adjust styles for responsive layout */
    @media only screen and (max-width: 767px) {
        .modal-content {
            width: 90%;
        }
    }
</style>


  </head>

  <body>
  <script>

function confirmDelete(button) {
    var userId = $(button).data('id');
    
    if (confirm('Are you sure you want to delete this user?')) {
        // User confirmed, proceed with deletion
        $.ajax({
            type: 'POST',
            url: 'delete_user.php',
            data: { userId: userId },
            success: function(response) {
                console.log(response); // Log the response
                alert('User deleted successfully');
                location.reload(); // Reload the page to update the table
            },
            error: function(error) {
                console.error('Error deleting user: ' + error.responseText);
            }
        });
    } else {
        // User canceled, do nothing
    }
}


$(document).ready(function() {
    $('[data-role="update"]').click(function() {
        var userId = $(this).data('id');
        
        // Redirect to the update page or implement a modal for updating user data
        // Example: window.location.href = 'update_user.php?userId=' + userId;
    });
});
</script>


    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="assets/img/logo" alt="" />
          <span class="d-none d-lg-block">Admin</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>
      <!-- End Logo -->

      <div class="search-bar">
        <form
          class="search-form d-flex align-items-center"
          method="POST"
          action="#"
        >
          <input
            type="text"
            name="query"
            placeholder="Search"
            title="Enter search keyword"
          />
          <button type="submit" title="Search">
            <i class="bi bi-search"></i>
          </button>
        </form>
      </div>
      <!-- End Search Bar -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle" href="#">
              <i class="bi bi-search"></i>
            </a>
          </li>
          <!-- End Search Icon-->

          

            <ul
              class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications"
            >
             
              <li>
                <hr class="dropdown-divider" />
              </li>

              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
               
              </li>

              <li>
                <hr class="dropdown-divider" />
              </li>

              

              

              <li>
                <hr class="dropdown-divider" />
              </li>

              <li class="notification-item">
                <i class="bi bi-info-circle text-primary"></i>
                <div>
                  <h4>Dicta reprehenderit</h4>
                  <p>Quae dolorem earum veritatis oditseno</p>
                  <p>4 hrs. ago</p>
                </div>
              </li>

              <li>
                <hr class="dropdown-divider" />
              </li>
              <li class="dropdown-footer">
                <a href="#">Show all notifications</a>
              </li>
            </ul>
            <!-- End Notification Dropdown Items -->
          </li>

          <li class="nav-item dropdown pe-3">
            <a
              class="nav-link nav-profile d-flex align-items-center pe-0"
              href="#"
              data-bs-toggle="dropdown"
            >
              <img
                src="assets/img/profile-img.png"
                alt="Profile"
                class="rounded-circle"
              />
              <?php
    // Fetch the first name and last name using the user ID
    $userQuery = "SELECT Prenom, Nom FROM user WHERE idUser = $iduser";
    $userResult = mysqli_query($con, $userQuery);

    if ($userResult && mysqli_num_rows($userResult) > 0) {
        $userData = mysqli_fetch_assoc($userResult);
        $firstName = $userData['Prenom'];
        $lastName = $userData['Nom'];

        // Display the first name and last name
        
    }
    ?>

<span class="d-none d-md-block dropdown-toggle ps-2"> <?php echo "<h6>$firstName $lastName</h6>";?></span></a>

            <!-- End Profile Iamge Icon -->

            <ul
              class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
            >
              <li class="dropdown-header">
    <?php echo "<h6>$firstName $lastName</h6>"; ?>
</li>
              <li>
                <hr class="dropdown-divider" />
              </li>

              <li>
                <a
                  class="dropdown-item d-flex align-items-center"
                  href="users-profile.php"
                >
                  <i class="bi bi-person"></i>
                  <span>My Profile</span>
                </a>
              </li>
              

              <li>
                <hr class="dropdown-divider" />
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="logout.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>
            </ul>
            <!-- End Profile Dropdown Items -->
          </li>
          <!-- End Profile Nav -->
        </ul>
      </nav>
      <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
          <a class="nav-link collapsed" href="dashbord.php">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <!-- End Dashboard Nav -->

        
        <!-- End Components Nav -->

        <li class="nav-item">
          <a
            class="nav-link collapsed"
            data-bs-target="#forms-nav"
            data-bs-toggle="collapse"
            href="#"
          >
            <i class="bi bi-journal-text"></i><span> Produits</span
            ><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul
            id="forms-nav"
            class="nav-content collapse"
            data-bs-parent="#sidebar-nav"
          >
            <li>
              <a href="products.php" class="active">
                <i class="bi bi-circle"></i><span>Liste Produits</span>
              </a>
            </li>
            <li>
              <a href="ajouterProduct.php" >
                <i class="bi bi-circle"></i><span>Ajouter Produits</span>
              </a>
            </li>
            
          </ul>
        </li>
        <!-- End Forms Nav -->

        <li class="nav-item">
          <a
            class="nav-link"
            data-bs-target="#tables-nav"
            data-bs-toggle="collapse"
            href="#"
          >
            <i class="bi bi-layout-text-window-reverse"></i><span>Clients</span
            ><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul
            id="tables-nav"
            class="nav-content collapse show"
            data-bs-parent="#sidebar-nav"
          >
            
            <li>
              <a href="admin-user.php" >
                <i class="bi bi-circle"></i><span>Liste des utilisateurs</span>
              </a>
            </li>
            <li>
              <a href="commande-user.php">
                <i class="bi bi-circle"></i><span>les commandes</span>
              </a>
            </li>
            <li>
              <a href="commandeEffectué.php">
                <i class="bi bi-circle"></i><span>les commandes Effectué</span>
              </a>
            </li>
          </ul>
        </li>
        

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="users-profile.php">
            <i class="bi bi-person"></i>
            <span>Profile</span>
          </a>
        </li>
        <!-- End Profile Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="shop.php">
            <i class="bi bi-file-earmark"></i>
            <span>Aller au Site</span>
          </a>
        </li>
        
        
        <!-- End Register Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="logout.php">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>LogOut</span>
          </a>
        </li>
      </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Ajouter un nouveau Produit</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Produits</li>
            <li class="breadcrumb-item ">Ajouter Produit</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
 
</main>


    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

     

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
