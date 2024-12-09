<?php
include '../Class/conexion.php';

$conexion = new Conexion();

$cid = $conexion->conectar('central');

$cid2 = $conexion->conectar('localhost');


header('Content-Type: application/json');

function responder($status, $mensaje) {
    echo json_encode(['status' => $status, 'mensaje' => $mensaje]);
    exit;
}


$area = $_GET['area'];
$idEnc = $_GET['idEnc'];

try {

    $sql2 = "SELECT 1
    FROM RO_ENC_CONTEO_LOCAL
    WHERE id = '$idEnc'
    AND $area >= CAST(SUBSTRING(AREA, 1, CHARINDEX('-', AREA) - 1) AS INT)
    AND $area <= CAST(SUBSTRING(AREA, CHARINDEX('-', AREA) + 1, LEN(AREA)) AS INT)
    AND $area NOT IN (
        SELECT DISTINCT AREA
        FROM RO_DET_CONTEO_LOCAL
        WHERE ID_CONT = '$idEnc'
    );
    ";


    $stmt2 = sqlsrv_query($cid2, $sql2);

    if (sqlsrv_has_rows($stmt2)) {
        responder('success', 'Area disponible');
    } else {
        responder('error', 'Area no disponible para el encabezado.');
        die();
    }


} catch (\Throwable $th) {
    //throw $th;
    }

sqlsrv_close($cid);
?>