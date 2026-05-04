<?php
require("../nonContenu.php");

verifierAdmin();

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
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - <?php echo $info['nom'] ?></title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(); ?>
    
    <main>
        <section class="content">
            
            <h1><?php echo $info['nom'] ?></h1>
            
            <article class="fiche">
                <ul>
                    <li><strong>Nom: </strong><?php echo $info['nom'] ?></li>
                    <li><strong>Catégorie: </strong><?php echo $info["nom_categorie"] ?></li>
                    <li><strong>Description: </strong><?php echo $info['ingredient'] ?></li>
                    <li><strong>Prix: </strong><?php echo $info['prix'] ?></li>
                    <img src=<?php echo $info['image_url'] ?> alt=<?php echo $info['image_url'] ?>>
                </ul>
            </article>
            <?php echo $boutton ?>
        </section>
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>