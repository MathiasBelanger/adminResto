<?php
include_once("form.php");
if (isset($_POST['enregistrer'])) {
    if (isset($_POST['nom'])) $nom = $_POST['nom'];
    if (isset($_POST['nbPersonnes'])) $nbPersonnes = $_POST['nbPersonnes'];
    if (isset($_POST['dateReservation'])) $dateReservation = $_POST['dateReservation'];
    if (isset($_POST['email'])) $email = $_POST['email'];
    if (isset($_POST['cellulaire'])) $cellulaire = $_POST['cellulaire'];
    if (isset($_POST['choixIntExt'])) {
        $choixIntExt = 1;
    } else {
        $choixIntExt = 0;
    }

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "INSERT INTO reservation(nom, nbPersonnes, dateReservation, email, cellulaire, choixIntExt) VALUES ";
    $SQL .= "(";
    $SQL .= ":nom,";
    $SQL .= ":nbPersonnes,";
    $SQL .= ":dateReservation,";
    $SQL .= ":email,";
    $SQL .= ":cellulaire,";
    $SQL .= ":choixIntExt ";
    $SQL .= ")";

    $stmt = $pdo->prepare($SQL);
    $stmt->execute([':nom' => $nom, ':choixIntExt' => $choixIntExt, ':nbPersonnes' => $nbPersonnes, ':dateReservation' => $dateReservation, ':email' => $email, ':cellulaire' => $cellulaire]);
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
    <title>Fiche - Ajout - Reservation</title>
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
            <h1>Ajouter une catégorie</h1>
            <?php echo html_form($info) ?>
        </section>
    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>