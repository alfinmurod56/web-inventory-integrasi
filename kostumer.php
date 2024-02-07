<div class="row">
	<div class="col-xs-12 mt-1 mb-3">
		<h4 class="">
			Data Customer
		</h4>
		<p>
			Admin dapat me-manage customer disini.
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
					<button class="btn btn-outline-primary pull-right" data-toggle="modal" data-target="#tambah">Tambah cabang</button>
					<div class="table-responsive m-t-40" style="margin-bottom: 15px;">
						<table cellspacing="0" class="display nowrap table table-hover table-striped table-bordered tableku" width="100%">
							<thead>
								<tr>
									<th>
										#
									</th>
									<th>
										Nama Cabang
									</th>
									<th>
										Penanggung Jawab
									</th>
									<th>
										Alamat
									</th>
									<th>
										No Handphone
									</th>
									<!-- <th>
										jenis
									</th> -->
									<th class="text-center">
										Aksi
									</th>
								</tr>
							</thead>
							<tbody id="isi">
								<?php 
								$customer = mysqli_query($koneksi,"select * from customer order by id_customer desc");
								$no = 0;
								while ($data = mysqli_fetch_array($customer)) {
									$no++;
									?>
									<tr>
										<td><?php echo $no ?></td>
										<td><?php echo $data['nm_cutomer'] ?></td>
										<td><?php echo $data['png_jawab'] ?></td>
										<td><?php echo $data['alamat'] ?></td>
										<td><?php echo $data['no_telp'] ?></td>
										<td><?php echo $data['jenis'] ?></td>
										<td>
											<button class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#update<?php echo $data['id_customer'] ?>"><i data-toggle="tooltip" title="Update cabang" class="fa fa-edit"></i></button>
											<a href="?p=dc&act=del&id=<?php echo $data['id_customer'] ?>" onclick="return confirm('Hapus data customer?')" class="btn btn-outline-danger btn-block" data-toggle="tooltip" title="Hapus cabang"><i class="fa fa-trash"></i></a>
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
		mysqli_query($koneksi,"delete from customer where id_customer = '$_GET[id]'");
		?>
		<script>
			alert(' Data customer telah di hapus!');
			window.location.href="admin.php?p=dc";
		</script>
		<?php
	}
}

$customer = mysqli_query($koneksi,"select * from customer");
$no = 0;
while ($data = mysqli_fetch_array($customer)) {
	?>
	<div class="modal fade text-xs-left" id="update<?php echo $data['id_customer'] ?>"  role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel1">Update Cabang</h4>
				</div>
				<form method="post" action="updcustomer.php?id=<?php echo $data['id_customer'] ?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label>Nama Cabang</label>
									<input type="text" class="form-control" autocomplete="off" value="<?php echo $data['nm_cutomer'] ?>" placeholder="Masukan nama customer" name="nm_cutomer" required="">
								</div>
								<div class="form-group">
									<label>Penanggung Jawab</label>
									<input type="text" class="form-control" autocomplete="off" value="<?php echo $data['png_jawab'] ?>" placeholder="Masukan Penanggung jawab" name="png_jawab" required="">
								</div>
								<div class="form-group">
									<label>Alamat customer</label>
									<textarea name="alamat" required="" placeholder="Masukan alamat" class="form-control"><?php echo $data['alamat'] ?></textarea>
								</div>
								<div class="form-group">
									<label>No Handphone</label>
									<input type="number" class="form-control" autocomplete="off" value="<?php echo $data['no_telp'] ?>" placeholder="Masukan Nomor Handphone" name="no_telp" required="">
								</div>

								<!-- <div class="form-group">
									<label>jenis</label>
									<input type="text" class="form-control" autocomplete="off" value="<?php echo $data['jenis'] ?>" placeholder="jenis" name="jenis" required="">
								</div> -->
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
				<h4 class="modal-title" id="myModalLabel1">Tambah cabang</h4>
			</div>
			<form method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label>Nama cabang</label>
								<input type="text" class="form-control" autocomplete="off"  placeholder="Masukan nama customer" name="nm_cutomer" required="">
							</div>
							<div class="form-group">
								<label>Penanggung Jawab</label>
								<input type="text" class="form-control" autocomplete="off"  placeholder="Masukan Penanggung jawab" name="png_jawab" required="">
							</div>
							<div class="form-group">
								<label>Alamat cabang</label>
								<textarea name="alamat" required="" placeholder="Masukan alamat" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label>No Handphone</label>
								<input type="number" class="form-control" autocomplete="off"  placeholder="Masukan Nomor Handphone" name="no_telp" required="">
							</div>

							<!-- <div class="form-group">
								<label>jenis</label>
								<input type="text" class="form-control" autocomplete="off"  placeholder="Masukan Jenis jenis" name="jenis" required="">
							</div> -->
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
	$cari = mysqli_num_rows(mysqli_query($koneksi,"select * from customer where nm_cutomer = '$_POST[nm_cutomer]'"));
	if ($cari > 0) {
		?>
		<script>alert('customer telah terdaftar sebelumnya')</script>
		<?php
	}else{
		$cek = mysqli_query($koneksi,"insert into customer (nm_cutomer,png_jawab,alamat,no_telp,jenis) values('$_POST[nm_cutomer]','$_POST[png_jawab]','$_POST[alamat]','$_POST[no_telp]','$_POST[jenis]')");

		if ($cek) {
			?>
			<script>alert('Data customer berhasil di tambahkan!');window.location.href="admin.php?p=dc"</script>
			<?php
		}
	}
}
?>