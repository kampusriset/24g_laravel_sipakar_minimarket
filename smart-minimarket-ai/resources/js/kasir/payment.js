// ==========================================
// PAYMENT.JS
// ==========================================

const cash = document.getElementById("cash");
const btnCheckout = document.getElementById("btnCheckout");
const kembaliText = document.getElementById("kembalian");

// Jika element belum ada, hentikan script
if (!cash || !btnCheckout || !kembaliText) {
    console.error("Element payment tidak ditemukan.");
} else {

    // ==========================================
    // BLOK INPUT SELAIN ANGKA
    // ==========================================

    cash.addEventListener("keydown", function (e) {

        if (["-", "+", "e", "E"].includes(e.key)) {
            e.preventDefault();
        }

    });

    // ==========================================
    // INPUT PEMBAYARAN
    // ==========================================

    cash.addEventListener("input", function () {

        // hanya angka
        this.value = this.value.replace(/\D/g, "");

        hitungKembalian();

    });

}

// ==========================================
// HITUNG KEMBALIAN
// ==========================================

window.hitungKembalian = function () {

    if (!cash || !btnCheckout || !kembaliText) return;

    let total = 0;

    window.cart.forEach(item => {

        total += item.qty * item.harga;

    });

    const bayar = Number(cash.value || 0);

    // ==========================
    // Keranjang kosong
    // ==========================

    if (total === 0) {

        kembaliText.innerHTML = "Rp0";

        btnCheckout.disabled = true;

        return;

    }

    // ==========================
    // Uang kurang
    // ==========================

    if (bayar < total) {

        kembaliText.innerHTML =
            "Kurang Rp " +
            (total - bayar).toLocaleString("id-ID");

        btnCheckout.disabled = true;
        btnCheckout.className =
            "w-full mt-8 py-3 rounded-xl bg-gray-300 text-gray-500 font-bold cursor-not-allowed";

        return;

    }

    // ==========================
    // Uang cukup
    // ==========================

    const kembali = bayar - total;

    kembaliText.innerHTML =
        "Rp " + kembali.toLocaleString("id-ID");

    btnCheckout.disabled = false;

    btnCheckout.className =
        "w-full mt-8 py-3 rounded-xl bg-yellow-400 hover:bg-yellow-500 font-bold text-black transition";

}

// ==========================================
// RESET PAYMENT
// ==========================================

window.resetPayment = function () {

    if (!cash || !btnCheckout || !kembaliText) return;

    cash.value = "";

    kembaliText.innerHTML = "Rp0";

    btnCheckout.disabled = true;

}