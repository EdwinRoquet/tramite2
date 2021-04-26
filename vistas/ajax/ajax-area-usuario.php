<?php 

include_once '../../includes/user.php';

	$user = new User();
	$MUsrArea = $user->ListarUsuariosXArea($_POST['id']);

	$listaUsuarios = '';

	foreach ($MUsrArea as $key => $value) {
		$listaUsuarios .= '<option value="'.$value['id'].'">'.$value['apepat'].' '.$value['apemat'].', '.$value['nombre'].'</option>';
	}

	echo $listaUsuarios;

?>