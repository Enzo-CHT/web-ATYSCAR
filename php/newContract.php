<?php
session_start();
require "connexion.php";
$_SESSION['stats'] = "";


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







$ASSOC = isset($_POST['data']) ? json_decode($_POST['data'], true) : 'NONE';



$requirement = [
    'NumCont',
    'DatDebCont',
    'HeurDepCont',
    'DatRetCont',
    'HeurRetCont',
    'VilDepCont',
    'VilRetCont',
    'NumC',
    'MatV',
    'CodTypTarif'
];





foreach ($ASSOC as $key => $val) {
    if (in_array($key, $requirement) && $val == null || $val == '') {
        die("ERREUR : CHAMP(S) OBLIGATOIRE(S) MANQUANT(S)");
    }
}







if ($ASSOC != 'NONE') {


    $q = "SELECT count(*) AS row_count FROM CONTRAT WHERE NumCont = ?";
    $stmt = $connexion->prepare($q);

    $stmt->bind_param('s', $ASSOC['NumCont']);
    if (!$stmt->execute()) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['row_count'];

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



        $NumCont = $ASSOC['NumCont'];
        $DatDebCont = $ASSOC['DatDebCont'];
        $HeurDepCont = $ASSOC['HeurDepCont'];
        $DatRetCont = $ASSOC['DatRetCont'];
        $HeurRetCont = $ASSOC['HeurRetCont'];
        $VilDepCont = $ASSOC['VilDepCont'];
        $VilRetCont = $ASSOC['VilRetCont'];
        $NumC = $ASSOC['NumC'];
        $MatV = $ASSOC['MatV'];
        $CodTypTarif = $ASSOC['CodTypTarif'];



        $stmt->bind_param(
            'ssssssssss',
            $NumCont,
            $DatDebCont,
            $HeurDepCont,
            $DatRetCont,
            $HeurRetCont,
            $VilDepCont,
            $VilRetCont,
            $NumC,
            $MatV,
            $CodTypTarif,

        );


        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }


       
        echo "CONTRAT ENREGISTRE AVEC SUCCES !";
        $stmt->close();



        mysqli_close($connexion);
    } else {
        echo "ERREUR : CONTRAT EXISTANT";
    }
} else {

    //Retourner vers la page d'erreur

}
