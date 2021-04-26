<?php 
// 1. importar libreria
	include_once '../../includes/solicitudrespuesta.php';
	$solicitudrespuesta = new solicitudrespuesta();

	$idUsuario = $_POST['idUsuario'];
	
	$listasolicitudpendiente = $solicitudrespuesta->RespuestasPendientesPorUsuario($idUsuario);
	$item = 0;

	$arreglo = array();

	foreach ($listasolicitudpendiente as $key => $value) {
		$item ++;
		$value['row'] = $item;
		$arreglo["data"][] = $value;
	}

	if(count($arreglo) == 0){

		echo '{"data":[]}';

	}else{

		echo json_encode($arreglo);
	}	


 ?>