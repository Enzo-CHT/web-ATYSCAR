<div id="autre-entretien">
    <div class="container">
        <div class="left-container">
            <img src="../addons/img/Atys Car.jpg" alt="atyscar-logo" class="logo">
        </div>
        <div class="right-container">
            <div class="box-c">
                <p>Autre entretien sur le même véhicule</p>
            </div>
            <div class="box-l">
                <div class="container-element">
                    <label for="autre-entretien-btn-oui"></label>
                    <input class="menu-button" type="button" value="Oui" id="autre-entretien-btn-oui" onclick="continueWith(true)">
                </div>

                <div class="container-element">
                    <label for="autre-entretien-btn-non"></label>
                    <input class="menu-button" type="button" value="Non" id="autre-entretien-btn-non"  onclick="continueWith(false)">
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    /**@abstract
     * Fonction définissante le nettoyage ou non des champs rentré par l'agent
     */
    function continueWith(keep) {
        keepVehicule = keep; //Déclaré dans index.php
        $('#popup').hide(); //Déclaré dans index.php
        mainFrame.style.filter = "blur(0px)"; //Déclaré dans index.php

        send(); //Déclaré dans index.php
    }
</script>