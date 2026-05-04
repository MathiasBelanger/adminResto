<?php
require("../nonContenu.php");

verifierAdmin();

$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM categorie");
$stmt->execute();
$categorie = '';
$categorie .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $types = [
        "Nourriture",
        "Boisson",
    ];
    $categorie .= '<article class="card">';
    $categorie .= '<h2>' . $enr['categorie'] . '</h2>';
    foreach ($types as $i => $type) {
        if ($enr['type'] == $i) {
            $categorie .= '<h4>' . $type . '</h4>';
        }
    }
    $categorie .= '<a href="modifier.php?id=' . $enr['id'] . '">Modifier la catégorie</a>';
    $categorie .= '</article>';
}
$categorie .= '</div>';
$ajout = '';
$ajout .= '<a href="ajout.php">Ajouter une catégorie</a>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Categorie</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(); ?>
    
    <main class="home">
        <h1>Les Catégories</h1>
        
        <?php echo $categorie; ?>
        <?php echo $ajout; ?>
        
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>