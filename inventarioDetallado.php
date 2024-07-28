<?php


include('header.php');
require 'Class/inventario.php';

$area = new Inventario();

?>


<body>
    <div class="container">
        <div class="form-group">
            <label id="labelAreas">Total Registros</label> 
            <input name="total_todo" id="totalArea" value="0" type="text" class="form-control form-control-sm text-center total" readonly>
        </div>
        <div class="form-group">
            <label id="labelAreas">Total Articulos</label> 
            <input name="total_todo" id="total" value="0" type="text" class="form-control form-control-sm text-center total" readonly>
        </div>
        <div id="contQuickSearch">
            <label id="textBusqueda">Busqueda rapida:</label>
            <input type="text" id="textbusq" placeholder="Sobre cualquier campo..." onkeyup="myFunction()" class="form-control form-control-sm"></input>
        </div>
        <div>
            <button class="btn btn-success" id="btnExport">Exportar <i class="fa fa-file-excel-o"></i></button>
        </div>
    </div>

        <?php
        
        $todasLasAreas = $area->traerInventarioDetallado();

        ?>

    <h4>Inventario Detallado</h4>

        <div class="table-responsive" id="tableDetalle" style="height: 72vh;">
            <table class="table table-hover table-condensed table-striped text-center" id="tableData">
                <thead class="thead-dark">
                    <th scope="col" style="width: 1%; text-align:center">AREA</th>
                    <th scope="col" style="width: 1%; text-align:center">ARTICULO</th>
                    <th scope="col" style="width: 5%; text-align:center">DESCRIPCION</th>
                    <th scope="col" style="width: 1%; text-align:center">CANTIDAD</th>
                </thead>

                <tbody id="table">
                    <?php
                    $todasLasAreas = json_decode($todasLasAreas);
                   /*  print_r($todosLosPedidos);  */
                    foreach ($todasLasAreas as $valor => $value) {
                        // var_dump($value->FECHA);
                    ?>
                    <tr>
                        <td class="areas"><?= $value->AREA; ?></td>
                        <td><?= $value->ARTICULO; ?></td>
                        <td><?= $value->DESCRIPCIO; ?></td>
                        <td class="sumTotal"><?= $value->CANTIDAD; ?></td>
                    </tr>
                    <?php
                    }
                    ?>

                </tbody>

            </table>
        </div>

</body>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

$(document).ready(() => {
  $("#btnExport").click(function () {
    $("#tableDetalle").table2excel({
      // exclude CSS class
      exclude: ".noExl",
      name: "Detalle inventario",
      filename: "Detalle inventario", //do not include extension
      fileext: ".xls", // file extension
    });
  });
});


</script>

