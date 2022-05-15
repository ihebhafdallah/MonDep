<?php
    if(isset($_GET['Spe_ID'])){
        $Spe_ID = $_GET['Spe_ID'];
        session_start();
        if (!isset($_SESSION ['Admin_ID'])) {
            header('Location: index.php');
            exit();
        }
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
        include('navbar.php');
        $result = $mysqli->query("SELECT * FROM `specialite` WHERE `Spe_ID` = '$Spe_ID'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $Spe_ID = $row['Spe_ID'];
                $Spe_Nom = $row['Spe_Nom'];
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Spe_Nom = $_POST["Spe_Nom"];
            $mysqli->query("UPDATE `specialite` SET `Spe_Nom`='$Spe_Nom ' WHERE `Spe_ID` = $Spe_ID");
            header('Location: specialite.php?ModifieAvecSucces');
            
        }

    ?>
    <form class="login" action="" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <h4 class="text-center font-weight-bold">Modification De: <?php echo $Spe_Nom; ?></h4>
        <input class="form-control" type="text" name="Spe_ID" placeholder="Specialité ID" value="<?php echo $Spe_ID; ?>" autocomplete="off" required readonly>
        <input class="form-control" type="text" name="Spe_Nom" placeholder="Specialité Nom" value="<?php echo $Spe_Nom; ?>" autocomplete="off" required>
        <input class="btn btn-primary btn-block" type="submit" value="Modifier">
    </form>
    <?php
    }
    else {
        header('Location: specialite.php');
    }
    include("footer.php");
?>