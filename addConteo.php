<?php

require_once 'Class/inventario.php';

$rubro = new inventario();
$todosLosRubros = $rubro->traerRubros();

?>

<style>
select[multiple], select[size] {
    height: 20rem;
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
            <div class="col-xl-6">
              <div class="well well-sm mt-4">
                <form class="form-horizontal" method="post" autocomplete="off" id="conteoForm">
                  <fieldset>
                    <div class="form-group">
                      <span class="col-md-1 col-md-offset-2 text-center"><i class="bi bi-check2-circle bigicon"></i></span>
                      <div class="col-md-6">
                        <select id="inputRubro" class="form-control form-control-sm" name="rubro" multiple>
                          <option value="" selected disabled>SELECCIONAR RUBRO</option>
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
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="bi bi-x-circle"></i> Cancelar</button>
        <button class="btn btn-success" type="button" onclick="iniciarConteo()"><i class="bi bi-check-circle"></i> Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', (event) => {
    const inputRubro = document.querySelector('#inputRubro');
    
    if (inputRubro) {
        document.querySelectorAll('#inputRubro option')[0].setAttribute('disabled', 'disabled');

        inputRubro.addEventListener('change', function() {
            this.querySelectorAll('option').forEach(option => {
                if (option.selected && option.value === "") {
                    option.selected = false;
                }
            });
        });
    }
});

function iniciarConteo() {
    const selectedOptions = Array.from(document.querySelectorAll('#inputRubro option:checked'));
    const selectedValues = selectedOptions.map(option => option.value);
    
    if (selectedValues.length === 0) {
        alert('Por favor, selecciona al menos un rubro.');
        return;
    }

    console.log('Selected rubros:', selectedValues);

    const formData = new FormData(document.getElementById('conteoForm'));
    formData.append('selectedRubros', JSON.stringify(selectedValues));

    // Envía los datos al backend (ajusta la URL y el método según tus necesidades)
    fetch('controller/iniciar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        alert('Conteo iniciado correctamente');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al iniciar el conteo.');
    });
}
</script>

