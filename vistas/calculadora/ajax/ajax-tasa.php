<?php 
	include_once '../includes/tasa.php';

	// $Tasa = new Tasa();	
	// $tasa = $Tasa->ListarTasa();
	// $arreglo = array();
	// $item = 0;

	// foreach ($tasa as $key => $value){

	// 	$item ++;
	// 	$value['row'] = $item;
        
	// 	$arreglo["data"][] = $value;
		
	// }

	// if(count($arreglo) == 0){
	// 	echo '{"data":[]}';
	// }
	// else{	
	// 	echo json_encode($arreglo);
	// }

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