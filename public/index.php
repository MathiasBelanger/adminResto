<?php
$bd = "../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM personnageshistorique");
$stmt->execute();
$collection = '';
$collection .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $collection .= '<article class="card">';
    $collection .= '<h2>' . $enr['nom_complet'] . '</h2>';
    $collection .= '<p>' . $enr['description'] . '</p>';
    $collection .= '<a href="fiche.php?id=' . $enr['id'] . '">Voir la fiche</a>';
    $collection .= '</article>';
}
$collection .= '</div>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil - Histoire+</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header>
        <div class="logo">📜 Histoire+</div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="#">Personnages</a></li>
                <li><a href="#">Époques</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="home">
        <h1>Collection de personnages historiques</h1>

        <?php echo $collection; ?>
        <!--<div class="cards">

            <article class="card">
                <h2>Napoléon Bonaparte</h2>
                <p>Empereur des Français (1769–1821)</p>
                <a href="fiche.php">Voir la fiche</a>
            </article>

            <article class="card">
                <h2>Cléopâtre</h2>
                <p>Reine d'Égypte (-69 – -30)</p>
                <a href="#">Voir la fiche</a>
            </article>

            <article class="card">
                <h2>Marie Curie</h2>
                <p>Physicienne et chimiste (1867–1934)</p>
                <a href="#">Voir la fiche</a>
            </article>

        </div> -->

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>