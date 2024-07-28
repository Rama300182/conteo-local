
<?php

include('header.php');

?>

<div class="containerEditUser">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm mt-4">
                <form class="form-horizontal" method="post" autocomplete="off">
                    <fieldset>
                        <legend class="headerUser">Alta de Usuario</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user-circle-o bigicon"></i></span>
                            <div class="col-md-6">
                                <input id="fname" name="name" type="text" placeholder="Nombre y Apeliido" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-6">
                                <input id="lname" name="name" type="text" placeholder="Usuario" class="form-control" required autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-lock bigicon"></i></span>
                            <div class="col-md-6">
                                <input id="email" name="email" type="password" placeholder="Contraseña" class="form-control" required autocomplete="off">
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

                        <div class="form-row mt-3">
                            <div class="text-center">
                                <button class="btn btn-success" id="buttonSaveUser">Guardar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
  