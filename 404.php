<?php


$Page_Name = "404";
include('config.php');
include("header.php");
session_start();
if (isset($_SESSION ['Admin_ID'])) {
    include("navbar.php");
}


?>


    <div class="Content-404">
        <h1>404</h1>
        <p>Page Non Trouvée</p>
    </div>



<?php
include ("footer.php")

?>