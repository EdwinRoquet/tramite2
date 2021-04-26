<?php 
require_once "db.php";

class SolicitudPretension{

	/*
		idSolicitud		INT				NOT NULL --> Codigo de Solicitud
		idPretension	INT				NOT NULL --> Codigo de Pretensión
		desPretension	VARCHAR(150)	NOT NULL --> Descripción de Pretensión
	*/
	
	/*=============================================
	  Listar Pretensiones
	  =============================================*/
	  public function ListarSolicitudPretension($idSolicitud){

	  	$query = Conexion::conectar()->prepare("SELECT idSolicitud,idPretension,desPretension FROM tra_tbSolicitudPretension WHERE idSolicitud = ".$idSolicitud);

   		$query->execute();

    	return $query -> fetchAll();

	  	$query->close();
	  }

	 /*=============================================
	  Registar Pretensiones
	  =============================================*/
	  public function NuevaSolicitudPretension($idSolicitud,$idPretension,$desPretension){

	  	$pdo=Conexion::conectar();

		$query = $pdo->prepare('INSERT INTO tra_tbSolicitudPretension(idSolicitud,idPretension,desPretension) 
									 VALUES (:idSolicitud,:idPretension,:desPretension)');

		$query->execute(['idSolicitud' => $idSolicitud,
						 'idPretension' => $idPretension,
						 'desPretension' => $desPretension]);
	  }

	  /*=============================================
	  Borrar Pretensiones
	  =============================================*/
	  public function BorrarSolicitudPretension($idSolicitud){

	  	$pdo = Conexion::conectar();

		$query = $pdo->prepare('DELETE FROM tra_tbSolicitudPretension WHERE idSolicitud = :idSolicitud');

		$query->execute(['idSolicitud' => $idSolicitud]);
   
	  }

}?>