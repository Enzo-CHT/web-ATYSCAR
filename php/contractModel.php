


<?php
session_start();
$_SESSION['stats'] = "";

$action = isset($_POST['action']) ? $_POST['action'] : null;
$embedded = isset($_POST['data'])  ? json_decode($_POST['data']) : null;

if ($action != null) {
    switch ($action) {
        case 'delete':
            deleteContract();
            break;
        case 'update':
            updateContract($embedded);
            break;
    }
}



function deleteContract()
{
    require "connexion.php";

    $id = isset($_SESSION['contrat']['NumCont']) ? $_SESSION['contrat']['NumCont'] : null;

    if ($id !== null) {
        $sql = "DELETE FROM Contrat WHERE NumCont = ?";
        $stmt = $connexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $id);
            if ($stmt->execute()) {
                echo "Delete : Success!";
            }

            $stmt->close();
            mysqli_close($connexion);
        }
    } else {
        die("No contract loaded.");
    }
}


function updateContract($newData)
{
    require "connexion.php";

    $newData = get_object_vars($newData);

    if ($newData != null) {

        $requir = [
            'NumCont',
            'date-depart',
            'heure-depart',
            'date-depart',
            'heure-retour',
            'station-depart',
            'station-retour',
            'numero-client',
            'MatV',
        ];

        $newData['MatV'] = isset($_SESSION['vehicule']['MatV']) ? $_SESSION['vehicule']['MatV'] : '';
        $newData['NumCont'] = isset($_SESSION['contrat']['NumCont']) ? $_SESSION['contrat']['NumCont'] : '';


        print_r($newData);
        foreach ($newData as $el => $val) {
            if (in_array($el, $requir) && $val == ('' || null)) {
                $_SESSION['stats'] = '';
                die('FAIL');
            }
        }


        $sql = "UPDATE Contrat SET
            DatDebCont = ? ,
            HeurDepCont = ? ,
            DatRetCont = ? ,
            HeurRetCont = ? ,
            VilDepCont = ? ,
            VilRetCont = ? ,
            NumC = ? ,
            MatV = ?  WHERE NumCont = ? ;";

        $stmt = $connexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param(
                'sssssssss',
                $newData['date-depart'],
                $newData['heure-depart'],
                $newData['date-retour'],
                $newData['heure-retour'],
                $newData['station-depart'],
                $newData['station-retour'],
                $newData['numero-client'],
                $newData['MatV'],
                // Ajouter code tarif
                $newData['NumCont']
            );

            if ($stmt->execute()) {
                echo "Success!";
            } else {
                die('Error in query execution'.  $stmt->error);
            }




            $stmt->close();
            mysqli_close($connexion);
        } else {
            die($connexion->error);
        }
    }
}
