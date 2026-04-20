<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM boisson");
$stmt->execute();
$boisson = '';
$boisson .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $types = [
        "Entrées",
        "Plats principaux - viande",
        "Plats principaux - poissons et fruits de mer",
        "Plats principaux - végétarien",
        "Desserts",
        "vin blanc",
        "vin rouge",
        "vin orange et nature",
        "vin mousseux",
        "spiritueux et digestifs",
    ];
    $boisson .= '<article class="card">';
    foreach ($types as $i => $type) {
        if ($enr['categorie_id'] == $i) {
            $boisson .= '<h2>' . $i . '</h2>';
        }
    }
    $boisson .= '<h4>' . $enr['nom'] . '</h4>';
    $boisson .= '<a href="fiche.php?id=' . $enr['id'] . '">Voir la fiche</a>';
    $boisson .= '</article>';
}
$boisson .= '</div>';
$ajout = '';
$ajout .= '<a href="ajout.php?id=' . $enr['id'] . '">Ajouter une boisson</a>';
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
        <h1>Les Boissons</h1>

        <?php echo $boisson; ?>
        <?php echo $ajout; ?>

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>