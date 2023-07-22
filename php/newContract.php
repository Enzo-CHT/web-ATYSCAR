<?php
session_start();
require "connexion.php";

/*
NumCont	
DatDebCont	
HeurDepCont	
DatRetCont	
HeurRetCont	
VilDepCont	
VilRetCont	
NumC	
MatV	
CodTypTarif
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

    $ask = "SELECT count(*) FROM CONTRAT WHERE NumCont = ?";
    $stmt = $connexion->prepare($ask);

    $stmt->bind_param('s', $ASSOC['contrat']['NumCont']);
    $stmt->execute();
    if (!$stmt->execute()) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }

    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();




    if (!$count) {
        $sql = "INSERT INTO CONTRAT (
        NumCont,
        DatDebCont,	
        HeurDepCont,
        DatRetCont,
        HeurRetCont,
        VilDepCont,	
        VilRetCont,	
        NumC,
        MatV,	
        CodTypTarif
        ) VALUES ( ?,?,?,?,?,?,?,?,?,? )";


        $stmt = $connexion->prepare($sql);
        if (!$stmt) {
            die("\nQuery error : " .  $connexion->error);
        }

        $stmt->bind_param(
            'ssssssssss',
            $ASSOC['contrat']['NumCont'],
            $ASSOC['contrat']['DatDebCont'],
            $ASSOC['contrat']['HeurDepCont'],
            $ASSOC['contrat']['DatRetCont'],
            $ASSOC['contrat']['HeurRetCont'],
            $ASSOC['contrat']['VilDepCont'],
            $ASSOC['contrat']['VilRetCont'],
            $ASSOC['client']['NumC'],
            $ASSOC['car']['MatV'],
            $ASSOC['contrat']['CodTypTarif'],

        );


        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        } else {
            echo "success!";
            $_SESSION['contrat-stats'] = "CONTRAT ENREGISTRER AVEC SUCCES !";
        }
        $stmt->close();



        mysqli_close($connexion);
    } else {
        echo "Existing element";
        $_SESSION['contrat-stats'] = "CONTRAT EXISTANT";
    }
} else {

    //Retourner vers la page d'erreur

}
