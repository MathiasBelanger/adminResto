<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM reservation");
$stmt->execute();
$reservation = '';
$reservation .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $reservation .= '<article class="card">';
    $reservation .= '<h2>' . $enr['nom'] . '</h2>';
    $reservation .= '<h4>' . $enr['dateReservation']->format() . '</h4>';
    $reservation .= '<a href="modifier.php?id=' . $enr['id'] . '">Modifier la catégorie</a>';
    $reservation .= '</article>';
}
$reservation .= '</div>';
$ajout = '';
$ajout .= '<a href="ajout.php">Ajouter une catégorie</a>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil - Histoire+</title>
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
        <h1>Les Catégories</h1>

        <?php echo $reservation; ?>
        <?php echo $ajout; ?>

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>