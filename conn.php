<?php
try {
    $host = 'mysql-goldenaxe.alwaysdata.net';
    $dbname = 'goldenaxe_db';
    $username = 'goldenaxe';
    $password = 'H95yks@uCXeqSiJ';
    
    // Options de configuration PDO
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
    ];
    
    // Création de la connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
    
    // Pour la compatibilité avec l'ancien code utilisant $con
    $con = $pdo;
    
} catch (PDOException $e) {
    // En production, vous pourriez vouloir logger cette erreur au lieu de l'afficher
    error_log('Erreur de connexion : ' . $e->getMessage());
    die('Une erreur est survenue lors de la connexion à la base de données. Veuillez réessayer plus tard.');
}
?>
