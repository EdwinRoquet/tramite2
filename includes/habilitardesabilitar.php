<?php 

require_once 'db.php';

/**
 * Clase : HabilitarDesabilitar
 */
class HabilitarDesabilitar
{

	/*============================
	  ACTUALIZAR ESTADO DE REGISTRO
	  ============================*/
	public static function ActualizarEstado($tabla,$campo,$valor,$id){

       $query = Conexion::conectar()->prepare('UPDATE '.$tabla.' SET '.$campo.' = :valor WHERE id = :id');                                

       $query->execute([ 'id' => $id,'valor' => $valor]);

	   $count = $query->rowCount();

	   return $count;
	}


 }?>