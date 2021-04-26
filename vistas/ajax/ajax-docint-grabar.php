<?php 

/* ==================================
	EDITAR DATOS DE DOCUMENTO INTERNO
	=================================*/

	include_once '../../includes/docint.php';

	$DocInt 	= new DocInt();
	$idDocInt 	= 0;

	if (isset($_POST)) {
		
		/*==================
		CAPTURAR DATOS
		====================*/
		$id 		= $_POST['idDocInt'];
		$nomdocint	= $_POST['nomdocint'];
		$estdocint	= 'H';

		if($id == ''){
			/*========================
			INSERTAR DOCUMENTO INTERNO
			=========================*/

			$idDocInt = $DocInt-> InsertarDocumentoInterno($nomdocint,$estdocint);

		}else{

			/*==================
			ACTUALIZAR USUARIO
			====================*/
			$idDocInt = $id;
			$DocInt -> ActualizarUsuario($id,$nomdocint,$estdocint);
		}
	}

	// Retornar clave generada o editada
	echo $idDocInt;
 ?>