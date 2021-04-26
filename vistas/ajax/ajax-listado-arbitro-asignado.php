<?php 

	/* Librerias de Proyecto */
	include_once '../../includes/solicitud.php';

	$Solicitud = new Solicitud();

	$id_solicitud	   = $_POST['id_solicitud'];


	$MSolicitud = $Solicitud->listadoArbitrosAsignados($id_solicitud);
	$item = 0;

	$arreglo = array();

	foreach ($MSolicitud as $key => $value){
		$item ++;
		$value['row'] = $item;
		$arreglo["data"][] = $value;

	}
	
	if(count($arreglo) == 0){

		echo '{"data":[]}';

	}
	else{
		
		echo json_encode($arreglo);		
		
	}

 ?>