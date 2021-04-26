<?php 
	include_once '../../includes/area.php';

	$Area 	= new Area();

	$id = $_POST['id'];

	$area = $Area->EliminarArea($id);

	echo $area;
 ?>