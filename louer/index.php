<?php
session_start();


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>LOUER UN VEHICULE</title>
</head>
<body>
    <main id="menu-location">
        <div>
            <img class="logo" src="../addons/img/Atys Car.jpg" alt="atyscar-logo">
        <div class="container-main-button">
            <a href="contrat.php">
                <input id="button-nouveau-contrat" class="menu-button"  type="button" value="NOUVEAU CONTRAT">
            </a>
            <a href="../build.html">
                <input id="button-nouveau-contrat" class="menu-button"  type="button" value="MODIFIER CONTRAT">
            </a>
            <a href="../edition/edition-facture.html">
                <input id="button-facture" class="menu-button" type="button" value="IMPRESSION FACTURE">
            </a>
            <a href="../edition/edition-contrat.html">
                <input id="button-facture" class="menu-button" type="button" value="IMPRESSION CONTRAT">
            </a>
            <a href="annulation-contrat.html">
                <input id="button-annuler-contrat" class="menu-button" type="button" value="ANNULER CONTRAT">
            </a>
        </div>
        <div class="container-option-button">
            <a href="../build.html">
                <input id="button-aide" class="menu-button" type="button" value="AIDE">
            </a>
            <a href="../index.html" > 
                <input id="button-annuler" class="menu-button" type="button" value="ANNULER" onclick="resetSession();">
            </a>
        </div>
        </div>
        
    </main>
    

    
</body>
</html>