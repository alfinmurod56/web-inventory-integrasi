<?php 
include "config/koneksi.php";
$cari = mysqli_fetch_array(mysqli_query($koneksi,"select * from cabang where id_cabang = '$_GET[id]'"));
if ($_POST['nama_cabang']==$cari['nama_cabang']) {
	$cek = mysqli_query($koneksi,"update cabang set nama_cabang='$_POST[nama_cabang]',png_jawab = '$_POST[png_jawab]',alamat = '$_POST[alamat]',no_telp = '$_POST[no_telp]',wilayah = '$_POST[wilayah]' where id_customer = '$_GET[id]'");
	?>
	<script>
		alert('Data customer telah di rubah!');
		window.location.href="admin.php?p=dc";
	</script>
	<?php
}else{
	$cari2 = mysqli_num_rows(mysqli_query($koneksi,"select * from cabang where nama_cabang = '$_POST[nama_cabang]'"));
	if ($cari2 > 0) {
		?>
		<script>alert('Cabang telah terdaftar sebelumnya');window.location.href="admin.php?p=dc";</script>
		<?php
	}else{
		$cek2 = mysqli_query($koneksi,"update cabang set nama_cabang='$_POST[nama_cabang]',png_jawab = '$_POST[png_jawab]',alamat = '$_POST[alamat]',no_telp = '$_POST[no_telp]',wilayah = '$_POST[wilayah]' where id_customer = '$_GET[id]'");
		?>
		<script>
			alert('Data cabang telah di update!');
			window.location.href="admin.php?p=dc";
		</script>

		<?php
	}
}
?>