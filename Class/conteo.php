<?php

class Conteo
{

    private function retornarArray($sqlEnviado)
    {

        require_once 'Conexion.php';

        $cid = new Conexion();
        $cid_central = $cid->conectar('central');
        $sql = $sqlEnviado;

        $stmt = sqlsrv_query($cid_central, $sql);

        $rows = array();

        while ($v = sqlsrv_fetch_array($stmt)) {
            $rows[] = $v;
        }


        return $rows;
    }


    public function iniciarConteo($rubro, $nroSucursal, $user, $areas)
    {
        require_once 'Conexion.php';
    
        $cid = new Conexion();
        $cid_central = $cid->conectar('localhost');
    
       
        $sql = "INSERT INTO RO_ENC_CONTEO_LOCAL (FECHA_INICIO, NRO_SUCURS, RUBRO, ESTADO, USUARIO_CONTROL, AREA) 
                VALUES (GETDATE(), ?, ?, '1', ?, ?);
                SELECT SCOPE_IDENTITY() AS InsertedID;";
    
       
        $params = [$nroSucursal, $rubro, $user, $areas];
        $stmt = sqlsrv_query($cid_central, $sql, $params);
    
        if ($stmt) {
        
            sqlsrv_next_result($stmt); 
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    
            if ($row && isset($row['InsertedID'])) {
                return $row['InsertedID'];
            } else {
                return false;
            }
        } else {
            return 'Error al iniciar conteo';
        }
    }
    
    public function fotoStock($rubro, $nroSucursal){

        require_once 'Conexion.php';

        $cid = new Conexion();
        $cid_central = $cid->conectar('');
        $sql = "SELECT A.COD_ARTICU, COD_DEPOSI, CAST(CANT_STOCK AS FLOAT) CANT_STOCK, B.IDFOLDER FROM STA19 A
        INNER JOIN STA11ITC B ON A.COD_ARTICU = B.CODEA 
        INNER JOIN (SELECT COD_SUCURS FROM STA22 WHERE COD_SUCURS LIKE '[0-9]%' AND INHABILITA = 0) C ON A.COD_DEPOSI = C.COD_SUCURS
        WHERE A.COD_ARTICU LIKE '[XO]%' AND CANT_STOCK <> 0 AND IDFOLDER NOT IN ('3','15','31')
        and IDFOLDER IN ($rubro)";
 

        $stmt = sqlsrv_query($cid_central, $sql);

        $rows = array();

        while ($v = sqlsrv_fetch_array($stmt)) {
            $rows[] = $v;
        }

        $valuesParaInsert = '';

        foreach ($rows as $row) {
            $valuesParaInsert .= "('$row[COD_ARTICU]', '$row[COD_DEPOSI]', '$row[CANT_STOCK]', '$row[IDFOLDER]', '$nroSucursal'),";
        }
        $cid_servidor = $cid->conectar('localhost');

        $valuesParaInsert = substr($valuesParaInsert, 0, -1);

        $sql = "INSERT INTO RO_STOCK_TEMPORAL (COD_ARTICU, COD_DEPOSI, CANT_STOCK, IDFOLDER, NRO_SUCURS) VALUES $valuesParaInsert";

        
        $stmt = sqlsrv_query($cid_servidor, $sql);

        if($stmt){
            return true;
        }else{
            return false;
        }

        

    }


    public function cargarArticulosPorRubroTemp($rubro, $nroSucursal){

        require_once 'Conexion.php';

        $cid = new Conexion();

        $cid_servidor = $cid->conectar('localhost');

        $sql = "INSERT INTO RO_MAESTRO_ART_TEMP (COD_ARTICU, SINONIMO, DESCRIPCIO, NRO_SUCURS)
        SELECT COD_ARTICU, SINONIMO, DESCRIPCIO, 1
        FROM [SERVIDOR].LAKER_SA.DBO.RO_ARTICULOS_CON_RUBRO_ACTIVOS
        WHERE IDFOLDER IN ($rubro)";
    
        $stmt = sqlsrv_query($cid_servidor, $sql);

        if($stmt){
            return true;
        }else{
            return false;
        }

        

    }

}