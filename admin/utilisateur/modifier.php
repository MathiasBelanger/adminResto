<?php
include_once("form.php");
require("../nonContenu.php");

verifierAdmin();

if (isset($_POST['suprimer'])) {
    $id = $_POST['id'];

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $suprimer = "DELETE FROM utilisateur WHERE id=:id";
    $stmt = $pdo->prepare($suprimer);
    $stmt->execute([":id" => $id]);
    
    header("location:index.php");
    exit;
}
if (isset($_POST['enregistrer'])) {
    $id = $_POST['id'];
    $courriel = $_POST['courriel'];
    $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);

    $SQL = "UPDATE utilisateur SET ";
    $SQL .= "courriel=:courriel, ";
    $SQL .= "mdp=:mdp ";
    $SQL .= "WHERE id=:id";
    
    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $stmt = $pdo->prepare($SQL);
    $stmt->bindParam(":courriel", $courriel);
    $stmt->bindParam(":mdp", $mdp);
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
$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id=:id");
$stmt->execute([':id' => $id]);
$info = $stmt->fetch();

$boutton = '<form action="" method="post">';
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
    <title>Fiche - Modifier - utilisateur</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(); ?>
    
    <main>
        <section class="content">
            
            <h1><?php echo $info['courriel'] ?></h1>
            <h2>Modifier le courriel</h2>
            <?php echo html_form($info); 
            echo $boutton; ?>
        </section>
        
        
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>