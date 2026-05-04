<?php
session_start();

function html_header()
{
    $resultat = '';
    $resultat .= '<header>';
    $resultat .= '<div class="logo">Les Rives Boréales</div>';
    $resultat .= '<nav>';
    $resultat .= '<ul>';
    $resultat .= '<li><a href="../index.php">Accueil</a></li>';
    $resultat .= '<li><a href="../categorie/index.php">Catégories</a></li>';
    $resultat .= '<li><a href="../plat/index.php">Plats</a></li>';
    $resultat .= '<li><a href="../boisson/index.php">Boissons</a></li>';
    $resultat .= '<li><a href="../reservation/index.php">Réservations</a></li>';
    $resultat .= '<li><a href="../ouverture/index.php">Heures d\'Ouvertures</a></li>';
    $resultat .= '</ul>';
    $resultat .= '<ul>';
    $resultat .= '<li><a href="../utilisateur/index.php">Administrateurs</a></li>';
    $resultat .= '<li><a href="../deconnexion.php">Déconnexion</a></li>';
    $resultat .= '</ul>';
    $resultat .= '</nav>';
    $resultat .= '</header>';
    return $resultat;
}

function html_footer()
{
    $resultat = '';
    $resultat .= '<footer>';
    $resultat .= '<p>© 2026 Les Rives Boréales - Tous droits réservés</p>';
    $resultat .= '</footer>';
    return $resultat;
}

function verifierAdmin()
{
    if (!isset($_SESSION["connecte"]) || $_SESSION["connecte"] != true) {
        header("location: connexion.php");
        exit;
    }
}