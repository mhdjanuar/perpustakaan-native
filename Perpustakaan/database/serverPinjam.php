<?php
include "../connect.php";

    $nis = $_POST['nama_siswa'];
    $kd_buku = $_POST['nama_buku'];
    $jumlah_pinjam = $_POST['jumlah_pinjam'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $jatuh_tempo = $_POST['jatuh_tempo'];

    $getByNis = mysqli_query($con,"select * from peminjaman where nis = '$nis' and status = 0 ");
  	$cekNis = mysqli_num_rows($getByNis);
  	//jika nis nya itu sudah ada
  	if($cekNis != 0){
  		echo '<div class="alert alert-danger" role="alert">
              Maaf Anda Masih Melakukan Peminjaman
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  	}else {
      echo '<div class="alert alert-success" role="alert">
              Berhasil Melakukan Peminjaman
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  		$query = mysqli_query($con,"CALL AddPinjam('$nis','$kd_buku','$jumlah_pinjam','$tgl_pinjam','$jatuh_tempo',0)");
  	}
?>
