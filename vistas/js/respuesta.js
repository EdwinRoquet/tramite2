$(document).ready(function(){

	/* Cargar por defecto lista de solicitudes pendientes*/
	BuscarSolicitudPendienteRespuesta();

	/*
		Botón : Buscar solicitudes pendientes a responder.
	*/
	$('#btnBuscarSolArbDem').click(function(){
		// Ejecutar función de busqueda / funciones.js
		BuscarSolicitudPendienteRespuesta();
	});

});