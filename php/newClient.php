<?php
session_start();

require "connexion.php";


$ASSOC = [];
$CLIENT = $_SESSION['client'];


foreach ($CLIENT as $key=>$value) {
    if (!empty($CLIENT) or $value != "") {
        $ASSOC[$key] = $value;
    } else {
        $ASSOC[$key] = "N/A";
    }
}


//print_r($ASSOC);


if (!empty($ASSOC)) {

    $ask = "SELECT count(*) FROM CLIENT WHERE NumC = ?";
    $stmt = $connexion->prepare($ask);

    $stmt->bind_param('s', $ASSOC['NumC']);
    $stmt->execute();
    if (!$stmt->execute()) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }
    
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
   
    
    if (!$count) {
        
        
    $sql = "INSERT INTO CLIENT (
        NumC,
        NomC,
        PrenomC,
        DatNaisC,
        LieuNaisC,
        NationaliteC,
        AdrVilC,
        AdrRueC,
        CodPosC,
        TelC,
        NumPasC,
        DatDelPasC,
        LieuDelPasC,
        PaysDelPasC,
        NumPermisC,
        DatDelPermiC,
        LieuDelPermisC,
        AutreAdr,
        Remarques,
        CodTypC   
    ) VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?  )";
    
    $stmt = $connexion->prepare($sql);
    
    $stmt->bind_param('ssssssssssssssssssss',
                        $ASSOC['NumC'],
                        $ASSOC['NomC'],
                        $ASSOC['PrenomC'],
                        $ASSOC['DatNaisC'],
                        $ASSOC['LieuNaisC'],
                        $ASSOC['NationaliteC'],
                        $ASSOC['AdrVilC'],
                        $ASSOC['AdrRueC'],
                        $ASSOC['CodPosC'], 
                        $ASSOC['TelC'],
                        $ASSOC['NumPasC'],
                        $ASSOC['DatDelPasC'], 
                        $ASSOC['LieuDelPasC'],
                        $ASSOC['PaysDelPasC'],
                        $ASSOC['NumPermisC'],
                        $ASSOC['DatDelPermiC'],
                        $ASSOC['LieuDelPermisC'],
                        $ASSOC['AutreAdr'],
                        $ASSOC['Remarques'],
                        $ASSOC['CodTypC']);
    $stmt->execute();
    if (!$stmt->execute()) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }
    $stmt->close();
    
    
    
    mysqli_close($connexion);
    }
} else {
    //Retourner vers la page d'erreur

}
?>