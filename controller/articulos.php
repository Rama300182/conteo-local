<?php

class Codigos
{
    public function traerArticulo($codigo){
        try {
            $servidor_central = 'servidor';
            $conexion_central = array( "Database"=>"LAKER_SA", "UID"=>"sa", "PWD"=>"Axoft1988", "CharacterSet" => "UTF-8");
            $cid_central = sqlsrv_connect($servidor_central, $conexion_central);
             
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        
        $sql = "SELECT COD_ARTICU, SINONIMO, DESCRIPCIO FROM STA11 
                WHERE (COD_ARTICU = '$codigo' OR SINONIMO = '$codigo')
                AND USA_ESC = 'S' AND COD_ARTICU LIKE '[XO]%' AND PERFIL != 'N'";
        
        $stmt = sqlsrv_query($cid_central, $sql);

        if($row = sqlsrv_fetch_array($stmt))
        {
            echo json_encode([
                'cod_articu' => $row['COD_ARTICU'],
                'descripcio' => $row['DESCRIPCIO']
            ]);
        } else {
            echo json_encode(['error' => 'No se encontró el artículo']);
        }
        sqlsrv_close($cid_central);
    }
}

if(isset($_GET['codigo']))
{
    $r = new Codigos();
    $r->traerArticulo($_GET['codigo']);
}