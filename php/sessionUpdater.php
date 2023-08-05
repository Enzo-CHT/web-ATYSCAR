<?php
session_start();
// Modification possible à terme
// Mise à jour session en fonction des contrats client + infos clients + entretien véhicule ??? 




// BUG
$session = isset($_GET['session']) ? $_GET['session'] : '';



switch ($session) {
    case "client":
        echo "client updated";
        updateClient();
        break;
    case "vehicule":
        echo "vehicule updated";
        updateVehicule();
        break;
    case "all":
        echo "all session updated";
        updateClient();
        updateVehicule();
        break;
}


function updateClient()
{
    require 'connexion.php';
    $client = isset($_SESSION['client']['NumC']) ? $_SESSION['client']['NumC'] : 'NONE';
    if (!empty($client) && $client != 'NONE') {
        $sql = "SELECT * FROM CLIENT WHERE NumC=?";
        $stmt = $connexion->prepare($sql);


        $stmt->bind_param('s', $client);
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }
        $result = $stmt->get_result();

        if (!empty($result)) {

            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    $_SESSION['client'][$key] = $value;
                }
            }
        }
        echo "Success!";


        $stmt->close();
    }
}


function updateVehicule()
{
    require 'connexion.php';
    $matv = isset($_SESSION['vehicule']['MatV']) ? $_SESSION['vehicule']['MatV'] : 'NONE';

    if (!empty($matv) && $matv != 'NONE') {
        $sql = "SELECT * FROM VEHICULE WHERE MatV=?";
        $stmt = $connexion->prepare($sql);

        if (isset($matv) && !empty($matv)) {
            $stmt->bind_param('s', $matv);
            if (!$stmt->execute()) {
                die("Erreur lors de l'exécution de la requête : " . $stmt->error);
            }
            $result = $stmt->get_result();

            if (!empty($result)) {

                while ($row = $result->fetch_assoc()) {
                    foreach ($row as $key => $value) {
                        $_SESSION['vehicule'][$key] = $value;
                    }
                }
            }


            echo "Success!";
        } else {
            die("No SESSION set");
        }


        $stmt->close();
        mysqli_close($connexion);
    }
}
