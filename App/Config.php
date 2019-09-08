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
          <div class="col-md-1">            
          </div>

          <div class="col-md-5">
            <h2>Configuración</h2>
            <br><br>
            <form action="Consultas.php" method="POST">
                <div class="form-group ">
                  <label>Nombre usuario</label>
                  <br>
                  <input disabled="true" class="form-control" type="text" value="<?php echo $_SESSION['nombre']; ?>">
                  <input value="<?php echo $_SESSION['nombre']; ?>" name="nombre" type="hidden">
                </div>

                <div class="form-group">
                  <label>*Contraseña actual</label>
                  <br>
                  <input type="password" name="pass" class="form-control" required>  
                </div>

                <div class="form-group ">
                  <label>Nombre usuario nuevo</label>
                  <br>
                  <input  class="form-control" type="text" name="nombre_changed">
                </div>

                <div class="form-group">
                  <label>*Contraseña Nueva</label>
                  <br>
                  <input type="password" name="pass_changed" class="form-control" required="true">  
                </div>

                <div class="form-group">
                  <label>*Confirmar contraseña</label>
                  <br>
                  <input type="password" name="pass_confirmed" class="form-control" required="true">  
                </div>
                <input type="hidden" name="opcion" value="8">

                <div class="form-group">
                  <button class="btn btn-success" type="submit">Actualizar datos</button>
                </div>
            </form>
          </div>

          <div class="col-md-6">
            <br>
            <center><img style="width: 65%;"src="images/logo.png"></center>
          </div>

        </div>
        <br><br>

        <div class="row">
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