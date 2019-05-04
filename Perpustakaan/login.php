<html>
<head>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css'>

      <link rel="stylesheet" href="css.style.css">
<style type="text/css">
	.center-block{
		width: 500px;
		margin-top: 20%;
		padding: 10px;
		letter-spacing: 10px;
		background-color: #eceadc;

	}

	@CHARSET "UTF-8";
/*
over-ride "Weak" message, show font in dark grey
*/

.progress-bar {
    color: #333;
} 

/*
Reference:
http://www.bootstrapzen.com/item/135/simple-login-form-logo/
*/

* {
    -webkit-box-sizing: border-box;
	   -moz-box-sizing: border-box;
	        box-sizing: border-box;
	outline: none;
}

    .form-control {
	  position: relative;
	  font-size: 16px;
	  height: auto;
	  padding: 10px;
		@include box-sizing(border-box);

		&:focus {
		  z-index: 2;
		}
	}

body {
	background-color: #122120;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.login-form {
	margin-top: 75%;
}

form[role=login] {
	color: #5d5d5d;
	background: #f2f2f2;
	padding: 26px;
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
}
	form[role=login] img {
		display: block;
		margin: 0 auto;
		margin-bottom: 35px;
	}
	form[role=login] input,
	form[role=login] button {
		font-size: 18px;
		margin: 16px 0;
	}
	form[role=login] > div {
		text-align: center;
	}
	
.form-links {
	text-align: center;
	margin-top: 1em;
	margin-bottom: 50px;
}
	.form-links a {
		color: #fff;
	}
</style>
</head>

<body>

	 <div class="container">
  
  <center>
  <div class="row" id="pwd-container">
    <div class="col-md-4" style='background-color:white; height:300px'>
	<h1><label>Login</label></h1><br>
		<form action='proses_login.php' method='post'>
		Username : <input type='text' name='username'><br><br>
		Password : <input type='password' name='pass'> <br><br>
		<input type='submit' name='submit' class='btn btn-primary'>
		</form>
	</div>
	</center>

  
</div>
</form>
</div>
</body>

</html>