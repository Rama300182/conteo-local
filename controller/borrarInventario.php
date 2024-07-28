
<?php


require_once '../Class/conexion.php';
$cid = new Conexion();
$cid_central = $cid->conectar();

if(tablaVacia())
{
try {
  $sql = "DELETE FROM SOF_INVENTARIO_FINAL
    ";

  $stmt = sqlsrv_query($cid_central, $sql);
} catch (Exception $e) {
  echo 'Se produjo un Error:' . $e->getMessage();
}
}else
{
  echo "ERROR";
}

function tablaVacia()
{
  GLOBAL $cid,$cid_central;
  try {
     $query = "SELECT * FROM SOF_INVENTARIO_FINAL";

    $stmt = sqlsrv_query($cid_central, $query);

    if ($row = sqlsrv_fetch_array($stmt)) {
      return true;
    } else {
      return false;
    }
  } catch (Exception $e) {
    echo 'Se produjo un Error:' . $e->getMessage();
  }
}
