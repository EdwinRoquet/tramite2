<?php 
	include_once '../../includes/Tasa.php';

	$Tasa = new Tasa();
	
	
	$tasaTipoCambio = $Tasa->ListarTasaTipoCambio($_POST['tipo_calculo']);

	$arreglo = array();

	$item = 0;

	foreach ($tasaTipoCambio as $key => $value){

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