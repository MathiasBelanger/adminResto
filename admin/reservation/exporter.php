<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM reservation");
$stmt->execute();
$infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$nomFichier = "reservation.csv";
$fh = fopen($nomFichier, "w");
$sections = array_keys(current($infos));
fputcsv($fh, $sections, ",");
foreach ($infos as $info) {
    fputcsv($fh, $info, ",");
}
fclose($fh);
header("location: reservation.csv");
die();
