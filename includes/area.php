<?php 

require_once 'db.php';
/*	
	Clase : area
*/

	class Area
	{
		/*========================================
		LISTA DE AREAS
		==========================================*/
		public function listarArea()
		{
			$query = Conexion::conectar()->prepare("SELECT id,desarea FROM tra_tbarea");
    	
	    	$query->execute();

    		return $query -> fetchAll();

	  		$query->close();	
		}

		/* ==========================================
		Listar Area
		========================================== */
		public static function  ListarAreaA($desarea){
			$query = Conexion::conectar()->prepare('SELECT id,desarea
														FROM tra_tbarea
														WHERE desarea LIKE :desarea');

			$query->execute(['desarea' => $desarea]);

			return $query;
			$query->close();	

		}

   /* ==========================================
   INSERTAR AREA (SISTEMA)
   ========================================== */
   		public function InsertarArea($desarea){
        
			$flat=0;
			$id=0;
			$pdo=Conexion::conectar();
			$query = $pdo->prepare('CALL usp_mantenimiento_area(:flat,:id,:desarea)');

			$query->execute(['flat'  	=> $flat,
							 'id'  		=> $id,
							 'desarea'  => $desarea,
							]);

			return $query->rowCount();;
			$query->close();

		
		}

		public function EditarArea($id){
        
			$query = Conexion::conectar()->prepare('SELECT *
                                                FROM tra_tbarea WHERE id = :id');
			
			$query->execute(['id' => $id]);

			return $query -> fetch();
	
		}

		public function ActualizarArea($id,$desarea)
		{
			$flat=1;
			$pdo=Conexion::conectar();
			$query = $pdo->prepare('CALL usp_mantenimiento_area(:flat,:id,:desarea)');

			$query->execute(['flat'  	=> $flat,
							 'id'  		=> $id,
							 'desarea'  => $desarea,
							]);

			return $query->rowCount();;
			$query->close();
		}

		public function EliminarArea($id)
		{
			$desarea=0;
			$flat=2;
			$pdo=Conexion::conectar();
			$query = $pdo->prepare('CALL usp_mantenimiento_area(:flat,:id,:desarea)');

			$query->execute(['flat'  	=> $flat,
							'id'  		=> $id,
							'desarea'   => $desarea,
							]);

			return $query->rowCount();;
			$query->close();
		}
	
		


	}
	
 ?>