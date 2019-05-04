<?php
include 'connect.php';
session_start();

if(isset($_SESSION['username'])){

$user = $_SESSION['username'];	

$id = $_POST['id'];


$query = mysqli_query($con,"select * from pengembalian inner join peminjaman on pengembalian.id_peminjaman = peminjaman.id_pinjam where pengembalian.id_pengembalian = $id");

foreach($query as $data){
	
	$denda =  $data['denda'];
	$status = $data['status'];
	$jumlah_pinjam = $data['jumlah_pinjam'];
	$id_buku = $data['kd_buku'];
	$id_pinjam = $data['id_peminjaman'];
	$_SESSION['id_pengembalian'] = $data['id_pengembalian'];
	
}


if($status == 1)
{
	header("Location:data_pengembalian.php");	
}
else if($status == null)
{
	
}

?>



<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css'>

      <link rel="stylesheet" href="css.style.css">

</head>
<body>

<?php
	include "navbar.php";	
?>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
    	<form action="proses_transaksiDenda.php" method='post'>
    	<h2>Denda</h2><br>
    	Anda memiliki denda sebesar Rp.<?php echo $denda; ?><br><br>
Bayar : <input type='text' name ='bayar'>
		<input type='hidden' name='denda' value='<?php echo $denda ?>'>
		<input type='hidden' name='id_pinjam' value='<?php echo $id_pinjam ?>'>
		<input type='hidden' name='jumlah_pinjam' value='<?php echo $jumlah_pinjam ?>'>
		<input type='hidden' name='id_buku' value='<?php echo $id_buku ?>'>
		<input type='submit' name= 'submit'>
		
</form>
    </div>
  </div>
</div>

</body>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js'></script>
<script src='https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  

    <script  src="js/index.js"></script></html>

    <?php 
}else{
	header('location:login.php');
}

 ?>