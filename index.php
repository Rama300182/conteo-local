<?php session_start();
if (!isset($_SESSION['username'])) {
    header("Location:../login.php");
} else {
    function strright($rightstring, $length)
    {
        return (substr($rightstring, -$length));
    }
    $ahora = date('Y-m') . '-' . strright(('0' . (date('d'))), 2);

    $nombre = $_SESSION['nombre'];

?>
    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Inventarios</title>
        <link rel="shortcut icon" href="icono.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Including Font Awesome CSS from CDN to show icons -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="styles/index.css">
    </head>

    <body>

        <div class="contenedor--principal">
            <?php
            if ($_SESSION['permisos'] == 6) {
                //echo 'm'.$_SESSION['username'].'m';
            ?>



                <form action="exportar.php" id="exportar" method="GET" class="contenedor--secundario">
                    <p>EXPORTAR</p>
                    <div class="contenedor--secundario__ele--col">
                        Desde <input type="date" name="desde" value="<?php echo $ahora ?>"></input>
                        Hasta <input type="date" name="hasta" value="<?php echo $ahora ?>"></input>
                    </div>
                    <div class="contenedor--secundario__ele--col">
                        <input type="submit" value="Exportar" class="btn btn-primary btn-sm">

                        <button type="button" class="btn btn-primary btn-sm" onClick="location.href='vaciar.php'">Limpiar Historial</button>
                    </div>
                </form>

            <?php
            }
            ?>


            <div class="contenedor--secundario" id="formulario">

            <a type="button" class="btn btn-primary" id="btnBack" href="javascript:history.back(-1)"><i class="fa fa-undo"></i> Atras</a>
                <div class="contenedor--secundario__ele--col">
                    <p>Ingrese Area</p></br>
                    <input class="" type="text" name="area" placeholder="Ingrese area..." id="caja">
                    <a><input type="submit" value="Comenzar" id="enviar" class="btn btn-success"></br>
                </div>
        </div>

        </div>




        <script>
            window.onload = function() {
                var input = document.getElementById("caja").focus();
            }
		
		var nombreUser = "<?= $nombre; ?>"; 
        
	    </script>

        </script>
        <script src="js/area.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php
}
    ?>
    </body>


    </html>