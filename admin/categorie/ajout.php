<?php
include_once("form.php");
require("../nonContenu.php");

verifierAdmin();

if (isset($_POST['enregistrer'])) {
    if (isset($_POST['categorie'])) $categorie = $_POST['categorie'];
    if (isset($_POST['type'])) {
        $type = 1;
    } else {
        $type = 0;
    }

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "INSERT INTO categorie(categorie, type) VALUES ";
    $SQL .= "(";
    $SQL .= ":categorie ,";
    $SQL .= ":type ";
    $SQL .= ")";

    $stmt = $pdo->prepare($SQL);
    $stmt->execute([':categorie' => $categorie, ':type' => $type]);
    header("location:index.php");
    exit;
}

$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT last_insert_rowid();");
$info = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - Ajout - Categorie</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

    <?php echo html_header(1); ?>
    
    <main>
        <section class="content">
            <h1>Ajouter une catégorie</h1>
            <?php echo html_form($info) ?>
        </section>
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>