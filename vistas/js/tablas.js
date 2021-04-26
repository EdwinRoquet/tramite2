/*  =======================================
	Funcionalidades JavaScript
	---------------------------------------
	Autor : David Montenegro Sarmiento
	Fecha : 18/05/2020
	Hora  : 10:35 pm
		  : Operaciones con tablas
		  	- Insercion de registros
		  	- Eliminación de registros 
    ======================================= */
	var myArrayTipoArbitro=[];
	var contadorPre=0;
$(document).ready(function(){
	
	
	//Deshabilitar el boton de agregar otros documentos en anexo
	$("#btnAgregarAnxOtros").prop('disabled', true);

	//VARIABLES GLOBALES
	var anexosDocumento = [];
/*  =========================================================================================================================
	Agregar : DESIGANACIÓN DE ARBITRO
	========================================================================================================================= */
	
	
	
	$( "#btnAgregarAnxArbitro" ).click(function(e) {

		e.preventDefault();

		if ($(this).html() == '<i class="fa fa-pencil"></i> Actualizar'){


			var index = $("#idDesArbitroEdit").val();

			if(index != ""){
				 var tem=0;
				//if($("#txtTipoArbitro").val()=='Presidente Arbitral')
				//{
					/*for (let index = 0; index < myArrayTipoArbitro.length; index++) 
						{
								
							if(myArrayTipoArbitro[index]=='Presidente Arbitral')
							{
								tem=tem+1;	
							}
						}
						console.log(tem);
						if(tem==1)
						{
							
							alert("no es posible ingresar a dos presidentes");
						}else
						{*/
							var valCelda = $("#txtApeNomArb").val();
							var valCelda1 = $("#txtDesDirArb").val();
							var valCelda2 = $("#txtNumTelArb").val();
							var valCelda3 = $("#txtDirEmaArb").val();
							var valCelda4 = $("#txtNomProArb").val();
							var valCelda5 = $("#txtNumColArb").val();
							var valCelda6 = $("#txtTipoArbitro").val();
							if( $('#FlgRegArb').is(':checked') ) {
							
								valCelda7='Si';
							}
							else{
								valCelda7='No';
							}
							$("#tbListadoArbitro #fila" + index).find("td").eq(0).html(valCelda);
							$("#tbListadoArbitro #fila" + index).find("td").eq(1).html(valCelda1);
							$("#tbListadoArbitro #fila" + index).find("td").eq(2).html(valCelda2);
							$("#tbListadoArbitro #fila" + index).find("td").eq(3).html(valCelda3);
							$("#tbListadoArbitro #fila" + index).find("td").eq(4).html(valCelda4);
							$("#tbListadoArbitro #fila" + index).find("td").eq(5).html(valCelda5);
							$("#tbListadoArbitro #fila" + index).find("td").eq(6).html(valCelda6);
							$("#tbListadoArbitro #fila" + index).find("td").eq(7).html(valCelda7);
			
							// Actualizar el titulo del boton
							$("#btnAgregarAnxArbitro").html('<i class="fa fa-search"></i> Agregar');
			
							// Cambiar estilos de botones
							$("#btnAgregarAnxArbitro").removeClass('btn-outline-danger');
							$("#btnAgregarAnxArbitro").addClass('btn-outline-success');
			
							/* Reseteamos Campo de Pretención*/
							$('#txtApeNomArb').val('');
							$('#txtDesDirArb').val('');
							$('#txtNumTelArb').val('');
							$('#txtDirEmaArb').val('');
							$('#txtNomProArb').val('');
							$('#txtNumColArb').val('');
							$('#txtTipoArbitro').val('');
							if( $('#FlgRegArb').is(':checked') ) {
							
								$("#FlgRegArb").prop("checked", false);  
							}
							
			
							   /* Enviamos el foco al Control*/
							   // $( "#DesPretension" ).focus();
						//}
				//}
				
				
				

			}

		}else{
			// Agregar aqui fila nueva
			var txtApeNomArb = $('#txtApeNomArb').val();
			var txtDesDirArb = $('#txtDesDirArb').val();
			var txtNumTelArb = $('#txtNumTelArb').val();
			var txtDirEmaArb = $('#txtDirEmaArb').val();
			var txtNomProArb = $('#txtNomProArb').val();
			var txtNumColArb = $('#txtNumColArb').val();
			var txtTipoArbitro = $('#txtTipoArbitro').val();
			var FlgRegArb = $('#FlgRegArb').val();
			if( $('#FlgRegArb').is(':checked') ) {
				
				FlgRegArb='Si';
			}
			else{
				FlgRegArb='No';
			}
			if(txtApeNomArb != '' && txtNumTelArb !='' && txtDirEmaArb!=''){
				
				var tbody = $("#tbListadoArbitro tbody"); 
				var nFilas = $("#tbListadoArbitro tr").length;
				variable = "'"+txtTipoArbitro+"'";
				var FilaContent =  '<tr id="fila'+ nFilas +'">'+
		        						'<td width=10% id="nColum1" class="text-left">'+ txtApeNomArb +'</td>'+
										'<td width=10% id="nColum2" class="text-left">'+ txtDesDirArb +'</td>'+
										'<td width=10% id="nColum3" class="text-left ColOculto">'+ txtNumTelArb +'</td>'+
										'<td width=10% id="nColum4" class="text-left ColOculto">'+ txtDirEmaArb +'</td>'+
										'<td width=10% id="nColum5" class="text-left ColOculto">'+ txtNomProArb +'</td>'+
										'<td width=10% id="nColum6" class="text-left ColOculto">'+ txtNumColArb +'</td>'+
										'<td width=10% id="nColum7" class="text-left">'+ txtTipoArbitro +'</td>'+
										'<td width=10% id="nColum8" class="text-left ">'+ FlgRegArb +'</td>'+
	    	    						'<td width=10% class="text-center">'+	
			        						'<a href="#" class="btn btn-lg btn-outline-info btnAccion" id="EmiminarArray"'+
			        						' onclick="eliminarDesignacionArbitro('+nFilas+','+variable+');"><i class="fa fa-trash" aria-hidden="true"'+
			        						' title="Consultar observación" ></i> Eliminar</a> '+
			        						'<a href="#" class="btn btn-lg btn-outline-info btnAccion"'+
			        						' onclick="editarDesignacionArbitro('+nFilas+');"><i class="fa fa-edit" aria-hidden="true"'+
			        						' title="Consultar observación" ></i> Editar</a>'+
											'<a href="#" class="btn btn-lg btn-outline-info btnAccion"'+
			        						'><i class="fa fa-envelope-o" aria-hidden="true"'+
			        						' title="Consultar observación" ></i> Notificaciones</a>'
											
		    	    					'</td>'+
		        					'</tr>';

					if(txtTipoArbitro=='Presidente Arbitral')
					{
						myArrayTipoArbitro.push(txtTipoArbitro);
						for (let index = 0; index < myArrayTipoArbitro.length; index++) 
						{
								
							if(myArrayTipoArbitro[index]=='Presidente Arbitral')
							{
									contadorPre =contadorPre+1;
							}
						}
						if(contadorPre<=1)
						{
							$('#tbListadoArbitro tbody').append(FilaContent);
							/* Reseteamos Campo de Pretención*/
							$('#txtApeNomArb').val('');
							$('#txtApeNomArb').val('');
							$('#txtDesDirArb').val('');
							$('#txtNumTelArb').val('');
							$('#txtDirEmaArb').val('');
							$('#txtNomProArb').val('');
							$('#txtNumColArb').val('');
							$('#txtTipoArbitro').val('');
	 
						}else
						{
							swal({
								title: "Designación de arbitro?",
								text: "No es posible ingresar a dos presidentes!",
								icon: "warning",
								buttons: true,
								dangerMode: true,
							  })
							  .then((willDelete) => {
								
							  });
							
						}

					}else{

						$('#tbListadoArbitro tbody').append(FilaContent);
						/* Reseteamos Campo de Pretención*/
						$('#txtApeNomArb').val('');
						$('#txtApeNomArb').val('');
						$('#txtDesDirArb').val('');
						$('#txtNumTelArb').val('');
						$('#txtDirEmaArb').val('');
						$('#txtNomProArb').val('');
						$('#txtNumColArb').val('');
						$('#txtTipoArbitro').val('');
 
					}
				
	   		
	   		
	   			
	   			/* Enviamos el foco al Control*/
	   			$( "#DesPretension" ).focus();			
			}else
			{
				
				if($('#txtApeNomArb').val()== '')
				{
				
					$("#errorNombre").html("Ingrese su nombre");
				}
				if(txtNumTelArb == '')
				{
					$("#errorCelular").html("Ingrese su número de celular");
				}
				if(txtDirEmaArb == '')
				{
					$("#errorCorreo").html("Ingrese su correo");
				}

			}
		}
		
	});
	//validar mensajes de ingreso de arbitros
	$( "#txtApeNomArb" ).keyup(function() {
		$("#errorNombre").html("");
	  });
	  $( "#txtNumTelArb" ).keyup(function() {
		$("#errorCelular").html("");
	  });
	  $( "#txtDirEmaArb" ).keyup(function() {
		$("#errorCorreo").html("");
	  });

	
	

/*  =========================================================================================================================
	Agregar : PRETENCION
	========================================================================================================================= */
	$( "#btnAgregar" ).click(function(e) {

		e.preventDefault();

		if ($(this).html() == '<i class="fa fa-pencil"></i> Actualizar'){


			var index = $("#idPretensionEdit").val();

			if(index != ""){
				
				var valCelda = $("#DesPretension").val();
				$("#tbPretensiones #fila" + index).find("td").eq(1).html(valCelda);

				// Actualizar el titulo del boton
				$("#btnAgregar").html('<i class="fa fa-search"></i> Agregar');

				// Cambiar estilos de botones
				$("#btnAgregar").removeClass('btn-outline-danger');
				$("#btnAgregar").addClass('btn-outline-success');

				/* Reseteamos Campo de Pretención*/
	   			$('#DesPretension').val('');

	   			/* Enviamos el foco al Control*/
	   			$( "#DesPretension" ).focus();

			}

		}else{
			// Agregar aqui fila nueva
			var vPretension = $('#DesPretension').val();
			if(vPretension != ''){

				var tbody = $("#tbPretensiones tbody"); 
				var nFilas = $("#tbPretensiones tr").length;
			
				var FilaContent =  '<tr id="fila'+ nFilas +'">'+
				                        '<td width=10%  class="text-left">'+ nFilas +'</td>'+
		        						'<td width=10% id="nColum2" class="text-left">'+ vPretension +'</td>'+
	    	    						'<td width=10% class="text-center">'+
			        						'<a href="#" class="btn btn-lg btn-outline-info btnAccion"'+
			        						' onclick="eliminarPretension('+nFilas+');"><i class="fa fa-trash" aria-hidden="true"'+
			        						' title="Consultar observación" ></i> Eliminar</a> '+
			        						'<a href="#" class="btn btn-lg btn-outline-info btnAccion"'+
			        						' onclick="editarPretension('+nFilas+');"><i class="fa fa-edit" aria-hidden="true"'+
			        						' title="Consultar observación" ></i> Editar</a>'
		    	    					'</td>'+
		        					'</tr>';
	      
				/* Agregamos fila con datos en formato HTML*/
					console.log(FilaContent);
	   			$('#tbPretensiones tbody').append(FilaContent);
	   		
	   			/* Reseteamos Campo de Pretención*/
	   			$('#DesPretension').val('');

	   			/* Enviamos el foco al Control*/
	   			$( "#DesPretension" ).focus();			
			}
		}
		
	});

/*  ==========================================================================================================================
	Agrega : DOCUMENTO FIRMADO
	========================================================================================================================== */
	$( "#btnCargarArchivo" ).click(function(e) {
		
		/*
		e.preventDefault();

		var vNomFilSol = $("#NomFilSol").val();

		console.log(vNomFilSol);

		if(vNomFilSol == ""){

			$('#pMensaje').html("<li> Debe seleccionar un archivo </li>");
			$('#ModalValidaciones').modal('show');
			return false;
		}
		*/
	})

	
	/*  ==========================================================================================================================
	Agrega : Mostra y ocultar campos de anexo para validar y mostrar campos
	========================================================================================================================== */
	$( "#TabAnexoMostar" ).click(function(e) {
		
		if($("#TipDocDem").val()==1)
		{
			$('#filaDocumento2').hide();
			$('#filaDocumento4').hide();	
		}else{
		
			$('#filaDocumento1').show();
			$('#filaDocumento2').show();
			$('#filaDocumento3').show();
			$('#filaDocumento4').show();
			$('#ocultarbtnAgregar').hide();
			
		}
	})


/*  ==========================================================================================================================
	Agrega : ANEXO
	========================================================================================================================== */
	$( "#btnAgregarAnx" ).click(function(e) {
    
		e.preventDefault();

		// captura de datos
		var vtipdocReq1 = $("#tipdocReq1").val();
		var vNomArcReq1 = $("#NomArcReq1").val();

		var vtipdocReq2 = $("#tipdocReq2").val();
		var vNomArcReq2 = $("#NomArcReq2").val();

		var vtipdocReq3 = $("#tipdocReq3").val();
		var vNomArcReq3 = $("#NomArcReq3").val();

		var vtipdocReq4 = $("#tipdocReq4").val();
		var vNomArcReq4 = $("#NomArcReq4").val();
       
		
		 if($("#TipDocDem").val()==2)
		 {
		   // 1.  Validaciones previas al registro de anexos	
			if(vtipdocReq1=="0" || vtipdocReq2=='0' || vtipdocReq3=='0' || vtipdocReq4=='0'){

				$('#pMensaje').html("<li> Debe seleccionar un tipo de Anexo </li>");
				$('#ModalValidaciones').modal('show');
				return false;

			}else if(vNomArcReq1 == "" || vNomArcReq2 == "" || vNomArcReq3 == "" || vNomArcReq4 == "")
			{
				
				$('#pMensaje').html("<li> Debe seleccionar un archivo </li>");
				$('#ModalValidaciones').modal('show');
				return false;

			}else{
				var cantidadArchivo=4;
				//llamnando al metodo ajaxAnexo para obtener la ruta de los archivos en anexos 
				ajaxAnexo('tipdocReq1','NomArcReq1',cantidadArchivo);
				ajaxAnexo('tipdocReq2','NomArcReq2',cantidadArchivo);
				ajaxAnexo('tipdocReq3','NomArcReq3',cantidadArchivo);
				ajaxAnexo('tipdocReq4','NomArcReq4',cantidadArchivo);

				$('th').click(function() {
					var table = $(this).parents('table').eq(0)
					console.log();
					var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
					this.asc = !this.asc
					if (!this.asc) {
					  rows = rows.reverse()
					}
					for (var i = 0; i < rows.length; i++) {
						console.log(rows[i]);
					  table.append(rows[i])
					}
					setIcon($(this), this.asc);
				  })
				
			
				// $('th').each(function(columna){
				// 	$(this).click(function()
				// 	{
				// 		var registro=$("#tbArchivos").find('tbody > tr').get();
				// 		registro.sort(function(a,b){
				// 			var valor=$(a).children('td').eq
				// 			(columna).text().toUpperCase();
				// 			var valor1=$(b).children('td').eq
				// 			(columna).text().toUpperCase();
				// 			return valor<valor1 ? -1 : valor>valor1 ? 1 :0
				// 		});
				// 		$.each(registro,function(indice,elemento)
				// 			{
				// 				$('tbody').append(elemento);
				// 				console.log(indice);
				// 			});
				// 	})
						
					
					
					
				// })
			
				
				

				console.log(documentosAnexo);
				//habilitar el boton de agregar otros documentos en anexo
				$("#btnAgregarAnxOtros").prop('disabled', false);

				//Deshabilitar el boton de agregar documentos en anexo
				$("#btnAgregarAnx").prop('disabled', true);
				

			}
		}else
		{
				if($("#TipDocDem").val()==1)
				{
					if(vtipdocReq1=="0"  || vtipdocReq3=='0'){

					$('#pMensaje').html("<li> Debe seleccionar un tipo de Anexo </li>");
					$('#ModalValidaciones').modal('show');
					return false;

				}else if(vNomArcReq1 == "" || vNomArcReq3 == "")
				{
					
					$('#pMensaje').html("<li> Debe seleccionar un archivo </li>");
					$('#ModalValidaciones').modal('show');
					return false;

				}else
				{
					var cantidadArchivo=2;
					//llamnando al metodo ajaxAnexo para obtener la ruta de los archivos en anexos
					ajaxAnexo('tipdocReq1','NomArcReq1',cantidadArchivo);
					ajaxAnexo('tipdocReq3','NomArcReq3',cantidadArchivo);

					
					$('th').click(function() {
						
						var table = $(this).parents('table').eq(0)
						console.log(this);
						var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
						this.asc = !this.asc
						if (!this.asc) {
						rows = rows.reverse()
						}
						for (var i = 0; i < rows.length; i++) {
							console.log(rows[i]);
						table.append(rows[i])
						}
						setIcon($(this), this.asc);
					})

					  
					//habilitar el boton de agregar otros documentos en anexo
					$("#btnAgregarAnxOtros").prop('disabled', false);

					//Deshabilitar el boton de agregar documentos en anexo
					$("#btnAgregarAnx").prop('disabled', true);
					
				}
		}

		}
	});

	/*  ==========================================================================================================================
	Agrega : ANEXO OTROS
	========================================================================================================================== */
	$( "#btnAgregarAnxOtros" ).click(function(e) {
    
		e.preventDefault();

		// captura de datos
		var vtipdocReq = $("#tipdocReq").val();
		var vNomArcReq = $("#NomArcReq").val();
       
		// 1.  Validaciones previas al registro de anexos
			if(vtipdocReq=="0"){

				$('#pMensaje').html("<li> Debe seleccionar un tipo de Anexo </li>");
				$('#ModalValidaciones').modal('show');
				return false;

			}else if(vNomArcReq == "")
			{
				
				$('#pMensaje').html("<li> Debe seleccionar un archivo </li>");
				$('#ModalValidaciones').modal('show');
				return false;

			}else{

                //llamando al metodo ajaxAnexo para obtener la ruta de los otros archivos  archivos en anexos
				ajaxAnexo('tipdocReq','NomArcReq');

			}
	});


	/*  ==========================================================================================================================
	Formatear  moneda: Solicitud de Arbitraje
	========================================================================================================================== */
	
	  $("#ImpNCuant").blur(function(){
			numeroForma=$("#ImpNCuant").val();
			numero=parseFloat(numeroForma, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
			$("#ImpNCuant").val(numero);
	  });
	  $("#ImpNCuant").focus(function(){
			var demo=$("#ImpNCuant").val().replace(/,/g, "");
			$("#ImpNCuant").val(demo);
	 });
	 
	/*Enviar numero para poder generar texto del numero*/
	  $("#ImpNCuant").on({
		"focus": function(event) {
		  $(event.target).select();
		},
		"keyup": function(event) {
			var numeroCompleto=$("#ImpNCuant").val().replace(/,/g, "");
			var parteInzNumero=numeroCompleto.split(".")[0];
			var parteDereNumero=numeroCompleto.split(".")[1];
			console.log(parteDereNumero);
			if(parteDereNumero==undefined || parteDereNumero==00)
			{
				$("#ImpLCuant").val(NumeroALetras(parteInzNumero));
			
			}else{

				$("#ImpLCuant").val(NumeroALetras(parteInzNumero)+' CON '+NumeroALetras(parteDereNumero));
			}
		
		}
	  });

	/*  ==========================================================================================================================
	Formatear  moneda: Solicitud de Arbitraje
	========================================================================================================================== */	

})


function comparer(index) {
    return function(a, b) {
      var valA = getCellValue(a, index),
        valB = getCellValue(b, index)
      return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
    }
  }

  function getCellValue(row, index) {
    return $(row).children('td').eq(index).html()
  }

  function setIcon(element, asc) {
    $("th").each(function(index) {
      $(this).removeClass("sorting");
      $(this).removeClass("asc");
      $(this).removeClass("desc");
    });
    element.addClass("sorting");
    if (asc) element.addClass("asc");
    else element.addClass("desc");
  }
/*  ==========================================================================================================================
	Metodo AjaxAnexo: Para obtener las rutas de los archivos en anexos
	========================================================================================================================== */	
var documentosAnexo = new Array;

function ajaxAnexo(tipdocReq1,NomArcReq1,cantidadArchivo)
{
	var vCodTipReq 	= $('#'+tipdocReq1+" option:selected").val();
	var vDesTipReq 	= $('#'+tipdocReq1+" option:selected").text();		
	

// ------------------------------------------------------------ FUNCIONALIDAD PARA OBTENER RUTA DE LOS 4 ARCHIVOS
	var vNomFil     = "";
	var inputFileImage  = document.getElementById(NomArcReq1);
	var file = inputFileImage.files[0];
	vNomFil = file.name;
	console.log(vNomFil);
	var data = new FormData();
	
	data.append(NomArcReq1,file);

	FilaContent='';

	$.ajax({
		url: 'ajax/obtener_ruta.php',
		type: 'POST',
		data: data,
		contentType: false,
		cache: false,
		processData: false,
		beforesend: function(){
			console.log("beforesend");
		},
		success: function(response){
			var tbody   	= $("#tbArchivos tbody");
			var nFilas  	= 0;
			var idSolicitud = 0;
			var nFilas 		= $("#tbArchivos tr").length;
								 
			if ($("#id").length > 0){
				idSolicitud = $("#id").val();
			}

			vflag = "'S'";
			if(cantidadArchivo==4)
			{
					if(vCodTipReq=='2')
				{
					nFilas=1;
				}
				if(vCodTipReq=='11')
				{
					nFilas=2;
				}

				if(vCodTipReq=='15')
				{
					nFilas=3;
				}

				if(vCodTipReq=='5')
				{
					nFilas=4;
				}
			}
			if(cantidadArchivo==2)
			{
				
				if(vCodTipReq=='2')
				{
					nFilas=1;
				}
				if(vCodTipReq=='15')
				{
					nFilas=2;
				}
			}
			

			var FilaContent = FilaContent +'<tr id="fila'+ nFilas +'">'+
									'<td width=10% class="text-center">'+ nFilas +
									'<input type="hidden" value="'+response+'" name="fileAnexo[]">'+
									'</td>'+
									'<td width=10% class="text-center ColOculto">0</td>'+
									'<td width=10% class="text-center ColOculto">'+ vCodTipReq +'</td>'+
									'<td width=20% class="text-center">'+ vDesTipReq +'</td>'+
									'<td width=30% class="text-center">'+ vNomFil + '</td>'+
									'<td width=10% class="text-center fin">'+
										'<a href="#" class="btn btn-outline-info btnAccion" '+
										'onclick="eliminarAnexo('+ nFilas +','+ idSolicitud +',0,'+ vflag +');">'+
										'<i class="fa fa-trash" aria-hidden="true" title="Consultar observación" ></i> Eliminar</a>'+

									'</td>'+
									'<td width=10% class="text-center ColOculto">S</td>'+
								'</tr>';

			// Agregamos fila con datos en formato HTML
		
			$('#tbArchivos tbody').append(FilaContent);
			$("#"+tipdocReq1).val('1');

			// Resetear input file
			$("#"+NomArcReq1).val(null);
			$("#"+NomArcReq1).siblings(".custom-file-label").addClass("selected").html('Seleccionar archivo');
		
		}
	
		
		
	});
		

	documentosAnexo.forEach(function(persona, index) {
		console.log("Persona " + index + " | Nombre: " + persona.nFilas + " Edad: " + persona.nFilas)
	  });


	
	

// ------------------------------------------------------------ FUNCIONALIDAD PARA OBTENER RUTA
}


/*  ==========================================================================================================================
	Eliminar : ANEXO
	========================================================================================================================== */
	function eliminarAnexo(fila,idSol,idAnx,flgNuevo){
		if(flgNuevo == 'S'){		
			// elimina de la lista en función al item de la tabla (lenght)
			   $("#tbArchivos #fila" + fila).remove();	
			   
			//habilitar el boton de agregar otros documentos en anexo
			document.getElementById("btnAgregarAnx").disabled = false; // habilitar
		

		}else{

			$.ajax({
				url: 'ajax/eliminarAnexo.php',
				type: 'POST',
				dataType: 'html',
				data: {idSolicitud: idSol,idAnexo: idAnx},
			})
			.done(function(respuesta) {
				$("#tbArchivos #fila" + fila).remove();
			})
				.fail(function() {
				console.log("error");
			})
				.always(function() {
				console.log("complete");
			});
			
		}
		
    }
/*  ==========================================================================================================================
	Eliminar : PRETENSION
	========================================================================================================================== */	
	function eliminarPretension(index) {  		
    	$("#tbPretensiones #fila" + index).remove();
	}
/*  ==========================================================================================================================
	Eliminar : DESIGNACION DE ARBITRO
	========================================================================================================================== */	
	function eliminarDesignacionArbitro(index,txtTipoArbitro) {  		
		if(txtTipoArbitro=='Presidente Arbitral')
		{
			myArrayTipoArbitro=[];
			contadorPre=0;
		}
    	$("#tbListadoArbitro #fila" + index).remove();
		
	}

	
/*  ==========================================================================================================================
	Editar : PRETENSION
	========================================================================================================================== */	
	function editarPretension(index) {  		
  
		
    	var vDesPretension = $("#tbPretensiones #fila" + index + " #nColum2").html();
		
    	$("#DesPretension").val(vDesPretension);

    	$("#idPretensionEdit").val(index);

    	// Cambiar nombre de boton
    	$("#btnAgregar").html('<i class="fa fa-pencil"></i> Actualizar');

    	// Cambiar estilos de botones
		$("#btnAgregar").removeClass('btn-outline-success');
		$("#btnAgregar").addClass('btn-outline-danger');

	}

	/*  ==========================================================================================================================
	Editar : PRETENSION
	========================================================================================================================== */	
	function editarDesignacionArbitro(index) {  		
  
		$("#tbListadoArbitro #fila1 #nColum2").html();
    	var VapeNomArb = $("#tbListadoArbitro #fila" + index + " #nColum1").html();
		var VDesDirArb = $("#tbListadoArbitro #fila" + index + " #nColum2").html();
		var VNumTelArb = $("#tbListadoArbitro #fila" + index + " #nColum3").html();
		var VDirEmaArb = $("#tbListadoArbitro #fila" + index + " #nColum4").html();
		var VNomProArb = $("#tbListadoArbitro #fila" + index + " #nColum5").html();
		var VNumColArb = $("#tbListadoArbitro #fila" + index + " #nColum6").html();
		var VTipoArbitro = $("#tbListadoArbitro #fila" + index + " #nColum7").html();
		var FlgRegArb = $("#tbListadoArbitro #fila" + index + " #nColum8").html();
	
    	$("#txtApeNomArb").val(VapeNomArb);
		$("#txtDesDirArb").val(VDesDirArb);
		$("#txtNumTelArb").val(VNumTelArb);
		$("#txtDirEmaArb").val(VDirEmaArb);
		$("#txtNomProArb").val(VNomProArb);
		$("#txtNumColArb").val(VNumColArb);
		$("#txtTipoArbitro").val(VTipoArbitro);
		

    	$("#idDesArbitroEdit").val(index);

    	// // Cambiar nombre de boton
    	$("#btnAgregarAnxArbitro").html('<i class="fa fa-pencil"></i> Actualizar');

    	// Cambiar estilos de botones
		$("#btnAgregarAnxArbitro").removeClass('btn-outline-success');
		$("#btnAgregarAnxArbitro").addClass('btn-outline-danger');

	}

	
/*  ==========================================================================================================================
	Numero : Formato letra
	========================================================================================================================== */	
	function Unidades(num){

		switch(num)
		{
		  case 1: return "UN";
		  case 2: return "DOS";
		  case 3: return "TRES";
		  case 4: return "CUATRO";
		  case 5: return "CINCO";
		  case 6: return "SEIS";
		  case 7: return "SIETE";
		  case 8: return "OCHO";
		  case 9: return "NUEVE";
		}
	  
		return "";
	  }
	  
	  function Decenas(num){
	  
		decena = Math.floor(num/10);
		unidad = num - (decena * 10);
	  
		switch(decena)
		{
		  case 1:   
			switch(unidad)
			{
			  case 0: return "DIEZ";
			  case 1: return "ONCE";
			  case 2: return "DOCE";
			  case 3: return "TRECE";
			  case 4: return "CATORCE";
			  case 5: return "QUINCE";
			  default: return "DIECI" + Unidades(unidad);
			}
		  case 2:
			switch(unidad)
			{
			  case 0: return "VEINTE";
			  default: return "VEINTI" + Unidades(unidad);
			}
		  case 3: return DecenasY("TREINTA", unidad);
		  case 4: return DecenasY("CUARENTA", unidad);
		  case 5: return DecenasY("CINCUENTA", unidad);
		  case 6: return DecenasY("SESENTA", unidad);
		  case 7: return DecenasY("SETENTA", unidad);
		  case 8: return DecenasY("OCHENTA", unidad);
		  case 9: return DecenasY("NOVENTA", unidad);
		  case 0: return Unidades(unidad);
		}
	  }//Unidades()
	  
	  function DecenasY(strSin, numUnidades){
		if (numUnidades > 0)
		  return strSin + " Y " + Unidades(numUnidades)
	  
		return strSin;
	  }//DecenasY()
	  
	  function Centenas(num){
	  
		centenas = Math.floor(num / 100);
		decenas = num - (centenas * 100);
	  
		switch(centenas)
		{
		  case 1:
			if (decenas > 0)
			  return "CIENTO " + Decenas(decenas);
			return "CIEN";
		  case 2: return "DOSCIENTOS " + Decenas(decenas);
		  case 3: return "TRESCIENTOS " + Decenas(decenas);
		  case 4: return "CUATROCIENTOS " + Decenas(decenas);
		  case 5: return "QUINIENTOS " + Decenas(decenas);
		  case 6: return "SEISCIENTOS " + Decenas(decenas);
		  case 7: return "SETECIENTOS " + Decenas(decenas);
		  case 8: return "OCHOCIENTOS " + Decenas(decenas);
		  case 9: return "NOVECIENTOS " + Decenas(decenas);
		}
	  
		return Decenas(decenas);
	  }//Centenas()
	  
	  function Seccion(num, divisor, strSingular, strPlural){
		cientos = Math.floor(num / divisor)
		resto = num - (cientos * divisor)
	  
		letras = "";
	  
		if (cientos > 0)
		  if (cientos > 1)
			letras = Centenas(cientos) + " " + strPlural;
		  else
			letras = strSingular;
	  
		if (resto > 0)
		  letras += "";
	  
		return letras;
	  }//Seccion()
	  
	  function Miles(num){
		divisor = 1000;
		cientos = Math.floor(num / divisor)
		resto = num - (cientos * divisor)
	  
		strMiles = Seccion(num, divisor, "UN MIL", "MIL");
		strCentenas = Centenas(resto);
	  
		if(strMiles == "")
		  return strCentenas;
	  
		return strMiles + " " + strCentenas;
	  
		//return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
	  }//Miles()
	  
	  function Millones(num){
		divisor = 1000000;
		cientos = Math.floor(num / divisor)
		resto = num - (cientos * divisor)
	  
		strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
		strMiles = Miles(resto);
	  
		if(strMillones == "")
		  return strMiles;
	  
		return strMillones + " " + strMiles;
	  
		//return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
	  }//Millones()
	  
	  function NumeroALetras(num){
		var data = {
		  numero: num,
		  enteros: Math.floor(num),
		  centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
		  letrasCentavos: "",
		  letrasMonedaPlural: "",
		  letrasMonedaSingular: ""
		};
	  
		if (data.centavos > 0)
		  data.letrasCentavos = "CON " + data.centavos + "/100";
	  
		if(data.enteros == 0)
		  return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
		if (data.enteros == 1)
		  return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
		else
		  return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
	  }//NumeroALetras()