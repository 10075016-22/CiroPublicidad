<?php
	include('Conexion.php');
	$dato=$_POST['opcion'];

	if($dato == "1")
	{
		//RECIBE LOS VALORES DE USUARIO Y CONTRASEÑA
		$user=$_POST['username'];
		$pass=$_POST['pass'];

		$aux=md5($pass);
		//EFECTUA LA CONSULTA PARA VER SI EXISTEN LOS DATOS EN LA BD
		$consulta= "SELECT * FROM usuarios WHERE nombre='$user' AND password='$pass' ";

		$resultado= mysqli_query($misqli, $consulta);

		//NUMERO DE FILAS DONDE SE ENCUENTRAN LOS DATOS
		$filas=mysqli_num_rows($resultado);

		//VALIDACION
		if ($filas>0) 
		{
			header("location: inicio.php");

			session_start();
			$_SESSION["nombre"]=$user;
		}
		else 
		{
			header("location: index.php");
		}
	}

	//AGREGAR CLIENTES
	else if($dato == "2")
	{
		$id=$_POST['id'];
		//RECIBE LOS DATOS DEL FORMULARIO
		if(!isset($id))
		{
			header("location: 404.php");
		}else
		{
			$nombre=$_POST['cliente'];
			$apellido=$_POST['apellido'];
			$telefono=$_POST['telefono'];
			$direccion=$_POST['direccion'];
			
			//INSERTA EN LA BASE DE DATOS
			$sql= "INSERT INTO clientes VALUES ('$id','$nombre', '$apellido','$telefono','$direccion', CURRENT_TIMESTAMP())";

			$band= $misqli ->query($sql);

			//VALIDA
			if($band)
			{
				header("location: clientes.php");

			}
			else
			{
				header("location: 404.php");
			}
		}
		
	}


	//ELIMINAR CLIENTES
	else if($dato == "3")
	{
		$id=$_POST["id"];

		$elim="DELETE FROM clientes WHERE identificacion='$id' ";

		$band= $misqli -> query($elim);

		if($band)
		{
			header("location: clientes.php");
		}
		else
		{
			header("location: 404.php");
		}
	}

	//AGREGAR ORDEN 
	else if($dato == "4")
	{
		$id=$_POST['id'];
		$nombre=$_POST['orden_nombre'];
		$descripcion=$_POST['descripcion_orden'];
		$valor=$_POST['valor'];
		$fecha=$_POST['fecha'];
		$estado = 0;
		

	  	$max = $misqli->query("SELECT max(id) + 1 as numero FROM orden");
	  	$res = $max->fetch_assoc();

	  	if ($res['numero'] == null ) {
            $consecutivo_orden = 1;
          }else{
            $consecutivo_orden = $res['numero'];
          }
		//INSERTA EN LA BASE DE DATOS
		$sql =$misqli->query("INSERT INTO orden 
		VALUES ('$consecutivo_orden','$id', '$nombre','$descripcion','$valor', CURRENT_TIMESTAMP(), '$fecha','$estado' )" );

		//VALIDA
		if($sql)
		{
			header("location: orden.php");
		}
		else
		{
			header("location: 404.php");
		}
	
	}


	//COMPLETAR ORDEN --EDITAR
	else if($dato == "5")
	{
		$id=$_POST['id'];

		//INSERTA EN LA BASE DE DATOS
		$sql= "UPDATE orden SET estado='1' WHERE (id='$id')";

		$band= $misqli ->query($sql);

		//VALIDA
		if($band)
		{
			header("location: orden.php");
		}
		else
		{
			header("location: 404.php");
		}
	}

	//ELIMINAR ORDEN
	else if($dato == "6")
	{
		$id=$_POST["id"];

		$elim="DELETE FROM orden WHERE id='$id' ";

		$band= $misqli -> query($elim);

		if($band)
		{
			header("location: orden.php");
		}
		else
		{
			header("location: 404.php");
		}
	}
	//EDITAR ORDEN
	else if($dato == "7")
	{
		$id=$_POST['id'];
		$orden_nombre=$_POST['nombre_orden'];
		$descripcion_orden=$_POST["descripcion_orden"];
		$valor=$_POST["valor"];
		$fecha=$_POST["fecha"];

		//INSERTA EN LA BASE DE DATOS
		$sql= "UPDATE orden SET nombre_orden='$orden_nombre',descripcion_orden='$descripcion_orden',valor_orden='$valor',fecha_entrega_orden='$fecha' WHERE (id='$id')";

		$band= $misqli ->query($sql);

		//VALIDA
		if($band)
		{
			header("location: orden.php");
		}
		else
		{
			header("location: 404.php");
		}
	}

	else if($dato == "8")
	{
		$nombre= $_POST['nombre'];
		$pass=$_POST['pass'];
		$pass_changed=$_POST['pass_changed'];
		$pass_confirmed=$_POST['pass_confirmed'];
		$nombre_changed=$_POST['nombre_changed'];


		$id=$misqli->query("SELECT * FROM usuarios WHERE nombre= '$nombre' ");
		$resultado=$id->fetch_assoc();

		$passmd5=md5($pass);

		if($passmd5 == $resultado['password'])
		{

			if($pass_changed == $pass_confirmed)
			{
				$aux=md5($pass_changed);
				$idu=$resultado['id'];

				if(isset($nombre_changed))
				{
					$sql= "
					UPDATE usuarios 
					SET nombre='$nombre_changed', password='$aux', password_changed='$aux', password_confirm='$aux' 
					WHERE (id='$idu')";
				}
				else
				{
					$sql= "
					UPDATE usuarios 
					SET password='$aux', password_changed='$aux', password_confirm='$aux' 
					WHERE (id='$idu')";
				}

				$band= $misqli ->query($sql);

				//VALIDA
				if($band)
				{
					header("location: Config.php");
				}
				else
				{
					header("location: 404.php");
				}
			}
		}
	}

	//EDITAR ORDEN
	else if($dato == "9")
	{
		$id=$_POST['id'];
		$nombre_cli=$_POST['cliente'];
		$apellido_cli=$_POST["apellido"];
		$telefono_cli=$_POST["telefono"];
		$direccion_cli=$_POST["direccion"];

		//INSERTA EN LA BASE DE DATOS
		$sql= "UPDATE clientes SET nombre_cli='$nombre_cli', apellido_cli='$apellido_cli', telefono_cli='$telefono_cli',direccion_cli='$direccion_cli' WHERE (identificacion='$id')";

		$band= $misqli ->query($sql);

		//VALIDA
		if($band)
		{
			header("location: clientes.php");
		}
		else
		{
			header("location: 404.php");
		}
	}
?>