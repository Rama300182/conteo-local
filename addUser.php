


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Alta de Usuario</h3>
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
                                    <input id="nombre" name="nombre" type="text" oninput="validarTextoEntrada(this, '[a-záéíóúñ ]')" placeholder="Nombre y Apeliido" class="form-control soloText mayusc" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <input id="user" name="user" type="text" oninput="validarTextoEntrada(this, '[a-záéíóúñ ]')" placeholder="Usuario" class="form-control soloText" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-lock bigicon"></i></span>
                                <div class="col-md-6">
                                    <input id="pass" name="pass" type="password" placeholder="Contraseña" class="form-control" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-unlock bigicon"></i></span>
                                <div class="col-md-6">
                                    <select id="rol" name="rol" type="text" placeholder="Rol" class="form-control mb-3" required>
                                        <option value="" selected disabled>Seleccione Rol...</option>
                                        <option value="6">Administrador</option>
                                        <option value="5">Operador</option>
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="message" name="message" style="display:none"></textarea>
                                </div>
                            </div>

                            <!-- <div class="form-row mt-3">
                                <div class="text-center">
                                    <button class="btn btn-success" type="button" id="buttonSaveUser" onclick="guardarUsuario()">Guardar</button>
                                </div>
                            </div> -->
                            <input type="hidden" id="numsuc" name="numsuc" value="<?php echo $_SESSION['numsuc']; ?>">
                            <input type="hidden" id="dsn" name="dsn" value="<?php echo $_SESSION['dsn']; ?>">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

      </div class="row">
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="bi bi-x-circle"></i> Cerrar</button>
        <button class="btn btn-success" type="button" onclick="guardarUsuario()"><i class="bi bi-floppy2-fill"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>

