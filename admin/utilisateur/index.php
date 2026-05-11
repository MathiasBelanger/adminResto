<?php
require("../nonContenu.php");

verifierAdmin();

$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM utilisateur");
$stmt->execute();

$reservation = '';
$reservation .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $reservation .= '<article class="card">';
    $reservation .= '<h2>' . $enr['courriel'] . '</h2>';
    $reservation .= '<a href="modifier.php?id=' . $enr['id'] . '">Modifier l\'administrateur</a>';
    $reservation .= '</article>';
}
$reservation .= '</div>';
$ajout = '';
$ajout .= '<a href="ajout.php">Ajouter un Administrateur</a>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Administrateur</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(1); ?>
    
    <main class="home">
        <h1>Les Administrateurs</h1>
        <?php echo $reservation; ?>
        <?php echo $ajout; ?>
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>