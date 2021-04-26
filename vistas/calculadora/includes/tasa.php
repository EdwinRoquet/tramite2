<?php 

require_once 'db.php';


	class Tasa
	{
		
		/* ==========================================
		Listar Tasa
		========================================== */
		// public static function  ListarTasa(){
		// 	$query = Conexion::conectar()->prepare('SELECT*
		// 												FROM tra_tbtasas
		// 												WHERE id_registro');

		// 	$query->execute();

		// 	return $query->fetchAll();
		// 	// $query->close();	

		// }

        		/* ==========================================
		Listar Tasa
		========================================== */
		public static function  ListarTasa($desarea){
			$query = Conexion::conectar()->prepare('SELECT*
														FROM tra_tbtasas
														WHERE id_registro LIKE :desarea');

			$query->execute(['desarea' => $desarea]);

			return $query;
			$query->close();	

		}
		
		public function ListarTasaTipoCambio($tipo_calculo)
		{
			$query = Conexion::conectar()->prepare('SELECT*
														FROM tra_tbtasas
														WHERE tipo_calculo =:tipo_calculo	');

			$query->execute(['tipo_calculo' => $tipo_calculo]);

			return $query->fetchAll();
			// $query->close();	
		}
		


	}
	
 ?>