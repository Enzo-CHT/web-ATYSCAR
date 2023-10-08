<?php

// Modele de récupération des données statistiques 


// Statistiques utilisés
/////////////////////////
// Utilisation / Type voiture / ville
// Utilisation / Type voiture / période
// Utilisation / Type voiture / Période / ville
// Recours concurrence / Type voiture / ville
// Recours concurrence / Type voiture / période



// TO DO
// Utilisation d'une seul fonction ??

UseByTypeCarByCity();
function UseByTypeCarByCity()
{
    $STATS = array();
    include "connexion.php";

    $request = "SELECT TypeV, VilDepCont FROM contrat INNER JOIN vehicule ON contrat.MatV = vehicule.MatV;";
    $res = $connexion->query($request);

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $ville = $row['VilDepCont'];
            $TypeV = $row['TypeV'];

            // Check if the city exists in the array
            if (!isset($STATS[$ville])) {
                $STATS[$ville] = [];
            }

            // Check if the vehicle type exists for the city
            if (!isset($STATS[$ville][$TypeV])) {
                $STATS[$ville][$TypeV] = ['cpt' => 1];
            } else {
                $STATS[$ville][$TypeV]['cpt']++;
            }
        }
    }

    $total = 0;

    // Calculate the total count
    foreach ($STATS as $el => $array) {
        foreach ($array as $typeV => $data) {
            $total += $data['cpt'];
        }
    }
    
    // Calculate percentages
    foreach ($STATS as $el => $val) {
        foreach ($val as $typeV => $data) {
            $STATS[$el][$typeV]['data'] = ($data['cpt'] / $total) * 100;
        }
    }


    $xLabels = array();
    $dataLabels = array();

    // Extract xLabels (cities)
    foreach ($STATS as $el => $ignore) {
        $xLabels[] = $el;
    }


    // FONCTION QUI FOU LA MERDE
    for ($i = 0; $i < sizeof($xLabels); $i++) {
        $set = array();
        $ville = $xLabels[$i];

        foreach ($STATS as $el => $array) {
            print_r($array);
            if (isset($array[$el])) {
                $data = $array[$el]['data'];
                $set[] = $data;
            } else {
                $set[] = 0;
            }
        }

        $percentLabels[$el] = $set;
    }
    ////  FIN FONCTION QUI FOU LA MERDE


    foreach ($percentLabels as $typeV => $arraysOfData) {
        
        $set = array();
        $len = max(array_map("count", $arraysOfData));
        for ($i = 0; $i < $len; $i++) {
            $sum = 0;

            foreach ($arraysOfData as $array) {
                $sum += isset($array[$i]) ? $array[$i] : 0;
            }

            $set[] = $sum;
        }

        $percentLabels[$typeV] = $set;
    }

    foreach ($percentLabels as $key => $valueArray) {
        $name = $key;
        $data = array_map('round', $valueArray);
        $dataLabels[] = ["name" => $name, "data" => $data];
    }

    $return = [$xLabels, $dataLabels];

    echo json_encode($return);
}
function UseByTypeCarByPeriode()
{
    $STATS = array();
    include "connexion.php";
    $request = "SELECT TypeV, periode FROM Tarifer 
    INNER JOIN contrat ON contrat.NumCont = id_contrat
    INNER JOIN vehicule ON contrat.MatV = vehicule.MatV;";
    $res = $connexion->query($request);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $periode = $row['periode'];
            $TypeV = $row['TypeV'];
            $STATS[$periode]['name'] = $TypeV;
            if (!isset($STATS[$periode]['cpt'])) {
                $STATS[$periode]['cpt'] = 1;
            } else {
                $STATS[$periode]['cpt']++;
            }
        }
    }
    $total = 0;
    foreach ($STATS as $el => $val) {
        $total += $STATS[$el]['cpt'];
    }

    foreach ($STATS as $el => $val) {
        $STATS[$el]['data'] = ($STATS[$el]['cpt'] / $total) * 100;
    }

    print_r($STATS);
}
function UseByTypeCarByPeriodeByCity()
{
    include "connexion.php";
    $request = "SELECT TypeV, periode, VilDepCont FROM Tarifer INNER JOIN contrat ON contrat.NumCont = id_contrat INNER JOIN vehicule ON contrat.MatV = vehicule.MatV;";
    $res = $connexion->query($request);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            print_r($row);
            foreach ($row as $el => $val) {
            }
        }
    }
}
function competitionByTypeCarByPeriode()
{
    $request = "";
}
function competitionByTypeCarByCity()
{
    $request = "";
}
