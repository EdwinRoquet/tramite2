<?php 
/*  ==============================================
	IMPORTACION DE LIBRERIAS
    ==============================================*/
	include_once '../../includes/solicitudrutas.php';

/*  ==============================================
	DECLARACION E INSTANCIA DE OBJETOS
    ==============================================*/
	$SolicitudRuta = new SolicitudRutas();

/*  ==============================================
	DESARROLLO DE PROCESO
    ==============================================*/
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_FILES['NomArcReq_atencion']['type'])){
		
		$directorio=$_SERVER['DOCUMENT_ROOT']."/tramite/vistas/upload/";

		if(!file_exists($directorio)){
			mkdir($directorio,0777,true);
		}

		/* Obtenemos el nombre del archivo */
   		$nom_archivo  = $_FILES['NomArcReq_atencion']['name'];

		/* Generamos el nombre del archivo para el servidor */
   		$nom_fil     = explode(".", $nom_archivo);
   		$nom_fil_ser = "DOCINT_".date("Ymd")."_".date("His").".".end($nom_fil);

		/* Generamos la ruta para el servidor */
		$ruta_archivo = $_SERVER['DOCUMENT_ROOT'].'/tramite/vistas/upload/'.$nom_fil_ser;

		if (move_uploaded_file($_FILES['NomArcReq_atencion']['tmp_name'], $ruta_archivo))
		{

			$idSolicitud 	= $_POST['idSolicitud'];
			$idtipdoc 		= $_POST['idtipdoc'];
			$asunto 		= $_POST['asunto'];
			$referencia		= $_POST['referencia'];
			$contenido 		= $_POST['contenido'];
			$para 			= $_POST['para'];
			$idareaenvio 	= $_POST['idareaenvio'];
			$idareadestino 	= $_POST['idareadestino'];
			$nomFileLoc 	= $nom_archivo;
			$nomFileSer 	= $nom_fil_ser;
			$idUsuario 		= $_POST['idUsuario'];
	
			$resultado = '';
			$resultado = $SolicitudRuta->AgregarRuta($idSolicitud,$idtipdoc,$asunto,$referencia,$contenido,$para,$idareaenvio,$idareadestino,$nomFileLoc,$nomFileSer,$idUsuario);

			/* Retornamos el numero de documento interno */
			echo $resultado['rNumDicInt'];
		}
	}else{
		echo '0';
	}

?>