<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Connexion à ta base déjà créée sur Alwaysdata
    $pdo = new PDO(
        'mysql:host=mysql-goldenaxe.alwaysdata.net;dbname=goldenaxe_db;charset=utf8mb4',
        'goldenaxe',
        'H95yks@uCXeqSiJ', // ton mot de passe MySQL Alwaysdata
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    // Charger et exécuter database.sql (création des tables)
    $sql = file_get_contents(__DIR__ . '/database.sql');
    if ($sql === false) {
        throw new Exception("Impossible de lire le fichier database.sql");
    }

    $pdo->exec($sql);

    echo "✅ Tables créées/initialisées avec succès dans goldenaxe_db !<br>";
    echo "➡️ Tu peux maintenant utiliser l’application.<br>";

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
