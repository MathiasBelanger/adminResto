<?php
require("../nonContenu.php");

verifierAdmin();

$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM reservation");
$stmt->execute();
$reservation = '';
$reservation .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $date = date_create($enr['dateReservation']);
    $reservation .= '<article class="card">';
    $reservation .= '<h2>' . $enr['nom'] . '</h2>';
    $reservation .= '<h4>' . date_format($date, "Y/m/d H:i") . '</h4>';
    $reservation .= '<a href="modifier.php?id=' . $enr['id'] . '">Modifier la catégorie</a>';
    $reservation .= '</article>';
}
$reservation .= '</div>';
$ajout = '';
$ajout .= '<a href="ajout.php">Ajouter une réservation</a>';
$exportation = '';
$exportation = '<a href="exporter.php">Exporter les réservations en format CSV</a>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(1); ?>
    
    <main class="home">
        <h1>Les Catégories</h1>
        
        <?php echo $reservation; ?>
        <?php echo $ajout; ?>
        <?php echo $exportation; ?>
        
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>