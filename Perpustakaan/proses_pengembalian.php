<?php

include "connect.php";

if(isset($_POST['submit'])){
	
	$id = $_POST['id'];
	$nama_siswa = $_POST['nama_siswa'];
	$nama_buku = $_POST['nama_buku'];
	$jumlah_pinjam = $_POST['jumlah_pinjam'];
	$jatuh_tempo = $_POST['jatuh_tempo'];
	$tgl_kembali = $_POST['tgl_kembali'];
	
	$siswa = mysqli_query($con,"SELECT * FROM siswa where nama_siswa = '$nama_siswa'");
	$buku = mysqli_query($con,"SELECT * FROM buku where nama_buku = '$nama_buku'");
	
	foreach ($siswa as $data){
		$nis = $data['nis'];
	}
	foreach ($buku as $data){
		$kd_buku = $data['kd_buku'];
		$jumlah_buku = $data['jumlah_buku'];
	}
	
	$jumlah_buku_kembali = $jumlah_buku + $jumlah_pinjam;

	$datetime1 = new DateTime($jatuh_tempo);
	$datetime2 = new DateTime($tgl_kembali);

	$difference = $datetime1->diff($datetime2);
	$days = $difference->days;
	
	if($datetime2 > $datetime1)
	{
		$denda = $days * 500;
	}else
	{
		$denda = 0;
	}
	
	
	$query = mysqli_query($con,"INSERT INTO pengembalian(id_peminjaman,tgl_kembali,denda) VALUES('$id','$tgl_kembali','$denda')");
	var_dump($query);
	 if($query == true){
		$update = mysqli_query($con,"update peminjaman set status = 2 where id_pinjam = $id");
		$query = mysqli_query($con,"update buku set jumlah_buku = $jumlah_buku_kembali where kd_buku = $kd_buku");
		$query = mysqli_query($con,"update peminjaman set status = 1 where id_pinjam = '$id_pinjam'");
		header('location:data_peminjaman.php');
	}
	else{
		echo "gagal";
	}
	
}



?>