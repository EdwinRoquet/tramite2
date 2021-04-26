<?php 

require_once 'db.php';


/**
 * Clase : Estado
 */
class Estado
{
	
	/*========================================
	LISTA DE ESTADOS
	==========================================*/
	public function listarEstado()
	{
		$query = Conexion::conectar()->prepare("SELECT id,desest FROM tra_tbestado");
    	
    	$query->execute();

    	return $query -> fetchAll();

	  	$query->close();	
	}

}
 ?>