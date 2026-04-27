<?php
include_once("form.php");
if (isset($_POST['enregistrer'])) {
    if (isset($_POST['nom'])) $nom = $_POST['nom'];
    if (isset($_POST['categorie_id'])) $categorie_id = $_POST['categorie_id'];
    if (isset($_POST['origine'])) $origine = $_POST['origine'];
    if (isset($_POST['anne'])) $anne = $_POST['anne'];
    if (isset($_POST['extra'])) $extra = $_POST['extra'];
    if (isset($_POST['pays'])) $pays = $_POST['pays'];
    if (isset($_POST['prix'])) $prix = $_POST['prix'];
    $upload = isset($_FILES['image_url']) && is_uploaded_file($_FILES['image_url']['tmp_name']);

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "INSERT INTO boisson(nom, categorie_id, origine, anne, extra, pays, image_url, prix) VALUES ";
    $SQL .= "(";
    $SQL .= ":nom ,";
    $SQL .= ":categorie_id ,";
    $SQL .= ":origine ,";
    $SQL .= ":anne ,";
    $SQL .= ":extra ,";
    $SQL .= ":pays ,";
    $SQL .= ":image_url ,";
    $SQL .= ":prix ";
    $SQL .= ")";

    $stmt = $pdo->prepare($SQL);
    if ($upload) {
        $image_url = "../img/" . $_FILES['image_url']['name'];
        move_uploaded_file($_FILES['image_url']['tmp_name'], __DIR__ . '/' . $image_url);
    } else $image_url = '';
    $stmt->execute([':origine' => $origine, ':categorie_id' => $categorie_id, ':nom' => $nom, ':extra' => $extra, ':anne' => $anne, ':pays' => $pays, ':image_url' => $image_url, ':prix' => $prix]);
    $id = $pdo->lastInsertId();
    header("location:fiche.php?id=" . $id);
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - Ajout - Boisson</title>
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
            <h1>Ajouter une boisson</h1>
            <?php echo html_form() ?>
        </section>
    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>