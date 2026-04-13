<?php
if (!isset($_GET['id'])) {
    header("location:index.php");
    die; //or exit
}
$id = $_GET['id'];
$bd = "../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM personnageshistorique WHERE id=:id");
$stmt->execute([':id' => $id]);
$info = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - <?php echo $info['nom_complet'] ?></title>
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

    <main>

        <aside class="sidebar">
            <h2>Autres personnages</h2>
            <ul>
                <li><a href="#">Cléopâtre</a></li>
                <li><a href="#">Jules César</a></li>
                <li><a href="#">Marie Curie</a></li>
                <li><a href="#">Charlemagne</a></li>
                <li><a href="#">Winston Churchill</a></li>
            </ul>
        </aside>

        <section class="content">

            <h1><?php echo $info['nom_complet'] ?></h1>

            <article class="fiche">
                <img src="<?php echo $info['image_url'] ?>" alt="Portrait de Napoléon">

                <ul>
                    <li><strong>Nom complet :</strong><?php echo $info['nom_complet'] ?></li>
                    <li><strong>Date de naissance :</strong><?php echo $info['date_naissance'] ?></li>
                    <li><strong>Lieu de naissance :</strong><?php echo $info['lieu_naissance'] ?></li>
                    <li><strong>Nationalité :</strong><?php echo $info['nationalite'] ?></li>
                    <li><strong>Profession :</strong><?php echo $info['profession'] ?></li>
                    <li><strong>Période :</strong><?php echo $info['periode'] ?></li>
                    <li><strong>Statut :</strong><?php echo $info['statut'] ?></li>
                    <li><strong>Description :</strong><?php echo $info['description'] ?></li>
                </ul>
            </article>
        </section>

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>