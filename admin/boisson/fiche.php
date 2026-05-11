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
$stmt = $pdo->prepare("SELECT boisson.*,categorie.categorie as nom_categorie from boisson INNER JOIN categorie on boisson.categorie_id = categorie.id WHERE boisson.id=:id");
$stmt->execute([':id' => $id]);
$info = $stmt->fetch();
$boutton = '';
$boutton .= '<a href="modifier.php?id=' . $info['id'] . '">Modifier la fiche</a>';
$image ='';
$image .='<img src="'.$info["image_url"].'" alt="image">';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - <?php echo $info['nom'] ?></title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(1); ?>
    
    <main>
        
        <section class="content">
            
            <h1><?php echo $info['nom'] ?></h1>
            
            <article class="fiche">
                <ul>
                    <li><strong>Nom: </strong><?php echo $info['nom'] ?></li>
                    <li><strong>Catégorie: </strong><?php echo $info["nom_categorie"] ?></li>
                    <li><strong>Origine: </strong><?php echo $info['origine'] ?></li>
                    <li><strong>Anné: </strong><?php echo $info['anne'] ?></li>
                    <li><strong>Extra: </strong><?php echo $info['extra'] ?></li>
                    <li><strong>Région: </strong><?php echo $info['pays'] ?></li>
                    <li><strong>Prix: </strong><?php echo $info['prix'] ?></li>
                    <?php echo $image ?>
                </ul>
            </article>
            <?php echo $boutton ?>
        </section>
        
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>