<?php
if (!isset($_GET['id'])) {
    header("location:index.php");
    die; //or exit
}
$id = $_GET['id'];
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT plat.*,categorie.categorie as nom_categorie from plat INNER JOIN categorie on plat.categorie_id = categorie.id WHERE plat.id=:id");
$stmt->execute([':id' => $id]);
$info = $stmt->fetch();
$boutton = '';
$boutton .= '<a href="modifier.php?id=' . $info['id'] . '">Modifier la fiche</a>';

$image = '';
if ((isset($info['image_url'])) && $info['image_url'] != '') {
    $image .= '<img src="' . $info['image_url'] . '" alt="image_de_' . $info['nom'] . '">';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - <?php echo $info['nom'] ?></title>
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

    <main>

        <section class="content">

            <h1><?php echo $info['nom'] ?></h1>

            <article class="fiche">
                <?php echo $image ?>
                <ul>
                    <li><strong>Nom: </strong><?php echo $info['nom'] ?></li>
                    <li><strong>Catégorie: </strong><?php echo $info["nom_categorie"] ?></li>
                    <li><strong>Description: </strong><?php echo $info['ingredient'] ?></li>
                    <li><strong>Prix: </strong><?php echo $info['prix'] ?>$</li>
                </ul>
            </article>
            <?php echo $boutton ?>
        </section>

    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>