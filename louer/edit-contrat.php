<?php
session_start();

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/sessionHandler.js"></script>
    <script src="../js/contractHandler.js"></script>
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

                        <label for="select-client"> Client<b><span style="color:red">*</span></b> </label>
                        <input type="text" name="numero-client" id="datalist-client" list="client" value="<?php echo isset($_SESSION['client']['NumC']) ? $_SESSION['client']['NumC'] : ''; ?>">
                        <datalist id="client">

                            <?php
                            include "../php/connexion.php";
                            $sql = "SELECT NumC, NomC, PrenomC FROM CLIENT";
                            $stmt = $connexion->prepare($sql);
                            if ($stmt->execute()) {
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        // Affichage des noms clients et de leur numéro d'identification
                                        echo "<option value='" . $row['NumC'] . "'>" . $row['PrenomC'] . " " . $row['NomC'] . "</option>";
                                    }
                                }
                            }


                            ?>
                        </datalist>

                        <div class="container-element">
                            <label for="facture-adresse"> Véhicule<b><span style="color:red">*</span></b> </label>
                            <input class="readonly" type="text" name="adresse" id="facture-adresse" value="<?php echo isset($_SESSION['vehicule']['MarV']) ? $_SESSION['vehicule']['MarV'] : ''; ?> <?php echo isset($_SESSION['vehicule']['ModV']) ? $_SESSION['vehicule']['ModV'] : ''; ?>" readonly />
                        </div>
                        <div class="container-element">
                            <input id="btn-vehiculeChanger" type="button" class="menu-button" value="Changer Véhicule" onclick="$('body').load('../louer/selectionner-vehicule.php');">
                            <p class="menu-button trigger-event">Caractéristiques du véhicule</p>
                            <div class="sub">
                                <div class="container-element">
                                    <p>Type du véhicule : </p>
                                    <p class="readonly"><?php echo isset($_SESSION['vehicule']['TypeV']) ? $_SESSION['vehicule']['TypeV'] : ''; ?> </p>
                                </div>
                                <div class="container-element">
                                    <p>Puissance du véhicule : </p>
                                    <p class="readonly"><?php echo isset($_SESSION['vehicule']['PuisV']) ? $_SESSION['vehicule']['PuisV'] : ''; ?></p>
                                </div>
                                <div class="container-element">
                                    <p>Carburant du véhicule : </p>
                                    <p class="readonly"><?php echo isset($_SESSION['vehicule']['CarbV']) ? $_SESSION['vehicule']['CarbV'] : ''; ?></p>
                                </div>
                                <div class="container-element">
                                    <p>Couleur du véhicule : </p>
                                    <p class="readonly"><?php echo isset($_SESSION['vehicule']['CoulV']) ? $_SESSION['vehicule']['CoulV'] : ''; ?></p>
                                </div>
                                <div class="container-element">
                                    <p>Nombre de place disponnible : </p>
                                    <p class="readonly"><?php echo isset($_SESSION['vehicule']['NbPlV']) ? $_SESSION['vehicule']['NbPlV'] : ''; ?></p>
                                </div>
                            </div>
                        </div>





                        <br><br>
                        <div class="container-element">

                            <label for="facture-adresse"> Adresse </label>
                            <input class="readonly" type="text" name="adresse" id="facture-adresse" value="<?php echo isset($_SESSION['client']['AdrRueC']) ? $_SESSION['client']['AdrRueC'] : ''; ?>" readonly />
                        </div>
                        <div class="container-element">

                            <label for="facture-ville">Ville</label>
                            <input class="readonly" type="text" name="ville" id="facture-ville" value="<?php echo isset($_SESSION['client']['AdrVilC']) ? $_SESSION['client']['AdrVilC'] :  ''; ?>" readonly />
                        </div>
                        <div class="container-element">

                            <label for="facture-code-postal">Code Postal</label>
                            <input class="readonly" type="text" name="code-postal" id="facture-code-postal" value="<?php echo isset($_SESSION['client']['CodPosC']) ? $_SESSION['client']['CodPosC'] : ''; ?>" readonly />
                        </div>
                        <div class="container-element">

                            <label for="facture-telephone">Téléphone</label>
                            <input class="readonly" type="text" name="telephone" id="facture-telephone" value="<?php echo isset($_SESSION['client']['TelC']) ? $_SESSION['client']['TelC'] : ''; ?>" readonly />
                        </div>
                    </div>
                    <br><br>
                    <div class="passeport">
                        <div class="container-element">
                            <label for="facture-num-passeport">Numéro de passeport </label>
                            <input class="readonly" type="text" name="num-passeport" id="facture-num-passeport" value="<?php echo isset($_SESSION['client']['NumPasC']) ? $_SESSION['client']['NumPasC'] : ''; ?>" readonly />
                        </div>
                        <div class="container-element">
                            <label for="facture-delivrer-date">Date de délivrance </label>
                            <input class="readonly" type="text" name="delivrer-date" id="facture-delivrer-date" value="<?php echo isset($_SESSION['client']['DatDelPasC']) ? $_SESSION['client']['DatDelPasC'] : ''; ?>" readonly />
                        </div>
                        <div class="container-element">
                            <label for="facture-passeport-delivrer-lieu">Lieu de délivrance </label>
                            <input class="readonly" type="text" name="delivrer-lieu" id="facture-passeport-delivrer-lieu" value="<?php echo isset($_SESSION['client']['LieuDelPasC']) ? $_SESSION['client']['LieuDelPasC'] : ''; ?>" readonly />
                        </div>
                        <div class="container-element">
                            <label for="facture-passeport-delivrer-pays">Pays délivrance </label>
                            <input class="readonly" type="text" name="delivrer-pays" id="facture-passeport-delivrer-pays" value="<?php echo isset($_SESSION['client']['PaysDelPasC']) ? $_SESSION['client']['PaysDelPasC'] : ''; ?>" readonly />
                        </div>
                    </div>
                </div>
                <form id="contratForm">
                    <div class="right-container">
                        <div class="contrat">
                            <div class="container-element">
                                <label for="facture-date-depart">Date de départ<b><span style="color:red">*</span></b> : </label>
                                <input type="date" name="date-depart" id="facture-date-depart" value="<?php echo isset($_SESSION['contrat']['DatDebCont']) ? $_SESSION['contrat']['DatDebCont'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="facture-date-retour">Date de retour<b><span style="color:red">*</span></b> : </label>
                                <input type="date" name="date-retour" id="facture-date-retour" value="<?php echo isset($_SESSION['contrat']['DatRetCont']) ? $_SESSION['contrat']['DatRetCont'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="facture-station-depart">Station départ<b><span style="color:red">*</span></b> : </label>
                                <input type="text" name="station-depart" id="facture-station-depart" value="<?php echo isset($_SESSION['contrat']['VilDepCont']) ? $_SESSION['contrat']['VilDepCont'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="facture-station-retour">Station retour réelle<b><span style="color:red">*</span></b> :</label>
                                <input type="text" name="station-retour" id="facture-station-retour" value="<?php echo isset($_SESSION['contrat']['VilRetCont']) ? $_SESSION['contrat']['VilRetCont'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="facture-heure-depart">Heure de départ<b><span style="color:red">*</span></b> :</label>
                                <input type="time" name="heure-depart" id="facture-heure-depart" value="<?php echo isset($_SESSION['contrat']['HeurDepCont']) ? $_SESSION['contrat']['HeurDepCont'] : ''; ?>" />
                            </div>
                            <div class="container-element">
                                <label for="facture-heure-retour">Heure d'arrivé<b><span style="color:red">*</span></b> :</label>
                                <input type="time" name="heure-retour" id="facture-heure-retour" value="<?php echo isset($_SESSION['contrat']['HeurRetCont']) ? $_SESSION['contrat']['HeurRetCont'] : ''; ?>" />
                            </div>
                        </div>
                        <div class="type-facturation">
                            <h2>Type facturation<b><span style="color:red">*</span></b> </h2>
                            <?php
                                $codeTarif = isset($_SESSION['contrat']['CodTypTarif']) ? $_SESSION['contrat']['CodTypTarif'] : null;
                            ?>
                            <ul class="list-type-facturation">
                                <li>
                                    <div class="container-element">
                                        <label for="contrat-forfait">Forfait</label>
                                        <input type="radio" name="tarif" id="contrat-forfait" value="1" <?php echo  ($codeTarif == '1') ? 'checked' : ''; ?>/>
                                    </div>
                                </li>

                                <li>
                                    <div class="container-element">
                                        <label for="contrat-durée">Durée</label>
                                        <input type="radio" name="tarif" id="contrat-durée" value="2" <?php echo  ($codeTarif == '2') ? 'checked' : ''; ?>/>
                                    </div>
                                </li>

                                <li>
                                    <div class="container-element">
                                        <label for="contrat-kilmetrage">Kilometrage</label>
                                        <input type="radio" name="tarif" id="contrat-kilmetrage" value="3" <?php echo  ($codeTarif == '3') ? 'checked' : ''; ?>/>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="type-facturation">
                        <h2>Périodes<b><span style="color:red">*</span></b> </h2>
                        <?php
                                $codePeriode = isset($_SESSION['contrat']['periode']) ? $_SESSION['contrat']['periode'] : null;
                            ?>
                        <ul class="list-type-facturation">
                            <li>
                                <div class="container-element">
                                    <label for="contrat-hiver">Hiver</label>
                                    <input type="radio" name="periode" id="contrat-hiver" value="1" <?php echo  ($codePeriode == '1') ? 'checked' : ''; ?>/>
                                </div>
                            </li>

                            <li>
                                <div class="container-element">
                                    <label for="contrat-ete">Ete</label>
                                    <input type="radio" name="periode" id="contrat-ete" value="2" <?php echo  ($codePeriode == '2') ? 'checked' : ''; ?>/>
                                </div>
                            </li>

                            <li>
                                <div class="container-element">
                                    <label for="contrat-vacances">Vacances</label>
                                    <input type="radio" name="periode" id="contrat-vacances" value="3" <?php echo  ($codePeriode == '3') ? 'checked' : ''; ?>/>
                                </div>
                            </li>
                        </ul>
                    </div>


                        <div class="box-c">
                            <input type="button" id="btn-valider" class="menu-button" value="Valider" onclick="modifierContrat()">
                            <a href="index.html"><input type="button" id="btn-retour" class="menu-button" value="Retour"></a>
                            <span id='span-stats'></span>
                        </div>

                        <div class="permis">
                            <div class="container-element">
                                <label for="facture-permis-num">Numéro permis : </label>
                                <input class="readonly" type="text" name="permis-num" id="facture-permis-num" value="<?php echo isset($_SESSION['client']['NumPermisC']) ? $_SESSION['client']['NumPermisC'] : ''; ?>" readonly />
                            </div>
                            <div class="container-element">
                                <label for="facture-permis-delivrer-date">Délivré le :</label>
                                <input class="readonly" type="text" name="permis-delivrer-date" id="facture-permis-delivrer-date" value="<?php echo isset($_SESSION['client']['DatDelPermiC']) ? $_SESSION['client']['DatDelPermiC'] : ''; ?>" readonly />
                            </div>
                            <div class="container-element">
                                <label for="facture-permis-delivrer-lieu">à :</label>
                                <input class="readonly" type="text" name="permis-delivrer-lieu" id="facture-permis-delivrer-lieu" value="<?php echo isset($_SESSION['client']['LieuDelPermisC']) ? $_SESSION['client']['LieuDelPermisC'] : ''; ?>" readonly />
                            </div>
                        </div>
                </form>
            </div>

        </div>
        </div>

        </div>
    </main>
</body>
<script>
    function modifierContrat() {
        const form = document.getElementById('contratForm');
        const formData = new FormData(form);

        var dataArray = {};
        formData.forEach((val, el) => {
            dataArray[el] = val;
        });

        dataArray['numero-client'] = document.getElementById('datalist-client').value;

       


        updateContract(dataArray);

    }


</script>

</html>