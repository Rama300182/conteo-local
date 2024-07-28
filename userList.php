<?php

include('header.php');
require 'Class/usuario.php';

$user = new Usuario();

?>

<body>

    <?php
        
        $todosLosUsuarios = $user->traerUsuarios();
        $i=1;
        ?>

        <h4>Lista de Usuarios</h4>

        <div class="table-responsive" id="tablePedidos" style="height: 72vh;">
            <table class="table table-hover table-bordered table-striped text-center" id="table">
                <thead class="thead-dark">
                    <th scope="col" style="width: 1%; text-align: center">N°</th>
                    <th scope="col" style="width: 3%; text-align: center">NOMBRE Y APELLIDO</th>
                    <th scope="col" style="width: 1%; text-align: center">USUARIO</th>
                    <th scope="col" style="width: 1%; text-align: center">CONTRASEÑA</th>
                    <th scope="col" style="width: 5%; text-align: center">ROL</th>
                    <th scope="col" style="width: 2%;"></th>
                    <!-- <th scope="col" style="width: 1%;"></th> -->
                </thead>

                <tbody id="table">
                    <?php
                    $todosLosUsuarios = json_decode($todosLosUsuarios);
                    foreach ($todosLosUsuarios as $valor => $value) {
                    ?>
                    <tr>
                        <th scope="row" style="text-align:center"><?= $i++ ?></th>
                        <td><input type="text" value=<?= $value->NOMBRE; ?> disabled style="border: none;"></td>
                        <td><input type="text" id="user" value=<?= $value->USUARIO; ?> disabled style="border: none;"></td>
                        <td><input type="text" value=<?= $value->PASS; ?> disabled style="border: none;"></td>
                        <td><input type="text" value=<?= $value->ROL; ?> disabled style="border: none;"></td>
                        <td>
                            <a class="click" value=<?= $value->USUARIO; ?> onclick="eliminarUsuario()"><i class="fa fa-user-times" id="userBtn" class="btn btn-sm btn-danger"></i></a>
			            </td>
                    </tr>
                    <?php
                    }
                    ?>

                </tbody>

            </table>
        </div>
</body>

    <script src="js/user.js"></script>
    <!-- Plugin to export Excel -->
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
