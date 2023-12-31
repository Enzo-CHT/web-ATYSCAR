<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/sessionHandler.js"></script>
  <script src="../js/vehiculeHandler.js"></script>

  <title>FICHIER CLIENTS</title>
</head>

<body>

  <main id="fichier-vehicule">
    <div>
      <div>
        <img class="logo" src="../addons/img/Atys Car.jpg" alt="logo-atyscar.jpg" />
      </div>

      <form id="vehiculeForm">
        <div class="container">
          <div class="left-container">
            <div class="vehicule">
              <h3>VEHICULE</h3>

              <div class="container-element">
                <label for="fichier-vehicule-type">Type<b style="color:red">*</b></label>
                <input type="text" name="TypeV" id="fichier-vehicule-type" value="<?php echo isset($_SESSION['vehicule']['TypeV']) ? $_SESSION['vehicule']['TypeV'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-categorie">Catégorie<b style="color:red">*</b></label>
                <input type="text" name="CatV" id="fichier-vehicule-categorie" value="<?php echo isset($_SESSION['vehicule']['CatV']) ? $_SESSION['vehicule']['CatV'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-matricule">Matricule<b style="color:red">*</b></label>
                <input type="text" name="MatV" id="fichier-vehicule-matricule" value="<?php echo isset($_SESSION['vehicule']['MatV']) ? $_SESSION['vehicule']['MatV'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-immatriculation">Immatriculation<b style="color:red">*</b></label>
                <input type="text" name="ImmatV" id="fichier-vehicule-immatriculation" value="<?php echo isset($_SESSION['vehicule']['ImmatV']) ? $_SESSION['vehicule']['ImmatV'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-annee">Année<b style="color:red">*</b></label>
                <input type="text" name="AnnV" id="fichier-vehicule-annee" value="<?php echo isset($_SESSION['vehicule']['AnnV']) ? $_SESSION['vehicule']['AnnV'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-marque"> Marque<b style="color:red">*</b> </label>
                <input type="text" name="MarV" id="fichier-vehicule-marque" value="<?php echo isset($_SESSION['vehicule']['MarV']) ? $_SESSION['vehicule']['MarV'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-modele">Modèle<b style="color:red">*</b></label>
                <input type="text" name="ModV" id="fichier-vehicule-modele" value="<?php echo isset($_SESSION['vehicule']['ModV']) ? $_SESSION['vehicule']['ModV'] :  ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-couleur">Couleur<b style="color:red">*</b></label>
                <input type="text" name="CoulV" id="fichier-vehicule-couleur" value="<?php echo isset($_SESSION['vehicule']['CoulV']) ? $_SESSION['vehicule']['CoulV'] : ''; ?>" />
              </div>
            </div>
          </div>

          <div class="right-container top">
            <div class="btn-container">
              <div>

                <input id="btn-add" class="menu-button" type="button" value="Ajouter" onclick="saveVehicule('vehiculeForm');" />
                <input id="btn-update" class="menu-button" type="button" value="Modifier" onclick="updateVehicule('vehiculeForm');" />
                <input id="btn-del" class="menu-button" type="button" value="Supprimer" onclick="delVehicule('vehiculeForm');" />
              </div>

              <div>
                <input id="btn-pre" class="menu-button" type="button" value="Précèdent" onclick="switchVehicule(-1)" />
                <input id="btn-suiv" class="menu-button" type="button" value="Suivant" onclick="switchVehicule(1)" />
              </div>

              <div>
                <!-- Not used 
                  <input id="btn-save" class="menu-button" type="button" value="Enregistrer" />
                -->
                <input id="btn-clear" class="menu-button" type="button" value="Vider" />
                <a href="../actualiser/index.html"><input class="menu-button" type="button" value="Annuler" /></a>
              </div>
            </div>
          </div>
        </div>

        <div class="container">
          <div id="fichier-vehicule-addons" class="left-container middle">
            <div class="container-element">
              <label for="fichier-vehicule-nombre-places">Nombre de places :<b style="color:red">*</b></label>
              <input type="number" name="NbPlV" id="fichier-vehicule-nombre-places" value="<?php echo isset($_SESSION['vehicule']['NbPlV']) ? $_SESSION['vehicule']['NbPlV'] : ''; ?>" />
            </div>
            <div class="container-element">
              <label for="fichier-vehicule-puissance">Puissance :<b style="color:red">*</b></label>
              <input type="number" name="PuisV" id="fichier-vehicule-puissance" value="<?php echo isset($_SESSION['vehicule']['PuisV']) ? $_SESSION['vehicule']['PuisV'] : ''; ?>" />
            </div>
          </div>



          <div class="right-container middle">
            <div class="radio-lists">

              <?php $TypeCarbV =  isset($_SESSION['vehicule']['CarbV']) ? $_SESSION['vehicule']['CarbV'] : ''; ?>

              <ul>
                <li>
                  <b>Carburant<b style="color:red">*</b></b>

                </li>
                <li>
                  <div class="container-element">
                    <label for="fichier-vehicule-diesel">Diesel</label>
                    <input type="radio" name="CarbV" id="fichier-vehicule-diesel" value="diesel" <?php echo ($TypeCarbV == "diesel") ? 'checked' : "" ?> />
                  </div>
                </li>

                <li>
                  <div class="container-element">
                    <label for="fichier-vehicule-essence">Essence</label>
                    <input type="radio" name="CarbV" id="fichier-vehicule-essence" value="essence" <?php echo ($TypeCarbV == "essence") ? 'checked' : "" ?> />
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="vehicule foot">
            <div class="container-element">
              <label for="fichier-vehicule-entretien-pre-kilometrage">Kilométrage
                dernier entretien</label>
              <input style="width: 55%" type="number" name="KilDernE" id="fichier-vehicule-entretien-pre-kilometrage" value="<?php echo isset($_SESSION['vehicule']['KilDernE']) ? $_SESSION['vehicule']['KilDernE'] : ''; ?>" />
            </div>
            <!--
            <div class="container-element">
              <label for="fichier-vehicule-entretien-pre-date">Date dernier
                entretien</label>
              <input style="width: 55%" type="text" name="Date-Ent" id="fichier-vehicule-entretien-pre-date" value="<?php //echo isset($_SESSION['vehicule']['Date-Ent']) ? $_SESSION['vehicule']['Date-Ent'] : ''; 
                                                                                                                    ?>" />
            </div>
          -->
            <div class="container-element">
              <label for="fichier-vehicule-entretien-pro-kilometrage">Kilométrage
                prochain entretien</label>
              <input style="width: 55%" type="number" name="KilProE" id="fichier-vehicule-entretien-pro-kilometrage" value="<?php echo isset($_SESSION['vehicule']['KilProE']) ? $_SESSION['vehicule']['KilProE'] : ''; ?>" />
            </div>
            <div class="container-element">
              <label for="fichier-vehicule-entretien-kilometrage">Kilométrage
                prochain entretien</label>
              <input style="width: 55%" type="number" name="KilomAV" id="fichier-vehicule-entretien-pro-kilometrage" value="<?php echo isset($_SESSION['vehicule']['KilomAV']) ? $_SESSION['vehicule']['KilomAV'] : ''; ?>" />
            </div>
            <span id='span-stats'><?php echo isset($_SESSION['stats']) ? $_SESSION['stats'] : ''; ?></span>

          </div>
        </div>
      </form>
    </div>

  </main>
</body>
<script>
  


  // Vide les champs remplit
  document.getElementById('btn-clear').onclick = function() {

    let inputs = document.querySelectorAll('input:not(.menu-button)');
    inputs.forEach(input => {
      input.value = '';
      $(input).prop("checked", false);
    });

  };






  if (document.getElementById("span-stats").innerHTML != '') {
    setTimeout(function() {
      spanStats.innerHTML = "";
      <?php unset($_SESSION['stats']); ?>
    }, 5000);
  }
</script>

</html>