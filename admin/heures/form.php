<?php
function html_form($info = [])
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_ferme($info['ferme'] ?? 0);
    $resultat .= html_form_heure_ouverture($info['heure_ouvert'] ?? "");
    $resultat .= html_form_heure_fermeture($info['heure_ferme'] ?? "");
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
function html_form_ferme($ferme = 0)
{
    $types = [
        "Ouvert",
        "Fermer",
    ];
    $resultat = '';
    $resultat .= '<fieldset>';
    $resultat .= '<legend>Types</legend>';
    foreach ($types as $i => $type) {
        if ($ferme == $i) {
            $resultat .= '<label><input type="radio" name="ferme" value="' . $i . '" checked>';
        } else {
            $resultat .= '<label><input type="radio" name="ferme" value="' . $i . '">';
        }
        $resultat .= $type;
        $resultat .= ' </label>';
    }
    $resultat .= '</fieldset>';
    return $resultat;
}
function html_form_heure_ouverture($heure_ouvert = "")
{
    $resultat = '';
    $resultat .= '<label>Heures d\'ouverture: ';
    $resultat .= '<input type="time" name="heure_ouvert" value="' . ($heure_ouvert ?: date("HH:mm")) . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_heure_fermeture($heure_ferme = "")
{
    $resultat = '';
    $resultat .= '<label>Heures de fermeture: ';
    $resultat .= '<input type="time" name="heure_ferme" value="' . ($heure_ferme ?: date("HH:mm")) . '">';
    $resultat .= '</label>';
    return $resultat;
}
