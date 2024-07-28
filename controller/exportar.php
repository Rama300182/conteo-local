<?php
$fechaHora = date("Y") .  date("m") .  date("d") . (date("H")-5) . date("i") . date("s");
$nombreFecha = 'inventario - '.$fechaHora.'.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='.$nombreFecha);

$output = fopen('php://output', 'w');

$dsn = '1 - CENTRAL';
$usuario = "Axoft";
$clave="Axoft";
/* $desde = $_GET['desde'].' 00:00:00.000';
$hasta = $_GET['hasta'].' 23:59:59.000'; */


$cid=odbc_connect($dsn, $usuario, $clave);

$sql=
	"
	SET DATEFORMAT YMD

	SELECT 'FECHA;USUARIO;AREA;COD_ARTICU;CANT'

	UNION ALL

	SELECT 
	CAST( CAST(FECHA AS DATE)AS VARCHAR) COLLATE Latin1_General_BIN +';'+
	CAST(USUARIO AS VARCHAR ) COLLATE Latin1_General_BIN+';'+
	CAST(AREA AS VARCHAR ) COLLATE Latin1_General_BIN+';'+
	CAST(COD_ARTICU AS VARCHAR) COLLATE Latin1_General_BIN+';'+ 
	CAST(CANT AS VARCHAR)  COLLATE Latin1_General_BIN
	FROM SOF_INVENTARIO_FINAL
	
	";
//WHERE FECHA BETWEEN '$desde' AND '$hasta'
ini_set('max_execution_time', 300);
$result=odbc_exec($cid,$sql)or die(exit("Error en odbc_exec"));

while($v=odbc_fetch_array($result))fputcsv($output, $v);



?>