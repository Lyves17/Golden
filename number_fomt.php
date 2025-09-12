<?php
function rup_format($query) {
    require_once __DIR__ . '/conn.php';
    global $con; // rendre $con accessible

    $sql = mysqli_query($con, $query);
    if (!$sql) {
        return "Erreur SQL : " . mysqli_error($con);
    }

    $row = mysqli_fetch_array($sql);
    $number = $row['total'] ?? 0;

    $number = (0 + str_replace(",", "", $number));
    if (!is_numeric($number)) return false;

    if     ($number >= 1000000000000) return 'PKR ' . round($number / 1000000000000, 2) . 'T';
    elseif ($number >= 1000000000)    return 'PKR ' . round($number / 1000000000, 2) . 'B';
    elseif ($number >= 1000000)       return 'PKR ' . round($number / 1000000, 2) . 'M';
    elseif ($number >= 1000)          return 'PKR ' . round($number / 1000, 2) . 'K';
    else                              return 'PKR ' . number_format($number, 2);
}
?>
