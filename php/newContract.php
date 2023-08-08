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
        $_SESSION['stats'] = 'CHAMP(S) OBLIGATOIRE(S) MANQUANT(S)';
        die("Fail : $key est manquant");
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



    echo $count;
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


        $_SESSION['stats'] = "CONTRAT ENREGISTRE AVEC SUCCES !";
        echo "Success!";
        $stmt->close();



        mysqli_close($connexion);
    } else {
        $_SESSION['stats'] = "CONTRAT EXISTANT";
        echo "Existing element";
    }
} else {

    //Retourner vers la page d'erreur

}
