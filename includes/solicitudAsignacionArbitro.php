<?php 
require_once "db.php";

class SolicitudAsignacionArbitro{

	/*
		idSolicitud		INT				NOT NULL --> Codigo de Solicitud
		idPretension	INT				NOT NULL --> Codigo de Pretensión
		desPretension	VARCHAR(150)	NOT NULL --> Descripción de Pretensión
	*/
	
	
	 /*=============================================
	  Registar solicitud arbitral
	  =============================================*/
	  public function NuevaSolicitudArbitral($id_solicitud,$nombre,$direccion,$celular,$mail,$profesion,$n_colegiatura,$osce,$tipo_arbitro){

	  	$pdo=Conexion::conectar();

  		$query = $pdo->prepare('CALL usp_registra_arbitro(:id_solicitud,:nombre,:direccion,:celular,:mail,:profesion,:n_colegiatura,:osce,:tipo_arbitro)');

		$query->execute(['id_solicitud'  => $id_solicitud,
						 'nombre'  => $nombre,
						 'direccion'  => $direccion,
						 'celular'  => $celular,
						 'mail'  => $mail,
						 'profesion'  => $profesion,
						 'n_colegiatura'  => $n_colegiatura,
						 'osce'  => $osce,
						 'tipo_arbitro'   => $tipo_arbitro]);

		return $query;

        
	  }

	  

}?>