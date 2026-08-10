document.addEventListener("DOMContentLoaded", function () {

    const canvas = document.getElementById("salesTrendChart");

    if (!canvas) {
        return;
    }


    new Chart(canvas, {

        type: "line",

        data: {

            labels: window.salesChartLabels,

            datasets: [
                {

                    label: "Penjualan",

                    data: window.salesChartData,

                    borderWidth: 3,

                    tension: 0.3,

                    fill: true,

                    pointRadius: 5,

                    pointHoverRadius: 7

                }
            ]

        },


        options: {

            responsive: true,
            maintainAspectRatio: false,


            plugins: {

                legend: {

                    display: false

                }

            },


            scales: {

                y: {

                    ticks: {

                        callback: function(value){

                            return "Rp " +
                            value.toLocaleString("id-ID");

                        }

                    }

                }

            }


        }


    });


});