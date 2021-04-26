<?php 

	include_once '../../includes/docint.php';

	$docint = new DocInt();

	$nomdocint = '%';
	

	if(isset($_POST)){
		$nomdocint = $_POST['nomdocint'];
		

		if($nomdocint == ''){
			$nomdocint = '%';
		}else{
			$nomdocint = '%'.$nomdocint.'%';
		}

	}

	$Mdocint = $docint->listarDocumentosInternos($nomdocint);

	$arreglo = array();

	$item = 0;

	foreach ($Mdocint as $key => $value){
		$item ++;
		$arreglo["data"][] = $value;
	}

	if(count($arreglo) == 0){
		echo '{"data":[]}';
	}
	else{	
		echo json_encode($arreglo);
	}

 ?>