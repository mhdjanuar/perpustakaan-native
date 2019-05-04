<?php
include "connect.php";
session_start();

if($_SESSION['username'] == '')header('location:login.php');

$user = $_SESSION['username'];

$query = mysqli_query($con,"select * from siswa");
$select_buku = mysqli_query($con,"select * from buku where jumlah_buku > 0");

$tgl_pinjam = date('Y/m/d');
$jatuh_tempo = date('Y/m/d',strtotime('+7 days', strtotime($tgl_pinjam)));

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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

      <link rel="stylesheet" href="css.style.css">

</head>
<body>

<?php
	include "navbar.php";
?>
<div class='container'>



<div class='row'>
	<div class='col-md-12'>
      <div class="validasi"></div>
			<form class="form-horizontal" method = "post">
			<fieldset>

			<!-- Form Name -->
			<legend>Peminjaman</legend>

			<!-- Select Basic -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="selectbasic">Nama Siswa</label>
			  <div class="col-md-4">
				<select id="selectbasic" name='nama_siswa' class="form-control">
				  <?php
						foreach($query as $data){
							echo "<option value='".$data['nis']."'>".$data['nama_siswa']."</option>";
						}
					?>
				</select>
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="form-group">
			  <label class="col-md-4 control-label"  for="selectbasic">Nama Buku</label>
			  <div class="col-md-4">
				<select id="selectbasic" name='nama_buku' class="form-control js-example-basic-single">
				  <?php
						foreach($select_buku as $data){
							echo "<option value='".$data['kd_buku']."'>".$data['nama_buku']."</option>";
						}
				  ?>
				</select>
			  </div>
			</div>


			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="jurusan">Jumlah Pinjam</label>
			  <div class="col-md-4">
			  <input id="jumlah_pinjam" name="jumlah_pinjam" type="text" placeholder="Masukan Jumlah Pinjam" value='' class="form-control input-md">

			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="kelas">Tanggal Pinjam</label>
			  <div class="col-md-4">
			  <input id="tgl_pinjam" name = "tgl_pinjam" type="text" placeholder="placeholder" value='<?php echo $tgl_pinjam ?>' class="form-control input-md">

			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="kelas">Jatuh Tempo</label>
			  <div class="col-md-4">
			  <input id="jatuh_tempo" name = "jatuh_tempo" type="text" placeholder="placeholder" value='<?php echo $jatuh_tempo ?>' class="form-control input-md">

			  </div>
			</div>

			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="edit"></label>
			  <div class="col-md-4">
				<button id="edit" name="submit" class="btn btn-primary simpan">Save</button>
			<span>*Pengembalian yang dilakukan setelah batas pengembalian akan dikenakan denda sebesar Rp. 500 per hari.</span>
			  </div>
			</div>

			</fieldset>
		</form>

	</div>
</div>

</div>




</body>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script  src="js/index.js"></script></html>

	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();

			$('#tgl_pinjam').on('change',function(){
				$('#jatuh_tempo').val('<?php echo $jatuh_tempo ?>');
			  })

      $(document).on('click', '.simpan', function(e){
        e.preventDefault();
        var data = $('form').serialize();
        $.ajax({
          type : 'POST',
          url : 'database/serverPinjam.php',
          data : data,
          success : function(data){
            $('.validasi').html(data);
            reset();
          }
        })
      })

		});

    function reset(){
        $('#jumlah_pinjam').val('');
    }
	</script>
