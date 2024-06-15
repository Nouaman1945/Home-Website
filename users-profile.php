	<?php
session_start();


$id=$_SESSION['idUser'];
$Gmail = $_SESSION['Email'];
// $nom = $_SESSION['Nom'];
// $prenom = $_SESSION['Prenom'];

include 'connect.php';
if (!isset($_SESSION['idUser'])) {
    header("Location: page-login.php");
}
    $sql = "SELECT * FROM user WHERE idUser = '$id'";
$row = mysqli_query($con,$sql);
$rows = mysqli_fetch_assoc($row);

if(isset($_POST['submit1'])){
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $Adress = $_POST['Adresse']; 
    $Gmail = $_POST['Email'];  
    $MDP=$_POST['MDP'];
    // $req = "SELECT * FROM vehicule WHERE Matricule_v = '$matricule'";
    // $a = mysqli_query($cn,$req);
    // if( !mysqli_num_rows($a) > 0 ){
        $sqli = "UPDATE user SET Prenom = '$prenom',Nom = '$nom',address='$Adress',Email='$Gmail',MDP='$MDP' WHERE idUser = '$id'";
       if( mysqli_query($con,$sqli)){
        echo "<script>alert('Updated !')</script>";
		header("Location: user-profile.php");
		echo "<script>alert('Updated !')</script>";
    }else {
       echo "<script>alert('Nop')</script>";
     }
	}
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

  </head>

  <body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="assets/img/logo.png" alt="" />
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
             
            <!-- End Profile Iamge Icon -->

            <ul
              class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
            >
              <li class="dropdown-header">
    <?php echo $rows['Nom']." ".$rows['Prenom']; ?>
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
            class="nav-link collapsed"
            data-bs-target="#tables-nav"
            data-bs-toggle="collapse"
            href="#"
          >
            <i class="bi bi-layout-text-window-reverse"></i><span>Clients</span
            ><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul
            id="tables-nav"
            class="nav-content collapse "
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
          <a class="nav-link " href="users-profile.php">
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
        <h1>Profile</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
            
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
  <form class="f" action="" method="POST" onsubmit="return myFunction();">
          <div class="container">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
    <div class="account-settings">
        <div class="user-profile d-flex align-items-center">
            <div class="user-avatar" style="max-width: 50px; margin-right: 10px;">
                <img src="assets/img/profile-img.png" alt="Admin" style="width: 571%;height: auto;transform: translate(22px, 20px);
">
            </div>
            <div>
                <h5 class="user-name" style="margin: 0;transform: translate(17px, 142px);"><?php echo $rows['Nom']." ".$rows['Prenom']; ?></h5>
                <h6 class="user-email" style="margin: 0;transform: translate(-15px, 146px);"><?php echo $rows['Email'] ?></h6>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary" style="transform: translate(10px, 12px);font-weight: bolder;">Personal Details</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" style="transform: translate(0px, 15px)">
				<div class="form-group">
					<label for="fullName">Nom</label>
					<input type="text" class="form-control" name="Nom" id="fullName" value="<?php echo $rows['Nom']; ?>"  placeholder="Nom">
				</div>
			</div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" style="transform: translate(0px, 15px)">
				<div class="form-group">
					<label for="eMail">Prenom</label>
					<input type="text" class="form-control" name="Prenom" id="eMail" value="<?php echo $rows['Prenom']; ?>"  placeholder="Prenom">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" style="transform: translate(0px, 15px)">
				<div class="form-group">
					<label for="eMail">Email</label>
					<input type="email" class="form-control" name="Email" id="eMail" value="<?php echo $rows['Email']; ?>"  placeholder="Email">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" style="transform: translate(0px, 15px)">
				<div class="form-group">
					<label for="phone">Adresse</label>
					<input type="text" class="form-control" name="Adresse" id="phone" value="<?php echo $rows['address']; ?>"  placeholder="Adresse">
				</div>
			</div>
		
        
            </div>
		<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary" style="transform: translate(10px, 27px);font-weight: bolder;">Changer Mot de passe</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" style="transform: translate(0px, 32px)">
				<div class="form-group">
					<label for="Street">Mot De Passe</label>
					<input type="text" class="form-control" name="MDP"   id="password" placeholder="Mot De Passe">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" style="transform: translate(0px, 32px)">
				<div class="form-group">
					<label for="ciTy">Confirmer le Mot De Passe</label>
					<input type="password" class="form-control" id="confirmPassword" name="cmdp" placeholder="Confirmer le Mot De Passe">
				</div>
			</div>
			
		</div>
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="text-right" style="transform: translate(4px, 40px)">
					<button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
					<!-- <button type="button" id="submit" name="submit1" class="btn btn-primary">Update</button> -->
					<a><input type='submit' name="submit1" class="btn btn-primary" value='Update'></a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</form>

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
