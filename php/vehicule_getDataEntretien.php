<?php

include "connexion.php";
$matv = isset($_GET['matricule']) ? $_GET['matricule'] : null;

if ($matv != null) {
    $aData = array(); // Informations container 

    $sql = "SELECT MarV, ModV, KilomAV FROM Vehicule WHERE Matv=?";
    $stmt = $connexion->prepare($sql);
   
    $stmt->bind_param("s", $matv);
    if ($stmt->execute() ) {
        $res = $stmt->get_result();
        if ($res->num_rows >0) {
            while ($row = $res->fetch_assoc()) {
                foreach($row as $el=>$val) {
                    switch ($el) {

                        // Antifuite des noms de tables
                        case "MarV":
                            $el = "marqueVehicule";
                            break;
                        case "ModV":
                            $el = "modeleVehicule";
                            break;
                        case "KilomAV":
                            $el = "kilometrageVehicule";
                            break;
                    }     
                    
                    $aData[$el] = $val;
                }
            }
        }
    }

    echo json_encode($aData);
}

die();



?>