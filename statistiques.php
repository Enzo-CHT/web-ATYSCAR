<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>STATISTIQUES</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="js/statsViewer.js"></script>

</head>

<body>
    <main id="statistiques">
        <div>


            <div class="container">

                <img class="logo" src="addons/img/Atys Car.jpg" alt="atyscar-logo">

                <div class="box-c">
                    <div class="container-element">
                        <label for="statistiques-type-stat">Type de statistiques</label>
                        <input id="statistiques-type-stat" type="text" list="stat_list">
                        <datalist id="stat_list">
                            <option value="blank"></option>
                            <!-- Enter Option here !-->
                        </datalist>
                    </div>


                </div>
            </div>
            <div id="stats"></div>
            <div class="box-l">
                <div class="container-element">
                    <input type="button" class="menu-button" id="statistiques-btn-selectionner" value="SELECTIONNER">
                </div>
                <div class="container-element">
                    <input type="button" class="menu-button" id="statistiques-btn-aide" value="AIDE">
                    <a href="index.html"><input type="button" class="menu-button" id="statistiques-btn-fermer" value="FERMER"></a>
                </div>
            </div>
        </div>
    </main>

</body>

</html>