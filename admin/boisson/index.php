<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT boisson.*,categorie.categorie as nom_categorie from boisson INNER JOIN categorie on boisson.categorie_id = categorie.id ORDER by categorie");
$stmt->execute();
$suprimer = isset($_GET["suprimer"]);
$boisson = '';
$boisson .= '<div class="cards">';
while ($info = $stmt->fetch()) {
    $boisson .= '<article class="card">';
    $boisson .= '<h2>' . $info['nom'] . '</h2>';
    $boisson .= '<h4>' . $info["nom_categorie"] . '</h4>';
    $boisson .= '<a href="fiche.php?id=' . $info['id'] . '">Voir la fiche</a>';
    $boisson .= '</article>';
}
$boisson .= '<article class="card">';
$boisson .= '<h2>Ajouter</h2>';
$boisson .= '<a href="ajout.php">Ajouter une boisson</a>';
$boisson .= '</article>';
$boisson .= '</div>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Boisson</title>
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
        <h1>Les Boissons</h1>
        <?php if ($suprimer): ?>
            <p class="succes">Page suprimer avec succès</p>
        <?php endif; ?>
        <?php echo $boisson; ?>

    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>