<?php
    if(isset($_GET['Spe_ID'])){
        $Spe_ID = $_GET['Spe_ID'];
        session_start();
        if (!isset($_SESSION ['Admin_ID'])) {
            header('Location: index.php');
            exit();
        }
        else {
            $Page_Name = "Specialité";
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
            $mysqli->query("DELETE FROM `specialite` WHERE `Spe_ID` = $Spe_ID");
            header('Location: specialite.php?SupprimeAvecSucces');
        }

    }
    else {
        header('Location: specialite.php');
    }

?>