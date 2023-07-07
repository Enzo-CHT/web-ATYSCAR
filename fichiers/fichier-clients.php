<?php
session_start();
require "../php/connexion.php";
//print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script type="module">
        import { newClient, updateClient, delClient, changeClient } from "../js/clientHandler.js";
        import { resetSession} from "../js/sessionHandler.js";
        
        var formId="clientForm";
        var thisPage = window.location.pathname;
        document.getElementById('btn-enregistrer').onclick =function() {newClient(formId,'../louer/contrat'); }
        document.getElementById('btn-annuler').onclick =function() {resetSession();}
        document.getElementById('btn-modifier').onclick = function() {updateClient(formId);}
        document.getElementById('btn-supprimer').onclick = function() {delClient(thisPage);}
        document.getElementById('btn-suiv').onclick =function() {changeClient(1,thisPage);}
        document.getElementById('btn-pre').onclick =function() {changeClient(-1,thisPage);}
        


    </script>


    <title>FICHIER CLIENTS</title>
</head>

<body>

    <main  id="fichier-client">
        
        <div>
        <form method="POST" action='#' id="clientForm">
            
            <div>
                <img class="logo" src="../addons/Atys Car.jpg" alt="logo-atyscar.jpg">
            </div>
                <div class="container">
               
                    <div class="left-container">
                        <span id="raise-error"></span>
                        <div class="client">
                            <h3>CLIENT</h3>

                            <div class="container-element">
                                <label for="fichier-client-nom">Nom<span style="color:red">*</span></label>
                                <input type="text" name="NomC" id="fichier-client-nom" style="text-transform: uppercase" required value="<?php echo isset($_SESSION['NomC']) ? $_SESSION['NomC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-prenom">Prénom<span style="color:red">*</span></label>
                                <input type="text" name="PrenomC" id="fichier-client-prenom" required value="<?php echo isset($_SESSION['PrenomC']) ? $_SESSION['PrenomC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-date-naissance">Date de naissance<span style="color:red">*</span></label>
                                <input type="date" name="DatNaisC" id="fichier-client-date-naissance" required value="<?php echo isset($_SESSION['DatNaisC']) ? $_SESSION['DatNaisC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-lieu-naissance">Lieu de naissance</label>
                                <input type="text" name="LieuNaisC" id="fichier-client-lieu-naissance" value="<?php echo isset($_SESSION['LieuNaisC']) ? $_SESSION['LieuNaisC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-nationalite">Nationalité</label>
                                <input type="text" name="NationaliteC" id="fichier-client-nationalite" value="<?php echo isset($_SESSION['NationaliteC']) ? $_SESSION['NationaliteC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-adresse"> Adresse </label>
                                <input type="text" name="AdrRueC" id="fichier-client-adresse" value="<?php echo isset($_SESSION['AdrRueC']) ? $_SESSION['AdrRueC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-ville">Ville</label>
                                <input type="text" name="AdrVilC" id="fichier-client-ville" value="<?php echo isset($_SESSION['AdrVilC']) ? $_SESSION['AdrVilC'] :  ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-code-postal">Code Postal</label>
                                <input type="text" name="CodPosC" id="fichier-client-code-postal" value="<?php echo isset($_SESSION['CodPosC']) ? $_SESSION['CodPosC'] : ''; ?>" />
                            </div>
                            <div class="container-element">

                                <label for="fichier-client-telephone">Téléphone</label>
                                <input type="text" name="TelC" id="fichier-client-telephone" value="<?php echo isset($_SESSION['TelC']) ? $_SESSION['TelC'] : ''; ?>" />
                            </div>
                        </div>

                        <div class="passeport">
                            <h3>PASSEPORT</h3>
                            <div class="container-element">
                                <label for="fichier-client-num-passeport">Numéro</label>
                                <input type="text" name="NumPasC" id="fichier-client-num-passeport" value="<?php echo isset($_SESSION['NumPasC']) ? $_SESSION['NumPasC'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="fichier-client-delivrer-date">Date de délivrance </label>
                                <input type="date" name="DatDelPasC" id="fichier-client-delivrer-date" value="<?php echo isset($_SESSION['DatDelPasC']) ? $_SESSION['DatDelPasC'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="fichier-client-passeport-delivrer-lieu">Lieu de délivrance </label>
                                <input type="text" name="LieuDelPasC" id="fichier-client-passeport-delivrer-lieu" value="<?php echo isset($_SESSION['LieuDelPasC']) ? $_SESSION['LieuDelPasC'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="fichier-client-passeport-delivrer-pays">Pays délivrance </label>
                                <input type="text" name="PaysDelPasC" id="fichier-client-passeport-delivrer-pays" value="<?php echo isset($_SESSION['PaysDelPasC']) ? $_SESSION['PaysDelPasC'] : ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="right-container">
                        <?php
                        $CodTypeC = isset($_SESSION['CodTypC']) ? $_SESSION['CodTypC'] : 1;
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
                                    <input id="btn-modifier" class="menu-button" type="button" value="Modifier">
                                    <input id="btn-supprimer" class="menu-button" type="button" value="Supprimer">
                                </div>

                                <div>
                                    <input id="btn-pre" class="menu-button" type="button" value="Précèdent">
                                    <input id="btn-suiv" class="menu-button" type="button" value="Suivant">
                                </div>

                                <div>
                                    <input class="menu-button" type="button" value="Enregistrer" id="btn-enregistrer">
                                    <a href="../louer/contrat.php"><input  id="btn-annuler" class="menu-button" type="button" value="Annuler" onclick="resetSession();"></a>
                                </div>

                            </div>

                        </div>
                        <div class="permis">
                            <h3>PERMIS DE CONDUIRE</h3>
                            <div class="container-element">
                                <label for="fichier-client-num-permis">Numéro</label>
                                <input type="text" name="NumPermisC" id="fichier-client-num-permis" value="<?php echo isset($_SESSION['NumPermisC']) ? $_SESSION['NumPermisC'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="fichier-client-permis-delivrer-date">Date de délivrance</label>
                                <input type="date" name="DatDelPermiC" id="fichier-client-permis-delivrer-date" value="<?php echo isset($_SESSION['DatDelPermiC']) ? $_SESSION['DatDelPermiC'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="ficheir-client-permis-delivrer-lieu">Lieu de Délivrance</label>
                                <input type="text" name="LieuDelPermisC" id="fichier-client-permis-delivrer-lieu" value="<?php echo isset($_SESSION['LieuDelPermisC']) ? $_SESSION['LieuDelPermisC'] : ''; ?>" />
                            </div>
                        </div>


                    </div>
                </div>



                <div class="foot">
                    <div class="autre">
                        <div class="container-element">
                            <label for="fichier-client-autre-adresse">Autre adresse</label>
                            <input style="width:85%" type="text" name="AutreAdr" id="fichier-client-autre-adresse" value="<?php echo isset($_SESSION['AutreAdr']) ? $_SESSION['AutreAdr'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="fichier-client-remarque">Remarque</label>
                            <input style="width:85%" type="text" name="Remarques" id="fichier-client-remarque" value="<?php echo isset($_SESSION['Remarques']) ? $_SESSION['Remarques'] : ''; ?>" />
                        </div>

                    </div>
                </div>
                
            </form>
        </div>

    </main>
   
</body>

</html>