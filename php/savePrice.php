<?php
session_start();
require 'connexion.php';




$data = isset($_POST['tarifs']) ? $_POST['tarifs'] : 'NONE';


if ($data['value'] < 0) {
    $data['value'] = 0;
}

if ($data != 'NONE') {

    $OCCURENCE = array();
    $OCCURENCE['tarif'] = $data['value'];
    $OCCURENCE += categorizeInput($data['name']);



    $query = "UPDATE TARIFER SET
            tarif = ? 
            WHERE 

                CodTypC = ?
            AND CodPerT = ?
            AND CodTypTarif = ?";

    $stmt = $connexion->prepare($query);
    if (!$stmt) {
        die("DB Connecion error : " . $connexion->error);
    }
    $stmt->bind_param(
        'iisi',
        $OCCURENCE['tarif'],
        $OCCURENCE['CodTypC'],
        $OCCURENCE['CodPerT'],
        $OCCURENCE['CodTypTarif']
    );
    if (!$stmt->execute()) {
        die('Query error :' .  $stmt->error);
    }

    echo "Success!";
    $_SESSION['stats'] = 'DONNEES SAUVEGARDER';

    $stmt->close();
    mysqli_close($connexion);
} else {
    die('Aucun données récupérés');
}



/**
 * Fonction qui prend un entrée le nom de l'objet traiter
 * et qui en extrait les élements associés à sa valeur
 */
function categorizeInput($name)
{
    // ($CodTypC, $CodPerT, $CodTypTarif)
    $OUTPUT = array();
    $name = explode('-', $name);
    switch ($name[0]) {
        case 'particulier':
            $OUTPUT['CodTypC'] = 1;
            break;
        case 'entreprise':
            $OUTPUT['CodTypC'] = 2;
            break;
        case 'privilegie':
            $OUTPUT['CodTypC'] = 3;
            break;
    }
    switch ($name[1]) {
        case 'vacances':
            $OUTPUT['CodPerT'] = 'VAC';
            break;
        case 'hiver':
            $OUTPUT['CodPerT'] = 'HIV';
            break;
        case 'ete':
            $OUTPUT['CodPerT'] = 'ETE';
            break;
    }
    switch ($name[2]) {
        case 'forfait':
            $OUTPUT['CodTypTarif'] = 1;
            break;
        case 'duree':
            $OUTPUT['CodTypTarif'] = 2;
            break;
        case 'kilometrage':
            $OUTPUT['CodTypTarif'] = 3;
            break;
    }
    return $OUTPUT;
}
