<?php
include 'data.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>NTT Mart</title>

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
    padding:20px;
    color:white;
}

.logo-area{
    display:flex;
    align-items:center;
    gap:10px;
}

.logo-area img{
    width:40px;
}

.title{
    font-size:24px;
    font-weight:bold;
}

.tagline{
    color:#d4a12a;
    font-size:12px;
}

.search{
    margin-top:15px;
}

.search input{
    width:100%;
    padding:12px;
    border:none;
    border-radius:25px;
}

.banner{
    margin:15px;
}

.banner img{
    width:100%;
    height:200px;
    object-fit:cover;
    border-radius:12px;
}

.section-title{
    margin:15px;
    font-size:20px;
    font-weight:bold;
}

.products{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:10px;
    padding:10px;
}

.card{
    width:180px;
    background:white;
    padding:10px;
    border-radius:10px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.card img{
    width:100%;
    height:150px;
    object-fit:cover;
    border-radius:8px;
}

.card h3{
    font-size:14px;
    margin-top:8px;
}

.card p{
    color:#7a0000;
    font-weight:bold;
    font-size:13px;
    margin-top:5px;
}

.btn{
    display:block;
    text-align:center;
    background:#d4a12a;
    color:white;
    text-decoration:none;
    padding:8px;
    border-radius:20px;
    margin-top:8px;
    font-size:13px;
}

.kategori-pilihan{
    display:flex;
    justify-content:space-around;
    align-items:flex-start;
    padding:10px 15px 20px;
    gap:10px;
}

.kategori-item{
    text-align:center;
    width:90px;
}

.kategori-img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:50%;
    margin-bottom:8px;
}

.kategori-item p{
    font-size:12px;
    margin-top:0;
    font-weight:bold;
}

/* Tentang Aplikasi */

.about{
    background:white;
    margin:15px;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.about h2{
    color:#000;
    font-weight:bold;
    font-size:22px;
    margin-bottom:10px;
}

.about p{
    font-size:14px;
    color:#555;
    line-height:1.7;
    text-align:justify;
}

/* Bottom Navigation */

.bottom-nav{
    position:fixed;
    bottom:0;
    left:0;
    width:100%;
    background:#4b0000;
    display:flex;
    justify-content:space-around;
    padding:12px;
    box-shadow:0 -2px 10px rgba(0,0,0,0.3);
}

.bottom-nav a{
    color:#d4a12a;
    text-decoration:none;
    font-weight:bold;
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
                Explore The Magic Of Nusa Tenggara Timur
            </div>
        </div>

    </div>

    <div class="search">
        <input type="text" placeholder="Cari Produk">
    </div>

</div>

<div class="banner">
    <img src="img/baner_tenun.jpg">
</div>

<div class="section-title">
    Produk Terbaru
</div>

<div class="products">

<?php
$data = mysqli_query($conn,"SELECT * FROM products");

while($p=mysqli_fetch_assoc($data)){
?>

<div class="card">

    <img src="<?php echo $p['gambar']; ?>">

    <h3><?php echo $p['nama_produk']; ?></h3>

    <p>Rp <?php echo number_format($p['harga']); ?></p>

    <a class="btn"
       href="cart.php?id=<?php echo $p['id']; ?>">
       Tambah
    </a>

</div>

<?php } ?>

</div>

<div class="section-title">
    Kategori Pilihan
</div>

<div class="kategori-pilihan">

    <div class="kategori-item">
        <img src="img/kategori2.png" class="kategori-img">
        <p>Kopi Flores</p>
    </div>

    <div class="kategori-item">
        <img src="img/kategori1.png" class="kategori-img">
        <p>Tenun Ikat</p>
    </div>

    <div class="kategori-item">
        <img src="img/kategori3.png" class="kategori-img">
        <p>Kerajinan</p>
    </div>

    <div class="kategori-item">
        <img src="img/kategori4.png" class="kategori-img">
        <p>Minyak Kelapa</p>
    </div>

</div>

<!-- Tentang Aplikasi -->

<div class="about">

    <h2>Tentang Aplikasi</h2>

    <p>
        NTT Mart Digital adalah platform pemasaran produk khas
        Nusa Tenggara Timur yang dirancang untuk membantu UMKM lokal
        mempromosikan dan menjual produknya secara online. Melalui
        aplikasi ini, pengguna dapat menemukan berbagai produk unggulan
        daerah seperti Tenun Ikat, Kopi Flores, kerajinan tangan,
        minyak kelapa, serta berbagai produk khas NTT lainnya.
        Aplikasi ini hadir untuk mendukung perekonomian daerah,
        memperluas jangkauan pemasaran UMKM, dan memperkenalkan
        kekayaan budaya Nusa Tenggara Timur kepada masyarakat luas.
    </p>

</div>

<div class="bottom-nav">

    <a href="home.php">Home</a>

    <a href="kategori.php">Semua Produk</a>

    <a href="cart.php">Troli</a>

    <a href="history.php">Pesanan</a>

    <a href="profile.php">Profil</a>

</div>

</body>
</html>