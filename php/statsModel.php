<?php
// Modele de récupération des données statistiques 


// Statistiques utilisés
/////////////////////////
// Utilisation / Type voiture / ville
// Utilisation / Type voiture / période
// A faire : Utilisation / Type voiture / Période / ville
// A faire : Recours concurrence / Type voiture / ville
// A faire : Recours concurrence / Type voiture / période




$err = 0;
$xLabels = array();
$dataDisplays = array();
$STATS = array();

$userRequest = (isset($_GET['userStats']) ? $_GET['userStats'] : null);

// Données à traiter en fonction de la requête
switch ($userRequest) {
    case 0:
        $STATS = getStats($request = "SELECT TypeV, VilDepCont FROM contrat 
        INNER JOIN vehicule ON contrat.MatV = vehicule.MatV;");
        break;
    case 1:
        $STATS = getStats($request = "SELECT TypeV, periode FROM Tarifer 
        INNER JOIN contrat ON contrat.NumCont = id_contrat
        INNER JOIN vehicule ON contrat.MatV = vehicule.MatV;");
        break;
        /* 
    case :
        $STATS = getStats($request = "SELECT TypeV, periode, VilDepCont FROM Tarifer 
        INNER JOIN contrat ON contrat.NumCont = id_contrat 
        INNER JOIN vehicule ON contrat.MatV = vehicule.MatV;");
        break;*/

    default:
        die("FAIL:Pas de statistique selectionnée");
}


// Recupération du total des données
$total = 0;
foreach ($STATS as $arrays) {
    foreach ($arrays as $xPosition => $data) {
        $total += $data['cpt'];
    }
}


// Récupération des nom de l'axe x
foreach ($STATS as $TypeV => $arrays) {
    foreach ($arrays as $xPosition => $data) {
        if (!in_array($xPosition, $xLabels)) {
            $xLabels[] = $xPosition;
        }
    }
}

$nombreElement = count($xLabels);

// Evite la division par 0 
if ($nombreElement == 0) {
    $err = 1;
}


if (!$err) {

    // Traitement des données pour les adapter au format utilisable par apexchart
    foreach ($STATS as $typeV => $arrays) {
        $set = array();
        foreach ($arrays as $xPosition => $yData) {
            for ($i = 0; $i < $nombreElement; $i++) {
                // Si l'element actuel est à la position i, alors on ajoute les données à cette position
                if ($xLabels[$i] == $xPosition) {
                    $set[$i] = round(($yData['cpt'] / $total) * 100);
                } else if (!isset($set[$i])) {
                    // Si la position i ne correspondant pas n'est pas définis, on l'initialise à 0
                    $set[$i] = 0;
                }
            }
        }
        $dataDisplays[] = ['name' => $typeV, 'data' => $set];
    }
}


// Données renvoyé à la page 
$return = [$xLabels, $dataDisplays, $err];
echo json_encode($return);



/**
 * Fonction de récupération en fonction de la requête utilisateur
 */
function getStats($request)
{

    $STATS = array();

    include "connexion.php";
    $res = $connexion->query($request);

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_row()) {
            $TypeV = $row[0];
            $xPosition = $row[1];

            if (!isset($STATS[$TypeV][$xPosition])) {
                $STATS[$TypeV][$xPosition]['cpt'] = 1;
            } else {
                $STATS[$TypeV][$xPosition]['cpt']++;
            }
        }
    }


    return $STATS;
}
