<?php 

/* ====================
	EDITAR DATOS DE TASA
	=======================*/

	include_once '../../includes/tasa.php';

	$Tasa 	= new Tasa();


	if (isset($_POST)) {
		
		/*==================
		CAPTURAR DATOS
		====================*/
		$idRegistro    = $_POST['idRegistro'];
		if($idRegistro == ''){
			/*==================
			INSERTAR TASA
			====================*/
			$textcuantiaMinima = $_POST['TextcuantiaMinima'];
			$textcuantiaMaxima = $_POST['TextcuantiaMaxima'];
			$textPorcentaje    = $_POST['textPorcentaje'];
			$textMontoMinimo   = $_POST['textMontoMinimo'];
			$textMontoMaximo   = $_POST['textMontoMaximo'];
			$cbTipoCalculo     = $_POST['cbTipoCalculo'];
			$idTasa = $Tasa->InsertarTasa($textcuantiaMinima,$textcuantiaMaxima,$textPorcentaje,$textMontoMinimo,$textMontoMaximo,$cbTipoCalculo);
			echo "1";
		}else{

			/*==================
			ACTUALIZAR TASA
			====================*/
			// echo "2";
			
			$textcuantiaMinima = $_POST['TextcuantiaMinima'];
			$textcuantiaMaxima = $_POST['TextcuantiaMaxima'];
			$textPorcentaje    = $_POST['textPorcentaje'];
			$textMontoMinimo   = $_POST['textMontoMinimo'];
			$textMontoMaximo   = $_POST['textMontoMaximo'];
			$cbTipoCalculo     = $_POST['cbTipoCalculo'];
			$Tasa->ActualizarTasa($idRegistro,$textcuantiaMinima,$textcuantiaMaxima,$textPorcentaje,$textMontoMinimo,$textMontoMaximo,$cbTipoCalculo);
			echo "1";
		}
	}

	// Retornar clave generada o editada
	echo $idRegistro;
 ?>