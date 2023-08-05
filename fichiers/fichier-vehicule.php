<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title>FICHIER CLIENTS</title>
</head>

<body>
  <main id="fichier-vehicule">
    <div>
      <div>
        <img class="logo" src="../addons/Atys Car.jpg" alt="logo-atyscar.jpg" />
      </div>

      <form id="vehiculeForm">
        <div class="container">
          <div class="left-container">

            <div class="vehicule">
              <h3>VEHICULE</h3>

              <div class="container-element">
                <label for="fichier-vehicule-type">Type<b style="color:red">*</b></label>
                <input type="text" name="TypeV" id="fichier-vehicule-type" value="<?php echo isset($_SESSION['car']['NomC']) ? $_SESSION['car']['NomC'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-categorie">Catégorie<b style="color:red">*</b></label>
                <input type="text" name="CatV" id="fichier-vehicule-categorie" value="<?php echo isset($_SESSION['car']['PrenomC']) ? $_SESSION['car']['PrenomC'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-matricule">Matricule<b style="color:red">*</b></label>
                <input type="text" name="MatV" id="fichier-vehicule-matricule" value="<?php echo isset($_SESSION['car']['DatNaisC']) ? $_SESSION['car']['DatNaisC'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-immatriculation">Immatriculation<b style="color:red">*</b></label>
                <input type="text" name="ImmatV" id="fichier-vehicule-immatriculation" value="<?php echo isset($_SESSION['car']['LieuNaisC']) ? $_SESSION['car']['LieuNaisC'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-annee">Année<b style="color:red">*</b></label>
                <input type="text" name="AnnV" id="fichier-vehicule-annee" value="<?php echo isset($_SESSION['car']['NationaliteC']) ? $_SESSION['car']['NationaliteC'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-marque"> Marque<b style="color:red">*</b> </label>
                <input type="text" name="MarV" id="fichier-vehicule-marque" value="<?php echo isset($_SESSION['car']['AdrRueC']) ? $_SESSION['car']['AdrRueC'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-modele">Modèle<b style="color:red">*</b></label>
                <input type="text" name="ModV" id="fichier-vehicule-modele" value="<?php echo isset($_SESSION['car']['AdrVilC']) ? $_SESSION['car']['AdrVilC'] :  ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-couleur">Couleur<b style="color:red">*</b></label>
                <input type="text" name="CoulV" id="fichier-vehicule-couleur" value="<?php echo isset($_SESSION['car']['CodPosC']) ? $_SESSION['car']['CodPosC'] : ''; ?>" />
              </div>
            </div>
          </div>

          <div class="right-container top">
            <div class="btn-container">
              <div>
                <input id="btn-add" class="menu-button" type="button" value="Ajouter" onclick />
                <input id="btn-update" class="menu-button" type="button" value="Modifier" onclick />
                <input id="btn-del" class="menu-button" type="button" value="Supprimer" onclick />
              </div>

              <div>
                <input id="btn-pre" class="menu-button" type="button" value="Précèdent" onclick />
                <input id="btn-suiv" class="menu-button" type="button" value="Suivant" onclick />
              </div>

              <div>
                <input id="btn-save" class="menu-button" type="button" value="Enregistrer" onclick />
                <a href="../actualiser/index.html"><input class="menu-button" type="button" value="Annuler" /></a>
              </div>
            </div>
          </div>
        </div>

        <div class="container">
          <div id="fichier-vehicule-addons" class="left-container middle">
            <div class="container-element">
              <label for="fichier-vehicule-nombre-places">Nombre de places :<b style="color:red">*</b></label>
              <input type="number" name="NbPlV" id="fichier-vehicule-nombre-places" />
            </div>
            <div class="container-element">
              <label for="fichier-vehicule-puissance">Puissance :<b style="color:red">*</b></label>
              <input type="number" name="PuisV" id="fichier-vehicule-puissance" />
            </div>
          </div>

          <div class="right-container middle">
            <div class="radio-lists">
              <ul>
                <li>
                  <b>Carburant<b style="color:red">*</b></b>

                </li>
                <li>
                  <div class="container-element">
                    <label for="fichier-vehicule-diesel">Diesel</label>
                    <input type="radio" name="CarbV" id="fichier-vehicule-diesel" value="diesel" />
                  </div>
                </li>

                <li>
                  <div class="container-element">
                    <label for="fichier-vehicule-essence">Essence</label>
                    <input type="radio" name="CarbV" id="fichier-vehicule-essence" value="essence" />
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
              <input style="width: 55%" type="text" name="KilDernE" id="fichier-vehicule-entretien-pre-kilometrage" value="<?php echo isset($_SESSION['car']['AutreAdr']) ? $_SESSION['car']['AutreAdr'] : ''; ?>" />
            </div>
            <div class="container-element">
              <label for="fichier-vehicule-entretien-pre-date">Date dernier
                entretien</label>
              <input style="width: 55%" type="text" name="Date-Ent" id="fichier-vehicule-entretien-pre-date" value="<?php echo isset($_SESSION['car']['Remarques']) ? $_SESSION['car']['Remarques'] : ''; ?>" />
            </div>
            <div class="container-element">
              <label for="fichier-vehicule-entretien-pro-kilometrage">Kilométrage
                prochain entretien</label>
              <input style="width: 55%" type="text" name="KilProE" id="fichier-vehicule-entretien-pro-kilometrage" value="<?php echo isset($_SESSION['car']['Remarques']) ? $_SESSION['car']['Remarques'] : ''; ?>" />
            </div>
          </div>
        </div>
      </form>
    </div>
  
  </main>
</body>
<script type="module">
  import {
    Vehicule
  } from "../js/carHandler.js";


  let formId = "vehiculeForm";
  document.getElementById('btn-save').onclick = function() {
    let element = new Vehicule(formId);
    element.saveVehicule();
    
  };
</script>

</html>