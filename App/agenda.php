<?php 
	session_start();

	$sesion= $_SESSION["nombre"];

	if ($sesion== null || $sesion== "") 
	{
	  header("location: index.php");
	}
  include 'Conexion.php';
  $sql = $misqli->query("SELECT * FROM orden");

?>
<!DOCTYPE html>
<html lang="en">
	<?php include("layouts/head.php"); ?>



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
            <h2>AGENDA DE PEDIDOS</h2>
          </div>
          
          <div class="col-md-12">
            <div id='calendar'></div>
          </div>
      </div>
      
    </div>

  </div>
  <?php 
    $cliente= $misqli->query("SELECT * FROM clientes");
  ?>
  <!-- Modal -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form class="form-horizontal" method="POST" action="Consultas.php">
      
        <div class="modal-header">
        <h3>Agregar Pedido</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" name="orden_nombre" required placeholder="Titulo orden">
          </div>  
          <div class="form-group">

            <select name="id" class="form-control">
              <option value="">Seleccione cliente</option>
              <?php 
              while ($cli = $cliente->fetch_assoc())
              {
                ?>
                <option value="<?php echo $cli['identificacion']; ?>"><?php echo $cli['nombre_cli']. " " . $cli['apellido_cli']; ?></option>
                <?php
              }
              ?>
            </select>
          </div>
            
          <div class="form-group">
            <label >Descripción</label>
            <textarea class="form-control" name="descripcion_orden" required="true">
            </textarea>
          </div>

          <div class="form-group">
            <input type="number" min="0" class="form-control"  name="valor" required placeholder="Valor">
          </div>

          <div class="form-group">
            <label class="col-form-label">Fecha de entrega </label>
            <input type="date" class="form-control" name="fecha" id="start">
          </div>

          <input type="hidden" name="opcion" value="4">
        </div>
        

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
      </div>
      </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <form class="form-horizontal" method="GET" action="editarOrden.php">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Modificar Orden</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control">
          </div>
          <div class="form-group">
            <label for="title">Editar orden</label>
            <div class="form-group">
              <input type="text" name="title" class="form-control" id="title" placeholder="Titulo" disabled>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Editar</button>
        </div>
      </form>
      </div>
      </div>
    </div>



  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
  <script src="js/sb-admin.min.js"></script>
  <script src="js/demo/datatables-demo.js"></script>
  <script type="text/javascript" src="js/fullCalendar/fullcalendar.js"></script>
  <script type="text/javascript" src="js/fullcalendar/locale/es.js"></script>
  <script type="text/javascript" src="js/fullcalendar/lib/moment.min.js"></script>
  <script>
      
      $(document).ready(function()
      {
        var date = new Date();
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
        var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

        $('#calendar').fullCalendar({
          header:
          {
            lang: 'es',
            left: 'prev,next, today',
            center: 'title',
            right: 'month, basicWeek'
          },

          defaultDate: yyyy+"-"+mm+"-"+dd,
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          selectable: true,
          selectHelper: true,
          select: function(start, end) {          
            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
            $('#ModalAdd').modal('show');
          },

          eventRender: function(event, element) {
          element.bind('dblclick', function() {
            $('#ModalEdit #id').val(event.id);
            $('#ModalEdit #title').val(event.title);
            $('#ModalEdit').modal('show');
          });
        },
          events:
          [
            <?php 
            while ($row = $sql->fetch_assoc())
            {
            ?>
              {
                id: '<?php echo $row['id']; ?>',
                title: '<?php echo $row['nombre_orden']; ?>',
                start: '<?php echo $row['fecha_entrega_orden']; ?>',
                end: '<?php echo $row['fecha_entrega_orden']; ?>',
                className: ['description']

              },
            <?php 
            }
            ?>
          ],

          eventColor: '#01A185'

        });
      });
    </script>



</body>

</html>