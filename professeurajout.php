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

        $Prof_Nom = $_POST["Prof_Nom"];
        $Prof_Prenom = $_POST["Prof_Prenom"];
        $Prof_Email = $_POST["Prof_Email"];
        $Prof_Pass = sha1($_POST["Prof_Pass"]);
        $Prof_Avatar = $_FILES['Prof_Avatar']['name'];
        $ext = pathinfo($Prof_Avatar, PATHINFO_EXTENSION);
	if (!file_exists('uploads/profs/')) {
    		mkdir('uploads/profs/', 0777, true);
	}
        $RandName = generateRandomString();
        $Prof_Avatar = "uploads/profs/".$RandName.'.'.$ext;
        
        $mysqli->query("INSERT INTO `prof`(`Prof_Nom`, `Prof_Prenom`, `Prof_Email`, `Prof_Pass`, `Prof_Avatar`) VALUES ('$Prof_Nom','$Prof_Prenom','$Prof_Email','$Prof_Pass','$Prof_Avatar')");

        if (move_uploaded_file($_FILES['Prof_Avatar']['tmp_name'], $Prof_Avatar))
        {
            header('Location: professeurs.php?AjouteAvecSucces');
        }
        else
            echo "errer dans l'upload";
        
    }

?>

    <form class="login" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <h4 class="text-center font-weight-bold">Ajouter Un Professeur: </h4>
        <input class="form-control" type="text" name="Prof_Nom" placeholder="Prof Nom" autocomplete="off" required>
        <input class="form-control" type="text" name="Prof_Prenom" placeholder="Prof Prenom" autocomplete="off" required>
        <input class="form-control" type="email" name="Prof_Email" placeholder="Prof Email" autocomplete="off" required>
        <input class="form-control" type="password" name="Prof_Pass" placeholder="Prof Password" autocomplete="off" required>
        <input type="file" name="Prof_Avatar" accept="image/*" required>
        <input class="btn btn-primary btn-block" type="submit" value="Ajouter">
    </form>


<?php
    include("footer.php");
?>