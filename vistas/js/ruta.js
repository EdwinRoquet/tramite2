/* =================================================
   CONSULTAR DATOS DE RUTA
   ================================================= */
	function ActualizarRuta(){
		/* =====================================
           VALIDACIONES 
        =======================================*/
        var pidSolicitud    = $('#idSolicitud').val();
        var pidRuta		    = $('#idRuta').val();       
        var ppara           = $('#para').val();
        var pasunto         = $('#asunto').val();
        var preferencia     = $('#referencia').val();
        var pcontenido      = $('#contenido').val();
        var vNomFilSol      = $("#NomArcReq").val();
        var vUsuOrigen      = $("#usuarioOrigen").val();

        var data            = new FormData();

        if(ppara == 0){
            alert('seleccione un usuario valido');
            return false
        }else if(pasunto == ''){
            alert('ingrese un asunto');
            return false
        }else if(preferencia == ''){
            alert('ingrese una referencia');
            return false
        }else if(pcontenido == ""){
            alert('ingrese un contenido');
            return false
        }else if (vNomFilSol == ''){
            alert('Cargue un archivo asociado a este envio');
            return false
        }

        /*==========================================
        CARGANDO ARCHIVO
        ===========================================*/
        var inputFileImage  = document.getElementById("NomArcReq");
        var file = inputFileImage.files[0];

         /*==========================================
        AGREGANDO VALORES
        ===========================================*/
        data.append('NomArcReq',file);
        data.append('idSolicitud',pidSolicitud);
        data.append('idRuta',pidRuta);
        data.append('asunto',pasunto);
        data.append('referencia',preferencia);
        data.append('contenido',pcontenido);
        data.append('para',ppara);
        data.append('idUsuario',vUsuOrigen);

        /* =====================================
            REGISTRO DE RUTA (DERIVAR SOLICITUD)
         =======================================*/      
         
         $.ajax({
             url: 'ajax/ajax-actualiza-envio.php',
             type: 'POST',
             dataType: 'html',
             data: data,
             contentType: false,
             cache: false,
             processData: false,
         })
         .done(function(data) {

         	console.log(data);

            // 1. Ocultar ventana de derivación
            $('#mdlEditarEnvio').modal('toggle');

            // 2. Al ocultar la ventana Derivación mostrar ventana Resumen
            $('#mdlEditarEnvio').on('hidden.bs.modal', function () {
                
                swal({
                        title: "Envio Actualizado",
                        text: "Se actualizo el envio seleccionado",
                        type: "success"
                    },
                    function(){
                    	// Actualizamos la página actual
                       location.reload();
                    });

            })

         }) 
		 
         /*--------------------------------------------------------------------------*/

	}
/* =================================================
   CONSULTAR DATOS DE RUTA
   ================================================= */
	function AnularRuta(){
		var idSol = $('#idSolicitud').val();
		var idRut = $('#idRuta').val();

		$.ajax({
			url: 'ajax/ajax-anular-ruta.php',
			type: 'POST',
			dataType: 'html',
			data: {
				    idSolicitud: idSol,
				    idRuta: idRut,
			      },
		})
		.done(function(data) {
			if(data == 1){

				$('#mdlEditarEnvio').modal('toggle');

	            /* 3. Al ocultar la ventana Derivación mostrar ventana Resumen*/
	            $('#mdlEditarEnvio').on('hidden.bs.modal', function () {
	                
                swal({
                        title: "Envio Anulado",
                        text: "Se anuló el envio seleccionado",
                        type: "success"
                    },
                    function(){
                    	// Actualizamos la página actual
                       location.reload();
                    });
	            })
				
			}
		})
		
	}

/* =================================================
   CONSULTAR DATOS DE RUTA
   ================================================= */
	function ConsultaRuta(idSol,idRut){

		$.ajax({
			url: 'ajax/ajax-consulta-ruta.php',
			type: 'POST',
			dataType: "json",
			data: {
					idSolicitud: idSol,
					idRuta: idRut
					},
		})
		.done(function(data) {

			// Asignación de datos
			$('#txtAreDes').val(data.desareadestino);
			$('#txtTipDoc').val(data.destipdoc);
			$('#txtDesPar').val(data.nomraz);
			$('#txtDesAsu').val(data.asunto);
			$('#txtDesRef').val(data.referencia);
			$('#txtDesCon').val(data.contenido);

			$('#descargaAdjunto').html('<a href="upload/'+data.nomFileSer+'" class="btn btn-outline-dark" target="_blank"><i class="fa fa-download"></i> '+data.nomFileLoc+'</a>');

			$('#mdlConsultaEnvio').modal('show');	

		})
	}
/* =================================================
   EDITAR DATOS DE RUTA
   ================================================= */
	function EditarRuta(idSol,idRut){

		$('#idSolicitud').val(idSol);
		$('#idRuta').val(idRut);

		$.ajax({
			url: 'ajax/ajax-consulta-ruta.php',
			type: 'POST',
			dataType: "json",
			data: {
					idSolicitud: idSol,
					idRuta: idRut
					},
		})
		.done(function(data) {

			// AREA DE DESTINO
			$("#areaDestino option[value="+ data.idareadestino +"]").attr("selected",true);

			/*-----------------------------------*/
			var idArea = data.idareadestino;

            $.ajax({
                url: 'ajax/ajax-area-usuario.php',
                type: 'POST',
                dataType: 'html',
                data: {id: idArea},
            })
            .done(function(response) {

                if(response != ''){
                    $('#para').html(response);
                }else{
                    $('#para').html('<option value="0">No existen usuarios</option>');  
                }
                
            }) 
			/*-----------------------------------*/

			// DOCUMENTO INTERNO
			$("#tipoDocumento option[value="+ data.idtipdoc +"]").attr("selected",true);

			// USUARIO DESTINO (PARA)
			$("#para option[value="+ data.para +"]").attr("selected",true);			

			$('#asunto').val(data.asunto);
			$('#referencia').val(data.referencia);
			$('#contenido').val(data.contenido);
			
            //$('#descargaAdjunto').html('<a href="upload/'+data.nomFileSer+'" class="btn btn-outline-dark" target="_blank"><i class="fa fa-download"></i> '+data.nomFileLoc+'</a>');
			
			$('#mdlEditarEnvio').modal('show');

		})
	}