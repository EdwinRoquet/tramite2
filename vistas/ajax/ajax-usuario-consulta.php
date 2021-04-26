<?php 

	include_once '../../includes/user.php';

	$user = new User();

	$nomusu = '%';
	$doiusr = '%';
	if(isset($_POST)){
		$nomusu = $_POST['nomusu'];
		$doiusr = $_POST['doiusr'];

		if($nomusu == ''){
			$nomusu = '%';
		}else{
			$nomusu = '%'.$nomusu.'%';
		}

		if($doiusr == ''){
			$doiusr = '%';
		}else{
			$doiusr = '%'.$doiusr.'%';
		}
	}

	$usuarios = $user->ListarUsuarios($nomusu,$doiusr);

	$arreglo = array();

	$item = 0;

	foreach ($usuarios as $key => $value){

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