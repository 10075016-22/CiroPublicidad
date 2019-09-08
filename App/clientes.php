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
            <h2>CLIENTES</h2>
          </div>
        </div>

        
        <br>
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-info" data-toggle="modal" data-target="#agregarCliente"> <i class="fas fa-plus"></i> Agregar Cliente</button>
              <div class="modal fade" id="agregarCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Agregar cliente</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form method="POST" action="Consultas.php">
                        
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-circle"></i></span>
                          </div>
                          <input type="number" min="0" class="form-control" name="id" required  placeholder="Identificación">
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" name="cliente" required="true" placeholder="Nombre">
                        </div>

                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" name="apellido" required="true" placeholder="Apellido">
                        </div>

                        <br>

                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                          </div>
                          <input type="number" class="form-control"  name="telefono" required="true" placeholder="Telefono">
                        </div>
                        
                        <br>

                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                          </div>
                          <input type="text" class="form-control" name="direccion" placeholder="Direccion">
                        </div>

                        <input type="hidden" name="opcion" value="2">

                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-info">Guardar</button>
                        </div>

                    </form>
                    </div>


                  </div>
                </div>
            </div>
              <br><br>
              <input class="form-control" type="text" placeholder="Filtrar" id="busqueda" >
            </div>
          </div>
        <br>
        <br>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Dirección</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">&nbsp;</th>
              </tr>
            </thead>
          <tbody id="tabla">
            <?php 
              include("Conexion.php"); 
              $cli = "SELECT * From clientes";
              $resultado = $misqli->query($cli);

              while($row = $resultado->fetch_assoc()) 
              {
              ?>
            
                <tr>
                  <td><?php echo $row['identificacion']; ?></td>
                  <td><?php echo $row['nombre_cli']; ?> </td>
                  <td><?php echo $row['apellido_cli']; ?></td>
                  <td><?php echo $row['telefono_cli']; ?></td>
                  <td><?php echo $row['direccion_cli']; ?></td>

                  <td>
                    <form action="editarCliente.php" method="GET">
                      <input type="hidden" name="ide" value="<?php echo $row['identificacion'] ?>">
                      <button class="btn btn-success btn-sm" type="submit">
                        <i class="fas fa-edit"></i>
                      </button>
                    </form>
                    
                  </td>


                  <td>
                    <form method="POST" action="Consultas.php">
                      <input type="hidden" name="id" value="<?php echo $row['identificacion']; ?>">
                      <input type="hidden" name="opcion" value="3">
                      <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </form>
                  </td>


                  <td>
                      <form action="agregarOrden.php" method="GET">
                        <input type="hidden" name="identificacion" value="<?php echo $row['identificacion']; ?>">
                     <button class="btn btn-info btn-sm"type ="submit"><i class="fas fa-plus"></i></button>

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