<?php 
	
	session_start();

	$sesion= $_SESSION["nombre"];

	if ($sesion== null || $sesion== "") 
	{
	  header("location: index.php");
	}
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>404 - Error de consulta</title>
	<link rel="shorcut icon" type="text/css" href="images/logo.png">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:700" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />
	<link type="text/css" rel="stylesheet" href="css/mdb.css" />

	<style type="text/css">
		body
		{
			margin: auto;
			background-image: url("images/404.jpg");
			background-size: 100%;
			background-repeat: no-repeat;
			background-position: all;
		}
		h2
		{
			font-weight: bold;
		}
	</style>
</head>

<div id="notfound" align="center">
	<div class="notfound">
		<div class="notfound-bg">

		</div><br><br><br><br><br><br><br><br>
		<h1>oops!</h1>
		<h2>Error : Ha ocurrido un error en la consulta</h2>
		<a href="index.php" class="btn btn-danger">Inicio</a>
	</div>
</div>