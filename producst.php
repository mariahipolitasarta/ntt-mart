<?php
include 'data.php';

$data = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Produk NTT Mart</title>
</head>
<body>

<h2>Daftar Produk</h2>

<a href="home.php">Home</a> |
<a href="cart.php">Keranjang</a>

<hr>

<?php while($p = mysqli_fetch_assoc($data)){ ?>

    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <h3><?php echo $p['nama_produk']; ?></h3>

        <?php if(!empty($p['gambar'])){ ?>
            <img src="images/<?php echo $p['gambar']; ?>" width="150">
            <br><br>
        <?php } ?>

        <p><?php echo $p['deskripsi']; ?></p>

        <p>
            <b>Rp <?php echo number_format($p['harga'],0,',','.'); ?></b>
        </p>

        <a href="cart.php?id=<?php echo $p['id']; ?>">
            Tambah ke Keranjang
        </a>
    </div>

<?php } ?>

</body>
</html>