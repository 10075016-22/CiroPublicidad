<?php 
  session_start();

  $sesion= $_SESSION["nombre"];

  if ($sesion== null || $sesion== "") 
  {
    header("location: index.php");
  }

  $id=$_GET['id'];
  $ident = $_GET["cliente"];
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
        <?php 
          include("Conexion.php");
          $peticion=$misqli->query("SELECT * FROM orden WHERE id='$id' ");
          $resultado=$peticion->fetch_assoc();

          $client=$misqli->query("SELECT * FROM clientes WHERE identificacion='$ident' ");
          $cliente=$client->fetch_assoc();

        ?>
        <div class="row">
          <div class="col-md-12 card-body">
            <label>Nro Orden.</label>
            <input type="text" class="form-control" disabled value="<?php echo $resultado['id']; ?>">
            <label>Cliente</label>
            <input type="text" class="form-control" disabled value="<?php echo $cliente['nombre_cli']. ' ' . $cliente['apellido_cli']; ?>">
            <label>Titulo</label>
            <input type="text" class="form-control" disabled value="<?php echo $resultado['nombre_orden']; ?>">

            <label>Descripcion</label>
            <textarea class="form-control" disabled> <?php echo $resultado['descripcion_orden']; ?>
            </textarea>


            <label>Valor</label>
            <input type="text" class="form-control" disabled value="<?php echo '$ '. $resultado['valor_orden']; ?>">


            <label>Fecha creacion</label>
            <input type="text" class="form-control" disabled value="<?php echo $resultado['fecha_orden']; ?>">


            <label>Fecha de entrega</label>
            <input type="text" class="form-control" disabled value="<?php echo $resultado['fecha_entrega_orden']; ?>">
            <div align="right">
              <a href="orden.php" class="btn btn-danger">Atras</a>
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