<?php 
require_once '../Class/conteo.php';

$conteo = new Conteo();

$numSuc = $_POST['numSuc'];

$result = $conteo->traerMaestroArticulos($numSuc);

echo json_encode($result);




?>