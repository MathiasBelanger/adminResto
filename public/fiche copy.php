<?php
if (!isset($_GET['id'])) {
    header("location:index.php");
    die; //or exit
}
$id = $_GET['id'];
$bd = "../database/db.sqlite";
$pdo = new PDO("sqlite:" . $bd);
$stmt = $pdo->prepare("SELECT * FROM personnageshistorique WHERE id=:id");
$stmt->execute([':id' => $id]);
$info = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche - <?php echo $info['nom_complet'] ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header>
        <div class="logo">📜 Histoire+</div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="#">Personnages</a></li>
                <li><a href="#">Époques</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <aside class="sidebar">
            <h2>Autres personnages</h2>
            <ul>
                <li><a href="#">Cléopâtre</a></li>
                <li><a href="#">Jules César</a></li>
                <li><a href="#">Marie Curie</a></li>
                <li><a href="#">Charlemagne</a></li>
                <li><a href="#">Winston Churchill</a></li>
            </ul>
        </aside>

        <section class="content">

            <h1><?php echo $info['nom_complet'] ?></h1>

            <article class="fiche">
                <img src="images/<?php echo $info['image_url'] ?>" alt="Portrait de Napoléon">

                <ul>
                    <li><strong>Nom complet :</strong><?php echo $info['nom_complet'] ?></li>
                    <li><strong>Date de naissance :</strong><?php echo $info['date_naissance'] ?></li>
                    <li><strong>Lieu de naissance :</strong><?php echo $info['lieu_naissance'] ?></li>
                    <li><strong>Nationalité :</strong><?php echo $info['nationalite'] ?></li>
                    <li><strong>Profession :</strong><?php echo $info['profession'] ?></li>
                    <li><strong>Période :</strong><?php echo $info['periode'] ?></li>
                    <li><strong>Statut :</strong><?php echo $info['statut'] ?></li>
                    <li><strong>Description :</strong><?php echo $info['description'] ?></li>
                </ul>
            </article>

            <h2>Modifier la fiche</h2>

            <form>

                <label>Nom complet :
                    <input type="text" name="nom" value="Napoléon Bonaparte">
                </label>

                <label>Date de naissance :
                    <input type="date" name="date_naissance" value="1769-08-15">
                </label>

                <label>Âge au décès :
                    <input type="number" name="age" value="51" min="0" max="120">
                </label>

                <label>Email fictif :
                    <input type="email" name="email" value="napoleon@empire.fr">
                </label>

                <label>Site officiel :
                    <input type="url" name="site" value="https://empire-francais.fr">
                </label>

                <label>Période historique :
                    <select name="periode">
                        <option>Antiquité</option>
                        <option>Moyen Âge</option>
                        <option selected>Époque moderne</option>
                        <option>Époque contemporaine</option>
                    </select>
                </label>

                <fieldset>
                    <legend>Statut</legend>
                    <label><input type="radio" name="statut" value="vivant"> Vivant</label>
                    <label><input type="radio" name="statut" value="decede" checked> Décédé</label>
                </fieldset>

                <fieldset>
                    <legend>Domaines d'influence</legend>
                    <label><input type="checkbox" checked> Politique</label>
                    <label><input type="checkbox" checked> Militaire</label>
                    <label><input type="checkbox"> Science</label>
                    <label><input type="checkbox"> Philosophie</label>
                </fieldset>

                <label>Couleur associée :
                    <input type="color" value="#000080">
                </label>

                <label>Niveau de notoriété :
                    <input type="range" min="1" max="10" value="10">
                </label>

                <label>Portrait :
                    <input type="file" accept="image/*">
                </label>

                <label>Description :
                    <textarea rows="5"></textarea>
                </label>

                <label>
                    <input type="checkbox" required>
                    Je confirme les modifications
                </label>

                <button type="submit">Enregistrer</button>
                <button type="reset">Réinitialiser</button>

            </form>

        </section>

    </main>

    <footer>
        <p>© 2026 Histoire+ - Tous droits réservés</p>
    </footer>

</body>

</html>