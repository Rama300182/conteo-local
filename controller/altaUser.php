<?php

require_once '../Class/conexion.php';
$cid = new Conexion();
$cid_central = $cid->conectar();

$nombre = $_POST['nombre'];
$user= $_POST['user'];
$pass = $_POST['pass'];
$rol = $_POST['rol'];
$dsn = $_POST['dsn'];
$numsuc = $_POST['numsuc'];

$sql = "INSERT INTO SOF_USUARIOS (NOMBRE, PASS, PERMISOS, DSN, DESCRIPCION, COD_CLIENT, NRO_SUCURS, COD_VENDED, TANGO, COD_DEPOSI, TIPO, IS_OUTLET)
        VALUES ('$user','$pass',$rol, '$dsn', '$nombre', '', '$numsuc', '0', 'NO', '00', 'LOCAL_PROPIO', 0)

    ";
    $stmt = sqlsrv_query( $cid_central, $sql );