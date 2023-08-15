<?php
session_start();
include 'connexion.php';

$NomC = isset($_GET['nom-client']) ? $_GET['nom-client'] : '';
$MatV = isset($_GET['num-vehicule']) ? $_GET['num-vehicule'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';


if ((!empty($NomC) || !empty($MatV)) && !empty($date)) {

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

        if ($stmt->execute()) {

            $results = $stmt->get_result();

            if ($results->num_rows <= 0) {
                echo "PAS DE RESULTATS POUR $NomC le $date";
                die();
            }


            while ($el = $results->fetch_assoc()) {
                if (!empty($el)) {
                    echo "<tr>";
                    foreach ($el as $key => $value) {

                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                } else {
                    die("No results found" . $stmt->error);
                }
            }
        }
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

        if ($stmt->execute()) {

            $results = $stmt->get_result();

            if ($results->num_rows <= 0) {
                die("ERREUR : PAS DE RESULTATS POUR $NomC le $date");
            }


            // Why is it not working 
            echo "<table style='width:85%'>";
            echo "<br><br>";

            echo "<thead> ";
            echo "<tr> ";
            echo "<th> NOM CLIENT </th>";
            echo "<th> MATRICULE VEHICULE </th>";
            echo "<th> DATE </th>";
            echo "</tr> ";
            echo "</thead> ";

            echo "<tbody> ";
            while ($el = $results->fetch_assoc()) {
                if (!empty($el)) {

                    echo "<tr>";
                    foreach ($el as $key => $value) {

                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                } else {
                    die("No results found" . $stmt->error);
                }
            }
            
            echo '</tr>';
            echo "</tbody> ";
            echo "</table>";

        }


    }
} else {
    die('ERREUR : CHAMPS OBLIGATOIRES MANQUANTS');
}
