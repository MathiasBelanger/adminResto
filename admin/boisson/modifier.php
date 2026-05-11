<?php
include_once("form.php");
require("../nonContenu.php");

verifierAdmin();

if (isset($_POST['suprimer'])) {
    $id = $_POST['id'];

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $suprimer = "DELETE FROM boisson WHERE id=:id";
    $stmt = $pdo->prepare($suprimer);
    $stmt->execute([":id" => $id]);
    header("location:index.php");
    exit;
}
if (isset($_POST['enregistrer'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $categorie_id = $_POST['categorie_id'];
    $origine = $_POST['origine'];
    $anne = $_POST['anne'];
    $extra = $_POST['extra'];
    $pays = $_POST['pays'];
    $prix = $_POST['prix'];

    $upload = isset($_FILES['image_url']) && is_uploaded_file($_FILES['image_url']['tmp_name']);
    if($upload){
        $search = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û");
        $replace = explode(",", "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u");
        $nomSansSterifs = str_replace($search, $replace, mb_strtolower($nom));

        $nom_fichier = date("h-i-s_H-m-s") . "_" . random_int(100000, 999999);
        $extension = strtolower(pathinfo($_FILES["image_url"]["name"], PATHINFO_EXTENSION));
        $extensions_permises = ["jpg", "png", "webp", "gif", "avif", "svg"];
        $image_url = "../image/" . $nomSansSterifs . "_" . $nom_fichier . "." . $extension;
        if(in_array($extension, $extensions_permises)){
            move_uploaded_file($_FILES['image_url']['tmp_name'], __DIR__ . '/' . $image_url);
        }
        else $image_url = "ERREUR";
    }
    else $image_url = "";

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "UPDATE boisson SET ";
    $SQL .= "nom=:nom, ";
    $SQL .= "categorie_id=:categorie_id, ";
    $SQL .= "origine=:origine, ";
    $SQL .= "anne=:anne, ";
    $SQL .= "extra=:extra, ";
    $SQL .= "pays=:pays, ";
    $SQL .= "prix=:prix, ";
    $SQL .= "image_url=:image_url ";
    $SQL .= "WHERE id=:id";
    $stmt = $pdo->prepare($SQL);

    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":categorie_id", $categorie_id);
    $stmt->bindParam(":origine", $origine);
    $stmt->bindParam(":anne", $anne);
    $stmt->bindParam(":extra", $extra);
    $stmt->bindParam(":pays", $pays);
    $stmt->bindParam(":prix", $prix);
    $stmt->bindParam(":image_url", $image_url);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    header("location:index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("location:index.php");
    die; //or exit
}
$id = $_GET['id'];
$stmt = execute("SELECT * FROM boisson WHERE id=:id", [':id' => $id]);
$info = $stmt->fetch();

$boutton = '<form action="" method="post">';
$boutton .= '<label><input type="checkbox" required>  Je confirme que je veux suprimer</label>';
$boutton .= '<input type="hidden" name="id" value="' . $info['id'] . '">';
$boutton .= '<input type="hidden" name="suprimer">';
$boutton .= '<button type="submit">Suprimer</button>';
$boutton .= '</form>';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - Modifier - Boisson</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(1); ?>
    
    <main>
        <section class="content">
            <h1><?php echo $info['nom'] ?></h1>
            <h2>Modifier la fiche</h2>
            <?php echo html_form($info) ?>
            <?php echo $boutton ?>
        </section>
        
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>