<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <title>FACTURE</title>
</head>

<body>
    <main id="facture">
        <div>
            <div class="head">
                <img class="logo" src="../addons/img/Atys Car.jpg" alt="atyscar-logo">
            </div>
            <div class="container">
                <div class="left-container">
                    <div class="client">

                        <div class="container-element">
                            <label for="facture-nom">Nom</label>
                            <input type="text" name="nom" id="facture-nom" value="<?php echo isset($_SESSION['NomC']) ? $_SESSION['NomC'] : ''; ?>" />
                        </div>
                        <div class="container-element">

                            <label for="facture-prenom">Prénom</label>
                            <input type="text" name="prenom" id="facture-prenom" value="<?php echo isset($_SESSION['PrenomC']) ? $_SESSION['PrenomC'] : ''; ?>" />
                        </div>
                        <div class="container-element">

                            <label for="facture-date-naissance">Date de naissance</label>
                            <input type="text" name="date-naissance" id="facture-date-naissance" value="<?php echo isset($_SESSION['DatNaisC']) ? $_SESSION['DatNaisC'] : ''; ?>" />
                        </div>
                        <div class="container-element">

                            <label for="facture-lieu-naissance">Lieu de naissance</label>
                            <input type="text" name="lieu-naissance" id="facture-lieu-naissance" value="<?php echo isset($_SESSION['LieuNaisC']) ? $_SESSION['LieuNaisC'] : ''; ?>" />
                        </div>
                        <div class="container-element">

                            <label for="facture-nationalite">Nationalité</label>
                            <input type="text" name="nationalite" id="facture-nationalite" value="<?php echo isset($_SESSION['NationaliteC']) ? $_SESSION['NationaliteC'] : ''; ?>" />
                        </div>
                        <br><br>
                        <div class="container-element">

                            <label for="facture-adresse"> Adresse </label>
                            <input type="text" name="adresse" id="facture-adresse" value="<?php echo isset($_SESSION['AdrRueC']) ? $_SESSION['AdrRueC'] : ''; ?>" />
                        </div>
                        <div class="container-element">

                            <label for="facture-ville">Ville</label>
                            <input type="text" name="ville" id="facture-ville" value="<?php echo isset($_SESSION['AdrVilC']) ? $_SESSION['AdrVilC'] :  ''; ?>" />
                        </div>
                        <div class="container-element">

                            <label for="facture-code-postal">Code Postal</label>
                            <input type="text" name="code-postal" id="facture-code-postal" value="<?php echo isset($_SESSION['CodPosC']) ? $_SESSION['CodPosC'] : ''; ?>" />
                        </div>
                        <div class="container-element">

                            <label for="facture-telephone">Téléphone</label>
                            <input type="text" name="telephone" id="facture-telephone" value="<?php echo isset($_SESSION['TelC']) ? $_SESSION['TelC'] : ''; ?>" />
                        </div>
                    </div>
                    <br><br>
                    <div class="passeport">
                        <div class="container-element">
                            <label for="facture-num-passeport">Numéro de passeport </label>
                            <input type="text" name="num-passeport" id="facture-num-passeport" value="<?php echo isset($_SESSION['NumPasC']) ? $_SESSION['NumPasC'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-delivrer-date">Date de délivrance </label>
                            <input type="text" name="delivrer-date" id="facture-delivrer-date" value="<?php echo isset($_SESSION['DatDelPasC']) ? $_SESSION['DatDelPasC'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-passeport-delivrer-lieu">Lieu de délivrance </label>
                            <input type="text" name="delivrer-lieu" id="facture-passeport-delivrer-lieu" value="<?php echo isset($_SESSION['LieuDelPasC']) ? $_SESSION['LieuDelPasC'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-passeport-delivrer-pays">Pays délivrance </label>
                            <input type="text" name="delivrer-pays" id="facture-passeport-delivrer-pays" value="<?php echo isset($_SESSION['PaysDelPasC']) ? $_SESSION['PaysDelPasC'] : ''; ?>" />
                        </div>
                    </div>
                </div>
                <div class="right-container">
                    <div class="station">
                        <div class="container-element">
                            <label for="facture-station-depart">Station départ : </label>
                            <input type="text" name="station-depart" id="facture-station-depart" value="<?php echo isset($_SESSION['LieuDelPasC']) ? $_SESSION['LieuDelPasC'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-station-retour">Station retour réelle :</label>
                            <input type="text" name="station-retour" id="facture-station-retour" value="<?php echo isset($_SESSION['PaysDelPasC']) ? $_SESSION['PaysDelPasC'] : ''; ?>" />
                        </div>
                    </div>

                    <div class="permis">
                        <div class="container-element">
                            <label for="facture-permis-num">Numéro permis : </label>
                            <input type="text" name="permis-num" id="facture-permis-num" value="<?php echo isset($_SESSION['LieuDelPasC']) ? $_SESSION['LieuDelPasC'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-permis-delivrer-date">Délivré le :</label>
                            <input type="text" name="permis-delivrer-date" id="facture-permis-delivrer-date" value="<?php echo isset($_SESSION['PaysDelPasC']) ? $_SESSION['PaysDelPasC'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-permis-delivrer-lieu">à :</label>
                            <input type="text" name="permis-delivrer-lieu" id="facture-permis-delivrer-lieu" value="<?php echo isset($_SESSION['PaysDelPasC']) ? $_SESSION['PaysDelPasC'] : ''; ?>" />
                        </div>
                    </div>
                </div>

            </div>
        </div>

        </div>
    </main>
</body>

</html>