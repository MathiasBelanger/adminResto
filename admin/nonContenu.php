<?php
function html_header()
{
    $resultat = '';
    $resultat .= '<header>';
    $resultat .= '<div class="logo">Les Rives Boréales</div>';
    $resultat .= '<nav>';
    $resultat .= '<ul>';
    $resultat .= '<li><a href="../index.php">Accueil</a></li>';
    $resultat .= '<li><a href="#">Personnages</a></li>';
    $resultat .= '<li><a href="#">Époques</a></li>';
    $resultat .= '<li><a href="#">Contact</a></li>';
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