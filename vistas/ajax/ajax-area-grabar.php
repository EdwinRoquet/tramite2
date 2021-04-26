<?php 

/* ====================
	EDITAR DATOS DE AREA
	=======================*/

	include_once '../../includes/area.php';

	$Area 	= new Area();


	if (isset($_POST)) {
		
		/*==================
		CAPTURAR DATOS
		====================*/
		$id 		= $_POST['idArea'];
		if($id == ''){
			/*==================
			INSERTAR AREA
			====================*/
			$desarea   = $_POST['desarea'];
			$idUsuario = $Area->InsertarArea($desarea);
			echo "1";
		}else{

			/*==================
			ACTUALIZAR AREA
			====================*/
			// echo "2";
			
			$desarea		= $_POST['desarea'];
			$Area-> ActualizarArea($id,$desarea);
		}
	}

	// Retornar clave generada o editada
	echo $id;
 ?>