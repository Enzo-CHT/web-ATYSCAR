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
    <div id="popup" class="popup-overlay"></div>
    <main id="enregistrer-entretien">
        <div>
            <form id="entretienForm" method="POST">

                <div class="head">
                    <div class="box-l">
                        <img class="logo" src="../addons/img/Atys Car.jpg" alt="atyscar-logo">
                        <div class="left-container">
                            <div class="container-element">
                                <label for="enregistrer-entretien-code">Code
                                    Entretien</label>
                                <input type="text" name="code" id="enregistrer-entretien-code" list="code-list" required />
                                <datalist id="code-list">
                                    <?php
                                    //Importation des codes et description des opérations
                                    $DescOpEArray = array(); //Sera uilisé dans le JS pour changer la description en fonction du code
                                    $codes = "SELECT CodeOpE,DescOpE FROM Operation_Entretien;";
                                    if ($result = $connexion->query($codes)) {
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=" . $row['CodeOpE'] . ">" . $row['DescOpE'] . "</option>";
                                                $DescOpEArray[$row['CodeOpE']] = $row['DescOpE'];
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
                                <input class="readonly" type="text" name="description" id="enregistrer-entretien-description" list="descritpion-list" readonly />

                            </div>
                        </div>

                    </div>
                </div>
                <div class="container">

                    <div class="left-container">
                        <div class="container-element">
                            <label for="enregistrer-entretien-vehicule-immatriculation">Immatriculation</label>
                            <input type="text" name="matricule" id="enregistrer-vehicule-immatriculation" list="immatriculation-list" onclick="this.value ='' " />
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
                            <input class="readonly" type="text" name="marque" id="enregistrer-vehicule-marque" list="marque-list" readonly />

                        </div>
                        <div class="container-element">
                            <label for="enregistrer-vehicule-modele">Modèle</label>
                            <input class="readonly" type="text" name="modele" id="enregistrer-vehicule-modele" list="modele-list" readonly />

                        </div>
                        <div class="container-element">
                            <label for="enregistrer-vehicule-kilometrage">Kilometrage</label>
                            <input class="readonly" type="text" name="kilometrage" id="enregistrer-vehicule-kilometrage" readonly required />

                        </div>
                    </div>

                </div>
                <!-- Display status of the request -->
                <span id="span-stat"></span>

                <div class="foot">
                    <div class="box-l">
                        <div class="container-element">
                            <a href="../index.html"><input class="menu-button" type="button" id="btn-annuler" value="Annuler" /></a>
                        </div>
                        <div class="container-element">
                            <input class="menu-button" type="button" id="btn-enregistrer" value="Enregistrer" onclick="showPopup()" />
                        </div>

                    </div>

                </div>
            </form>
        </div>

    </main>
</body>
<script>
    const mainFrame = document.getElementById('enregistrer-entretien');
    var keepVehicule = false;

    immatInputObject = document.getElementById('enregistrer-vehicule-immatriculation');
    codeOperationInputObject = document.getElementById('enregistrer-entretien-code');
    descriptionOutputObject = document.getElementById('enregistrer-entretien-description');

    // Script d'importation des éléments en fonction du véhicule
    immatInputObject.onchange = function() {
        $.ajax({
            url: "../php/vehicule_getDataEntretien.php",
            type: "GET",
            async: false,
            data: {
                matricule: this.value,
            },
            success: function(response) {
                if (response != null) {
                    response = JSON.parse(response);
                    var itemMarque = document.getElementById('enregistrer-vehicule-marque');
                    var itemModele = document.getElementById('enregistrer-vehicule-modele');
                    var itemKilometrage = document.getElementById('enregistrer-vehicule-kilometrage');

                    itemMarque.value = response['marqueVehicule'];
                    itemModele.value = response['modeleVehicule'];
                    itemKilometrage.value = response['kilometrageVehicule'];
                }

            },
            error: function(xhr, error, status) {
                console.error("Can't access to getDataEntretien : ", error, status)
            }

        })
    };

    /// Affiche la description lié au code de l'opération 
    codeOperationInputObject.onchange = function() {
        possibleDescription = <?php echo json_encode($DescOpEArray) ?>;
        descriptionOutputObject.value = possibleDescription[this.value];
    }


    /**@abstract
     * Affiche l'overlay de validation afin de continuer ou non avec le même véhicule
     */
    function showPopup() {
        mainFrame.style.filter = "blur(5px)";
        document.getElementById("popup").style.zIndex = "1";
        $("#popup").load("keepVehicule.php");
        $("#popup").show();

    }

    // Fonction déclenché par showPopup()
    /**@abstract
     * Fonction d'envoie à base de données 
     */
    function send() {

        const formData = new FormData(document.getElementById("entretienForm"));
        var form = {};
        formData.forEach((value, key) => {
            form[key] = value;
        });

        // Ajout de l'entretien dans BDD
        $.ajax({
            url: "../php/addEntretien.php",
            type: 'POST',
            data: {
                'data': JSON.stringify(form),
            },
            success: function(response) {


                if (response.indexOf('SUCCESS') > -1) {

                    // Ajout de validation
                    if (!keepVehicule) {
                        fields = document.querySelectorAll("input:not([type='button'])");
                        fields.forEach(element => {
                            element.value = '';
                        });
                    } else {
                        fields = document.querySelectorAll("input:not([type='button'])");
                        fields.forEach(element => {
                            if (element.id === "enregistrer-entretien-code" || element.id === "enregistrer-entretien-description") {
                                element.value = "";
                            }
                        });
                    }
                    // Affiche de validation 
                    document.getElementById("span-stat").innerHTML = "<p style='color:green;font-weight:bold'>  \
                    Entretien enregistré avec succès </p>";
                } else {
                    document.getElementById("span-stat").innerHTML = "<p style='color:red;font-weight:bold'>  \
                    Une erreur s'est produit. Veuillez réessayez </p>";
                }

                setInterval(function() {
                    document.getElementById("span-stat").innerHTML = "";
                }, 5000)

                // Ajout d'erreur
            }
        })


    }
</script>

</html>