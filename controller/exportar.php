<?php
require_once '../Class/conexion.php';

// Configuración de errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if (!isset($_GET['numsuc'])) {
    echo json_encode(["status" => "error", "message" => "No se proporcionó el número de sucursal."]);
    exit;
}

$numsuc = intval($_GET['numsuc']);

$conexion = new Conexion();
$cid = $conexion->conectar('central');

if ($cid === false) {
    echo json_encode(["status" => "error", "message" => "Error de conexión a la base de datos."]);
    exit;
}

// Verificar si es una solicitud de descarga o de verificación
if (!isset($_GET['download'])) {
    // Verificación de existencia de datos
    $sql = "
    SELECT COUNT(*) as count
    FROM SOF_INVENTARIO_FINAL_LOCAL
    WHERE SUCURSAL = ?
    ";

    $params = array($numsuc);
    $stmt = sqlsrv_query($cid, $sql, $params);

    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Error al ejecutar la consulta de verificación."]);
        exit;
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $count = $row['count'];

    if ($count == 0) {
        echo json_encode(["status" => "empty", "message" => "No hay datos para exportar en esta sucursal."]);
    } else {
        echo json_encode(["status" => "success", "message" => "Datos listos para exportar.", "count" => $count]);
    }
} else {
    // Exportación de datos
    $sql = "
    SET DATEFORMAT YMD
    SELECT 
        CONVERT(VARCHAR, FECHA, 120) AS FECHA,
        USUARIO,
        AREA,
        COD_ARTICU,
        CAST(CANT AS VARCHAR) AS CANT,
        CAST(SUCURSAL AS VARCHAR) AS SUCURSAL
    FROM SOF_INVENTARIO_FINAL_LOCAL
    WHERE SUCURSAL = ?
    ORDER BY FECHA
    ";

    $params = array($numsuc);
    $stmt = sqlsrv_query($cid, $sql, $params);

    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Error al ejecutar la consulta de exportación."]);
        exit;
    }

    $fechaHora = date("YmdHis");
    $nombreFecha = 'inventario_suc' . $numsuc . '_' . $fechaHora . '.csv';

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $nombreFecha . '"');

    $output = fopen('php://output', 'w');

    // Escribir la cabecera
    fputcsv($output, array('FECHA', 'USUARIO', 'AREA', 'COD_ARTICU', 'CANT', 'SUCURSAL'), ';');

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        fputcsv($output, $row, ';');
    }

    fclose($output);
    exit;
}

sqlsrv_close($cid);
?>