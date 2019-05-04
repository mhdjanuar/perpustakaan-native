<?php
	//memulai session
	session_start();
	//mengecek jika session user ada atau tidak
	if($_SESSION['username'] =='')header('location:login.php');
	$user = $_SESSION['username'];
?>
<html>
	<head>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
		<style>
			.menu{
				margin-right:1%;
				margin-top:1%;
				background-color:;
				height:auto;
				border-radius:10px;

			}
			.menu:hover{

				background-color:#d0d1c8;
			}
			.isi{
				margin-top:35px;
			}
			.glyphicon {
				font-size: 100px;
				margin-top:10px;
			}
			.login-user.glyphicon.glyphicon-user{
				font-size: 15px;
				margin-top:0px;
			}
			p{
				font-size: 15px;
				text-align:center;
			}
		</style>
	</head>
		<body>
			<!-- Navbar -->
			<?php
					include "navbar.php";
			?>

			<!-- End Navbar -->


			<div class="container-fluid">

					<div class='row'>
						<div class='menuutama col-md-8 col-md-offset-2' style='background-color:'>
							<div class='row'>

								<a href='buku.php'><div class='menu col-sm-4 col-sm-offset-2 col-md-2 col-md-offset-2' >
									<span class="glyphicon glyphicon-book"></span>
									<p>Buku</p>

								</div></a>
								<a href='anggota.php'><div class='menu col-sm-4 col-md-2'>
									<span class="glyphicon glyphicon-user"></span>
									<p>Anggota</p>
								</div></a>
								<a href='peminjaman.php'><div class='menu col-sm-4 col-md-2'>
									<span class="glyphicon glyphicon-shopping-cart"></span>
									<p>Peminjaman</p>
								</div></a>
								<a href='data_peminjaman.php'><div class='menu col-sm-4 col-md-2'>
									<span class="glyphicon glyphicon-share-alt"></span>
									<p>Pengembalian</p>
								</div></a>

							</div>
						</div>
					</div>

			</div>

		</body>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>
