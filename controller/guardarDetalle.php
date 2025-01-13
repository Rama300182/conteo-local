
<?php
 require_once '../Class/conexion.php';
 $cid = new Conexion();
 $cid_central = $cid->conectar('localhost');  


$codigos = json_decode($_POST['codigos']);
$numSuc = $_POST['numSuc'];
$area = $_POST['area'];
$idEnc = $_POST['idEnc'];
$usuario = $_POST['usuario'];

$codigosParaSql = '';

foreach ($codigos as $codigo) {

    $codigosParaSql .= "('$idEnc','$usuario','$area','$codigo->codigo','$codigo->descripcion','$codigo->cantidad', GETDATE(), '$numSuc'),";

}
$codigosParaSql = substr($codigosParaSql, 0, -1);


$sql = "INSERT INTO RO_DET_CONTEO_LOCAL (ID_CONT, USUARIO, AREA, COD_ARTICU, DESCRIPCIO, CANT_CONTEO, FECHA_SCAN, NRO_SUCURS) VALUES $codigosParaSql";

$stmt=sqlsrv_query($cid_central, $sql);

if( $stmt === false ) {
    die( print_r( 'Error'.sqlsrv_errors() , true));
}else{
    echo true;
}


?>