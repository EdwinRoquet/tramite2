<?php 

require_once 'db.php';


/**
 * Clase : Tipo de Anexos
 */
class TipoComprobante
{
	
	/*========================================
	LISTA DE TIPOS DE COMPROBANTE
	==========================================*/
	public function listartipoComprobante()
	{
		$query = Conexion::conectar()->prepare("SELECT id,destip FROM tra_tbtipoComprobante");
    	
    	$query->execute();

    	return $query -> fetchAll();

	  	$query->close();	
	}

}
 ?>