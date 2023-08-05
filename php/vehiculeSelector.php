<?php


include "../php/connexion.php";

$options = json_decode($_POST['options']);

//===================================
//Ajouter une vérification des valeurs
//===================================






if (!empty($options)) { // Vérification de l'existence des options 

    $array = array();
    $param = array();
    header('Content-Type: application/json'); // En-tête pour encoder en JSON
    foreach ($options as $key => $value) {

        if (!empty($value)) {  //Si un paramètre à été rempli par l'agent 
            $param[$key] = $value; //Ajout de celui ci 

        } else if (count($param) <= 0) { // Vérification de l'existance d'un paramètre
            //Tant qu'aucun paramètre n'a été ajouté, récupération normal des valeurs (sans filtre)
            $sql = "SELECT DISTINCT $key FROM VEHICULE";
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();


            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
                    foreach ($row as $key => $value) {

                        $array[$key][] = $value;
                    }
                }
            }
        }
    }

    // Si un/des paramètre(s) a/ont été entré(s) 
    if (count($param) > 0) {
        $array = array(); //Réinitialisation du paquet
        //print_r($param);

        foreach ($options as $key => $value) {
            $sql = "SELECT DISTINCT $key FROM VEHICULE WHERE ";
            $params = array();
            $placeholders = array();

            foreach ($param as $stg => $val) {
                if ($stg === "PuisV" || $stg === "NbPlV") {
                    $placeholders[] = "$stg>=? ";
                    $params[] = $val;
                } else {
                    $placeholders[] = "$stg=? ";
                    $params[] = $val;
                }
            }

            $sql .= implode(" AND ", $placeholders); 

            $stmt = $connexion->prepare($sql);
            $stmt->bind_param(str_repeat("s", count($params)), ...$params); 

            if ($stmt->execute()) {
                $result = $stmt->get_result();


                if (!empty($result)) {
                    while ($row = $result->fetch_assoc()) {
                        foreach ($row as $key => $value) {

                            $array[$key][] = $value;
                        }
                    }
                }
            }
        }
    }

    //print_r($array);
    echo json_encode($array);
}
