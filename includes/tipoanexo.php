<?php 

require_once 'db.php';


/**
 * Clase : Tipo de Anexos
 */
class TipoAnexo
{
	
	/*========================================
	LISTA DE TIPOS DE ANEXOS
	==========================================*/
	public function listartipoAnexo()
	{
		$query = Conexion::conectar()->prepare("SELECT id,desanx FROM tra_tbtipoAnexo");
    	
    	$query->execute();

    	return $query -> fetchAll();

	  	$query->close();	
	}

}
 ?>