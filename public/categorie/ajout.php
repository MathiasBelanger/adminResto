<?php
<<<<<<< HEAD
include_once("form.php");
if (isset($_POST['enregistrer'])) {
    if (isset($_POST['categorie'])) $categorie = $_POST['categorie'];
    if (isset($_POST['type'])) {
        $type = 1;
    } else {
        $type = 0;
    }
=======
if (isset($_POST['ajouter'])) {
    if(isset($_POST['categorie'])) $categorie = $_POST['categorie'];
    if(isset($_POST['type'])){
        $type = 1;
    }
    else{
        $type = 0;
    } //COMMIT
>>>>>>> 762cdd04744322ad9102436a2f1af1b55ebd0f59

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "INSERT INTO categorie(categorie, type) VALUES ";
    $SQL .= "(";
    $SQL .= ":categorie ,";
    $SQL .= ":type ";
    $SQL .= ")";

    $stmt = $pdo->prepare($SQL);
<<<<<<< HEAD
    $stmt->execute([':categorie' => $categorie, ':type' => $type]);
=======
    $stmt->execute([':categorie'=>$categorie, ':type'=>$type]);
>>>>>>> 762cdd04744322ad9102436a2f1af1b55ebd0f59
    header("location:index.php");
    exit;
}

<<<<<<< HEAD
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT last_insert_rowid();");
$info = $stmt->fetch();
=======
function html_form()
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_categorie();

    $resultat .= '<label><input type="checkbox" required>Je confirme la nouvelle catégorie.</label>';
    $resultat .= '<input type="hidden" name="ajouter">';
    $resultat .= '<button type="submit">Ajouter</button>';
    $resultat .= '<button type="reset">Réinitialiser</button>';
    $resultat .= '</form>';

    return $resultat;
}
function html_form_categorie()
{
    $resultat = '';
    $resultat .= '<label>Nouvelle catégorie :';
    $resultat .= '<input type="text" name="categorie" value="Nom de la catégorie"';
    $resultat .= '<input type="checkbox" name="type" value="type"';
    $resultat .= '</label>';
    return $resultat;
}


>>>>>>> 762cdd04744322ad9102436a2f1af1b55ebd0f59
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