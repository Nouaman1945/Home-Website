	<?php
    session_start();
  $iduser = $_SESSION['idUser'];

// $Nom = $_SESSION['Nom'];
// $Prenom = $_SESSION['Prenom'];
require_once ('connect.php');
if (!isset($_SESSION['idUser'])) {
  echo"<script>alert('You are not login in')</script>";
  header("Location: page-login.php");
  
}
  if(isset($_POST['clique'])){
    $var = $_POST['chercher'];
    $req = "SELECT * FROM `user` WHERE Nom LIKE '%$var%' Or Prenom LIKE '%$var%'";
    $a = mysqli_query($con,$req);
}else {
  $ReadSql = "SELECT * FROM `user` ";
    $a = mysqli_query($con,$ReadSql);
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
    <link href="assets/img/logo" rel="icon" />
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
              

<span class="d-none d-md-block dropdown-toggle ps-2"><?php $userData = mysqli_fetch_assoc($a); echo $userData['Nom']." ".$userData['Prenom']; ?></span></a>

            <!-- End Profile Iamge Icon -->

            <ul
              class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
            >
              <li class="dropdown-header">
                <h6><?php $userData = mysqli_fetch_assoc($a); echo $userData['Nom']." ".$userData['Prenom']; ?></h6>
                
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
              <a href="products.php">
                <i class="bi bi-circle"></i><span>Liste Produits</span>
              </a>
            </li>
            <li>
              <a href="ajouterProduct.php">
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
              <a href="admin-user.php" class="active">
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
        <!-- End Login Page Nav -->

       
        <!-- End Error 404 Page Nav -->

       
        <!-- End Blank Page Nav -->
      </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Users</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Clients</li>
            <li class="breadcrumb-item active">Liste Des Utilisateurs</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
               

                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                        <th><b>I</b>D</th>
                        <th>Nom </th>
                        <th>Prenom</th>
                        <th>adresse</th>
					    <th>Email</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <?php while ($r = mysqli_fetch_assoc($a)) {
				?>

				<tr class="update-row" data-id="<?= $r['idUser']; ?>">
					<td class="data" scope="row"><?php echo $r['idUser']; ?></td>
					<td class="data"><?php echo $r['Nom']; ?></td>
					<td class="data"><?php echo $r['Prenom']; ?></td>
					<td class="data"><?php echo $r['address']; ?></td>
					<td class="data"><?php echo $r['Email']; ?></td>
                    <td > 
                          <form action="delete_user.php" method="post" style="display: inline;">
    <input type="hidden" name="userId" value="<?php echo $r['idUser']; ?>">
    <button type="button" class="delete" style="margin-right:10px;background:white;border:none;border-radius:5px;color:red;font-size:20px;" data-id="<?= $r['idUser']; ?>" onclick="confirmDelete(this)">
    <i class="fa-solid fa-trash-can"></i>
</button>
<button type="button" data-id="<?= $r['idUser']; ?>" style="margin-right:10px;background:weight;border:none;border-radius:5px;color:blue;font-size:20px;" onclick="openUpdateModal(<?= $r['idUser']; ?>)">
    <i class="fas fa-edit"></i>
</button>

</form> </td> 

    



					
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>

              </div>
			<tbody>
               

            
				<?php while ($r = mysqli_fetch_assoc($a)) {
				?>

				<tr>
					<th scope="row"><?php echo $r['idUser']; ?></th>
					<td><?php echo $r['Nom']; ?></td>
					<td><?php echo $r['Prenom']; ?></td>
					<td><?php echo $r['address']; ?></td>
					<td><?php echo $r['Email']; ?></td>
                    <td style="display:flex;flex-direction:row;width:120px;padding:0px 10px"> 
                          <button type="submit" data-role="update" data-id="<?php echo $r['idUser']; ?>" style="margin-right:10px;background:rgb(95, 95, 95);border:none;border-radius:5px;color:yellow;font-size:20px;"><i class="fa-solid fa-pen-to-square"></i></button>
                          <button type="submit"  id='del_<?= $r['idUser']; ?>' class="delete" style="margin-right:10px;background:white;border:none;border-radius:5px;color:red;font-size:20px;"><i class="fa-solid fa-trash-can"></i></button>
                        </td> 
					<td>
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                </table>

                <!-- Update form initially hidden -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <!-- Title for the modal -->
        <h2>Modifier l'utilisateur</h2>

        <!-- Form fields go here -->
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prenom:</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

         <input type="hidden" id="updateUserId">

        <!-- Buttons for Modifier and Annuler -->
       <div style="display: flex; justify-content: space-between;">
    <button type="button" class="btn btn-success" onclick="submitUpdateForm()">Modifier</button>

    <button type="button" class="btn btn-warning" onclick="closeUpdateModal()">Annuler</button>
</div>

</div>
</div>

<script>
    function openUpdateModal(userId) {
        // Récupérez les données utilisateur avec AJAX et pré-remplissez le formulaire
        $.ajax({
            url: 'fetch_user_data.php',
            method: 'POST',
            data: { userId: userId },
            success: function(response) {
                var userData = JSON.parse(response);

                // Pré-remplissez le formulaire avec les données de l'utilisateur
                $('#updateUserId').val(userData.idUser);
                $('#nom').val(userData.Nom);
                $('#prenom').val(userData.Prenom);
                $('#adresse').val(userData.address);
                $('#email').val(userData.Email);

                // Affichez le formulaire de mise à jour
                $('#updateModal').show();
            },
            error: function(error) {
                console.error('Erreur lors de la récupération des données utilisateur : ' + error.responseText);
            }
        });
    }

    function closeUpdateModal() {
        // Cachez le formulaire de mise à jour
        $("#updateModal").hide();
    }

    // Rest of your existing script...
</script>



<script>
// Function to toggle the visibility of the update form
function toggleUpdateForm(button,userId) {
    var userId = $(button).data('id');
    
    $("#updateModal").toggle();
    openUpdateModal(userId);
}

function submitUpdateForm() {
        // Récupérez les valeurs mises à jour depuis les champs de formulaire
        var userId = $('#updateUserId').val();
        var nom = $('#nom').val();
        var prenom = $('#prenom').val();
        var adresse = $('#adresse').val();
        var email = $('#email').val();

        // Utilisez AJAX pour envoyer une requête POST vers update_user.php
        $.ajax({
            type: 'POST',
            url: 'update_user.php',
            data: {
                id: userId,
                nom: nom,
                prenom: prenom,
                adresse: adresse,
                email: email
            },
            success: function(response) {
                // Affichez la réponse du serveur (peut être une confirmation ou un message d'erreur)
                alert(response);

                // Cachez le formulaire de mise à jour
                closeUpdateModal();
            },
            error: function(error) {
                console.error('Erreur lors de la mise à jour de l\'utilisateur : ' + error.responseText);
            }
        });
    }
</script>

<div id="updateModal" class="modal">
    <div class="modal-content">
        <!-- Titre du formulaire de mise à jour -->
        <h2>Modifier l'utilisateur</h2>

        <!-- Champs du formulaire de mise à jour -->
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prenom:</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <input type="hidden" id="updateUserId">

        <!-- Boutons pour Modifier et Annuler -->
        <div style="display: flex; justify-content: space-between;">
            <button type="button" class="btn btn-success" onclick="submitUpdateForm()">Modifier</button>
            <button type="button" class="btn btn-warning" onclick="closeUpdateModal()">Annuler</button>
        </div>
    </div>
</div>
                <!-- End Table with stripped rows -->
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->

    <!-- End Footer -->

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
