<?php
if (isset($_POST['ajouter'])) {
    if(isset($_POST['origine'])) $origine = $_POST['origine'];
    if(isset($_POST['nom'])) $nom = $_POST['nom'];
    if(isset($_POST['extra'])) $extra = $_POST['extra'];
    if(isset($_POST['anne'])) $anne = $_POST['anne'];
    if(isset($_POST['prix'])) $prix = $_POST['prix'];

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "INSERT INTO categorie(categorie, type) VALUES ";
    $SQL .= "(";
    $SQL .= ":origine ,";
    $SQL .= ":nom ,";
    $SQL .= ":extra ,";
    $SQL .= ":anne ,";
    $SQL .= ":prix ";
    $SQL .= ")";

    $stmt = $pdo->prepare($SQL);
    $stmt->execute([':origine'=>$origine, ':nom'=>$nom, ':extra'=>$extra, ':anne'=>$anne, ':prix'=>$prix]);
    header("location:index.php");
    exit;
}

function html_form()
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_categorie();

    $resultat .= '<label><input type="checkbox" required>Je confirme la nouvelle boisson.</label>';
    $resultat .= '<input type="hidden" name="ajouter">';
    $resultat .= '<button type="submit">Ajouter</button>';
    $resultat .= '<button type="reset">Réinitialiser</button>';
    $resultat .= '</form>';

    return $resultat;
}
function html_form_categorie()
{
    $resultat = '';
    $resultat .= '<label>Nouvelle boisson :';
    $resultat .= '<input type="text" name="origine" value="Origine de la boisson"';
    $resultat .= '<input type="text" name="nom" value="Nom de la boisson"';
    $resultat .= '<input type="text" name="extra" value="Données extras"';
    $resultat .= '<input type="number" name="anne" value="Année de création"';
    $resultat .= '<input type="number" name="prix" value="Prix de la boisson"';
    $resultat .= '</label>';
    return $resultat;
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