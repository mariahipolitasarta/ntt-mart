<?php
include 'data.php';

if (isset($_POST['register'])) {

    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $telepon  = mysqli_real_escape_string($conn, $_POST['telepon']);
    $alamat   = mysqli_real_escape_string($conn, $_POST['alamat']);

    $query = mysqli_query($conn, "
        INSERT INTO users (
            nama,
            telepon,
            alamat
        ) VALUES (
            '$nama',
            '$telepon',
            '$alamat'
        )
    ");

    if ($query) {

        $_SESSION['id_user'] = mysqli_insert_id($conn);

        header("Location: checkout.php");
        exit;

    } else {

        $error = "Gagal menyimpan data!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register - NTT MART DIGITAL</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:linear-gradient(180deg,#4b0000,#7a0000);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}

.container{
    width:400px;
    color:white;
    text-align:center;
}

.logo{
    width:140px;
    margin-bottom:15px;
}

h1{
    margin-bottom:8px;
}

.tagline{
    color:#d4a12a;
    margin-bottom:25px;
    font-size:13px;
}

input,
textarea{
    width:100%;
    padding:15px;
    margin-bottom:15px;
    border:none;
    border-radius:25px;
    background:#f2f2f2;
    font-size:15px;
}

textarea{
    height:90px;
    resize:none;
    border-radius:15px;
}

button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:25px;
    background:#d4a12a;
    color:white;
    font-size:17px;
    cursor:pointer;
}

button:hover{
    opacity:.9;
}

.error{
    background:#ffffff33;
    padding:12px;
    margin-bottom:15px;
    border-radius:10px;
}

.info{
    margin-top:20px;
    color:#d4a12a;
    font-size:14px;
}

</style>

</head>

<body>

<div class="container">

    <img src="img/logo.png" class="logo">

    <h1>NTT MART DIGITAL</h1>

    <div class="tagline">
        Explore The Magic Of Nusa Tenggara Timur
    </div>

    <?php
    if(isset($error)){
        echo "<div class='error'>$error</div>";
    }
    ?>

    <form method="POST">

        <input
            type="text"
            name="nama"
            placeholder="Nama Lengkap"
            required>

        <input
            type="text"
            name="telepon"
            placeholder="No. Telepon"
            required>

        <textarea
            name="alamat"
            placeholder="Alamat Lengkap"
            required></textarea>

        <button
            type="submit"
            name="register">
            Lanjutkan Pemesanan
        </button>

    </form>

    <div class="info">
        Silakan lengkapi data diri untuk melanjutkan ke proses checkout.
    </div>

</div>

</body>
</html>