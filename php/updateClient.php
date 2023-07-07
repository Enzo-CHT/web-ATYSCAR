

<?php
session_start();

require "connexion.php";


$ASSOC = [];

foreach ($_SESSION as $key=>$value) {
    if (!empty($_SESSION[$key]) or $value != "") {
        $ASSOC[$key] = $value;
    } else {
        $ASSOC[$key] = "N/A";
    }
}


print_r($ASSOC);

    

$sql = "UPDATE CLIENT SET
    NomC = ?,
    PrenomC = ?,
    DatNaisC = ?,
    LieuNaisC = ?,
    NationaliteC = ?,
    AdrVilC = ?,
    AdrRueC = ?,
    CodPosC = ?,
    TelC = ?,
    NumPasC = ?,
    DatDelPasC = ?,
    LieuDelPasC = ?,
    PaysDelPasC = ?,
    NumPermisC = ?,
    DatDelPermiC = ?,
    LieuDelPermisC = ?,
    AutreAdr = ?,
    Remarques = ?,
    CodTypC  = ?  
 WHERE NumC=?" ;

$stmt = $connexion->prepare($sql);

$stmt->bind_param('ssssssssssssssssssis',
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
                    $ASSOC['CodTypC'],
                    $ASSOC['NumC']);
$stmt->execute();
if (!$stmt->execute()) {
    die("Erreur lors de l'exécution de la requête : " . $stmt->error);
}
$stmt->close();



mysqli_close($connexion);

?>


