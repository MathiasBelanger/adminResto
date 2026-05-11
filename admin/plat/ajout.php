<?php
include_once("form.php");
require("../nonContenu.php");

verifierAdmin();

if (isset($_POST['enregistrer'])) {
    if (isset($_POST['nom'])) $nom = $_POST['nom'];
    if (isset($_POST['categorie_id'])) $categorie_id = $_POST['categorie_id'];
    if (isset($_POST['ingredient'])) $ingredient = $_POST['ingredient'];
    if (isset($_POST['prix'])) $prix = $_POST['prix'];
    $upload = isset($_FILES['image_url']) && is_uploaded_file($_FILES['image_url']['tmp_name']);

    $search = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û");
    $replace = explode(",", "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u");
    $nomSansSterifs = str_replace($search, $replace, mb_strtolower($nom));

    $nom_fichier = date("h-i-s_H-m-s") . "_" . random_int(100000, 999999);
    $extension = strtolower(pathinfo($_FILES["image_url"]["name"], PATHINFO_EXTENSION));
    $extensions_permises = ["jpg", "png", "webp", "gif", "avif", "svg"];
    $url_cible = "../image/" . $nomSansSterifs . "_" . $nom_fichier . "." . $extension;

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "INSERT INTO plat(nom, categorie_id, ingredient, prix, image_url) VALUES ";
    $SQL .= "(";
    $SQL .= ":nom ,";
    $SQL .= ":categorie_id ,";
    $SQL .= ":ingredient ,";
    $SQL .= ":prix ,";
    $SQL .= ":image_url";
    $SQL .= ")";

    
    $stmt = $pdo->prepare($SQL);
    if (in_array($extension, $extensions_permises)) {
        if ($upload) move_uploaded_file($_FILES['image_url']['tmp_name'], $url_cible);
        else $image_url = '';

        $stmt->execute([':ingredient' => $ingredient, ':categorie_id' => $categorie_id, ':nom' => $nom, ':prix' => $prix, ':image_url' => $url_cible]);
    }
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
    <?php echo html_header(1); ?>

    <main>
        <section class="content">
            <h1>Ajouter un plat</h1>
            <?php echo html_form() ?>
        </section>
    </main>

    <?php echo html_footer(); ?>
</body>

</html>