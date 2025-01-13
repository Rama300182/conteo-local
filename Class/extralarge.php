<?php

class Extralarge {

    function __construct(){

        require_once __DIR__.'/conexion.php';
        $this->conn = new Conexion;

        
    }

    
    public function login($user, $pass, $db = 'central'){

        $cid = $this->conn->conectar('central');

        $sql = "SELECT A.*, H.CONEXION_DNS, H.BASE_NOMBRE FROM SOF_USUARIOS A
        LEFT JOIN (select COD_CLIENT, CONEXION_DNS, BASE_NOMBRE FROM [LAKERBIS].locales_lakers.dbo.SUCURSALES_LAKERS WHERE NRO_SUC_MADRE is null)H        
        ON A.COD_CLIENT = H.COD_CLIENT
        WHERE A.NOMBRE = '$user' AND A.PASS = '$pass'";
  
        $stmt = sqlsrv_query($cid, $sql);

        $rows = array();

        while ($v = sqlsrv_fetch_array($stmt)) {
            $rows[] = $v;
        }

        return $rows;

    }
}