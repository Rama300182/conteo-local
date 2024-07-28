<?php

class Conexion226{
    private $servidor = 'servidortesting';
    private $database = 'UbicacionesStockMvc';
    private $user = 'sa';
    private $pass = 'Axoft1988';
    private $character = 'UTF-8';

    public function conectar(){
        try {
            $conexion_servidortesting = array( "Database"=>$this->database, "UID"=>$this->user, "PWD"=>$this->pass, "CharacterSet" => $this->character);
            $cid_central = sqlsrv_connect($this->servidor,  $conexion_servidortesting);
            return $cid_central;
             
         } catch (PDOException $e){
                 echo $e->getMessage();
         }
    }

}
