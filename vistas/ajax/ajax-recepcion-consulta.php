<?php 

	/* Librerias de Proyecto */
	include_once '../../includes/solicitud.php';

	/* Instanciamiento de clase*/
	$Solicitud = new Solicitud();

	/*Captura de datos*/
	$RazSoc = $_POST['RazSoc'];
	$NroSol = $_POST['NroSol'];
	$EstSol = $_POST['EstSol'];

	/*Ejecución de consulta*/
	$MSolicitud = $Solicitud->ListarSolicitudRecepcion($RazSoc,$NroSol,$EstSol);

	/*conversión a matriz*/
	$item = 0;
	$arreglo = array();
	foreach ($MSolicitud as $key => $value){
		$item ++;
		$value['row'] = $item;
		$arreglo["data"][] = $value;
	}

	/*retorno de resultados*/
	if(count($arreglo) == 0){
		echo '{"data":[]}';
	}
	else{
		echo json_encode($arreglo);
	}
 ?>



