<?php
include_once("form.php");
if (isset($_POST['enregistrer'])) {
    if (isset($_POST['nom'])) $nom = $_POST['nom'];
    if (isset($_POST['nbrPersonnes'])) $nbrPersonnes = $_POST['nbrPersonnes'];
    if (isset($_POST['dateReservation'])) $dateReservation = $_POST['dateReservation'];
    if (isset($_POST['email'])) $email = $_POST['email'];
    if (isset($_POST['cellulaire'])) $cellulaire = $_POST['cellulaire'];
    if (isset($_POST['choixExterieur'])) {
        $choixExterieur = 1;
    } else {
        $choixExterieur = 0;
    }

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "INSERT INTO reservation(nom, nbrPersonnes, dateReservation, email, cellulaire, choixExterieur) VALUES ";
    $SQL .= "(";
    $SQL .= ":nom,";
    $SQL .= ":nbrPersonnes,";
    $SQL .= ":dateReservation,";
    $SQL .= ":email,";
    $SQL .= ":cellulaire,";
    $SQL .= ":choixExterieur ";
    $SQL .= ")";

    $stmt = $pdo->prepare($SQL);
    $stmt->execute([':nom' => $nom, ':choixExterieur' => $choixExterieur, ':nbrPersonnes' => $nbrPersonnes, ':dateReservation' => $dateReservation, ':email' => $email, ':cellulaire' => $cellulaire]);
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
    <title>Fiche - Ajout - Catégorie</title>
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
            <h1>Ajouter une catégorie</h1>
            <?php echo html_form($info) ?>
        </section>
    </main>

    <footer>
        <p>© 2026 Categorie+ - Tous droits réservés</p>
    </footer>

</body>

</html>