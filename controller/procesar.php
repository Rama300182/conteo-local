<?php

require_once '../Class/conexion.php';
$cid = new Conexion();
$cid_central = $cid->conectar('central');

if (isset($_GET['codigos'])) {

  $codigos = json_decode($_GET['codigos']);

  $dia = date('Y-m') . '-' . strright(('0' . (date('d'))), 2);
  $hora = (date('G') - 5) . ':' . date('i:s');
  $fechaHora = $dia . ' ' . $hora . ':000';
/* var_dump($codigos); */
  $fechaHora = str_replace("-","",$fechaHora);
  $numsuc = $_GET['numsuc'];
  foreach ($codigos as $codigo) {

    $cod = $codigo->codigo;
    $user = $codigo->usuario; //este valor falta obtener en el front
    $ubicacion=$codigo->ubicacion;
    $cant=intval($codigo->cantidad);
    try {
      $sql = "
      SET DATEFORMAT YMD
      INSERT INTO SOF_INVENTARIO_FINAL_LOCAL (FECHA, USUARIO, AREA, COD_ARTICU, CANT, SUCURSAL) 
      VALUES ('$fechaHora', '$user', '$ubicacion', '$cod', $cant,'$numsuc')
      ";
      $stmt=sqlsrv_query($cid_central, $sql);
            if( $stmt === false ) {
                die( print_r( sqlsrv_errors() , true));
           }
    } catch (Exception $e) {
      echo 'Se produjo un Error:' . $e->getMessage();
    }
  }

  sqlsrv_close($cid_central);
}

if(isset($_GET['area']))
{
  $area=$_GET['area'];
  
  try {
    $sql="select * from SOF_INVENTARIO_FINAL_LOCAL where AREA ='$area' ";
    $stmt = sqlsrv_query($cid_central, $sql);

    if ($row = sqlsrv_fetch_array($stmt)) {
        echo 'Encontrado';
    } else {
        echo 'Error';
    }
} catch (Exception $e) {
    echo 'Se produjo un Error:' . $e->getMessage();
}
}

function strright($rightstring, $length)
{
  return (substr($rightstring, -$length));
}

?>
