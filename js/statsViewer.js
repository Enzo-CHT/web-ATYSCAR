// Wait for the ApexCharts library to be fully loaded
window.addEventListener('DOMContentLoaded', function () {
    displayGraphics();
});



function randomArray() {
    var arrayRandom = [];
    for (var i = 0; i < 12; i++) {
        var nb = Math.floor(Math.random() * 101);
        arrayRandom.push(nb);

    }
    return arrayRandom;
}

function displayGraphics(data = null) {



    // Contient les données affichés dans l'axe X
    xLabels = ['01 Jan', 'Ville', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
        '10 Jan', '11 Jan', '12 Jan'];

    // Contient les données affichés dans le grahique (avec leur label)
    dataDisplay = [
        {
            name: "Session Duration",
            data: randomArray(),
        },
        {
            name: "Page Views",
            data: randomArray()
        },
        {
            name: 'Total Visits',
            data: randomArray()
        },
        {
            name: 'Total Visits',
            data: randomArray()
        }
    ];




    var options = {
        // Affiche le nom et les données associé, dans l'ordre, à chaque date
        series: dataDisplay,
        chart: {
            height: 350,
            type: 'line',
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
