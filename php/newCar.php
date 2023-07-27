<?php
session_start();
require "connexion.php";
$_SESSION['contrat-stats'] = "";
/*
MatV	
ImmatV	
TypeV	
MarV	
ModV	
CatV	
PuisV	
CarbV	
CoulV	
NbPlV	
AnnV	
KilDernE	
KilProE	
*/




$ASSOC = [];

foreach ($_SESSION as $type => $array) {

    foreach ($array as $key => $value) {
        if (!empty($array) or $value != "") {
            $ASSOC[$type][$key] = $value;
        } else {
            $ASSOC[$type][$key] = "N/A";
        }
    }
}







if (!empty($ASSOC)) {

    $ask = "SELECT count(*) FROM VEHICULE WHERE MatV = ?";
    $stmt = $connexion->prepare($ask);

    $stmt->bind_param('s', $ASSOC['car']['MatV']);
    if (!$stmt->execute()) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }

    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();




    if (!$count) {
        $sql = "INSERT INTO VEHICULE (
        MatV,	
        ImmatV,
        TypeV,	
        MarV,	
        ModV,	
        CatV,	
        PuisV,	
        CarbV,	
        CoulV,	
        NbPlV,	
        AnnV,	
        KilDernE,	
        KilProE,	
        ) VALUES ( ?,?,?,?,?,?,?,?,?,?,?,? )";


        $stmt = $connexion->prepare($sql);
        if (!$stmt) {
            die("\nQuery error : " .  $connexion->error);
        }

        $stmt->bind_param(
            'sssssssssssss',
            $ASSOC['car']['MatV'],
            $ASSOC['car']['ImmatV'],
            $ASSOC['car']['TypeV'],
            $ASSOC['car']['MarV'],
            $ASSOC['car']['ModV'],
            $ASSOC['car']['CatV'],
            $ASSOC['car']['PuisV'],
            $ASSOC['car']['CarbV'],
            $ASSOC['car']['CoulV'],
            $ASSOC['car']['NbPlV'],
            $ASSOC['car']['AnnV'],
            $ASSOC['entretien']['KilDernE'],
            $ASSOC['entretien']['KilProE'],

        );


        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }


        $_SESSION['contrat-stats'] = "CONTRAT ENREGISTRE AVEC SUCCES !";
        echo "success!";
        $stmt->close();



        mysqli_close($connexion);
    } else {
        $_SESSION['contrat-stats'] = "CONTRAT EXISTANT";
        echo "Existing element";
    }
} else {

    //Retourner vers la page d'erreur

}
