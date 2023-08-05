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

function saveVehicule($data)
{
    include "connexion.php";

    if (!empty($data)) {


        $ask = "SELECT count(*) FROM VEHICULE WHERE MatV = ?";
        $stmt = $connexion->prepare($ask);

        $stmt->bind_param('s', $data['vehicule']['MatV']);
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        echo $count;
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
            KilProE	
            ) VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,? )";


            $stmt = $connexion->prepare($sql);
            if (!$stmt) {
                die("\nQuery error : " .  $connexion->error);
            }

            $stmt->bind_param(
                'sssssssssssss',
                $data['vehicule']['MatV'],
                $data['vehicule']['ImmatV'],
                $data['vehicule']['TypeV'],
                $data['vehicule']['MarV'],
                $data['vehicule']['ModV'],
                $data['vehicule']['CatV'],
                $data['vehicule']['PuisV'],
                strtolower($data['vehicule']['CarbV']),
                $data['vehicule']['CoulV'],
                $data['vehicule']['NbPlV'],
                $data['vehicule']['AnnV'],
                $data['vehicule']['KilDernE'],
                $data['vehicule']['KilProE'],

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
            KilProE = ?

            WHERE MatV = ?";


            $stmt = $connexion->prepare($sql);
            if (!$stmt) {
                die("\nQuery error : " .  $connexion->error);
            }

            $stmt->bind_param(
                'sssssssssssss',
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

function deleteVehicule()
{
    require "connexion.php";
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

function switchVehicule($way)
{
    include "connexion.php";
    if (!in_array($way, [1, -1, 0])) {
        $way = 0;
    }




    $sql = "SELECT MatV FROM VEHICULE";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $MATV = []; //COntient les resultats de la requete
    $VEHICULE = isset($_SESSION['vehicule']['MatV']) ? $_SESSION['vehicule']['MatV'] : ""; // Contient les infos du vehicule dans la session

    $count = 0;
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $key => $value) {
            $MATV[$count] = $value;
            $count++;
        }
    }


    //print_r($MATV);
    if (empty($VEHICULE)) {
        $VEHICULE = $MATV[0];
    }

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
        $next = $MATV[0];
    }

   
    echo "Next : Success!";

    $_SESSION['vehicule']['MatV'] = $next;


    return 0;
}
