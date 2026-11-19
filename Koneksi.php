<?php
$host = "localhost:3306";
$user = "root";
$pass = "root";
$db   = "CRUD_Mbg"; // sesuaikan dengan nama database kalian!

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
  die("koneksi database gagal: " . mysqli_connect_error());
}
?>