<?php 

require_once 'db.php';
/*	
	Clase : area
*/

	class Tasa
	{
		
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

   /* ==========================================
   INSERTAR TASA (SISTEMA)
   ========================================== */
   		public function InsertarTasa($cuantia_minimo,$cuantia_maximo,$porcentaje,$monto_minimo,$monto_maximo,$tipo_calculo){
        
			$flat		=1;
			$idRegistro =0;
			$pdo=Conexion::conectar();
			$query = $pdo->prepare('CALL usp_mantenimiento_tasas(:flat,:idRegistro,:cuantia_minimo,:cuantia_maximo,:porcentaje,:monto_minimo,:monto_maximo,:tipo_calculo)');

			$query->execute(['flat'  		=> $flat,
							 'idRegistro'  	=> $idRegistro,
							 'cuantia_minimo'  	=> $cuantia_minimo,
							 'cuantia_maximo'  	=> $cuantia_maximo,
							 'porcentaje'       => $porcentaje,
							 'monto_minimo'     => $monto_minimo,
							 'monto_maximo'     => $monto_maximo,
							 'tipo_calculo'     => $tipo_calculo,
							]);

			return $query->rowCount();;
			$query->close();

		
		}

		public function EditarTasa($id_registro){
        
			$query = Conexion::conectar()->prepare('SELECT *
                                                FROM tra_tbtasas WHERE id_registro = :id_registro');
			
			$query->execute(['id_registro' => $id_registro]);

			return $query -> fetch();
	
		}

		public function ActualizarTasa($idRegistro,$cuantia_minimo,$cuantia_maximo,$porcentaje,$monto_minimo,$monto_maximo,$tipo_calculo)
		{
			$flat		=4;
			$pdo=Conexion::conectar();
			$query = $pdo->prepare('CALL usp_mantenimiento_tasas(:flat,:idRegistro,:cuantia_minimo,:cuantia_maximo,:porcentaje,:monto_minimo,:monto_maximo,:tipo_calculo)');

			$query->execute(['flat'  		=> $flat,
							 'idRegistro'  	=> $idRegistro,
							 'cuantia_minimo'  	=> $cuantia_minimo,
							 'cuantia_maximo'  	=> $cuantia_maximo,
							 'porcentaje'       => $porcentaje,
							 'monto_minimo'     => $monto_minimo,
							 'monto_maximo'     => $monto_maximo,
							 'tipo_calculo'     => $tipo_calculo,
							]);

			return $query->rowCount();;
			$query->close();
		}

		public function EliminarTasa($idRegistro)
		{
			$flat		     =3;
			$cuantia_minimo  =0;   
			$cuantia_maximo  =0;   
			$porcentaje      =0;
			$monto_minimo    =0;
			$monto_maximo    =0;
			$tipo_calculo    =0;
			$pdo=Conexion::conectar();
			$query = $pdo->prepare('CALL usp_mantenimiento_tasas(:flat,:idRegistro,:cuantia_minimo,:cuantia_maximo,:porcentaje,:monto_minimo,:monto_maximo,:tipo_calculo)');

			$query->execute(['flat'  		=> $flat,
							 'idRegistro'  	=> $idRegistro,
							 'cuantia_minimo'  	=> $cuantia_minimo,
							 'cuantia_maximo'  	=> $cuantia_maximo,
							 'porcentaje'       => $porcentaje,
							 'monto_minimo'     => $monto_minimo,
							 'monto_maximo'     => $monto_maximo,
							 'tipo_calculo'     => $tipo_calculo,
							]);

			return $query->rowCount();
			$query->close();

		}
		
		public function ListarTasaTipoCambio($tipo_calculo)
		{
			$query = Conexion::conectar()->prepare('SELECT*
														FROM tra_tbtasas
														WHERE tipo_calculo =:tipo_calculo	');

			$query->execute(['tipo_calculo' => $tipo_calculo]);

			return $query;
			$query->close();	
		}
		


	}
	
 ?>