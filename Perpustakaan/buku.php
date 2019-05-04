<?php
include "connect.php";
session_start();

if($_SESSION['username'] == "") header('location:login.php');

$user = $_SESSION['username'];

$query = mysqli_query($con,"select * from buku where jumlah_buku > 0");

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
        <caption class="text-center">Data Buku</caption>
				<caption>
				<!-- MainForm -->
					<div id='MainForm'>

						<div class='row'>
							<div class='col-md-12' style='background-color:'>
								<button id='addData' class='btn btn-primary'>Add Data</button>
								<button id='importData' class='btn btn-primary'>Import Data</button>
							</div>

					<!-- Form Input Data -->
					<div class='col-md-12' id='BodyForm1' style='display:none;background-color:'>
							<form method="post" class='FormInput'>
								<div class='row justify-md-center'>

									<div class='col-md-2'>
										<label>Kode Buku:</label>
									</div>
									<div class='col-md-9'>
										<input type = "text" name = "kodeBuku" id='kodeBuku'>
									</div>

									<div class='col-md-2'>
										<label>Nama Buku:</label>
									</div>
									<div class='col-md-9'>
										<input type = "text" name = "nama" id='nama'>
									</div>

									<div class='col-md-2'>
										<label>Pengarang:</label>
									</div>
									<div class='col-md-9'>
										<input type = "text" name = "pengarang" id='pengarang'>
									</div>

									<div class='col-md-2'>
										<label>Penerbit:</label>
									</div>
									<div class='col-md-9'>
										<input type = "text" name = "penerbit" id='penerbit'>
									</div>

									<div class='col-md-2'>
										<label>Jumlah Buku:</label>
									</div>
									<div class='col-md-9'>
										<input type = "text" name = "JumlahBuku" id='JumlahBuku'>
									</div>


									<div class='col-md-2' >
										<label></label>
									</div>
									<div class='col-md-9' >
										<input type = "submit" name = "submit" value = "Simpan" class='btn btn-primary simpan'>
										<input type = "submit" name = "reset" value = "Batal" id='reset' class='btn btn-danger'>
									</div>

								</div>
							</form>
					 </div>
					 <!--End Form Input Data -->

					<!-- Form Import Data -->
					<div class='col-md-12' id='BodyForm2' style='display:none;background-color:'>
						<form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
							<div class='row justify-md-center'>
								<div class='col-md-12'>
									<h3>Import Excel File</h3>
								</div>

								<div class='col-md-2'>
									<label>Choose Excel File</label>
								</div>
								<div class='col-md-9'>
									<input type="file" name="file" id="file" accept=".xls,.xlsx">
								</div>


								<div class='col-md-2' >
									<label></label>
								</div>
								<div class='col-md-9' >
									<button type="submit" id="submit" name="import" class="btn btn-success">Import</button>
								</div>


							</div>
						</form>
					</div>
				</div>
				<!--End Form Import Data -->
			</div>
			<!--End MainForm -->
				</caption>
        <thead>
          <tr>
            <th>Kode Buku</th>
            <th>Nama Buku</th>
						<th>Pengarang</th>
            <th>Penerbit</th>
            <th>Jumlah Buku</th>
						<th width='15%'>Action</th>
          </tr>
        </thead>
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

    <!-- <script  src="js/index.js"></script></html> -->
		<script>
			var table = $('table').DataTable({
								"ajax" : 'database/fetchBuku.php'
							})

			$(document).ready(function(){
				$('#addData').click(function(){
					$('#BodyForm1').slideToggle();
					$('#BodyForm2').slideUp();
				});

				$('#importData').click(function(){
					$('#BodyForm2').slideToggle();
					$('#BodyForm1').slideUp();
				});

		$(document).on('click', '.simpan', function(e){
	        e.preventDefault();
	        var data = $('.FormInput').serialize();
	        $.ajax({
	          type : 'POST',
	          url : 'database/serverBuku.php?simpan',
	          data : data,
	          success : function(data){
	            alert('Berhasil Simpan');
	            table.ajax.reload();
	            reset();
	          }
	        })
	      })

			$(document).on('click', '.edit', function(){
				var id = $(this).attr('id');
				$.ajax({
					type : 'GET',
					url : 'database/serverBuku.php?edit',
					data : {kdBuku : id},
					dataType : 'json',
					success : function(data){
						$('#BodyForm1').slideDown();
						$('#kodeBuku').val(data.kd_buku);
						$('#nama').val(data.nama_buku);
						$('#pengarang').val(data.pengarang);
						$('#penerbit').val(data.penerbit);
						$('#JumlahBuku').val(data.jumlah_buku);
						// alert(data.jumlah_buku);
					}
				})
			})

			$(document).on('click', '.hapus', function(){
        var kode = $(this).attr('id');
        $.ajax({
          type : 'GET',
          url : 'database/serverBuku.php?hapus',
          data : {kode : kode},
          success : function(data){
            alert('Berhasil Hapus Data');
            table.ajax.reload();
						reset();
          }
        });
      });

			$('#reset').click(function(e){
				e.preventDefault();
				reset();
			})

			function reset(){
				$('#kodeBuku').val('');
				$('#nama').val('');
				$('#pengarang').val('');
				$('#penerbit').val('');
				$('#JumlahBuku').val('');
			}

			})
		</script>
