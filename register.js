function lanjut() {

    let nama = document.getElementById("nama").value;
    let telepon = document.getElementById("telepon").value;
    let alamat = document.getElementById("alamat").value;

    if (nama === "" || telepon === "" || alamat === "") {
        alert("Lengkapi semua data!");
        return;
    }

    localStorage.setItem("customer", JSON.stringify({
        nama,
        telepon,
        alamat
    }));

    window.location.href = "checkout.html";
}