<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM reservation");
$stmt->execute();
$infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$nomFichier = "reservation.csv";
$fh = fopen($nomFichier, "w");
$sections = array_keys(current($infos));
var_dump($sections);
fputcsv($fh, $sections, ",");
foreach ($infos as $info) {
    fputcsv($fh, $info, ",");
}
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $nomFichier . '"');
// fpassthru($fh);
// fclose($fh);
die();
