<?php
$servername = "mysql-goldenaxe.alwaysdata.net";
$username   = "goldenaxe";
$password   = "H95yks@uCXeqSiJ";
$dbname     = "goldenaxe_db";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Erreur connexion MySQL : " . mysqli_connect_error());
}
?>
