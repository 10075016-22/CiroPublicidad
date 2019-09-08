
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Administrador</title>

  
  <link rel="shorcut icon" type="text/css" href="images/logo.png">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/mdb.css">
  <link rel="stylesheet" type="text/css" href="css/mdb.lite.css">

  <link href='js/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
  <link href='js/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  
  <script src='js/fullcalendar/lib/jquery.min.js'></script>
  <script src='js/fullcalendar/lib/moment.min.js'></script>
  <script src='js/fullcalendar.min.js'></script>

  <script>
    $(document).ready(function()
    {
      $("#busqueda").on("keyup", function()
      {
        var value = $(this).val().toLowerCase();
        $("#tabla tr").filter(function() 
        {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>