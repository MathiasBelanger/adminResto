<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT boisson.*,categorie.categorie as nom_categorie from boisson INNER JOIN categorie on boisson.categorie_id = categorie.id ORDER by categorie");
$stmt->execute();
$boisson = '';
$boisson .= '<div class="cards">';
while ($info = $stmt->fetch()) {
    $boisson .= '<article class="card">';
    $boisson .= '<h2>' . $info["nom_categorie"] . '</h2>';
    $boisson .= '<h4>' . $info['nom'] . '</h4>';
    $boisson .= '<a href="fiche.php?id=' . $info['id'] . '">Voir la fiche</a>';
    $boisson .= '</article>';
}
$boisson .= '</div>';
$ajout = '';
$ajout .= '<a href="ajout.php">Ajouter une boisson</a>';
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