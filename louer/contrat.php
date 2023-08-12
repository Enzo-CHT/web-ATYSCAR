<?php
session_start();



print_r($_SESSION['vehicule']);
// Si Client et vehicule définis 
if (isset($_SESSION['client']) && isset($_SESSION['vehicule']['MatV'])) {
    $_SESSION['contrat'] = array();
    $date = date('ymdhis', time());
    //creation du contrat  à partir de la date
    $_SESSION['contrat']['NumCont'] = "CTR" . $date;
}

?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <title>CONTRAT DE LOCATION</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module">
        import {
            resetSession
        } from "../js/sessionHandler.js";
        import {
            redirectTo
        } from "../js/actButton.js";


        var condition1 = <?php echo json_encode(isset($_SESSION['client'])); ?>;

        document.getElementById('btn-nouveauClient').onclick = async function() {
            await resetSession("client");
            redirectTo('../fichiers/fichier-clients');
        };
    </script>
</head>

<body>
    <main id="contrat-location">

        <div>
            <div class="left-container">

                <div class="head" id="head">
                    <img class="logo" src="../addons/img/Atys Car.jpg" alt="atyscar-logo.jpg">
                    <br>
                    <div>
                        <a href="rechercher_client.html">
                            <input class="menu-button" onclick="" type="button" value="RECHERCHER CLIENT">
                        </a>
                        <input id="btn-nouveauClient" class="menu-button" type="button" value="NOUVEAU CLIENT">

                    </div>
                    <b><span id="span-stats"><?php echo isset($_SESSION['stats']) ?  $_SESSION['stats'] : '' ?></span></b>


                </div>








                <div class="client">
                    <h1>Client</h1>
                    <div class="container-element">
                        <label for="contrat-nom">Nom</label>
                        <input type="text" name="NomC" id="contrat-nom" value="<?php echo isset($_SESSION['client']['NomC']) ? $_SESSION['client']['NomC'] : ''; ?>" />
                    </div>

                    <div class="container-element">
                        <label for="contrat-prenom">Prénom</label>
                        <input type="text" name="PrenomC" id="contrat-prenom" value="<?php echo isset($_SESSION['client']['PrenomC']) ? $_SESSION['client']['PrenomC'] : ''; ?>" />
                    </div>
                    <div class="container-element">
                        <label for="contrat-date-naissance">Date de naissance</label>
                        <input type="date" name="DatNaisC" id="contrat-date-naissance" value="<?php echo isset($_SESSION['client']['DatNaisC']) ? $_SESSION['client']['DatNaisC'] : ''; ?>" />
                    </div>
                    <div class="container-element">
                        <label for="contrat-lieu-naissance">Lieu de naissance</label>
                        <input type="text" name="LieuNaisCe" id="contrat-lieu-naissance" value="<?php echo isset($_SESSION['client']['LieuNaisC']) ? $_SESSION['client']['LieuNaisC'] : ''; ?>" />
                    </div>
                    <div class="container-element">
                        <label for="contrat-nationalite">Nationalité</label>
                        <input type="text" name="NationaliteC" id="contrat-nationalite" value="<?php echo isset($_SESSION['client']['NationaliteC']) ? $_SESSION['client']['NationaliteC'] : ''; ?>" />
                    </div>
                    <div class="container-element">
                        <label for="contrat-adresse"> Adresse </label>
                        <input type="text" name="AdrRueC" id="contrat-adresse" value="<?php echo isset($_SESSION['client']['AdrRueC']) ? $_SESSION['client']['AdrRueC'] : ''; ?>" />
                    </div>
                    <div class="container-element">
                        <label for="contrat-ville">Ville</label>
                        <input type="text" name="AdrVilC" id="contrat-ville" value="<?php echo isset($_SESSION['client']['AdrVilC']) ? $_SESSION['client']['AdrVilC'] : ''; ?>" />
                    </div>
                    <div class="container-element">
                        <label for="contrat-code-postal">Code Postal</label>
                        <input type="text" name="CodPosCl" id="contrat-code-postal" value="<?php echo isset($_SESSION['client']['CodPosC']) ? $_SESSION['client']['CodPosC'] : ''; ?>" />
                    </div>
                    <div class="container-element">
                        <label for="contrat-telephone">Téléphone</label>
                        <input type="text" name="TelC" id="contrat-telephone" value="<?php echo isset($_SESSION['client']['TelC']) ? $_SESSION['client']['TelC'] : ''; ?>" />
                    </div>
                </div>
                <div class="passeport">
                    <h1>Passport</h1>
                    <div class="container-element">
                        <label for="contrat-num-passeport">Numéro</label>
                        <input type="text" name="NumPasC" id="contrat-num-passeport" value="<?php echo isset($_SESSION['client']['NumPasC']) ? $_SESSION['client']['NumPasC'] : ''; ?>" />
                    </div>
                    <div class="container-element">
                        <label for="contrat-passeport-delivrer-date">Délivré le </label>
                        <input type="date" name="DatDelPasC" id="contrat-passeport-delivrer-date" value="<?php echo isset($_SESSION['client']['DatDelPasC']) ? $_SESSION['client']['DatDelPasC'] : ''; ?>" />
                    </div>
                    <div class="container-element">
                        <label for="contrat-passeport-delivrer-lieu">à </label>
                        <input type="text" name="LieuDelPasC" id="contrat-passeport-delivrer-lieu" value="<?php echo isset($_SESSION['client']['LieuDelPasC']) ? $_SESSION['client']['LieuDelPasC'] : ''; ?>" />
                    </div>
                    <div class="container-element">
                        <label for="contrat-passeport-delivrer-pays">Pays </label>
                        <input type="text" name="PaysDelPasC" id="contrat-passeport-delivrer-pays" value="<?php echo isset($_SESSION['client']['PaysDelPasC']) ? $_SESSION['client']['PaysDelPasC'] : ''; ?>" />
                    </div>
                </div>
            </div>
            <div class="right-container">
                <div class="contrat">
                    <form action="#" method="POST" id="formContrat">
                        <h1>Contrat</h1>
                        <div class="container-element">
                            <label for="contrat-contrat-id">Numéro contrat<span style="color:red">*</span> :</label>
                            <input type="text" name="NumCont" id="contrat-num-id" readonly value="<?php echo isset($_SESSION['contrat']['NumCont']) ? $_SESSION['contrat']['NumCont'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="contrat-contrat-depart-date">Date départ<span style="color:red">*</span> :</label>
                            <input type="date" name="DatDebCont" id="contrat-contrat-depart-date" value="2023-01-01" />
                        </div>
                        <div class="container-element">
                            <label for="contrat-contrat-depart-heure">Heure départ<span style="color:red">*</span> :</label>
                            <input type="time" name="HeurDepCont" id="contrat-contrat-depart-heure" value="00:00:00" />
                        </div>
                        <div class="container-element">
                            <label for="contrat-contrat-retour-date">Date retour prévue<span style="color:red">*</span> :</label>
                            <input type="date" name="DatRetCont" id="contrat-contrat-retour-date" value="2023-01-01" />
                        </div>
                        <div class="container-element">
                            <label for="contrat-contrat-retour-heure">Heure retour prévue<span style="color:red">*</span> :</label>
                            <input type="time" name="HeurRetCont" id="contrat-contrat-retour-heure" value="00:00:00" />
                        </div>
                        <div class="container-element">
                            <label for="contrat-contrat-depart-ville">Ville départ<span style="color:red">*</span> :</label>
                            <input type="text" name="VilDepCont" id="contrat-contrat-depart-ville" value="tmp" />
                        </div>
                        <div class="container-element">
                            <label for="contrat-contrat-retour-ville">Ville retour prévue<span style="color:red">*</span> :</label>
                            <input type="text" name="VilRetCont" id="contrat-contrat-retour-ville" value="tmp" />
                        </div>

                        <div class="utilities-btn">
                            <a href="selectionner-vehicule"><input id="contrat-btn-select-vehicule" class="menu-button" type="button" value="SELECTIONNER VEHICULE"></a>
                            <div>
                                <input id="contrat-btn-enregistrer" class="menu-button" type="button" value="Enregistrer">
                                <input id="contrat-btn-imprimer" class="menu-button" type="button" value="Imprimer">
                                <a href="index.php"><input id="contrat-btn-annuler" class="menu-button" type="button" value="Annuler" onclick="resetSession();"></a>
                            </div>
                    </form>
                </div>



                <div class="radio-lists">
                    <div class="type-client">
                        <?php
                        $CodTypeC = isset($_SESSION['client']['CodTypC']) ? $_SESSION['client']['CodTypC'] : 1;
                        ?>
                        <h2>Type de client</h2>
                        <ul class="list-type-client">
                            <li>
                                <div class="container-element">
                                    <label for="contrat-particulier">Particulier</label>
                                    <input type="radio" name="CodTypC" id="contrat-particulier" value="particulier" <?php echo ($CodTypeC === 1) ? 'checked' : ''; ?> />
                                </div>
                            </li>

                            <li>
                                <div class="container-element">
                                    <label for="contrat-entreprise">Entreprise</label>
                                    <input type="radio" name="CodTypC" id="contrat-entreprise" value="entreprise" <?php echo ($CodTypeC === 2) ? 'checked' : ''; ?> />
                                </div>
                            </li>

                            <li>
                                <div class="container-element">

                                    <label for="contrat-privilegie">Privilégié</label>
                                    <input type="radio" name="CodTypC" id="contrat-privilegie" value="privilegie" <?php echo ($CodTypeC === 3) ? 'checked' : ''; ?> />
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="type-facturation">
                        <h2>Type facturation<span style="color:red">*</span></h2>
                        <ul class="list-type-facturation">
                            <li>
                                <div class="container-element">
                                    <label for="contrat-forfait">Forfait</label>
                                    <input type="radio" name="CodTypTarif" id="contrat-forfait" value="1" />
                                </div>
                            </li>

                            <li>
                                <div class="container-element">
                                    <label for="contrat-durée">Durée</label>
                                    <input type="radio" name="CodTypTarif" id="contrat-durée" value="2" />
                                </div>
                            </li>

                            <li>
                                <div class="container-element">
                                    <label for="contrat-kilmetrage">Kilometrage</label>
                                    <input type="radio" name="CodTypTarif" id="contrat-kilmetrage" value="3" />
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="permis">
                <h1>Permis</h1>
                <div class="container-element">
                    <label for="contrat-num-permis">Numéro</label>
                    <input type="text" name="NumPermisC" id="contrat-num-permis" value="<?php echo isset($_SESSION['NumPermisC']) ? $_SESSION['NumPermisC'] : ''; ?>" />
                </div>
                <div class="container-element">
                    <label for="contrat-permis-delivrer-date">Délivrer le</label>
                    <input type="date" name="DatDelPermiC" id="contrat-permis-delivrer-date" value="<?php echo isset($_SESSION['DatDelPermiC']) ? $_SESSION['DatDelPermiC'] : ''; ?>" />
                </div>
                <div class="container-element">
                    <label for="ficheir-client-permis-delivrer-lieu">à</label>
                    <input type="text" name="LieuDelPermisC" id="contrat-permis-delivrer-lieu" value="<?php echo isset($_SESSION['LieuDelPermisC']) ? $_SESSION['LieuDelPermisC'] : ''; ?>" />
                </div>

            </div>


        </div>


        </div>
    </main>
</body>

<script type="module">
    import {
        setSession
    } from "../js/sessionHandler.js";

    var formId = "formContrat";

    function encapsulateData(formId) {
        const form = document.getElementById(formId);
        const formData = new FormData(form);

        var dataArray = {};
        formData.forEach((value, key) => {
            dataArray[key] = value;
        });

        // Récupération des élements non manuellement remplissable
        dataArray['MatV'] = "<?php echo isset($_SESSION['vehicule']['MatV']) ? $_SESSION['vehicule']['MatV'] : '' ?>";
        dataArray['NumC'] = "<?php echo isset($_SESSION['client']['NumC']) ? $_SESSION['client']['NumC'] : '' ?>";
        dataArray['NumCont'] = "<?php echo isset($_SESSION['contrat']['NumCont']) ? $_SESSION['contrat']['NumCont'] : '' ?>";

        //Ajout manuel de CodTypTarif (cause idk why but it don't work)
        const selectedCodTypTarif = document.querySelector('input[name="CodTypTarif"]:checked');
        dataArray['CodTypTarif'] = selectedCodTypTarif ? selectedCodTypTarif.value : '';


        return dataArray
    }



    document.getElementById('contrat-btn-enregistrer').onclick = async function() {
        var dataArray = encapsulateData(formId);
        $.ajax({
            url: '../php/newContract.php',
            type: 'POST',
            data: {
                'data': JSON.stringify(dataArray),
            },
            success: function(response) {


                console.log('newContract has been executed.');

                // Ajouter non réinitilisation de tout le tableau en cas d'erreur

                /*
                if (response.indexOf('Fail') < 0) {
                    $('#contrat-location').load(document.URL + '#contrat-location');
                }
                */

                // tmp --
                $('#contrat-location').load(document.URL + '#contrat-location');
                // --


                console.log("<?php echo (isset($_SESSION['stats']) ?  $_SESSION['stats'] : '') ?>");
            },
            error: function(xhr, error, status) {
                console.error('Error page (newContract) ', error, status);
            },
        });

    }

    document.getElementById('contrat-btn-imprimer').onclick = function() {
        var dataArray = encapsulateData(formId);

        console.log(dataArray);
        setSession({
            'contrat': dataArray
        });


        var newWindow = window.open('../php/contractPrint.php');

      
        setTimeout(function() {
            if (newWindow) {
                newWindow.close();
            }
        }, 3000); 



    };

    let spanStats = document.getElementById("span-stats");
    if (spanStats.innerHTML != '') {
        setTimeout(function() {
            spanStats.innerHTML = "";
            <?php unset($_SESSION['stats']); ?>
        }, 5000);
    }


    var stats = document.getElementById('span-stats');


    switch (stats.textContent) {
        case "CONTRAT EXISTANT":
            stats.style = "color : red;";
            break;
        case "CHAMP(S) OBLIGATOIRE(S) MANQUANT(S)":
            stats.style = "color : red;";
            break;
        case "CONTRAT ENREGISTRE AVEC SUCCES !":
            stats.style = "color : green;";
            break;
    }
</script>

</html>