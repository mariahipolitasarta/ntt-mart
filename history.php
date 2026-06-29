```php
<?php
include 'data.php';

if(isset($_SESSION['id_user'])){

    $q = mysqli_query($conn,"
    SELECT * FROM orders
    WHERE id_user='".$_SESSION['id_user']."'
    ORDER BY tanggal DESC
    ");

}else{

    $q = mysqli_query($conn,"
    SELECT * FROM orders
    ORDER BY tanggal DESC
    ");

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Pesanan Saya</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:#f5f5f5;
    padding-bottom:80px;
}

.header{
    background:linear-gradient(180deg,#4b0000,#7a0000);
    color:white;
    text-align:center;
    padding:20px;
}

.title-box{
    background:#5f0b0b;
    color:white;
    margin:15px;
    padding:12px;
    text-align:center;
    border-radius:10px;
    font-weight:bold;
}

.card{
    background:white;
    margin:15px;
    padding:15px;
    border-radius:12px;
    box-shadow:0 2px 5px rgba(0,0,0,.1);
}

.row{
    display:flex;
    justify-content:space-between;
    margin:8px 0;
}

.status{
    color:#d4a12a;
    font-weight:bold;
}

.total{
    color:#7a0000;
    font-weight:bold;
    font-size:20px;
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
    font-size:16px;
}

.active{
    color:white !important;
    font-weight:bold;
}

</style>
</head>

<body>

<div class="header">
    <h2>NTT MART DIGITAL</h2>
</div>

<div class="title-box">
    Pesanan Saya
</div>

<?php

if(mysqli_num_rows($q) > 0){

    while($d=mysqli_fetch_assoc($q)){
?>

<div class="card">

    <div class="row">
        <span>No Pesanan</span>
        <b>#<?php echo $d['id']; ?></b>
    </div>

    <div class="row">
        <span>Tanggal</span>
        <span><?php echo $d['tanggal']; ?></span>
    </div>

    <div class="row">
        <span>Status</span>
        <span class="status">
            <?php echo $d['status']; ?>
        </span>
    </div>

    <hr style="margin:10px 0;">

    <div class="row">
        <span>Total Pembayaran</span>
        <span class="total">
            Rp <?php echo number_format($d['total']); ?>
        </span>
    </div>

</div>

<?php
    }

}else{
?>

<div class="card">
    Belum ada pesanan.
</div>

<?php } ?>

<div class="bottom-nav">

    <a href="home.php">
        Home
    </a>

    <a href="kategori.php">
        Semua Produk
    </a>

    <a href="cart.php">
        Troli
    </a>

    <a href="history.php" class="active">
        Pesanan
    </a>

    <a href="profile.php">
        Profil
    </a>

</div>

</body>
</html>
```
