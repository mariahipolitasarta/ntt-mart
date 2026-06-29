<?php
include 'data.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $q = mysqli_query($conn,"SELECT * FROM users
    WHERE username='$username' AND password='$password'");

    if(mysqli_num_rows($q) > 0){
        $data = mysqli_fetch_assoc($q);

        $_SESSION['id_user'] = $data['id'];
        $_SESSION['username'] = $data['username'];

        header("Location: home.php");
        exit;
    }else{
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - NTT Mart</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background: linear-gradient(180deg,#4b0000,#7a0000);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .container{
            width:350px;
            text-align:center;
            color:white;
        }

        .logo{
            width:180px;
            margin-bottom:20px;
        }

        h1{
            margin-bottom:5px;
        }

        .tagline{
            color:#d4a12a;
            font-size:12px;
            margin-bottom:30px;
        }

        input{
            width:100%;
            padding:15px;
            border:none;
            border-radius:25px;
            margin-bottom:15px;
            font-size:14px;
        }

        button{
            width:100%;
            padding:15px;
            border:none;
            border-radius:25px;
            background:#d4a12a;
            color:white;
            font-size:18px;
            cursor:pointer;
        }

        button:hover{
            opacity:0.9;
        }

        .register{
            margin-top:20px;
            font-size:14px;
        }

        .register a{
            color:#d4a12a;
            text-decoration:none;
        }

        .error{
            background:#ffffff22;
            padding:10px;
            border-radius:10px;
            margin-bottom:15px;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Ganti logo.png dengan logo NTT Mart milikmu -->
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
            name="username"
            placeholder="Username"
            required>

        <input
            type="password"
            name="password"
            placeholder="Password"
            required>

        <button type="submit" name="login">
            Masuk
        </button>

    </form>

    <div class="register">
        Belum punya akun?
        <a href="register.php">Daftar sekarang</a>
    </div>

</div>

</body>
</html>