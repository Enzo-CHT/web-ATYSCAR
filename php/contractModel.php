<?php
session_start();
$_SESSION['stats'] = "";

$action = isset($_POST['action']) ? $_POST['action'] : null;
if ($action == null) {
    $action = isset($_GET['action']) ? $_GET['action'] : null;
}
$embedded = isset($_POST['data'])  ? json_decode($_POST['data']) : null;

if ($action != null) {
    switch ($action) {
        case 'delete':
            deleteContract();
            break;
        case 'update':
            updateContract($embedded);
            break;
        case 'add':
            addContract($embedded);
            break;
    }
}


/**
 * Fonction de suppression d'un contrat
 */
function deleteContract()
{

    include "connexion.php";

    // Récupération par paramètre
    $id = isset($_GET['data']) ? $_GET['data'] : null;

    // Si pas de paramètre, récupération par SESSION
    if ($id == null) {
        $id = isset($_SESSION['contrat']['NumCont']) ? $_SESSION['contrat']['NumCont'] : null;
    }
    
    // Vérifie qu'il existe un id
    if ($id !== null) {
        $sql = "DELETE FROM Contrat WHERE NumCont = ?";
        $stmt = $connexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $id);
            if ($stmt->execute()) {
                echo "Delete : Success!";
            } else {
                die($connexion->error);
            }

            $stmt->close();
            mysqli_close($connexion);
        }
    } else {
        die("No contract loaded.");
    }
}

/**
 * Fonction de mise à jour du contrat
 */
function updateContract($newData)
{
    require "connexion.php";

    // Changement du type de l'element $newData (stdClass => array)
    $newData = get_object_vars($newData);

    if ($newData != null) {

        $requir = [
            'NumCont',
            'DatDebCont',
            'HeurDepCont',
            'DatRetCont',
            'HeurRetCont',
            'VilDepCont',
            'VilRetCont',
            'NumC',
            'MatV',
            'CodTypTarif',
            'Periode',
            'CodTypC'
        ];


        // Récupération du MatV et NumCont depuis la session
        // Ceux ci sont récupérés avant l'accès à la page de mise à jour du contrat
        // et ne change pas 
        $newData['MatV'] = isset($_SESSION['vehicule']['MatV']) ? $_SESSION['vehicule']['MatV'] : '';
        $newData['NumCont'] = isset($_SESSION['contrat']['NumCont']) ? $_SESSION['contrat']['NumCont'] : '';


        // Vérification des données
        switch ($newData['Periode']) {
            case 1:
                $newData['Periode'] = "HIV";
                break;
            case 2:
                $newData['Periode'] = "ETE";
                break;
            case 3:
                $newData['Periode'] = "VAC";
                break;
            default:
                $newdata['Periode'] = "";
        }
        // S'il manque un element de la liste des champs obligatoire
        foreach ($requir as $element) {
            if (!isset($newData[$element])) {

                die('FAIL:CHAMP(S) OBLIGATOIRE(S) MANQUANT(S)');
            }
        }

        //Si une valeur obligatoire n'est pas remplie
        foreach ($newData as $el => $val) {
            if (in_array($el, $requir) && $val == ('' || null)) {

                die('FAIL:CHAMP(S) OBLIGATOIRE(S) MANQUANT(S)');
            }
        }



        ////// Vérification de validité
        /*
        DateDebut < DateFin
        CodTypTarif <= 2
        */
        if (strtotime($data['DatDebCont']) > strtotime($data['DatRetCont'])) {
            die('FAIL:DATES NON VALIDES');
        }
        if ($data['CodTypTarif'] < 0 || $data['CodTypTarif'] > 2) {
            die('FAIL:VEUILLEZ ENTREZ UN TYPE DE FACTURATION VALIDE');
        }

        /////


        // Communication avec Base de données 
        $sql = "UPDATE Contrat SET
            DatDebCont = ? ,
            HeurDepCont = ? ,
            DatRetCont = ? ,
            HeurRetCont = ? ,
            VilDepCont = ? ,
            VilRetCont = ? ,
            NumC = ? ,
            MatV = ?,  
            CodTypTarif = ? 
            WHERE NumCont = ? ;";

        $stmt = $connexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param(
                'ssssssssss',
                $newData['date-depart'],
                $newData['heure-depart'],
                $newData['date-retour'],
                $newData['heure-retour'],
                $newData['station-depart'],
                $newData['station-retour'],
                $newData['numero-client'],
                $newData['MatV'],
                $newData['tarif'],
                $newData['NumCont']
            );

            if ($stmt->execute()) {
                echo "Update Success!";
            } else {
                die("Erreur lors de l'exécution de la requête" .  $stmt->error);
            }

            $stmt->close();
            mysqli_close($connexion);
        } else {
            die($connexion->error);
        }
    }
}


function addContract($data)
{
    // Changement du type de l'element $data (stdClass => array)
    $data = get_object_vars($data);


    if ($data != null) {
        include 'connexion.php';


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
            'CodTypTarif',
            'Periode',
            'CodTypC'
        ];

        switch ($data['Periode']) {
            case '1':
                $data['Periode'] = "HIV";
                break;
            case '2':
                $data['Periode'] = "ETE";
                break;
            case '3':
                $data['Periode'] = "VAC";
                break;
            default:
                $data['Periode'] = "";
        }

        foreach ($requirement as $element) {
            if (!isset($data[$element])) {
                die('FAIL:CHAMP(S) OBLIGATOIRE(S) MANQUANT(S)');
            }
        }
        foreach ($data as $key => $val) {
            if (in_array($key, $requirement) && $val == null || $val == '') {
                die("FAIL : CHAMP(S) OBLIGATOIRE(S) MANQUANT(S)");
            }
        }




        ////// Vérification de validité
        /*
        DateDebut < DateFin
        CodTypTarif <= 2
        */
        if (strtotime($data['DatDebCont']) > strtotime($data['DatRetCont'])) {
            die('FAIL:DATES NON VALIDES');
        }
        if ($data['CodTypTarif'] < 0 || $data['CodTypTarif'] > 2) {
            die('FAIL:VEUILLEZ ENTREZ UN TYPE DE FACTURATION VALIDE');
        }

        /////



        // Communication avec Base de données 
        $q = "SELECT count(*) AS row_count FROM CONTRAT WHERE NumCont = ?";
        $stmt = $connexion->prepare($q);

        $stmt->bind_param('s', $data['NumCont']);
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête");
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


            $NumCont = $data['NumCont'];
            $DatDebCont = $data['DatDebCont'];
            $HeurDepCont = $data['HeurDepCont'];
            $DatRetCont = $data['DatRetCont'];
            $HeurRetCont = $data['HeurRetCont'];
            $VilDepCont = $data['VilDepCont'];
            $VilRetCont = $data['VilRetCont'];
            $NumC = $data['NumC'];
            $MatV = $data['MatV'];
            $CodTypTarif = $data['CodTypTarif'];
            $Periode = $data['Periode'];
            $CodTypC = $data['CodTypC'];



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
                die("Une erreur s'est produite, réessayer plus tard");
            }
            $stmt->close();

            $ajoutTarif = "INSERT INTO Tarifer VALUES (?,?,?,?)";
            $tariferStmt = $connexion->prepare($ajoutTarif);
            $tariferStmt->bind_param(
                "ssii",
                $NumCont,
                $Periode,
                $CodTypTarif,
                $CodTypC,
            );
            if (!$tariferStmt->execute()) {
                die("Une erreur s'est produite, réessayer plus tard");
            }


            echo "AddContrat Success! : CONTRAT ENREGISTRE AVEC SUCCES !";
            mysqli_close($connexion);
        } else {
            die("FAIL : CONTRAT EXISTANT");
        }
    }
}
