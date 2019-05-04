<?php
include "connect.php";
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
session_start();

if (isset($_POST["import"]))
{


  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new SpreadsheetReader($targetPath);

        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {

            $Reader->ChangeSheet($i);

            foreach ($Reader as $Row)
            {

                $nis = "";
                if(isset($Row[0])) {
                    $nis = mysqli_real_escape_string($con,$Row[0]);
                }

                $nama_siswa = "";
                if(isset($Row[1])) {
                    $nama_siswa = mysqli_real_escape_string($con,$Row[1]);
                }

                $kelas = "";
                if(isset($Row[2])) {
                    $kelas = mysqli_real_escape_string($con,$Row[2]);
                }

                $jurusan = "";
                if(isset($Row[3])) {
                    $jurusan = mysqli_real_escape_string($con,$Row[3]);
                }


                if (!empty($nis) || !empty($nama_siswa) || !empty($kelas) || !empty($jurusan)) {
                    $query = "insert into siswa(nis,nama_siswa,kelas,jurusan) values('".$nis."','".$nama_siswa."','".$kelas."'
                    ,'".$jurusan."')";
                    $result = mysqli_query($con, $query);

                    if (! empty($result)) {
                        $type = "success";
                        $message = "Excel Data Imported into the Database";
                    } else {
                        $type = "error";
                        $message = "Problem in Importing Excel Data";
                    }
                }
             }

         }
  }
  else
  {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
}

if($_SESSION['username'] == "") header('location:login.php');

$user = $_SESSION['username'];

$sql = mysqli_query($con,'select * from siswa');

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

<!-- Navbar -->
<?php
		include "navbar.php";
?>

<!-- End Navbar -->

<div class="container">

  <!-- Table Anggota -->
  <div class="row">
    <div class="col-md-12">
      <table summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
		<caption class="text-center">Data Siswa</caption>
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
								<label>Nis:</label>
							</div>
							<div class='col-md-9'>
								<input type = "text" name = "nis" id='nis'>
							</div>

							<div class='col-md-2'>
								<label>Nama Siswa:</label>
							</div>
							<div class='col-md-9'>
								<input type = "text" name = "nama" id='nama'>
							</div>

							<div class='col-md-2'>
								<label>Kelas:</label>
							</div>
							<div class='col-md-9'>
								<input type = "text" name = "kelas" id='kelas'>
							</div>

							<div class='col-md-2'>
								<label>Jurusan:</label>
							</div>
							<div class='col-md-9'>
								<select name='jurusan' id='jurusan'>
									<option>Rekayasa Perangkat Lunak</option>
									<option>Hotel</option>
									<option>Tata Boga</option>
								</select>
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
              <th>Nis</th>
              <th>Nama Siswa</th>
			        <th>Kelas</th>
              <th>Jurusan</th>
			        <th>Action</th>
          </tr>
        </thead>

      </table>
		<div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
  </div>
</div>
<!-- End Table Anggota -->

</body>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js'></script>
<script src='https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
	$(document).ready(function(){
      var table = $('table').DataTable({
        "ajax" : 'database/fetchAnggota.php'
      });

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
          url : 'database/serverAnggota.php?simpan',
          data : data,
          success : function(data){
            alert("Berhasil Simpan Data");
            table.ajax.reload();
            reset();
          }
        })
      })

      $(document).on('click', '.edit', function(){
        var nis = $(this).attr('id');
        $.ajax({
          type : 'GET',
          url : 'database/serverAnggota.php?edit',
          data : {nis : nis},
          dataType : 'json',
          success : function(data){
            $('#BodyForm1').slideDown();
          	$('#BodyForm2').slideUp();
            $('#nis').val(data.nis);
      			$('#nama').val(data.nama_siswa);
      			$('#kelas').val(data.kelas);
      			$('#jurusan').val(data.jurusan);
          }
        });
      });

      $(document).on('click', '.hapus', function(){
        var nis = $(this).attr('id');
        $.ajax({
          type : 'GET',
          url : 'database/serverAnggota.php?hapus',
          data : {nis : nis},
          success : function(data){
            alert('Berhasil hapus data');
            table.ajax.reload();
          }
        });
      });

      $('#reset').click(function(e){
        e.preventDefault();
        reset();
      })

			// function loadData(){
			// 	$.get('content_table_anggota.php',function(data){
			// 		$('tbody').html(data);
      //
			// 		$('.UpdateData').click(function(e){
			// 			e.preventDefault();
			// 			$('#BodyForm1').slideDown();
			// 			$('#BodyForm2').slideUp()
			// 			$('#nis').val($(this).attr('nis'));
			// 			$('#nama').val($(this).attr('nama'));
			// 			$('#kelas').val($(this).attr('kelas'));
			// 			$('#jurusan').val($(this).attr('jurusan'));
			// 			$('.FormInput').attr('action',$(this).attr('href'));
			// 		})
			// 	});
			// }

			// $('.FormInput').on('submit',function(e){
			// 	e.preventDefault();
			// 	$.ajax({
			// 		type:$(this).attr('method'),
			// 		url:$(this).attr('action'),
			// 		data:$(this).serialize(),
			// 			success:function(data){
			// 				alert(data);
			// 			}
			// 	});
      //
			// });
      //
			// $('#reset').click(function(){
			// 	reset();
			// });

			function reset(){
				$('#nis').val("");
				$('#nama').val("");
				$('#kelas').val("");
				$('#jurusan').val("");
				$('#nis').focus();
			}
	});
</script>
