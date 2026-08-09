// ==========================================
// SEARCH.JS
// ==========================================

const search = document.getElementById("searchProduct");
const result = document.getElementById("searchResult");
const app = document.querySelector('#kasir-app');

const products = JSON.parse(
    app.dataset.products
);

console.log(products);

// Jika bukan halaman kasir, hentikan script
if (!search || !result) {
    console.log("Search.js dilewati (bukan halaman kasir)");
} else {

    // ==========================================
    // SEARCH PRODUK
    // ==========================================

    search.addEventListener("keyup", async function () {

        const keyword = this.value.trim();

        if (keyword.length < 2) {

            result.innerHTML = "";
            result.classList.add("hidden");
            return;

        }

        try {

            const response = await fetch(
                "/products/search?q=" + encodeURIComponent(keyword)
            );

            const products = await response.json();

            result.innerHTML = "";

            if (products.length === 0) {

                result.innerHTML = `
                    <div class="p-4 text-center text-gray-400">
                        Produk tidak ditemukan
                    </div>
                `;

                result.classList.remove("hidden");
                return;
            }

            products.forEach(product => {

                result.innerHTML += `
                    <div
                        class="product-item p-4 border-b hover:bg-yellow-50 cursor-pointer transition"
                        data-id="${product.id}"
                        data-name="${product.nama_produk}"
                        data-price="${product.harga_jual}"
                        data-stock="${product.stock}">

                        <div class="font-semibold">
                            ${product.nama_produk}
                        </div>

                        <div class="text-sm text-gray-500">
                            ${product.kode_produk}
                            •
                            Rp ${Number(product.harga_jual).toLocaleString("id-ID")}
                        </div>

                        <div class="text-xs text-gray-400 mt-1">
                            Stock : ${product.stock}
                        </div>

                    </div>
                `;

            });

            result.classList.remove("hidden");

        } catch (error) {

            console.error(error);

        }

    });

    // ==========================================
    // PILIH PRODUK
    // ==========================================

    result.addEventListener("click", function (e) {

        const item = e.target.closest(".product-item");

        if (!item) return;

        window.addToCart({

            id: Number(item.dataset.id),
            nama: item.dataset.name,
            harga: Number(item.dataset.price),
            stock: Number(item.dataset.stock)

        });

        search.value = "";
        result.innerHTML = "";
        result.classList.add("hidden");

    });

    // ==========================================
    // TUTUP DROPDOWN
    // ==========================================

    document.addEventListener("click", function (e) {

        if (
            !search.contains(e.target) &&
            !result.contains(e.target)
        ) {

            result.classList.add("hidden");

        }

    });

}