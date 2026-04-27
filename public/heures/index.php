<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM heures");
$stmt->execute();
$heures = '';
$heures .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $heures .= '<article class="card">';
    $heures .= '<h2>' . $enr['jour'] . '</h2>';
    if ($enr['ferme'] == 0) {
        $heures .= '<h4>Ouverture: ' . $enr['heure_ouvert'] . '</h4>';
        $heures .= '<h4>Fermeture: ' . $enr['heure_ferme'] . '</h4>';
    } else $heures .= '<h4>Le restaurant est fermé</h4>';
    $heures .= '<a href="modifier.php?id=' . $enr['id'] . '">Modifier les heures</a>';
    $heures .= '</article>';
}
$heures .= '</div>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>heures</title>
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
        <h1>Les heures d'ouvertures</h1>

        <?php echo $heures; ?>

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>