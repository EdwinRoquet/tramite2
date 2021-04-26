<?php 

require_once 'db.php';


/**
 * Clase : Tipo de Anexos
 */
class Moneda
{
	
	/*========================================
	LISTA DE TIPOS DE ANEXOS
	==========================================*/
	public function listarMoneda()
	{
		$query = Conexion::conectar()->prepare("SELECT id,SimMon,DesMon FROM tra_tbMoneda;");
    	
    	$query->execute();

    	return $query -> fetchAll();

	  	$query->close();	
	}

}
 ?>