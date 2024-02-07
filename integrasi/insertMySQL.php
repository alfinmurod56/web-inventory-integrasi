<?php
error_reporting(E_ALL & ~E_NOTICE);

$servername = "localhost";
$database = "inventory_swg";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $database) or die("Gagal Koneksi");

$idproduk = $_GET['idproduk'];
$namaproduk = $_GET['namaproduk'];
$harga = $_GET['harga'];
$idukuran = $_GET['idukuran'];
$nmukuran = $_GET['nmukuran'];

$query = mysqli_query($conn, "insert into barang (id_produk, nama_produk, harga, id_ukuran, nm_ukuran) values 
('" . $idproduk . "','" . $namaproduk . "' ,'" . $harga . "','" . $idukuran . "','" . $nmukuran . "' )");
