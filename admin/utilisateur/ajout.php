<?php
include_once("form.php");
require("../nonContenu.php");


if (isset($_POST['enregistrer'])) {
    if(!empty($_POST)){
        $courriel = $_POST["courriel"];
        $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
    
        $pdo = new PDO("sqlite:../../database/db.sqlite");
        $stmt = $pdo->prepare("
            INSERT INTO utilisateur
                (courriel, mdp)
            VALUES
                (:courriel, :mdp)
        ");
    
        $success = $stmt->execute([
            "courriel" => $courriel,
            "mdp" => $mdp,
        ]);
    
        header("index.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - Ajout - administrateur</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(); ?>

    <main>
        <section class="content">
            <h1>Ajouter un administrateur</h1>
            <?php echo html_form() ?>
        </section>
    </main>

    <?php echo html_footer(); ?>
</body>