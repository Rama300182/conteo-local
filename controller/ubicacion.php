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

   
    $sql2 = "WITH CheckAreaRange AS (
        SELECT 
            CASE 
                WHEN $area >= CAST(SUBSTRING(AREA, 1, CHARINDEX('-', AREA) - 1) AS INT)
                AND $area <= CAST(SUBSTRING(AREA, CHARINDEX('-', AREA) + 1, LEN(AREA)) AS INT)
                THEN 1
                ELSE 0
            END AS isInRange,
            AREA
        FROM RO_ENC_CONTEO_LOCAL
        WHERE id = '$idEnc'
    ),
    CheckAreaExclusion AS (
        SELECT 
            CASE 
                WHEN $area NOT IN (
                    SELECT DISTINCT AREA
                    FROM RO_DET_CONTEO_LOCAL
                    WHERE ID_CONT = '$idEnc'
                )
                THEN 1
                ELSE 0
            END AS isExcluded,
            AREA
        FROM RO_ENC_CONTEO_LOCAL
        WHERE id = '$idEnc'
    )
    SELECT 
        CASE
            WHEN isInRange = 0 THEN 'La ubicación no existe en el maestro'
            WHEN isExcluded = 0 THEN 'La ubicación ya fue escaneada'
            ELSE 'Área válida'
        END AS validationResult
    FROM CheckAreaRange
    JOIN CheckAreaExclusion
    ON CheckAreaRange.AREA = CheckAreaExclusion.AREA;
    ";



    $result = sqlsrv_query($cid2, $sql2);


    if ($result === false) {
        responder('error', 'Error en la consulta');
    }

    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

    $data = [];


    if($row['validationResult'] == 'Área válida') {
        $data['status'] = 'success';
        $data['mensaje'] = 'Área válida';
    } else {
        $data['status'] = 'error';
        $data['mensaje'] = $row['validationResult'];
    }

    echo json_encode($data);


} catch (\Throwable $th) {
    //throw $th;
    }

sqlsrv_close($cid);
?>