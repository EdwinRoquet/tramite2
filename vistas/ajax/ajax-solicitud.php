<?php 
	include_once '../../includes/solicitudpretension.php';
	include_once '../../includes/solicitudrespuesta.php';
	include_once '../../includes/solicitudanexo.php';
	include_once '../../includes/solicitud.php';
	include_once '../../includes/user.php';
	require_once '../../vendor/autoload.php';

	$Solicitudpretension = new SolicitudPretension();
	$solicitudrespuesta = new solicitudrespuesta();
	$SolicitudAnexo  = new SolicitudAnexo();
	$solicitud = new solicitud();
	$user = new User();

	/* ==========================================================================================================================
	GENERAR SOLICITUD DE ARBITRAJE MANUAL 
	=============================================================================================================================*/
	if($_POST['Operacion']== 'GenerarSolManual'){
		// 1. Obtener datos
		/* ---------------------------------------------------------------------------------------- */
		$idUsuario	 = $_POST['idUsuario'];
		$RazSocDem	 = $_POST['RazSocDem'];
		$TipDocDem	 = $_POST['TipDocDem'];
		$NumDocDem   = $_POST['txtNumDocDem'];
		$RazSocDmd	 = $_POST['RazSocDmd'];
		$TipDocDmd	 = $_POST['TipDocDmd'];
		$NumDocDmd	 = $_POST['txtNumDocDmd'];
		$DirEmaDmd	 = $_POST['DirEmaDmd'];
		$idtipsol	 = 1; // inicializar "Solicitud de Arbitraje"
		$idSit		 = 2; // inicializar "Enviado"
		$idEst		 = 2; // inicializar "Recibido"
		$nomfileloc	 = '';
		$nomfileser	 = '';
		$mailUsuario = $_POST['mailUsuario'];

		/* 2. Cargar archivo Adjunto */
		/* ---------------------------------------------------------------------------------------- */
		if(isset($_FILES['NomFilSolMan']['type'])){

			$directorio=$_SERVER['DOCUMENT_ROOT']."/tramite/vistas/upload/";
			if(!file_exists($directorio)){
				mkdir($directorio,0777,true);
			}
			/* Obtenemos el nombre del archivo */
			$nom_archivo  = $_FILES['NomFilSolMan']['name'];

			/* Generamos el nombre del archivo para el servidor */
			$nom_fil     = explode(".", $nom_archivo);
			$nom_fil_ser = "ANX_".date("Ymd")."_".date("His").".".end($nom_fil);

			/* Generamos la ruta para el servidor */
			$ruta_archivo = $_SERVER['DOCUMENT_ROOT'].'/tramite/vistas/upload/'.$nom_fil_ser;

			if (move_uploaded_file($_FILES['NomFilSolMan']['tmp_name'], $ruta_archivo)){
				$nomfileloc		= $nom_archivo;
				$nomfileser		= $nom_fil_ser;
			}
		}

		/* 3. Registro de Solicitud y anexo */
		/* ---------------------------------------------------------------------------------------- */
		$respuesta = $solicitud->SolicitudArbitralManual($idUsuario,$RazSocDem,$TipDocDem,$NumDocDem,$RazSocDmd,$TipDocDmd,$NumDocDmd,$DirEmaDmd,$idtipsol,$idSit,$idEst,$nomfileloc,$nomfileser);

		/* 4. Envio de notificacion a demandante*/
		/* ---------------------------------------------------------------------------------------- */
		if(isset($respuesta['pnumsol'])){
			
	       	$NumeroSolicitud    = $respuesta['pnumsol'];
	       	$fechaActual        = date('d-m-Y');
	       	$rutaSistema 		= "http://epsilon.pe/tramite/index.php";
	       	
	       	$transport = (new Swift_SmtpTransport('mail.epsilon.pe', 465,'ssl'))
            ->setUsername('dmontenegro@epsilon.pe')
            ->setPassword(')84aqKv;MaE7');

            $mailer = new Swift_Mailer($transport);
            $html = "<p>¡Hola " . $RazSocDem . "!"."</p>
       	            <p> Acabas de registrar una solicitud arbitral.</p>
                   	<ul>
                       	<li> Nro. de solicitud  :". $NumeroSolicitud ."</li>
                       	<li> Fecha del registro :". $fechaActual ."</li>
                   	</ul>
                   	<p> Recuerda que puedes accedes a nuestra plataforma web a través del siguiente enlace: <a href='".$rutaSistema."'>" . $rutaSistema."</a></p>";

            // Creación de mensaje
            $message = (new Swift_Message('Registro de Solicitud Arbitral - Manual'))
            ->setFrom(['dmontenegro@epsilon.pe' => 'Sistema Electrónico Arbitral - SISTELAR'])
            ->setTo([$mailUsuario,$mailUsuario => 'Demandante'])
            ->setBody($html,'text/html');
            
            // Envio de mensaje
            $result = $mailer->send($message);
		}
		echo $respuesta['pnumsol'];

		}
	
	/* ==========================================================================================================================
	NOTIFICAR A DEMANDANTE POR CORREO PARA INGRESA RESPUESTA
	============================================================================================================================*/
	if($_POST['Operacion'] == 'NotificarDemandante'){

		/* 1. Capturar variables */
		$idSolicitud   = $_POST['idSolicitud'];
		$idUsrCreacion = $_POST['idUsuario'];

		/* 2. Actualizar estado */
		$respuesta = $solicitud->ActualizaNotificacion($idSolicitud);
		
		/* 3. Crear usuario */
		$nuevoUsuario = false;
		$idUsuario    = '';

		if ($respuesta = '1'){
			
			$dataSolicitud 		= $solicitud->EditarSolicitud_v2($idSolicitud);
			$notificar_usuario 	= '';
			$notificar_clave   	= '';

			if($user->mailExists($dataSolicitud['DirEmaDmd'])){
				/* DEVOLVER DATOS */
				$dataUsuario = $user->DatosUsuario($dataSolicitud['DirEmaDmd']);

				$notificar_usuario = $dataUsuario['direma'];
				$notificar_clave   = $dataUsuario['passwd'];
				$idUsuario         = $dataUsuario['id'];

			}else{
				/* CREAR USUARIO */
				$nuevoUsuario = true;
				$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
				$psw = '';
	        	for($i=0; $i<6 ; $i++) {
	            	$psw .= substr($cadena,rand(0,62),1);
	        	}

				$tipdoc 	= $dataSolicitud['TipDocDmd'];
				$nrodoc 	= $dataSolicitud['NumDocDmd'];
				$nomraz 	= $dataSolicitud['RazSocDmd'];
				$direma 	= $dataSolicitud['DirEmaDmd'];
				$numtel 	= $dataSolicitud['NumTelDmd'];
				$passwd 	= $psw;
				$idUsuario  = $user->newUser($tipdoc,$nrodoc,$nomraz,$direma,$numtel,$passwd);

				$notificar_usuario = $direma;
				$notificar_clave   = $passwd;
			}

			/* 4. Crear registro de respuesta*/
			$cadena 	= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			$ClaSegTok 	= '';

	        for($i=0; $i<10 ; $i++) {
	           	$ClaSegTok .= substr($cadena,rand(0,62),1);
	        }

	        /* Evaluar que datos seras pregrabados en la respuesta */
	        /* -----------------------------------------------------------------------------------------*/
	        $UsrDmd 		= $idUsuario;
	        $RazSocDmd 		= $dataSolicitud['RazSocDmd'];
	        $TipDocDmd 		= $dataSolicitud['TipDocDmd'];
	        $NumDocDmd 		= $dataSolicitud['NumDocDmd'];
	        $DirEmaDmd		= $dataSolicitud['DirEmaDmd'];
	        $ClaSegTok		= $ClaSegTok;
	        $usrcreacion 	= $idUsrCreacion;
			$NuevaRespuesta = $solicitudrespuesta->GenerarNuevaRespuesta($idSolicitud,$UsrDmd,$RazSocDmd,$TipDocDmd,$NumDocDmd,$DirEmaDmd,$ClaSegTok,$usrcreacion);

			/* 5. Notificar por correo datos de usuario y link de acceso */
			$NumeroSolicitud    = $dataSolicitud['NumSol'];
	    //  $NumeroSolicitud    = $respuesta['pnumsol'];
	       	$fechaActual        = date('d-m-Y');
	       	$rutaSistema 		= "http://epsilon.pe/tramite/index.php";
	       	
	       	$transport = (new Swift_SmtpTransport('mail.epsilon.pe', 465,'ssl'))
            ->setUsername('dmontenegro@epsilon.pe')
            ->setPassword(')84aqKv;MaE7');

            $mailer = new Swift_Mailer($transport);
            $html   = "<p>¡Hola " . $dataSolicitud['RazSocDmd'] . "!"."</p>
	           	            	    <p> Se acaba de registrar una solicitud arbitral.</p>
	                       		    <ul>
	                           			<li> Nro. de solicitud  :". $NumeroSolicitud ."</li>
	                           			<li> Fecha del registro :". $fechaActual ."</li>
	                       		    </ul>
	                       		    <p> Agradeceremos indicar las respuesta a esta demanda ingresando a: 
	                       		    	<a href='".$rutaSistema."'>" . $rutaSistema."</a>
	                       		    </p>
	                       		    <p> Opción de menú <strong>MENU DEMANDADO</strong> > Procesos en Demanda.</p>";
	        if ($nuevoUsuario){
				$html .= '<p>Hemos creado para ti las credenciales a usar:</p>';
	        }else{
				$html .= '<p>Te recordamos las credenciales a usar:</p>';
	        }

	        $html .= '<ul>
						<li>Usuario  : '.$notificar_usuario.'</li>
						<li>Password : '.$notificar_clave.'</li>
						<li>Clave Token : '.$ClaSegTok.'</li>
					</ul>';

            // Creación de mensaje
            $message = (new Swift_Message('Notificación de Respuesta'))
            ->setFrom(['dmontenegro@epsilon.pe' => 'Sistema Electrónico Arbitral - SISTELAR'])
            ->setTo([$dataSolicitud['DirEmaDmd'],$dataSolicitud['DirEmaDmd'] => 'Demandante'])
            ->setBody($html,'text/html');
            
            // Envio de mensaje
            $result = $mailer->send($message);


		}else{
			echo '0';
		}

	}
	/* ==========================================================================================================================
	REGISTRAR RESPUESTA DE SOLICITUD
	============================================================================================================================*/
	if($_POST['Operacion']== 'GenerarRespuesta'){

		$idRespuesta = $_POST['idRespuesta'];

		/* PESTAÑA : DEMANDADO */
		$DesDirDmd = $_POST['DesDirDmd'];
		$ValSegTok = $_POST['ValSegTok'];
		$NomRepLeg = $_POST['NomRepLeg'];
		$TipDocRep = $_POST['TipDocRep'];
		$NumDocRep = $_POST['txtNumDocRep'];
		$NumTelRep = $_POST['NumTelRep'];
		$NumCelRep = $_POST['NumCelRep'];
		$DirEmaRep = $_POST['DirEmaRep'];
		/* PESTAÑA : DESIGNACION DE ARBITRO */
		$ApeNomArb = $_POST['ApeNomArb'];
		$DesDirArb = $_POST['DesDirArb'];
		$NumTelArb = $_POST['NumTelArb'];
		$DirEmaArb = $_POST['DirEmaArb'];
		$NomProArb = $_POST['NomProArb'];
		$NumColArb = $_POST['NumColArb'];
		$FlgRegArb = (isset($_POST['FlgRegArb']) && $_POST['FlgRegArb'] == 'Yes') ? "1" : "0";
        $FlgPrtArb = (isset($_POST['FlgPrtArb']) && $_POST['FlgPrtArb'] == 'Yes') ? "1" : "0";
        $FlgUniArb = (isset($_POST['FlgUniArb']) && $_POST['FlgUniArb'] == 'Yes') ? "1" : "0";
        /* PESTAÑA : INFORMACION ADICIONAL */
        $PosPrtDmd = $_POST['detposdem'];
        $PreRecDmd = $_POST['detprecon'];
        $CuaCtrdmd = $_POST['detcuacon'];
        /* PESTAÑA : ANEXOS */
        $NomFil01 = '';
        $NomFil02 = '';
        $NomFil03 = '';
        $DirFil01 = '';
        $DirFil02 = '';
        $DirFil03 = '';


        /* 2. Cargar archivo Adjunto */
		/* ---------------------------------------------------------------------------------------- */
		$Archivos = new CargaArchivo();

		/* 2.1 CArga adjunto 01 */
		// echo $_FILES['NomArcReq01']['type'];

		if(isset($_FILES['NomArcReq01']['type'])){
			if ($_FILES['NomArcReq01']['name'] != ''){
				$NomFil01 = $_FILES['NomArcReq01']['name'];
				$DirFil01 = $Archivos->subirArchivo($_FILES['NomArcReq01']);
			}
		}
		/* 2.2 Carga adjunto 02 */
		if(isset($_FILES['NomArcReq02']['type'])){
			if($_FILES['NomArcReq02']['name'] != ''){
				$NomFil02 = $_FILES['NomArcReq02']['name'];
				$DirFil02 = $Archivos->subirArchivo($_FILES['NomArcReq02']);
			}
		}
		/* 2.3 CArga adjunto 03 */
		if(isset($_FILES['NomArcReq03']['type'])){
			if($_FILES['NomArcReq03']['name'] != ''){
				$NomFil03 = $_FILES['NomArcReq03']['name'];
				$DirFil03 = $Archivos->subirArchivo($_FILES['NomArcReq03']);
			}
		}

		/* PESTAÑA DESIGNACION DE ARBITRO */ 
		$Respuesta = $solicitudrespuesta->ActualizarRespuesta($idRespuesta,$DesDirDmd,$ValSegTok,$NomRepLeg,$TipDocRep,$NumDocRep,$NumTelRep,$NumCelRep,$DirEmaRep,$ApeNomArb,
															  $DesDirArb,$NumTelArb,$DirEmaArb,$NomProArb,$NumColArb,$FlgRegArb,$FlgPrtArb,$FlgUniArb,$PosPrtDmd,$PreRecDmd,
															  $CuaCtrdmd,$NomFil01,$NomFil02,$NomFil03,$DirFil01,$DirFil02,$DirFil03);

		/* Aqui implementar logica para  actualizar indicador que demandado respondio*/

		$dataRespuesta = $solicitudrespuesta->ObtenerRespuestaPendiente($idRespuesta);

		$Respondio = $solicitud->ActualizaRespuesta($dataRespuesta['idsolicitud']);
		
		//echo $Respuesta;
		echo $Respondio;

	}
	/* ==========================================================================================================================
	REGISTRAR RESPUESTA DE SOLICITUD
	============================================================================================================================*/
	if($_POST['Operacion']== 'ValidaToken'){

		$idRespuesta = $_POST['idRespuesta'];
        $ValSegTok 	 = $_POST['ValSegTok'];

        $Respuesta = $solicitudrespuesta->ValidaToken($idRespuesta,$ValSegTok);

        echo $Respuesta;
	}
	/* ==========================================================================================================================
	GENERAR SOLICITUD DE ARBITRAJE MANUAL 
	=============================================================================================================================*/
	if($_POST['Operacion']== 'GenerarMedidaCautelar'){
		
		/* Grabar en tabla tra_tbsolicitud */
		$idUsuario 		= $_POST['idUsuario']; 		/**/
		$RazSocDem 		= $_POST['RazSocDem']; 		/**/
		$TipDocDem 		= $_POST['TipDocDem']; 		/**/
		$NumDocDem 		= $_POST['NumDocDem']; 		/**/
		$DesDirDem 		= $_POST['DesDirDem']; 		/**/
		$ApeNomLeg 		= $_POST['ApeNomLeg']; 		/**/
		$NumDocRep 		= $_POST['NumDocRep']; 		/**/
		$NumTelRep 		= $_POST['NumTelRep']; 		/**/
		$NumCelRep 		= $_POST['NumCelRep']; 		/**/
		$DirEmaRep 		= $_POST['DirEmaRep']; 		/**/

		$EscPubDem      = $_POST['EscPubDem']; 		/* escritura publica */ 

		$RazSocEmiCom 	= $_POST['RazSocEmiCom']; 	/**/
		$RazSocDmd 		= $_POST['RazSocDmd'];		/**/
		$DesDirDmd 		= $_POST['DesDirDmd'];		/**/
		$NumTelDmd 		= $_POST['NumTelDmd'];		/**/
		$NumCelDmd 		= $_POST['NumCelDmd'];		/**/
		$DirEmaDmd 		= $_POST['DirEmaDmd'];		/**/
		$DesNarHec 		= $_POST['DesNarHec'];		/**/
		$desexicon 		= $_POST['desexicon'];		/**/
		$frmejenomper 	= $_POST['frmejenomper'];	/**/
		$frmejedomper 	= $_POST['frmejedomper'];	/**/
		$frmejetelper 	= $_POST['frmejetelper'];	/**/
		$frmejecelper 	= $_POST['frmejecelper'];	/**/
		$frmejeemaper 	= $_POST['frmejeemaper'];	/**/
		$frmejenomemp 	= $_POST['frmejenomemp'];	/**/
		$frmejedomemp 	= $_POST['frmejedomemp'];	/**/
		$frmejetelemp 	= $_POST['frmejetelemp'];	/**/
		$frmejecelemp 	= $_POST['frmejecelemp'];	/**/
		$frmejeemaemp 	= $_POST['frmejeemaemp'];	/**/
		$desexpcon 		= $_POST['desexpcon'];		/**/
		$despre01 		= $_POST['despre01'];		/**/
		$despre02 		= $_POST['despre02'];		/**/
		$despre03 		= $_POST['despre03'];		/**/
		$despreadi01 	= $_POST['despreadi01'];	/**/
		$despreadi02 	= $_POST['despreadi02'];	/**/
		$despreadi03 	= $_POST['despreadi03'];	/**/

		$idSolicitud = $solicitud->GeneraMedidaCautelar($idUsuario,$RazSocDem,$TipDocDem,$NumDocDem,$DesDirDem,$ApeNomLeg,$NumDocRep,$NumTelRep,$NumCelRep,$DirEmaRep,
   											   		$EscPubDem,$RazSocEmiCom,$RazSocDmd,$DesDirDmd,$NumTelDmd,$NumCelDmd,$DirEmaDmd,$DesNarHec,$desexicon,$frmejenomper,
   											   		$frmejedomper,$frmejetelper,$frmejecelper,$frmejeemaper,$frmejenomemp,$frmejedomemp,$frmejetelemp,$frmejecelemp,$frmejeemaemp,
   											   		$desexpcon,$despre01,$despre02,$despre03,$despreadi01,$despreadi02,$despreadi03);

		/* Grabar en tabla tra_tbSolicitudpretension */
		$dataPretenciones = array();

		if(isset($_POST["pretenciones"])){
            foreach($_POST["pretenciones"] as $p){
                $pretencion = json_decode($p);
                array_push($dataPretenciones, $pretencion);
            }    
        }

        if(isset($dataPretenciones)){ // ------------------------------------------------------------------------ logica de pretensiones
                // Agregar aqui todas las pretenciones
                $idPretension  = 0;
                foreach ($dataPretenciones as $value) {
                    $idPretension  ++;
                    $desPretension = $value->pretencion;
                    $Solicitudpretension->NuevaSolicitudPretension($idSolicitud['nuevoId'],$idPretension,$desPretension);
                }
            }

		/* Grabar en tabla tra_tbSolicitudanexo */
		$dataAnexos = array();
		
		if(isset($_POST["anexos"])){
            foreach($_POST["anexos"] as $p){
                $anexos = json_decode($p);
                array_push($dataAnexos, $anexos);                   
            }
        }

        if(isset($dataAnexos)){ // ---------------------------------------------------------------------------- logica de anexos
            $cntfile  = 0;

            if(isset($_POST["fileAnexo"])){
                $files = $_POST["fileAnexo"];
                $itemFiles = 0;
            }

            foreach ($dataAnexos as $value) {

                $cntfile ++;
                
                $idTipo         = $value->idtipo;
              //$idSolicitud    = $ValMsnRegistro;
                $nomFileLoc     = $value->Archivo;

                $nomFilePrt     = explode(".", $nomFileLoc);
                $nomfileSav     = end($nomFilePrt);
                $nomFileSer     = "ANX_".date("Ymd")."_".date("His")."_".$cntfile.".".$nomfileSav;
                $flgEliminado   = 'N';

                $SolicitudAnexo->AgregarAnexo($idSolicitud['nuevoId'],$idTipo,$nomFileLoc,$nomFileSer,$flgEliminado);

                // Escritura de archivo en servidor
                if(isset($_POST["fileAnexo"])){
                    $filSvr = $_SERVER['DOCUMENT_ROOT'].'/tramite/vistas/upload/'.$nomFileSer;
                    file_put_contents($filSvr, base64_decode($files[$itemFiles]));
                    $itemFiles++;
                }
            }
        }

		/* devolver datos */
		echo $idSolicitud['nuevoId'];
	}

	/* ==========================================================================================================================
	BUSCAR MEDIDA CAUTELAR
	=============================================================================================================================*/
	if($_POST['Operacion']== 'BuscarMedidaCautelar'){

		$idUsuario = $_POST['idUsuario'];
	
		$ListaMedidaCautelar = $solicitud->ListarMedidaCautelar($idUsuario);
		$item = 0;

		$arreglo = array();

		foreach ($ListaMedidaCautelar as $key => $value) {
			$item ++;
			$value['row'] = $item;
			$arreglo["data"][] = $value;
		}

		if(count($arreglo) == 0){
			echo '{"data":[]}';
		}else{
			echo json_encode($arreglo);
		}
	}

	/* ==========================================================================================================================
	ASIGNACION DE ARBITRO (SOLO EN LAS SOLICITUD DE ARBITRAJE)
	=============================================================================================================================*/
	if($_POST['Operacion'] == 'AsignarArbitro'){

		$idSolicitud    = $_POST['idSolicitud'];
		$dataSolicitud 	= $solicitud->EditarSolicitud_v2($idSolicitud);
		$dataRespuesta  = $solicitudrespuesta->ObtenerRespuestaSolicitud($idSolicitud);

		/* --------------------------------------------------------------------------------- ARBITRO DEMANDANTE*/
		$html = '<div class="card border-info rounded-0">
		    		<div class="card-header p-2 bg-info text-white rounded-0">
		    			Árbitro seleccionado por DEMANDANTE
		    		</div>
		    		<div class="card-body p-2">';
		    			
		    			if($dataSolicitud['FlgPrtArb'] == 'x'){
		    				$html .='<select name="cboarbdmd" id="cboarbdmd" class="form-control cbo">
										<option value="">Seleccione Árbitro para Demandante</option>
										<option value="1">Arbitro 01</option>
										<option value="2">Arbitro 02</option>
									</select>';	
						}else{
							if($dataSolicitud['ApeNomArb'] != ''){
								$html .= '<label for="">'.$dataSolicitud['ApeNomArb'].'</label>';
							}else{
								$html .='<select name="cboarbdmd" id="cboarbdmd" class="form-control cbo">
											<option value="">Seleccione Árbitro para Demandante</option>
											<option value="1">Arbitro 01</option>
											<option value="2">Arbitro 02</option>
											<option value="3">Arbitro 03</option>
										</select>';	
							}
						}
		$html .=	'</div>
		    	</div>';
		/* --------------------------------------------------------------------------------- ARBITRO DEMANDADO (RESPUESTA)*/
		$html .='<div class="card border-info rounded-0 mt-2">
		    		<div class="card-header p-2 bg-info text-white rounded-0">
		    			Árbitro seleccionado por DEMANDADO
		    		</div>
		    		<div class="card-body p-2">';
		    		if(isset($dataRespuesta['FlgPrtArb'])){
		    			if($dataRespuesta['FlgPrtArb'] == '0'){
		    				$html .= '<label class="form-control">'.$dataRespuesta['NomProArb'] .', '.$dataRespuesta['ApeNomArb'].'</label>';
		    			}else{
							$html .='<select name="" id="" class="form-control">
										<option value="">Seleccione Árbitro para Demandado</option>
									</select>';	
		    			}
		    		}else{
						$html .= '<label class="form-control">DEMANDADO, no fue <strong> NOTIFICADO </strong>.</label>';
		    		}

		    $html .='</div>
		    	</div>';

		/* --------------------------------------------------------------------------------- ARBITRO PRINCIPAL */
		$html .='<div class="card border-info rounded-0 mt-2">
		    		<div class="card-header p-2 bg-info text-white rounded-0">
		    			Árbitro Principal
		    		</div>
		    		<div class="card-body p-2">';
				$html .='<select name="" id="" class="form-control">
							<option value="">Seleccione Árbitro Principal</option>
							<option value="1">Arbitro 01</option>
							<option value="2">Arbitro 02</option>
							<option value="3">Arbitro 03</option>
						</select>';	
		    $html .='</div>
		    	</div>';
		/* --------------------------------------------------------------------------------- ARBITRO UNICO */
		$html .='<div class="card border-info rounded-0 mt-2">
		    		<div class="card-header p-2 bg-info text-white rounded-0">
		    			Árbitro Unico (de ser así necesario)
		    		</div>
		    		<div class="card-body p-2">';
					if($dataSolicitud['FlgUniArb'] == 'x'){
						$html .='<select name="" id="" class="form-control">
										<option value="">Seleccione Árbitro para Demandante</option>
										<option value="1">Arbitro 01</option>
										<option value="2">Arbitro 02</option>
										<option value="3">Arbitro 03</option>
									</select>';	
					}else{
						$html .='<label class="form-control">DEMANDANTE, no indico <strong>ÁRBITRO ÚNICO</strong></label>';
					}
		   $html .='</div>
		    	</div>';

		echo $html;
	}

	/*==========================================================================================================================*/
	class CargaArchivo{

		public static function subirArchivo($file){

			$directorio = $_SERVER['DOCUMENT_ROOT']."/tramite/vistas/upload/";

			if(!file_exists($directorio)){
				mkdir($directorio,0777,true);
			}
			/* Obtenemos el nombre del archivo */
			$nom_archivo  = $file['name'];

			/* Generamos el nombre del archivo para el servidor */
			$nom_fil     = explode(".", $nom_archivo);
			$nom_fil_ser = "ANX_RPT_".date("Ymd")."_".date("His").".".end($nom_fil);

			/* Generamos la ruta para el servidor */
			$ruta_archivo = $directorio.$nom_fil_ser;

			if (move_uploaded_file($file['tmp_name'], $ruta_archivo)){
				$nomfileser		= $nom_fil_ser;
			}

			return $nom_fil_ser;

		}
	}

?>