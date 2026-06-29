```php
<?php
include 'data.php';

if(isset($_SESSION['id_user'])){

    if(isset($_POST['simpan'])){

        $nama = $_POST['nama'];
        $telepon = $_POST['telepon'];
        $alamat = $_POST['alamat'];

        mysqli_query($conn,"
        UPDATE users
        SET
        nama='$nama',
        telepon='$telepon',
        alamat='$alamat'
        WHERE id='".$_SESSION['id_user']."'
        ");

        $success = "Profil berhasil diperbarui!";
    }

    $q = mysqli_query($conn,"
    SELECT * FROM users
    WHERE id='".$_SESSION['id_user']."'
    ");

    $user = mysqli_fetch_assoc($q);

}else{

    $user = [
        'nama' => 'Pengunjung',
        'telepon' => '-',
        'alamat' => '-'
    ];

}
?>
```


<!DOCTYPE html>
<html>
<head>
<title>Profil Saya</title>

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

.profile-card{
    background:white;
    border-radius:15px;
    padding:20px;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
}

.profile-icon{
    width:90px;
    height:90px;
    border-radius:50%;
    background:#d4a12a;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:40px;
    margin:auto;
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
    color:#555;
}

input,
textarea{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:10px;
    margin-bottom:15px;
}

textarea{
    resize:none;
    height:100px;
}

.btn{
    width:100%;
    border:none;
    background:#d4a12a;
    color:white;
    padding:15px;
    border-radius:10px;
    cursor:pointer;
    font-size:16px;
    font-weight:bold;
}

.logout{
    display:block;
    text-align:center;
    background:#7a0000;
    color:white;
    text-decoration:none;
    padding:15px;
    border-radius:10px;
    margin-top:10px;
}

.success{
    background:#d4edda;
    color:#155724;
    padding:10px;
    border-radius:10px;
    margin-bottom:15px;
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

.active{
    font-weight:bold;
    color:white !important;
}

</style>
</head>

<body>

<div class="header">
    <h2>Profil Saya</h2>
</div>

<div class="container">

    <?php
    if(isset($success)){
        echo "<div class='success'>$success</div>";
    }
    ?>

    <div class="profile-card">

        <div class="profile-icon">
            👤
        </div>

        <form method="POST">

            <label>Nama Lengkap</label>
            <input
                type="text"
                name="nama"
                value="<?php echo $user['nama']; ?>"
                required>

            <label>No Telepon</label>
            <input
                type="text"
                name="telepon"
                value="<?php echo $user['telepon']; ?>"
                required>

            <label>Alamat</label>
            <textarea
                name="alamat"
                required><?php echo $user['alamat']; ?></textarea>

    

            <button
                type="submit"
                name="simpan"
                class="btn">
                Simpan Perubahan
            </button>

        </form>

       <a href="logout.php" class="logout">
    Logout
</a>
    </div>

</div>

<div class="bottom-nav">
    <a href="home.php">Home</a>
    <a href="kategori.php">Semua Produk</a>
    <a href="cart.php">Troli</a>
    <a href="history.php">Pesanan</a>
    <a href="profile.php" class="active">Profil</a>
</div>

</body>
</html>