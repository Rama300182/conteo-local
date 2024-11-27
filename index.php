<?php 
    session_start();

    function strright($rightstring, $length)
    {
        return (substr($rightstring, -$length));
    }
    $ahora = date('Y-m') . '-' . strright(('0' . (date('d'))), 2);  

?>
    <!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Inventarios</title>
    <link rel="shortcut icon" href="icono.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/index.css">
</head>

<body class="bg-light">

<input type="hidden" id="numsuc" name="numsuc" value="<?php echo $_SESSION['numsuc']; ?>">
<div hidden id="idEnc"><?= $_GET['idEnc'] ?></div>

    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        
                        <a class="btn btn-primary mb-4" id="btnBack" href="login.php">
                            <i class="fas fa-undo"></i> Atrás
                        </a>
                        
                        <h5 class="text-center mb-3 mt-4">Ingresar Área</h5>
                        
                        <div class="form-group inputArea">
                            <input type="text" class="form-control" name="area" placeholder="Ingresar o escanear área..." id="caja">
                        </div>
                        
                        <button type="button" id="enviar" class="btn btn-success btn-block">Comenzar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/area.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function() {
            document.getElementById("caja").focus();
        }
        var nombreUser = "<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>";
        var numsuc = <?php echo isset($_SESSION['numsuc']) ? intval($_SESSION['numsuc']) : 'null'; ?>;

    </script>
</body>
</html>