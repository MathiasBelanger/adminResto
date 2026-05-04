<?php
require("../nonContenu.php");

verifierAdmin();

$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT plat.*,categorie.categorie as nom_categorie from plat INNER JOIN categorie on plat.categorie_id = categorie.id ORDER by categorie");
$stmt->execute();
$plat = '';
$plat .= '<div class="cards">';
while ($info = $stmt->fetch()) {
    $plat .= '<article class="card">';
    $plat .= '<h2>' . $info["nom_categorie"] . '</h2>';
    $plat .= '<h4>' . $info['nom'] . '</h4>';
    $plat .= '<img src="' . $info['image_url'] . '" alt="' . $info['image_url'] . '">';
    $plat .= '<a href="fiche.php?id=' . $info['id'] . '">Voir la fiche</a>';
    $plat .= '</article>';
}
$plat .= '</div>';
$ajout = '';
$ajout .= '<a href="ajout.php">Ajouter un plat</a>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Plat</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(); ?>
    
    <main class="home">
        <h1>Les plats</h1>
        
        <?php echo $plat; ?>
        <?php echo $ajout; ?>
        
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>