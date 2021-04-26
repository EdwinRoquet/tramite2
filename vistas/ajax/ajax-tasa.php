<?php 

	/* ====================
	EDITAR DATOS DE USUARIO
	=======================*/

	include_once '../../includes/tasa.php';

	$Tasa = new Tasa();

	$id_registro = $_POST['id_registro'];

	$DataTasa = $Tasa->EditarTasa($id_registro);

	echo json_encode($DataTasa);

 ?>