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

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "INSERT INTO boisson(nom, categorie_id, origine, anne, extra, pays, prix) VALUES ";
    $SQL .= "(";
    $SQL .= ":nom ,";
    $SQL .= ":categorie_id ,";
    $SQL .= ":origine ,";
    $SQL .= ":anne ,";
    $SQL .= ":extra ,";
    $SQL .= ":pays ,";
    $SQL .= ":prix ";
    $SQL .= ")";

    $stmt = $pdo->prepare($SQL);
    $stmt->execute([':origine' => $origine, ':categorie_id' => $categorie_id, ':nom' => $nom, ':extra' => $extra, ':anne' => $anne, ':pays' => $pays, ':prix' => $prix]);
    header("location:index.php");
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
        <div class="logo">📜 Histoire+</div>
        <nav>
            <ul>
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="#">Personnages</a></li>
                <li><a href="#">Époques</a></li>
                <li><a href="#">Contact</a></li>
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
        <p>© 2026 Boisson+ - Tous droits réservés</p>
    </footer>

</body>

</html>