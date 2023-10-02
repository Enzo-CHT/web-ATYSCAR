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
            $STATS[$ville]['name'] = $TypeV;
            if (!isset($STATS[$ville]['cpt'])) {
                $STATS[$ville]['cpt'] = 1;
            } else {
                $STATS[$ville]['cpt']++;
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

    

    $xLabels = array();
    $dataDisplay = array();
    foreach ($STATS as $el => $val) {
        $xLabels[] = $el;
        /// Ajouter importation dataDisplay
    }
    print_r($STATS);
    print_r($xLabels);
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
