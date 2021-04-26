<?php 
include_once '../../includes/solicitudanexo.php';

if(isset($_POST['idSolicitud'])){

	$idSol = $_POST['idSolicitud'];
	$idAnx = $_POST['idAnexo'];

	$SolicitudAnexo = new SolicitudAnexo();
	$SolicitudAnexo->EliminarAnexo($idSol,$idAnx);

	echo 'Solicitud : '.$idSol.' Anexo : '. $idAnx.' eliminado';

}
	
 ?>