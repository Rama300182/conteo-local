<?php 
require_once '../Class/conteo.php';

$conteo = new Conteo();

$nroSucursal = $_POST['nroSuc'];
$nroConteo = $_POST['nroConteo'];

$result = $conteo->traerComparativo($nroSucursal, $nroConteo);

echo json_encode($result);




?>