<?php

    session_start();
    if (!isset($_SESSION ['Admin_ID'])) {
        header('Location: index.php');
        exit();
    }
    $Page_Name = "Professeurs";
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
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'phpqrcode/temp'.DIRECTORY_SEPARATOR;
    $PNG_WEB_DIR = 'phpqrcode/temp/';
    //$filename = $PNG_TEMP_DIR.'test.png';
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 2;

?>
    <!-- Begin Tables Module -->
    <h2 class="text-center mt-2 font-weight-bold">Notre Professeurs</h2>
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
        <a href="professeurajout.php"><button type="button" class="btn btn-success float-right mb-2"><i class="fa fa-plus"
                    aria-hidden="true"></i> Ajouter Un Professeur</button></a>
        <table class="table table-striped table-bordered specialite" style="width: 100%">
            <thead>
                <tr>
                    <th>Professeur QR Code</th>
                    <th>Professeur ID</th>
                    <th>Professeur Nom</th>
                    <th>Professeur Prenom</th>
                    <th>Professeur Email</th>
                    <th>Professeur Avatar</th>
                    <th>Outils</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                        $result = $mysqli->query("SELECT * FROM `prof`");
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                <tr>                    
                    <th><?php
                        $filename = $PNG_TEMP_DIR.''.$row ['Prof_ID'].'.png';
                        //$filename = $PNG_TEMP_DIR.'test.png';
                        QRcode::png('ProfID: '.$row ['Prof_ID'] ."\n". 'Prof Nom Et Pernom: '. $row ['Prof_Nom']. ' ' . $row ['Prof_Prenom']."\n".'Prof Email: '.$row ['Prof_Email'] , $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
                        echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />';
                    ?></th>
                    <th><?php echo $row ['Prof_ID']?></th>
                    <th><?php echo $row ['Prof_Nom']?></th>
                    <th><?php echo $row ['Prof_Prenom']?></th>
                    <th><?php echo $row ['Prof_Email']?></th>
                    <th><img src="<?php echo $row ['Prof_Avatar']?>" class="img-fluid" width="64"></th>
                    <th>
                        <a href="professeuredit.php?Prof_ID=<?php echo $row ['Prof_ID']?>"><button type="button"
                                class="btn btn-warning m-1"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                        <a href="professeursupp.php?Prof_ID=<?php echo $row ['Prof_ID']?>"><button type="button"
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