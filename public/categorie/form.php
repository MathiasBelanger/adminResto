<?php
function html_form($info = [])
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_categorie($info['categorie'] ?? "");
    $resultat .= html_form_type($info['type'] ?? "");

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

function html_form_categorie($categorie = "")
{
    $resultat = '';
    $resultat .= '<label>Catégorie :';
    $resultat .= '<input type="text" name="categorie" value="' . $categorie . '">';
    $resultat .= '</label>';
    return $resultat;
}

function html_form_type($typeInfo = "")
{
    $types = [
        "Nourriture",
        "Boisson",
    ];
    $resultat = '';
    $resultat .= '<fieldset>';
    $resultat .= '<legend>Types</legend>';
    foreach ($types as $i => $type) {
        if ($typeInfo == $i) {
            $resultat .= '<label><input type="radio" name="type" value="' . $i . '" checked>';
        } else {
            $resultat .= '<label><input type="radio" name="type" value="' . $i . '">';
        }
        $resultat .= $type;
        $resultat .= '</label>';
    }
    $resultat .= '</fieldset>';
    return $resultat;
}