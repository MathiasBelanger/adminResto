<?php
require("includes/init.php");

$erreur_connexion = false;

if (!empty($_POST)) {
    $courriel = $_POST["courriel"];
    $mdp = $_POST["mdp"];

    $stmt = $bdd->prepare("SELECT mdp FROM utilisateurs WHERE courriel = :courriel");
    $stmt->execute([
        ":courriel" => $courriel,
    ]);
    $resultat = $stmt->fetch();

    if ($resultat == false) {
        $erreur_connexion = true;
    } else {
        $mdp = $_POST["mdp"];

        $succes = password_verify($mdp, $resultat["mdp"]);
        if ($succes) {
            $_SESSION["connecte"] = true;
            header("location:index.php");
            exit();
        } else {
            // Mot de passe
            $erreur_connexion = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>Page de connexion</h1>

    <?php if ($erreur_connexion): ?>
        <p class="erreur">Erreur de connexion</p>
    <?php endif; ?>

    <form action="#" method="post">
        <label>Courriel: <input type="text" name="courriel"></label>
        <label>Mot de Passe: <input type="password" name="mdp"></label>
        <input type="submit">
    </form>
</body>

</html>