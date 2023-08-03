<?php
session_start();
// Modification possible à terme
// Mise à jour session en fonction des contrats client + infos clients + entretien véhicule ??? 



$session = filter_input(INPUT_GET, 'session');

echo $session;
echo "test";
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
}


function updateClient()
{
    require 'connexion.php';
    if (isset($_SESSION['client']['NumC']) && !empty($_SESSION['client']['NumC'])) {
        $sql = "SELECT * FROM CLIENT WHERE NumC=?";
        $stmt = $connexion->prepare($sql);

        if (isset($_SESSION['client']['NumC']) && !empty($_SESSION['client']['NumC'])) {
            $stmt->bind_param('s', $_SESSION['client']['NumC']);
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
            echo "success!";
        } else {
            die("No SESSION set");
        }
    print_r($_SESSION['client']);
        $stmt->close();
    }
}


function updateVehicule()
{
    require 'connexion.php';
    if (!empty($_SESSION['vehicule']['MatV'])) {

        $sql = "SELECT * FROM VEHICULE WHERE MatV=?";
        $stmt = $connexion->prepare($sql);

        if (isset($_SESSION['vehicule']['MatV']) && !empty($_SESSION['vehicule']['MatV'])) {
            $stmt->bind_param('s', $_SESSION['vehicule']['MatV']);
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


            echo "success!";
        } else {
            die("No SESSION set");
        }


        $stmt->close();
        mysqli_close($connexion);
    }
}