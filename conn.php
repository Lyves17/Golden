<?php
$servername = "mysql-goldenaxe.alwaysdata.net";  // Hôte MySQL AlwaysData
$username   = "goldenaxe";                       // Ton utilisateur DB AlwaysData
$password   = "H95yks@uCXeqSiJ";                 // Ton mot de passe DB
$dbname     = "goldenaxe_web_programming";       // Nom exact de ta base (vérifie dans phpMyAdmin !)

// Crée la connexion
$con = mysqli_connect($servername, $username, $password, $dbname);

// Vérifie la connexion
if (!$con) {
    die("Connexion échouée : " . mysqli_connect_error());
}
?>
