<?php
$servername = "localhost";
$database = "asuransi";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn) {
    die("koneksi gagal : " . mysqli_connect_error());

} else {
    echo " koneksi berhasil";
}