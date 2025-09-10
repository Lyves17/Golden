<?php
include 'conn.php'; // Utiliser la connexion déjà configurée

function r_format($rup) {
    global $con; // Utiliser la connexion globale
    $result = mysqli_query($con, $rup);

    if(!$result) {
        return "0"; // si la requête échoue, retourne 0
    }

    $row = mysqli_fetch_assoc($result);
    $number = isset($row['total']) ? (0 + str_replace(",", "", $row['total'])) : 0;

    if (!is_numeric($number)) return "0";

    if     ($number >= 1000000000000) return round($number/1000000000000, 2).'T';
    elseif ($number >= 1000000000)    return round($number/1000000000, 2).'B';
    elseif ($number >= 1000000)       return round($number/1000000, 2).'M';
    elseif ($number >= 10000)         return round($number/1000, 2).'K';
    else                              return $number;
}
?>
