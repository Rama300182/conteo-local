<?php
session_start();
require_once 'Class/extralarge.php';

$extraLarge = new Extralarge;

$usuario = $extraLarge->login($_POST['user'], $_POST['pass']);

if(count($usuario) > 0){
	foreach ($usuario as $key => $v) {

		

		setcookie("idioma","es",time()+60*60*24*3);
		$_SESSION['username'] = $v['NOMBRE'];
		$_SESSION['permisos'] = $v['PERMISOS'];
		$_SESSION['conexion_dns'] = $v['CONEXION_DNS'];
		$_SESSION['base_nombre'] = $v['BASE_NOMBRE'];
		$_SESSION['numsuc'] = $v['NRO_SUCURS'];
		$_SESSION['nombre'] = $v['DESCRIPCION'];
        $_SESSION['tipo'] = $v['TIPO'];
		$_SESSION['auditoria'] = 0;

		if ($_SESSION['permisos'] == 1 && $_SESSION['tipo'] == 'LOCAL_PROPIO') {
			header('Location: menu.php');
			exit();
		} else if ($_SESSION['permisos'] == 5) {
			header('Location: index.php');
			exit();
		} else {
			header('Location: index.php');
			exit();
		}
	}
} else {
	header("Location: login.php");
	exit();
}
?>
