
<?php
require_once '../Class/conteo.php';

$nroConteo = $_POST['nroConteo'];

$conteo = new Conteo();

$result = $conteo->checkCompletado($nroConteo);

if($result == true){
    $conteo->conteoCompletado($nroConteo);
    echo true;
    die();
}

echo false;


?>
