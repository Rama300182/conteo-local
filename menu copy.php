<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location:../../../logistica/login.php");
} else {

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
          <a class="navbar-brand" href="#menu-toggle" id="menu-toggle"> <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>  <span class="logo">SIAC MANAGER</span> 
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?= $usuario;?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Profile</a>
                </li>
                <li><a href="#"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Settings </a>
                </li>
              </ul>
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
          <li class="active"> <a href="#"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> <span class="menu-text">Home</span></a>
          </li>
          <li> <a href="javascript:;" data-toggle="collapse" data-target="#menu1"></i> <span class="glyphicon glyphicon-file" aria-hidden="true"></span> Reportes<b class="caret"></b></a>
            <ul id="menu1" class="collapse">
              <li><a href="inventarioArea.php">Totales por Area</a></li>
              <li><a href="inventarioArticulo.php">Totales por Articulo</a></li>
              <li><a href="inventarioDetallado.php">Detallado por Area</a></li>
            </ul>
          </li>
          <li> <a href="javascript:;" data-toggle="collapse" data-target="#menu2"></i> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuarios<b class="caret"></b> </a>
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
      <!-- /#sidebar-wrapper -->
      <!-- Page Content -->
      <div id="main-page-content">
        <div class="container-fluid">
          <h1>SIAC MANAGER</h1>
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">Administrar Inventario</div>
                <div class="panel-body" id="feature-content">

                  <a href="inventarioArea.php">
                    <div class="col-md-4">
                      <div class="panel panel-primary">
                        <div class="panel-body text-center btn-warning">
                          <span class="glyphicon glyphicon-remove icon-big" aria-hidden="true"></span>
                          <h3>Eliminar Area</h3>
                        </div>
                      </div>
                    </div>
                  </a>

                  <form action="controller/exportar.php" style="cursor:pointer">
                    <div class="col-md-4">
                      <div class="panel panel-primary">
                        <div class="panel-body text-center btn-success btn_inventario">
                          <span class="glyphicon glyphicon-save icon-big" aria-hidden="true"></span>
                          <h3><button type="submit" style="border:none;color:white;background:none">Inventario</button></h3>
                        </div>
                      </div>
                    </div>
                  </form>

                  <div class="col-md-4" style="cursor:pointer">
                    <div class="panel panel-primary">
                      <div class="panel-body text-center btn-danger btn-borrar">
                        <span class="glyphicon glyphicon-trash icon-big" aria-hidden="true"></span>
                        <h3>Borrar Inventario</h3>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">Administrar Usuarios</div>
                <div class="panel-body" id="feature-content">

                  <a type="button" data-toggle="modal" data-target="#exampleModal" style="cursor:pointer">
                    <div class="col-md-4">
                      <div class="panel panel-primary">
                        <div class="panel-body text-center btn-info">
                          <span class="fa fa-user-plus icon-big" aria-hidden="true"></span>
                          <h3>Agregar Usuario</h3>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="userList.php" style="cursor:pointer">
                    <div class="col-md-4">
                      <div class="panel panel-primary">
                        <div class="panel-body text-center btn-warning">
                          <span class="fa fa-edit icon-big" aria-hidden="true"></span>
                          <h3>Editar Usuario</h3>
                        </div>
                      </div>
                    </div>
                  </a>

                 
                </div>
              </div>
            </div>
          </div>

          <div style="clear:both"></div>
        </div>
      </div>
    </div>
    <!-- /#wrapper -->
  <!-- Menu Toggle Script -->
  <script src="js/sidebar.js?ver=2"></script>
  <script src="js/user.js"></script>
    <!-- Plugin to export Excel -->
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
  <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  Modal
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
</body>
  </body>

<?php
}
?>

<script>
  $("#myModal").modal('toggle');
</script>

<?php

include('./addUser.php');

?>

  </html>