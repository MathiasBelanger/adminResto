<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT plat.*,categorie.categorie as nom_categorie from plat INNER JOIN categorie on plat.categorie_id = categorie.id ORDER by categorie");
$stmt->execute();
$suprimer = isset($_GET["suprimer"]);
$plat = '';
$plat .= '<div class="cards">';
while ($info = $stmt->fetch()) {
    $plat .= '<article class="card">';
    $plat .= '<h2>' . $info["nom_categorie"] . '</h2>';
    $plat .= '<h4>' . $info['nom'] . '</h4>';
    $plat .= '<a href="fiche.php?id=' . $info['id'] . '">Voir la fiche</a>';
    $plat .= '</article>';
}
$plat .= '<article class="card">';
$plat .= '<h2>Ajouter</h2>';
$plat .= '<a href="ajout.php">Ajouter un plat</a>';
$plat .= '</article>';
$plat .= '</div>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Plat</title>
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
        <h1>Les plats</h1>
        <?php if ($suprimer): ?>
            <p class="succes">Page suprimer avec succès</p>
        <?php endif; ?>
        <?php echo $plat; ?>

    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>