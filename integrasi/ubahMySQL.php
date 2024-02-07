<?php
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

$query = mysqli_query($conn, "update barang set nama_produk='".$namaproduk."', harga='" . $harga . "' ,id_ukuran='" . $idukuran . "', nm_ukuran='" . $nmukuran . "' where id_produk= '" . $idproduk . "' ");