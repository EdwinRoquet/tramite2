<?php 

	$rutaArchivo = '';
	if(isset($_FILES['NomArcReq']['tmp_name']))
	{
	    $file = file_get_contents($_FILES['NomArcReq']['tmp_name']);
		echo base64_encode($file);	
	
	}

	if(isset($_FILES['NomArcReq2']['tmp_name']))
	{
	$file = file_get_contents($_FILES['NomArcReq2']['tmp_name']);
		echo base64_encode($file);	
	
	}
	if(isset($_FILES['NomArcReq1']['tmp_name']))
	{
	$file = file_get_contents($_FILES['NomArcReq1']['tmp_name']);
		echo base64_encode($file);	
	
	}
	if(isset($_FILES['NomArcReq3']['tmp_name']))
	{
	$file = file_get_contents($_FILES['NomArcReq3']['tmp_name']);
		echo base64_encode($file);	
	
	}
	if(isset($_FILES['NomArcReq4']['tmp_name']))
	{
	$file = file_get_contents($_FILES['NomArcReq4']['tmp_name']);
		echo base64_encode($file);	
	
	}


 ?>