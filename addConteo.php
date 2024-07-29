<?php

require_once 'Class/inventario.php';

$rubro = new inventario();
$todosLosRubros = $rubro->traerRubros();

?>
<!-- Modal -->
<div class="modal fade" id="modalAddConteo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Iniciar Conteo</h3>
      </div>
      <div class="modal-body">
        <div class="containerAddUser">
          <div class="row">
            <div class="col-xl-6">
              <div class="well well-sm mt-4">
                <form class="form-horizontal" method="post" autocomplete="off">
                  <fieldset>
                    <div class="form-group">
                      <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user-circle-o bigicon"></i></span>
                      <div class="col-md-6">
                        <input id="nombre" name="nombre" type="text" oninput="validarTextoEntrada(this, '[a-záéíóúñ ]')" placeholder="Nombre y Apellido" class="form-control soloText mayusc" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-unlock bigicon"></i></span>
                      <div class="col-md-6">
                        <select id="inputRubro" class="form-control form-control-sm" name="rubro">
                          <option value="" selected>Seleccionar Rubro</option>
                          <?php
                          foreach($todosLosRubros as $key){
                              echo '<option value="' . htmlspecialchars($key['RUBRO']) . '">' . htmlspecialchars($key['RUBRO']) . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <input type="hidden" id="numsuc" name="numsuc" value="<?php echo $_SESSION['numsuc']; ?>">
                    <input type="hidden" id="dsn" name="dsn" value="<?php echo $_SESSION['dsn']; ?>">
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-success" type="button" onclick="guardarAltaConteo()">Guardar</button>
      </div>
    </div>
  </div>
</div>
