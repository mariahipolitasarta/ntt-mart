let orders = JSON.parse(localStorage.getItem("orders")) || [];

let area = document.getElementById("history");

if (orders.length == 0) {

    area.innerHTML = `
    <div class="empty">
        Belum ada pesanan.
    </div>
    `;

} else {

    orders.reverse().forEach(o => {

        area.innerHTML += `
        <div class="card">

            <div class="row">
                <span>No Pesanan</span>
                <b>#${o.id}</b>
            </div>

            <div class="row">
                <span>Tanggal</span>
                <span>${o.tanggal}</span>
            </div>

            <div class="row">
                <span>Status</span>
                <span class="status">${o.status}</span>
            </div>

            <hr>

            <div class="row">
                <span>Total Pembayaran</span>
                <span class="total">
                    Rp ${o.total.toLocaleString("id-ID")}
                </span>
            </div>

        </div>
        `;

    });

}