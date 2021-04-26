<?php 

include_once '../../includes/solicitud.php';

/*  ==============================================
	DECLARACION E INSTANCIA DE OBJETOS
    ==============================================*/

	$Solicitud = new Solicitud();

	$id    = $_POST['idSolicitud'];
	$idEst = $_POST['idEstado'];


	$resultado = $Solicitud->CambiarEstado($id,$idEst);

	/*
	if($resultado == '1'){

		$dataSolicitud =  $Solicitud->EditarSolicitud_v2($id);
		
		$destino    = $dataSolicitud['direma'];

   		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

		$contenido  = "<p> titulo.</p>
        			   <p> subtitulo </p>
        			   <p> contenido </p>";
        						       						 
        mail($destino,"subject", $contenido,$cabeceras);
	}
	*/
	echo $resultado;

?>