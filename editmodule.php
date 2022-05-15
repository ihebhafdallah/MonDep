<?php
    if(isset($_GET['Mod_ID'])){
        $Mod_ID = $_GET['Mod_ID'];
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
        $result = $mysqli->query("SELECT * FROM `module` WHERE `Mod_ID` = '$Mod_ID'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $Mod_ID = $row['Mod_ID'];
                $Mod_Nom = $row['Mod_Nom'];
                $Mod_Coef = $row['Mod_Coef'];
                $Mod_Credit = $row['Mod_Credit'];
                $Spe_ID = $row['Spe_ID'];
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Mod_Nom = $_POST['Mod_Nom'];
            $Mod_Coef = $_POST['Mod_Coef'];
            $Mod_Credit = $_POST['Mod_Credit'];
            $Spe_ID = $_POST['Spe_ID'];
            $mysqli->query("UPDATE `module` SET `Mod_Nom`='$Mod_Nom',`Mod_Coef`='$Mod_Coef',`Mod_Credit`='$Mod_Credit',`Spe_ID`='$Spe_ID' WHERE `Mod_ID`='$Mod_ID'");
            header('Location: module.php?ModifieAvecSucces');
            
        }

    ?>
    <form class="login" action="" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <h4 class="text-center font-weight-bold">Modification De: <?php echo $Mod_Nom; ?></h4>
        <input class="form-control" type="text" name="Mod_ID" placeholder="Module ID" value="<?php echo $Mod_ID; ?>" autocomplete="off" required readonly>
        <input class="form-control" type="text" name="Mod_Nom" placeholder="Module Nom" value="<?php echo $Mod_Nom; ?>" autocomplete="off" required>
        <input class="form-control" type="number" name="Mod_Coef" placeholder="Module Coef" value="<?php echo $Mod_Coef; ?>" autocomplete="off" required>
        <input class="form-control" type="number" name="Mod_Credit" placeholder="Module Credit" value="<?php echo $Mod_Credit; ?>" autocomplete="off" required>
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
        <input class="btn btn-primary btn-block" type="submit" value="Modifier">
    </form>
    <?php
    }
    else {
        header('Location: module.php');
    }
    include("footer.php");
?>