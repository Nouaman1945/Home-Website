<?php
session_start();
require_once('connect.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifier si la clé 'idUser' existe dans la session
$iduser = isset($_SESSION['idUser']) ? $_SESSION['idUser'] : null;

if ($iduser === null) {
    // L'utilisateur n'est pas connecté, vous pouvez afficher un message ou effectuer une action appropriée ici
}

if (mysqli_connect_error()) {
    echo "Connection Error.";
} else {
    $sql2 = "SELECT * FROM produit";
    $result = mysqli_query($con, $sql2);

    if ($result === false) {
        // Afficher l'erreur MySQL
        echo "Error in SQL query: " . mysqli_error($con);
    } else {
        // Le reste du code
        if (isset($_POST['add_to_cart'])) {
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = 1;

            // Vérifier si l'utilisateur est connecté
            if ($iduser !== null) {
                // Vérifier si le produit est déjà dans le panier de l'utilisateur
                $check_cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE nomP= '$product_name' AND IdUser = '$iduser'");
                
                if ($check_cart_query === false) {
                    // Afficher l'erreur MySQL
                    echo "Error in SQL query: " . mysqli_error($con);
                } else {
                    // Compter le nombre de lignes dans le résultat de la requête
                    $num_rows = mysqli_num_rows($check_cart_query);

                    if ($num_rows > 0) {
                        // Le produit est déjà dans le panier, mettez à jour la quantité
                        $update_quantity = mysqli_query($con, "UPDATE `cart` SET quantite = quantite + 1 WHERE nomP= '$product_name' AND IdUser = '$iduser'");

                        if ($update_quantity === false) {
                            // Afficher l'erreur MySQL
                            echo "Error in SQL query: " . mysqli_error($con);
                        } else {
                            echo "<script>alert('Product quantity updated in cart successfully')</script>";
                        }
                    } else {
                        // Ajouter le produit au panier
                        $insert_product = mysqli_query($con, "INSERT INTO `cart`(nomP, prix, image, quantite, IdUser) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity','$iduser')");

                        if ($insert_product === false) {
                            // Afficher l'erreur MySQL
                            echo "Error in SQL query: " . mysqli_error($con);
                        } else {
                            echo "<script>alert('Product added to cart successfully')</script>";
                        }
                    }
                }
            } else {
                echo "<script>alert('You should be logged in to add items to the cart.')</script>";
            }
        }
    }
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
		<title>Shop</title>
	</head>
<style>
	.product-image {
    height: 250px; /* Définissez la hauteur souhaitée */
}
</style>
<script>
    // Vérifier si l'utilisateur est connecté
    function checkLoginStatus(event) {
        <?php if (!isset($_SESSION['idUser'])) { ?>
            // Si l'utilisateur n'est pas connecté, afficher une alerte
            alert('You should be logged in to add items to the cart.');
            event.preventDefault(); // Prevent form submission if the user is not logged in
        <?php } ?>
    }

    // Attacher la fonction de vérification à l'événement du clic sur le bouton "Add to Cart"
    document.addEventListener('DOMContentLoaded', function () {
        var addToCartButtons = document.getElementsByName('add_to_cart');
        addToCartButtons.forEach(function (button) {
            button.addEventListener('click', checkLoginStatus);
        });
    });
</script>
	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="index.php">Home<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item ">
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li class="active"><a class="nav-link" href="shop.php">Shop</a></li>
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
								<h1>Shop</h1>
							<p class="mb-4">Chaque maison est une histoire particulière</p>
								<p><a href="" class="btn btn-secondary me-2">Shop Now</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="images/couch.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section product-section before-footer-section">
		    <form method="POST"enctype="multipart/form-data" action="" method="post"> 
		<div class="container">
		      	<div class="row">
		<?php
      
      $select_products = mysqli_query($con, "SELECT * FROM `produit`");
      if(mysqli_num_rows($select_products) > 0){
		 $product_count = 0;
         while($fetch_product = mysqli_fetch_assoc($select_products)){
			 $product_count++;
      	?>
		      		<!-- Start Column 1 -->
					
					 <div class="col-12 col-md-4 col-lg-3 mb-5">
            <a class="product-item" href="#">
                <img src="images/<?php echo $fetch_product['imageP']; ?>" class="img-fluid product-thumbnail product-image">
                <h3 class="product-title"><?php echo $fetch_product['Nomprod']; ?></h3>
                <strong class="product-price"><?php echo $fetch_product['prix']; ?> MAD</strong>
                <input type="hidden" name="product_name" value="<?php echo $fetch_product['Nomprod']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['prix']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['imageP']; ?>">
                <button class="icon-cross" name="add_to_cart">
                    <img src="images/cross.svg" class="img-fluid">
                </button>
            </a>
        </div>
					</form>

      <?php
	 if ($product_count % 4 == 0) {
                echo '</div><div class="row">';
              }
	}} ?>
					

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
				</div>

			</div>
		</footer>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
