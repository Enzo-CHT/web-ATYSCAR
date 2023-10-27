<?php
include("../php/connexion.php");
$callerPage = isset($_GET["callerPage"]) ? $_GET["callerPage"] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/sessionHandler.js"></script>

    <title>RECHERCHER CLIENT</title>
</head>

<body>
    <main id="rechercher-client">
        <div>
            <span id="raise-error"></span>

            <form action="../php/searchClient.php" method="post">
                <input id="contract-id" type="text" list=datalist>
                <datalist id=datalist>
                    <?php
                    include("../php/connexion.php");

                    if ($callerPage === "contrat.php") {

                        $sql = 'SELECT Client.NumC, Client.NomC, Client.PrenomC FROM  Client';
                        $stmt = $connexion->prepare($sql);
                        if ($stmt->execute()) {
                            $res = $stmt->get_result();
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    echo '<option>' . $row['PrenomC'] . ' ' . $row['NomC'] . ' : ' . $row['NumC'] . '</option>';
                                }
                            }
                        }
                    } else if ($callerPage === 'index.html') {
                        $sql = 'SELECT Contrat.NumCont FROM  Contrat';
                        $stmt = $connexion->prepare($sql);
                        if ($stmt->execute()) {
                            $res = $stmt->get_result();
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    echo '<option>' . $row['NumCont'] . '</option>';
                                }
                            }
                        }
                    }
                    ?>
                </datalist>
                <span id="btn-action">
                    <input id="btn-chercher" class="menu-button" type="button" value="CHERCHER" onclick="lookFor()">
                </span>
                <input type="button" class="menu-button" value="Annuler" onclick="document.location.href=''">
            </form>
        </div>
    </main>

</body>
<script>
    // Etapes de recherche.
    function lookFor() {
        const data = document.getElementById('contract-id').value;

        // Présence du CTR = potentielle contrat
        if (data.substring(0, 3) == "CTR") {
            // Appel de recherche du contrat avec callback en cas d'erreur
            lookForContract(function(data) {
                lookForClient(data)
            }, data);
        } else {
            lookForClient(data);
        }


    }


    function lookForContract(callback, data) {
        $.ajax({
            url: '../php/sessionUpdater.php',
            type: 'POST',
            async: false,
            data: {
                session: 'all',
                data: data,
            },
            success: function(response) {
                // Si aucun succès dans la réponse, appel du callback
                if (response.indexOf('SUCCESS') > -1) {
                    //console.log("contract updated.");
                    window.location.href = "edit-contrat";

                } else {
                    callback(data);
                }

            },
            error: function(xhr, error, status) {
                console.error('Page error in (recherche_element) : ', error, status);
            }
        });

    }





    function lookForClient(data) {
        $.ajax({
            url: '../php/searchClient.php',
            type: 'GET',
            async: false,
            data: {
                client: data
            },
            success: function(response) {
                //console.log("searchClient has been executed.");

                if (response.indexOf('SUCCESS') > -1) {
                    $('body').load('../fichiers/fichier-clients.php');
                } else {

                    document.getElementById('raise-error').innerHTML = 'Aucun correspondance';
                }
            },
            error: function(xhr, status, error) {
                console.error("Page error (searchClient) : ", error, status);
            }
        })
    }
</script>

</html>