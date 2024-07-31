<?php

class Inventario
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


    public function traerInventarioTotalArea()
    {

        $sql = "SELECT UPPER(AREA) AREA, SUM(CANT) CANTIDAD FROM SOF_INVENTARIO_FINAL GROUP BY AREA";

        $rows = $this->retornarArray($sql);
        
        $myJSON = json_encode($rows);

        return $myJSON;

    }

    public function traerInventarioTotalArticulo()
    {

        $sql = "SELECT A.COD_ARTICU ARTICULO, B.DESCRIPCIO,SUM(CANT) CANTIDAD FROM SOF_INVENTARIO_FINAL A
                INNER JOIN STA11 B ON A.COD_ARTICU = B.COD_ARTICU
                GROUP BY A.COD_ARTICU, DESCRIPCIO";

        $rows = $this->retornarArray($sql);
        
        $myJSON = json_encode($rows);

        return $myJSON;

    }

    public function traerInventarioDetallado()
    {

        $sql = "SELECT A.AREA, A.COD_ARTICU ARTICULO, B.DESCRIPCIO,CANT CANTIDAD FROM SOF_INVENTARIO_FINAL A
                INNER JOIN STA11 B ON A.COD_ARTICU = B.COD_ARTICU COLLATE Latin1_General_BIN";

        $rows = $this->retornarArray($sql);
        
        $myJSON = json_encode($rows);

        return $myJSON;

    }

    public function traerRubros()
    {

        $sql = "SELECT IDFOLDER, RUBRO FROM SOF_RUBROS_TANGO 
                WHERE IDFOLDER NOT IN ('3','15','31')
                GROUP BY IDFOLDER, RUBRO 
                ORDER BY 2";

        $rows = $this->retornarArray($sql);
        
        return $rows;

    }

}