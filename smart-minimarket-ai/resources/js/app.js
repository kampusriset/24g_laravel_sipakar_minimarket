import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.data("restockPage", () => ({
    showModal: false,

    selected: null,

    data: [],

    init() {
        const element = document.getElementById("restock-data");

        if (element) {
            try {
                this.data = JSON.parse(
                    element.dataset.fuzzy || "[]"
                );
            } catch (error) {
                console.error(
                    "Gagal membaca data fuzzy:",
                    error
                );

                this.data = [];
            }
        }
    },

    openDetail(index) {
        this.selected = this.data[index];

        this.showModal = true;

        document.body.classList.add(
            "overflow-hidden"
        );
    },

    closeDetail() {
        this.showModal = false;

        this.selected = null;

        document.body.classList.remove(
            "overflow-hidden"
        );
    }
}));

Alpine.start();