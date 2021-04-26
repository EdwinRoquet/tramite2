<?php 

	/* ====================
	EDITAR DATOS DE USUARIO
	=======================*/

	include_once '../../includes/Area.php';

	$Area = new Area();

	$idArea = $_POST['idArea'];

	$DataArea = $Area->EditarArea($idArea);

	echo json_encode($DataArea);

 ?>