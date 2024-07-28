<?php

include '../Class/conexion226.php';
include '../Class/conexion.php';

$cid_226 = new Conexion226();
$cid_226 = $cid_226->conectar();
$cid= new Conexion();
$cid=$cid->conectar();

if (isset($_GET['area'])) {

    $area = $_GET['area'];

    try {
        $sql = "
            select top 1 * from ubicacion where Cod_Ubicacion = '$area'
            ";
        $stmt = sqlsrv_query($cid_226, $sql);

        if ($row = sqlsrv_fetch_array($stmt)) {
            echo $row['Nombre_Ubicacion'];
        } else {
            echo 'Error';
        }
    } catch (Exception $e) {
        echo 'Se produjo un Error:' . $e->getMessage();
    }


    sqlsrv_close($cid_226);
}else
{
    if(isset($_GET['ubicacion']))
    {
        $ubicacion = $_GET['ubicacion'];

        try {
            $sql = "
                select top 1 * from sof_inventario_final where area = '$ubicacion'
                ";
            $stmt = sqlsrv_query($cid, $sql);
    
            if ($row = sqlsrv_fetch_array($stmt)) {
                // echo 'Error';
            } else {
                echo 'ok';
            }
        } catch (Exception $e) {
            echo 'Se produjo un Error:' . $e->getMessage();
        }
    
    
        sqlsrv_close($cid);
    }
}
