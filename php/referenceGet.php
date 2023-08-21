<?php
session_start();
include 'connexion.php';

$NomC = isset($_GET['nom-client']) ? $_GET['nom-client'] : '';
$MatV = isset($_GET['num-vehicule']) ? $_GET['num-vehicule'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';


if ((!empty($NomC) || !empty($MatV)) && !empty($date)) {

    // Déclaration pour réutiliser dans la zone d'effet
    $sql;
    $stmt;


    if (!empty($NomC)) {

        $sql = "SELECT contrat.NumC, contrat.MatV, contrat.DatDebCont, contrat.DatRetCont 
                            FROM CONTRAT
                            INNER JOIN CLIENT ON contrat.NumC = client.NumC
                            WHERE client.NomC = ? 
                            AND contrat.DatDebCont <= ?
                            AND contrat.DatRetCont >= ? ";

        $stmt = $connexion->prepare($sql);

        if (!$stmt) {
            die('Connexion error : ' . $connexion->error);
        }

        $stmt->bind_param('sss', $NomC, $date, $date);

        
    } else {


        $sql = "SELECT contrat.NumC, contrat.MatV, contrat.DatDebCont, contrat.DatRetCont 
                            FROM CONTRAT
                            INNER JOIN CLIENT ON contrat.NumC = client.NumC
                            WHERE contrat.MatV = ? 
                            AND contrat.DatDebCont <= ?
                            AND contrat.DatRetCont >= ? ";

        $stmt = $connexion->prepare($sql);

        if (!$stmt) {
            die('Connexion error : ' . $connexion->error);
        }

        $stmt->bind_param('sss', $MatV, $date, $date);

        
    }


    if ($stmt->execute()) {

        $results = $stmt->get_result();

        if ($results->num_rows <= 0) {
            die(json_encode("ERREUR : PAS DE RESULTATS POUR $NomC $MatV le $date"));
        }


        $cpt = 0;
        $response = array();
        while ($el = $results->fetch_assoc()) {
            if (!empty($el)) {
                foreach ($el as $key => $value) {

                    // Changement des noms pour éviter de faire fuiter les attributs de la base
                    switch ($key) {
                        case 'NumC':
                            $key = 'numClient';
                            break;
                        case 'MatV':
                            $key = 'matVehicule';
                            break;
                        case 'DatDebCont':
                            $key = 'dateDebut';
                            break;
                        case 'DatRetCont':
                            $key = 'dateFin';
                            break;
                    }

                    $response[$cpt][$key] = $value;
                }
                $cpt++;
            } else {
                die("ERREUR : No results found" . $stmt->error);
            }
        }

        print_r(json_encode($response));
    }
} else {
    die(json_encode('ERREUR : CHAMPS OBLIGATOIRES MANQUANTS'));
}
