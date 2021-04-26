<?php 

require_once 'db.php';

class SolicitudAnexo{

	/*
		idSolicitud 	INT				NOT NULL,  --> Codigo de Solicitud
		idAnexo         INT				NOT NULL,  --> Codigo de Anexo
		idTipo          VARCHAR(2)		NULL,      --> Codigo de tipo de anexo
		nomFileLoc      VARCHAR(250)	NULL,      --> Nombre de archivo local
		nomFileSer  	VARCHAR(250)	NULL,      --> Nombre de archivo genetrado en servidor
		flgEliminado	VARCHAR(1)		NULL,      --> indicador de archivo eliminado
	*/
	/*=============================================
	  Listar Anexos
	  =============================================*/
	  public function ListarSolicitudAnexo($idSolicitud){

	  	$query = Conexion::conectar()->prepare("SELECT c.idSolicitud,c.idAnexo,c.idTipo,d.desanx,c.nomFileLoc,c.nomFileSer,c.flgEliminado 
												FROM tra_tbSolicitudAnexo c 
												LEFT JOIN tra_tbtipoAnexo d
												ON c.idtipo = d.id
												WHERE c.flgEliminado = 'N' and c.idSolicitud = ".$idSolicitud);
   		$query->execute();

    	return $query -> fetchAll();

	  	$query->close();
	  }
 
	  /*=============================================
	  Agregar Anexos (Nueva Versión)
	  =============================================*/
	  public function AgregarAnexo($idSolicitud,$idTipo,$nomFileLoc,$nomFileSer,$flgEliminado){
  		
  		$pdo=Conexion::conectar();

  		$query = $pdo->prepare('CALL usp_agregar_anexo(:idSolicitud,:idTipo,:nomFileLoc,:nomFileSer,:flgEliminado)');

		$query->execute(['idSolicitud' => $idSolicitud,
						 'idTipo' => $idTipo,
						 'nomFileLoc' => $nomFileLoc,
						 'nomFileSer' => $nomFileSer,
						 'flgEliminado' => $flgEliminado]);
   	}

   	/*=============================================
	  Eliminar Anexos
	  =============================================*/
	  public function EliminarAnexo($idSolicitud,$idAnexo){

	  	$pdo=Conexion::conectar();

		$query = $pdo->prepare('UPDATE tra_tbSolicitudAnexo SET flgEliminado = "S" WHERE idSolicitud = :idSolicitud AND idAnexo = :idAnexo');

		$query->execute(['idSolicitud' => $idSolicitud,
						 'idAnexo' => $idAnexo]);
	  }

}
?>