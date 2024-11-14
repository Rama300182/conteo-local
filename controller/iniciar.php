
<?php

require_once '../Class/conexion.php';

$rubro = $_POST['rubro'];

var_dump($rubro);

  require_once '../Class/conexion.php';

    $cid = new Conexion();
    $cid_central = $cid->conectar();        

    $sql = "SELECT * FROM RO_RUBROS_TANGO_ACTIVOS WHERE RUBRO LIKE '$rubro'
    ";

    $stmt = sqlsrv_query( $cid_central, $sql );

echo $rubro;

?>
