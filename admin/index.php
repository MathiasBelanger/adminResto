<?php include_once("./admin/nonContenu.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil - Admin</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <?php html_header(); ?>
    
    <main class="home">
        <h1>Les tableaux modifiables</h1>
        
        <div class="cards">
            
            <article class="card">
                <h2>Catégories</h2>
                <p>Catégories des tables (Entrées,vin,dessert,etc.)</p>
                <a href="categorie/index.php">Voir la carte</a>
            </article>
            
            <article class="card">
                <h2>Plats</h2>
                <p>Les plats</p>
                <a href="plat/index.php">Voir la carte</a>
            </article>

            <article class="card">
                <h2>Boissons</h2>
                <p>Les Boissons</p>
                <a href="boisson/index.php">Voir la carte</a>
            </article>
            
            <article class="card">
                <h2>Réservations</h2>
                <p>Les Réservations</p>
                <a href="reservation/index.php">Voir la carte</a>
            </article>
            
            <article class="card">
                <h2>Heures d'Ouvertures</h2>
                <p>Les Heures d'Ouvertures</p>
                <a href="ouverture/index.php">Voir la carte</a>
            </article>
            
        </div>
        
    </main>

    <?php html_header(); ?>
</body>

</html>