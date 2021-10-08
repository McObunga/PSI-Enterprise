// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
Chart.defaults.global.legend.labels.usePointStyle = true;

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}



// Area Chart Telemedicine
var ctx = document.getElementById("myAreaChartTelemedicine");
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "In-person",
            fill: false,
            lineTension: 0,
            backgroundColor: "blue",
            borderColor: "blue",
            borderWidth: 1,
            pointRadius: 3,
            pointBackgroundColor: "white",
            pointBorderColor: "blue",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "blue",
            pointHoverBorderColor: "blue",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [5000, 10500, 5600, 1000, 10000, 2000, 5000, 5000, 2000, 1000, 5000, 2100],
        }, {
            label: "Telemedicine",
            fill: false,
            lineTension: 0,
            backgroundColor: "green",
            borderColor: "green",
            borderWidth: 1,
            pointRadius: 3,
            pointBackgroundColor: "white",
            pointBorderColor: "green",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "green",
            pointHoverBorderColor: "green",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [500, 2000, 5000, 7000, 6600, 2000, 5600, 4000, 6000, 3070, 500, 2000],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                display: true,
                time: {
                    unit: 'date'
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Month',
                    fontColor: 'blue',
                },
                gridLines: {
                    display: false,
                    drawBorder: false,
                    drawTicks: false,
                    display: false
                },
                ticks: {
                    maxTicksLimit: 12,

                }
            }],
            yAxes: [{
                display: true,
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return '$' + number_format(value);
                    }
                },

                gridLines: {
                    display: false,
                    drawBorder: false,
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Number Of Bookings',
                    fontColor: 'blue',
                },
            }],
        },
        legend: {
            display: true
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: true,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                }
            }
        }
    }
});

// Area Chart In-person
var ctx = document.getElementById("myAreaChartInPerson");
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "In-person",
            fill: false,
            lineTension: 0,
            backgroundColor: "blue",
            borderColor: "blue",
            borderWidth: 1,
            pointRadius: 3,
            pointBackgroundColor: "white",
            pointBorderColor: "blue",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "blue",
            pointHoverBorderColor: "blue",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [5000, 10500, 5600, 1000, 10000, 2000, 5000, 5000, 2000, 1000, 5000, 2100],
        }, {
            label: "Telemedicine",
            fill: false,
            lineTension: 0,
            backgroundColor: "green",
            borderColor: "green",
            borderWidth: 1,
            pointRadius: 3,
            pointBackgroundColor: "white",
            pointBorderColor: "green",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "green",
            pointHoverBorderColor: "green",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [500, 2000, 5000, 7000, 6600, 2000, 5600, 4000, 6000, 3070, 500, 2000],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                display: true,
                time: {
                    unit: 'date'
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Month',
                    fontColor: 'blue',
                },
                gridLines: {
                    display: false,
                    drawBorder: false,
                    drawTicks: false,
                    display: false
                },
                ticks: {
                    maxTicksLimit: 12,

                }
            }],
            yAxes: [{
                display: true,
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return '$' + number_format(value);
                    }
                },

                gridLines: {
                    display: false,
                    drawBorder: false,
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Number Of Bookings',
                    fontColor: 'blue',
                },
            }],
        },
        legend: {
            display: true
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: true,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                }
            }
        }
    }
});

// Area Chart All
var ctx = document.getElementById("myAreaChartAll");
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "In-person",
            fill: false,
            lineTension: 0,
            backgroundColor: "blue",
            borderColor: "blue",
            borderWidth: 1,
            pointRadius: 3,
            pointBackgroundColor: "white",
            pointBorderColor: "blue",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "blue",
            pointHoverBorderColor: "blue",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [5000, 10500, 5600, 1000, 10000, 2000, 5000, 5000, 2000, 1000, 5000, 2100],
        }, {
            label: "Telemedicine",
            fill: false,
            lineTension: 0,
            backgroundColor: "green",
            borderColor: "green",
            borderWidth: 1,
            pointRadius: 3,
            pointBackgroundColor: "white",
            pointBorderColor: "green",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "green",
            pointHoverBorderColor: "green",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [500, 2000, 5000, 7000, 6600, 2000, 5600, 4000, 6000, 3070, 500, 2000],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                display: true,
                time: {
                    unit: 'date'
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Month',
                    fontColor: 'blue',
                },
                gridLines: {
                    display: false,
                    drawBorder: false,
                    drawTicks: false,
                    display: false
                },
                ticks: {
                    maxTicksLimit: 12,

                }
            }],
            yAxes: [{
                display: true,
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return '$' + number_format(value);
                    }
                },

                gridLines: {
                    display: false,
                    drawBorder: false,
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Number Of Bookings',
                    fontColor: 'blue',
                },
            }],
        },
        legend: {
            display: true
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: true,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                }
            }
        }
    }
});

