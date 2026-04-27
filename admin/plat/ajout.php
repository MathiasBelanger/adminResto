<?php
include_once("form.php");
include_once("./admin/nonContenu.php");
if (isset($_POST['enregistrer'])) {
    if (isset($_POST['nom'])) $nom = $_POST['nom'];
    if (isset($_POST['categorie_id'])) $categorie_id = $_POST['categorie_id'];
    if (isset($_POST['ingredient'])) $ingredient = $_POST['ingredient'];
    if (isset($_POST['prix'])) $prix = $_POST['prix'];

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "INSERT INTO plat(nom, categorie_id, ingredient, prix) VALUES ";
    $SQL .= "(";
    $SQL .= ":nom ,";
    $SQL .= ":categorie_id ,";
    $SQL .= ":ingredient ,";
    $SQL .= ":prix ";
    $SQL .= ")";

    $stmt = $pdo->prepare($SQL);
    $stmt->execute([':ingredient' => $ingredient, ':categorie_id' => $categorie_id, ':nom' => $nom, ':prix' => $prix]);
    header("location:index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - Ajout - Plat</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php html_header(); ?>
    
    <main>
        <section class="content">
            <h1>Ajouter un plat</h1>
            <?php echo html_form() ?>
        </section>
    </main>
    
    <?php html_footer(); ?>
</body>

</html>