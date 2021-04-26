<?php 

require_once 'db.php';


/**
 * Clase : Situación
 */
class Situacion
{
	
	/*========================================
	LISTA DE ESTADOS
	==========================================*/
	public function listarSituacion()
	{
		$query = Conexion::conectar()->prepare("SELECT id,dessit FROM tra_tbSituacion;");
    	
    	$query->execute();

    	return $query -> fetchAll();

	  	$query->close();	
	}

}
 ?>