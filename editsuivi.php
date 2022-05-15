<?php 
    if((!isset($_GET["Suivi_ID"])) || (!isset($_GET["NomPrenom"])) || (!isset($_GET["Mod_Nom"])))
    {
        header('Location: module.php');
    }
    else {
        $Mod_ID = $_GET["Mod_ID"];
        $Spe_ID = $_GET["Spe_ID"];
        $Mod_Nom = $_GET["Mod_Nom"];
        $Suivi_ID = $_GET["Suivi_ID"];
        $NomPrenom = $_GET["NomPrenom"];
        session_start();
        if (!isset($_SESSION ['Admin_ID'])) {
            header('Location: index.php');
            exit();
        }
        $Page_Name = "Suivi Module Mise à jour";
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

        <form class="login" action="" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h4 class="text-center font-weight-bold">Modification De Suivi: <?php echo $NomPrenom; ?> Dans La Module: <?php echo $Mod_Nom; ?></h4>
            <?php
                $lst = $mysqli->query("SELECT * FROM suivi_module WHERE Suivi_ID = '$Suivi_ID'");
                if ($lst->num_rows > 0) {
                    if ($r = $lst->fetch_assoc()) {
                        $Note = $r["Note"];
                        $Nb_Absences = $r["Nb_Absences"];
                    }
                }
            ?>
            <input class="form-control" type="number" name="Note" placeholder="Note" value="<?php echo $Note; ?>" autocomplete="off" required>
            <input class="form-control" type="number" name="Nb_Absences" placeholder="Absences" value="<?php echo $Nb_Absences; ?>" autocomplete="off" required>
            <input class="btn btn-primary btn-block" type="submit" value="Modifier">
        </form>


        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Note = $_POST['Note'];
            $Nb_Absences = $_POST["Nb_Absences"];
            $mysqli->query("UPDATE `suivi_module` SET `Note`='$Note',`Nb_Absences`='$Nb_Absences' WHERE `Suivi_ID`='$Suivi_ID'");
            header('Location: moduleetudiants.php?ModifieAvecSucces&Mod_ID='.$Mod_ID.'&Spe_ID='.$Spe_ID.'');   
        }
        include("footer.php");
    }
?>