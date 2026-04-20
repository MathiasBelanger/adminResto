<?php
function execute($sql, $data = [])
{
    $bd = "../../database/db.sqlite";
    $pdo = new PDO("sqlite:" . $bd);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    return $stmt;
}
function html_form($info = [])
{
    $resultat = '';
    $resultat .= '<form action="" method="post" enctype="multipart/form-data">';
    $resultat .= html_form_nom($info['nom'] ?? "");
    $resultat .= html_form_categorie($info['categorie_id'] ?? "");
    $resultat .= html_form_ingredient($info['ingredient'] ?? "");
    $resultat .= html_form_prix($info['prix'] ?? "");
    
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
    $stmt = execute("SELECT id,categorie from categorie order by categorie",);
    $types = $stmt->fetchAll();
    $resultat = '';
    $resultat .= '<label>Catégories: ';
    $resultat .= '<select name="categorie_id">';
    foreach ($types as $type) {
        if ($categorie == $type["id"]) {
            $resultat .= '<option value="' . $type["id"] . '" selected>';
        } else {
            $resultat .= '<option value="' . $type["id"] . '">';
        }
        $resultat .= $type["categorie"];
    }
    $resultat .= '</select>';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_nom($nom = "")
{
    $resultat = '';
    $resultat .= '<label>Nom: ';
    $resultat .= '<input type="text" name="nom" value="' . $nom . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_ingredient($ingredient = "")
{
    $resultat = '';
    $resultat .= '<label>Description: ';
    $resultat .= '<input type="text" name="ingredient" value="' . $ingredient . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_prix($prix = "")
{
    $resultat = '';
    $resultat .= '<label>Prix: ';
    $resultat .= '<input type="text" name="prix" value="' . $prix . '">';
    $resultat .= '</label>';
    return $resultat;
}
