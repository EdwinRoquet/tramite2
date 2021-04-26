<?php 
	include_once '../../includes/tasa.php';

	$Tasa 	= new Tasa();

	$id_registro = $_POST['id_registro'];

	$tasa = $Tasa->EliminarTasa($id_registro);

	echo $tasa;
 ?>