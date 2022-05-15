<?php
    session_start();
    if (!isset($_SESSION ['Admin_ID'])) {
        header('Location: index.php');
        exit();
    }
    $Page_Name = "Ajouter Module";
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
        $Mod_Nom = $_POST["Mod_Nom"];
        $Mod_Coef = $_POST["Mod_Coef"];
        $Mod_Credit = $_POST["Mod_Credit"];
        $Spe_ID = $_POST["Spe_ID"];

        echo $Mod_Nom .' '. $Mod_Coef .' '. $Mod_Credit . ' ' .$Spe_ID;

        $mysqli->query("INSERT INTO `module`(`Mod_Nom`, `Mod_Coef`, `Mod_Credit`, `Spe_ID`) VALUES ('$Mod_Nom','$Mod_Coef','$Mod_Credit','$Spe_ID')");
        header('Location: module.php?AjouteAvecSucces');
        
    }

?>

    <form class="login" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <h4 class="text-center font-weight-bold">Ajouter Une Module: </h4>
        <input class="form-control" type="text" name="Mod_Nom" placeholder="Module Nom" autocomplete="off" required>
        <input class="form-control" type="number" name="Mod_Coef" placeholder="Module Coefficient" autocomplete="off" required>
        <input class="form-control" type="number" name="Mod_Credit" placeholder="Module Credit" autocomplete="off" required>
        <select class="form-control mb-2" name="Spe_ID">
            <?php
               $lst = $mysqli->query("SELECT * FROM `specialite`");
               if ($lst->num_rows > 0) {
                while($row = $lst->fetch_assoc()) {
            ?>
            <option value="<?php echo $row ['Spe_ID'] ?>"><?php echo $row ['Spe_Nom'] ?></option>
            <?php
                }
            }
            ?>
        </select>
        <input class="btn btn-primary btn-block" type="submit" value="Ajouter">
    </form>



<?php
    include("footer.php");
?>