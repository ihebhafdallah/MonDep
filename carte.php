<?php
    if (isset($_GET['Etu_ID'])) {
        session_start();
        if (!isset($_SESSION ['Admin_ID'])) {
            header('Location: index.php');
            exit();
        }
        $Page_Name = "Etudiants";
        include('config.php');
        include('functions.php');
        include('phpqrcode/qrlib.php');
        $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'phpqrcode/temp/etud'.DIRECTORY_SEPARATOR;
        $PNG_WEB_DIR = 'phpqrcode/temp/etud/';
        //$filename = $PNG_TEMP_DIR.'test.png';
        $errorCorrectionLevel = 'L';
        $matrixPointSize = 2; 

        header('Content-type: image/jpeg');

        // La carte Vide
        $jpg_image = imagecreatefromfile('assets/img/carte.jpg');
        // Le Couleur
        $white = imagecolorallocate($jpg_image, 38, 53, 112);
        // Le Fonts
        $font_path = realpath("assets/fonts/Changa.ttf");


        // Les informations de l'etudiant
        $Etu_ID = $_GET['Etu_ID'];
        $Etu = $mysqli->query("SELECT * FROM `etudiant` WHERE `Etu_ID` = '$Etu_ID'");
        if ($Etu->num_rows > 0){
            while($row = $Etu->fetch_assoc()) {
                $Etu_Nom = $row['Etu_Nom'];
                $Etu_Prenom = $row['Etu_Prenom'];
                $Etu_Nis = $row['Etu_Nis'];
                $Etu_Avatar_Data = $row['Etu_Avatar'];
                $Etu_Avatar = imagecreatefromfile($Etu_Avatar_Data);
                $Spe_ID = $row['Spe_ID'];
                $Spe_ID = $row ['Spe_ID'];
                $result1 = $mysqli->query("SELECT * FROM `specialite` WHERE `Spe_ID` = '$Spe_ID'");
                if ($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) {
                        $Spe_Nom = $row1 ['Spe_Nom'];
                    }
                }
                $filename = $PNG_TEMP_DIR.''.$row ['Etu_ID'].'.png';
                QRcode::png('Etu_ID: '.$row ['Etu_ID'] ."\n". 'Etudiant Nom Et Pernom: '. $row ['Etu_Nom']. ' ' . $row ['Etu_Prenom']."\n".'Etudiant Date De Naissance: '.$row ['Etu_Nis'] , $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
                $QR_code = imagecreatefromfile($PNG_WEB_DIR.basename($filename));
            }
        }
        /*$Etu_Nom = "Hafdallah";
        $Etu_Prenom = "Iheb";
        $Etu_Nis = "05-08-1998";
        $Etu_Avatar = imagecreatefromfile('uploads/etud/iheb.png');
        $Spe_ID = "RSI";
        $QR_code = imagecreatefromfile('assets/img/1.png');*/

        $data = getimagesize($Etu_Avatar_Data);
        $width = $data[0];
        $height = $data[1];

        // La creation de la carte
        imagettftext($jpg_image, 26, 0, 400, 290, $white, $font_path, $Etu_Nom);
        imagettftext($jpg_image, 26, 0, 465, 333, $white, $font_path, $Etu_Prenom);
        imagettftext($jpg_image, 26, 0, 650, 375, $white, $font_path, $Etu_Nis);
        imagettftext($jpg_image, 26, 0, 500, 420, $white, $font_path, $Spe_Nom);
        imagecopyresized($jpg_image, $Etu_Avatar, 60, 220, 0, 0, 220, 220, $width, $height);
        imagecopy($jpg_image, $QR_code, 950, 500, 0, 0, 82, 82);


        // Send Image to Browser
        imagejpeg($jpg_image);

        // Clear Memory
        imagedestroy($jpg_image);
    }
    else {
        header('Location: etudiants.php');
    }

?>