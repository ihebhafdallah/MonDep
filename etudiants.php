<?php

    session_start();
    if (!isset($_SESSION ['Admin_ID'])) {
        header('Location: index.php');
        exit();
    }
    $Page_Name = "Etudiants";
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
        
    include('phpqrcode/qrlib.php');
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'phpqrcode/temp/etud'.DIRECTORY_SEPARATOR;
    $PNG_WEB_DIR = 'phpqrcode/temp/etud/';
    //$filename = $PNG_TEMP_DIR.'test.png';
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 2;

?>
    <!-- Begin Tables Module -->
    <h2 class="text-center mt-2 font-weight-bold">Notre Etudiants</h2>
    <!-- Alert De Ajouté avec succès -->
    <?php if (isset($_GET['AjouteAvecSucces']))
    {?>
    <div class="w-50 alert alert-success m-auto" role="alert">
    Ajouté avec succès
    </div>
    <?php
    }
    ?>
    <div class="container my-3">
        <a href="etudiantajout.php"><button type="button" class="btn btn-success float-right mb-2"><i class="fa fa-plus"
                    aria-hidden="true"></i> Ajouter Un Etudiants</button></a>
        <table class="table table-striped table-bordered specialite" style="width: 100%">
            <thead>
                <tr>
                    <th>Etudiant QR Code</th>
                    <th>Etudiant ID</th>
                    <th>Etudiant Nom</th>
                    <th>Etudiant Prenom</th>
                    <th>Etudiant Date De Naissance</th>
                    <th>Etudiant Bac</th>
                    <th>Etudiant Avatar</th>
                    <th>Specialité</th>
                    <th>Outils</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                        $result = $mysqli->query("SELECT * FROM `etudiant`");
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                <tr>                    
                    <th><?php
                        $filename = $PNG_TEMP_DIR.''.$row ['Etu_ID'].'.png';
                        //$filename = $PNG_TEMP_DIR.'test.png';
                        QRcode::png('Etu_ID: '.$row ['Etu_ID'] ."\n". 'Etudiant Nom Et Pernom: '. $row ['Etu_Nom']. ' ' . $row ['Etu_Prenom']."\n".'Etudiant Date De Naissance: '.$row ['Etu_Nis'] , $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
                        echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />';
                    ?></th>
                    <th><?php echo $row ['Etu_ID']?></th>
                    <th><?php echo $row ['Etu_Nom']?></th>
                    <th><?php echo $row ['Etu_Prenom']?></th>
                    <th><?php echo $row ['Etu_Nis']?></th>
                    <th><?php echo $row ['Etu_Bac']?></th>
                    <th><img src="<?php echo $row ['Etu_Avatar']?>" class="img-fluid" width="64"></th>
                    <th><?php $Spe_ID = $row ['Spe_ID'];
                        $Spe_ID = $row ['Spe_ID'];
                        $result1 = $mysqli->query("SELECT * FROM `specialite` WHERE `Spe_ID` = '$Spe_ID'");
                        if ($result1->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) {
                                echo $row1 ['Spe_Nom'];
                            }
                        }
                    ?></th>
                    <th>
                        <a href="carte.php?Etu_ID=<?php echo $row ['Etu_ID']?>" target="_blank"><button type="button"
                                class="btn btn-success m-1"><i class="fa fa-id-card-o" aria-hidden="true"></i></button></a>
                        <a href="#"><button type="button"
                                class="btn btn-warning m-1"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                        <a href="#"><button type="button"
                                class="btn btn-danger m-1"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
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
    
    include('footer.php');

?>