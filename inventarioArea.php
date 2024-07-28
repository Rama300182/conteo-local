<?php

include('header.php');
require 'Class/inventario.php';

$area = new Inventario();

?>


<body>
    <div class="container">
        <div class="form-group">
            <label id="labelAreas">Cantidad Areas</label> 
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
    </div>

        <?php
        
        $todasLasAreas = $area->traerInventarioTotalArea();

        ?>

        <h4>Totales por Area</h4>

        <div class="table-responsive" id="tablePedidos" style="height: 72vh;">
            <table class="table table-hover table-condensed table-striped text-center" id="table">
                <thead class="thead-dark">
                    <th scope="col" style="width: 1%; text-align:center">AREA</th>
                    <th scope="col" style="width: 1%; text-align:center">CANTIDAD</th>
                    <th scope="col" style="width: 1%"></th>
                    <th scope="col" style="width: 1%"></th>
                </thead>

                <tbody id="table">
                    <?php
                    $todasLasAreas = json_decode($todasLasAreas);
                   /*  print_r($todosLosPedidos);  */
                    foreach ($todasLasAreas as $valor => $value) {
                        // var_dump($value->FECHA);
                    ?>
                    <tr>
                        <td class="areas" id="area"><?= $value->AREA; ?></td>
                        <td class="sumTotal"><?= $value->CANTIDAD; ?></td>
                        <td><i class="fa fa-trash btn-delete" id="iconDelete" aria-hidden="true" title="Eliminar"></i></td>
                        <td><i class="fa fa-search" id="iconView" aria-hidden="true" title="Ver"></i></td>
                    </tr>
                    <?php
                    }
                    ?>

                </tbody>

            </table>
        </div>

</body> 

<script src="js/sidebar.js"></script>
      