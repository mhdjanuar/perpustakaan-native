<?php 
	include "connect.php";
	session_start();
	
	if(isset($_POST['nis'])){
		 $nis = $_POST['nis'];
		
		$query = mysqli_query($con,"select * from siswa where nis = $nis");
		
		foreach($query as $data){
			  $nis = $data['nis'];
			  $nama = $data['nama_siswa'];
			  $jurusan = $data['jurusan'];
			  $kelas = $data['kelas'];
		}	
	}
	if($_SESSION['username'] =='')header('location:login.php');
	$user = $_SESSION['username'];
?>

<html>
	<head>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
	</head>
	<body>
		<div class='container'>
		<?php
			include "navbar.php";	
		?>
			<form class="form-horizontal">
			<fieldset>

			<!-- Form Name -->
			<legend>Edit Siswa</legend>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="textinput">NIS</label>  
			  <div class="col-md-4">
			  <input id="textinput" name="textinput" type="text" placeholder="" value='<?php echo $nis ?>' class="form-control input-md">
				
			  </div>
			</div>
			
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="namaSiswa">Nama Siswa</label>  
			  <div class="col-md-4">
			  <input id="namaSiswa" name="namaSiswa" type="text" placeholder="placeholder" value='<?php echo $nama ?>' class="form-control input-md">
				
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="jurusan">Jurusan</label>  
			  <div class="col-md-4">
			  <input id="jurusan" name="jurusan" type="text" placeholder="placeholder" value='<?php echo $jurusan ?>' class="form-control input-md">
				
			  </div>
			</div>


			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="kelas">Kelas</label>  
			  <div class="col-md-4">
			  <input id="kelas" name="kelas" type="text" placeholder="placeholder" value='<?php echo $kelas  ?>' class="form-control input-md">
				
			  </div>
			</div>

			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="edit"></label>
			  <div class="col-md-4">
				<button id="edit" name="edit" class="btn btn-primary">Save</button>
			  </div>
			</div>

			</fieldset>
		</form>

		</div>
	</body>
</html>