
<?php
require_once '../Class/conteo.php';

$rubro = $_POST['rubro'];
$nroSucursal = $_POST['nroSucursal'];
$user = $_POST['user'];

$conteo = new Conteo();

// $result = $conteo->iniciarConteo($rubro, $nroSucursal, $user);

// foto 
$result = $conteo->fotoStock($rubro, $user);


// require_once '../Class/conexion.php';

// $rubro = $_POST['rubro'];


//   require_once '../Class/conexion.php';

//     $cid = new Conexion();
//     $cid_central = $cid->conectar('central');        

//     $sql = "SELECT * FROM RO_RUBROS_TANGO_ACTIVOS WHERE RUBRO LIKE '$rubro'
//     ";

//     $stmt = sqlsrv_query( $cid_central, $sql );

// echo $rubro;

?>
