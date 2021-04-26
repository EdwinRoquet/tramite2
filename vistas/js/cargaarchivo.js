/*==================================
	CARGA ARCHIVOS AL SERVIDOR
  ==================================*/

function fnd_carga_archivo(){

		var vNomFilSol = $("#NomFilSol").val();

		if(vNomFilSol == ""){

			$('#pMensaje').html("<li> Debe seleccionar un archivo </li>");
			$('#ModalValidaciones').modal('show');
			return false;
		}

	var data = new FormData();

	// obtenemos los datos de archivo cargado
	var inputFileImage  = document.getElementById("NomFilSol");
	var file = inputFileImage.files[0];

	// agregamos al formulario el archivo
	data.append('NomFilSol',file);
	
	// Agregamos al formulario los datos a procesar
	data.append('idSol',$("#id").val());
	data.append('nombre',$("#usr_nom").val());
	data.append('email',$("#usr_ema").val());

	$.ajax({
		url: 'ajax/carga-archivos.php',
		type: 'POST',
		data: data,
		contentType: false,
		cache: false,
		processData: false,
		beforesend: function(){
			console.log("beforesend");
		},
		success: function(response){

			// cambiamos mensaje de respuesta
			$("#RespuestaCarga").html(response);

			// mostramos modal de respuesta
			$('#MdlCargaExitosa').modal('show');

			$('#MdlCargaExitosa').on('hidden.bs.modal', function () {
                    
                location.href='consulta.php';

             });
		}
	});
}