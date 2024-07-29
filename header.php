
<?php 
session_start(); 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}else{

$usuario = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIAC MANAGER</title>
  <link rel="shortcut icon" href="images/favicon.png">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <!-- bootstrap jquery -->
  <script src="https://code.jquery.com/jquery-latest.min.js"></script>
  <script src="https://cdn.jsdelivr.net/mark.js/8.6.0/jquery.mark.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <!-- bootstrap sidebar stylesheet -->
  <!-- Including Font Awesome CSS from CDN to show icons -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">

  <link href="styles/menu.css" rel="stylesheet">
  <link href="styles/user.css" rel="stylesheet">
  <link href="styles/tables.css" rel="stylesheet">
</head>

<body>
  <!-- boostrap wrapper -->
  <div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-blue navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#menu-toggle" id="menu-toggle"> <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>  <span class="logo">Conteo Stock Local</span> 
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?= $usuario;?> <span class="caret"></span></a>
            </li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    <!-- Boostrap Sidebar  - Collapsible Menu Items -->
    <!-- Sidebar -->
    <div id="bootstrap-sidebar" class="cyan-theme text-menu">
      <ul class="sidebar-nav">
        <li class="active"> <a href="menu.php"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> <span class="menu-text">Home</span></a>
        </li>
        <li> <a href="javascript:;" data-toggle="collapse" data-target="#menu1"> <span class="glyphicon glyphicon-file" aria-hidden="true"></span> Reportes<b class="caret"></b> </a>
          <ul id="menu1" class="collapse">
            <li><a href="inventarioArea.php">Totales por Area</a></li>
            <li><a href="inventarioArticulo.php">Totales por Articulo</a></li>
            <li><a href="inventarioDetallado.php">Detallado por Area</a></li>
          </ul>
        <!-- </li>
        <li> <a href="inventarioDetallado.php"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <span class="menu-text">Descargar Inventario</span></a>
        </li>
        <li> <a href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> <span class="menu-text">Borrar Inventario</span></a>
        </li> -->
      <li> <a href="javascript:;" data-toggle="collapse" data-target="#menu2"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuarios<b class="caret"></b> </a>
        <ul id="menu2" class="collapse">
        <li> <a href="userList.php">Listado</a></li>
        <li> <a href="addUser.php">Agregar</a></li>
        <li> <a href="#">Cambiar Contraseña</a></li>
        </ul>
      </li>
        <li> <a href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="menu-text">Opciones</span></a>
        </li>
      </ul>
    </div>
  </div>

  <!-- /#wrapper -->
  <!-- Menu Toggle Script -->
  <script src="js/sidebar.js?ver=2"></script>
  <script src="js/user.js"></script>
    <!-- Plugin to export Excel -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

<?php
}
?>

</html>
