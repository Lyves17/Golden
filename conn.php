<?php
$servername = "db";        // Nom du service MySQL défini dans docker-compose
$username = "bankuser";
$password = "bankpass";
$dbname = "web_programming";

// Crée la connexion
$con = mysqli_connect($servername, $username, $password, $dbname);

// Vérifie la connexion
if (!$con) {
    die("Connexion échouée : " . mysqli_connect_error());
}
?>
