<?php 
/*  ==============================================
	IMPORTACION DE LIBRERIAS
    ==============================================*/
	include_once '../../includes/solicitud.php';
	include_once '../../includes/solicitudobservacion.php';
	include_once '../../includes/user.php'; 
	include_once '../../includes/user_session.php';
	require_once '../../vendor/autoload.php';
 	
 	$userSession = new UserSession();

    $user = new User();
    $user->setUser($userSession->getCurrentUser());

    $mailUsuario = $user->getUserName();

/*  ==============================================
	DECLARACION E INSTANCIA DE OBJETOS
    ==============================================*/

	$Solicitud = new Solicitud();
	$solicitudobservacion = new SolicitudObservacion();
	
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
		$nom_fil_ser = "ANX_".date("Ymd")."_".date("His").".".end($nom_fil);

		/* Generamos la ruta para el servidor */
		$ruta_archivo = $_SERVER['DOCUMENT_ROOT'].'/tramite/vistas/upload/'.$nom_fil_ser;

		if (move_uploaded_file($_FILES['NomArcReq']['tmp_name'], $ruta_archivo)){

			$idSolicitud    = $_POST['idSolicitud'];
			$idEstado 		= $_POST['idEstado'];
			$desObservacion = $_POST['desObservacion'];
			$nomFileLoc		= $nom_archivo;
			$nomFileSer		= $nom_fil_ser;
			$idUsuario		= $_POST['idUsuario'];
			$idArea			= $_POST['idArea'];
			$desasunto		= $_POST['Asunto'];

			// cambiar estado
			$resultado = $Solicitud->CambiarEstado($idSolicitud,$idEstado);

			if($resultado == '1'){

				// Insertar observación
				$observacion = $solicitudobservacion->AgregarObservacion($idSolicitud,$idArea,$desasunto,$desObservacion,$nomFileLoc,$nomFileSer,$idUsuario);	

				/* Cambio : Envio de Correo
				   Fecha  : 21/07/2020 04:15
				   Autor  : David Montenegro
				   --------------------------------------------------------------------------------------------------------- */
				   	$data 		= $Solicitud->EditarSolicitud_v2($idSolicitud);
				  	$destino    = $data['direma'];
					$contenido  = '';
					$asunto     = '';

					if($idEstado == 3){

						$contenido  = "<p> Estimado usuario, le informamos que su trámite Nro. ".$data['NumSol']." ya fue admitido, 
										  para más información puede ingresar a su Mesa de Partes de Virtual y dirigirse a la opción 
										  Mis Mensajes - <a href='http://epsilon.pe/tramite'>Sistema Web</a></p>";

						$asunto    = 'Tramite Admitido';

					}else if($idEstado == 4){
						
						$contenido  = "<p> Estimado usuario, le informamos que su trámite Nro. ".$data['NumSol']." fue observado, 
									   para más información puede ingresar a su Mesa de Partes Virtual y dirigirse a la opción 
									   Mis Mensajes  -  <a href='http://epsilon.pe/tramite'>Sistema Web</a></p>";

						$asunto    = 'Tramite observado';
					}
					
		        	$transport = (new Swift_SmtpTransport('mail.epsilon.pe', 465,'ssl'))
		            ->setUsername('dmontenegro@epsilon.pe')
		            ->setPassword(')84aqKv;MaE7');

		            $mailer = new Swift_Mailer($transport);

		            if($idEstado == 3){
						$contenido  = "<p> Estimado usuario, le informamos que su trámite Nro. ".$data['NumSol']." ya fue admitido, 
										  para más información puede ingresar a su Mesa de Partes de Virtual y dirigirse a la opción 
										  Mis Mensajes - <a href='http://epsilon.pe/tramite'>Sistema Web</a></p>";

						$asunto    = 'Tramite Admitido';
		            }else{

		            	$contenido  = "<p> Estimado usuario, le informamos que su trámite Nro. ".$data['NumSol']." fue observado, 
									   para más información puede ingresar a su Mesa de Partes Virtual y dirigirse a la opción 
									   Mis Mensajes  -  <a href='http://epsilon.pe/tramite'>Sistema Web</a></p>";

						$asunto    = 'Tramite observado';

		            }

		            // Creación de mensaje
		            $message = (new Swift_Message($asunto))
		            ->setFrom(['dmontenegro@epsilon.pe' => 'Sistema Electrónico Arbitral - SISTELAR'])
		            ->setTo([$destino,$destino => 'Demandante'])
		            ->setBody($contenido,'text/html');
		            // Envio de mensaje
		            $result = $mailer->send($message);
				/* --------------------------------------------------------------------------------------------------------- */
			}
			echo $resultado;
		}
	}else{
		echo '0';
	}
 ?>