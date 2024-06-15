<?php
session_start();

    $iduser = $_SESSION['idUser'];
  
//   $Nom = $_SESSION['Nom'];
//   $Prenom = $_SESSION['Prenom'];
  require_once ('connect.php');
  if (!isset($_SESSION['idUser'])) {
    echo"<script>alert('You are not login in')</script>";
    header("Location: page-login.php");
    
  }
$id = $_SESSION['idUser'];
// $Nom = $_SESSION['Nom'];
// $Prenom = $_SESSION['Prenom'];
error_reporting(0);

$sql = "SELECT * FROM user WHERE idUser = '$id'";
$row = mysqli_query($con,$sql);
$rows = mysqli_fetch_assoc($row);

if(isset($_POST['update_update_btn'])){
  $update_value = $_POST['update_quantity'];
  $update_id = $_POST['update_quantity_id'];
 
  $update_quantity_query = mysqli_query($con, "UPDATE `cart` SET `quantite` = $update_value WHERE `cart`.`idcart` = $update_id ");
  
};

if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($con, "DELETE FROM `cart` WHERE idcart = '$remove_id'");
  header('location:cart.php');
};

if(isset($_GET['delete_all'])){
  mysqli_query($con, "DELETE FROM `cart` WHERE IdUser = '$iduser'");
  header('location:cart.php');
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="logo.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<title>Cart </title>
    <style>
      /* Style du champ de quantité */
input[name="update_quantity"] {
    width: 60px; /* Ajustez la largeur selon vos besoins */
    padding: 5px;
}

/* Style du bouton "Update" */
input[name="update_update_btn"] {
    background-color: #28a745; /* Couleur de fond du bouton */
    color: black; /* Couleur du texte du bouton */
    padding: 8px 15px; /* Espacement du texte à l'intérieur du bouton */
    border: none; /* Supprime la bordure */
    cursor: pointer;
}

/* Style du bouton "Continue Shopping" */
.btn-outline-black.btn-sm.btn-block a {
    color: black; /* Couleur du texte du lien dans le bouton */
    text-decoration: none; /* Supprime le soulignement du lien */
}


.delete-btn {
    color: #dc3545; /* Couleur du texte du lien "Delete All" */
    text-decoration: none; /* Supprime le soulignement du lien */
    font-weight: bold; /* Met en gras le texte du lien */
    cursor: pointer;
}

/* Style du texte "Total" */
.table-bottom td:last-child {
    font-weight: bolder; /* Met en gras le texte "Total" */
    color: orange;
}

      </style>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="index.html">Home<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item ">
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li><a class="nav-link" href="shop.php">Shop</a></li>
						<li><a class="nav-link" href="about.php">About us</a></li>
						
						<li><a class="nav-link" href="blog.php">Blog</a></li>
						<li><a class="nav-link" href="contact.php">Contact us</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
						 <?php if(isset($_SESSION['idUser'])){
                echo"<a href='logout.php' class='user'><i class='fa fa-sign-out' style='font-size: 22px;transform: translate(76px, 13px);color: white;'></i></a>";
                echo"<li><a class='nav-link' href='cart.php'><img src='images/cart.svg'></a></li>";
				 echo"<a href='profile2.php' class='user'><i class='fa fa-user' style='font-size: 22px;transform: translate(60px, 13px);color: white;'></i></a>";
                
            }
            
            else { 
                echo"<a href='page-login.php' class='user' style='color: white;'><i class='ri-user-fill'></i></i>Sign In</a>" ;
           
        }
             ?>
						
					</ul>
				</div>
			</div>
				
		</nav>
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Cart</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section before-footer-section">
            <div class="container">
              <div class="row mb-5">
                <form class="col-md-12" method="post">
                  <div class="site-blocks-table">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-total">Total</th>
                          <th class="product-remove">Remove</th>
                        </tr>
                      </thead>
                      <tbody>

         <?php 
         
         $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE IdUser = '$iduser'");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['nomP']; ?></td>
            <td><?php echo $fetch_cart['prix']; ?> DH</td>
            <td>
               <form action="" method="POST">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['idcart']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantite']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
                  
                  
               </form>   
            </td>
            <td><?php echo $sub_total = $fetch_cart['prix'] * $fetch_cart['quantite']; ?>DH</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['idcart']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash" style="color:red"></i> </a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><button class="btn btn-outline-black btn-sm btn-block"><a href="shop.php" >continue shopping</a></button></td>
            <td colspan="3" style="font-weight:bolder">grand total</td>
            <td><?php echo $grand_total; ?> DH</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
            <!-- <a href="facturation.php" class="confirm" style="margin-top: 0;">Confirmer la commande</a> -->
          </tr>
         
      </tbody>

   </table>
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>
        
              <div class="row">
                <div class="col-md-6">
                  
                </div>
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase">Cart Total</h3>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black"><?php echo $grand_total; ?> MAD</strong>
                        </div>
                      </div>
        
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		

		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="images/sofa.png" alt="Image" class="img-fluid">
				</div>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

							<form action="#" class="row g-3">
								<div class="col-auto">
									<input type="text" class="form-control" placeholder="Enter your name">
								</div>
								<div class="col-auto">
									<input type="email" class="form-control" placeholder="Enter your email">
								</div>
								<div class="col-auto">
									<button class="btn btn-primary">
										<span class="fa fa-paper-plane"></span>
									</button>
								</div>
							</form>

						</div>
					</div>
				</div>

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Home<span>.</span></a></div>
						<p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">About us</a></li>
									<li><a href="#">Services</a></li>
									<li><a href="#">Blog</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Our team</a></li>
									<li><a href="#">Leadership</a></li>
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Nordic Chair</a></li>
									<li><a href="#">Kruzo Aero</a></li>
									<li><a href="#">Ergonomic Chair</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				

			</div>
		</footer>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
