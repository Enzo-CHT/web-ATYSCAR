window.addEventListener('DOMContentLoaded', function () {
    var selectElement = document.getElementById("statistiques-type-stat");

    // première initialisation
    displayGraphics(selectElement.value, 0);

    
    selectElement.addEventListener('change', function () {
        //Recupère l'option selectionné
        var selectedOption = this.options[this.selectedIndex];

        if (selectedOption) {
            var optionId = selectedOption.id;

            displayGraphics(selectedOption.text, optionId);
        }
    });

});



/**
 * Fonction d'affichage des données
 * @param {*} titre Titre du graphique
 * @param {*} typeStats Type de statistic à générer 
 */
function displayGraphics(titre, typeStats) {


    document.querySelector("#stats").innerHTML = "";
    if (window.myChart)
        window.myChart.destroy();


    // Contient les données affichés dans l'axe X
    /// Ville
    /// Periode
    /// Ville + Periode 
    xLabels = [];

    // Contient les données affichés dans le grahique (avec leur label)
    /// name : Type_Vehicule
    /// data : Recours concurrence
    /// data : Utilisation %
    dataDisplay = [];

    // Importation des données depuis la base de données
    $.ajax({
        url: 'php/statsModel.php',
        type: 'GET',
        async: false,
        data: {
            userStats: typeStats,
        },
        success: function (response) {
            res = JSON.parse(response);
            xLabels = res[0];
            dataDisplay = res[1];

        }
    })



    var options = {
        // Affiche le nom et les données associé, dans l'ordre, à chaque date
        series: dataDisplay,
        chart: {
            height: 350,
            width: 450,
            type: 'bar',
            zoom: {
                enabled: false
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 3,
            curve: 'straight',
            dashArray: 0
        },
        title: {
            text: 'Statistique ' + titre,
            align: 'left',
        },
        legend: {
            tooltipHoverFormatter: function (val, opts) {
                return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + '%'
            }
        },
        markers: {
            size: 0,
            hover: {
                sizeOffset: 6
            }
        },
        xaxis: {
            categories: xLabels,
        },
        tooltip: {
            y: [
                {
                    title: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                },
                {
                    title: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                },
                {
                    title: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                }
            ]
        },
        grid: {
            borderColor: '#f1f1f1',
        }
    };

    // Utilisation de apexcharts pour générer un graphique
    var myChart = new ApexCharts(document.querySelector("#stats"), options);
    myChart.render();




}
