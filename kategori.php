<?php
include 'data.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Kategori Produk</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f5f5f5;
    padding-bottom:80px;
}

/* HEADER */

.header{
    background:linear-gradient(180deg,#4b0000,#7a0000);
    padding:20px;
    color:white;
}

.logo-area{
    display:flex;
    align-items:center;
    gap:10px;
}

.logo-area img{
    width:45px;
}

.title{
    font-size:24px;
    font-weight:bold;
}

.tagline{
    font-size:12px;
    color:#d4a12a;
}

.search{
    margin-top:15px;
}

.search input{
    width:100%;
    padding:12px 18px;
    border:none;
    border-radius:25px;
    font-size:14px;
}

/* TITLE */

.section-title{
    margin:15px;
    font-size:20px;
    font-weight:bold;
    color:#4b0000;
}

/* GRID */

.kategori-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
    gap:20px;
    padding:15px;
}

.card-produk{
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 2px 8px rgba(0,0,0,.15);
}

.card-produk img{
    width:100%;
    height:180px;
    object-fit:cover;
}

.card-body{
    padding:12px;
}

.card-body h4{
    font-size:16px;
    margin-bottom:10px;
    min-height:40px;
}

.harga{
    color:#7a0000;
    font-size:16px;
    font-weight:bold;
    margin-bottom:12px;
}

.btn-tambah{
    display:block;
    text-align:center;
    background:#d4a12a;
    color:white;
    text-decoration:none;
    padding:10px;
    border-radius:25px;
    font-size:15px;
}
/* BOTTOM NAV */

.bottom-nav{
    position:fixed;
    bottom:0;
    left:0;
    width:100%;
    background:#4b0000;
    display:flex;
    justify-content:space-around;
    align-items:center;
    height:60px;
    border-top:2px solid #6b0000;
}

.bottom-nav a{
    color:#d4a12a;
    text-decoration:none;
    font-size:15px;
    font-weight:bold;
}

.bottom-nav a.active{
    color:#ffd700;
}

</style>
</head>

<body>

<div class="header">

    <div class="logo-area">
        <img src="img/logo.png">

        <div>
            <div class="title">NTT MART DIGITAL</div>
            <div class="tagline">
                The Soul Of East Nusa In Your Hand
            </div>
        </div>
    </div>

    <div class="search">
        <input type="text" placeholder="Cari Produk">
    </div>

</div>

<div class="section-title">
    semua produk
</div>

<div class="kategori-grid">

<?php
$data = mysqli_query($conn,"SELECT * FROM products");

while($p=mysqli_fetch_assoc($data)){
?>

<div class="card-produk">

    <img src="<?php echo $p['gambar']; ?>">

    <div class="card-body">

        <h4>
            <?php echo $p['nama_produk']; ?>
        </h4>

        <div class="harga">
            Rp <?php echo number_format($p['harga']); ?>
        </div>

        <a
        class="btn-tambah"
        href="cart.php?id=<?php echo $p['id']; ?>">
            Tambah
        </a>

    </div>

</div>

<?php } ?>

</div>

<div class="bottom-nav">
    <a href="home.php">Home</a>
    <a href="kategori.php" class="active">Semua Produk</a>
    <a href="cart.php">Troli</a>
    <a href="history.php">Pesanan</a>
    <a href="profile.php">Profil</a>
</div>

</body>
</html>