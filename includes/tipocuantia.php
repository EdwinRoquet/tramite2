<?php 

require_once 'db.php';


/**
 * Clase : Tipo de cuantia
 */
class TipoCuantia
{
	
	/*========================================
	LISTA DE TIPOS DE COMPROBANTE
	==========================================*/
	public function listartipoCuantia()
	{
		$query = Conexion::conectar()->prepare("SELECT id,destip FROM tra_tbtipoCuantia");
    	
    	$query->execute();

    	return $query -> fetchAll();

	  	$query->close();	
	}

}
 ?>