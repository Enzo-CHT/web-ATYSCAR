<?php session_start();
print_r($_SESSION) ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <title>SELECTIONNER VEHICULE</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module">
        import {
            setSession
        } from "../js/sessionHandler.js";
        import {
            redirectTo
        } from "../js/actButton.js";

        document.getElementById('btn-ok').onclick = function() {
            var dataArray = {};
            var inputElements = document.querySelectorAll('input:not(.menu-button)'); //Récupère tous les inputs
            // Récupère les radio
            inputElements.forEach(function(element) {
                dataArray[element.getAttribute('name')] = element.value;
            });
            setSession({
                car: dataArray
            });
            redirectTo("../louer/contrat")

        }
    </script>
</head>

<body>
    <main id="selectionner-vehicule">
        <div>

            <img class="logo" src="../addons/Atys Car.jpg" alt="atyscar-logo">

            <div class="left-container">
                <div class="radio-lists">
                    <h2>Carburant</h2>

                    <?php $CarbRadio =  isset($_SESSION['car']['CarV']) ? $_SESSION['car']['CarV'] : '' ?>
                    <ul>
                        <li>

                            <input id="selectionner-vehicule-diesel" type="radio" name="CarV" value="1" <?php echo ($CarbRadio == 1) ? 'checked' : ''; ?>>
                            <label for="selectionner-vehicule-type-diesel">Diesel</label>

                        </li>
                        <li>

                            <input id="selectionner-vehicule-type-essence" type="radio" name="CarV" value="2" <?php echo ($CarbRadio == 2) ? 'checked' : ''; ?>>
                            <label for="selectionner-vehicule-type-essence">Essence</label>

                        </li>
                </div>


                <!-- Remplissage dynamique par script -->

            </div>


            <div class="right-container">
                <div class="container-element">
                    <label for="selectionner-vehicule-nombre-place">Nombre de places</label>
                    <input type="number" name="NbPlV" id="selectionner-vehicule-nombre-place" min='1' value="<?php echo isset($_SESSION['car']['NbPlV']) ? $_SESSION['car']['NbPlV'] : '1' ?>" />
                </div>
                <div class="container-element">
                    <label for="selectionner-vehicule-puissance">Puissance</label>
                    <input type="number" name="PuisV" id="selectionner-vehicule-puissance" min="0" value="<?php echo isset($_SESSION['car']['PuisV']) ? $_SESSION['car']['PuisV'] : '0' ?>" />

                </div>
                <div class="container-element">
                    <label for="selectionner-vehicule-marque">Marque </label>
                    <input type="text" name="MarV" id="selectionner-vehicule-marque" list="marque-list" value="<?php echo isset($_SESSION['car']['MarV']) ? $_SESSION['car']['MarV'] : '' ?>" />
                    <datalist id="marque-list">
                        <option value=""></option>
                        <!-- Remplissage dynamique par script -->

                    </datalist>
                </div>
                <div class="container-element">
                    <label for="selectionner-vehicule-modele">Modèle</label>
                    <input type="text" name="ModV" id="selectionner-vehicule-modele" list="modele-list" value="<?php echo isset($_SESSION['car']['ModV']) ? $_SESSION['car']['ModV'] : '' ?>" />
                    <datalist id="modele-list">
                        <option value=""></option>
                        <!-- Remplissage dynamique par script -->

                    </datalist>
                </div>
                <div class="container-element">
                    <label for="selectionner-vehicule-couleur">Couleur</label>
                    <input type="text" name="CoulV" id="selectionner-vehicule-couleur" list="couleur-list" value="<?php echo isset($_SESSION['car']['CoulV']) ? $_SESSION['car']['CoulV'] : '' ?>" />
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
    <script>
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
                PuisV: 'selectionner-vehicule-nombre-place',
                NbPlV: 'selectionner-vehicule-puissance',

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
                    url: '../php/carSelector', // Replace with the path to your PHP script
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
                            console.log(key);
                            if (dataDecaps.hasOwnProperty(key)) { // Si key appartient au array
                                var innerArray = dataDecaps[key]; //Seclection du array interne
                                console.log(innerArray);
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
    </script>
</body>

</html>