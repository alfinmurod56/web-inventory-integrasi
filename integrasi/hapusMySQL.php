<?php
$servername = "localhost";
$database = "inventory_swg";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $database) or die("Gagal Koneksi");

$idproduk = $_GET['idproduk'];

$query = mysqli_query($conn, "delete from barang where id_produk='" . $idproduk . "'");
