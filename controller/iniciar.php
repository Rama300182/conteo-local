
<?php
require_once '../Class/conteo.php';

$rubro = $_POST['rubro'];
$nroSucursal = $_POST['nroSucursal'];
$user = $_POST['user'];
$areas = $_POST['areas'];

$conteo = new Conteo();
$checkConteoIniciado = $conteo->checkConteoIniciado($nroSucursal);

if($checkConteoIniciado){
    echo false;
    die();
}

$result = $conteo->iniciarConteo($rubro, $nroSucursal, $user, $areas);
$conteo->fotoStock($rubro, $nroSucursal);
$conteo->cargarArticulosPorRubroTemp($rubro, $nroSucursal);


$_SESSION['nroConteo'] = $result;

echo $result;
?>
