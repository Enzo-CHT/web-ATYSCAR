<?php session_start();

unset($_SESSION['vehicule']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <title>SELECTIONNER VEHICULE</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    </script>
</head>

<body>
    <main id="selectionner-vehicule">
        <span id="raise-error"></span>
        <div>

            <img class="logo" src="../addons/img/Atys Car.jpg" alt="atyscar-logo">
            <div class="left-container">
                <div class="radio-lists">
                    <h2>Carburant</h2>

                    <?php $CarbRadio = isset($_SESSION['vehicule']['CarV']) ? $_SESSION['vehicule']['CarV'] : '' ?>
                    <ul>
                        <li>

                            <input id="selectionner-vehicule-diesel" type="radio" name="CarbV" value="1" <?php echo ($CarbRadio == 1) ? 'checked' : ''; ?>>
                            <label for="selectionner-vehicule-type-diesel">Diesel</label>

                        </li>
                        <li>

                            <input id="selectionner-vehicule-type-essence" type="radio" name="CarbV" value="2" <?php echo ($CarbRadio == 2) ? 'checked' : ''; ?>>
                            <label for="selectionner-vehicule-type-essence">Essence</label>

                        </li>
                </div>


                <!-- Remplissage dynamique par script -->

            </div>


            <div class="right-container">
                <div class="container-element">
                    <label for="selectionner-vehicule-nombre-place">Nombre de places</label>
                    <input type="number" name="NbPlV" id="selectionner-vehicule-nombre-place" min='1' value="<?php echo isset($_SESSION['vehicule']['NbPlV']) ? $_SESSION['vehicule']['NbPlV'] : '1' ?>" />
                </div>
                <div class="container-element">
                    <label for="selectionner-vehicule-puissance">Puissance</label>
                    <input type="number" name="PuisV" id="selectionner-vehicule-puissance" min="0" value="<?php echo isset($_SESSION['vehicule']['PuisV']) ? $_SESSION['vehicule']['PuisV'] : '0' ?>" />

                </div>
                <div class="container-element">
                    <label for="selectionner-vehicule-marque">Marque </label>
                    <input type="text" name="MarV" id="selectionner-vehicule-marque" list="marque-list" value="<?php echo isset($_SESSION['vehicule']['MarV']) ? $_SESSION['vehicule']['MarV'] : '' ?>" />
                    <datalist id="marque-list">
                        <option value=""></option>
                        <!-- Remplissage dynamique par script -->

                    </datalist>
                </div>
                <div class="container-element">
                    <label for="selectionner-vehicule-modele">Modèle</label>
                    <input type="text" name="ModV" id="selectionner-vehicule-modele" list="modele-list" value="<?php echo isset($_SESSION['vehicule']['ModV']) ? $_SESSION['vehicule']['ModV'] : '' ?>" />
                    <datalist id="modele-list">
                        <option value=""></option>
                        <!-- Remplissage dynamique par script -->

                    </datalist>
                </div>
                <div class="container-element">
                    <label for="selectionner-vehicule-couleur">Couleur</label>
                    <input type="text" name="CoulV" id="selectionner-vehicule-couleur" list="couleur-list" value="<?php echo isset($_SESSION['vehicule']['CoulV']) ? $_SESSION['vehicule']['CoulV'] : '' ?>" />
                    <datalist id="couleur-list">
                        <option value=""></option>
                        <!-- Remplissage dynamique par script -->

                    </datalist>
                </div>
                <br>
                <div class="container-element">
                    <input id="btn-ok" class="menu-button" type="button" value="Ok">
                    <a href="contrat.php"><input id="btn-annuler" class="menu-button" type="button" value="Annuler"></a>

                </div>
            </div>

        </div>
    </main>
    <script type="module" type="text/javascript">
        import {
            setSession
        } from "../js/sessionHandler.js";
        import {
            redirectTo
        } from "../js/actButton.js";


        $(document).ready(function() {
            // Function to fetch and update options

            //Listes des liens
            var lists = {
                MarV: 'marque-list',
                ModV: 'modele-list',
                CoulV: 'couleur-list',

            };

            var input = {
                MarV: 'selectionner-vehicule-marque',
                ModV: 'selectionner-vehicule-modele',
                CoulV: 'selectionner-vehicule-couleur',
                PuisV: 'selectionner-vehicule-puissance',
                NbPlV: 'selectionner-vehicule-nombre-place',

            };

            // Recupération initial 
            fetchOptions();
            // Ajoute un listener pour chaque element 
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    fetchOptions();
                }
            });

            function fetchOptions() {

                var dataEncaps = {};
                for (var el in input) {
                    dataEncaps[el] = document.querySelector('#' + input[el]).value;
                }

                //console.log(JSON.stringify(dataEncaps));

                $.ajax({
                    url: '../php/vehiculeSelector', // 
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        options: JSON.stringify(dataEncaps), // Encodage JSON
                    },
                    success: function(response) {
                        // Update the HTML with the received options
                        var dataDecaps = response;
                        //console.log(dataDecaps);
                        for (var key in dataDecaps) {

                            if (dataDecaps.hasOwnProperty(key)) { // Si key appartient au array
                                var innerArray = dataDecaps[key]; //Seclection du array interne

                                if (innerArray.length > 1) {
                                    //Définition des options pour chaque champs

                                    var selectElement = document.getElementById(lists[key]); //Récupération de la liste associée à key

                                    if (selectElement != null) { //Vérifie si l'element existe dans la list
                                        selectElement.innerHTML = ''; //Vider la liste
                                        for (var i = 0; i < innerArray.length; i++) { //Ajout des elements mis à jour
                                            var optionElement = document.createElement('option');
                                            optionElement.textContent = innerArray[i];
                                            selectElement.appendChild(optionElement);
                                        }

                                    }


                                } else { // S'il n'existe qu'un element, afficher directement
                                    var selectElement = document.querySelector('#' + input[key]);
                                    selectElement.value = innerArray[0];
                                }
                            }
                        }
                    },

                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            }

        });





        document.getElementById('btn-ok').onclick = async function() {
            var dataArray = {};
            var inputs = document.querySelectorAll('input:not(.menu-button)'); //Récupère tous les inputs

            // Récupère les radio
            inputs.forEach(function(element) {
                var elementName = element.name;


                if (elementName === "CarbV") {

                    if (element.checked) {
                        var typeCarbV = [
                            "diesel",
                            "essence"
                        ];

                        dataArray[elementName] = typeCarbV[(element.value) - 1];

                    }

                } else {
                    dataArray[elementName] = element.value;
                }
            });

            console.log(dataArray);
            await setSession({
                vehicule: dataArray
            });

            console.log(dataArray);
            await $.ajax({
                url: '../php/vehiculeGet.php', // Récupère la voiture
                type: 'GET',
                data : {
                    data : JSON.stringify(dataArray),
                },
                success: function(response) {
                    console.log('carGet has been executed!');

                },
                error: function(xhr, status, error) {
                    console.error(error, status);
                }
            });


            /// Add condition to raise error if element is not found
            redirectTo("../louer/contrat")
        }
    </script>
</body>

</html>