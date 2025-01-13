<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location:login.php");
} else {
/*   $ubicacion = $_SESSION['area']; */
  require_once 'Class/conteo.php';
  $usuario = $_SESSION['username'];
  $ubicacion=$_GET['area'];
  $idEnc = $_GET['idEnc'];
  $conteo = new Conteo();
  $conteo->estadoIniciado($idEnc);  
  
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <link rel="shortcut icon" href="icono.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styles/recoleccion.css" />
    <title>Recolección</title>
</head>
<body>
    <input type="hidden" id="usuario" value="<?= $usuario ?>">
    <input type="hidden" id="ubicacion" value="<?= $ubicacion ?>">
    <input type="hidden" id="idEnc" value="<?= $idEnc ?>">
    <input type="hidden" id="numsuc" name="numsuc" value="<?php echo $_SESSION['numsuc']; ?>">
    
    <div class="container-fluid px-0">
        <div class="principal">
            <div class="principal--encabezado">
                <div class="principal__elemento">
                    <i class="fas fa-times-circle" id="iconCancel"></i>
                </div>
                <div class="principal__elemento">
                    <h5 id="numDeposito">Area: <?= $ubicacion ?></h5>
                </div>
                <div class="principal__elemento">
                    <i class="fas fa-check-square" id="iconConfirm"></i>
                </div>
            </div>
            <div class="principal--buscar">
                <div class="principal--buscar__ele">
                    <input type="search" class="form-control form-control-sm" placeholder="Escanear artículo..." id="buscarArticulo" />
                </div>
            </div>
            <div class="principal--conteo">
                <p class="mb-0">Últ.Ingresado: <span id="ultCodigo"></span></p>
                <p class="mb-0">TOTAL: <span id="total">0</span></p>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-sm">
                <thead class="thead-fixed">
                    <tr>
                    <th class="col-codigo">CÓDIGO</th>
                    <th class="col-descripcion">DESCRIPCIÓN</th>
                    <th class="col-cant">CANT</th>
                    <th class="col-accion"></th>
                    </tr>
                </thead>
                <tbody>
                  <!-- Las filas se añadirán aquí -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/recoleccion.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("buscarArticulo").focus();
    </script>
</body>
</html>
 
<?php
}
?>