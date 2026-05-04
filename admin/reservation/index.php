<?php
$bd = "../../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM reservation ORDER by created_at");
$stmt->execute();
$suprimer = isset($_GET["suprimer"]);
$succes = isset($_GET["succes"]);
$reservation = '';
$reservation .= '<div class="cards">';
while ($enr = $stmt->fetch()) {
    $date = date_create($enr['dateReservation']);
    $reservation .= '<article class="card">';
    $reservation .= '<h2>' . $enr['nom'] . '</h2>';
    $reservation .= '<h4>' . date_format($date, "Y/m/d H:i") . '</h4>';
    $reservation .= '<a href="modifier.php?id=' . $enr['id'] . '">Modifier la catégorie</a>';
    $reservation .= '</article>';
}
$reservation .= '<article class="card">';
$reservation .= '<h2>Ajouter</h2>';
$reservation .= '<a href="ajout.php">Ajouter une réservation</a>';
$reservation .= '</article>';
$reservation .= '</div>';
$reservation .= '<a href="exporter.php">Exporter en format CSV</a>';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
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
        <h1>Les Réservations</h1>
        <?php if ($suprimer): ?>
            <p class="succes">Page suprimer avec succès</p>
        <?php endif; ?>
        <?php if ($succes): ?>
            <p class="succes">Page modifier/ajouter avec succès</p>
        <?php endif; ?>
        <?php echo $reservation; ?>

    </main>

    <footer>
        <p>© 2026 Les rives Boréales</p>
    </footer>

</body>

</html>