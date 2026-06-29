<?php
include 'data.php';

if(isset($_SESSION['id_user'])){

    $user = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            "SELECT * FROM users WHERE id='".$_SESSION['id_user']."'"
        )
    );

}else{

    $user = [
        'nama' => 'Pengunjung',
        'telepon' => '-',
        'alamat' => 'Alamat belum diisi'
    ];

}

$total = 0;
$total_item = 0;
$ongkir = 25000;

if(isset($_POST['bayar'])){

    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){

        $total_order = 0;

        foreach($_SESSION['cart'] as $id => $qty){

            $q = mysqli_query(
                $conn,
                "SELECT * FROM products WHERE id='$id'"
            );

            $p = mysqli_fetch_assoc($q);

            $total_order += ($p['harga'] * $qty);
        }

        $metode = $_POST['metode'];

$id_user = isset($_SESSION['id_user']) 
           ? $_SESSION['id_user'] 
           : 0;

mysqli_query($conn,"
INSERT INTO orders(
    id_user,
    total,
    metode_pembayaran,
    status
)
VALUES(
    '$id_user',
    '$total_order',
    '$metode',
    'Menunggu'
)
");

        unset($_SESSION['cart']);

        echo "
        <script>
        alert('✅ Pesanan berhasil dibuat!');
        window.location='history.php';
        </script>
        ";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Rincian Pesanan</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:#f5f5f5;
    padding-bottom:90px;
}

.header{
    background:linear-gradient(180deg,#4b0000,#7a0000);
    color:white;
    text-align:center;
    padding:20px;
}

.container{
    padding:15px;
}

.title-box{
    background:#5f0b0b;
    color:white;
    text-align:center;
    padding:12px;
    border-radius:10px;
    margin-bottom:15px;
    font-weight:bold;
}

.card{
    background:white;
    border-radius:12px;
    padding:15px;
    margin-bottom:15px;
    box-shadow:0 2px 5px rgba(0,0,0,.1);
}

.card h3{
    margin-bottom:10px;
    color:#333;
}

.row{
    display:flex;
    justify-content:space-between;
    margin:8px 0;
}

.total{
    font-size:22px;
    font-weight:bold;
    color:#7a0000;
}

.btn{
    width:100%;
    border:none;
    background:#d4a12a;
    color:white;
    padding:15px;
    border-radius:10px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

.btn:hover{
    opacity:.9;
}

.bottom-nav{
    position:fixed;
    bottom:0;
    width:100%;
    background:#4b0000;
    display:flex;
    justify-content:space-around;
    padding:15px;
}

.bottom-nav a{
    color:#d4a12a;
    text-decoration:none;
    font-size:14px;
}

.produk-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:8px;
}

.alamat{
    line-height:1.6;
}

</style>
</head>

<body>

<div class="header">
    <h2>NTT MART DIGITAL</h2>
</div>

<div class="container">

    <div class="title-box">
        Rincian Pesanan
    </div>

    <div class="card">

        <h3>Alamat Pengiriman</h3>

        <div class="alamat">

            <b><?php echo $user['nama']; ?></b><br>

            <?php echo $user['telepon']; ?><br>

            <?php echo $user['alamat']; ?>

        </div>

    </div>

    <div class="card">

        <h3>Pilihan Pengiriman</h3>

        J&T Regular (Estimasi 2-4 Hari)<br><br>

        <b>Rp <?php echo number_format($ongkir); ?></b>

    </div>

    <div class="card">

        <h3>Ringkasan Belanja</h3>

        <?php

        if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){

            foreach($_SESSION['cart'] as $id => $qty){

                $q = mysqli_query(
                    $conn,
                    "SELECT * FROM products WHERE id='$id'"
                );

                $p = mysqli_fetch_assoc($q);

                $subtotal = $p['harga'] * $qty;

                $total += $subtotal;
                $total_item += $qty;
        ?>

        <div class="produk-row">

            <span>
                <?php echo $p['nama_produk']; ?>
                (<?php echo $qty; ?>x)
            </span>

            <span>
                Rp <?php echo number_format($subtotal); ?>
            </span>

        </div>

        <?php
            }
        }else{
            echo "<center>Belum ada produk di troli</center>";
        }
        ?>

        <hr style="margin:10px 0;">

        <div class="row">

            <b>Total Item (<?php echo $total_item; ?>)</b>

            <b>Rp <?php echo number_format($total); ?></b>

        </div>

    </div>

    <?php
    $grandtotal = $total + $ongkir;
    ?>


</div>

    </div>

    <form method="POST">

    <div class="card">

        <h3>Metode Pembayaran</h3>

        <label style="display:block;margin-bottom:10px;">
            <input type="radio"
                   name="metode"
                   value="QRIS"
                   checked>
            QRIS
        </label>

        <label style="display:block;margin-bottom:10px;">
            <input type="radio"
                   name="metode"
                   value="GoPay">
            GoPay
        </label>

        <label style="display:block;">
            <input type="radio"
                   name="metode"
                   value="Transfer Bank">
            Transfer Bank
        </label>

    </div>

    <button
        type="submit"
        class="btn"
        name="bayar">

        🔒 Konfirmasi Pesanan & Bayar

    </button>

</form>
</div>

<div class="bottom-nav">
    <a href="home.php">Home</a>
    <a href="kategori.php">Kategori</a>
    <a href="cart.php">Troli</a>
    <a href="history.php">Pesanan</a>
    <a href="profile.php">Profil</a>
</div>

</body>
</html>