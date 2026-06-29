<?php
$host = "sql103.infinityfree.com";
$user = "if0_42270931";
$pass = "rpKYrRPafia";
$db   = "if0_42270931_ntt_mart";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>