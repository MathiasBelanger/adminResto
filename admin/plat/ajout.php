<?php
include_once("form.php");
if (isset($_POST['enregistrer'])) {
    if (isset($_POST['nom'])) $nom = $_POST['nom'];
    if (isset($_POST['categorie_id'])) $categorie_id = $_POST['categorie_id'];
    if (isset($_POST['ingredient'])) $ingredient = $_POST['ingredient'];
    if (isset($_POST['prix'])) $prix = $_POST['prix'];
    $upload = isset($_FILES['image_url']) && is_uploaded_file($_FILES['image_url']['tmp_name']);

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "INSERT INTO plat(nom, categorie_id, ingredient, image_url, prix) VALUES ";
    $SQL .= "(";
    $SQL .= ":nom ,";
    $SQL .= ":categorie_id ,";
    $SQL .= ":ingredient ,";
    $SQL .= ":image_url ,";
    $SQL .= ":prix ";
    $SQL .= ")";

    $stmt = $pdo->prepare($SQL);
    if ($upload) {
        $image_url = "../img/" . $_FILES['image_url']['name'];
        move_uploaded_file($_FILES['image_url']['tmp_name'], __DIR__ . '/' . $image_url);
    } else $image_url = '';
    $stmt->execute([':ingredient' => $ingredient, ':categorie_id' => $categorie_id, ':nom' => $nom, ':image_url' => $image_url, ':prix' => $prix]);
    $id = $pdo->lastInsertId();
    header("location:fiche.php?id=" . $id);
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
            <h1>Ajouter un plat</h1>
            <?php echo html_form() ?>
        </section>
    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>