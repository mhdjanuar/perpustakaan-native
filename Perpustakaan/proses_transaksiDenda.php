<?php 
include 'connect.php';
session_start();

if(isset($_POST['submit'])){
	$bayar = $_POST['bayar'];
	$denda = $_POST['denda'];
	$id_pinjam = $_POST['id_pinjam'];
	$kd_buku = $_POST['id_buku'];
	$jumlah_pinjam = $_POST['jumlah_pinjam'];
	
	$id = $_SESSION['id_pengembalian'];
	
	
	$query = mysqli_query($con,"select * from buku where kd_buku = $kd_buku ");
	foreach($query as $data)
	{
		$jumlah_buku = $data['jumlah_buku'];
		
		$jmlh_buku = $jumlah_buku + $jumlah_pinjam;
	}
	
	
	if($bayar == $denda){
		$query = mysqli_query($con,"update pengembalian set status = 1 where id_pengembalian = '$id'");
		$query = mysqli_query($con,"update peminjaman set status = 0 where id_pinjam = '$id_pinjam'");
		$query = mysqli_query($con,"update buku set jumlah_buku = $jmlh_buku where kd_buku = $kd_buku");
		header('location:data_pengembalian.php');
	}
}

?>