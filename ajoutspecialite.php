<?php
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $Spe_Nom = $_POST["Spe_Nom"];
        $mysqli->query("INSERT INTO `specialite` (`Spe_Nom`) VALUES ('$Spe_Nom')");
        header('Location: specialite.php?AjouteAvecSucces');
        
    }

?>

    <form class="login" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <h4 class="text-center font-weight-bold">Ajouter Une Specialité: </h4>
        <input class="form-control" type="text" name="Spe_Nom" placeholder="Specialité Nom" autocomplete="off" required>
        <input class="btn btn-primary btn-block" type="submit" value="Ajouter">
    </form>



<?php
    include("footer.php");
?>