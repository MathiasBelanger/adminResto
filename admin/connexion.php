<?php 
    include_once("nonContenu.php");
    $erreur_connexion = false;
    
    if(!empty($_POST)){
        $courriel = $_POST["courriel"];
        $mdp = $_POST["mdp"];

        $pdo = new PDO("sqlite:../database/db.sqlite");
        $stmt = $pdo->prepare("
            SELECT mdp
            FROM utilisateur
            WHERE courriel = :courriel
        ");
        $stmt->execute([
            ":courriel" => $courriel,
        ]);
        $resultat = $stmt->fetch();

        if($resultat == false){
            $erreur_connexion = true;
        }
        else{
            $mdp = $_POST["mdp"];

            $succes = password_verify($mdp, $resultat["mdp"]);
            if($succes){
                $_SESSION["connecte"] = true;
                header("location:index.php");
                exit;
            }
            else $erreur_connexion = true;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Page de connexion</h1>

    <?php if ($erreur_connexion): ?>
        <p class="erreur">Erreur de connexion</p>
    <?php endif; ?>

    <form action="#" method="post">
        <h2>Connexion : </h2>
        Nom d'utilisateur :<input type="text" name="courriel">
        Mot de passe :<input type="password" name="mdp">
        <input type="submit">
    </form>
    <a href="utilisateur/ajout.php">AJOUT</a>
</body>

</html>