<?php
function html_form($info = [])
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_nom($info['nom'] ?? "");
    $resultat .= html_form_nbrPersonnes($info['nbrPersonnes'] ?? "");
    $resultat .= html_form_dateReservation($info['dateReservation'] ?? "");
    $resultat .= html_form_email($info['email'] ?? "");
    $resultat .= html_form_cellulaire($info['cellulaire'] ?? "");
    $resultat .= html_form_exterieur($info['choixExterieur'] ?? 0);

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

function html_form_nom($nom = "")
{
    $resultat = '';
    $resultat .= '<label>Nom :';
    $resultat .= '<input type="text" name="nom" value="' . $nom . '">';
    $resultat .= '</label>';
    return $resultat;
}

function html_form_nbrPersonnes($nbrPersonnes = "")
{
    $resultat = '';
    $resultat .= '<label>Nombre de personnes :';
    $resultat .= '<input type="number" name="nbrPersonnes" value="' . $nbrPersonnes . '">';
    $resultat .= '</label>';
    return $resultat;
}

function html_form_dateReservation($dateReservation = "")
{
    $resultat = '';
    $resultat .= '<label>Date de Réservation :';
    $resultat .= '<input type="datetime-local" name="dateReservation" value="'. ($dateReservation?:date("Y-m-d\TH:i")) .'">';
    $resultat .= '</label>';
    return $resultat;
}

function html_form_email($email = "")
{
    $resultat = '';
    $resultat .= '<label>eMail :';
    $resultat .= '<input type="email" name="email" value="' . $email . '">';
    $resultat .= '</label>';
    return $resultat;
}

function html_form_cellulaire($cellulaire = "")
{
    $resultat = '';
    $resultat .= '<label>Numero de Telephone :';
    $resultat .= '<input type="tel" name="cellulaire" value="' . $cellulaire . '">';
    $resultat .= '</label>';
    return $resultat;
}

function html_form_exterieur($exterieur = 0)
{
    $types = [
        "Interieur",
        "Exterieur",
    ];
    $resultat = '';
    $resultat .= '<fieldset>';
    $resultat .= '<legend>Types</legend>';
    foreach ($types as $i => $type) {
        echo $i;
        if ($exterieur == $i) {
            $resultat .= '<label><input type="radio" name="choixExterieur" value="' . $i . '" checked>';
        } else {
            $resultat .= '<label><input type="radio" name="choixExterieur" value="' . $i . '">';
        }
        $resultat .= $type;
        $resultat .= '</label>';
    }
    $resultat .= '</fieldset>';
    return $resultat;
}
