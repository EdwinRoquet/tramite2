<?php 

	/* =============================
		IMPORTACION DE LIBRERIA
	===============================*/
	include_once '../../includes/solicitudrutas.php';
	$SolicitudRutas = new SolicitudRutas();

	/* =============================
	DECLARACION DE VARIABLES
	================================*/
	$arreglo = array();

	/* ===========================
	CAPTURA DE DATOS
	==============================*/

	if(!empty($_POST)){
		
		$idSolicitud = $_POST['idSolicitud'];
		$idRuta = $_POST['idRuta'];	

		$SolicitudRuta = $SolicitudRutas->EditarRuta($idSolicitud,$idRuta);

	}
	
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($SolicitudRuta);

 ?>