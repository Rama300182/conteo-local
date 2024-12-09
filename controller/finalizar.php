
<?php
require_once '../Class/conteo.php';

$nroConteo = $_POST['nroConteo'];

$conteo = new Conteo();

$result = $conteo->finalizarConteo($nroConteo);


?>
