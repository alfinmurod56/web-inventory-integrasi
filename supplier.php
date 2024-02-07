<div class="row">
	<div class="col-xs-12 mt-1 mb-3">
		<h4 class="">
			Data Supplier
		</h4>
		<p>
			Admin dapat me-manage supplier disini.
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
					<button class="btn btn-outline-primary pull-right" data-toggle="modal" data-target="#tambah">Tambah Supplier</button>
					<div class="table-responsive m-t-40" style="margin-bottom: 15px;">
						<table cellspacing="0" class="display nowrap table table-hover table-striped table-bordered tableku" width="100%">
							<thead>
								<tr>
									<th>
										#
									</th>									
									<th>
										Supplier
									</th>
									<th>
										Alamat
									</th>
									<th>
										No Handphone
									</th>									
									<th class="text-center">
										Aksi
									</th>
								</tr>
							</thead>
							<tbody id="isi">
								<?php 
								$supplier = mysqli_query($koneksi,"select * from supplier order by id_supplier desc");
								$no = 0;
								while ($data = mysqli_fetch_array($supplier)) {
									$no++;
									?>
									<tr>
										<td><?php echo $no ?></td>
										<td><?php echo $data['nama_supplier'] ?></td>
										<td><?php echo $data['telp_supplier'] ?></td>
										<td><?php echo $data['alamat'] ?></td>										
										<td>
											<button class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#update<?php echo $data['id_supplier'] ?>"><i data-toggle="tooltip" title="Update supplier" class="fa fa-edit"></i></button>
											<a href="?p=ds&act=del&id=<?php echo $data['id_supplier'] ?>" onclick="return confirm('Hapus data supplier?')" class="btn btn-outline-danger btn-block" data-toggle="tooltip" title="Hapus suppplier"><i class="fa fa-trash"></i></a>																						
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
		mysqli_query($koneksi,"delete from supplier where id_supplier = '$_GET[id]'");
		?>
		<script>
			alert(' Data supplier telah di hapus!');
			window.location.href="admin.php?p=ds";
		</script>
		<?php
	}
}

$supplier = mysqli_query($koneksi,"select * from supplier");
$no = 0;
while ($data = mysqli_fetch_array($supplier)) {
	?>
	<div class="modal fade text-xs-left" id="update<?php echo $data['id_supplier'] ?>"  role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel1">Update supplier</h4>
				</div>
				<form method="post" action="updsupplier.php?id=<?php echo $data['id_supplier'] ?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label>Nama Supplier</label>
									<input type="text" class="form-control" autocomplete="off" value="<?php echo $data['nama_supplier'] ?>" placeholder="Masukan nama supplier" name="nama_supplier" required="">
								</div>								
								<div class="form-group">
									<label>Alamat Supplier</label>
									<textarea name="alamat" required="" placeholder="Masukan alamat" class="form-control"><?php echo $data['alamat'] ?></textarea>
								</div>
								<div class="form-group">
									<label>No Handphone</label>
									<input type="number" class="form-control" autocomplete="off" value="<?php echo $data['telp_supplier'] ?>" placeholder="Masukan Nomor Handphone" name="telp_supplier" required="">
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

<div class="modal fade text-xs-left" id="tambah"  role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel1">Tambah Supplier</h4>
			</div>
			<form method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label>Nama Supplier</label>
								<input type="text" class="form-control" autocomplete="off"  placeholder="Masukan nama supplier" name="nama_supplier" required="">
							</div>							
							<div class="form-group">
								<label>Alamat Suppplier</label>
								<textarea name="alamat" required="" placeholder="Masukan alamat" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label>No Handphone</label>
								<input type="number" class="form-control" autocomplete="off"  placeholder="Masukan Nomor Handphone" name="telp_supplier" required="">
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

<?php 
if (isset($_POST['tambah'])) {
	$cari = mysqli_num_rows(mysqli_query($koneksi,"select * from supplier where nama_supplier = '$_POST[nama_supplier]'"));
	if ($cari > 0) {
		?>
		<script>alert('Supplier telah terdaftar sebelumnya')</script>
		<?php
	}else{
		$cek = mysqli_query($koneksi,"insert into supplier (nama_supplier,alamat,telp_supplier) values('$_POST[nama_supplier]','$_POST[alamat]','$_POST[telp_supplier]')");

		if ($cek) {
			?>
			<script>alert('Data supplier berhasil di tambahkan!');window.location.href="admin.php?p=ds"</script>
			<?php
		}
	}
}
?>