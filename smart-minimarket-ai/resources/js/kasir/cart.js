// ==========================================
// CART.JS
// ==========================================

window.cart = [];

const cartContainer = document.getElementById("cartContainer");

// ==========================================
// TAMBAH KE KERANJANG
// ==========================================

window.addToCart = function (product) {

    const existing = window.cart.find(item => item.id === product.id);

    if (existing) {

        if (existing.qty >= existing.stock) {
            alert("Stock tidak mencukupi.");
            return;
        }

        existing.qty++;

    } else {

        window.cart.push({
            id: product.id,
            nama: product.nama,
            harga: Number(product.harga),
            stock: Number(product.stock),
            qty: 1
        });

    }

    renderCart();

}

// ==========================================
// RENDER CART
// ==========================================

window.renderCart = function () {

    if (window.cart.length === 0) {

        cartContainer.innerHTML = `
            <div class="text-center text-gray-400 py-20">
                Belum ada produk.
            </div>
        `;

        updateTotal();

        return;

    }

    let html = "";

    window.cart.forEach(item => {

        html += `

        <div class="flex justify-between items-center border-b py-4">

            <div>

                <div class="font-semibold">
                    ${item.nama}
                </div>

                <div class="text-sm text-gray-500 mt-1">
                    Rp ${item.harga.toLocaleString("id-ID")}
                </div>

                <div class="text-yellow-600 font-bold mt-1">
                    Rp ${(item.qty * item.harga).toLocaleString("id-ID")}
                </div>

            </div>

            <div class="flex items-center gap-2">

                <button
                    class="minus w-8 h-8 rounded bg-gray-200 hover:bg-gray-300"
                    data-id="${item.id}">
                    -
                </button>

                <span class="w-6 text-center font-bold">
                    ${item.qty}
                </span>

                <button
                    class="plus w-8 h-8 rounded bg-yellow-400 hover:bg-yellow-500"
                    data-id="${item.id}">
                    +
                </button>

                <button
                    class="delete text-red-500 ml-2"
                    data-id="${item.id}">
                    🗑
                </button>

            </div>

        </div>

        `;

    });

    cartContainer.innerHTML = html;

    updateTotal();

}

// ==========================================
// TOTAL
// ==========================================

window.updateTotal = function () {

    let totalItem = 0;
    let totalHarga = 0;

    window.cart.forEach(item => {

        totalItem += item.qty;
        totalHarga += item.qty * item.harga;

    });

    document.getElementById("totalItem").innerHTML =
        totalItem + " Barang";

    document.getElementById("totalHarga").innerHTML =
        "Rp " + totalHarga.toLocaleString("id-ID");

    if (typeof window.hitungKembalian === "function") {
        window.hitungKembalian();
    }

}

// ==========================================
// PLUS MINUS DELETE
// ==========================================

document.addEventListener("click", function (e) {

    // PLUS
    if (e.target.classList.contains("plus")) {

        const id = Number(e.target.dataset.id);

        const item = window.cart.find(p => p.id === id);

        if (!item) return;

        if (item.qty >= item.stock) {

            alert("Stock habis.");

            return;

        }

        item.qty++;

        renderCart();

    }

    // MINUS
    if (e.target.classList.contains("minus")) {

        const id = Number(e.target.dataset.id);

        const item = window.cart.find(p => p.id === id);

        if (!item) return;

        item.qty--;

        if (item.qty <= 0) {

            window.cart = window.cart.filter(p => p.id !== id);

        }

        renderCart();

    }

    // DELETE
    if (e.target.classList.contains("delete")) {

        const id = Number(e.target.dataset.id);

        window.cart = window.cart.filter(p => p.id !== id);

        renderCart();

    }

});