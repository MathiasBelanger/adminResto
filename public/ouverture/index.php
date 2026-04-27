<?php
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

    <header>
        <div class="logo">📜 Histoire+</div>
        <nav>
            <ul>
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="#">Personnages</a></li>
                <li><a href="#">Époques</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="home">
        <h1>Les Dates d'Ouvertures</h1>

        <?php echo $ouverture; ?>
    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>