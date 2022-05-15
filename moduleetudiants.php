<?php
if ((!isset($_GET["Mod_ID"])) || (!isset($_GET["Spe_ID"]))) {
    header('Location: module.php');
} else {
    session_start();
    if (!isset($_SESSION['Admin_ID'])) {
        header('Location: index.php');
        exit();
    }
    $Page_Name = "Module Suivi";
    include('config.php');
    include('functions.php');
    include("header.php");
    $Admin_ID = $_SESSION['Admin_ID'];
    $result = $mysqli->query("SELECT * FROM `admin` WHERE `Admin_ID` = '$Admin_ID'");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $Admin_Nom = $row['Admin_Nom'];
        }
    }
    include('navbar.php');
    $Mod_ID = $_GET["Mod_ID"];
    $Spe_ID = $_GET["Spe_ID"];
    $lst = $mysqli->query("SELECT * FROM `etudiant` WHERE `Spe_ID` = '$Spe_ID'");
    if ($lst->num_rows > 0) {
        while ($r = $lst->fetch_assoc()) {
            $Etu_ID = $r["Etu_ID"];
            $lstSuivMod = $mysqli->query("SELECT * FROM `suivi_module` WHERE `Etu_ID` = '$Etu_ID' AND `Mod_ID` = '$Mod_ID'");
            if ($lstSuivMod->num_rows == 0) {
                $mysqli->query("INSERT INTO `suivi_module`(`Mod_ID`, `Etu_ID`) VALUES ('$Mod_ID','$Etu_ID')");
            }
        }
    }


    // للحصول على إسم المقياس
    $lstmod = $mysqli->query("SELECT Mod_Nom From module WHERE Mod_ID = '$Mod_ID'");
    if ($lstmod->num_rows > 0) {
        if ($rmod = $lstmod->fetch_assoc()) {
            $Mod_Nom = $rmod["Mod_Nom"];
        }
    }
?>
    <h2 class="text-center mt-2 font-weight-bold">Suivi De Module: <?php echo $Mod_Nom ?></h2>
    <!-- Alert De Modifié avec succès -->
    <?php if (isset($_GET['ModifieAvecSucces'])) { ?>
        <div class="w-50 alert alert-success m-auto" role="alert">
            Modifié avec succès
        </div>
    <?php
    }
    ?>
    <div class="container my-3">
        <table class="table table-striped table-bordered specialite" style="width: 100%">
            <thead>
                <tr>
                    <th>Suivi ID</th>
                    <th>Nom et Prenom</th>
                    <th>Note</th>
                    <th>Les Absences</th>
                    <th>Otuils</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $list = $mysqli->query("SELECT * FROM `suivi_module`,`etudiant` WHERE suivi_module.Mod_ID = '$Mod_ID' AND suivi_module.Etu_ID = etudiant.Etu_ID");
                if ($list->num_rows > 0) {
                    while ($rr = $list->fetch_assoc()) {
                ?>
                        <tr>
                            <th><?php echo $rr["Suivi_ID"] ?></th>
                            <th><?php echo $rr["Etu_Nom"] . ' ' . $rr["Etu_Prenom"] ?></th>
                            <th><?php
                                if ($rr["Note"] == NULL)
                                    echo "Non marqué";
                                else
                                    echo $rr["Note"];

                                ?></th>
                            <th><?php echo $rr["Nb_Absences"] ?></th>
                            <th>
                                <a href="editsuivi.php?Suivi_ID=<?php echo $rr["Suivi_ID"] ?>&Mod_ID=<?php echo $Mod_ID ?>&Spe_ID=<?php echo $Spe_ID ?>&Mod_Nom=<?php echo $Mod_Nom ?>&NomPrenom=<?php echo $rr["Etu_Nom"] . ' ' . $rr["Etu_Prenom"] ?>"><button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                            </th>
                        </tr>
                <?php
                    }
                }



                ?>
            </tbody>


        </table>
    </div>



<?php
}
include("footer.php");
?>