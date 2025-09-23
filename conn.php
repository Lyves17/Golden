<?php
$servername = "mysql-goldenaxe.alwaysdata.net";  // Hôte MySQL AlwaysData
$username   = "goldenaxe";                        // Ton utilisateur DB
$password   = "H95yks@uCXeqSiJ";                  // Mot de passe correct
$dbname     = "goldenaxe_db";                     // Nom exact de ta base

// Crée la connexion
$con = mysqli_connect($servername, $username, $password, $dbname);

// Vérifie la connexion
if (!$con) {
    die("Connexion échouée : " . mysqli_connect_error());
}
?>
