<?php 

	/* ====================
	EDITAR DOCUMENTO INTERNO
	=======================*/

	include_once '../../includes/docint.php';

	$DocInt = new DocInt();

	$id = $_POST['iddocint'];

	$DataDocInt = $DocInt -> EditarDocInt($id);

	echo json_encode($DataDocInt);

 ?>