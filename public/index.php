<?php
// $bd = "../database/db.sqlite";
// $pdo = new PDO("sqlite:" . $bd);
// $stmt = $pdo->prepare("SELECT * FROM personnageshistorique");
// $stmt->execute();
// $collection = '';
// $collection .= '<div class="cards">';
// while ($enr = $stmt->fetch()) {
//     $collection .= '<article class="card">';
//     $collection .= '<h2>' . $enr['nom_complet'] . '</h2>';
//     $collection .= '<p>' . $enr['description'] . '</p>';
//     $collection .= '<a href="fiche.php?id=' . $enr['id'] . '">Voir la fiche</a>';
//     $collection .= '</article>';
// }
// $collection .= '</div>';
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
        <h1>Les tableaux modifiables</h1>

        <div class="cards">

            <article class="card">
                <h2>Catégories</h2>
                <p>Catégories des tables (Entrées,vin,dessert,etc.)</p>
                <a href="categorie/index.php">Voir la carte</a>
            </article>

            <article class="card">
                <h2>Plats</h2>
                <p>Les plats</p>
                <a href="plat/index.php">Voir la carte</a>
            </article>

            <article class="card">
                <h2>Table d'hôte</h2>
                <p>Les tables d'hôte</p>
                <a href="hote/index.php">Voir la carte</a>
            </article>

            <article class="card">
                <h2>Boissons</h2>
                <p>Les Boissons</p>
                <a href="boisson/index.php">Voir la carte</a>
            </article>

            <article class="card">
                <h2>Réservations</h2>
                <p>Les Réservations</p>
                <a href="reservation/index.php">Voir la carte</a>
            </article>

        </div>

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>