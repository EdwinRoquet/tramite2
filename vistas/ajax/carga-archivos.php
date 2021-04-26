<?php
	include_once '../../includes/solicitud.php';
	include_once '../../includes/solicitudanexo.php';
	require_once '../../vendor/autoload.php';

	/* Declaración e instancia de objetos */
	$Solicitud = new Solicitud();
	$mensaje = '';

	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_FILES['NomFilSol']['type'])){
	
		$directorio=$_SERVER['DOCUMENT_ROOT']."/tramite/vistas/upload/";

		if(!file_exists($directorio)){
			mkdir($directorio,0777,true);
		}
		
		/* Obtenemos el nombre del archivo */
		$nom_archivo  = $_FILES['NomFilSol']['name'];

		/* Generamos el nombre del archivo para el servidor */
		$nom_fil     = explode(".", $nom_archivo);
		$nom_fil_ser = "ANX_".date("Ymd")."_".date("His").".".end($nom_fil);

		/* Generamos la ruta para el servidor */
		$ruta_archivo = $_SERVER['DOCUMENT_ROOT'].'/tramite/vistas/upload/'.$nom_fil_ser;
		
		if (move_uploaded_file($_FILES['NomFilSol']['tmp_name'], $ruta_archivo)){

			// 0. Generar un numero de solicitud y enviarlo por correo
		 		$NumSol = $Solicitud->GeneraNumSol();
		 		
		 	// 1. Cambiar estado en 2 y situación  en 2
		 		if(isset($_POST["idSol"])){
		 			$id = $_POST["idSol"];
		 			$vNumSol = $NumSol["rNumSol"];
					
					$Solicitud->EnviaSolicitud($id,$vNumSol);

					// 2. Crear el registro del Anexo
					$SolicitudAnexo = new SolicitudAnexo();
					// ------------------------------------
					$idSolicitud 	= $id;
					$idTipo 		= '5'; 			// Copia de contrato de arbitraje
					$nomFileLoc 	= $nom_archivo;
					$nomFileSer 	= $nom_fil_ser; // $ruta_archivo;
					$flgEliminado 	= "N";

					$SolicitudAnexo->AgregarAnexo($idSolicitud,$idTipo,$nomFileLoc,$nomFileSer,$flgEliminado);

		 		}
		 	// 2. envia mensaje de confirmación	 		
		 		$mensaje = '<div class="alert alert-success" role="alert">
  							<i class="fa fa-upload"></i> Registro de la solicitud completado con éxito
  							<ul>
  								<li>El documento ha sido enviado.</li> 
  								<li>Se le envió un correo electrónico con el número de solicitud arbitral.</li> 
  							</ul>
		 				</div>';

		 	// 3. Enviar correo electronico ==============================
       		$nombre      		= $_POST["nombre"];
        	$destino     		= $_POST["email"];
        	$NumeroSolicitud    = $vNumSol;
        	$fechaActual        = date('d-m-Y');
        	$rutaSistema 		= "http://epsilon.pe/tramite/index.php";

        	$transport = (new Swift_SmtpTransport('mail.epsilon.pe', 465,'ssl'))
            ->setUsername('dmontenegro@epsilon.pe')
            ->setPassword(')84aqKv;MaE7');

            $mailer = new Swift_Mailer($transport);
            $html = '<p>¡Hola '. $nombre . '!</p>
            	     <p> Acabas de registrar una solicitud arbitral.</p>
                     <ul>
                       	<li> Nro. de solicitud  :'. $NumeroSolicitud .'</li>
                       	<li> Fecha del registro :'. $fechaActual .'</li>
                     </ul>
                     <p> Recuerda que puedes accedes a nuestra plataforma web a través del siguiente enlace: <a href="'.$rutaSistema.'">'. $rutaSistema.'</a></p>';

            // Creación de mensaje
            $message = (new Swift_Message('Registro de Solcitud Arbitral'))
            ->setFrom(['dmontenegro@epsilon.pe' => 'Sistema Electrónico Arbitral - SISTELAR'])
            ->setTo([$destino,$destino => 'Demandante'])
            ->setBody($html,'text/html');
            // Envio de mensaje
            $result = $mailer->send($message);

        /* ================================================================= */
	 	
		}else{
			$mensaje = 'Lo siento, tu archivo no fue subido';
		}
		echo $mensaje;
	}
 ?>