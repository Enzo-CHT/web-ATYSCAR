<?php
session_start();
require "connexion.php";
$_SESSION['contrat-stats'] = "";
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
            $ASSOC['vehicule']['MatV'],
            $ASSOC['contrat']['CodTypTarif'],

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
