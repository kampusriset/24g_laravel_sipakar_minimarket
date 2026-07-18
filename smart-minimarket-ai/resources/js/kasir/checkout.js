// ==========================================
// CHECKOUT.JS
// ==========================================

const btnCheckout = document.getElementById("btnCheckout");

btnCheckout.addEventListener("click", async () => {

    if (window.cart.length === 0) {
        alert("Keranjang masih kosong.");
        return;
    }

    const total = window.cart.reduce((sum, item) => {
        return sum + (item.qty * item.harga);
    }, 0);

    const bayar = Number(document.getElementById("cash").value);

    if (bayar < total) {
        alert("Uang pembayaran kurang.");
        return;
    }

    btnCheckout.disabled = true;
    btnCheckout.textContent = "Memproses...";

    try {

        const response = await fetch("/kasir/checkout", {

            method: "POST",

            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .content
            },

            body: JSON.stringify({

                cart: window.cart.map(item => ({
                    id: item.id,
                    qty: item.qty
                })),

                total,
                bayar

            })

        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message);
        }

        alert(data.message);

        // ==========================
        // RESET
        // ==========================

        window.cart.length = 0;

        window.renderCart();

        window.resetPayment();

    } catch (error) {

        console.error(error);

        alert(error.message);

    } finally {

        btnCheckout.textContent = "BELI";

        btnCheckout.disabled = false;

    }

});