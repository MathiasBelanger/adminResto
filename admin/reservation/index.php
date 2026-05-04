<?php
include_once("../nonContenu.php");
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
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(); ?>
    
    <main class="home">
        <h1>Les Catégories</h1>
        
        <?php echo $reservation; ?>
        <?php echo $ajout; ?>
        
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>