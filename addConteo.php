<?php

require_once 'Class/inventario.php';

$rubro = new inventario();
$todosLosRubros = $rubro->traerRubros();


?>


  <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

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
</head>

<body>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-latest.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <!-- Select2 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
                            <select id="inputRubro" class="form-control form-control-sm" name="rubro[]" style="width: 400px;" multiple>
                              <option selected></option>
                                  <?php
                                      foreach($todosLosRubros as $rubro => $key){
                                  ?>
                                    <option value="<?= $key['IDFOLDER'] ?>"><?= $key['RUBRO'] ?></option>
                                  <?php
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

                      <input type="hidden" id="numsuc2" name="numsuc" value="<?php echo $_SESSION['numsuc']; ?>">
                      <input type="hidden" id="dsn2" name="dsn" value="<?php echo $_SESSION['dsn']; ?>">
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
    $(document).ready(function() {
      $('#inputRubro').select2({
        placeholder: "Select options",
        allowClear: true
      });
    });

  function iniciarConteo() {
    let rubros = $('#inputRubro').val();
    let nroSucursal = $('#nroSucursal').text();
    let user = $('#user').text();
    rubros.forEach(element => {
      if(element == ''){
        rubros.splice(rubros.indexOf(element), 1);
      }
    });

    let rubrosString =  rubros.join(', ');

  Swal.fire({
    title: "Desea confirmar los datos?",
    text: "El conteo quedará iniciado!",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Confirmar",
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {
      // Captura el valor del rubro
      const rubro = $("#inputRubro").val();

      $.ajax({
        url: "controller/iniciar.php",
        method: "POST",
        data: {
          rubro: rubrosString,
          nroSucursal: nroSucursal,
          user: user
        },
        success: function (response) {
      
   
          if (response.trim() === 'Conteo iniciado') {
            Swal.fire({
              title: "Éxito",
              text: "El conteo ha sido iniciado.",
              icon: "success"
            }).then(() => {
              $('#modalAddConteo').modal('hide');
            });
          } else {
            Swal.fire({
              title: "Error",
              text: datos.message || "Hubo un problema al iniciar el conteo.",
              icon: "error"
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error('Error:', textStatus, errorThrown);
          Swal.fire({
            title: "Error",
            text: "Hubo un problema al iniciar el conteo.",
            icon: "error"
          });
        }
      });
    } else if (result.isDismissed) {
      // Limpiar los campos del formulario si el usuario cancela
      setTimeout(() => {
        $("#inputRubro").val(""); // Vaciar el campo de rubro
      }, 300);
    }
  });
}



  </script>
</body>
</html>



