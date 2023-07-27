<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />

    <title>FICHIER CLIENTS</title>
  </head>

  <body>
    <main id="fichier-vehicule">
      <div>
        <form action method="POST">
          <div>
            <img
              class="logo"
              src="../addons/Atys Car.jpg"
              alt="logo-atyscar.jpg" />
          </div>

          <div class="container">
            <div class="left-container">
              <div class="vehicule">
                <h3>VEHICULE</h3>

                <div class="container-element">
                  <label for="fichier-vehicule-type">Type</label>
                  <input
                    type="text"
                    name="type"
                    id="fichier-vehicule-type"
                    value="<?php echo isset($_SESSION['car']['NomC']) ? $_SESSION['car']['NomC'] : ''; ?>" />
                </div>
                <div class="container-element">
                  <label for="fichier-vehicule-categorie">Catégorie</label>
                  <input
                    type="text"
                    name="categorie"
                    id="fichier-vehicule-categorie"
                    value="<?php echo isset($_SESSION['car']['PrenomC']) ? $_SESSION['car']['PrenomC'] : ''; ?>" />
                </div>
                <div class="container-element">
                  <label for="fichier-vehicule-matricule">Matricule</label>
                  <input
                    type="text"
                    name="matricule"
                    id="fichier-vehicule-matricule"
                    value="<?php echo isset($_SESSION['car']['DatNaisC']) ? $_SESSION['car']['DatNaisC'] : ''; ?>" />
                </div>
                <div class="container-element">
                  <label for="fichier-vehicule-immatriculation">Immatriculation</label>
                  <input
                    type="text"
                    name="immatriculation"
                    id="fichier-vehicule-immatriculation"
                    value="<?php echo isset($_SESSION['car']['LieuNaisC']) ? $_SESSION['car']['LieuNaisC'] : ''; ?>" />
                </div>
                <div class="container-element">
                  <label for="fichier-vehicule-annee">Année</label>
                  <input
                    type="text"
                    name="annee"
                    id="fichier-vehicule-annee"
                    value="<?php echo isset($_SESSION['car']['NationaliteC']) ? $_SESSION['car']['NationaliteC'] : ''; ?>" />
                </div>
                <div class="container-element">
                  <label for="fichier-vehicule-marque"> Marque </label>
                  <input
                    type="text"
                    name="marque"
                    id="fichier-vehicule-marque"
                    value="<?php echo isset($_SESSION['car']['AdrRueC']) ? $_SESSION['car']['AdrRueC'] : ''; ?>" />
                </div>
                <div class="container-element">
                  <label for="fichier-vehicule-modele">Modèle</label>
                  <input
                    type="text"
                    name="modele"
                    id="fichier-vehicule-modele"
                    value="<?php echo isset($_SESSION['car']['AdrVilC']) ? $_SESSION['car']['AdrVilC'] :  ''; ?>" />
                </div>
                <div class="container-element">
                  <label for="fichier-vehicule-couleur">Couleur</label>
                  <input
                    type="text"
                    name="couleur"
                    id="fichier-vehicule-couleur"
                    value="<?php echo isset($_SESSION['car']['CodPosC']) ? $_SESSION['car']['CodPosC'] : ''; ?>" />
                </div>
              </div>
            </div>

            <div class="right-container top">
              <div class="btn-container">
                <div>
                  <input
                    class="menu-button"
                    type="button"
                    value="Ajouter"
                    onclick />
                  <input
                    class="menu-button"
                    type="button"
                    value="Modifier"
                    onclick />
                  <input
                    class="menu-button"
                    type="button"
                    value="Supprimer"
                    onclick />
                </div>

                <div>
                  <input
                    class="menu-button"
                    type="button"
                    value="Précèdent"
                    onclick />
                  <input
                    class="menu-button"
                    type="button"
                    value="Suivant"
                    onclick />
                </div>

                <div>
                  <input
                    class="menu-button"
                    type="button"
                    value="Enregistrer"
                    onclick />
                  <a href="../actualiser/index.html"><input class="menu-button"
                      type="button" value="Annuler" /></a>
                </div>
              </div>
            </div>
          </div>

          <div class="container">
            <div id="fichier-vehicule-addons" class="left-container middle">
              <div class="container-element">
                <label for="fichier-vehicule-nombre-places">Nombre de places :</label>
                <input
                  type="number"
                  name="nombre-places"
                  id="fichier-vehicule-nombre-places" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-puissance">Puissance :</label>
                <input
                  type="number"
                  name="puissance"
                  id="fichier-vehicule-puissance" />
              </div>
            </div>

            <div class="right-container middle">
              <div class="radio-lists">
                <ul>
                  <li>
                    <b>Carburant</b>

                  </li>
                  <li>
                    <div class="container-element">
                      <label for="fichier-vehicule-diesel">Diesel</label>
                      <input
                        type="radio"
                        name="type-carburant"
                        id="fichier-vehicule-diesel"
                        value="diesel" />
                    </div>
                  </li>

                  <li>
                    <div class="container-element">
                      <label for="fichier-vehicule-essence">Essence</label>
                      <input
                        type="radio"
                        name="type-carburant"
                        id="fichier-vehicule-essence"
                        value="essence" />
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
                <input
                  style="width: 55%"
                  type="text"
                  name="entretien-pre-kilometrage"
                  id="fichier-vehicule-entretien-pre-kilometrage"
                  value="<?php echo isset($_SESSION['car']['AutreAdr']) ? $_SESSION['car']['AutreAdr'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-entretien-pre-date">Date dernier
                  entretien</label>
                <input
                  style="width: 55%"
                  type="text"
                  name="entretien-pre-date"
                  id="fichier-vehicule-entretien-pre-date"
                  value="<?php echo isset($_SESSION['car']['Remarques']) ? $_SESSION['car']['Remarques'] : ''; ?>" />
              </div>
              <div class="container-element">
                <label for="fichier-vehicule-entretien-pro-kilometrage">Kilométrage
                  prochain entretien</label>
                <input
                  style="width: 55%"
                  type="text"
                  name="entretien-pro-kilometrage"
                  id="fichier-vehicule-entretien-pro-kilometrage"
                  value="<?php echo isset($_SESSION['car']['Remarques']) ? $_SESSION['car']['Remarques'] : ''; ?>" />
              </div>
            </div>
          </div>
        </form>
      </div>
    </main>
  </body>
  <script></script>
</html>
