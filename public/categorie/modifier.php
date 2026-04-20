<?php
include_once("form.php");
if (isset($_POST['suprimer'])) {
    $id = $_POST['id'];

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $suprimer = "DELETE FROM categorie WHERE id=:id";
    $stmt = $pdo->prepare($suprimer);
    $stmt->execute([":id" => $id]);
    header("location:index.php");
    exit;
}
if (isset($_POST['enregistrer'])) {
    $id = $_POST['id'];
    $categorie = $_POST['categorie'];
    $type = $_POST['type'];

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "UPDATE categorie SET ";
    $SQL .= "categorie=:categorie, ";
    $SQL .= "type=:type ";
    $SQL .= "WHERE id=:id";
    $stmt = $pdo->prepare($SQL);
    $stmt->bindParam(":categorie", $categorie);
    $stmt->bindParam(":type", $type);
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
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM categorie WHERE id=:id");
$stmt->execute([':id' => $id]);
$info = $stmt->fetch();

$boutton = '<form action="" method="post"';
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
    <title>Fiche - <?php echo $info['categorie'] ?></title>
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

            <h1><?php echo $info['categorie'] ?></h1>
            <h2>Modifier la fiche</h2>
            <?php echo html_form($info) ?>
            <?php echo $boutton ?>
        </section>


    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>