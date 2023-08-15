<?php session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>HISTORIQUE</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <main id="historique">
        <div>
            <img class="logo" src="addons/img/Atys Car.jpg" alt="atyscar-logo">
            <div class="container">

                <div class="top">
                    <div class="box-c">
                        <div class="left-container">
                            <b>Recherche</b>
                            <div class="container-element">
                                <label for="historique-nom-client">Nom
                                    Client</label>
                                <input type="text" id="historique-nom-client" name="nom-client" list="client-list" value="CHETAH">
                                <datalist id="client-list">

                                    <?php
                                    include 'php/connexion.php';

                                    $sql = "SELECT NomC FROM CLIENT";
                                    $stmt = $connexion->query($sql);

                                    if ($stmt->num_rows > 0) {

                                        while ($row = $stmt->fetch_row()) {
                                            echo '<option>' . $row[0] . '</option>';
                                        }
                                    }



                                    ?>

                                    <!-- Option ICI -->
                                </datalist>
                            </div>
                            <div class="container-element">
                                <label for="historique-num-vehicule">Numéro
                                    Véhicule</label>
                                <input type="text" id="historique-num-vehicule" name="num-vehicule" list="vehicule-list">
                                <datalist id="vehicule-list">

                                    <?php
                                    include 'php/connexion.php';

                                    $sql = "SELECT MatV FROM VEHICULE";
                                    $stmt = $connexion->query($sql);

                                    if ($stmt->num_rows > 0) {

                                        while ($row = $stmt->fetch_row()) {
                                            echo '<option>' . $row[0] . '</option>';
                                        }
                                    }

                                    ?>
                                    <!-- Option ICI -->
                                </datalist>

                            </div>
                        </div>

                    </div>

                    <div class="right-container">
                        <div class="container-element">
                            <label for="historique-date">Date</label>
                            <input type="date" id="historique-date" name="date" value="2023-01-01">

                        </div>

                    </div>

                </div>

                <div class="bottom">
                    <div class="btn-container">
                        <div class="left-container">
                            <div>
                                <input type="button" class="menu-button" id="btn-display-ref-client" value="AFFICHER REFERENCES CLIENT" onclick="buildDisplay()">
                                <input type="button" class="menu-button" id="btn-display-ref-vehicule" value="AFFICHER REFERENCES VEHICULE">

                            </div>
                            <div>
                                <input type="button" class="menu-button" id="btn-print-ref-client" value="IMPRIMER REFERENCES CLIENT">
                                <input type="button" class="menu-button" id="btn-print-ref-client" value="IMPRIMER REFERENCES VEHICULE">

                            </div>
                        </div>
                        <div class="right-container">
                            <input type="button" class="menu-button" id="his-btn-aide" value="AIDE">
                            <a href="index.html"><input type="button" class="menu-button" id="his-btn-fermer" value="FERMER"></a>
                        </div>
                    </div>
                </div>

                <span id="displayer"></span>
                <span id="span-stat"></span>
            </div>

        </div>
    </main>
</body>
<script>
    let nomClientInput = document.getElementById('historique-nom-client');
    let numVehiculeInput = document.getElementById('historique-num-vehicule');
    let dateInput = document.getElementById('historique-date');
    let spanStats = document.getElementById('span-stat');

    function buildDisplay() {
        console.log("starting to build display..");


        $.ajax({
            url: 'php/referenceGet.php',
            type: 'GET',
            data: {
                'nom-client': nomClientInput.value,
                'num-vehicule': numVehiculeInput.value,
                'date': dateInput.value,
            },
            success: function(response) {
                
                console.log('referenceGet has been executed.');
                let capsul = response;

                $("#displayer").html(capsul);

            },
            error: function(xhr, error, status) {
                console.error('Page error (referenceGet) : ', error, status);
            }
        });



        console.log("finish building display..");

    }
</script>

</html>