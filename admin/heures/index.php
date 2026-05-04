<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM heures");
$stmt->execute();
$succes = isset($_GET["succes"]);
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
        <div class="logo">Les Rives Boréales</div>
        <nav>
            <ul>
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="../categorie/index.php">Catégories</a></li>
                <li><a href="../plat/index.php">Plats</a></li>
                <li><a href="../boisson/index.php">Boissons</a></li>
                <li><a href="../reservation/index.php">Réservations</a></li>
                <li><a href="../heures/index.php">Heures d'ouvertures</a></li>
                <li><a href="../utilisateurs/index.php">Compte Admin</a></li>
            </ul>
        </nav>
    </header>

    <main class="home">
        <h1>Les heures d'ouvertures</h1>
        <?php if ($succes): ?>
            <p class="succes">Heure modifier avec succès</p>
        <?php endif; ?>
        <?php echo $heures; ?>

    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>