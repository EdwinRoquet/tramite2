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

	$Respuesta = '0';

	if(!empty($_POST)){
		
		$idSolicitud = $_POST['idSolicitud'];
		$idRuta = $_POST['idRuta'];	

		$Respuesta = $SolicitudRutas->AnularRuta($idSolicitud,$idRuta);

	}
	
	echo $Respuesta;

 ?>