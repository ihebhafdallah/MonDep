<?php
    session_start();
    if (!isset($_SESSION ['Admin_ID'])) {
        header('Location: index.php');
        exit();
    }
    $Page_Name = "Dashboard";
    include('config.php');
    include('functions.php');
    include("header.php");
    $Admin_ID = $_SESSION ['Admin_ID'];
    $result = $mysqli->query("SELECT * FROM `admin` WHERE `Admin_ID` = '$Admin_ID'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Admin_Nom = $row['Admin_Nom'];
        }
    }
    include('navbar.php');
?>

    
    <!-- Begin Information Section  -->
    <div class="info row container m-auto">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">Les Professeurs: <?php echo Profs_NB (); ?></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="professeurs.php">Voir les détails</a>
                    <div class="small text-white"><i class="fa fa-eye" aria-hidden="true"></i>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">Les Spécialités: <?php echo Specialite_NB (); ?></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="specialite.php">Voir les détails</a>
                    <div class="small text-white"><i class="fa fa-eye" aria-hidden="true"></i>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">Les Modules: <?php echo Module_NB (); ?></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="module.php">Voir les détails</a>
                    <div class="small text-white"><i class="fa fa-eye" aria-hidden="true"></i>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">Les Etudiants: <?php echo Etudiant_NB (); ?></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="etudiants.php">Voir les détails</a>
                    <div class="small text-white"><i class="fa fa-eye" aria-hidden="true"></i>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Information Section  -->



<?php
    include("footer.php");
?>