<?php 
if (session_status() == PHP_SESSION_NONE) {
    // Jika sesi belum aktif, maka mulai sesi
    session_start();
}
if (isset($_POST['tambah'])) {
	$id_produk= '';
	$prev_produk_query = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id_produk DESC LIMIT 1");
	// id sebelumnya P0002
	$prev_produk_row = mysqli_fetch_assoc($prev_produk_query);
	if ($prev_produk_row) {
		$prev_id_numeric = intval(substr($prev_produk_row['id_produk'], 1));
		$new_id_numeric = $prev_id_numeric + 1;
		$id_produk = 'P' . str_pad($new_id_numeric, 3, '0', STR_PAD_LEFT);
	} else {
		$id_produk = 'P001';
	}

	$_SESSION["id_produk"] = $id_produk;
	$data_ukuran_query = mysqli_query($koneksi,"select * from ukuran where id_ukuran = '$_POST[id_ukuran]' LIMIT 1");	
	$data_ukuran_row = mysqli_fetch_assoc($data_ukuran_query);
	if ($data_ukuran_row) {
		$nm_ukuran = $data_ukuran_row['nm_ukuran'];
		$cek = mysqli_query($koneksi,"insert into barang (id_produk,nama_produk,harga,id_ukuran,nm_ukuran,stok) values('$id_produk','$_POST[nama_produk]','$_POST[harga]', '$_POST[id_ukuran]','$nm_ukuran','0')");
		if ($cek) {
			include ('insertSQLServer.php');
			?>			
			<!-- <script>alert('Data barang berhasil di tambahkan!');window.location.href="admin.php?p=db"</script> -->
			<?php
		}	
	} else {
		?>
			<script>alert('Tidak ada data ukuran!');</script>
		<?php
	}
	
}
?>

<div class="row">
	<div class="col-xs-12 mt-1 mb-3">
		<h4 class="">
			Data Barang
		</h4>
		<p>
			Admin dapat me-manage data barang disini.
		</p>
		<hr>
	</div>
	<div class="col-xs-12">
	</div>
</div>
<br>

<link rel="stylesheet" type="text/css" href="assets/style.css">
<div class="row" style="margin-top: -30px;">
	<div class="col-12">
		<div class="card">
			<div class="container">
				<div class="card-body">
					<button class="btn btn-outline-primary pull-right" data-toggle="modal" data-target="#tambah">Tambah barang</button>
					<div class="table-responsive m-t-40" style="margin-bottom: 15px;">
						<table cellspacing="0" class="display nowrap table table-hover table-striped table-bordered tableku" width="100%">
							<thead>
								<tr>
									<th>
										#
									</th>
									<th>
										Id Produk
									</th>
									<th>
										Nama Produk
									</th>
									<th>
										harga
									</th>
									<th>
										ID Ukuran
									</th>
									<th>
										Ukuran
									</th>
									<th>
										Stok
									</th>						
									<!-- <th class="text-center">
										Aksi
									</th> -->
								</tr>
							</thead>
							<tbody id="isi">
								<?php 
								$barang = mysqli_query($koneksi,"select * from barang order by id_produk desc");
								$no = 0;
								while ($data = mysqli_fetch_array($barang)) {
									$no++;
									?>
									<tr>
										<td><?php echo $no ?></td>
										<td><?php echo $data['id_produk'] ?></td>
										<td><?php echo $data['nama_produk'] ?></td>
										<td><?php echo $data['harga'] ?></td>
										<td><?php echo $data['id_ukuran'] ?></td>
										<td><?php echo $data['nm_ukuran'] ?></td>
										<td><?php echo $data['stok'] ?></td>
										<td>
											<button class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#update<?php echo $data['id_produk'] ?>"><i data-toggle="tooltip" title="Update barang" class="fa fa-edit"></i></button>
											<a href="?p=db&act=del&id=<?php echo $data['id_produk'] ?>" onclick="return confirm('Hapus data barang?')" class="btn btn-outline-danger btn-block" data-toggle="tooltip" title="Hapus barang"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
if (@$_GET['act']!==null) {
	if (@$_GET['id']!==null) {
		include('deleteSQLServer.php');
		mysqli_query($koneksi,"delete from barang where id_produk = '$_GET[id]'");
		?>
		<script>
			alert(' Data barang telah di hapus!');
			window.location.href="admin.php?p=db";
		</script>
		<?php
	}
}
// Update Barang
$barang = mysqli_query($koneksi,"select * from barang");
$no = 0;
while ($data = mysqli_fetch_array($barang)) {
	?>
	<div class="modal fade text-xs-left" id="update<?php echo $data['id_produk'] ?>"  role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel1">Update barang</h4>
				</div>
				<form method="post" action="updbarang.php?id=<?php echo $data['id_produk'] ?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label>ID Produk</label>
									<input type="text" class="form-control" autocomplete="off" value="<?php echo $data['id_produk'] ?>" placeholder="Masukan id produk" name="id_produk" required="">
								</div>
								<div class="form-group">
									<label>Nama Produk</label>
									<input type="text" class="form-control" autocomplete="off" value="<?php echo $data['nama_produk'] ?>" placeholder="Masukan nama produk" name="nama_produk" required="">
								</div>
								<div class="form-group">
									<label>Harga</label>
									<input type="text" class="form-control" autocomplete="off" value="<?php echo $data['harga'] ?>" placeholder="Masukan Harga" name="harga" required="">
								</div>
								<div class="form-group">
									<label>ID Ukuran</label>
									<input type="text" class="form-control" autocomplete="off" value="<?php echo $data['id_ukuran'] ?>" placeholder="Masukan ukuran" name="id_ukuran" required="">
								</div>
								<div class="form-group">
									<label>Ukuran</label>
									<input type="text" class="form-control" autocomplete="off" value="<?php echo $data['nm_ukuran'] ?>" placeholder="Masukan ukuran" name="nm_ukuran" required="">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
						<button type="submit" id="btn1" class="btn btn-outline-primary">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
}
?>

			<?php
			// $auto = mysql_query($koneki,"select max(id_produk) as max_code from barang");
			// $data1 = mysql_fetch_array($auto);
			// $code = $data1['max_code'];
			// $urutan = (int)substr($code, 1, 3);
			// $urutan++;
			// $huruf = "P";
			// $id_bar = $huruf . sprintf("%03s", $urutan );
			?>

<div class="modal fade text-xs-left" id="tambah"  role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel1">Tambah Produk</h4>
			</div>

			<form method="post">
				<div class="modal-body">	
					<div class="row">
						<div class="col-xs-12">
						<!-- <input type="hidden" class="d-none" name="id_produk" values='<?= $id_produk ?>'> -->
							<!-- <div class="form-group">								
								<label>ID Produk</label>
								<input type="text" class="form-control" placeholder="Masukan ID Produk" name="id_produk" required="">
							</div> -->
							<div class="form-group">
								<label>Nama Produk</label>
								<input type="text" class="form-control" autocomplete="off" placeholder="Masukan nama produk" name="nama_produk" required="">
							</div>
							<div class="form-group">
								<label>Harga</label>
								<input type="text" class="form-control" autocomplete="off" placeholder="Masukan Harga" name="harga" required="">
							</div>
							<!-- <div class="form-group">
								<label>Ukuran</label>
								<input type="text" class="form-control" autocomplete="off" placeholder="Masukan Ukuran" name="nm_ukuran" required="">
							</div> -->								

							<div class="form-group">
								<label>Ukuran</label>
								<select name="id_ukuran" class="form-control" required="" id="">
									<option value="" selected disabled>--Pilih Ukuran--</option>
									<?php 
									$query = mysqli_query($koneksi,"select * from ukuran");
									while ($c = mysqli_fetch_array($query)) {
										?>
										<option value="<?php echo $c['id_ukuran'];?>"><?php echo $c['nm_ukuran'] ?></option>
										<?php
									}
									?>
								</select>
							</div>

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
					<button name="tambah" id="btn" class="btn btn-outline-primary">Tambah </button>
				</div>
			</form>
		</div>
	</div>
</div>  

