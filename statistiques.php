<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>STATISTIQUES</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/statsBuilder.js"></script>

</head>

<body>
    <main id="statistiques">
        <div>


            <div class="container">

                <img class="logo" src="addons/img/Atys Car.jpg" alt="atyscar-logo">

                <div class="box-c">
                    <div class="container-element">
                        <label for="statistiques-type-stat">Type de statistiques</label>
                        <select id="statistiques-type-stat" type="text" list="stat_list">
                            <!-- Enter Option here !-->
                            <option id=0>% Utilisation / Type de véhicule / Ville</option>
                            <option id=1>% Utilisation / Type de véhicule / Periode</option>
                        </select>
                    </div>


                </div>
            </div>
            <div id="stats"></div>
            <div class="box-l">
              
                <div class="container-element">
                    <a href="guide/guide.html#statistiques"><input type="button" class="menu-button" id="statistiques-btn-aide" value="AIDE"></a>
                    <a href="index.html"><input type="button" class="menu-button" id="statistiques-btn-fermer" value="FERMER"></a>
                </div>
            </div>
        </div>
    </main>

</body>

</html>