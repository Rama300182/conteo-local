<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location:login.php");
} else {
/*   $ubicacion = $_SESSION['area']; */
  $usuario = $_SESSION['username'];
  $ubicacion=$_GET['area'];
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="icono.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--  <link rel="stylesheet" href='fontawesome-free-6.1.1-web/css/all.css' /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/recoleccion.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" /> -->
    <script src="https://kit.fontawesome.com/222ca0945e.js" crossorigin="anonymous"></script>
   
    <title>Recolección</title>
  </head>

  <body>
  
    <input type="text" id="usuario" value="<?= $usuario ?>" hidden>
    <input type="text" id="ubicacion" value="<?= $ubicacion ?>" hidden>
    <div class="principal">
      <div class="principal--encabezado">
        <div class="principal__elemento">
          <i class="fa-solid fa-circle-xmark"></i>
        </div>
        <div class="principal__elemento">
          <h1 id="numDeposito"><?= $ubicacion ?></h1>
        </div>
        <div class="principal__elemento">
          <i class="fa-solid fa-square-check"></i>
        </div>
      </div>
      <div class="principal--buscar">
        <div class="principal--buscar__ele">
          <input type="search" placeholder="escanear articulo..." id="buscarArticulo" />
        </div>
        <!--  <div class="principal--buscar__ele">
          <button type="button" id="buscarArticulo">INGRESAR</button>
        </div> -->
      </div>
      <div class="principal--opciones"></div>
      <div class="principal--conteo">
        <p>Ult.Ingresado: <span id="ultCodigo"></span> </p>
        <p>TOTAL: <span id="total">0</span></p>
      </div>
    </div>
    <table class="table">
      <thead class="thead-fixed">
        <tr>
          <th>CÓDIGO</th>
          <th>DESCRIPCIÓN</th>
          <th>CANT</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      
      </tbody>
    </table>
    <script src="js/recoleccion.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <!-- <script src="sweetalert2.all.min.js"></script> -->
    <script>
   document.getElementById("buscarArticulo").focus();
 
  </script>

  </body>

  </html>
 
<?php
}
?>