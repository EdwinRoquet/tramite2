$(document).ready(function(){
/*  =================================================
	REGISTRO : SOLICITUD ARBITRAL MANUAL
	================================================= */
	$('#btnGrabarSolicitudManual').click(function(){
		/* -------------------------------------------------------------*/
		/* Validaciones */
		/* -------------------------------------------------------------*/
		var cntfldObs = 0;
		var msgfldObs = '';
		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

		if ($('#RazSocDem').val() == ''){cntfldObs ++ ; msgfldObs += '<li> Razón Social de demandante obligatorio.</li>'}
		if ($('#TipDocDem').val() == ''){cntfldObs ++ ; msgfldObs += '<li> Tipo de Documento de demandante obligatorio.</li>'}
		if ($('#txtNumDocDem').val() == ''){cntfldObs ++ ; msgfldObs += '<li> Número de Documento de demandante obligatorio.</li>'}

		if ($('#RazSocDmd').val() == ''){cntfldObs ++ ; msgfldObs += '<li> Razón Social de demandado obligatorio.</li>'}
		if ($('#TipDocDmd').val() == ''){cntfldObs ++ ; msgfldObs += '<li> Tipo de Documento de demandado obligatorio.</li>'}
		if ($('#txtNumDocDmd').val() == ''){cntfldObs ++ ; msgfldObs += '<li> Número de Documento de demandado obligatorio.</li>'}
		if ($('#DirEmaDmd').val() == ''){
			cntfldObs ++ ; 
			msgfldObs += '<li> Correo electrónico de demandado obligatorio.</li>'
		}else if(!expresion.test($('#DirEmaDmd').val())){
			cntfldObs ++ ; 
			msgfldObs += '<li> Correo electrónico de demandado incorrecto.</li>'	
		}
		if($('#NomFilSolMan').val() == ''){cntfldObs ++ ; msgfldObs += '<li> Debe Adjuntar a la solicitud el archivo debidamente Firmado.</li>'}

		/* -------------------------------------------------------------   */
		/* Sí paso las validaciones, entonces se procedé al envío de datos */
		/* -------------------------------------------------------------   */
		var fileImg  = document.getElementById("NomFilSolMan");
		var file 	 = fileImg.files[0];
	
		if(cntfldObs != 0){
			var titmsjobs = '<p class="text-muted">El sistema identificó los siguientes campos con observaciones el el registro : </p><ul class="text-muted">'+msgfldObs+'</ul>'
			
			$('#MdlMensajeValidacion').html(titmsjobs);
			$('#mdlValidaSolicitudManual').modal('show');

		}else{
			var formData  = new FormData($('#frmSolManual')[0]);
			formData.append('Operacion','GenerarSolManual');
			if(file != undefined){
				formData.append('NomFilSolMan',file.name);
			}

			$.ajax({
				url: 'ajax/ajax-solicitud.php',
				type: 'POST',
				dataType: 'html',
				data: formData,
				contentType: false,
        		cache: false,
        		processData:false,
			})
			.done(function(data) {
				console.log(data);
				swal({
					title:"Solicitud N° " + data,
					text:"Solicitud de Arbitraje generada y enviada vía mail con exito.",
					icon: "success"
				}).then((value) =>{
					location.href='consulta.php';
				});
			})
		}
	})
});