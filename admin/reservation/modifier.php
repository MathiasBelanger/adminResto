<?php
include_once("form.php");
include_once("../nonContenu.php");
if (isset($_POST['suprimer'])) {
    $id = $_POST['id'];

    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $suprimer = "DELETE FROM reservation WHERE id=:id";
    $stmt = $pdo->prepare($suprimer);
    $stmt->execute([":id" => $id]);
    header("location:index.php");
    exit;
}
if (isset($_POST['enregistrer'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $nbPersonnes = $_POST['nbPersonnes'];
    $dateReservation = $_POST['dateReservation'];
    $email = $_POST['email'];
    $cellulaire = $_POST['cellulaire'];
    $choixIntExt = $_POST['choixIntExt'];
    $pdo = new PDO("sqlite:../../database/db.sqlite");
    $SQL = "UPDATE reservation SET ";
    $SQL .= "nom=:nom, ";
    $SQL .= "nbPersonnes=:nbPersonnes, ";
    $SQL .= "dateReservation=:dateReservation, ";
    $SQL .= "email=:email, ";
    $SQL .= "cellulaire=:cellulaire, ";
    $SQL .= "choixIntExt=:choixIntExt ";
    $SQL .= "WHERE id=:id";
    $stmt = $pdo->prepare($SQL);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":nbPersonnes", $nbPersonnes);
    $stmt->bindParam(":dateReservation", $dateReservation);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":cellulaire", $cellulaire);
    $stmt->bindParam(":choixIntExt", $choixIntExt);
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
$stmt = $pdo->prepare("SELECT * FROM reservation WHERE id=:id");
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
    <title>Fiche - Modifier - Reservation</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(); ?>
    
    <main>
        <section class="content">
            
            <h1><?php echo $info['nom'] ?></h1>
            <h2>Modifier la fiche</h2>
            <?php echo html_form($info) ?>
            <?php echo $boutton ?>
        </section>        
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>