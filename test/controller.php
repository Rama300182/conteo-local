<?php

 function retornarArray()
    {

        require_once '../Class/conexion.php';

        $cid = new Conexion();
        $cid_central = $cid->conectar();
        $sql = "SELECT top 20000 cod_Articu, DESCRIPCIO FROM SJ_VIEW_STA11 ";

        $stmt = sqlsrv_query($cid_central, $sql);

        $rows = array();

        while ($v = sqlsrv_fetch_array($stmt)) {
            $rows[] = array(
                'COD_ARTICU' => $v['cod_Articu'],
                'DESCRIPCIO' => $v['DESCRIPCIO'],
            );
        }

        return $rows;
    }


     echo json_encode(retornarArray());   
    // echo print_r(retornarArray());   

