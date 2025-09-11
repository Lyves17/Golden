<?php
// Activation du rapport d'erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuration de la connexion à AlwaysData
$servername = "mysql17.paris1.alwaysdata.com"; // Serveur MySQL donné par Alwaysdata
$username   = "nosdevis2024@gmail.com";        // Utilisateur MySQL affiché dans ton panneau Alwaysdata
$password   = "H95yks@uCXeqSiJ";               // Mot de passe défini pour MySQL
$dbname     = "goldenaxe_db";              // Nom complet de ta base Alwaysdata

// Établir la connexion
$con = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$con) {
    error_log('[' . date('Y-m-d H:i:s') . '] Erreur de connexion : ' . mysqli_connect_error());
    die("Connexion échouée : " . mysqli_connect_error());
}

// Définir le jeu de caractères
mysqli_set_charset($con, "utf8mb4");

// Fonction utilitaire pour exécuter des requêtes avec gestion d'erreur
function db_query($sql) {
    global $con;
    if (!$con) {
        error_log("Erreur: Pas de connexion à la base de données");
        return false;
    }
    
    $result = mysqli_query($con, $sql);
    if (!$result) {
        error_log("Erreur SQL: " . mysqli_error($con) . " - Requête: " . $sql);
        return false;
    }
    return $result;
}
?>
