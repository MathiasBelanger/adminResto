<?php
if (isset($_POST['modifier'])) {
    //traitement
    //var_dump($_POST);
    //exit;
    $id = $_POST['id'];
    $boisson = $_POST['boisson'];

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "UPDATE boisson SET ";
    $SQL .= "boisson=:boisson ";
    $SQL .= "WHERE id=:id";
    $stmt = $pdo->prepare($SQL);

    $stmt->bindParam(":boisson", $boisson);
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
$stmt = $pdo->prepare("SELECT * FROM boisson WHERE id=:id");
$stmt->execute([':id' => $id]);
$info = $stmt->fetch();

function html_form($info)
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_boisson($info['boisson']);

    $resultat .= '<label><input type="checkbox" required>    Je confirme les modifications</label>';
    $resultat .= '<input type="hidden" name="id" value="' . $info['id'] . '">';
    $resultat .= '<input type="hidden" name="modifier">';
    $resultat .= '<button type="submit">Enregistrer</button>';
    $resultat .= '<button type="reset">Réinitialiser</button>';
    $resultat .= '</form>';

    return $resultat;
}
function html_form_boisson($boisson)
{
    $resultat = '';
    $resultat .= '<label>Catégorie :';
    $resultat .= '<input type="text" name="boisson" value="' . $boisson . '">';
    $resultat .= '</label>';
    return $resultat;
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - <?php echo $info['boisson'] ?></title>
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

            <h1><?php echo $info['boisson'] ?></h1>
            <h2>Modifier la fiche</h2>
            <?php echo html_form($info) ?>
        </section>

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>