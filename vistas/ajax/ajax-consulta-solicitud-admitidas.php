<?php 

	/* Librerias de Proyecto */
	include_once '../../includes/solicitud.php';

	$Solicitud = new Solicitud();

	$NumSolArb = '';
	$CodUsr	   = $_POST['idusuario'];
	$flgmsaprt = $_POST['flgmsaprt'];

	if(!empty($_POST)){
		
		$NumSolArb = $_POST['NumSolArb'];

	}else{
		
		$NumSolArb = '';

	}
		
	$MSolicitud = $Solicitud->ListarSolicitudAdmitidas($CodUsr,$NumSolArb,$flgmsaprt);
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