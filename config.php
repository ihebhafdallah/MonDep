<?php
    $LOCALHOST = "127.0.0.1";
    $USER = "root";
    $PASS = "";
    $DB = "mondep";
    $mysqli = new mysqli($LOCALHOST,$USER,$PASS,$DB);
    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
?>