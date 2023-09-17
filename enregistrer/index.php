<?php
session_start();
include "../php/connexion.php";



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>ENREGISTRER ENTRETIEN</title>
</head>

<body>
    <main id="enregistrer-entretien">
        <div>
            <div class="head">
                <div class="box-l">
                    <img class="logo" src="../addons/img/Atys Car.jpg" alt="atyscar-logo">
                    <div class="left-container">
                        <div class="container-element">
                            <label for="enregistrer-entretien-code">Code
                                Entretien</label>
                            <input type="text" name="entretien-code" id="enregistrer-entretien-code" list="code-list" />
                            <datalist id="code-list">
                                <?php

                                $codes = "SELECT CodeOpE FROM Operation_Entretien;";
                                if ($result = $connexion->query($codes)) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            foreach ($row as $element) {
                                                echo "<option name=" . $element . ">" . $element . "</option>";
                                            }
                                        }
                                    }
                                }

                                ?>
                            </datalist>
                        </div>
                    </div>

                    <div class="right-container">
                        <div class="container-element">
                            <label for="enregistrer-entretien-description">Description</label>
                            <input type="text" name="entretien-description" id="enregistrer-entretien-description" list="descritpion-list" readonly />

                        </div>
                    </div>

                </div>
            </div>
            <div class="container">

                <div class="left-container">
                    <div class="container-element">
                        <label for="enregistrer-entretien-vehicule-immatriculation">Immatriculation</label>
                        <input type="text" name="vehicule-immatriculation" id="enregistrer-vehicule-immatriculation" list="immatriculation-list" onclick="this.value ='' " />
                        <datalist id="immatriculation-list">
                            <!-- Entrer les options ici -->
                            <?php

                            $codes = "SELECT MatV,ImmatV FROM Vehicule;";
                            if ($result = $connexion->query($codes)) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        echo "<option name=" . $row['MatV'] . " value=" . $row['MatV'] . " > Immatriculation : " . $row['ImmatV'] . "</option>";
                                    }
                                }
                            }

                            ?>
                        </datalist>
                    </div>
                    <div class="container-element">
                        <label for="enregistrer-entretien-date">Date
                            entretien</label>
                        <input type="date" name="date" id="enregistrer-entretien-date" />

                    </div>

                </div>
                <div class="right-container">
                    <div class="container-element">
                        <label for="enregistrer-vehicule-marque">Marque</label>
                        <input class="readonly" type="text" name="vehicule-marque" id="enregistrer-vehicule-marque" list="marque-list" readonly />

                    </div>
                    <div class="container-element">
                        <label for="enregistrer-vehicule-modele">Modèle</label>
                        <input class="readonly" type="text" name="vehicule-modele" id="enregistrer-vehicule-modele" list="modele-list" readonly />

                    </div>
                    <div class="container-element">
                        <label for="enregistrer-vehicule-kilometrage">Kilometrage</label>
                        <input class="readonly" type="text" name="vehicule-kilometrage" id="enregistrer-vehicule-kilometrage" readonly />

                    </div>
                </div>

            </div>
            <div class="foot">
                <div class="box-l">
                    <div class="container-element">
                        <a href="../index.html"><input class="menu-button" type="button" id="btn-annuler" value="Annuler" /></a>
                    </div>
                    <div class="container-element">
                        <input class="menu-button" type="button" id="btn-enregistrer" value="Enregistrer" />
                    </div>

                </div>

            </div>
        </div>

    </main>
</body>
<script>
    // Script d'importation des éléments en fonction du véhicule


    immatInputObject = document.getElementById('enregistrer-vehicule-immatriculation');
    immatInputObject.onchange = function () {
        $.ajax({
            url: "../php/vehicule_getDataEntretien.php",
            type: "GET",
            async: false,
            data: {
                matricule: this.value,
            },
            success: function(response) {
                console.log('blup');
                importData(response);
            },
            error: function(xhr, error, status) {
                console.error("Can't access to getDataEntretien : ", error, status)
            }

        })
    };



    function importData(array) {
        var itemMarque = document.getElementById('enregistrer-vehicule-marque');
        var itemModele = document.getElementById('enregistrer-vehicule-modele');
        var itemKilometrage = document.getElementById('enregistrer-vehicule-kilometrage');

        itemMarque.value = array['marqueVehicule'];
        itemModele.value = array['modeleVehicule'];
        itemKilometrage.value = array['kilometrageVehicule'];
    }
</script>

</html>