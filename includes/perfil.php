<?php 

require_once 'db.php';
/*	
	Clase : perfil
*/

	class Perfil
	{
		/*========================================
		LISTA DE AREAS
		==========================================*/
		public function listarPerfil()
		{
			$query = Conexion::conectar()->prepare("SELECT id,desperfil,flgusuario,flgdocinterno,flgmesapartes,flgatencion,flgatendidos FROM tra_tbperfil;;");
    	
	    	$query->execute();

    		return $query -> fetchAll();

	  		$query->close();	
		}
	}
 ?>