<?php
$servername = "mysql-goldenaxe.alwaysdata.net"; // toujours cette forme pour AlwaysData
$username   = "goldenaxe";                      // ton utilisateur MySQL
$password   = "H95yks@uCXeqSiJ";                // mot de passe MySQL
$dbname     = "goldenaxe_db";                   // nom complet de la base

// Créer la connexion
$con = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$con) {
    die("Connexion échouée : " . mysqli_connect_error());
}
?>
