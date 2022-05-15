<?php
    session_start();
    if (!isset($_SESSION ['Admin_ID'])) {
        header('Location: index.php');
        exit();
    }
    $Page_Name = "Module";
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

    <!-- Begin Tables Module -->
    <h2 class="text-center mt-2 font-weight-bold">Notre Modules</h2>

    <!-- Alert De Modifié avec succès -->
    <?php if (isset($_GET['ModifieAvecSucces']))
    {?>
    <div class="w-50 alert alert-success m-auto" role="alert">
        Modifié avec succès
    </div>
    <?php
    }
    ?>

    <!-- Alert De Ajouté avec succès -->
    <?php if (isset($_GET['AjouteAvecSucces']))
    {?>
    <div class="w-50 alert alert-success m-auto" role="alert">
    Ajouté avec succès
    </div>
    <?php
    }
    ?>

    <!-- Alert De Supprimé avec succès -->
    <?php if (isset($_GET['SupprimeAvecSucces']))
    {?>
    <div class="w-50 alert alert-danger m-auto" role="alert">
        Supprimé avec succès
    </div>
    <?php
    }
    ?>


    <div class="container my-3">
    <a href="ajoutmodule.php"><button type="button" class="btn btn-success float-right mb-2"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter Une Module</button></a>
        <table class="table table-striped table-bordered module" style="width: 100%">
            <thead>
                <tr>
                    <th>Module ID</th>
                    <th>Module Nom</th>
                    <th>Module Coef</th>
                    <th>Module Credit</th>
                    <th>Module Scpecialié</th>
                    <th>Outils</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $result = $mysqli->query("SELECT * FROM `module`");
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $Spe_ID = $row ['Spe_ID'];
                            $result2 = $mysqli->query("SELECT * FROM `specialite` WHERE `Spe_ID` = '$Spe_ID'");
                            while($row1 = $result2->fetch_assoc()) {
                                $Spe_Nom= $row1['Spe_Nom'];
                            }

                            ?>
                            <tr>
                                <th><?php echo $row ['Mod_ID']?></th>
                                <th><?php echo $row ['Mod_Nom']?></th>
                                <th><?php echo $row ['Mod_Coef']?></th>
                                <th><?php echo $row ['Mod_Credit']?></th>
                                <th><?php echo $Spe_Nom?></th>
                                <th>
                                    <a href="moduleetudiants.php?Mod_ID=<?php echo $row ['Mod_ID']?>&Spe_ID=<?php echo $row ['Spe_ID']?>"><button type="button" class="btn btn-success"><i class="fa fa-user" aria-hidden="true"></i></button></a>
                                    <a href="editmodule.php?Mod_ID=<?php echo $row ['Mod_ID']?>"><button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                                    <a href="suppmodule.php?Mod_ID=<?php echo $row ['Mod_ID']?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                </th>
                            </tr>
                            <?php
                        }
                    }

                ?>
                
            </tbody>


        </table>
    </div>

    <!-- End Tables Module -->

<?php
    include("footer.php");
?>