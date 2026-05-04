<?php
require("../includes/init.php");
include_once("form.php");
if (isset($_POST['enregistrer'])) {
    if (isset($_POST['courriel'])) $courriel = $_POST['courriel'];
    if (isset($_POST['mdp'])) $mdp = $_POST['mdp'];

    $mdp_encrypte = password_hash($mdp, PASSWORD_DEFAULT);

    $SQL = "INSERT INTO utilisateurs(courriel, mdp) VALUES ";
    $SQL .= "(";
    $SQL .= ":courriel,";
    $SQL .= ":mdp ";
    $SQL .= ")";

    $stmt = $bdd->prepare($SQL);

    $succes = $stmt->execute([
        "courriel" => $courriel,
        "mdp" => $mdp_encrypte,
    ]);

    header("location:index.php?succes=1");
    exit();
}
$stmt = $bdd->prepare("SELECT last_insert_rowid();");
$info = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
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
                <li><a href="../utilisateurs/index.php">Compte Admin</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="content">

            <h1>Page de creation de compte</h1>
            <?php echo html_form($info) ?>
        </section>


    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>
</body>

</html>