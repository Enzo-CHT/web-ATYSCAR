<?php
session_start();
// Modification possible à terme
// Mise à jour session en fonction des contrats client + infos clients + entretien véhicule ??? 




$session = isset($_POST['session']) ? $_POST['session'] : '';
$data = isset($_POST['data']) ? $_POST['data'] : 'NONE';


switch ($session) {
    case "client":
        updateClient();
        echo "client updated";
        break;
    case "vehicule":
        updateVehicule();
        echo "vehicule updated";
        break;
    case "contrat":
        updateContract($data);
        echo "contrat updated";
        break;
    default:
        updateContract($data);
        updateClient();
        updateVehicule();
        echo "\nall session updated";

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

        if (!$result) {
            die('No result found (client)');
        }

        if (!empty($result)) {

            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    $_SESSION['client'][$key] = $value;
                }
            }
        }
        echo "Client : SUCCESS";


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


        $stmt->bind_param('s', $matv);
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }
        $result = $stmt->get_result();

        if (!$result) {
            die('No result found (vehicule)');
        }

        if (!empty($result)) {

            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    $_SESSION['vehicule'][$key] = $value;
                }
            }
        }


        echo "Vehicule : SUCCESS";



        $stmt->close();
        mysqli_close($connexion);
    } else {
        die("No SESSION set");
    }
}


function updateContract($data)
{
    require 'connexion.php';

    if (!empty($data) && $data != 'NONE') {
        $sql = "SELECT Contrat.NumCont, Contrat.DatDebCont,Contrat.HeurDepCont, Contrat.DatRetCont,Contrat.HeurRetCont,Contrat.VilDepCont,Contrat.VilRetCont,Contrat.NumC,Contrat.MatV,Contrat.CodTypTarif,tarifer.periode FROM CONTRAT INNER JOIN Tarifer ON Contrat.NumCont = Tarifer.id_contrat WHERE NumCont=?";
        $stmt = $connexion->prepare($sql);


        $stmt->bind_param('s', $data);
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }
        $result = $stmt->get_result();

        if (!$result) {
            die('No result found (contrat)');
        }

        if ($result->num_rows > 0) {


            while ($row = $result->fetch_assoc()) {


                foreach ($row as $key => $value) {
                    if ($key == 'periode') {
                        switch ($value) {
                            case 'HIV':
                                $value = 1;
                                break;
                            case 'ETE':
                                $value = 2;
                                break;
                            case 'VAC':
                                $value = 3;
                                break;
                        }
                    }

                    $_SESSION['contrat'][$key] = $value;

                    // Utiliser pour récupérer les autres sessions après chargement de celle ci
                    if ($key == 'MatV') {
                        $_SESSION['vehicule']['MatV'] = $value;
                    }
                    if ($key == 'NumC') {
                        $_SESSION['client']['NumC'] = $value;
                    }
                }
            }

            echo "Contract : SUCCESS";
        } else {
            die("No result");
        }





        $stmt->close();
        mysqli_close($connexion);
    } else {
        die('Contract : No DATA embedded.');
    }
}
