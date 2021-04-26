<?php 
require_once "db.php";

class Solicitud{

/*
	id			 INT
	idUsuario	 INT 			NOT NULL     --> Identificador de Usuario
	NumSol		 VARCHAR(15)	NULL,		 --> Numero de Solicitud
	FchCreSol	 DATE			NULL,		 --> Fecha de Solicitud
	HraCreSol	 DATE			NULL,		 --> Hora de Solicitud
	----------------------------------------------------------------------------------------------------------- DEMANDANTE
	RazSocDem	 VARCHAR(150)	NOT NULL, 	 --> Razón social de demandante
	TipDocDem	 VARCHAR(1)		NOT NULL,	 --> Tipo de documento de demandante
	NumDocDem	 VARCHAR(20)	NOT NULL,	 --> Numero de documento de demandante
	EscPubDem	 VARCHAR(250)	NULL, 		 --> Datos de escritura publica acta legalizada etc.
	DesDirDem	 VARCHAR(150)	NULL,		 --> Domicilio de persona natural o juridica
	ApeNomLeg	 VARCHAR(150)	NULL,		 --> Apellidos y nombres de representante legal
	TipDocRep	 VARCHAR(1)		NULL,		 --> Tipo de documento de identidad de representante legal
	NumDocRep	 VARCHAR(20)	NULL,		 --> Numero de documento de identidad de representante legal
	NumTelRep	 VARCHAR(20)	NULL,		 --> Numero de telefono de representante
	NumCelRep	 VARCHAR(20)	NULL,		 --> Numero de celular de representante
	DirEmaRep	 VARCHAR(150)	NULL,		 --> Dirección de correo electronico de representante
	TipDocEmiCom VARCHAR(1)		NULL,		 --> Tipo de comprobante de pago para emitir 
	NumDocEmiCom VARCHAR(20)	NULL,		 --> Numero de documento de identidad dependiendo Tipo de documento 
	RazSocEmiCom VARCHAR(150)	NULL,		 --> Razon social para emision de crompobante en caso elija Boleta
    ----------------------------------------------------------------------------------------------------------- DEMANDADO
	RazSocDmd	 VARCHAR(150)	NULL,        --> Razón Social de demandado
	DesDirDmd	 VARCHAR(150)	NULL,        --> Dirección de demandado
	TipDocDmd	 VARCHAR(2)		NULL,		 --> Tipo de documento de identidad del demandado
	NumDocDmd	 VARCHAR(20)	NULL,		 --> Numero de documento del del demandado
	NumTelDmd	 VARCHAR(20)	NULL,        --> Numero de Telefono de demandado
	NumCelDmd	 VARCHAR(20)	NULL,        --> Numero de Celular de demandado
	DirEmaDmd	 VARCHAR(150)	NULL,        --> Correo electronico de demandado
	AutRepDmd	 VARCHAR(150)   NULL,		 --> Auitoridad o representante         (27/05/2020)
	ProPubDmd	 VARCHAR(150)   NULL,        --> Procurador público de corresponder (27/05/2020)
    ----------------------------------------------------------------------------------------------------------- CONVENIO
	DesConArb	 TEXT 			NULL,        --> Detalle de convenio arbitral
    ----------------------------------------------------------------------------------------------------------- TIPO DE ARBITRAJE
	flgCtrDer	VARCHAR(1)		NULL,		 --> Indicador de Controversia de Derecho
	flgCtrCon	VARCHAR(1)		NULL,		 --> Indicador de Controversia de Consiciencia
	flgCtrNac	VARCHAR(1)		NULL,		 --> Indicador de Controversia Nacional
	flgCtrInt	VARCHAR(1)		NULL,		 --> Indicador de Controversia Internacional
	flgEspCtr	VARCHAR(1)		NULL,		 --> Indicador de Especialidad por contratación Pública
	flgEspCiv	VARCHAR(1)		NULL,		 --> Indicador de Especialidad Civil
	flgEspLey	VARCHAR(1)		NULL,		 --> Indicador de Especialidad Ley General
	flgEspMin	VARCHAR(1)		NULL,		 --> Indicador de Especialidad Minero
	flgEspCon	VARCHAR(1)		NULL,		 --> Indicador de Especialidad Conseciones
	flgEspOtr	VARCHAR(1)		NULL,		 --> Indicador de Especialidad Otros
    ---------------------------------------------------------------------------------------------------------- NARRACION DE HECHOS
	DesNarHec	 VARCHAR(950)	NULL,        --> Descripción de Naracción de Hechos.
    ---------------------------------------------------------------------------------------------------------- MEDIDA CAUTELAR
	DesMedCau	 TEXT			NULL,        --> Descripción de Medida Cautelar
    ---------------------------------------------------------------------------------------------------------- CUANTIA
	TipCuant	VARCHAR(2)		NULL,		 --> Tipo de Cuantia
	MonCuant	VARCHAR(2)		NULL,		 --> Moneda de Cuantia
	ImpNCuant	VARCHAR(20)		NULL,		 --> Importe en numero de cuatía
	ImpLCuant	VARCHAR(150)	NULL,		 --> Importe en Letras de cuentía
    ---------------------------------------------------------------------------------------------------------- DESIGNACION DE ARBITRO
	ApeNomArb	 VARCHAR(150)	NULL,		 --> Apellidos y Nombre de Arbitro
	DesDirArb	 VARCHAR(150)	NULL,		 --> Dirección de Arbitro
	NumTelArb	 VARCHAR(20)	NULL,		 --> Telefono de Arbitro
	DirEmaArb	 VARCHAR(150)	NULL,		 --> Email de Arbitro
 	NomProArb	 VARCHAR(150)	NULL,		 --> Profesión de Arbitro
 	NumColArb	 VARCHAR(50)	NULL,		 --> Numero de Colegiatura
 	FlgRegArb	 VARCHAR(1)		NULL,		 --> Indicador de registro de Arbitros OSCE
	FlgPrtArb	 VARCHAR(10)	NULL,		 --> Indicador que indica si centro de arbitraje designa arbitro de parte
	FlgUniArb	 VARCHAR(10)	NULL,		 --> Indicador que indica si centro de arbitraje designa arbitro unico
    ----------------------------------------------------------------------------------------------------------
    idtipsol	 INT			NULL,		 --> Tipo de solicitud
	dessum		 VARCHAR(180)	NULL,		 --> Descripción de Sumilla
	desref		 VARCHAR(180)   NULL,		 --> Descripcion de Referencia
    idSit		 VARCHAR(1)		NULL,		 --> Codigo de Situación
	idEst		 VARCHAR(1)		NULL,		 --> Codigo de Estado
	FchUltMod	 DATE			NULL,		 --> Fecha de Ultima Modificación
	flgNotDem	 VARCHAR(1)		DEFAULT 'N', --> Indicar de Notificación de correo de respuesta a demandado
*/
   //listado de arbitros asignados a una solicidud
    public static function listadoArbitrosAsignados($id)
	{
		$flat=1;
		$pdo=Conexion::conectar();
		$query = $pdo->prepare('CALL usp_mantenimiento_solicitud_arbitro(:flat,:id)');

		$query->execute(['flat'  	=> $flat,
						 'id'  		=> $id
						]);

		return $query -> fetchAll();


	  	$query->close();
	}
	//Eliminar arbitros asignados a una solicidud
	public static function EliminarArbitroAsignado($id)
	{
		$flat=2;
		$pdo=Conexion::conectar();
		$query = $pdo->prepare('CALL usp_mantenimiento_solicitud_arbitro(:flat,:id)');

		$query->execute(['flat'  	=> $flat,
						 'id'  		=> $id
						]);

		$count = $query->rowCount();

		return $count;
	}
	public static function ActualizaRespuesta($idSolicitud){
		
		$query = Conexion::conectar()->prepare("update tra_tbSolicitud set flgSolRes = 'S' where id = :id");

		$query->execute(['id' => $idSolicitud]);
		
		$count = $query->rowCount();

	   	return $count;

	}

	public static function ActualizaNotificacion($idSolicitud){
		
		$query = Conexion::conectar()->prepare("update tra_tbSolicitud set flgNotDem = 'S' where id = :id");

		$query->execute(['id' => $idSolicitud]);
		
		$count = $query->rowCount();

	   	return $count;

	}

	public static function SolicitudArbitralManual($idUsuario,$RazSocDem,$TipDocDem,$NumDocDem,$RazSocDmd,$TipDocDmd,$NumDocDmd,$DirEmaDmd,$idtipsol,$idSit,$idEst,$nomfileloc,$nomfileser){
  		
  		$pdo=Conexion::conectar();

  		$query = $pdo->prepare('CALL usp_generar_solicitud_arbitral_manual(:idUsuario,:RazSocDem,:TipDocDem,:NumDocDem,:RazSocDmd,:TipDocDmd,:NumDocDmd,:DirEmaDmd,:idtipsol,:idSit,:idEst,:nomfileloc,:nomfileser)');

		$query->execute(['idUsuario'  => $idUsuario,
						 'RazSocDem'  => $RazSocDem,
						 'TipDocDem'  => $TipDocDem,
						 'NumDocDem'  => $NumDocDem,
						 'RazSocDmd'  => $RazSocDmd,
						 'TipDocDmd'  => $TipDocDmd,
						 'NumDocDmd'  => $NumDocDmd,
						 'DirEmaDmd'  => $DirEmaDmd,
						 'idtipsol'   => $idtipsol,
						 'idSit' 	  => $idSit,
						 'idEst' 	  => $idEst,
						 'nomfileloc' => $nomfileloc,
						 'nomfileser' => $nomfileser]);

		return $query -> fetch();

   	}

/* ==========================================
   Grabar Solicitud por Mesa de Partes
   ========================================== */
   public static function ActualizarSolicitudMesaPartes($id,$idtipsol,$desSum,$desRef,$idSit,$idEst){
	
		$query = Conexion::conectar()->prepare('UPDATE tra_tbSolicitud SET  idtipsol  = :idtipsol,
																			desSum    = :desSum,
																			desRef    = :desRef,
																			idSit     = :idSit,
																			idEst     = :idEst     
																	  WHERE id = :id');                                
       	$query->execute([ 'idtipsol'  => $idtipsol,
						  'desSum'    => $desSum,
						  'desRef'    => $desRef,
						  'idSit'     => $idSit,
						  'idEst'     => $idEst,
						  'id'		  => $id]);

	   	$count = $query->rowCount();

	   	return $count;
   }

/* ==========================================
   Numero de Solicitudes
   ========================================== */
   public function CountSolicitud($idUsuario,$NumSol){
   		
   		$CriSel = '';
   		if($NumSol == ''){
   			$CriSel = '%';
   		}else{
			$CriSel = '%'.$NumSol.'%';
   		}

   		$query = Conexion::conectar()->prepare("SELECT count(id) as Cnt FROM tra_tbSolicitud WHERE idUsuario = ".$idUsuario." and NumSol like '".$CriSel."'");

   			$query->execute(['idUsuario'  => $idUsuario,
						 'RazSocDem'  => $RazSocDem,
						 'TipDocDem'  => $TipDocDem,
						 'NumDocDem'  => $NumDocDem,
						 'RazSocDmd'  => $RazSocDmd,
						 'TipDocDmd'  => $TipDocDmd,
						 'NumDocDmd'  => $NumDocDmd,
						 'DirEmaDmd'  => $DirEmaDmd,
						 'idtipsol'   => $idtipsol,
						 'idSit' 	  => $idSit,
						 'idEst' 	  => $idEst,
						 'nomfileloc' => $nomfileloc,
						 'nomfileser' => $nomfileser]);

    	return $query -> fetch();

	  	$query->close();
   }

/* ==========================================
   Editar Solicitud
   ========================================== */
   public function EditarSolicitud($id,$idUsuario){
   		
   		$query = Conexion::conectar()->prepare("SELECT  c.id,c.idUsuario,c.NumSol,c.FchCreSol,c.RazSocDem,c.TipDocDem,c.NumDocDem,c.EscPubDem,
														c.DesDirDem,c.ApeNomLeg,c.TipDocRep,c.NumDocRep,c.NumTelRep,c.NumCelRep,
														c.DirEmaRep,c.TipDocEmiCom,c.NumDocEmiCom,c.RazSocEmiCom,c.RazSocDmd,
														c.DesDirDmd,c.TipDocDmd,c.NumDocDmd,c.NumTelDmd,c.NumCelDmd,
														c.DirEmaDmd,c.AutRepDmd,c.ProPubDmd,c.DesConArb,c.flgCtrDer,c.flgCtrCon,c.flgCtrNac,
														c.flgCtrInt,c.flgEspCtr,c.flgEspCiv,c.flgEspLey,c.flgEspMin,
														c.flgEspCon,c.flgEspOtr,c.DesNarHec,c.DesMedCau,c.TipCuant,
														c.MonCuant,c.ImpNCuant,c.ImpLCuant,c.ApeNomArb,c.DesDirArb,
														c.NumTelArb,c.DirEmaArb,c.NomProArb,c.NumColArb,c.FlgRegArb,
														c.FlgPrtArb,c.FlgUniArb,c.idSit,e.desSit,c.idEst,d.desest,c.FchUltMod,
														c.idtipsol, c.dessum, c.desref
													FROM tra_tbSolicitud c 
													LEFT JOIN tra_tbestado d ON c.idEst = d.id
													LEFT JOIN tra_tbsituacion e ON c.idSit = e.id
													WHERE c.id = ".$id." AND c.idUsuario = ".$idUsuario);

   		$query->execute();

    	return $query -> fetch();

	  	$query->close();
   }

/* ==========================================
   Editar Solicitud para plantilla
   ========================================== */
   public function EditarSolicitud_v2($id){
   		
   		$query = Conexion::conectar()->prepare("SELECT  c.id,c.idUsuario,c.NumSol,
														c.FchCreSol,
														c.HraCreSol,
														u.nomraz  as 'RazSocDem',
														u.direma,
														c.TipDocDem,
														t.tipdoc  as 'DesTipDocDem',
														c.NumDocDem,
														c.EscPubDem,
														c.DesDirDem,
														c.ApeNomLeg,
														c.TipDocRep,
														tr.tipdoc  as 'DesTipDocRep',
														c.NumDocRep,
														c.NumTelRep,c.NumCelRep,
														c.DirEmaRep,
														c.TipDocEmiCom,
														tc.destip as 'DesTipDocEmiCom',
														c.NumDocEmiCom,
														c.RazSocEmiCom,
														c.RazSocDmd,
														c.DesDirDmd,
														c.TipDocDmd,
														trr.tipdoc  as 'DesTipDocDmd',
														c.NumDocDmd,
														c.NumTelDmd,
														c.NumCelDmd,
														c.DirEmaDmd,
														c.AutRepDmd,
														c.ProPubDmd,
														c.DesConArb,
														(CASE WHEN c.flgCtrDer = 1 THEN 'x' ELSE ' ' END) as 'flgCtrDer',
														(CASE WHEN c.flgCtrCon = 1 THEN 'x' ELSE ' ' END) as 'flgCtrCon',
														(CASE WHEN c.flgCtrNac = 1 THEN 'x' ELSE ' ' END) as 'flgCtrNac',
														(CASE WHEN c.flgCtrDer = 1 THEN 'x' ELSE ' ' END) as 'flgCtrDer',
														(CASE WHEN c.flgCtrInt = 1 THEN 'x' ELSE ' ' END) as 'flgCtrInt',
														(CASE WHEN c.flgEspCtr = 1 THEN 'x' ELSE ' ' END) as 'flgEspCtr',
														(CASE WHEN c.flgEspCiv = 1 THEN 'x' ELSE ' ' END) as 'flgEspCiv',
														(CASE WHEN c.flgEspLey = 1 THEN 'x' ELSE ' ' END) as 'flgEspLey',
														(CASE WHEN c.flgEspMin = 1 THEN 'x' ELSE ' ' END) as 'flgEspMin',
														(CASE WHEN c.flgEspCon = 1 THEN 'x' ELSE ' ' END) as 'flgEspCon',
														(CASE WHEN c.flgEspOtr = 1 THEN 'x' ELSE ' ' END) as 'flgEspOtr',
														c.DesNarHec,
														c.DesMedCau,
														c.TipCuant,
														tu.destip as 'desTipCuant',
														c.MonCuant,
														tm.SimMon,
														tm.DesMon,
														c.ImpNCuant,
														c.ImpLCuant,
														c.ApeNomArb,
														c.DesDirArb,
														c.NumTelArb,
														c.DirEmaArb,
														c.NomProArb,
														c.NumColArb,
														c.FlgRegArb,
														(CASE WHEN c.FlgPrtArb = 1 THEN 'x' ELSE ' ' END) as 'FlgPrtArb',
														(CASE WHEN c.FlgUniArb = 1 THEN 'x' ELSE ' ' END) as 'FlgUniArb',
														c.idSit,
														e.desSit,
														c.idEst,
														d.desest,
														c.FchUltMod,
														t.tipdoc,
														tr.tipdoc as 'tipDocRep',
														c.NumSol,
														c.idtipsol,
														ts.flgmsaprt,
														ts.destipsol,
														c.nomtra,
														c.dessum,
														c.desref,
														ts.destipsol,
														c.flgNotDem,
														c.flgSolRes,
														c.desexicon,
														c.frmejenomper,
														c.frmejedomper,
														c.frmejetelper,
														c.frmejecelper,
														c.frmejeemaper,
														c.frmejenomemp,
														c.frmejedomemp,
														c.frmejetelemp,
														c.frmejecelemp,
														c.frmejeemaemp,
														c.desexpcon,
														c.despre01,
														c.despre02,
														c.despre03,
														c.despreadi01,
														c.despreadi02,
														c.despreadi03
													FROM tra_tbSolicitud c 
													LEFT JOIN tra_tbestado d 	ON c.idEst = d.id
													LEFT JOIN tra_tbsituacion e ON c.idSit = e.id
													LEFT JOIN tra_tbtipdoc t 	ON c.TipDocDem = t.id
													LEFT JOIN tra_tbtipdoc tr 	ON c.TipDocRep = tr.id
													LEFT JOIN tra_tbtipdoc trr 	ON c.TipDocDmd = trr.id
													LEFT JOIN tra_tbMoneda tm 	ON c.MonCuant = tm.id
													LEFT JOIN tra_tbTipoSolicitud ts ON c.idtipsol = ts.id
													LEFT JOIN tra_tbtipoComprobante tc ON c.TipDocEmiCom = tc.id
													LEFT JOIN tra_tbtipoCuantia tu ON c.TipCuant = tu.id
													LEFT JOIN tra_tbusuario u ON c.idUsuario = u.id
													LEFT JOIN tra_tbTipoSolicitud tis ON c.idtipsol = tis.id
													WHERE c.id = ".$id);

   		$query->execute();

    	return $query -> fetch();

	  	$query->close();
   }


  /* ==========================================
   RECEPCION : LISTAR
   ========================================== */
   	public function ListarSolicitudRecepcion($RazSoc,$NroSol,$EstSol){
   		
		$sql = "SELECT  0 as 'row',
						c.id,
						c.NumSol,
						CONCAT(c.FchCreSol,' ',c.HraCreSol) as 'FchCreSol',
						c.RazSocDem,
						c.RazSocDmd,
						e.desSit,
						d.desEst,
						concat(c.id,'-',e.desSit) as idSol,
						concat(c.id,'-',d.desest,'-',COALESCE(r.cnt,0),'-',c.idtipsol) as idSolEst,
						t.destipsol,
						c.dessum,
						c.desref,
						c.idUsuario,
						UPPER(u.nomraz) as nomraz,
						COALESCE(r.cnt,0) as ctnenvio
			FROM tra_tbSolicitud c 
			LEFT JOIN tra_tbestado d ON c.idEst = d.id
			LEFT JOIN tra_tbsituacion e ON c.idSit = e.id
			LEFT JOIN tra_tbTipoSolicitud t ON c.idtipsol = t.id
			LEFT JOIN tra_tbusuario u ON c.idUsuario = u.id
			LEFT JOIN (SELECT 
								idSolicitud,
								count(idruta) as 'cnt'
						  FROM tra_tbSolicitudRutas 
						  WHERE flgEliminado = 'N'
						  GROUP BY idsolicitud) as r ON  c.id = r.idSolicitud
			WHERE COALESCE(c.RazSocDem,'') like '".$RazSoc."'
			AND COALESCE(c.NumSol,'') like '".$NroSol."' 
			AND COALESCE(c.idEst,'') like '".$EstSol."'
			ORDER BY c.FchCreSol DESC,c.HraCreSol DESC";

   		$query = Conexion::conectar()->prepare($sql);

   		$query->execute();

    	return $query -> fetchAll();

	  	$query->close();
   }
   
/* ==========================================
   Listar Solicitud
   ========================================== */
   	public function ListarSolicitud($idUsuario,$NumSol,$flgmsaprt){
   		
   		$CriSel = '';
   		if($NumSol == ''){
   			$CriSel = '%';
   		}else{
			$CriSel = '%'.$NumSol.'%';
   		}
		$sql = "SELECT  0 as 'row',
						c.id,
						c.NumSol,
						c.FchCreSol,
						c.RazSocDem,
						c.RazSocDmd,
						e.desSit,
						d.desEst,
						concat(c.id,'-',e.desSit) as idSol,
						t.destipsol,
						c.dessum,
						c.desref

				FROM tra_tbSolicitud c 
				LEFT JOIN tra_tbestado d ON c.idEst = d.id
				LEFT JOIN tra_tbsituacion e ON c.idSit = e.id
				LEFT JOIN tra_tbTipoSolicitud t ON c.idtipsol = t.id 
					WHERE c.idUsuario = ".$idUsuario." 
					AND c.NumSol like '".$CriSel."' 
					AND t.flgmsaprt = '".$flgmsaprt."'
					AND c.idtipsol = 1
					ORDER BY c.id DESC";

   		$query = Conexion::conectar()->prepare($sql);

   		$query->execute();

    	return $query -> fetchAll();

	  	$query->close();
   }

   /* ==========================================
   Listar Solicitud admitidas 
   ========================================== */
   public function ListarSolicitudAdmitidas($idUsuario,$NumSol,$flgmsaprt){
   	
	$CriSel = '';
	if($NumSol == ''){
		$CriSel = '%';
	}else{
	 $CriSel = '%'.$NumSol.'%';
	}
	$pdo=Conexion::conectar();
	$query = $pdo->prepare('CALL usp_carga_solicitud_admitidas(:idUsuario,:NumSolArb,:flgmsaprt)');
	$query->execute([
					'idUsuario'  => $idUsuario,
					'NumSolArb'  => $CriSel,
					'flgmsaprt'  => $flgmsaprt
					]);
		
	return $query;
	$query->close();

	
}
/* ==========================================
   Registrar Solicitud de Mesa de Partes
   ========================================== */
   public function NuevaSolicitudMesaPartes($idUsuario,$idtipSol,$nomtra,$desSum,$desRef,$idSit,$idEst){
   		
   		$pdo = Conexion::conectar();

   		$query = $pdo->prepare('INSERT INTO tra_tbSolicitud(idUsuario,NumSol,FchCreSol,HraCreSol,idtipsol,nomtra,dessum,desref,idSit,idEst,FchUltMod)
   										VALUES (:idUsuario,"",Now(),curtime(),:idtipsol,:nomtra,:dessum,:desref,:idSit,:idEst,Now())');

   		if ($query->execute(['idUsuario' => $idUsuario,
   							 'idtipsol'  => $idtipSol,
   							 'nomtra'    => $nomtra,
							 'dessum'    => $desSum,
							 'desref'    => $desRef,
							 'idSit'     => $idSit,
							 'idEst'     => $idEst])){
   			$lastInsertId = $pdo->lastInsertId();
   		} else{
        	//Pueden haber errores, como clave duplicada
         	$lastInsertId = 0;
         	echo $query->errorInfo()[2];
    	} 

    	return  $lastInsertId;

   }



/* ==========================================
   Registrar Solicitud
   ========================================== */
   public function NuevaSolicitud($idUsuario,$RazSocDem,$TipDocDem,$NumDocDem,$EscPubDem,$DesDirDem,$ApeNomLeg,$TipDocRep,$NumDocRep,$NumTelRep,$NumCelRep,$DirEmaRep,$TipDocEmiCom,$NumDocEmiCom,$RazSocEmiCom,$RazSocDmd,
								$DesDirDmd,$TipDocDmd,$NumDocDmd,$NumTelDmd,$NumCelDmd,$DirEmaDmd,$AutRepDmd,$ProPubDmd,$DesConArb,$flgCtrDer,$flgCtrCon,$flgCtrNac,$flgCtrInt,$flgEspCtr,$flgEspCiv,$flgEspLey,$flgEspMin,$flgEspCon,$flgEspOtr,$DesNarHec,$DesMedCau,$TipCuant,
								$MonCuant,$ImpNCuant,$ImpLCuant,$ApeNomArb,$DesDirArb,$NumTelArb,$DirEmaArb,$NomProArb,$NumColArb,$FlgRegArb,$FlgPrtArb,$FlgUniArb,$idSit,$idEst){
   		
   		$pdo=Conexion::conectar();

   		$query = $pdo->prepare('INSERT INTO tra_tbSolicitud(idUsuario,NumSol,FchCreSol,HraCreSol,RazSocDem,TipDocDem,NumDocDem,EscPubDem,DesDirDem,ApeNomLeg,TipDocRep,NumDocRep,NumTelRep,NumCelRep,DirEmaRep,TipDocEmiCom,NumDocEmiCom,RazSocEmiCom,
															RazSocDmd,DesDirDmd,TipDocDmd,NumDocDmd,NumTelDmd,NumCelDmd,DirEmaDmd,AutRepDmd,ProPubDmd,DesConArb,flgCtrDer,flgCtrCon,flgCtrNac,flgCtrInt,flgEspCtr,flgEspCiv,flgEspLey,flgEspMin,flgEspCon,flgEspOtr,DesNarHec,DesMedCau,TipCuant,MonCuant,ImpNCuant,ImpLCuant,
															ApeNomArb,DesDirArb,NumTelArb,DirEmaArb,NomProArb,NumColArb,FlgRegArb,FlgPrtArb,FlgUniArb,idtipsol,idSit,idEst,FchUltMod)
   												VALUES (:idUsuario,"",Now(),Curtime(),:RazSocDem,:TipDocDem,:NumDocDem,:EscPubDem,:DesDirDem,:ApeNomLeg,:TipDocRep,:NumDocRep,:NumTelRep,:NumCelRep,:DirEmaRep,:TipDocEmiCom,:NumDocEmiCom,:RazSocEmiCom,
														:RazSocDmd,:DesDirDmd,:TipDocDmd,:NumDocDmd,:NumTelDmd,:NumCelDmd,:DirEmaDmd,:AutRepDmd,:ProPubDmd,:DesConArb,:flgCtrDer,:flgCtrCon,:flgCtrNac,:flgCtrInt,:flgEspCtr,:flgEspCiv,:flgEspLey,:flgEspMin,:flgEspCon,:flgEspOtr,:DesNarHec,:DesMedCau,:TipCuant,
														:MonCuant,:ImpNCuant,:ImpLCuant,:ApeNomArb,:DesDirArb,:NumTelArb,:DirEmaArb,:NomProArb,:NumColArb,:FlgRegArb,:FlgPrtArb,:FlgUniArb,"1",:idSit,:idEst,Now())');
   

   		if ($query->execute(['idUsuario' => $idUsuario,
   							 'RazSocDem' => $RazSocDem,
							 'TipDocDem' => $TipDocDem,
							 'NumDocDem' => $NumDocDem,
							 'EscPubDem' => $EscPubDem,
							 'DesDirDem' => $DesDirDem,
							 'ApeNomLeg' => $ApeNomLeg,
							 'TipDocRep' => $TipDocRep,
							 'NumDocRep' => $NumDocRep,
							 'NumTelRep' => $NumTelRep,
							 'NumCelRep' => $NumCelRep,
							 'DirEmaRep' => $DirEmaRep,
							 'TipDocEmiCom' => $TipDocEmiCom,
							 'NumDocEmiCom' => $NumDocEmiCom,
							 'RazSocEmiCom' => $RazSocEmiCom,
							 'RazSocDmd' => $RazSocDmd,
							 'DesDirDmd' => $DesDirDmd,
							 'TipDocDmd' => $TipDocDmd,
							 'NumDocDmd' => $NumDocDmd,
							 'NumTelDmd' => $NumTelDmd,
							 'NumCelDmd' => $NumCelDmd,
							 'DirEmaDmd' => $DirEmaDmd,
							 'AutRepDmd' => $AutRepDmd,
							 'ProPubDmd' => $ProPubDmd,
							 'DesConArb' => $DesConArb,
							 'flgCtrDer' => $flgCtrDer,
							 'flgCtrCon' => $flgCtrCon,
							 'flgCtrNac' => $flgCtrNac,
							 'flgCtrInt' => $flgCtrInt,
							 'flgEspCtr' => $flgEspCtr,
							 'flgEspCiv' => $flgEspCiv,
							 'flgEspLey' => $flgEspLey,
							 'flgEspMin' => $flgEspMin,
							 'flgEspCon' => $flgEspCon,
							 'flgEspOtr' => $flgEspOtr,
							 'DesNarHec' => $DesNarHec,
							 'DesMedCau' => $DesMedCau,
							 'TipCuant' => $TipCuant,
							 'MonCuant' => $MonCuant,
							 'ImpNCuant' => $ImpNCuant,
							 'ImpLCuant' => $ImpLCuant,
							 'ApeNomArb' => $ApeNomArb,
							 'DesDirArb' => $DesDirArb,
							 'NumTelArb' => $NumTelArb,
							 'DirEmaArb' => $DirEmaArb,
							 'NomProArb' => $NomProArb,
							 'NumColArb' => $NumColArb,
							 'FlgRegArb' => $FlgRegArb,
							 'FlgPrtArb' => $FlgPrtArb,
							 'FlgUniArb' => $FlgUniArb,
							 'idSit' => $idSit,
							 'idEst' => $idEst]))
   		{
   			$lastInsertId = $pdo->lastInsertId();
   		} else{
        	//Pueden haber errores, como clave duplicada
         	$lastInsertId = 0;
         	echo $query->errorInfo()[2];
    	} 

 		//$query -> close();
    	return  $lastInsertId;
   }
   /* ==========================================
   Actualizar Solicitud
   ========================================== */
   public function ActualizaSolicitud($idUsuario,$id,$RazSocDem,$TipDocDem,$NumDocDem,$EscPubDem,$DesDirDem,$ApeNomLeg,$TipDocRep,$NumDocRep,$NumTelRep,$NumCelRep,$DirEmaRep,$TipDocEmiCom,$NumDocEmiCom,$RazSocEmiCom,$RazSocDmd,
								$DesDirDmd,$TipDocDmd,$NumDocDmd,$NumTelDmd,$NumCelDmd,$DirEmaDmd,$AutRepDmd,$ProPubDmd,$DesConArb,$flgCtrDer,$flgCtrCon,$flgCtrNac,$flgCtrInt,$flgEspCtr,$flgEspCiv,$flgEspLey,$flgEspMin,$flgEspCon,$flgEspOtr,$DesNarHec,$DesMedCau,$TipCuant,
								$MonCuant,$ImpNCuant,$ImpLCuant,$ApeNomArb,$DesDirArb,$NumTelArb,$DirEmaArb,$NomProArb,$NumColArb,$FlgRegArb,$FlgPrtArb,$FlgUniArb,$idSit,$idEst){
   		
   		$pdo=Conexion::conectar();

   		$query = $pdo->prepare('UPDATE tra_tbSolicitud
   								SET RazSocDem 	 = :RazSocDem,
									TipDocDem 	 = :TipDocDem,
									NumDocDem 	 = :NumDocDem,
									EscPubDem 	 = :EscPubDem,
									DesDirDem 	 = :DesDirDem,
									ApeNomLeg 	 = :ApeNomLeg,
									TipDocRep 	 = :TipDocRep,
									NumDocRep 	 = :NumDocRep,
									NumTelRep 	 = :NumTelRep,
									NumCelRep 	 = :NumCelRep,
									DirEmaRep 	 = :DirEmaRep,
									TipDocEmiCom = :TipDocEmiCom,
									NumDocEmiCom = :NumDocEmiCom,
									RazSocEmiCom = :RazSocEmiCom,
									RazSocDmd 	 = :RazSocDmd,
									DesDirDmd 	 = :DesDirDmd,
									TipDocDmd 	 = :TipDocDmd,
									NumDocDmd 	 = :NumDocDmd,
									NumTelDmd 	 = :NumTelDmd,
									NumCelDmd 	 = :NumCelDmd,
									DirEmaDmd 	 = :DirEmaDmd,
									AutRepDmd	 = :AutRepDmd,
									ProPubDmd    = :ProPubDmd,
									DesConArb 	 = :DesConArb,
									flgCtrDer 	 = :flgCtrDer,
									flgCtrCon 	 = :flgCtrCon,
									flgCtrNac 	 = :flgCtrNac,
									flgCtrInt 	 = :flgCtrInt,
									flgEspCtr 	 = :flgEspCtr,
									flgEspCiv 	 = :flgEspCiv,
									flgEspLey 	 = :flgEspLey,
									flgEspMin 	 = :flgEspMin,
									flgEspCon 	 = :flgEspCon,
									flgEspOtr 	 = :flgEspOtr,
									DesNarHec 	 = :DesNarHec,
									DesMedCau 	 = :DesMedCau,
									TipCuant 	 = :TipCuant,
									MonCuant 	 = :MonCuant,
									ImpNCuant 	 = :ImpNCuant,
									ImpLCuant 	 = :ImpLCuant,
									ApeNomArb 	 = :ApeNomArb,
									DesDirArb 	 = :DesDirArb,
									NumTelArb 	 = :NumTelArb,
									DirEmaArb 	 = :DirEmaArb,
									NomProArb 	 = :NomProArb,
									NumColArb 	 = :NumColArb,
									FlgRegArb 	 = :FlgRegArb,
									FlgPrtArb 	 = :FlgPrtArb,
									FlgUniArb 	 = :FlgUniArb,
									FchUltMod 	 = Now()
   								WHERE idUsuario = :idUsuario and 
   									  id        = :id'); 

   		$inserted = $query->execute(['idUsuario' 	=> $idUsuario,
   							 		 'RazSocDem' 	=> $RazSocDem,
							 		 'TipDocDem' 	=> $TipDocDem,
							 		 'NumDocDem' 	=> $NumDocDem,
							 		 'EscPubDem' 	=> $EscPubDem,
							 		 'DesDirDem' 	=> $DesDirDem,
							 		 'ApeNomLeg' 	=> $ApeNomLeg,
							 		 'TipDocRep' 	=> $TipDocRep,
							 		 'NumDocRep' 	=> $NumDocRep,
							 		 'NumTelRep' 	=> $NumTelRep,
							 		 'NumCelRep' 	=> $NumCelRep,
							 		 'DirEmaRep' 	=> $DirEmaRep,
							 		 'TipDocEmiCom' => $TipDocEmiCom,
							 		 'NumDocEmiCom' => $NumDocEmiCom,
							 		 'RazSocEmiCom' => $RazSocEmiCom,
							 		 'RazSocDmd' 	=> $RazSocDmd,
							 		 'DesDirDmd' 	=> $DesDirDmd,
							 		 'TipDocDmd' 	=> $TipDocDmd,
							 		 'NumDocDmd' 	=> $NumDocDmd,
							 		 'NumTelDmd' 	=> $NumTelDmd,
							 		 'NumCelDmd' 	=> $NumCelDmd,
							 		 'DirEmaDmd' 	=> $DirEmaDmd,
									 'AutRepDmd'    => $AutRepDmd,
									 'ProPubDmd'    => $ProPubDmd,
							 		 'DesConArb' 	=> $DesConArb,
							 		 'flgCtrDer' 	=> $flgCtrDer,
							 		 'flgCtrCon' 	=> $flgCtrCon,
							 		 'flgCtrNac' 	=> $flgCtrNac,
							 		 'flgCtrInt' 	=> $flgCtrInt,
							 		 'flgEspCtr' 	=> $flgEspCtr,
							 		 'flgEspCiv' 	=> $flgEspCiv,
							 		 'flgEspLey' 	=> $flgEspLey,
							 		 'flgEspMin' 	=> $flgEspMin,
							 		 'flgEspCon' 	=> $flgEspCon,
							 		 'flgEspOtr' 	=> $flgEspOtr,
							 		 'DesNarHec' 	=> $DesNarHec,
							 		 'DesMedCau' 	=> $DesMedCau,
							 		 'TipCuant'  	=> $TipCuant,
							 		 'MonCuant'  	=> $MonCuant,
							 		 'ImpNCuant' 	=> $ImpNCuant,
							 		 'ImpLCuant' 	=> $ImpLCuant,
							 		 'ApeNomArb' 	=> $ApeNomArb,
							 		 'DesDirArb' 	=> $DesDirArb,
							 		 'NumTelArb' 	=> $NumTelArb,
							 		 'DirEmaArb' 	=> $DirEmaArb,
							 		 'NomProArb' 	=> $NomProArb,
							 		 'NumColArb' 	=> $NumColArb,
							 		 'FlgRegArb' 	=> $FlgRegArb,
							 		 'FlgPrtArb' 	=> $FlgPrtArb,
							 		 'FlgUniArb' 	=> $FlgUniArb,
							 		 'id'           => $id]);
   		if(!$inserted){
    		return false;
		}else {
			return true;
		}
   } 

/*  ==========================================
    OBTENER CORRELATIVO
    ========================================== */
   	public function GeneraNumSol(){
  		
  		$pdo=Conexion::conectar();

  		$query = $pdo->prepare('CALL usp_carga_solicitud');

		$query->execute();
		
		return $query -> fetch();

	  	$query->close();
   	}

 /* ========================================
	ACTUALIZAR SOLICITUD ENVIADA
   	========================================*/
    public function EnviaSolicitud($id,$NumSol){
   		
   		$pdo=Conexion::conectar();

   		$query = $pdo->prepare('UPDATE tra_tbSolicitud
   								SET NumSol = :NumSol,
   									idSit = 2,
   									idEst = 2,
									FchUltMod = Now()
   								WHERE id  = :id'); 

   		$query->execute(['id' => $id,'NumSol' => $NumSol]);
   }

/* ========================================
	ACTUALIZAR SOLICITUD ENVIADA
   	========================================*/
    public function CambiarEstado($id,$idEst){
   		
   		$pdo=Conexion::conectar();

   		$query = $pdo->prepare('UPDATE tra_tbSolicitud
   								SET idEst = :idEst,
									FchUltMod = Now()
   								WHERE id  = :id'); 

   		$query->execute(['id' => $id,'idEst' => $idEst]);

   		$count = $query->rowCount();

	   	return $count;

   }
/* ========================================
	GENERA MEDIDA CAUTELAR
   	========================================*/
   public static function GeneraMedidaCautelar($idUsuario,$RazSocDem,$TipDocDem,$NumDocDem,$DesDirDem,$ApeNomLeg,$NumDocRep,$NumTelRep,$NumCelRep,$DirEmaRep,
   											   $EscPubDem,$RazSocEmiCom,$RazSocDmd,$DesDirDmd,$NumTelDmd,$NumCelDmd,$DirEmaDmd,$DesNarHec,$desexicon,$frmejenomper,
   											   $frmejedomper,$frmejetelper,$frmejecelper,$frmejeemaper,$frmejenomemp,$frmejedomemp,$frmejetelemp,$frmejecelemp,$frmejeemaemp,
   											   $desexpcon,$despre01,$despre02,$despre03,$despreadi01,$despreadi02,$despreadi03){
  		
  		$pdo=Conexion::conectar();

  		$query = $pdo->prepare('CALL usp_genera_medida_cautelar(:idUsuario,:RazSocDem,:TipDocDem,:NumDocDem,:DesDirDem,:ApeNomLeg,:NumDocRep,:NumTelRep,:NumCelRep,:DirEmaRep,
  																:EscPubDem,:RazSocEmiCom,:RazSocDmd,:DesDirDmd,:NumTelDmd,:NumCelDmd,:DirEmaDmd,:DesNarHec,:desexicon,:frmejenomper,
  																:frmejedomper,:frmejetelper,:frmejecelper,:frmejeemaper,:frmejenomemp,:frmejedomemp,:frmejetelemp,:frmejecelemp,:frmejeemaemp,
  																:desexpcon,:despre01,:despre02,:despre03,:despreadi01,:despreadi02,:despreadi03)');

			$query->execute(['idUsuario' 	=> $idUsuario,
						    'RazSocDem' 	=> $RazSocDem,
						    'TipDocDem' 	=> $TipDocDem,
						    'NumDocDem' 	=> $NumDocDem,
						    'DesDirDem' 	=> $DesDirDem,
						    'ApeNomLeg' 	=> $ApeNomLeg,
						    'NumDocRep' 	=> $NumDocRep,
						    'NumTelRep' 	=> $NumTelRep,
						    'NumCelRep' 	=> $NumCelRep,
						    'DirEmaRep' 	=> $DirEmaRep,
						    'EscPubDem' 	=> $EscPubDem,
						    'RazSocEmiCom'  => $RazSocEmiCom,
						    'RazSocDmd' 	=> $RazSocDmd,
						    'DesDirDmd' 	=> $DesDirDmd,
						    'NumTelDmd' 	=> $NumTelDmd,
						    'NumCelDmd' 	=> $NumCelDmd,
						    'DirEmaDmd' 	=> $DirEmaDmd,
						    'DesNarHec' 	=> $DesNarHec,
						    'desexicon' 	=> $desexicon,
						    'frmejenomper'  => $frmejenomper,
						    'frmejedomper'  => $frmejedomper,
						    'frmejetelper'  => $frmejetelper,
						    'frmejecelper'  => $frmejecelper,
						    'frmejeemaper'  => $frmejeemaper,
						    'frmejenomemp'  => $frmejenomemp,
						    'frmejedomemp'  => $frmejedomemp,
						    'frmejetelemp'  => $frmejetelemp,
						    'frmejecelemp'  => $frmejecelemp,
						    'frmejeemaemp'  => $frmejeemaemp,
						    'desexpcon' 	=> $desexpcon,
						    'despre01' 	    => $despre01,
						    'despre02' 	    => $despre02,
						    'despre03' 	    => $despre03,
						    'despreadi01' 	=> $despreadi01,
						    'despreadi02' 	=> $despreadi02,
						    'despreadi03' 	=> $despreadi03]);
			
		return $query -> fetch();

	  	$query->close();
   	}
   	/* ========================================
	LISTA MEDIDA CAUTELAR
   	========================================*/
   	public static function ListarMedidaCautelar($idUsuario){

  		$query = Conexion::conectar()->prepare("SELECT
  													s.id, 
													s.idUsuario,
													s.NumSol,
													s.FchCreSol,
													s.HraCreSol,
													s.RazSocDem,
													s.TipDocDem,
													s.NumDocDem,
													s.DesDirDem,
													s.ApeNomLeg,
													s.TipDocRep,
													s.NumDocRep,
													s.NumTelRep,
													s.NumCelRep,
													s.DirEmaRep,
													s.RazSocEmiCom,
													s.RazSocDmd,
													s.DesDirDmd,
													s.NumTelDmd,
													s.NumCelDmd,
													s.DirEmaDmd,
													s.EscPubDem,
													s.DesNarHec,
													s.idtipsol,
													s.idSit,
													i.desSit,
													s.idEst,
													e.desest,
													s.FchUltMod,
													s.desexicon,
													s.frmejenomper,
													s.frmejedomper,
													s.frmejetelper,
													s.frmejecelper,
													s.frmejeemaper,
													s.frmejenomemp,
													s.frmejedomemp,
													s.frmejetelemp,
													s.frmejecelemp,
													s.frmejeemaemp,
													s.desexpcon,
													s.despre01,
													s.despre02,
													s.despre03,
													s.despreadi01,
													s.despreadi02,
													s.despreadi03
													FROM tra_tbSolicitud s
													INNER JOIN tra_tbsituacion i on s.idSit = i.id
													INNER JOIN tra_tbestado e on s.idEst = e.id
													WHERE s.idUsuario = :idUsuario
													AND s.idtipsol = 43
													ORDER BY s.id DESC");

   		$query->execute(['idUsuario' => $idUsuario]);

    	return $query -> fetchAll();

	  	$query->close(); 		
   	}
}
?>