<?php
include "connect.php";
session_start();  

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$pass =  $_POST['pass'];
	
	$query = mysqli_query($con,"SELECT * FROM petugas WHERE nama_petugas = '$username' and password = '$pass' ");
	
	$cek = mysqli_num_rows($query);
	
	if($cek > 0){
		//header('location:home.php');
		
		foreach($query as $data){
		$_SESSION['username']=$data['nama_petugas'];
		//echo $data['nama_petugas'];
		header('location:home.php');
		}
	}
	else{
		echo "gagal";
	}
}

?>