<?php
function html_form($info = [])
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_ouverture($info['heure_ouverture'] ?? "");
    $resultat .= html_form_fermature($info['heure_fermature'] ?? "");
    $resultat .= html_form_estOuvert($info['estOuvert'] ?? 1);

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

function html_form_ouverture($ouverture = "")
{
    $resultat = '';
    $resultat .= '<label>Temps d\'ouverture :';
    $resultat .= '<input type="time" name="heure_ouverture" value="'. $ouverture .'">';
    $resultat .= '</label>';
    return $resultat;
}

function html_form_fermature($fermature = "")
{
    $resultat = '';
    $resultat .= '<label>Temps de fermature :';
    $resultat .= '<input type="time" name="heure_fermature" value="'. $fermature .'">';
    $resultat .= '</label>';
    return $resultat;
}

function html_form_estOuvert($estOuvert = 1)
{
    $resultat = '';
    $resultat .= '<label>Si le restaurent est ouvert :';
    $resultat .= '<input type="checkbox" name="estOuvert" '; 
    if($estOuvert == 1) $resultat .= 'checked>';
    else $resultat .= '>';
    $resultat .= '</label>';
    return $resultat;
}