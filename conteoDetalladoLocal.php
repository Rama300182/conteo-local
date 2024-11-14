
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorización Gastos de Sucursales</title>
    <link rel="shortcut icon" href="images/caja.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="styles/conteo.css" class="rel">

</head>
<body>

<div class="custom-container">
<h4><i class="bi bi-basket3-fill"></i>  Conteo Detallado por artículo</h4>
  
    <div class="filter-row row align-items-center mt-3">
        <div class="col-md-2" style="display: inline-flex;">
            <label for="desde" class="mr-1">Desde:</label>
            <input type="date" id="desde" class="form-control form-control-sm" value="2024-01-01">
        </div>
        <div class="col-md-2" style="display: inline-flex;">
            <label for="hasta" class="mr-1">Hasta:</label>
            <input type="date" id="hasta" class="form-control form-control-sm" value="2024-01-31">
        </div>
        <div class="col-" style="display: inline-flex;">
            <label for="sucursal" class="mr-1 ml-2">Rubro:</label>
            <select id="sucursal" class="form-control form-control-sm">
                <option>BILLETERAS DE VINILICO</option>
                <!-- Agregar más opciones si es necesario -->
            </select>
        </div>
        <div class="d-flex align-items-end ml-2">
            <button class="btn btn-primary btn-block">
                Filtrar <i class="fas fa-filter"></i>
            </button>
        </div>
    </div>

    <table id="example" class="table table-bordered display">
        <thead class="thead-dark">
            <tr>
                <th>FECHA</th>
                <th>ARTICULO</th>
                <th>DESCRIPCION</th>
                <th>RUBRO</th>
                <th>CANT. SISTEMA</th>
                <th>CANT. CONTEO</th>
                <th>DIFERENCIA</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1/7/2024</td>
                <td>XV3SDC37B0112</td>
                <td>PIPPA FICHERO</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>3</td>
                <td>2</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XC2SAP01B1829</td>
                <td>ARI BILLE H C CIERRE</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>2</td>
                <td>1</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XV3SDC37B0112</td>
                <td>PIPPA FICHERO</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>3</td>
                <td>2</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XC2SAP01B1829</td>
                <td>ARI BILLE H C CIERRE</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>2</td>
                <td>1</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XV3SDC37B0112</td>
                <td>PIPPA FICHERO</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>3</td>
                <td>2</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XC2SAP01B1829</td>
                <td>ARI BILLE H C CIERRE</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>2</td>
                <td>1</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XV3SDC37B0112</td>
                <td>PIPPA FICHERO</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>3</td>
                <td>2</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XC2SAP01B1829</td>
                <td>ARI BILLE H C CIERRE</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>2</td>
                <td>1</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XV3SDC37B0112</td>
                <td>PIPPA FICHERO</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>3</td>
                <td>2</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XC2SAP01B1829</td>
                <td>ARI BILLE H C CIERRE</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>2</td>
                <td>1</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XV3SDC37B0112</td>
                <td>PIPPA FICHERO</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>3</td>
                <td>2</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XC2SAP01B1829</td>
                <td>ARI BILLE H C CIERRE</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>2</td>
                <td>1</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XV3SDC37B0112</td>
                <td>PIPPA FICHERO</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>3</td>
                <td>2</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XC2SAP01B1829</td>
                <td>ARI BILLE H C CIERRE</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>2</td>
                <td>1</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XV3SDC37B0112</td>
                <td>PIPPA FICHERO</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>3</td>
                <td>2</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XC2SAP01B1829</td>
                <td>ARI BILLE H C CIERRE</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>2</td>
                <td>1</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XV3SDC37B0112</td>
                <td>PIPPA FICHERO</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>3</td>
                <td>2</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XC2SAP01B1829</td>
                <td>ARI BILLE H C CIERRE</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>2</td>
                <td>1</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XV3SDC37B0112</td>
                <td>PIPPA FICHERO</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>3</td>
                <td>2</td>
                <td>-1</td>
            </tr>
            <tr>
                <td>1/7/2024</td>
                <td>XC2SAP01B1829</td>
                <td>ARI BILLE H C CIERRE</td>
                <td>BILLETERAS DE VINILICO</td>
                <td>2</td>
                <td>1</td>
                <td>-1</td>
            </tr>
        </tbody>
    </table>
</div>

<script src="https://kit.fontawesome.com/your-kit-code.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "pageLength":50,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
            }
        });
    });
</script>
</body>
</html>

