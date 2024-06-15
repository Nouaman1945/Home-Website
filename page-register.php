<?php


 $host = "localhost";
 $username="root";
 $password="";
 $database = "ecommerce";
 
 $cn = mysqli_connect($host, $username, $password, $database);
 
if(isset($_POST['submit1'])){
    $Prenom = $_POST['Prenom'];
    $Adresse = $_POST['Adresse'];
    $Email = $_POST['Email1'];
    $passe = $_POST['passe'];
    $passe1 =$_POST['passe1'];
    $Nom = $_POST['username'];
    //--------------------------------------
    
    if (empty($Nom) || empty($Prenom) || empty($username) || empty($Adresse) || empty($passe) || empty($passe1)){
        echo "<script>alert('remplir tout les champs ! ')</script>";
    }
    else{
        if($_POST['passe'] == $_POST['passe']){
        $sqlu = "SELECT * FROM user WHERE Nom = '$Nom'";
        $sql = mysqli_query($cn, $sqlu);
        if( !mysqli_num_rows($sql) > 0 ){
            $sqli = "INSERT INTO user(Nom,Prenom,address,Email,Statue,MDP) VALUES('$Nom','$Prenom','$Adresse','$Email','user','$passe')";
            
            $_SESSION['Nom'] = $Nom ;

            if (mysqli_query($cn, $sqli)) {
                echo "<script>alert('Inscription complete ! Vous pouvez connecter maintenant')</script>";
            }else {
                echo "<script>alert('Erreur !!.')</script>";
            }
        }else{
                echo "<script>alert('Votre Nom déja Existe !!.')</script>";
        }
        }else {
            echo "<script>alert('Votre mot de passe n'est pas correcte.')</script>";
        }
    }}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8 d-flex flex-column align-items-center justify-content-center">

              

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" action="" method="POST" novalidate>
  <div class="col-12">
    <label for="firstName" class="form-label">Prénom</label>
    <input type="text" name="Prenom" class="form-control" id="firstName" required>
    <div class="invalid-feedback">Veuillez entrer votre prénom !</div>
  </div>

  <div class="col-12">
    <label for="lastName" class="form-label">Nom de famille</label>
    <input type="text" name="username" class="form-control" id="lastName" required>
    <div class="invalid-feedback">Veuillez entrer votre nom de famille !</div>
  </div>

  <div class="col-12">
    <label for="userAddress" class="form-label">Adresse</label>
    <input type="text" name="Adresse" class="form-control" id="userAddress" required>
    <div class="invalid-feedback">Veuillez entrer votre adresse !</div>
  </div>

  <div class="col-12">
    <label for="yourEmail" class="form-label">Votre adresse e-mail</label>
    <input type="email" name="Email1" class="form-control" id="yourEmail" required>
    <div class="invalid-feedback">Veuillez entrer une adresse e-mail valide !</div>
  </div>

  <div class="col-12">
    <label for="yourPassword" class="form-label">Mot de passe</label>
    <input type="password" name="passe" class="form-control" id="yourPassword" required>
    <div class="invalid-feedback">Veuillez entrer votre mot de passe !</div>
  </div>

  <div class="col-12">
    <label for="confirmPassword" class="form-label">Confirmer le mot de passe</label>
    <input type="password" name="passe1" class="form-control" id="confirmPassword" required>
    <div class="invalid-feedback">Veuillez confirmer votre mot de passe !</div>
  </div>

  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
      <label class="form-check-label" for="acceptTerms">J'accepte les <a href="#">termes et conditions</a></label>
      <div class="invalid-feedback">Vous devez accepter avant de soumettre.</div>
    </div>
  </div>
  
  <div class="col-12">
    <button class="btn btn-primary w-100" type="submit" name="submit1">Créer un compte</button>
  </div>
  <div class="col-12">
    <p class="small mb-0">Vous avez déjà un compte ? <a href="page-login.php">Connectez-vous</a></p>
  </div>
</form>



                </div>
              </div>

              

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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