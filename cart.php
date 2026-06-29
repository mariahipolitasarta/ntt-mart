<?php
include 'data.php';

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

/* TAMBAH PRODUK */
if(isset($_GET['id'])){

    $id = (int)$_GET['id'];

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]++;
    }else{
        $_SESSION['cart'][$id] = 1;
    }

    header("Location: cart.php");
    exit;
}

/* TOMBOL + */
if(isset($_GET['plus'])){

    $id = (int)$_GET['plus'];

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]++;
    }

    header("Location: cart.php");
    exit;
}

/* TOMBOL - */
if(isset($_GET['minus'])){

    $id = (int)$_GET['minus'];

    if(isset($_SESSION['cart'][$id])){

        $_SESSION['cart'][$id]--;

        if($_SESSION['cart'][$id] <= 0){
            unset($_SESSION['cart'][$id]);
        }
    }

    header("Location: cart.php");
    exit;
}

/* HAPUS */
if(isset($_GET['hapus'])){

    $id = (int)$_GET['hapus'];

    if(isset($_SESSION['cart'][$id])){
        unset($_SESSION['cart'][$id]);
    }

    header("Location: cart.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Troli Saya</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:#f5f5f5;
    padding-bottom:100px;
}

.header{
    background:linear-gradient(180deg,#4b0000,#7a0000);
    color:white;
    padding:20px;
    text-align:center;
}

.cart-container{
    padding:15px;
}

.cart-item{
    background:white;
    border-radius:12px;
    padding:10px;
    margin-bottom:12px;
    display:flex;
    gap:10px;
    align-items:center;
    box-shadow:0 2px 5px rgba(0,0,0,.1);
}

.cart-item img{
    width:90px;
    height:90px;
    object-fit:cover;
    border-radius:10px;
}

.info{
    flex:1;
}

.info h3{
    font-size:18px;
    margin-bottom:8px;
}

.price{
    color:#7a0000;
    font-size:20px;
    font-weight:bold;
    margin-bottom:10px;
}

.qty-row{
    display:flex;
    align-items:center;
    gap:10px;
}

.qty-btn{
    width:35px;
    height:35px;
    border-radius:50%;
    background:#d4a12a;
    color:white;
    text-decoration:none;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
    font-size:18px;
}

.qty-text{
    font-size:18px;
    min-width:20px;
    text-align:center;
}

.hapus{
    margin-left:auto;
    color:#7a0000;
    font-size:22px;
    text-decoration:none;
}

.summary{
    background:white;
    margin:15px;
    padding:15px;
    border-radius:12px;
    box-shadow:0 2px 5px rgba(0,0,0,.1);
}

.summary h3{
    margin-bottom:10px;
}

.summary-row{
    display:flex;
    justify-content:space-between;
    margin:8px 0;
}

.total-bayar{
    display:flex;
    justify-content:space-between;
    margin-top:15px;
    font-size:22px;
    font-weight:bold;
    color:#7a0000;
}

.btn{
    display:block;
    width:100%;
    text-align:center;
    background:#d4a12a;
    color:white;
    text-decoration:none;
    padding:15px;
    border-radius:25px;
    margin-top:15px;
}

.empty-cart{
    text-align:center;
    padding:60px 20px;
    background:white;
    border-radius:15px;
    box-shadow:0 2px 5px rgba(0,0,0,.1);
}

.empty-cart .icon{
    font-size:60px;
}

.empty-cart h3{
    margin-top:10px;
}

.empty-cart p{
    color:#666;
    margin-top:10px;
}

.empty-cart a{
    display:inline-block;
    margin-top:15px;
    background:#d4a12a;
    color:white;
    text-decoration:none;
    padding:12px 25px;
    border-radius:25px;
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
}

</style>
</head>

<body>

<div class="header">
    <h2>Troli Saya</h2>
</div>

<div class="cart-container">

<?php

$total = 0;

if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){

    foreach($_SESSION['cart'] as $id => $qty){

        $q = mysqli_query($conn,"SELECT * FROM products WHERE id='$id'");
        $p = mysqli_fetch_assoc($q);

        if(!$p){
            continue;
        }

        $subtotal = $p['harga'] * $qty;
        $total += $subtotal;
?>

<div class="cart-item">

    <img src="<?php echo $p['gambar']; ?>">

    <div class="info">

        <h3><?php echo $p['nama_produk']; ?></h3>

        <div class="price">
            Rp <?php echo number_format($subtotal); ?>
        </div>

        <div class="qty-row">

            <a class="qty-btn"
               href="cart.php?minus=<?php echo $id; ?>">
               -
            </a>

            <span class="qty-text">
                <?php echo $qty; ?>
            </span>

            <a class="qty-btn"
               href="cart.php?plus=<?php echo $id; ?>">
               +
            </a>

            <a class="hapus"
               href="cart.php?hapus=<?php echo $id; ?>">
               🗑
            </a>

        </div>

    </div>

</div>

<?php
    }

}else{
?>

<div class="empty-cart">

    <div class="icon">🛒</div>

    <h3>Keranjang Masih Kosong</h3>

    <p>Yuk tambahkan produk favoritmu</p>

    <a href="home.php">
        Belanja Sekarang
    </a>

</div>

<?php } ?>

</div>

<?php

$ongkir = 25000;

if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){

?>

<div class="summary">

    <h3>Ringkasan Pesanan</h3>

    <div class="summary-row">
        <span>Total Item</span>
        <span><?php echo array_sum($_SESSION['cart']); ?></span>
    </div>

    <div class="summary-row">
        <span>Subtotal Produk</span>
        <span>Rp <?php echo number_format($total); ?></span>
    </div>

    <div class="summary-row">
        <span>Estimasi Ongkir</span>
        <span>Rp <?php echo number_format($ongkir); ?></span>
    </div>

    <hr style="margin:10px 0;">

    <div class="total-bayar">
        <span>Total Pembayaran</span>
        <span>
            Rp <?php echo number_format($total + $ongkir); ?>
        </span>
    </div>

    <?php if(isset($_SESSION['id_user'])){ ?>

<a class="btn" href="checkout.php">
    Lanjut ke Pembayaran
</a>

<?php } else { ?>

<a class="btn" href="register.php">
    Lanjut ke Pembayaran
</a>

<?php } ?>
</div>

<?php } ?>

<div class="bottom-nav">
    <a href="home.php">Home</a>
    <a href="kategori.php">Semua Produk</a>
    <a href="cart.php">Troli</a>
    <a href="history.php">Pesanan</a>
    <a href="profile.php">Profil</a>
</div>

</body>
</html>