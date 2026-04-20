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
    $resultat .= html_form_origine($info['origine'] ?? "");
    $resultat .= html_form_anne($info['anne'] ?? "");
    $resultat .= html_form_extra($info['extra'] ?? "");
    $resultat .= html_form_pays($info['pays'] ?? "");
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
            $resultat .= '<option value="' .$type["id"] . '" selected>';
        } else {
            $resultat .= '<option value="' .$type["id"] . '">';
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
function html_form_origine($origine = "")
{
    $resultat = '';
    $resultat .= '<label>Origine: ';
    $resultat .= '<input type="text" name="origine" value="' . $origine . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_anne($anne = "")
{
    $resultat = '';
    $resultat .= '<label>Année: ';
    $resultat .= '<input type="text" name="anne" value="' . $anne . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_extra($extra = "")
{
    $resultat = '';
    $resultat .= '<label>Extra: ';
    $resultat .= '<input type="text" name="extra" value="' . $extra . '">';
    $resultat .= '</label>';
    return $resultat;
}
function html_form_pays($pays = "")
{
    $resultat = '';
    $resultat .= '<label>Région: ';
    $resultat .= '<input type="text" name="pays" value="' . $pays . '">';
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
