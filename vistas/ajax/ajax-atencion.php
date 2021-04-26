<?php 

/* Librerias de Proyecto */
	include_once '../../includes/solicitudrutas.php';

class AjaxAtencion{
	/*===================================================================================*/
	public $numsol;
	public $estsol;
	public $recsol;
	public $codare;
	public function ajaxbuscar(){

		$pnumsol = $this->numsol;
		$precsol = $this->recsol;
		$pcodare = $this->codare;

		$SolicitudRuta = new SolicitudRutas();
		$MSolicitudRuta = $SolicitudRuta->ListarSolicitudAtencion($pnumsol,$precsol,$pcodare);

		/*conversión a matriz*/
		$arreglo = array();
		$item = 0;
		foreach ($MSolicitudRuta as $key => $value){
			$item ++;

			$value['row'] = $item;

			$arreglo["data"][] = $value;
		}

		/*retorno de resultados*/
		if(count($arreglo) == 0){
			echo '{"data":[]}';
		}
		else{
			echo json_encode($arreglo);
		}

	}
	/*===================================================================================*/
	public $idSolicitud;
	public $idRuta;
	public $idUsuario;
	public function ajaxrecepcionar(){
		$pidSolicitud = $this->idSolicitud;
		$pidRuta      = $this->idRuta;
		$pidUsuario   = $this->idUsuario;

		$SolicitudRuta = new SolicitudRutas();
		$respuesta = $SolicitudRuta->RecepcionarRuta($pidSolicitud,$pidRuta,$pidUsuario);
		
		echo $respuesta;
	}
	/*===================================================================================*/
	//public $codare;
	public function ajaxbuscarenviado(){
		$pnumsol = $this->numsol;
		$pcodare = $this->codare;

		$SolicitudRuta = new SolicitudRutas();
		$MSolicitudRuta = $SolicitudRuta->ListarSolicitudEnviadas($pnumsol,$pcodare);

		/*conversión a matriz*/
		$arreglo = array();
		$item = 0;
		foreach ($MSolicitudRuta as $key => $value){
			$item ++;
			$value['row'] = $item;
			$arreglo["data"][] = $value;
		}

		/*retorno de resultados*/
		if(count($arreglo) == 0){
			echo '{"data":[]}';
		}
		else{
			echo json_encode($arreglo);
		}
	}

}

/* =========================================================================================
   OPERACIONES DESDE PHP
   =========================================================================================  */

	/* BUSCAR SOLICITUDES PENDIENTES DE ATENCION */
	if($_POST["Operacion"] == 'Buscar'){
		$buscar = new AjaxAtencion();
		
		$buscar -> numsol = $_POST['numsol'];
		$buscar -> recsol = $_POST['recsol'];
		$buscar -> codare = $_POST['codare'];

		$buscar -> ajaxbuscar();
	}
	/* RECEPIONAR SOLICITUDES PENDIENTES */
	if($_POST["Operacion"] == 'Recepcionar'){
		$recepcionar = new AjaxAtencion();
		$recepcionar -> idSolicitud = $_POST["idSolicitud"];
		$recepcionar -> idRuta = $_POST["idRuta"];
		$recepcionar -> idUsuario = $_POST["idUsuario"];

		$recepcionar -> ajaxrecepcionar();
	}
	/* BUSCAR SOLICITUDES ATENDIDAS */
	if($_POST["Operacion"] == 'BuscarEnviados'){
		$enviado = new AjaxAtencion();
		$enviado ->  numsol = $_POST["numsol"];
		$enviado ->  codare = $_POST["codare"];
		
		$enviado -> ajaxbuscarenviado();

	}


 ?>