<?php
if (!isset($_GET['id'])) {
    header("location:index.php");
    die; //or exit
}
$id = $_GET['id'];
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM boisson WHERE id=:id");
$stmt->execute([':id' => $id]);
$info = $stmt->fetch();
$boutton = '';
$boutton .= '<a href="modifier.php?id=' . $enr['id'] . '">Modifier la fiche</a>';
$boutton .= '<a href="ajout.php?id=' . $enr['id'] . '">Supprimer la fiche</a>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - <?php echo $info['nom_complet'] ?></title>
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

    <main>

        <section class="content">

            <h1><?php echo $info['nom_complet'] ?></h1>

            <article class="fiche">
                <ul>
                    <li><strong>Catégorie :</strong><?php echo $info['type'] ?></li>
                    <li><strong>origine :</strong><?php echo $info['origine'] ?></li>
                    <li><strong>Nom :</strong><?php echo $info['nom'] ?></li>
                    <li><strong>Anné :</strong><?php echo $info['anne'] ?></li>
                    <li><strong>extra :</strong><?php echo $info['extra'] ?></li>
                    <li><strong>pays :</strong><?php echo $info['pays'] ?></li>
                    <li><strong>Statut :</strong><?php echo $info['prix'] ?></li>
                </ul>
            </article>
            <?php echo $boutton ?>
        </section>

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>