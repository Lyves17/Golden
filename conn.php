<?php
// Activation du rapport d'erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuration de la connexion à AlwaysData
$servername = "mysql-goldenaxe.alwaysdata.net";
$username   = "goldenaxe";
$password   = "H95yks@uCXeqSiJ";
$dbname     = "goldenaxe_db";

// Initialisation de la variable de connexion
$con = null;

try {
    // Options de configuration PDO
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
        PDO::ATTR_TIMEOUT => 10,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
    ];
    
    // Création de la connexion PDO
    $con = new PDO(
        "mysql:host=$servername;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        $options
    );
    
    // Pour la rétrocompatibilité avec le code existant
    $pdo = $con;
    
} catch (PDOException $e) {
    // Journalisation de l'erreur
    error_log('[' . date('Y-m-d H:i:s') . '] Erreur de connexion : ' . $e->getMessage());
    
    // Message d'erreur générique pour l'utilisateur
    if (strpos($_SERVER['PHP_SELF'], 'admin') !== false) {
        die('Erreur de connexion à la base de données. Veuillez contacter l\'administrateur.');
    } else {
        header('Location: /error.php?code=db_connection');
        exit();
    }
}

// Fonction utilitaire pour exécuter des requêtes préparées
function executeQuery($sql, $params = []) {
    global $con;
    try {
        $stmt = $con->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        error_log('Erreur SQL : ' . $e->getMessage() . ' - Query: ' . $sql);
        return false;
    }
}
?>
