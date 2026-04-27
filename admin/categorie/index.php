<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM categorie");
$stmt->execute();
$categorie = '';
$categorie .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $types = [
        "Nourriture",
        "Boisson",
    ];
    $categorie .= '<article class="card">';
    $categorie .= '<h2>' . $enr['categorie'] . '</h2>';
    foreach ($types as $i => $type) {
        if ($enr['type'] == $i) {
            $categorie .= '<h4>' . $type . '</h4>';
        }
    }
    $categorie .= '<a href="modifier.php?id=' . $enr['id'] . '">Modifier la catégorie</a>';
    $categorie .= '</article>';
}
$categorie .= '<article class="card">';
$categorie .= '<h2>Ajouter</h2>';
$categorie .= '<a href="ajout.php">Ajouter une catégorie</a>';
$categorie .= '</article>';
$categorie .= '</div>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Categorie</title>
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
            </ul>
        </nav>
    </header>

    <main class="home">
        <h1>Les Catégories</h1>

        <?php echo $categorie; ?>

    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>