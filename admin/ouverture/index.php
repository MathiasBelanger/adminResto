<?php
require("../nonContenu.php");

verifierAdmin();

$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM ouverture");
$stmt->execute();
$ouverture = '';
$ouverture .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $ouverture .= '<article class="card">';
    $ouverture .= '<h2>' . $enr['journee'] . '</h2>';
    if($enr['estOuvert'] == 1){
        $ouverture .= '<h4> Ouverture : ' . $enr['heure_ouverture'] . '</h4>';
        $ouverture .= '<h4> Fermature : ' . $enr['heure_fermature'] . '</h4>';
    }
    else $ouverture .= '<h4>Le restaurant est fermé !</h4>';
    $ouverture .= '<a href="modifier.php?id=' . $enr['id'] . '">Modifier les heures et l\'ouverture</a>';
    $ouverture .= '</article>';
}
$ouverture .= '</div>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ouvertures</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(1); ?>
    <main class="home">
        <h1>Les Dates d'Ouvertures</h1>
        
        <?php echo $ouverture; ?>
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>