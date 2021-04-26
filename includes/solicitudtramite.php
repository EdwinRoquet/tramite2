<?php 

require_once "db.php";

class solicitudtramite{
	/*---------------------------------------------------------
	REGISTRAR TRAMITE
	---------------------------------------------------------*/
	public static function registrartramite($idsolicitud,$idsumilla,$nomtramite,$referencia,$detalle,$nomfileloc,$nomfileser){

  		$query = Conexion::conectar()->prepare('CALL usp_registrar_tramite(:idsolicitud,:idsumilla,:nomtramite,:referencia,:detalle,:nomfileloc,:nomfileser)');

		$query->execute(['idsolicitud' 	=> $idsolicitud,
						 'idsumilla' 	=> $idsumilla,
						 'nomtramite'	=> $nomtramite,
						 'referencia'	=> $referencia,
						 'detalle'		=> $detalle,
						 'nomfileloc' 	=> $nomfileloc,
						 'nomfileser' 	=> $nomfileser]);
	}
	/*---------------------------------------------------------
	LISTAR TRAMITE
	---------------------------------------------------------*/
	public static function listartramite($idsolicitud){

		$query = Conexion::conectar()->prepare("SELECT 	t.idsolicitud,
														t.idtramite,
														t.idsumilla,
														s.destipsol,
														t.nomtramite,
														t.referencia,
														t.detalle,
														t.nomfileloc,
														t.nomfileser,
														t.fchcreacion,
														t.hracreacion
												FROM tbsolicitudtramite t
												INNER JOIN tra_tbTipoSolicitud s
												ON t.idsumilla = s.id
												WHERE t.idsolicitud = :idsolicitud");
    	
	    $query->execute(['idsolicitud' => $idsolicitud]);

    	return $query -> fetchAll();

	  	$query->close();
	}
}

?>