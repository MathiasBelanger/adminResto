<?php
date_default_timezone_set("America/Toronto");
function html_form($info = [])
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_courriel($info['courriel'] ?? "");
    $resultat .= html_form_password($info['mdp'] ?? "");
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
function html_form_courriel($courriel = "")
{
    $resultat = '';
    $resultat .= '<label>Courriel: ';
    $resultat .= '<input type="text" name="courriel"value="' . $courriel . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_password($mdp = "")
{
    $resultat = '';
    $resultat .= '<label>Mot de Passe: ';
    $resultat .= '<input type="password" name="mdp">';
    $resultat .= '</label>';
    return $resultat;
}
