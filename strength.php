<?php
require_once __DIR__ . '/conn.php';

function r_format($sql) {
    global $con;
    
    if (!$con) {
        error_log('Erreur: Connexion à la base non initialisée.');
        return "0";
    }
    
    $result = mysqli_query($con, $sql);
    if (!$result) return "0";
    
    $row = mysqli_fetch_assoc($result);
    if (!$row) return "0";
    
    $value = $row['total'] ?? reset($row);
    $number = is_numeric($value) ? $value + 0 : 0;

    if ($number >= 1_000_000_000_000) return round($number / 1_000_000_000_000, 2) . 'T';
    if ($number >= 1_000_000_000) return round($number / 1_000_000_000, 2) . 'B';
    if ($number >= 1_000_000) return round($number / 1_000_000, 2) . 'M';
    if ($number >= 1_000) return round($number / 1_000, 2) . 'K';

    return number_format($number, 2, '.', ',');
}
?>
