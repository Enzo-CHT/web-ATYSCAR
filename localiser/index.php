<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/style.css" type="text/css" />
  <title>LOCALISER VÉHICULE</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/sessionHandler.js"></script>
</head>

<body>




  <main id="localiser">


    <div>

      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7386.896554680578!2d166.46139459357903!3d-22.22306419999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6c2807ee8794723b%3A0xed4bc87ffc9004f3!2sAutofast!5e0!3m2!1sfr!2sfr!4v1695012826433!5m2!1sfr!2sfr"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
      <div class="container">
        <img class="logo" src="../addons/img/Atys Car.jpg" alt="atyscar-logo" />



        <div class="container">

          <div class="left-container">
            <div class="container-element">
              <label for="enregistrer-entretien-vehicule-immatriculation">Immatriculation</label>
              <input type="text" name="vehicule-immatriculation" id="enregistrer-vehicule-immatriculation"
                list="immatriculation-list" onclick="this.value ='' " />
              <datalist id="immatriculation-list">
                <!-- Entrer les options ici -->
                <?php

                include "../php/connexion.php";

                $codes = "SELECT MatV,ImmatV FROM Vehicule;";
                if ($result = $connexion->query($codes)) {
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                      echo "<option name=" . $row['MatV'] . " value=" . $row['MatV'] . " > Immatriculation : " . $row['ImmatV'] . "</option>";
                    }
                  }
                }

                ?>

              </datalist>

                <div class="container-element">
                  <a href="../index.html">
                    <input class="menu-button" type="button" value="Annuler" id="btn-annuler" />
                  </a>
                </div>
            </div>
          </div>
        </div>
      </div>
  </main>
</body>
<script>

  document.getElementById("btn-ok").onclick = function () {
    $.ajax({
      url: "../php/sessionUpdater.php",
      type: "POST",
      data: {
        session: "all",
        data: document.getElementById("edition-facture-id").value,
      },
      success: function () {
        console.log("sessionUpdate has been called and executed.");

        var newWindow = window.open("cPrint.php");

        setTimeout(function () {
          if (newWindow) {
            newWindow.close();
          }
        }, 3000);

      },
      error: function (xhr, error, status) {
        console.error("Error page (sessionUpdater) : ", error, status);
      },
    });
  };
</script>

</html>