<?php 

require_once 'db.php';
/*	
	Clase : cargo
*/

	class Cargo
	{
		/*========================================
		LISTA DE CARGOS
		==========================================*/
		public function listarCargo()
		{
			$query = Conexion::conectar()->prepare("SELECT id,descargo FROM tra_tbcargo");
    	
	    	$query->execute();

    		return $query -> fetchAll();

	  		$query->close();	
		}
	}
 ?>