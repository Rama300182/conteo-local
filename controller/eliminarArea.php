
<?php


$area = $_POST['area'];
// var_dump($area);

  require_once '../Class/conexion.php';

    $cid = new Conexion();
    $cid_central = $cid->conectar();        

    $sql = "DELETE FROM SOF_INVENTARIO_FINAL WHERE AREA = '$area'
    ";

    $stmt = sqlsrv_query( $cid_central, $sql );

echo $area;

?>