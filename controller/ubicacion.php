<?php
include '../Class/conexion.php';

$cid = new Conexion();
$cid = $cid->conectar();

header('Content-Type: application/json');

function responder($status, $mensaje) {
    echo json_encode(['status' => $status, 'mensaje' => $mensaje]);
    exit;
}

if (isset($_GET['area'])) {
    $area = $_GET['area'];

    try {
        $sql = "SELECT TOP 1 * FROM UBICACION WHERE Cod_Ubicacion = ?";
        $params = array($area);
        $stmt = sqlsrv_query($cid, $sql, $params);

        if ($stmt === false) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }

        if ($row = sqlsrv_fetch_array($stmt)) {
            responder('success', $row['Cod_Ubicacion']);
        } else {
            responder('error', 'Ubicación no encontrada');
        }
    } catch (Exception $e) {
        responder('error', 'Se produjo un Error: ' . $e->getMessage());
    }
} elseif (isset($_GET['ubicacion']) && isset($_GET['numsuc'])) {
    $ubicacion = $_GET['ubicacion'];
    $numsuc = intval($_GET['numsuc']); // Convertir a entero

    try {
        $sql = "SELECT TOP 1 * FROM SOF_INVENTARIO_FINAL_LOCAL WHERE AREA = ? AND SUCURSAL = ?";
        $params = array($ubicacion, $numsuc);
        $stmt = sqlsrv_query($cid, $sql, $params);

        if ($stmt === false) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }

        if ($row = sqlsrv_fetch_array($stmt)) {
            responder('error', 'Ya existe un conteo para esta ubicación');
        } else {
            responder('success', 'ok');
        }
    } catch (Exception $e) {
        responder('error', 'Se produjo un Error: ' . $e->getMessage());
    }
} else {
    responder('error', 'Parámetros incorrectos');
}

sqlsrv_close($cid);
?>