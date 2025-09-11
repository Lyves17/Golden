<?php
/**
 * Formatte un nombre à partir d'un résultat de requête SQL
 * @param string $sql La requête SQL à exécuter
 * @param array $params Paramètres pour la requête préparée
 * @return string Nombre formaté ou "0" si erreur ou pas de résultat
 */
function r_format($sql, $params = []) {
    global $con;
    
    if (!isset($con)) {
        error_log('Erreur: Connexion à la base de données non initialisée dans r_format()');
        return "0";
    }
    
    try {
        // Utilisation de la fonction executeQuery définie dans conn.php
        $stmt = executeQuery($sql, $params);
        
        if (!$stmt) {
            return "0";
        }
        
        $row = $stmt->fetch();
        
        if (!$row) {
            return "0";
        }
        
        // Récupère la valeur de la première colonne si 'total' n'existe pas
        $value = $row['total'] ?? reset($row);
        $number = is_numeric($value) ? $value + 0 : 0;
        
        // Formatage du nombre avec 2 décimales et séparateurs de milliers
        $formatted = number_format($number, 2, '.', ',');
        
        // Formatage conditionnel selon la taille du nombre
        if ($number >= 1000000000000) {
            return round($number/1000000000000, 2).'T';
        } elseif ($number >= 1000000000) {
            return round($number/1000000000, 2).'B';
        } elseif ($number >= 1000000) {
            return round($number/1000000, 2).'M';
        } elseif ($number >= 10000) {
            return round($number/1000, 2).'K';
        }
        
        return $formatted;
        
    } catch (PDOException $e) {
        error_log('Erreur dans r_format: ' . $e->getMessage() . ' - Requête: ' . $sql);
        return "0";
    }
}
?>
