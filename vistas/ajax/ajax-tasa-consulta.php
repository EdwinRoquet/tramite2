<?php 
	include_once '../../includes/Tasa.php';

	$Tasa = new Tasa();
	
	$desTasa = '%';

	if(isset($_POST)){
		$tasa = $_POST['tasa'];

		if($desTasa == ''){
			$desTasa = '%';
		}else{
			$desTasa = '%'.$desTasa.'%';
		}

	}
	$tasa = $Tasa->ListarTasa($desTasa);

	$arreglo = array();

	$item = 0;

	foreach ($tasa as $key => $value){

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