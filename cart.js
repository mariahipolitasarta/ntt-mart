// ============================
// DATA PRODUK
// ============================
const products = [
    {
        id: 1,
        nama: "Kopi Flores",
        harga: 75000,
        gambar: "img/kopi.jpg"
    },
    {
        id: 2,
        nama: "Tenun Ikat",
        harga: 350000,
        gambar: "img/tenun.jpg"
    },
    {
        id: 3,
        nama: "Selendang Tenun",
        harga: 180000,
        gambar: "img/selendang.png"
    },
    {
        id: 4,
        nama: "Kopi Nagekeo",
        harga: 65000,
        gambar: "img/nagekeo.jpg"
    }
];

// ============================
// AMBIL DATA TROLI
// ============================
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// ============================
// SIMPAN TROLI
// ============================
function saveCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

// ============================
// TAMBAH PRODUK
// ============================
function tambah(id){

    let item = cart.find(p => p.id === id);

    if(item){
        item.qty++;
    }else{
        cart.push({
            id:id,
            qty:1
        });
    }

    saveCart();

    window.location.href = "cart.html";
}

// ============================
// TOMBOL +
// ============================
function chg(id, nilai) {

    let item = cart.find(p => p.id === id);

    if (!item) return;

    item.qty += nilai;

    if (item.qty <= 0) {
        cart = cart.filter(p => p.id !== id);
    }

    saveCart();

    render();

}

// ============================
// HAPUS
// ============================
function del(id) {

    if (confirm("Hapus produk ini?")) {

        cart = cart.filter(p => p.id !== id);

        saveCart();

        render();

    }

}

// ============================
// FORMAT RUPIAH
// ============================
function rupiah(angka) {
    return "Rp " + angka.toLocaleString("id-ID");
}

// ============================
// TAMPILKAN TROLI
// ============================
function render() {

    const area = document.getElementById("cart");

    const summary = document.getElementById("summary");

    if (!area) return;

    area.innerHTML = "";

    let subtotal = 0;

    let totalItem = 0;

    // Keranjang kosong
    if (cart.length == 0) {

        area.innerHTML = `
        <div class="empty-cart">

            <div class="icon">🛒</div>

            <h3>Keranjang Masih Kosong</h3>

            <p>Yuk tambahkan produk favoritmu</p>

            <a class="btn" href="kategori.html">
                Belanja Sekarang
            </a>

        </div>
        `;

        if (summary) {

            summary.innerHTML = `
            <div class="summary">

                <h3>Ringkasan Pesanan</h3>

                <p>Belum ada produk.</p>

            </div>
            `;

        }

        return;
    }

    // Produk dalam troli
    cart.forEach(item => {

        let p = products.find(x => x.id == item.id);

        if (!p) return;

        let sub = p.harga * item.qty;

        subtotal += sub;

        totalItem += item.qty;

        area.innerHTML += `

        <div class="cart-item">

            <img src="${p.gambar}">

            <div class="info">

                <h3>${p.nama}</h3>

                <div class="price">
                    ${rupiah(sub)}
                </div>

                <div class="qty-row">

                    <button class="qty-btn"
                        onclick="chg(${item.id},-1)">
                        -
                    </button>

                    <span class="qty-text">
                        ${item.qty}
                    </span>

                    <button class="qty-btn"
                        onclick="chg(${item.id},1)">
                        +
                    </button>

                    <button class="hapus"
                        onclick="del(${item.id})">
                        🗑
                    </button>

                </div>

            </div>

        </div>

        `;

    });

    let ongkir = 25000;

    let total = subtotal + ongkir;

    if (summary) {

        summary.innerHTML = `

        <div class="summary">

            <h3>Ringkasan Pesanan</h3>

            <div class="summary-row">
                <span>Total Item</span>
                <span>${totalItem}</span>
            </div>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>${rupiah(subtotal)}</span>
            </div>

            <div class="summary-row">
                <span>Ongkir</span>
                <span>${rupiah(ongkir)}</span>
            </div>

            <hr>

            <div class="total-bayar">

                <span>Total</span>

                <span>${rupiah(total)}</span>

            </div>

            <a class="btn" href="checkout.html">
    Lanjut ke Pembayaran
</a>

        </div>

        `;

    }

}

// ============================
// JALANKAN
// ============================
render();