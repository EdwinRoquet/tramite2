<?php 
include_once '../../includes/solicitudtramite.php';

$solicitudtramite = new solicitudtramite();

/*----------------------------------------------------------- 
	LISTAR DE TRAMITE
  -----------------------------------------------------------*/
if($_POST['Operacion'] == 'ListarTramite'){

	$idsolicitud = $_POST['idsolicitud'];
	$html   	 = '';

	$listatramites = $solicitudtramite -> listartramite($idsolicitud);
	
	if(isset($listatramites) && count($listatramites) != 0){
		$html .= '<table class="table table-bordered">';
		$html .= '<tr>';
			$html .= '<th width="12%">Fecha</th>';
			$html .= '<th width="65%">Sumilla</th>';
			$html .= '<th width="15%">Referencia</th>';
			$html .= '<th width="8%">Adjunto</th>';
		$html .= '</tr>';

		foreach ($listatramites as $key => $value) {
			$html .= '<tr>
						<td class="align-middle">'.$value['fchcreacion'].'</td>
						<td class="align-middle">
							<strong>'.$value['destipsol'].'</strong>
							<p class="font-italic">Detalle : '.$value['detalle'].'</p>
						</td>
						<td class="align-middle">'.$value['referencia'].'</td>
						<td class="align-middle">
							<a href="upload/'.$value["nomfileser"].'" class="btn btn-primary" download>
								<i class="fa fa-download"></i>
							</a>
						</td>
					 </tr>';
		}
		$html .= '</table>';
	}else{
		$html = '<div class="alert alert-danger" role="alert">
  						<i class="fa fa-warning"></i> ¡No existen <strong>trámites</strong> registrados para esta solicitud!
				</div>';
	}

	echo $html;
}
/*----------------------------------------------------------- 
	GENERACION DE TRAMITE
  -----------------------------------------------------------*/
if($_POST['Operacion'] == 'GenerarTramite'){
	$respuesta = 0;
/* validamos formnulario */
	if(!empty($_POST)){
		/* captura de datos */
		$idsolicitud	= $_POST['idsolicitud'];
		$idsumilla		= $_POST['idsumilla'];
		$nomtramite		= $_POST['nomtramite'];
		$referencia		= $_POST['referencia'];
		$detalle		= $_POST['detalle'];
		$nomfileloc		= '';
		$nomfileser		= '';

		if(isset($_FILES['ArchivoAdjunto']['type'])){

			$directorio=$_SERVER['DOCUMENT_ROOT']."/tramite/vistas/upload/";
			if(!file_exists($directorio)){
				mkdir($directorio,0777,true);
			}
			/* Obtenemos el nombre del archivo */
			$nom_archivo  = $_FILES['ArchivoAdjunto']['name'];

			/* Generamos el nombre del archivo para el servidor */
			$nom_fil     = explode(".", $nom_archivo);
			$nom_fil_ser = "ANX_".date("Ymd")."_".date("His").".".end($nom_fil);

			/* Generamos la ruta para el servidor */
			$ruta_archivo = $_SERVER['DOCUMENT_ROOT'].'/tramite/vistas/upload/'.$nom_fil_ser;

			if (move_uploaded_file($_FILES['ArchivoAdjunto']['tmp_name'], $ruta_archivo)){
				$nomfileloc		= $nom_archivo;
				$nomfileser		= $nom_fil_ser;
			}

		}

		/* registro de tramite */
		$respuesta = $solicitudtramite -> registrartramite($idsolicitud,$idsumilla,$nomtramite,$referencia,$detalle,$nomfileloc,$nomfileser);

	}	
	/* retornamos respuesta de registro de tramite */
	echo $respuesta;
}


?>



