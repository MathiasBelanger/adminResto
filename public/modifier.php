<?php
if (isset($_POST['modifier'])) {
    //traitement
    //var_dump($_POST);
    //exit;
    $id = $_POST['id'];
    $nom_complet = $_POST['nom_complet'];
    $date_naissance_formater = $_POST['date_naissance_formater'];
    $age_deces = $_POST['age_deces'];
    $email = $_POST['email'];
    $site = $_POST['site'];
    $periode = $_POST['periode'];
    $statut = $_POST['statut'];
    $domaine = $_POST['domaine'] ?? [];
    $couleur = $_POST['couleur'];
    $notoriete = $_POST['notoriete'];
    $description = $_POST['description'];
    $domaine = implode(", ", $domaine);

    $pdo = new PDO("sqlite:../database/db.sqlite");
    $SQL = "UPDATE personnageshistorique SET ";
    $SQL .= "nom_complet=:nom_complet, ";
    $SQL .= "date_naissance_formater=:date_naissance_formater, ";
    $SQL .= "age_deces=:age_deces, ";
    $SQL .= "email=:email, ";
    $SQL .= "site=:site, ";
    $SQL .= "periode=:periode, ";
    $SQL .= "statut=:statut, ";
    $SQL .= "domaine=:domaine, ";
    $SQL .= "couleur=:couleur, ";
    $SQL .= "notoriete=:notoriete, ";
    $SQL .= "description=:description, ";
    $SQL .= "image_url=:image_url ";
    $SQL .= "WHERE id=:id";
    $stmt = $pdo->prepare($SQL);
    if (isset($_FILES['image_url'])) {
        $image_url = "img/" . $_FILES['image_url']['name'];
        move_uploaded_file($_FILES['image_url']['tmp_name'], __DIR__ . '/' . $image_url);
    }
    $stmt->bindParam(":nom_complet", $nom_complet);
    $stmt->bindParam(":date_naissance_formater", $date_naissance_formater);
    $stmt->bindParam(":age_deces", $age_deces);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":site", $site);
    $stmt->bindParam(":periode", $periode);
    $stmt->bindParam(":statut", $statut);
    $stmt->bindParam(":domaine", $domaine);
    $stmt->bindParam(":couleur", $couleur);
    $stmt->bindParam(":notoriete", $notoriete);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":image_url", $image_url);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    header("location:fiche.php?id=" . $id);
    exit;
}

if (!isset($_GET['id'])) {
    header("location:index.php");
    die; //or exit
}
$id = $_GET['id'];
$bd = "../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM personnageshistorique WHERE id=:id");
$stmt->execute([':id' => $id]);
$info = $stmt->fetch();

function html_form($info)
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_nom_complet($info['nom_complet']);
    $resultat .= html_form_date_naissance($info['date_naissance_formater']);
    $resultat .= html_form_age_deces($info['age_deces']);
    $resultat .= html_form_email($info['email']);
    $resultat .= html_form_site($info['site']);
    $resultat .= html_form_periode($info['periode']);
    $resultat .= html_form_statut($info['statut']);
    $resultat .= html_form_domaine($info['domaine']);
    $resultat .= html_form_couleur($info['couleur']);
    $resultat .= html_form_notoriete($info['notoriete']);
    $resultat .= html_form_image($info['image_url']);
    $resultat .= html_form_desciption($info['description']);

    $resultat .= '<label><input type="checkbox" required>    Je confirme les modifications</label>';
    $resultat .= '<input type="hidden" name="id" value="' . $info['id'] . '">';
    $resultat .= '<input type="hidden" name="modifier">';
    $resultat .= '<button type="submit">Enregistrer</button>';
    $resultat .= '<button type="reset">Réinitialiser</button>';
    $resultat .= '</form>';

    return $resultat;
}
function html_form_nom_complet($nom_complet)
{
    $resultat = '';
    $resultat .= '<label>Nom complet :';
    $resultat .= '<input type="text" name="nom_complet" value="' . $nom_complet . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_date_naissance($date_naissance_formater)
{
    $resultat = '';
    $resultat .= '<label>Date de naissance :';
    $resultat .= '<input type="date" name="date_naissance_formater" value="' . $date_naissance_formater . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_age_deces($age_deces)
{
    $resultat = '';
    $resultat .= '<label>Âge au décès :';
    $resultat .= '<input type="number" name="age_deces" value="' . $age_deces . '" min="0" max="120">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_email($email)
{
    $resultat = '';
    $resultat .= '<label>Email fictif :';
    $resultat .= '<input type="email" name="email" value="' . $email . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_site($site)
{
    $resultat = '';
    $resultat .= '<label>Site officiel :';
    $resultat .= '<input type="url" name="site" value="' . $site . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_periode($periodesInfo)
{
    $periodes = [
        "Antiquité",
        "Moyen Âge",
        "Époque moderne",
        "Époque contemporaine",
    ];
    $resultat = '';
    $resultat .= '<label>Période historique :';
    $resultat .= '<select name="periode">';
    foreach ($periodes as $i => $periode) {
        if ($periodesInfo == $i) {
            $resultat .= '<option value="' . $i . '" selected>';
        } else {
            $resultat .= '<option value="' . $i . '">';
        }
        $resultat .= $periode;
    }
    $resultat .= '</select>';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_statut($statutInfo)
{
    $statuts = [
        "vivant",
        "Décédé",
    ];
    $resultat = '';
    $resultat .= '<fieldset>';
    $resultat .= '<legend>Statut</legend>';
    foreach ($statuts as $i => $statut) {
        if ($statutInfo == $i) {
            $resultat .= '<label><input type="radio" name="statut" value="' . $i . '" checked>';
        } else {
            $resultat .= '<label><input type="radio" name="statut" value="' . $i . '">';
        }
        $resultat .= $statut;
        $resultat .= '</label>';
    }
    $resultat .= '</fieldset>';
    return $resultat;
}
function html_form_domaine($domaine)
{
    $domainesInfo = [
        "Politique",
        "Militaire",
        "Science",
        "Philosophie",
    ];
    $resultat = '';
    $resultat .= '<fieldset>';
    $resultat .= '<legend>Domaines dinfluence</legend>';
    foreach ($domainesInfo as $i => $domaineInfo) {
        if ($domaine == $i)
            $resultat .= '<label><input type="checkbox" name="domaine[' . $i . ']" value="' . $domaineInfo . '" checked>';
        else {
            $resultat .= '<label><input type="checkbox" name="domaine[' . $i . ']" value="' . $domaineInfo . '">';
        }
        $resultat .= $domaineInfo;
        $resultat .= '</label>';
    }
    // $resultat .= '<label><input type="checkbox" checked> Politique</label>';
    // $resultat .= '<label><input type="checkbox" checked> Militaire</label>';
    // $resultat .= '<label><input type="checkbox"> Science</label>';
    // $resultat .= '<label><input type="checkbox"> Philosophie</label>';
    $resultat .= '</fieldset>';
    return $resultat;
}
function html_form_couleur($couleur)
{
    $resultat = '';
    $resultat .= '<label>Couleur associée :';
    $resultat .= '<input type="color" name="couleur" value="' . $couleur . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_notoriete($notoriete)
{
    $resultat = '';
    $resultat .= '<label>Niveau de notoriété :';
    $resultat .= '<input type="range" name="notoriete" min="1" max="10" value="' . $notoriete . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_image($image_url)
{
    $resultat = '';
    $resultat .= '<label>Portrait :';
    $resultat .= '<input type="file" name="image_url" accept="image/*">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_desciption($description)
{
    $resultat = '';
    $resultat .= '<label>Description :';
    $resultat .= '<textarea rows="5" name="description">' . $description . '</textarea>';
    $resultat .= '</label>';
    return $resultat;
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - <?php echo $info['nom_complet'] ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header>
        <div class="logo">📜 Histoire+</div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="#">Personnages</a></li>
                <li><a href="#">Époques</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <aside class="sidebar">
            <h2>Autres personnages</h2>
            <ul>
                <li><a href="#">Cléopâtre</a></li>
                <li><a href="#">Jules César</a></li>
                <li><a href="#">Marie Curie</a></li>
                <li><a href="#">Charlemagne</a></li>
                <li><a href="#">Winston Churchill</a></li>
            </ul>
        </aside>

        <section class="content">

            <h1><?php echo $info['nom_complet'] ?></h1>
            <h2>Modifier la fiche</h2>
            <?php echo html_form($info) ?>
        </section>

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>