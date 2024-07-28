
<?php


$user = $_POST['user'];
// var_dump($area);

  require_once '../Class/conexion.php';

    $cid = new Conexion();
    $cid_central = $cid->conectar();        

    $sql = "DELETE FROM SOF_USUARIOS WHERE NOMBRE = '$user'
    ";

    $stmt = sqlsrv_query( $cid_central, $sql );

echo $user;

?>