<?php 
require_once '../Class/conteo.php';

$conteo = new Conteo();

$nroSuc = $_POST['nroSuc'];

$result = $conteo->traerUltimo($nroSuc);

echo json_encode($result);




?>