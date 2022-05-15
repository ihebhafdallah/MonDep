<?php
    session_start();
    if (!isset($_SESSION ['Admin_ID'])) {
        header('Location: index.php');
        exit();
    }
    $Page_Name = "Ajouter Professeur";
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

        $RandName = generateRandomString();

        $Etu_Nom = $_POST["Etu_Nom"];
        $Etu_Prenom = $_POST["Etu_Prenom"];
        $Etu_Nis = $_POST["Etu_Nis"];
        $Etu_Bac = $_POST["Etu_Bac"];
        $Etu_Avatar = $_FILES['Etu_Avatar']['name'];
        $Spe_ID = $_POST["Spe_ID"];
        $ext = pathinfo($Etu_Avatar, PATHINFO_EXTENSION);
	
	if (!file_exists('uploads/etud/')) {
    		mkdir('uploads/etud/', 0777, true);
	}
        $RandName = generateRandomString();
        $Etu_Avatar = "uploads/etud/".$RandName.'.'.$ext;
        
        $mysqli->query("INSERT INTO `etudiant`(`Etu_Nom`, `Etu_Prenom`, `Etu_Nis`, `Etu_Bac`, `Etu_Avatar`, `Spe_ID`) VALUES ('$Etu_Nom', '$Etu_Prenom', '$Etu_Nis', '$Etu_Bac', '$Etu_Avatar', '$Spe_ID')");

        if (move_uploaded_file($_FILES['Etu_Avatar']['tmp_name'], $Etu_Avatar))
        {
            header('Location: etudiants.php?AjouteAvecSucces');
        }
        else
            echo "errer dans l'upload";
        
    }

?>

    <form class="login" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <h4 class="text-center font-weight-bold">Ajouter Un Etudiant: </h4>
        <input class="form-control" type="text" name="Etu_Nom" placeholder="Etudiant Nom" autocomplete="off" required>
        <input class="form-control" type="text" name="Etu_Prenom" placeholder="Etudiant Prenom" autocomplete="off" required>
        <input class="form-control" type="date" name="Etu_Nis" placeholder="Etudiant Email" autocomplete="off" required>
        <input class="form-control" type="number" name="Etu_Bac" placeholder="Etudiant BAC" autocomplete="off" required>
        <input type="file" name="Etu_Avatar" accept="image/*" required>
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