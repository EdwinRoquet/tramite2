<?php 
require_once "db.php";

class SolicitudObservacion{

/*
	idSolicitud			 	INT				NOT NULL 	--> Codigo de Solicitud
	idObservacion			INT				NOT NULL 	--> Codigo de Observación
	idarea					INT 			NULL 		--> Codigo de área que genero la observación
	asunto					VARCHAR(150)	NULL 		--> Asunto de observación
	desObservacion			VARCHAR(150)	NULL 		--> Descripción de Observación
	nomFileLoc				VARCHAR(250)	NULL,		--> Nombre de archivo local
	nomFileSer				VARCHAR(250)	NULL,		--> Nombre de archivo en servidor
	idUsuario				INT 			NOT NULL 	--> Codigo de Usuario
	fchCreacion				DATE			NULL 		--> Fecha de creación
	hraCreacion				DATE			NULL 		--> Hora de creación
	);
*/

	/*=============================================
  	AGREGAR OBSERVACIONES
	=============================================*/
  	public function AgregarObservacion($idSolicitud,$idArea,$asunto,$desObservacion,$nomFileLoc,$nomFileSer,$idUsuario){
 		
		$pdo=Conexion::conectar();

  		$query = $pdo->prepare('CALL usp_agregar_observacion(:idSolicitud,:idarea,:asunto,:desObservacion,:nomFileLoc,:nomFileSer,:idUsuario)');

		$query->execute(['idSolicitud' 		=> $idSolicitud,
						 'idarea'			=> $idArea,
						 'asunto'			=> $asunto,
						 'desObservacion' 	=> $desObservacion,
						 'nomFileLoc' 		=> $nomFileLoc,
						 'nomFileSer' 		=> $nomFileSer,
						 'idUsuario'		=> $idUsuario]);
   	}
	/*=============================================
	LISTAR OBSERVACIONES
	=============================================*/
	public function ListarObservacion($idUsuario){
 		
		$pdo=Conexion::conectar();

  		$query = $pdo->prepare('SELECT 	so.idSolicitud,
										so.idObservacion,
										so.desObservacion,
										so.nomFileLoc,
										so.nomFileSer,
										so.idUsuario,
										so.fchCreacion,
										so.hraCreacion,
										so.idarea,
										a.desarea,
										so.asunto,
										s.numsol
							FROM tra_tbSolicitudObservacion so
							INNER JOIN tra_tbSolicitud s ON so.idSolicitud = s.id
							LEFT JOIN tra_tbarea a on so.idarea = a.id
							WHERE s.idUsuario = :idusuario
							ORDER BY so.fchCreacion DESC,so.hraCreacion DESC');

		$query->execute(['idusuario' => $idUsuario]);

		return $query -> fetchAll();

		$query->close();	
   	}

}

?>
