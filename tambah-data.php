<?php
// Insert data to MySQL
$conn = mysqli_connect("localhost","root", "", "inventory_swg");

if ($conn->connect_error) {
    die("Connection failed because " . $conn->connect_error);
}

$id                 = $_POST["id_produk"];
$nama_umkm          = $_POST['nama_produk'];
$nama_pemilik       = $_POST['harga'];
$kategori_umkm      = $_POST['id_ukuran'];
$jenis_usaha        = $_POST["nama_ukuran"];


//SQL Syntax 
$sql = "INSERT INTO `data_umkm` (id_umkm, kategori_umkm, nama_umkm, nama_pemilik_usaha, jenis_usaha, alamat, nilai_penjualan_per_bulan) 
        VALUES ('".$id."', '".$kategori_umkm."', '".$nama_umkm."', '".$nama_pemilik."', '" . $jenis_usaha . "', '".$alamat."', '" . $nilai_jual . "');";

if ($conn->query($sql)) {
    include ('insertSQLServer.php');
    header('location:tambah.php');
} else {
    echo mysqli_error($conn);
}


