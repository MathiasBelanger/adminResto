<?php
function html_form($info = [])
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_infos($info["courriel"]);

    $resultat .= '<label><input type="checkbox" required>    Je confirme les modifications</label>';
    if (isset($info['id'])) {
        $resultat .= '<input type="hidden" name="id" value="' . $info['id'] . '">';
    }
    $resultat .= '<input type="hidden" name="enregistrer">';
    $resultat .= '<button type="submit">Enregistrer</button>';
    $resultat .= '<button type="reset">Réinitialiser</button>';
    $resultat .= '</form>';

    return $resultat;
}

function html_form_infos($courriel)
{
    $resultat = '';
    $resultat .= '<p>Courriel :</p><input type="text" name="courriel" value="' . $courriel . '">';
    $resultat .= '<p>Mot de passe :</p><input type="password" name="mdp">';
    return $resultat;
}