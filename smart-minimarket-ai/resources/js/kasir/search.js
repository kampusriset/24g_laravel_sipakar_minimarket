// ==========================================
// SEARCH.JS
// ==========================================

const searchInput = document.getElementById("searchProduct");
const result = document.getElementById("searchResult");
const kategori = document.getElementById("kategoriFilter");


if (!searchInput || !result) {

    console.log("Search.js dilewati");

} else {


async function cariProduk() {


    const keyword = searchInput.value.trim();

    const categoryId = kategori.value;


    const response = await fetch(
        "/products/search?q="
        + encodeURIComponent(keyword)
        + "&category_id="
        + categoryId
    );


    const products = await response.json();


    result.innerHTML = "";


    if(products.length === 0){

        result.innerHTML = `
            <div class="p-4 text-gray-400 text-center">
                Produk tidak ditemukan
            </div>
        `;

        result.classList.remove("hidden");

        return;

    }


    products.forEach(product => {


        result.innerHTML += `

        <div 
            class="product-item p-4 border-b cursor-pointer"
            data-id="${product.id}"
            data-name="${product.nama_produk}"
            data-price="${product.harga_jual}"
            data-stock="${product.stock}"
        >

            <b>${product.nama_produk}</b>

            <div>
                Rp ${Number(product.harga_jual)
                .toLocaleString("id-ID")}
            </div>

        </div>

        `;


    });


    result.classList.remove("hidden");

}



searchInput.addEventListener(
    "keyup",
    cariProduk
);



kategori.addEventListener(
    "change",
    cariProduk
);



result.addEventListener(
    "click",
    function(e){


        const item = e.target.closest(".product-item");


        if(!item) return;


        window.addToCart({

            id:Number(item.dataset.id),

            nama:item.dataset.name,

            harga:Number(item.dataset.price),

            stock:Number(item.dataset.stock)

        });


        searchInput.value = "";

        result.innerHTML = "";

        result.classList.add("hidden");


    }
);



document.addEventListener(
    "click",
    function(e){

        if(
            !searchInput.contains(e.target)
            &&
            !result.contains(e.target)
        ){

            result.classList.add("hidden");

        }

    }
);


}