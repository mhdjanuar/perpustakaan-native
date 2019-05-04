<?php 
include "connect.php";
session_start();

if($_SESSION['username'] == "") header('location:login.php');

$user = $_SESSION['username'];	

$query = mysqli_query($con,"select * from peminjaman inner join siswa on peminjaman.nis = siswa.nis join buku on peminjaman.kd_buku = buku.kd_buku where peminjaman.status = 0");

$today = date('Y-m-d');
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
      <table summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
        <caption class="text-center">Data Peminjaman</caption>
        <thead>
          <tr>
            <th>NIS</th>
            <th>Nama Siswa</th>
			<th>Nama Buku</th>
            <th>Jumlah Pinjam</th>
			<th>Tanggal Pinjam</th>
			<th>Jatuh Tempo</th>
			<th>Status</th>
			<th>Action</th>
          </tr>
        </thead>
        <tbody>
		<?php
	while($data = mysqli_fetch_array($query))
{
	$status = $data['status'];
	$jatuh_tempo = $data['jatuh_tempo'];
	
	//mengecek telat atau tidak
	if($today > $jatuh_tempo) $telat = 'danger';
	else $telat = 'succses';
	
	//status pinjam
	if($status == 0) $status_pinjam = 'Masih Pinjam';

	echo "<tr class='".$telat."'>";
	echo "<td>".$data['nis']."</td>";
	echo "<td>".$data['nama_siswa']."</td>";
	echo "<td>".$data['nama_buku']."</td>";
	echo "<td>".$data['jumlah_pinjam']."</td>";
	echo "<td>".$data['tgl_pinjam']."</td>";
	echo "<td>".$data['jatuh_tempo']."</td>";
	echo "<td>".$status_pinjam."</td>";
	echo "<td><center><form action='pengembalian.php' method='post'><button class='btn btn-primary' type'submit' name='id' value='".$data['id_pinjam']."'>Kembalikan</button></form></center></td>";
	echo "</tr>";
}
  ?>
        </tbody>
      </table>
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
	