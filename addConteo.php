<?php

require_once 'Class/inventario.php';

$rubro = new inventario();
$todosLosRubros = $rubro->traerRubros();

?>

<style>
  select[multiple], select[size] {
    height: 20rem;
  }

  .small-input {
    max-width: 120px;
  }

  .form-inline {
    display: flex;
    flex-direction: row;
    align-items: center;
  }

  .form-inline .form-control {
    margin: 0 5px;
  }

</style>
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
            <div class="col-xl-12">
              <div class="well well-sm mt-4">
                <form class="form-horizontal" method="post" autocomplete="off" id="conteoForm" style="margin-left: 2rem;">
                  <fieldset>
                    <div class="form-group">
                    <div class="form-inline">
                      <label>Rubro: </label>
                      <div>
                        <select id="inputRubro" class="form-control form-control-sm" name="rubro" style="width: 400px;" multiple>
                          <option value="" selected disabled>SELECCIONAR RUBRO</option>
                          <?php
                          foreach($todosLosRubros as $key){
                              echo '<option value="' . htmlspecialchars($key['RUBRO']) . '">' . htmlspecialchars($key['RUBRO']) . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    </div>

                    <div class="form-group">
                      <div class="form-inline area">
                      <label>Areas: </label>
                        <input id="desdeArea" name="desdeArea" type="number" placeholder="Desde..." class="form-control form-control-sm small-input" required autocomplete="off">
                        <input id="hastaArea" name="hastaArea" type="number" placeholder="Hasta..." class="form-control form-control-sm small-input" required autocomplete="off">
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
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="bi bi-x-circle"></i> Cancelar</button>
        <button class="btn btn-success" type="button" onclick="iniciarConteo()"><i class="bi bi-check-circle"></i> Aceptar</button>
      </div>
    </div>
  </div>
</div>


