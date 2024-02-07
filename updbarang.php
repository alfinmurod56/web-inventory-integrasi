<?php 
include "config/koneksi.php";
$cari = mysqli_fetch_array(mysqli_query($koneksi,"select * from barang where id_produk = '$_GET[id]'"));
if ($_POST['id_produk']==$cari['id_produk']) {
	include('editSQLServer.php');
	$cek = mysqli_query($koneksi,"update barang set nama_produk = '$_POST[nama_produk]', harga = '$_POST[harga]', nm_ukuran = '$_POST[nm_ukuran]',id_ukuran = '$_POST[id_ukuran]' where id_produk = '$_GET[id]'");
	?>
	<script>
		alert('Data barang telah di rubah!');
		window.location.href="admin.php?p=db";
	</script>
	<?php
}else{
	$cari2 = mysqli_num_rows(mysqli_query($koneksi,"select * from barang where id_produk = '$_POST[id_produk]'"));
	if ($cari2 > 0) {
		?>
		<script>alert('Kode barang telah terdaftar sebelumnya');window.location.href="admin.php?p=db";</script>
		<?php
	}else{
		$cek = mysqli_query($koneksi,"update barang set nama_produk='$_POST[nama_produk]', harga='$_POST[harga]', nm_ukuran = '$_POST[nm_ukuran]', id_ukuran = '$_POST[id_ukuran]' where id_produk = '$_GET[id]'");
		?>
		<script>
			alert('Data barang telah di rubah!');
			window.location.href="admin.php?p=db";
		</script>
		<?php
	}
}
?>