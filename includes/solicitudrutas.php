<?php 
require_once "db.php";
class SolicitudRutas{

/*
	idSolicitud			 	INT				NOT NULL,		--> Codigo de solicitud
	idruta					INT				NOT NULL,		--> numero de ruta o envio
	idtipdoc				INT				NULL,			--> tipo de documento interno
	asunto					VARCHAR(150)	NULL,			--> asunto de envio
	contenido				VARCHAR(250)	NULL,			--> contenido de envio
	para					INT				NULL,			--> usuario destino
	idareaenvio				INT				NULL,			-->	area de envio
	fchenvio				DATE			NULL,			--> fecha de envio
	hraenvio				TIME			NULL,			-->	hora de envio
	idareadestino			INT				NULL,			-->	area de destino

	usrrecepcion			INT				NULL,			-->	usuario de recepcion
	fchrecepcion			DATE			NULL,			-->	fecha de recepcion
	hrarecepcion			TIME			NULL,			--> hora de recepción
	flgrecepcion			VARCHAR(1)		NULL,			--> indicador de recibido

	nomFileLoc				VARCHAR(250)	NULL,			--> nombre de archivo subido
	nomFileSer				VARCHAR(250)	NULL,			--> nombre de archivo en servidor
	idUsuario				INT 			NULL,			-->	codigo de usuario que registro el envio
	fchCreacion				DATE			NULL,			-->	fecha de registro
	hraCreacion				TIME			NULL,			--> hora de registro
*/

	/*=============================================
	  RECEPCIONAR RUTA
	  =============================================*/
	  public function RecepcionarRuta($idSolicitud,$idRuta,$idUsuario){

	  	$query = Conexion::conectar()->prepare('UPDATE tra_tbSolicitudRutas 
	  											SET  flgrecepcion = "S",
	  												 usrrecepcion = :idusuario,
	  												 fchrecepcion = CURDATE(),
	  												 hrarecepcion = CURTIME()
												WHERE idSolicitud = :idSolicitud
												AND idruta = :idruta');                                
       	$query->execute([ 'idSolicitud'  => $idSolicitud,
						  'idruta'       => $idRuta,
						  'idusuario'    => $idUsuario]);

	   	$count = $query->rowCount();

	   	return $count;
	  }

	/*=============================================
	  LISTAR RUTAS
	  =============================================*/
	  public function AnularRuta($idSolicitud,$idRuta){

	  	$query = Conexion::conectar()->prepare('UPDATE tra_tbSolicitudRutas 
	  											SET  flgEliminado  = "S"
												WHERE idSolicitud = :idSolicitud
												AND idruta = :idruta');                                
       	$query->execute([ 'idSolicitud'  => $idSolicitud,
						  'idruta'    => $idRuta]);

	   	$count = $query->rowCount();

	   	return $count;
	  }

	/*=============================================
	  LISTAR RUTAS
	  =============================================*/
	  public function EditarRuta($idSolicitud,$idRuta){

	  	$query = Conexion::conectar()->prepare("SELECT 	
														s.idtipsol,
														i.destipsol,
	  													s.NumSol,
	  													s.FchCreSol,
	  													s.HraCreSol,
	  													r.idSolicitud,
	  													r.idruta,
	  													r.idtipdoc,
	  													t.desdocint as 'destipdoc',
	  													r.asunto,
	  													r.contenido,
	  													r.para,
	  													CONCAT(u.apepat,' ',u.apemat,', ',u.nombre) as 'nomraz',
	  													r.idareaenvio,
	  													a1.desarea as 'desareaenvio',
	  													r.fchenvio,
	  													r.hraenvio,
	  													r.idareadestino,
	  													a2.desarea as 'desareadestino',
														r.usrrecepcion,
														r.fchrecepcion,
														r.hrarecepcion,
														r.flgrecepcion,
														r.nomFileLoc,
														r.nomFileSer,
														r.idUsuario,
														r.fchCreacion,
														r.hraCreacion,
														r.referencia,
														r.numdocint,
														s.RazSocDem,
														s.TipDocDem,
														s.NumDocDem,
														td.tipdoc as 'DesDocDem',
														s.RazSocDmd,
														s.DiremaDmd
												FROM tra_tbSolicitudRutas r
												LEFT JOIN tra_tbarea a1 ON r.idareaenvio = a1.id
												LEFT JOIN tra_tbarea a2 ON r.idareadestino = a2.id
												LEFT JOIN tra_tbdocumentosinternos t on r.idtipdoc = t.id
												LEFT JOIN tra_tbusuario u on r.para = u.id
												LEFT JOIN tra_tbSolicitud s ON r.idSolicitud = s.id
												LEFT JOIN tra_tbTipoSolicitud i ON s.idtipsol = i.id
												LEFT JOIN tra_tbtipdoc td ON s.TipDocDem = td.id
												WHERE r.idSolicitud = ".$idSolicitud." 
												AND r.idruta = ".$idRuta."
												AND r.flgEliminado = 'N'");
   		$query->execute();

    	return $query -> fetch();

	  	$query->close();
	  }

	/*=============================================
	  LISTAR RUTAS
	  =============================================*/
	  public function ListarRutas($idSolicitud){

	  	$query = Conexion::conectar()->prepare("SELECT 	r.idSolicitud,
	  													r.idruta,
	  													r.idtipdoc,
	  													t.desdocint as 'destipdoc',
	  													r.asunto,
	  													r.contenido,
	  													r.numdocint,
	  													r.para,
	  													r.idareaenvio,
	  													a1.desarea as 'desareaenvio',
	  													r.fchenvio,
	  													r.hraenvio,
	  													r.idareadestino,
	  													a2.desarea as 'desareadestino',
														r.usrrecepcion,
														r.fchrecepcion,
														r.hrarecepcion,
														r.flgrecepcion,
														r.nomFileLoc,
														r.nomFileSer,
														r.idUsuario,
														r.fchCreacion,
														r.hraCreacion
												FROM tra_tbSolicitudRutas r
												LEFT JOIN tra_tbdocumentosinternos t on r.idtipdoc = t.id
												LEFT JOIN tra_tbarea a1 ON r.idareaenvio = a1.id
												LEFT JOIN tra_tbarea a2 ON r.idareadestino = a2.id
												WHERE r.idSolicitud = ".$idSolicitud." 
												AND r.flgEliminado = 'N'");
   		$query->execute();

    	return $query -> fetchAll();

	  	$query->close();
	  }

	/*========================================================
	AGREGAR RUTA
	========================================================*/
	public function AgregarRuta($idSolicitud,$idtipdoc,$asunto,$referencia,$contenido,$para,$idareaenvio,$idareadestino,$nomFileLoc,$nomFileSer,$idUsuario){
 		
		$pdo=Conexion::conectar();

	  	$query = $pdo->prepare('CALL usp_agregar_ruta(:idSolicitud,:idtipdoc,:asunto,:referencia,:contenido,:para,:idareaenvio,:idareadestino,:nomFileLoc,:nomFileSer,:idUsuario)');

		$resultado = $query->execute(['idSolicitud'   => $idSolicitud,
									  'idtipdoc'      => $idtipdoc,
									  'asunto'        => $asunto,
									  'referencia'    => $referencia,
									  'contenido'     => $contenido,
									  'para'          => $para,
									  'idareaenvio'   => $idareaenvio,
									  'idareadestino' => $idareadestino,
									  'nomFileLoc'    => $nomFileLoc,
									  'nomFileSer'    => $nomFileSer,
									  'idUsuario'     => $idUsuario]);
	   	
	   	return $query -> fetch();

	   	}

	/*========================================================
	ACTUALIZAR RUTA
	========================================================*/
	public function ActualizarRuta($idSolicitud,$idruta,$asunto,$referencia,$contenido,$para,$nomFileLoc,$nomFileSer,$idUsuario){
 		
		$pdo=Conexion::conectar();

	  	$query = $pdo->prepare('UPDATE tra_tbSolicitudRutas
	  								SET para       = :para,
	  									asunto     = :asunto,
	  									referencia = :referencia,
	  									contenido  = :contenido,
	  									nomFileLoc = :nomFileLoc,
	  									nomFileSer = :nomFileSer,
	  									idUsuario  = :idUsuario
	  								WHERE idSolicitud = :idSolicitud
	  								AND idruta = :idruta');

		$query->execute([	'para'          => $para,
							'asunto'        => $asunto,
							'referencia'    => $referencia,
							'contenido'     => $contenido,	
							'nomFileLoc'    => $nomFileLoc,
							'nomFileSer'    => $nomFileSer,
							'idUsuario'     => $idUsuario,
							'idSolicitud'   => $idSolicitud,
							'idruta'		=> $idruta]);
	   	
	   	$count = $query->rowCount();

	   	return $count;

	   	}	   	

	/* ==========================================
    RECEPCION : LISTA DE RUTAS PENDIENTES
    ========================================== */
   	public function ListarSolicitudAtencion($pnumsol,$recsol,$idarea){
  
		$sql = "SELECT 	0 as 'row',
						r.idSolicitud,
						r.idruta,
						s.NumSol,
						e.desest as 'desest',
						CONCAT(r.fchenvio,' ',r.hraenvio) as 'fchenvio',
						r.idareaenvio,
						a.desarea,
						r.asunto,
						r.idtipdoc,
						r.numdocint,
						r.flgrecepcion,
						r.fchrecepcion,
						r.hrarecepcion,
						r.usrrecepcion,
						CONCAT(r.idSolicitud,'-',r.idruta) as 'item'
				FROM tra_tbSolicitud s
				INNER JOIN tra_tbSolicitudRutas r ON s.id = r.idSolicitud
				INNER JOIN tra_tbarea a   ON r.idareaenvio = a.id
				INNER JOIN tra_tbestado e ON s.idest = e.id
				INNER JOIN (SELECT 
								idSolicitud,
								MAX(idruta) AS 'ultimoEnvio'
							FROM tra_tbSolicitudRutas
							WHERE flgEliminado = 'N'
							GROUP BY idSolicitud
							) rmax ON  r.idSolicitud = rmax.idSolicitud AND r.idruta = rmax.ultimoEnvio

				WHERE r.idareadestino = :areadestino
				AND r.flgrecepcion = :flgrecepcion
				ORDER BY s.id DESC";

   		$query = Conexion::conectar()->prepare($sql);

   		$query->execute([
   							'areadestino' => $idarea,
   							'flgrecepcion' => $recsol
   						]);

    	return $query -> fetchAll();

	  	$query->close();
   }
	/* ==========================================
    RECEPCION : LISTA DE RUTAS PENDIENTES
    ========================================== */
   	public function ListarSolicitudEnviadas($pnumsol,$pcodare){
   		
   		$sql = "SELECT   0 as 'row',
   						 r.idSolicitud,
   						 r.idruta,
					   	 s.Numsol,
						 CONCAT(r.fchenvio,' ',r.hraenvio) as fchenvio,
						 r.idareadestino,
						 a.desarea,
						 r.asunto,
						 r.idtipdoc,
						 r.numdocint,
						 r.flgrecepcion,
						 r.fchrecepcion,
						 r.hrarecepcion,
						 r.usrrecepcion,
						 CONCAT(r.idSolicitud,'-',r.idruta) as 'item'
					FROM tra_tbSolicitudRutas r
					LEFT JOIN tra_tbSolicitud s ON r.idSolicitud = s.id
					LEFT JOIN tra_tbarea a   	ON r.idareadestino = a.id
					WHERE idareaenvio = :idareaenvio
					AND flgrecepcion = 'N'
					AND flgeliminado = 'N'";

   		$query = Conexion::conectar()->prepare($sql);

   		$query->execute(['idareaenvio' => $pcodare]);

    	return $query -> fetchAll();

	  	$query->close();
   }
 }

?>

