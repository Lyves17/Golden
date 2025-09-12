<?php
// Inclure la connexion centralisée
require_once __DIR__ . '/conn.php';

/**
 * Formatte-- un nombre à partir d'un résultat de requête SQL
 * @param string $sql La requête SQL à exécuter
 * @return string Nombre formaté ou "0" si erreur ou pas de résultat
 */
function r_format($sql) {
    global $con;
    
    if (!isset($con) || !$con) {
        error_log('Erreur: Connexion à la base de données non initialisée dans r_format()');
        return "0";
    }
    
    // Exécuter la requête
    $result = mysqli_query($con, $sql);
    if (!$result) {
        error_log('Erreur SQL: ' . mysqli_error($con));
        return "0";
    }
    
    $row = mysqli_fetch_assoc($result);
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
}
?>
