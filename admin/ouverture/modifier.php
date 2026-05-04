<?php
include_once("form.php");
include_once("../nonContenu.php");
if (isset($_POST['enregistrer'])) {
    $id = $_POST['id'];
    $heure_ouverture = $_POST['heure_ouverture'];
    $heure_fermature = $_POST['heure_fermature'];
    if($_POST['estOuvert']) $estOuvert = 1;
    else $estOuvert = 0;
    $pdo = new PDO("sqlite:../../database/db.sqlite");

    $SQL = "UPDATE ouverture SET ";
    $SQL .= "heure_ouverture=:heure_ouverture, ";
    $SQL .= "heure_fermature=:heure_fermature, ";
    $SQL .= "estOuvert=:estOuvert ";
    $SQL .= "WHERE id=:id";

    $stmt = $pdo->prepare($SQL);
    $stmt->bindParam(":heure_ouverture", $heure_ouverture);
    $stmt->bindParam(":heure_fermature", $heure_fermature);
    $stmt->bindParam(":estOuvert", $estOuvert);
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
$stmt = $pdo->prepare("SELECT * FROM ouverture WHERE id=:id");
$stmt->execute([':id' => $id]);
$info = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - Modifier - ouvertures</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php echo html_header(); ?>
    
    <main>
        <section class="content">
            
            <h1><?php echo $info['journee'] ?></h1>
            <h2>Modifier les heures</h2>
            <?php echo html_form($info) ?>
        </section>
        
        
    </main>
    
    <?php echo html_footer(); ?>
</body>

</html>