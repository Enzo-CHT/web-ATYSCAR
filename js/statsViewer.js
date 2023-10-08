// Wait for the ApexCharts library to be fully loaded
window.addEventListener('DOMContentLoaded', function () {
    displayGraphics();
});




function randomArray() {
    var arrayRandom = [];
    for (var i = 0; i < 3; i++) {
        var nb = Math.floor(Math.random() * 101);
        arrayRandom.push(nb);

    }
    return arrayRandom;
}

function displayGraphics(data = null) {



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

    $.ajax({
        url: 'php/statsModel.php',
        type: 'GET',
        async: false,
        success: function (response) {
            res = JSON.parse(response);
            xLabels = res[0];
            dataDisplay = res[1];
            console.log(dataDisplay);
        }
    })



    var options = {
        // Affiche le nom et les données associé, dans l'ordre, à chaque date
        series: dataDisplay,
        chart: {
            height: 350,
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
            text: 'Page Statistics',
            align: 'left'
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

    var chart = new ApexCharts(document.querySelector("#stats"), options);
    chart.render();
}
