<?php
include "connect.php";
session_start();

if($_SESSION['username']=="") header('location:login.php');

$user = $_SESSION['username'];
$id = $_POST['id'];

//mengambil data peminjaman
$query = mysqli_query($con,"SELECT * FROM peminjaman INNER JOIN siswa on siswa.nis = peminjaman.nis JOIN buku on buku.kd_buku = peminjaman.kd_buku where peminjaman.id_pinjam = '$id'");

foreach($query as $data){
	$id_pinjam = $data['id_pinjam'];
	$nis = $data['nis'];
	$nama_siswa = $data['nama_siswa'];
	$nama_buku = $data['nama_buku'];
	$jumlah_pinjam = $data['jumlah_pinjam'];
	$jatuh_tempo = $data['jatuh_tempo'];
	$status = $data['status'];
}
//end

$today = date('Y-m-d');

//operasi denda
$datetime1 = new DateTime($jatuh_tempo);
$datetime2 = new DateTime($today);

$difference = $datetime1->diff($datetime2);
$days = $difference->days;

if($datetime2 > $datetime1)
	{
		$denda = $days * 500;
	}else
	{
		$denda = 0;
	}
//end operasi denda
?>

<html>
<head>

<style type="text/css">

  .form-horizontal{
    margin-left: 5%;
    margin-top: 3%;
  }

</style>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css'>
	<link rel='stylesheet' href='https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css'>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">

      <link rel="stylesheet" href="css.style.css">

</head>
<body>

<?php
	include "navbar.php";
?>

<div class='container'>
	<div class='row'>
	<div class='col-md-12'>
			<form class="form-horizontal" action = "proses_pengembalian.php" method = "post">
			<fieldset>

			<!-- Form Name -->
			<legend>Pengembalian</legend>

			<!-- Select Basic -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="selectbasic">Nama Siswa</label>
			  <div class="col-md-4">
				<input id="kelas" name="nama_siswa" type="text" placeholder="placeholder" value='<?php echo $nama_siswa ?>' class="form-control input-md" readonly>
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="form-group">
			  <label class="col-md-4 control-label"  for="selectbasic">Nama Buku</label>
			  <div class="col-md-4">
				<input id="kelas" name="nama_buku" type="text" placeholder="placeholder" value='<?php echo $nama_buku ?>' class="form-control input-md" readonly>
			  </div>
			</div>


			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="jurusan">Jumlah Pinjam</label>
			  <div class="col-md-4">
			  <input id="kelas" name="jumlah_pinjam" type="text" placeholder="placeholder" value='<?php echo $jumlah_pinjam ?>' class="form-control input-md" readonly>

			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="kelas">Jatuh Tempo</label>
			  <div class="col-md-4">
			  <input id="kelas" name = "jatuh_tempo" type="text" placeholder="placeholder" value='<?php echo $jatuh_tempo ?>' class="form-control input-md" readonly>

			  </div>
			</div>


			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="kelas">Tanggal Kembali</label>
			  <div class="col-md-4">
			  <input id="tgl_kembali" name="tgl_kembali" type="text" placeholder="Pilih Tanggal Hari ini" value='' class="form-control input-md">

			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="kelas">Denda</label>
			  <div class="col-md-4">
			  <input id="denda" name="denda" type="text" placeholder="Biaya Denda" value='' class="form-control input-md">

			  </div>
			</div>

			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="edit"></label>
			  <div class="col-md-4">
				<button id="edit" name="submit" class="btn btn-primary">Save</button>
				<input type='hidden' name='id' value='<?php echo $data['id_pinjam'] ?>'>
			  </div>
			</div>

			</fieldset>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script  src="js/index.js"></script>

	</html>
	<script>
	  $(document).ready(function(){

			$( "#tgl_kembali" ).datepicker({dateFormat:'yy-mm-dd'});
			$("#tgl_kembali").on('change',function(){
				$('#denda').val('<?php echo $denda ?>');
			})

	  })
  </script>
