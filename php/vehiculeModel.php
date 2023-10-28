<?php
session_start();
$_SESSION['stats'] = "";


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
    KilomAV
    */


$function = isset($_GET['function']) ? $_GET['function'] : "No function";
$data = isset($_GET['data']) ? json_decode($_GET['data'], true) : '';






switch ($function) {
    case "saveVehicule":
        saveVehicule($data);
        break;
    case "updateVehicule":
        updateVehicule($data);
        break;
    case "deleteVehicule":
        deleteVehicule();
        break;
    case "switchVehicule":
        switchVehicule($data);
        break;
}


/**
 * Fonction de sauvegarde de véhicule
 * 
 * La fonction vérifie l'existance d'un véhicule utilisant le matricule MatV
 * S'il existe ignoré la sauvegarde
 * Sinon le véhicule est sauvegardé
 */
function saveVehicule($data)
{
    include "connexion.php";

    // Vérification que les données existe et qu'elles respectent les prérequis
    if (!empty($data) && checkRequirements($data)) {

        // Recherche d'un élement pré existant
        $ask = "SELECT count(*) FROM VEHICULE WHERE MatV = ?";
        $stmt = $connexion->prepare($ask);

        $stmt->bind_param('s', $data['vehicule']['MatV']);
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        

        // Si aucun element trouvé
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
            KilomAV
            ) VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,?,? )";


            $stmt = $connexion->prepare($sql);
            if (!$stmt) {
                die("\nQuery error : " .  $connexion->error);
            }

            $data['vehicule']['CarbV'] = strtolower($data['vehicule']['CarbV']);

            $stmt->bind_param(
                'ssssssssssssss',
                $data['vehicule']['MatV'],
                $data['vehicule']['ImmatV'],
                $data['vehicule']['TypeV'],
                $data['vehicule']['MarV'],
                $data['vehicule']['ModV'],
                $data['vehicule']['CatV'],
                $data['vehicule']['PuisV'],
                $data['vehicule']['CarbV'],
                $data['vehicule']['CoulV'],
                $data['vehicule']['NbPlV'],
                $data['vehicule']['AnnV'],
                $data['vehicule']['KilDernE'],
                $data['vehicule']['KilProE'],
                $data['vehicule']['KilomAV'],

            );


            if (!$stmt->execute()) {
                die("Erreur lors de l'exécution de la requête : " . $stmt->error);
            }

        
            $_SESSION['stats'] = "VEHICULE ENREGISTRE";
            echo "Save : Success!";
            $stmt->close();



            mysqli_close($connexion);
        } else {
            $_SESSION['stats'] = "VEHICULE EXISTANT";
            echo "Existing element";
        }
    } else {

        //Retourner vers la page d'erreur

    }
}

/**
 * Fonction de mis à jour d'un véhicule existant
 * 
 * Si le véhicule n'existe pas, la mis à jour est ignoré
 * 
 * @param mixed $newData Tableau comportant les nouvelles données du véhicule
 */
function updateVehicule($newData)
{
    include "connexion.php";
    if (!empty($newData)) {
        $ask = "SELECT count(*) FROM VEHICULE WHERE MatV = ?";
        $stmt = $connexion->prepare($ask);

        $stmt->bind_param('s', $newData['vehicule']['MatV']);
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count) {
            $sql = "UPDATE VEHICULE SET
            ImmatV = ?,
            TypeV = ?,	
            MarV = ?,	
            ModV = ?,	
            CatV = ?,	
            PuisV = ?,	
            CarbV = ?,	
            CoulV = ?,	
            NbPlV = ?,	
            AnnV = ?,	
            KilDernE = ?,	
            KilProE = ?,
            KilomAV = ?

            WHERE MatV = ?";


            $stmt = $connexion->prepare($sql);
            if (!$stmt) {
                die("\nQuery error : " .  $connexion->error);
            }

            $stmt->bind_param(
                'ssssssssssssss',
                $newData['vehicule']['ImmatV'],
                $newData['vehicule']['TypeV'],
                $newData['vehicule']['MarV'],
                $newData['vehicule']['ModV'],
                $newData['vehicule']['CatV'],
                $newData['vehicule']['PuisV'],
                $newData['vehicule']['CarbV'],
                $newData['vehicule']['CoulV'],
                $newData['vehicule']['NbPlV'],
                $newData['vehicule']['AnnV'],
                $newData['vehicule']['KilDernE'],
                $newData['vehicule']['KilProE'],
                $newData['vehicule']['KilomAV'],
                $newData['vehicule']['MatV'],

            );


            if (!$stmt->execute()) {
                die("Erreur lors de l'exécution de la requête : " . $stmt->error);
            }


            $_SESSION['stats'] = "VEHICULE MIS A JOUR";
            echo "Update : Success!";
            $stmt->close();

            mysqli_close($connexion);
        }
    }
}

/**
 * Fonction de suppression de véhicule existant
 */
function deleteVehicule()
{
    require "connexion.php";
    // Récupération du MatV du véhicule en SESSION
    $identifier = $_SESSION['vehicule']['MatV'];
    $sql = " DELETE FROM VEHICULE WHERE MatV=?";

    $stmt = $connexion->prepare($sql);
    if (!$stmt) {
        die("Erreur lors de la connexion" . $connexion->error);
    }

    $stmt->bind_param('s', $identifier);
    $stmt->execute();
    if (!$stmt->execute()) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }


    $_SESSION['stats'] = "VEHICULE SUPPRIMER";
    echo "Delete : Success!";
    $stmt->close();
    mysqli_close($connexion);
}

/**
 * Fonction de changement de véhicule
 * @param mixed $way Direction du changement (-1 ou 1)
 */
function switchVehicule($way)
{
    include "connexion.php";

    // Si la variable ne respecte pas les prérequis
    if (!in_array($way, [1, -1, 0])) {
        $way = 0;
    }




    $sql = "SELECT MatV FROM VEHICULE";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $MATV = []; //Contient les resultats de la requete
    $VEHICULE = isset($_SESSION['vehicule']['MatV']) ? $_SESSION['vehicule']['MatV'] : ""; // Contient les infos du vehicule dans la session



    // Récupération de tous les matricules
    $count = 0;
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $key => $value) {
            $MATV[$count] = $value;
            $count++;
        }
    }


    
    // Si pas de véhicule au départ 
    $condition = (!empty($VEHICULE));
    if ($condition) {
        foreach ($MATV as $i => $value) {
            if ($value == $VEHICULE) {

                // Optimisation nécessaire
                $nextIndex = $i + $way;
                $nextIndex = ($nextIndex) < 0 ? $count - 1 : $nextIndex; // Nouvelle index du suivant ou précédent
                $nextIndex = ($nextIndex) >= $count ? 0 : $nextIndex; // Nouvelle index du suivant ou précédent


                $next = $MATV[$nextIndex];
            }
        }
    } else {
        // Choisir le premier par défaut
        $next = $MATV[0];
    }

   
    echo "Next : Success!";

    $_SESSION['vehicule']['MatV'] = $next; // Définition du nouveau matricule
    // Le reste des informations seront récupérer lors de la mis à jour de la SESSION


    return 0;
}


/**
 * Fonction de vérification des prérequis à l'enregistrement d'un nouveau véhicule
 */
function checkRequirements($data) {
    $Require = [
        'MatV',	
        'ImmatV',
       'TypeV',	
        'MarV',	
        'ModV',	
        'CatV',	
        'PuisV',
       'CarbV',	
       'CoulV',	
       'NbPlV',	
       'AnnV',
    ];


    foreach($data['vehicule'] as $key=>$val) {
        

        //Si la valeur qui est dans le tableau est null ou vide
        if (in_array($key, $Require) && $val == (null || '')) {
            
            $_SESSION['stats'] = 'CHAMP(S) OBLITOIRE(S) MANQUANT(S)';
            return false;
        }
    }


    return true ;
}