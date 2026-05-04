<?php
include_once("form.php");
if (isset($_POST['suprimer'])) {
    $id = $_POST['id'];

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $suprimer = "DELETE FROM plat WHERE id=:id";
    $stmt = $pdo->prepare($suprimer);
    $stmt->execute([":id" => $id]);
    header("location:index.php?suprimer=1");
    exit;
}
if (isset($_POST['enregistrer'])) {
    $upload = isset($_FILES['image_url']) && is_uploaded_file($_FILES['image_url']['tmp_name']);
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $categorie_id = $_POST['categorie_id'];
    $ingredient = $_POST['ingredient'];
    $prix = $_POST['prix'];

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "UPDATE plat SET ";
    $SQL .= "nom=:nom, ";
    $SQL .= "categorie_id=:categorie_id, ";
    $SQL .= "ingredient=:ingredient, ";
    $SQL .= "image_url=:image_url, ";
    $SQL .= "prix=:prix ";
    $SQL .= "WHERE id=:id";
    $stmt = $pdo->prepare($SQL);
    if ($upload) {
        $nom_fichier = date("h-i-s_H-m-s") . "_" . random_int(100000, 999999);
        $extension = strtolower(pathinfo($_FILES["image_url"]["name"], PATHINFO_EXTENSION));
        $extensions_permises = ["jpg", "png", "webp", "gif", "avif", "svg"];
        $image_url = "../img/" .  $_FILES['image_url']['name'] . $nom_fichier . "." . $extension;
        if (in_array($extension, $extensions_permises)) {
            $transfert_ok = move_uploaded_file($_FILES['image_url']['tmp_name'], __DIR__ . '/' . $image_url);
        } else {
            $image_url = '';
            $erreur = true;
        }
    } else $image_url = '';
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":categorie_id", $categorie_id);
    $stmt->bindParam(":ingredient", $ingredient);
    $stmt->bindParam(":prix", $prix);
    $stmt->bindParam(":image_url", $image_url);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    header("location:fiche.php?id=" . $id . "&succes=1");
    exit;
}

if (!isset($_GET['id'])) {
    header("location:index.php");
    die; //or exit
}
$id = $_GET['id'];
$stmt = execute("SELECT * FROM plat WHERE id=:id", [':id' => $id]);
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
    <title>Fiche - Modifier - Plat></title>
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
                <li><a href="../utilisateurs/index.php">Compte Admin</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="content">
            <h1><?php echo $info['nom'] ?></h1>
            <h2>Modifier la fiche</h2>
            <?php echo html_form($info) ?>
            <?php echo $boutton ?>
        </section>

    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>