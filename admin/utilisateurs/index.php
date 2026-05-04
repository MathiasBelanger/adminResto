<?php
require("../includes/init.php");
$stmt = $bdd->prepare("SELECT * FROM utilisateurs");
$stmt->execute();
$suprimer = isset($_GET["suprimer"]);
$succes = isset($_GET["succes"]);
$utilisateurs = '';
$utilisateurs .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $utilisateurs .= '<article class="card">';
    $utilisateurs .= '<h4>' .  $enr['courriel'] . '</h4>';
    $utilisateurs .= '<a href="modifier.php?id=' . $enr['id'] . '">Modifier le compte</a>';
    $utilisateurs .= '</article>';
}
$utilisateurs .= '<article class="card">';
$utilisateurs .= '<h2>Ajouter</h2>';
$utilisateurs .= '<a href="ajout.php">Ajouter un compte</a>';
$utilisateurs .= '</article>';
$utilisateurs .= '</div>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>utilisateurs</title>
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

    <main class="home">
        <h1>Les Comptes Admin</h1>
        <?php if ($suprimer): ?>
            <p class="succes">Page suprimer avec succès</p>
        <?php endif; ?>
        <?php if ($succes): ?>
            <p class="succes">Page modifier/ajouter avec succès</p>
        <?php endif; ?>
        <?php echo $utilisateurs; ?>

    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>