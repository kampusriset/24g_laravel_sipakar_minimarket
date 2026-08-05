import Chart from "chart.js/auto";

document.addEventListener("DOMContentLoaded", () => {

    const container = document.getElementById("restock-data");

    if (!container) return;

    const fuzzyData = JSON.parse(container.dataset.products || "[]");

    const modal = document.getElementById("detailModal");
    const btnCloseModal = document.getElementById("btnCloseModal");
    const btnTutup = document.getElementById("btnTutup");

    // ===========================
    // Tombol Detail AI
    // ===========================

    document.querySelectorAll(".btn-detail").forEach(button => {

        button.addEventListener("click", () => {

            const index = Number(button.dataset.index);
            const data = fuzzyData[index];

            if (!data) return;
            const ruleContainer =
                document.getElementById("ruleContainer");

            ruleContainer.innerHTML = "";

            data.rule

                .filter(rule => rule.alpha > 0)
                .forEach(rule => {

                    ruleContainer.innerHTML += `
        
                <div class="border rounded-lg p-3">
        
                    <div class="font-semibold">
        
                        ${rule.nama}
        
                    </div>
        
                    <div>
        
                        IF Stock <b>${rule.stock}</b>
        
                        AND Penjualan <b>${rule.penjualan}</b>
        
                        AND Lead Time <b>${rule.leadTime}</b>
        
                    </div>
        
                    <div>
        
                        THEN <b>${rule.status}</b>
        
                    </div>
        
                    <div class="text-red-600">
        
                        α = ${rule.alpha}
        
                    </div>
        
                </div>
        
                `;

                });

            document.getElementById("namaProduk").textContent = data.nama;
            document.getElementById("kategoriProduk").textContent = data.kategori;

            document.getElementById("stock").textContent = data.stock;
            document.getElementById("minimum").textContent = data.minimum;
            document.getElementById("rataPenjualan").textContent = data.rataPenjualan ? data.rataPenjualan + " pcs/minggu": "0 pcs/minggu";

            document.getElementById("score").textContent = data.score;
            document.getElementById("status").textContent = data.status;

            document.getElementById("stockSedikit").textContent = data.stockSedikit;
            document.getElementById("stockSedang").textContent = data.stockSedang;
            document.getElementById("stockBanyak").textContent = data.stockBanyak;

            document.getElementById("jualRendah").textContent = data.jualRendah;
            document.getElementById("jualSedang").textContent = data.jualSedang;
            document.getElementById("jualTinggi").textContent = data.jualTinggi;

            document.getElementById("leadCepat").textContent = data.leadCepat;
            document.getElementById("leadSedang").textContent = data.leadSedang;
            document.getElementById("leadLama").textContent = data.leadLama;

            document.getElementById("barStockSedikit").style.width =
                (data.stockSedikit * 100) + "%";

            document.getElementById("barStockSedang").style.width =
                (data.stockSedang * 100) + "%";

            document.getElementById("barStockBanyak").style.width =
                (data.stockBanyak * 100) + "%";

            document.getElementById("barJualRendah").style.width =
                (data.jualRendah * 100) + "%";

            document.getElementById("barJualSedang").style.width =
                (data.jualSedang * 100) + "%";

            document.getElementById("barJualTinggi").style.width =
                (data.jualTinggi * 100) + "%";

            // Kesimpulan AI
            let kesimpulan = "";

            if (data.status === "Segera Restock") {
                kesimpulan =
                    "Produk memiliki prioritas tinggi untuk segera dilakukan restock karena stok rendah dan tingkat penjualan tinggi.";
            } else if (data.status === "Perlu Dipantau") {
                kesimpulan =
                    "Produk masih tersedia namun perlu dipantau karena berpotensi segera membutuhkan restock.";
            } else {
                kesimpulan =
                    "Stok produk masih aman sehingga belum memerlukan restock.";
            }

            document.getElementById("kesimpulanAI").textContent = kesimpulan;

            modal.classList.remove("hidden");
            modal.classList.add("flex");

        });

    });

    // ===========================
    // Fungsi Tutup Modal
    // ===========================

    function closeModal() {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }

    btnCloseModal?.addEventListener("click", closeModal);

    btnTutup?.addEventListener("click", closeModal);

    // Klik area hitam untuk menutup
    modal?.addEventListener("click", function (e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Tekan tombol ESC
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeModal();
        }
    });


    // ==========================
    // PIE CHART
    // ==========================

    const chartContainer = document.getElementById("chart-data");

    if (chartContainer) {

        const chartData = JSON.parse(chartContainer.dataset.chart);

        const ctx = document.getElementById("statusChart");

        new Chart(ctx, {

            type: "pie",

            data: {

                labels: Object.keys(chartData),

                datasets: [{

                    data: Object.values(chartData),

                    backgroundColor: [

                        "#ef4444",
                        "#facc15",
                        "#22c55e"

                    ],

                    borderColor: "#ffffff",
                    borderWidth: 3,
                    hoverOffset: 15

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        position: "bottom",

                        labels: {

                            padding: 20,
                            font: {

                                size: 14

                            }

                        }

                    }

                }

            }

        });

    }

    const barContainer = document.getElementById("bar-chart-data");

    if (barContainer) {

        const data = JSON.parse(barContainer.dataset.chart);

        const ctx = document.getElementById("priorityChart");

        new Chart(ctx, {

            type: "bar",

            data: {

                labels: data.labels,

                datasets: [{

                    label: "Score AI",

                    data: data.scores,

                    backgroundColor: "#ef4444",

                    borderRadius: 8

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        display: false

                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        max: 100

                    }

                }

            }

        });

    }
    const trendContainer = document.getElementById("trend-chart-data");

    if (trendContainer) {

        const trend = JSON.parse(trendContainer.dataset.chart);

        new Chart(document.getElementById("trendChart"), {

            type: "line",

            data: {

                labels: trend.labels,

                datasets: [{

                    label: "Jumlah Terjual",

                    data: trend.data,

                    borderColor: "#3b82f6",

                    backgroundColor: "rgba(59,130,246,0.2)",

                    fill: true,

                    tension: 0.4

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        display: false

                    }

                }

            }

        });

    }

});