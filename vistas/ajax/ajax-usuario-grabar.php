<?php 

/* ====================
	EDITAR DATOS DE USUARIO
	=======================*/

	include_once '../../includes/user.php';

	$Usuario 	= new User();
	$idUsuario 	= 0;

	if (isset($_POST)) {
		
		/*==================
		CAPTURAR DATOS
		====================*/
		$id 		= $_POST['idUsr'];
		$tipdoc		= '2';
		$numtel     =$_POST['numtel'];
		$nrodoc		= $_POST['numdoi'];
		$direma 	= $_POST['direma'];
		
		$passwd 	= $_POST['passwd'];
		$flgTipUsr 	= 'I';				 // Usuario Interno
		$idarea		= $_POST['nomarea'];
		$nombre 	= $_POST['nomusr'];
		$apepat 	= $_POST['apepat'];
		$apemat 	= $_POST['apemat'];
		$idcargo 	= $_POST['nomcargo'];
		$idperfil 	= $_POST['nomperfil'];
		$idest 		= 'H';
		
		if($id == ''){
			/*==================
			INSERTAR USUARIO
			====================*/
			$tipdoc		= '2';
			$nrodoc		= $_POST['numdoi'];
			$numtel     =$_POST['numtel'];
			$direma 	= $_POST['direma'];
			$passwd 	= $_POST['passwd'];
			$flgTipUsr 	= 'I';				 // Usuario Interno
			$idarea		= $_POST['nomarea'];
			$nombre 	= $_POST['nomusr'];
			$apepat 	= $_POST['apepat'];
			$apemat 	= $_POST['apemat'];
			$idcargo 	= $_POST['nomcargo'];
			$idperfil 	= $_POST['nomperfil'];
			$idest 		= 'H';

			$idUsuario = $Usuario-> InsertarUsuario($tipdoc,$nrodoc,$direma,$numtel,$passwd,$flgTipUsr,$idarea,$nombre,$apepat,$apemat,$idcargo,$idperfil,$idest);

		}else{

			/*==================
			ACTUALIZAR USUARIO
			====================*/
			$idUsuario = $id;
			$nomraz	   ='prueba';
			$Usuario-> ActualizarUsuario($id,$tipdoc,$nrodoc,$nomraz,$direma,$numtel,$passwd,$idarea,$nombre,$apepat,$apemat,$idcargo,$idperfil);
		}
	}

	// Retornar clave generada o editada
	echo $idUsuario;
 ?>