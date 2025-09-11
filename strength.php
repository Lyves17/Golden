<?php
require_once 'conn.php'; // Utiliser require_once pour s'assurer que le fichier est inclus une seule fois

function r_format($rup) {
    global $pdo; // Utiliser la connexion PDO globale
    
    try {
        $stmt = $pdo->query($rup);
        $row = $stmt->fetch();
        
        if (!$row) {
            return "0";
        }
        
        $number = isset($row['total']) ? (0 + str_replace(",", "", $row['total'])) : 0;
        
        if (!is_numeric($number)) {
            return "0";
        }
        
        if ($number >= 1000000000000) {
            return round($number/1000000000000, 2).'T';
        } elseif ($number >= 1000000000) {
            return round($number/1000000000, 2).'B';
        } elseif ($number >= 1000000) {
            return round($number/1000000, 2).'M';
        } elseif ($number >= 10000) {
            return round($number/1000, 2).'K';
        } else {
            return $number;
        }
    } catch (PDOException $e) {
        error_log('Erreur dans r_format: ' . $e->getMessage());
        return "0";
    }
}
?>
