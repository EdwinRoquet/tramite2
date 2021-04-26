<?php 

$ope = new operacion;

echo $ope->sumar(10);

class operacion{
	public static function sumar($valor1){
		$respuesta = $valor1 + 10;
		return $respuesta;
	}	
}

 ?>