<?php 

include_once "db.php";

class solicitudrespuesta{
	/*=====================================================
	Validar Valor token 
	=======================================================*/
	public static function ValidaToken($idRespuesta,$ValSegTok){
		
		$query = conexion::conectar()->prepare('SELECT id FROM respuestasolicitud where ClaSegTok = :ValSegTok');

		$query->execute(['ValSegTok' => $ValSegTok]);

		$count = $query->rowCount();

	   	return $count;

	}

	/*=====================================================
	Consultar data de respuesta pendiente
	=======================================================*/	
	public static function ActualizarRespuesta($idRespuesta,$DesDirDmd,$ValSegTok,$NomRepLeg,$TipDocRep,$NumDocRep,$NumTelRep,$NumCelRep,$DirEmaRep,$ApeNomArb,
											   $DesDirArb,$NumTelArb,$DirEmaArb,$NomProArb,$NumColArb,$FlgRegArb,$FlgPrtArb,$FlgUniArb,$PosPrtDmd,$PreRecDmd,
											   $CuaCtrdmd,$NomFil01,$NomFil02,$NomFil03,$DirFil01,$DirFil02,$DirFil03){

		$query = Conexion::conectar()->prepare('UPDATE respuestasolicitud
												SET DesDirDmd = :DesDirDmd,
													ValSegTok = :ValSegTok,
													ApeNomLeg = :ApeNomLeg,
													TipDocRep = :TipDocRep,
													NumDocRep = :NumDocRep,
													NumTelRep = :NumTelRep,
													NumCelRep = :NumCelRep,
													DirEmaRep = :DirEmaRep,
													ApeNomArb = :ApeNomArb,
													DesDirArb = :DesDirArb, 
													NumTelArb = :NumTelArb,
													DirEmaArb = :DirEmaArb,
													NomProArb = :NomProArb,
													NumColArb = :NumColArb,
													FlgRegArb = :FlgRegArb,
													FlgPrtArb = :FlgPrtArb,
													FlgUniArb = :FlgUniArb,
													PosPrtDmd = :PosPrtDmd,
													PreRecDmd = :PreRecDmd,
													CuaCtrdmd = :CuaCtrdmd,
													NomFil01  = :NomFil01,
													NomFil02  = :NomFil02,
													NomFil03  = :NomFil03,
													DirFil01  = :DirFil01,
													DirFil02  = :DirFil02,
													DirFil03  = :DirFil03,
													fchmodifica = curdate(),
													hramodifica = curtime()
												WHERE id = :id');

		$query->execute(['id' 		 => $idRespuesta,
						 'DesDirDmd' => $DesDirDmd,
						 'ValSegTok' => $ValSegTok,
						 'ApeNomLeg' => $NomRepLeg,
						 'TipDocRep' => $TipDocRep,
						 'NumDocRep' => $NumDocRep,
						 'NumTelRep' => $NumTelRep,
						 'NumCelRep' => $NumCelRep,
						 'DirEmaRep' => $DirEmaRep,
						 'ApeNomArb' => $ApeNomArb,
						 'DesDirArb' => $DesDirArb,
						 'NumTelArb' => $NumTelArb,
						 'DirEmaArb' => $DirEmaArb,
						 'NomProArb' => $NomProArb,
						 'NumColArb' => $NumColArb,
						 'FlgRegArb' => $FlgRegArb,
						 'FlgPrtArb' => $FlgPrtArb,
						 'FlgUniArb' => $FlgUniArb,
						 'PosPrtDmd' => $PosPrtDmd,
						 'PreRecDmd' => $PreRecDmd,
						 'CuaCtrdmd' => $CuaCtrdmd,
						 'NomFil01'  => $NomFil01,
						 'NomFil02'  => $NomFil02,
						 'NomFil03'  => $NomFil03,
						 'DirFil01'  => $DirFil01,
						 'DirFil02'  => $DirFil02,
						 'DirFil03'  => $DirFil03
						]);
		$count = $query->rowCount();

	   	return $count;

	}

	/*=====================================================
	Consultar data de respuesta pendiente
	=======================================================*/
	public static function GenerarNuevaRespuesta($idsolicitud,$UsrDmd,$RazSocDmd,$TipDocDmd,$NumDocDmd,$DirEmaDmd,$ClaSegTok,$usrcreacion){

		$query = Conexion::conectar()->prepare('INSERT INTO respuestasolicitud(idsolicitud,UsrDmd,RazSocDmd,TipDocDmd,NumDocDmd,DirEmaDmd,ClaSegTok,usrcreacion,fchcreacion,hracreacion)
													 VALUES(:idsolicitud,:UsrDmd,:RazSocDmd,:TipDocDmd,:NumDocDmd,:DirEmaDmd,:ClaSegTok,:usrcreacion,curdate(),curtime())');

		$query->execute(['idsolicitud' => $idsolicitud,
						 'UsrDmd'	   => $UsrDmd,
						 'RazSocDmd'   => $RazSocDmd,
						 'TipDocDmd'   => $TipDocDmd,
						 'NumDocDmd'   => $NumDocDmd,
						 'DirEmaDmd'   => $DirEmaDmd,
						 'ClaSegTok'   => $ClaSegTok,
						 'usrcreacion' => $usrcreacion]);

		$count = $query->rowCount();

	   	return $count;

	}

	/*=====================================================
	Obtener datos de respuesta en función a solicitud
	=======================================================*/	
	public static function ObtenerRespuestaSolicitud($idSolicitud){
		
		$consulta = Conexion::conectar()->prepare('SELECT id,idsolicitud,RazSocDmd,TipDocDmd,NumDocDmd,DesDirDmd,DirEmaDmd,ClaSegTok,ValSegTok,ApeNomLeg,
														  TipDocRep,NumDocRep,NumTelRep,NumCelRep,DirEmaRep,ApeNomArb,DesDirArb,NumTelArb,DirEmaArb,NomProArb,
														  NumColArb,FlgRegArb,FlgPrtArb,FlgUniArb,PosPrtDmd,PreRecDmd,CuaCtrdmd,usrcreacion,fchcreacion,hracreacion,
														  usrmodifica,fchmodifica,hramodifica,NomFil01,NomFil02,NomFil03,DirFil01,DirFil02,DirFil03
													FROM respuestasolicitud WHERE idsolicitud = :idSolicitud');

		$consulta->execute(['idSolicitud' => $idSolicitud]);

		return $consulta->fetch();

		$consulta->close();
	}

	/*=====================================================
	Consultar data de respuesta pendiente
	=======================================================*/	
	public static function ObtenerRespuestaPendiente($idRespuesta){
		
		$consulta = Conexion::conectar()->prepare('SELECT id,idsolicitud,RazSocDmd,TipDocDmd,NumDocDmd,DesDirDmd,DirEmaDmd,ClaSegTok,ValSegTok,ApeNomLeg,
														  TipDocRep,NumDocRep,NumTelRep,NumCelRep,DirEmaRep,ApeNomArb,DesDirArb,NumTelArb,DirEmaArb,NomProArb,
														  NumColArb,FlgRegArb,FlgPrtArb,FlgUniArb,PosPrtDmd,PreRecDmd,CuaCtrdmd,usrcreacion,fchcreacion,hracreacion,
														  usrmodifica,fchmodifica,hramodifica,NomFil01,NomFil02,NomFil03,DirFil01,DirFil02,DirFil03
													FROM respuestasolicitud WHERE id = :id');

		$consulta->execute(['id' => $idRespuesta]);

		return $consulta->fetch();

		$consulta->close();
	}

	/*=====================================================
	Listado de respuesta pendientes por usuario
	=======================================================*/
	public static function RespuestasPendientesPorUsuario($idUsuario){
		$consulta = Conexion::conectar()->prepare('SELECT 
														r.id,
														r.idsolicitud,
														r.UsrDmd,
														r.RazSocDmd,
														r.TipDocDmd,
														r.NumDocDmd,
														r.DesDirDmd,
														r.DirEmaDmd,
														r.ClaSegTok,
														r.ValSegTok,
														r.ApeNomLeg,
														r.TipDocRep,
														r.NumDocRep,
														r.NumTelRep,
														r.NumCelRep,
														r.DirEmaRep,
														r.ApeNomArb,
														r.DesDirArb,
														r.NumTelArb,
														r.DirEmaArb,
														r.NomProArb,
														r.NumColArb,
														r.FlgRegArb,
														r.FlgPrtArb,
														r.FlgUniArb,
														r.PosPrtDmd,
														r.PreRecDmd,
														r.CuaCtrdmd,
														r.usrcreacion,
														r.fchcreacion,
														r.hracreacion,
														r.usrmodifica,
														r.fchmodifica,
														r.hramodifica,
														s.NumSol,
														s.RazSocDem,
														s.fchCreSol,
														e.desSit,
														d.desEst,
														r.NomFil01,
														r.NomFil02,
														r.NomFil03,
														r.DirFil01,
														r.DirFil02,
														r.DirFil03
												FROM respuestasolicitud r
												INNER JOIN tra_tbSolicitud s ON r.idsolicitud = s.id
												LEFT JOIN tra_tbsituacion e ON s.idSit = e.id
												LEFT JOIN tra_tbestado d ON s.idEst = d.id
												WHERE r.UsrDmd = :UsrDmd');

		$consulta->execute(['UsrDmd' => $idUsuario]);

		return $consulta ->fetchAll();

		$consulta->close();
	}
}
?>
