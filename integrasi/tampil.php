<?php 

include ('config/koneksi.php');

$query = mysqli_query($conn, "SELECT * from barang");

if(mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_array($query)) {
        echo $data['kode_id'].'-'.$data['nama'].'-'.$data['lokasi'].'-'.$data['category'].';';
    }
}


?>