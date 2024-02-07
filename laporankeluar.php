<div class="row">
	<div class="col-xs-12 mt-1 mb-3">
		<h4 class="">
			Laporan barang keluar
		</h4>
		<p>
			Admin dapat me-manage mengeksport data barang yang keluar.
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
					<div class="table-responsive m-t-40" style="margin-bottom: 15px;">
						<table cellspacing="0" class="display nowrap table table-hover table-striped table-bordered " id="example23" width="100%">
							<thead>
								<tr>
									<th>
										No.
									</th>
									<th>
										Tanggal Keluar
									</th>
									<th>
										Kode Barang
									</th>
									<th>
										Nama Barang
									</th>
									<th>
										Cabang
									</th>
									<th>
										Penanggung Jawab
									</th>
									<th>
										Stok Awal
									</th>
									<th>
										Keluar
									</th>
									<th>
										Sisa
									</th>									
									<!-- <th class="text-center">
										Aksi
									</th> -->
								</tr>
							</thead>
							<tbody id="isi">
							<?php 
								$customer = mysqli_query($koneksi,"select customer.nm_cutomer,
								customer.png_jawab,
								barang.*,
								barang_keluar.jumlah,
								barang_keluar.tgl_keluar,
								barang_keluar.awal,
								barang_keluar.sisa 
								from barang_keluar
								inner join barang on barang.id_produk = barang_keluar.id_barang
								inner join customer on customer.id_customer = barang_keluar.id_costumer 
								order by id_keluar desc");
								$no = 0;
								while ($data = mysqli_fetch_array($customer)) {
									$no++;
									?>
									<tr>
										<td><?php echo $no ?></td>
										<td><?php echo $data['tgl_keluar'] ?></td>
										<td><?php echo $data['id_produk'] ?></td>
										<td><?php echo $data['nama_produk'] ?></td>
										<td><?php echo $data['nm_cutomer'] ?></td>
										<td><?php echo $data['png_jawab'] ?></td>
										<td><?php echo $data['awal'] ?></td>
										<td><?php echo $data['jumlah'] ?></td>
										<td><?php echo $data['sisa'] ?></td>
										
										<!-- <td>
											<button class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#update<?php echo $data['id_masuk'] ?>"><i data-toggle="tooltip" title="Update customer" class="fa fa-edit"></i></button>
											<a href="?p=dc&act=del&id=<?php echo $data['id_masuk'] ?>" onclick="return confirm('Hapus data customer?')" class="btn btn-outline-danger btn-block" data-toggle="tooltip" title="Hapus customer"><i class="fa fa-trash"></i></a>
										</td> -->
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