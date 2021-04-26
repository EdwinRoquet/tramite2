<?php 
	include_once '../../includes/habilitardesabilitar.php';

	$HabDes = new HabilitarDesabilitar();

	$tabla = $_POST['tabla'];
	$campo = $_POST['campo'];
	$valor = $_POST['valor'];
	$id = $_POST['id'];

	$proceso = $HabDes->ActualizarEstado($tabla,$campo,$valor,$id);

	echo $proceso;
 ?>