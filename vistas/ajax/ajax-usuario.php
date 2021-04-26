<?php 

	/* ====================
	EDITAR DATOS DE USUARIO
	=======================*/

	include_once '../../includes/user.php';

	$Usuario = new User();

	$id = $_POST['idusuario'];

	$DataUsuario = $Usuario -> EditarUsuario($id);

	echo json_encode($DataUsuario);

 ?>