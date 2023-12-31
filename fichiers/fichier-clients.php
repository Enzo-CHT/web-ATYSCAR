<?php
session_start();
require "../php/connexion.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>FICHIER CLIENTS</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/sessionHandler.js"></script>
    <script src="../js/clientHandler.js"></script>
</head>

<body>

    <main id="fichier-client">

        <div>
            <form method="POST" action='#' id="clientForm">

                <div>
                    <img class="logo" src="../addons/img/Atys Car.jpg" alt="logo-atyscar.jpg">
                    <b><span id="span-stats"><?php echo isset($_SESSION['stats']) ? $_SESSION['stats'] : ''; ?></span></b>
                </div>
                <div class="container">

                    <div class="left-container">
                        <span id="span-stats"></span>
                        <div class="client">
                            <h3>CLIENT</h3>

                            <div class="container-element">
                                <label for="fichier-client-nom">Nom<span style="color:red;font-weight:bold">*</span></label>
                                <input type="text" name="NomC" id="fichier-client-nom" style="text-transform: uppercase" required value="<?php echo isset($_SESSION['client']['NomC']) ? $_SESSION['client']['NomC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-prenom">Prénom<span style="color:red;font-weight:bold">*</span></label>
                                <input type="text" name="PrenomC" id="fichier-client-prenom" required value="<?php echo isset($_SESSION['client']['PrenomC']) ? $_SESSION['client']['PrenomC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-date-naissance">Date de naissance<span style="color:red;font-weight:bold">*</span></label>
                                <input type="date" name="DatNaisC" id="fichier-client-date-naissance" required value="<?php echo isset($_SESSION['client']['DatNaisC']) ? $_SESSION['client']['DatNaisC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-lieu-naissance">Lieu de naissance</label>
                                <input type="text" name="LieuNaisC" id="fichier-client-lieu-naissance" value="<?php echo isset($_SESSION['client']['LieuNaisC']) ? $_SESSION['client']['LieuNaisC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-nationalite">Nationalité</label>
                                <input type="text" name="NationaliteC" id="fichier-client-nationalite" value="<?php echo isset($_SESSION['client']['NationaliteC']) ? $_SESSION['client']['NationaliteC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-adresse"> Adresse<span style="color:red;font-weight:bold">*</span> </label>
                                <input type="text" name="AdrRueC" id="fichier-client-adresse" value="<?php echo isset($_SESSION['client']['AdrRueC']) ? $_SESSION['client']['AdrRueC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-ville">Ville<span style="color:red;font-weight:bold">*</span></label>
                                <input type="text" name="AdrVilC" id="fichier-client-ville" value="<?php echo isset($_SESSION['client']['AdrVilC']) ? $_SESSION['client']['AdrVilC'] :  ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-code-postal">Code Postal<span style="color:red;font-weight:bold">*</span></label>
                                <input type="text" name="CodPosC" id="fichier-client-code-postal" value="<?php echo isset($_SESSION['client']['CodPosC']) ? $_SESSION['client']['CodPosC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-telephone">Téléphone</label>
                                <input type="text" name="TelC" id="fichier-client-telephone" value="<?php echo isset($_SESSION['client']['TelC']) ? $_SESSION['client']['TelC'] : ''; ?>" />
                            </div>
                        </div>

                        <div class="passeport">
                            <h3>PASSEPORT</h3>
                            <div class="container-element">
                                <label for="fichier-client-num-passeport">Numéro</label>
                                <input type="text" name="NumPasC" id="fichier-client-num-passeport" value="<?php echo isset($_SESSION['client']['NumPasC']) ? $_SESSION['client']['NumPasC'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="fichier-client-delivrer-date">Date de délivrance </label>
                                <input type="date" name="DatDelPasC" id="fichier-client-delivrer-date" value="<?php echo isset($_SESSION['client']['DatDelPasC']) ? $_SESSION['client']['DatDelPasC'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="fichier-client-passeport-delivrer-lieu">Lieu de délivrance </label>
                                <input type="text" name="LieuDelPasC" id="fichier-client-passeport-delivrer-lieu" value="<?php echo isset($_SESSION['client']['LieuDelPasC']) ? $_SESSION['client']['LieuDelPasC'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="fichier-client-passeport-delivrer-pays">Pays délivrance </label>
                                <input type="text" name="PaysDelPasC" id="fichier-client-passeport-delivrer-pays" value="<?php echo isset($_SESSION['client']['PaysDelPasC']) ? $_SESSION['client']['PaysDelPasC'] : ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="right-container">
                        <?php
                        $CodTypeC = isset($_SESSION['client']['CodTypC']) ? $_SESSION['client']['CodTypC'] : 1;
                        ?>



                        <div class="autre">

                            <div class="client-parametres">
                                <div class="radio-lists">
                                    <div class="type-client">
                                        <h2>Type</h2>
                                        <ul>
                                            <li>
                                                <div class="container-element">
                                                    <label for="fichier-client-particulier">Particulier</label>
                                                    <input type="radio" name="CodTypC" id="fichier-client-particulier" value="1" <?php echo ($CodTypeC === 1) ? 'checked' : ''; ?> />
                                                </div>
                                            </li>

                                            <li>
                                                <div class="container-element">
                                                    <label for="fichier-client-entreprise">Entreprise</label>
                                                    <input type="radio" name="CodTypC" id="fichier-client-entreprise" value="2" <?php echo ($CodTypeC === 2) ? 'checked' : ''; ?> />
                                                </div>
                                            </li>

                                            <li>
                                                <div class="container-element">
                                                    <label for="fichier-client-privilegie">Privilégié</label>
                                                    <input type="radio" name="CodTypC" id="fichier-client-privilegie" value="3" <?php echo ($CodTypeC === 3) ? 'checked' : ''; ?> />
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <div class="container-element">
                                    <label for="fichier-client-remise">Remise :</label>
                                    <input type="number" name="remise" id="fichier-client-remise" />
                                </div>

                            </div>

                            <div class="btn-container">
                                <div>
                                    <input class="menu-button" type="button" value="Ajouter" id="btn-ajouter" onclick="ajouterClient();">
                                    <input id="btn-modifier" class="menu-button" type="button" value="Modifier" onclick="modifierClient();">
                                    <input id="btn-supprimer" class="menu-button" type="button" value="Supprimer" onclick="delClient();">
                                </div>

                                <div>
                                    <input id="btn-pre" class="menu-button" type="button" value="Précèdent" onclick="changeClient(1);">
                                    <input id="btn-suiv" class="menu-button" type="button" value="Suivant" onclick="changeClient(-1);">
                                </div>

                                <div>
                                    <input class="menu-button" type="button" value="Selectionner" id="btn-selectionner" onclick="document.location.href = '';">
                                    <input id="btn-annuler" class="menu-button" type="button" value="Annuler" onclick="resetSession('client');document.location.href = '';">
                                </div>

                            </div>

                        </div>
                        <div class="permis">
                            <h3>PERMIS DE CONDUIRE<span style="color:red;font-weight:bold">*</span></h3>
                            <div class="container-element">
                                <label for="fichier-client-num-permis">Numéro<span style="color:red;font-weight:bold">*</span></label>
                                <input type="text" name="NumPermisC" id="fichier-client-num-permis" value="<?php echo isset($_SESSION['client']['NumPermisC']) ? $_SESSION['client']['NumPermisC'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="fichier-client-permis-delivrer-date">Date de délivrance<span style="color:red;font-weight:bold">*</span></label>
                                <input type="date" name="DatDelPermiC" id="fichier-client-permis-delivrer-date" value="<?php echo isset($_SESSION['client']['DatDelPermiC']) ? $_SESSION['client']['DatDelPermiC'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="ficheir-client-permis-delivrer-lieu">Lieu de Délivrance<span style="color:red;font-weight:bold">*</span></label>
                                <input type="text" name="LieuDelPermisC" id="fichier-client-permis-delivrer-lieu" value="<?php echo isset($_SESSION['client']['LieuDelPermisC']) ? $_SESSION['client']['LieuDelPermisC'] : ''; ?>" />
                            </div>
                        </div>


                    </div>
                </div>



                <div class="foot">
                    <div class="autre">
                        <div class="container-element">
                            <label for="fichier-client-autre-adresse">Autre adresse</label>
                            <input style="width:85%" type="text" name="AutreAdr" id="fichier-client-autre-adresse" value="<?php echo isset($_SESSION['client']['AutreAdr']) ? $_SESSION['client']['AutreAdr'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="fichier-client-remarque">Remarque</label>
                            <input style="width:85%" type="text" name="Remarques" id="fichier-client-remarque" value="<?php echo isset($_SESSION['client']['Remarques']) ? $_SESSION['client']['Remarques'] : ''; ?>" />
                        </div>

                    </div>
                </div>

            </form>
        </div>

    </main>

</body>

<script>
    var formId = "clientForm";
    var thisPage = window.location.pathname;


    function ajouterClient() {
        const form = document.getElementById(formId);
        const formData = new FormData(form);


        // Encapsulation des données du client
        var ENCAPS = {
            client: {}
        };
        formData.forEach(function(value, key) {
            ENCAPS['client'][key] = value;
        });

        newClient(ENCAPS);
    }




    function modifierClient() {
        const form = document.getElementById(formId);
        const formData = new FormData(form);


        // Encapsulation des données du client
        var ENCAPS = {
            client: {}
        };
        formData.forEach(function(value, key) {
            ENCAPS['client'][key] = value;
        });
        updateClient(ENCAPS);
    }
</script>

</html>