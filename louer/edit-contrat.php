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
                    <form id="contratForm">
                        <div class="client">

                            <label for="select-client"> Client </label>
                            <input type="text" name="numero-client" id="datalist-client" list="client" value="<?php echo isset($_SESSION['client']['NomC']) ? $_SESSION['client']['NomC'] : ''; ?> <?php echo isset($_SESSION['client']['PrenomC']) ? $_SESSION['client']['PrenomC'] : ''; ?>">
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
                                <label for="facture-adresse"> Véhicuel </label>
                                <input class="readonly" type="text" name="adresse" id="facture-adresse" value="<?php echo isset($_SESSION['vehicule']['MarV']) ? $_SESSION['vehicule']['MarV'] : ''; ?> <?php echo isset($_SESSION['vehicule']['ModV']) ? $_SESSION['vehicule']['ModV'] : ''; ?>" readonly />
                            </div>
                            <a href="../fichiers/fichier-vehicule.php"><input type="button" class="menu-button" value="Changer Véhicule"></a>
                            <input hidden type="button" class="menu-button" value="Voir caractéristiques">



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
                <div class="right-container">
                    <div class="contrat">
                        <div class="container-element">
                            <label for="facture-date-depart">Date de départ : </label>
                            <input type="date" name="date-depart" id="facture-date-depart" value="<?php echo isset($_SESSION['contrat']['DatDebCont']) ? $_SESSION['contrat']['DatDebCont'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-date-retour">Date de retour : </label>
                            <input type="date" name="date-retour" id="facture-date-retour" value="<?php echo isset($_SESSION['contrat']['DatRetCont']) ? $_SESSION['contrat']['DatRetCont'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-station-depart">Station départ : </label>
                            <input type="text" name="station-depart" id="facture-station-depart" value="<?php echo isset($_SESSION['contrat']['VilDepCont']) ? $_SESSION['contrat']['VilDepCont'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-station-retour">Station retour réelle :</label>
                            <input type="text" name="station-retour" id="facture-station-retour" value="<?php echo isset($_SESSION['contrat']['VilRetCont']) ? $_SESSION['contrat']['VilRetCont'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-heure-depart">Heure de départ :</label>
                            <input type="time" name="heure-depart" id="facture-heure-depart" value="<?php echo isset($_SESSION['contrat']['HeurDepCont']) ? $_SESSION['contrat']['HeurDepCont'] : ''; ?>" />
                        </div>
                        <div class="container-element">
                            <label for="facture-heure-retour">Heure d'arrivé :</label>
                            <input type="time" name="heure-retour" id="facture-heure-retour" value="<?php echo isset($_SESSION['contrat']['HeurRetCont']) ? $_SESSION['contrat']['HeurRetCont'] : ''; ?>" />
                        </div>
                    </div>


                    <div class="box-c">
                        <input type="button" id="btn-valider" class="menu-button" value="Valider" onclick="modifierContrat()">
                        <a href="index.html"><input type="button" id="btn-annuler" class="menu-button" value="Annuler"></a>
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

        console.log(dataArray);

        updateContract(dataArray);

    }
</script>

</html>