/*==================================
	OBTENER HISTORIAL DE ANEXOS
  ==================================*/
//$(fnd_anexos());

function fnd_anexos(idSolicitud){

	$.ajax({
		url: 'ajax/ajax-anexos.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: idSolicitud},
	})
	.done(function(respuesta) {
		$("#bodyAnexos").html(respuesta);		
	})
	.fail(function() {
		console.log("error");
	})	
}