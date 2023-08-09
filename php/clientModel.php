<?php
session_start();
$_SESSION['stats'] = '';



$function = isset($_GET['function']) ? $_GET['function'] : '';
$data = isset($_GET['data']) ? $_GET['data'] : '';


switch ($function) {
    case 'newClient':
        newClient();
        break;
    case 'delClient':
        delClient();
        break;
    case 'updateClient':
        updateClient();
        break;
    case 'changeClient':
        changeClient($data);
        break;
}



/**
 * Fonction de sauvegarde d'un nouveau client
 * Si le client existe, la sauvegarde est ignoré
 */
function newClient()
{

    require "connexion.php";


    $ASSOC = [];
    $CLIENT = $_SESSION['client'];

    // Définition d'un tableau respectant les prérequis
    foreach ($CLIENT as $key => $value) {


        // Si un element est vide, on ajoute la note N/A 
        if (!empty($CLIENT[$key]) or $value != null) {
            $ASSOC[$key] = $value;
        } else {
            $ASSOC[$key] = "N/A";
        }
    }




    if (!empty($ASSOC)) {


        // On vérifie que l'element existe 
        $ask = "SELECT count(*) FROM CLIENT WHERE NumC = ?";
        $stmt = $connexion->prepare($ask);

        $stmt->bind_param('s', $ASSOC['NumC']);
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();


        // S'il n'existe pas, on l'ajoute
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

            $stmt->bind_param(
                'ssssssssssssssssssss',
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
                $ASSOC['CodTypC']
            );
            $stmt->execute();
            if (!$stmt->execute()) {
                die("Erreur lors de l'exécution de la requête : " . $stmt->error);
            }

            echo "Save : Success!";

            $stmt->close();
            mysqli_close($connexion);
        }
    } else {
        die('Pas de données');
    }
}

/**
 * Fonction de suppression d'un client existant
 */
function delClient()
{
    require "connexion.php";


    // Récupération du numéro Client
    $NUMC = isset($_SESSION['client']['NumC']) ? $_SESSION['client']['NumC'] : 'NONE';

    if ($NUMC != 'NONE') {
        $sql = "DELETE FROM CLIENT WHERE NumC=?";

        $stmt = $connexion->prepare($sql);

        $stmt->bind_param('s', $ASSOC['NumC']);
        $stmt->execute();
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }

        echo "Delete : Success!";
        $_SESSION['stats'] = "CLIENT SUPPRIMER";

        $stmt->close();
        mysqli_close($connexion);
    }
}

/**
 * Fonction de mis à jour d'un client existant
 * Si le client n'existe pas, la mis à jour est ignoré
 */
function updateClient()
{

    require "connexion.php";


    $ASSOC = [];
    $CLIENT = $_SESSION['client'];
    foreach ($CLIENT as $key => $value) {
        if (!empty($CLIENT[$key]) or $value != "") {
            $ASSOC[$key] = $value;
        } else {
            $ASSOC[$key] = "N/A";
        }
    }



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
 WHERE NumC=?";

    $stmt = $connexion->prepare($sql);

    $stmt->bind_param(
        'ssssssssssssssssssis',
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
        $ASSOC['NumC']
    );

    if (!$stmt->execute()) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }


    echo "Update : Success!";
    $_SESSION['stats'] = "CLIENT MIT A JOUR";

    $stmt->close();
    mysqli_close($connexion);
}

/**
 * Fonction de changement de Client de SESSION
 */
function changeClient($way)
{
    require "connexion.php";

    //Vérification des prérequis 
    if (!in_array($way, [1, -1, 0])) {
        $way = 0;
    }



    $sql = "SELECT NumC FROM CLIENT";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $NUMC = []; //Contient les resultats de la requete
    $CLIENT = $_SESSION['client']; // Contient les infos du client dans la session
   
   
    $count = 0;
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $key => $value) {
            $NUMC[$count] = $value;
            $count++;
        }
    }





    $condition = (isset($CLIENT['NumC']) && !empty($CLIENT['NumC']));
    if ($condition) {
        foreach ($NUMC as $i => $value) {
            if ($value == $CLIENT['NumC']) {

                // Optimisation nécessaire
                $nextIndex = $i + $way;
                $nextIndex = ($nextIndex) < 0 ? $count - 1 : $nextIndex; // Nouvelle index du suivant ou précédent
                $nextIndex = ($nextIndex) >= $count ? 0 : $nextIndex; // Nouvelle index du suivant ou précédent

                $next = $NUMC[$nextIndex];
            }
        }
    } else {
        $next = $NUMC[0];
    }

    $_SESSION['client']['NumC'] = $next;

    echo 'Switch : Success!';
}
