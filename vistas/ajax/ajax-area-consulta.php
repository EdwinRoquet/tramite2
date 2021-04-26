<?php 
	include_once '../../includes/area.php';

	$Area = new Area();
	
	$desarea = '%';

	if(isset($_POST)){
		$desarea = $_POST['desarea'];

		if($desarea == ''){
			$desarea = '%';
		}else{
			$desarea = '%'.$desarea.'%';
		}

	}
	$area = $Area->ListarAreaA($desarea);

	$arreglo = array();

	$item = 0;

	foreach ($area as $key => $value){

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