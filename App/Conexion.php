<?php 

	//Conexion a la base de datos

	$hostname="localhost";
	$username="root";
	$password="";
	$database="ciro";

	//MySQLi

	$misqli= new mysqli($hostname, $username, $password, $database);

	if ($misqli -> connect_errno) 
	{
		die("Fallo la conexion a MySQL:  (" . $misqli -> mysqli_connect_errno() . ") ".$misqli -> mysqli_connect_errno());
	}
	

?>