$(document).ready(function() {
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    Chart.defaults.global.legend.labels.usePointStyle = true;
    var xAxisLabel, yAxislabel, xAxisDataSet, yAxisDataSet, graphType, legendLabel;
    drawBarGraph();
    drawDoughnut();

    // Area Chart Overview
    function drawLineGraph() {
        var ctx = document.getElementById("booking-trend");
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
                    backgroundColor: "#0055CB",
                    bodyFontColor: "#ffffff",
                    titleMarginBottom: 10,
                    titleFontColor: '#ffffff',
                    titleFontSize: 14,
                    borderColor: '#0055CB',
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
                },
                legendCallback: (chart) => {
                    const renderLabels = (chart) => {
                    const { data } = chart;
                    return data.datasets[0].data
                        .map(
                        (_, i) =>
                            `<li>
                                <div id="legend-${i}-item" class="legend-item">
                                <span style="background-color:
                                    ${data.datasets[0].backgroundColor[i]}">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                                ${
                                    data.labels[i] &&
                                    `<span class="label">${data.labels[i]}: $${data.datasets[0].data[i]}</span>`
                                }
                                </div>
                            </li>
                        `
                        )
                        .join("");
                    };
                    return `<ul class="chartjs-legend">
                                ${renderLabels(chart)}
                            </ul>`;
                },
            }
        });
    }

    function drawDoughnut() {
        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [55, 30, 15, 20, 30, 15, 4],
                    backgroundColor: ['#33a02c', '#fdbf6f', '#b2df8a', '#a6cee3', '#fb9a99', '#e31a1c', '#1f78b4'],
                    hoverBackgroundColor: ['#33a02c', '#fdbf6f', '#b2df8a', '#a6cee3', '#fb9a99', '#e31a1c', '#1f78b4'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
                labels: ["Maternal care", "Child healthcare", "Family planning", "Non communicable", "Tuberculosis", "HIV & AIDS", "Other"]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "#147ad6",
                    bodyFontColor: "#ffffff",
                    borderColor: '#147ad6',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    caretPadding: 10,
                },
                plugins: {
                    labels: false
                },
                legend: {
                    display: false,
                    position: 'bottom',
                    align: 'start',
                },
                cutoutPercentage: 45,
                title: {
                    display: true,
                    text: 'Medical Conditions'
                },
                labels: {
                    display: false
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            },
        };
        var ctx = document.getElementById("medical-conditions-doughnut").getContext("2d");
        window.myDoughnut = new Chart(ctx, config);
    }

    function drawBarGraph() {
        var barChartData = {
            labels: ["0-10", "11-20", "21-30", "31-40", "41-50", "51-60", "61-70", "71-80", "81-90", "91-100"],
            datasets: [{
                backgroundColor: '#002147',
                borderColor: '#002147',
                borderWidth: 1,
                data: [987, 704, 300, 207, 409, 176, 86, 101, 41, 8]
            }]
        };

        var ctx = document.getElementById("booking-trend").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                    display: false,
                },
                title: {
                    display: true,
                    text: 'Age Group Booking Trend'
                },
                tooltips: {
                    backgroundColor: "#0055CB",
                    bodyFontColor: "#ffffff",
                    titleMarginBottom: 10,
                    titleFontColor: '#ffffff',
                    titleFontSize: 14,
                    borderColor: '#0055CB',
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
                },
                hover: {
                    mode: 'nearest',
                    intersect: false
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Age Groups',
                            fontColor: '#1f78b4'
                        },
                        gridLines: {
                            display:false
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Number Of Bookings',
                            fontColor: '#1f78b4'
                        },
                        gridLines: {
                            display:false
                        }
                    }]
                }
            }
        });
    }

    function number_format(number, decimals, dec_point, thousands_sep) {
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

});