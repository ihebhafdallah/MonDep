<?php
    if (!file_exists('phpqrcode/temp/etud/')) {
    	mkdir('phpqrcode/temp/etud/', 0777, true);
    }
    session_start();
    if ((isset($_SESSION ['Admin_ID'])) || (isset($_SESSION ['Prof_ID']))) {
        header('Location: dashboard.php');
    }

    $Page_Name = "Login Page";
    include('config.php');
    include("header.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $hashedPass = sha1($password);
        $result = $mysqli->query("SELECT * FROM `admin` WHERE `Admin_Email` = '$email' AND `Admin_Pass` = '$hashedPass'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION ['Admin_ID'] = $row['Admin_ID'];
                header('Location: dashboard.php');
                exit();
            }
        } else {
            header('Location: index.php?Erreur');
        }
    }
?>

    <form class="login" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <h3 class="text-center font-weight-bold">Login</h3>
        <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off" required>
        <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="new-password" required>
        <?php
            if (isset($_GET['Erreur']))
            {
            
        ?>
            <div class="alert alert-danger mb-2" role="alert">
            Il y a une erreur dans la connexion, soit l'utilisateur n'existe pas soit une erreur dans l'email ou le mot de passe.
            </div>
        <?php
            }
        ?>
        <input class="btn btn-primary btn-block" type="submit" value="Login">
    </form>

<?php
    include("footer.php");
?>