<?php 
	include_once '../../includes/solicitud.php';

	$Solicitud = new Solicitud();

	$id = $_POST['id'];

	$arbitro = $Solicitud->EliminarArbitroAsignado($id);
	echo $arbitro;
 ?>