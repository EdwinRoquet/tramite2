/*  =======================================
	Funcionalidades JavaScript
	---------------------------------------
	Autor : David Montenegro Sarmiento
	Fecha : 18/05/2020
	Hora  : 10:35 pm
    ======================================= */

$(document).ready(function(){
	/*  =================================================
	VALIDAR FORMULARIO : CREACION DE CUENTA
	================================================= */
	$("#frmRecordar").submit(function(){

			// Captura de input
			var username = $("#username").val();

			if(username == ""){

				// Establecemos el mensaje a mostar
				$('#pMensaje').html('<i class="fa fa-edit"></i> Debe ingresar un correo electronico');

				$('#mdlRecordar').modal('show');

				return false

			}

	})
})