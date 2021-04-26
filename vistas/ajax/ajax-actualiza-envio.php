<?php 

/*  ==============================================
		IMPORTACION DE LIBRERIA
	==============================================*/
	include_once '../../includes/solicitudrutas.php';
	$SolicitudRutas = new SolicitudRutas();

/*  ==============================================
	DECLARACION E INSTANCIA DE OBJETOS
    =============================================*/
	$SolicitudRuta = new SolicitudRutas();

/*  ==============================================
	DESARROLLO DE PROCESO
    ==============================================*/
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_FILES['NomArcReq']['type'])){
		
		$directorio=$_SERVER['DOCUMENT_ROOT']."/tramite/vistas/upload/";

		if(!file_exists($directorio)){
			mkdir($directorio,0777,true);
		}

		/* Obtenemos el nombre del archivo */
   		$nom_archivo  = $_FILES['NomArcReq']['name'];

		/* Generamos el nombre del archivo para el servidor */
   		$nom_fil     = explode(".", $nom_archivo);
   		$nom_fil_ser = "DOCINT_".date("Ymd")."_".date("His").".".end($nom_fil);

		/* Generamos la ruta para el servidor */
		$ruta_archivo = $_SERVER['DOCUMENT_ROOT'].'/tramite/vistas/upload/'.$nom_fil_ser;

		if (move_uploaded_file($_FILES['NomArcReq']['tmp_name'], $ruta_archivo))
		{
	
			$idSolicitud	= $_POST['idSolicitud'];
			$idruta			= $_POST['idRuta'];
			$asunto			= $_POST['asunto'];
			$referencia		= $_POST['referencia'];
			$contenido		= $_POST['contenido'];
			$para			= $_POST['para'];
			$nomFileLoc		= $nom_archivo;
			$nomFileSer		= $nom_fil_ser;
			$idUsuario		= $_POST['idUsuario'];
	
			$resultado = '';
			$resultado = $SolicitudRuta->ActualizarRuta($idSolicitud,$idruta,$asunto,$referencia,$contenido,$para,$nomFileLoc,$nomFileSer,$idUsuario);

			echo $resultado;
		}
	}else{
		echo '0';
	}
?>