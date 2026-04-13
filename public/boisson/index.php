<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM boisson");
$stmt->execute();
$categorie = '';
$categorie .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $categorie .= '<article class="card">';
    $categorie .= '<h2>' . $enr['type'] . ' ' . $enr['nom'] . '</h2>';
    $categorie .= '<a href="fiche.php?id=' . $enr['id'] . '">Voir la fiche</a>';
    $categorie .= '</article>';
}
$categorie .= '</div>';
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

        <?php echo $categorie; ?>
        <?php echo $ajout; ?>

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>