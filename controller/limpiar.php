<?php
require_once '../Class/conexion.php';
$cid = new Conexion();
$cid_central = $cid->conectar();

session_start();
if (!isset($_SESSION['username'])) {
	header("Location:../login.php");
} else {
	$_SESSION['area'] = $_GET['area'];
	$user = $_SESSION['username'];

	$sql =
		"DELETE FROM SOF_INVENTARIO WHERE USUARIO = '$user';";

	sqlsrv_query($cid_central, $sql);

	sqlsrv_close($cid_central);
}
?>
<script>
	setTimeout(function() {
		window.location.href = '../recoleccion.php';
	}, 1);
</script>