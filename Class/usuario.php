<?php

class Usuario
{

    private function retornarArray($sqlEnviado)
    {

        require_once 'Conexion.php';

        $cid = new Conexion();
        $cid_central = $cid->conectar();
        $sql = $sqlEnviado;

        $stmt = sqlsrv_query($cid_central, $sql);

        $rows = array();

        while ($v = sqlsrv_fetch_array($stmt)) {
            $rows[] = $v;
        }

        return $rows;
    }


    public function traerUsuarios()
    {

        $sql = "SELECT DESCRIPCION NOMBRE, NOMBRE USUARIO, PASS, 
                CASE WHEN PERMISOS = '5' THEN 'OPERADOR' WHEN PERMISOS = '6' THEN 'ADMINISTRADOR' ELSE 'DESCONOCIDO' END ROL 
                FROM SOF_USUARIOS WHERE TIPO = 'LOGISTICA'";

        $rows = $this->retornarArray($sql);
        
        $myJSON = json_encode($rows);

        return $myJSON;

    }

}