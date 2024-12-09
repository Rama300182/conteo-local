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
    
        $sqlCancelar = "UPDATE RO_ENC_CONTEO_LOCAL SET ESTADO = 5 WHERE NRO_SUCURS = $nroSucursal AND ESTADO != 4";

        $stmt = sqlsrv_query($cid_central, $sqlCancelar);

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
        $sql = "SELECT A.COD_ARTICU, COD_DEPOSI, CAST(CANT_STOCK AS FLOAT) CANT_STOCK, B.IDFOLDER, ST11.DESCRIPCIO FROM STA19 A
        INNER JOIN STA11ITC B ON A.COD_ARTICU = B.CODEA 
        INNER JOIN (SELECT COD_SUCURS FROM STA22 WHERE COD_SUCURS LIKE '[0-9]%' AND INHABILITA = 0) C ON A.COD_DEPOSI = C.COD_SUCURS
        LEFT JOIN STA11 ST11 ON ST11.COD_ARTICU = A.COD_ARTICU
        WHERE A.COD_ARTICU LIKE '[XO]%' AND CANT_STOCK <> 0 AND IDFOLDER NOT IN ('3','15','31')
        and IDFOLDER IN ($rubro)";
 

        $stmt = sqlsrv_query($cid_central, $sql);

        $rows = array();

        while ($v = sqlsrv_fetch_array($stmt)) {
            $rows[] = $v;
        }

        $valuesParaInsert = '';

        foreach ($rows as $row) {
            $valuesParaInsert .= "('$row[COD_ARTICU]', '$row[COD_DEPOSI]', '$row[CANT_STOCK]', '$row[IDFOLDER]', '$nroSucursal', '$row[DESCRIPCIO]'),";
        }
        
        $cid_servidor = $cid->conectar('localhost');
        
        $valuesParaInsert = substr($valuesParaInsert, 0, -1);
        
        $sqlLimpiarStock = "DELETE FROM RO_STOCK_TEMPORAL WHERE NRO_SUCURS = '$nroSucursal'";
        
        $stmtLimpiar = sqlsrv_query($cid_servidor ,$sqlLimpiarStock);
        
        $sql = "INSERT INTO RO_STOCK_TEMPORAL (COD_ARTICU, COD_DEPOSI, CANT_STOCK, IDFOLDER, NRO_SUCURS, DESCRIPCIO) VALUES $valuesParaInsert";
        
  
        
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

        $sqlLimpiar = "DELETE FROM RO_MAESTRO_ART_TEMP WHERE NRO_SUCURS = $nroSucursal";

        $stmt = sqlsrv_query($cid_servidor, $sqlLimpiar);

        $sqlInsert = "INSERT INTO RO_MAESTRO_ART_TEMP (COD_ARTICU, SINONIMO, DESCRIPCIO, NRO_SUCURS)
        SELECT COD_ARTICU, SINONIMO, DESCRIPCIO, $nroSucursal
        FROM [SERVIDOR].LAKER_SA.DBO.RO_ARTICULOS_CON_RUBRO_ACTIVOS
        WHERE IDFOLDER IN ($rubro)";
    
        $stmt = sqlsrv_query($cid_servidor, $sqlInsert);

        if($stmt){
            return true;
        }else{
            return false;
        }

        

    }

    public function estadoIniciado($idEnc) {

        require_once 'Conexion.php';

        $cid = new Conexion();

        $cid_servidor = $cid->conectar('localhost');

        $sql = "UPDATE RO_ENC_CONTEO_LOCAL SET ESTADO = 2 WHERE ID = '$idEnc' AND ESTADO != 2";

        $stmt = sqlsrv_query($cid_servidor, $sql);

        if($stmt){
            return true;
        }else{
            return false;
        }


    }


    public function finalizarConteo($idEnc) {

        require_once 'Conexion.php';

        $cid = new Conexion();

        $cid_servidor = $cid->conectar('localhost');

        $sql = "UPDATE RO_ENC_CONTEO_LOCAL SET ESTADO = 4, FECHA_FIN = GETDATE() WHERE ID = '$idEnc'";

        $stmt = sqlsrv_query($cid_servidor, $sql);

        if($stmt){
            return true;
        }else{
            return false;
        }

    }


    public function checkCompletado($idEnc) {
        require_once 'Conexion.php';
    
        $cid = new Conexion();
        $cid_servidor = $cid->conectar('localhost');
    
        $sql = "
            WITH Ranges AS (
                SELECT 
                    CAST(SUBSTRING(AREA, 1, CHARINDEX('-', AREA) - 1) AS INT) AS StartRange,
                    CAST(SUBSTRING(AREA, CHARINDEX('-', AREA) + 1, LEN(AREA)) AS INT) AS EndRange
                FROM RO_ENC_CONTEO_LOCAL
                WHERE ID = ?
            ),
            GeneratedAreas AS (
                SELECT 
                    r.StartRange + v.Number AS Area
                FROM Ranges r
                CROSS APPLY ( 
                    SELECT TOP (r.EndRange - r.StartRange + 1) ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) - 1 AS Number 
                    FROM master.dbo.spt_values
                ) v
            ),
            MissingCount AS (
                SELECT 
                    COUNT(*) AS MissingCount
                FROM GeneratedAreas ga
                LEFT JOIN RO_det_CONTEO_LOCAL dc 
                    ON ga.Area = dc.AREA AND dc.ID_CONT = ?
                WHERE dc.AREA IS NULL
            )
            SELECT 
                CASE 
                    WHEN MissingCount = 0 THEN 1
                    ELSE 0
                END AS AllAreasCovered
            FROM MissingCount;
        ";
    
        $stmt = sqlsrv_prepare($cid_servidor, $sql, [$idEnc, $idEnc]);
    
        if (!$stmt) {
            return false;
        }
    

        if (sqlsrv_execute($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if ($row && $row['AllAreasCovered'] == 1) {
                return true; 
            }
        }
    
        return false; 
    }


    public function conteoCompletado($idEnc) {

        require_once 'Conexion.php';

        $cid = new Conexion();

        $cid_servidor = $cid->conectar('localhost');

        $sql = "UPDATE RO_ENC_CONTEO_LOCAL SET ESTADO = 3 WHERE ID = '$idEnc'";

        $stmt = sqlsrv_query($cid_servidor, $sql);

        if($stmt){
            return true;
        }else{
            return false;
        }

    }


    public function traerUltimo($nroSuc){

        require_once 'Conexion.php';

        $cid = new Conexion();

        $cid_servidor = $cid->conectar('localhost');

        $sql="SELECT FECHA_SCAN, COD_ARTICU, DESCRIPCIO, CANT_CONTEO FROM RO_DET_CONTEO_LOCAL 
        WHERE ID_CONT = (select MAX(ID) from RO_ENC_CONTEO_LOCAL WHERE NRO_SUCURS = $nroSuc AND ESTADO = 4)";

        $stmt = sqlsrv_query($cid_servidor, $sql);

        $rows = [];
        while ($v = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $v;
        }
        
        return $rows;
        
    }


    public function traerComparativo($nroSucursal, $nroConteo){

        
        require_once 'Conexion.php';

        $cid = new Conexion();

        $cid_servidor = $cid->conectar('localhost');


        $sql = "SELECT 
            det.FECHA_SCAN,
            det.COD_ARTICU,
            det.DESCRIPCIO,
            (SELECT RUBRO FROM RO_ENC_CONTEO_LOCAL WHERE ID = det.ID_CONT) AS RUBRO,  
            COALESCE(stk.CANT_STOCK, 0) AS CANTIDAD_SISTEMA, 
            COALESCE(det.CANT_CONTEO, 0) AS CANTIDAD_FISICA, 
            (COALESCE(det.CANT_CONTEO, 0) - COALESCE(stk.CANT_STOCK, 0)) AS DIFERENCIA 
        FROM 
            RO_DET_CONTEO_LOCAL det
        LEFT JOIN 
            RO_STOCK_TEMPORAL stk
            ON det.COD_ARTICU = stk.COD_ARTICU 
            AND stk.NRO_SUCURS = $nroSucursal
        WHERE 
            det.ID_CONT = $nroConteo
            AND (det.CANT_CONTEO != COALESCE(stk.CANT_STOCK, 0) OR stk.CANT_STOCK IS NULL)

        UNION ALL
        SELECT 
            NULL AS FECHA_SCAN,  
            stk.COD_ARTICU,
            stk.DESCRIPCIO collate SQL_Latin1_General_CP1_CI_AS
            (SELECT RUBRO FROM RO_ENC_CONTEO_LOCAL WHERE ID = 13) AS RUBRO, 
            COALESCE(stk.CANT_STOCK, 0) AS CANTIDAD_SISTEMA,  
            0 AS CANTIDAD_FISICA, 
            COALESCE(stk.CANT_STOCK, 0) AS DIFERENCIA 
        FROM 
            RO_STOCK_TEMPORAL stk
        LEFT JOIN 
            RO_DET_CONTEO_LOCAL det
            ON det.COD_ARTICU = stk.COD_ARTICU
            AND det.ID_CONT = $nroConteo
        WHERE 
            stk.NRO_SUCURS = $nroSucursal
            AND det.COD_ARTICU IS NULL
        ORDER BY 
            COD_ARTICU;";

        
                
        $stmt = sqlsrv_query($cid_servidor, $sql);

        $rows = [];
        while ($v = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $v;
        }

        return $rows;
        
    } 
    
    public function traerMaestroArticulos($nroSuc){

             
        require_once 'Conexion.php';

        $cid = new Conexion();

        $cid_servidor = $cid->conectar('localhost');

        $sql = "SELECT * FROM RO_MAESTRO_ART_TEMP WHERE NRO_SUCURS = $nroSuc";

        $stmt = sqlsrv_query($cid_servidor, $sql);

        $rows = [];
        while ($v = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $v;
        }

        return $rows;


    }

}