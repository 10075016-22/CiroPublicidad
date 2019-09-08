<?php 
	session_start();

	$sesion= $_SESSION["nombre"];

	if ($sesion== null || $sesion== "") 
	{
	  header("location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("layouts/head.php"); ?>
</head>


<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="inicio.php">CiroPublicidad</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

	<ul class="navbar-nav ml-auto ml-md-12">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item"><i class="fas fa-user"></i> <?php echo $_SESSION['nombre']; ?></a>
          <a class="dropdown-item" href="Config.php"><i class="fas fa-cog"></i> Ajustes</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="Logout.php"><i class="fas fa-times"></i> Cerrar Sesión</a>
        </div>
      </li>
    </ul>    
    
  </nav>

  <div id="wrapper">

    <?php include("layouts/menu.php"); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="inicio.php">CIROPUBLICIDAD</a>
          </li>
        </ol>

        <div class="row">
          <div class="col-md-12">
            <h2>ORDENES</h2>
          </div>
        </div>
        <br><br>

        <div class="row">
          <div class="col-md-12">
            <input class="form-control" type="text" placeholder="Filtrar" id="busqueda" >
            <br>
            
          </div>

        </div>

        <br><br>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Num</th>
                <th scope="col">Cliente</th>
                <th scope="col">Orden</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Valor</th>
                <th scope="col">Fecha de salida</th>
                <th scope="col">Estado</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">&nbsp;</th>
              </tr>
            </thead>
          <tbody id="tabla">
            <?php 
              include("Conexion.php"); 
              $cli = "SELECT * From orden";
              $resultado = $misqli->query($cli);

              while($row = $resultado->fetch_assoc()) 
              {
            ?>
            
              <tr>
                <th><?php echo $row['id']; ?></th>
                <td>
                  <?php 
                    $consulta=$misqli->query("SELECT nombre_cli FROM clientes WHERE identificacion = '".$row['identificacion']."' ");
                      $dato=$consulta->fetch_assoc();
                      echo $dato['nombre_cli']; ?>
                </td>
                <td><?php echo $row['nombre_orden']; ?></td>
                <td><?php echo $row['descripcion_orden']; ?></td>
                <td><?php echo $row['valor_orden']; ?></td>
                <td><?php echo $row['fecha_entrega_orden']; ?></td>
                <td>
                	<?php 
                		if($row['estado']== 0)
                		{
                			?>
                				<form action="Consultas.php" method="POST">
                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                          <input type="hidden" name="opcion" value="5">
                          <button class="btn btn-success btn-sm" type="submit"><i class="far fa-thumbs-up"></i></button>
                      </form>
                			<?php
                		}
                		else if($row['estado'] == 1)
                		{
                			?>
                				<button disabled="true" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                			<?php
                		}
                	 ?>
                </td>

                <td>
            	<?php 
            		if($row['estado']== 0)
                	{
            	 ?>
                  <form action="editarOrden.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <button class="btn btn-success btn-sm"type="submit"><i class="fas fa-edit"></i></button> 
                  </form>
                 
                  	
                  	<?php 
                  	}
                  	else
                  	{ 
                  		?>
	                  	<button disabled="true" class="btn btn-success btn-sm" data-toggle="modal" data-target="#EditOrden">
	                  		<i class="fas fa-edit"></i>
	                  	</button>
                  	<?php 
                  	} 
                  	?>
                  


                </td>

                <td>
                  <form action="Consultas.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="opcion" value="6">
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                  </form>
                </td>


                <td>
                	<?php 
                		if($row['estado']== 0)
                		{
                	?>
		                	<form action="details.php" method="GET">
		                		<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
		                    	<input type="hidden" name="opcion" value="5">
                          <input type="hidden" name="cliente" value="<?php echo $row['identificacion']; ?>">
		                		<button class="btn btn-info btn-sm" type="submit"><i class="fa fa-print"></i></button>
		                	</form>

		            <?php
		            	}
		            	else
		            	{
		            		?>
                      <form action="details.php" method="GET">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="cliente" value="<?php echo $row['identificacion']; ?>">
                        <input type="hidden" name="opcion" value="5">
                        <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-print"></i></button>
                      </form>
		            		<?php
		            	}
		            ?>
                    
                </td>

              </tr>

            <?php 
              }
            ?>
            </tbody>
          </table>
          </div>
        </div>
        
        
      </div>
      <!-- /.container-fluid -->

      
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->


  <?php include("layouts/scripts.php"); ?>
</body>

</html>