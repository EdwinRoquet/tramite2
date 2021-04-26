/*
	Librería de Funciones
	Autor : David Montenegro Sarmiento
	Email : davidyus85@hotmail.com
	fecha : 29/07/2020

	Lista de funciones :
	1.  BuscarSolicitudArbitraje(flgmsaprt)  			=> Buscar solicitud de arbitraje
	2.  ModalTramiteListado(idsolicitud)				=> Mostrar ventana de lista de trámites
	3.  ModalTramiteRegistro(idsolicitud)				=> Mostrar ventana registro de trámite
	4.  RegistrarTramite()								=> Proceso de registro de trámite
	5.  BuscarMedidaCautelar()							=> Buscar solicitudes por medida cautelar 	  			=> 30/07/2020 04:50 pm
	6.  BuscarSolicitudPendienteRespuesta()  			=> Buscar solicituides pendientes a responder 			=> 07/08/2020 02:15 am
	7.  RecepcionarEnvio(idSol,idRut,idUsr)				=> Recepcionar Solicitud enviada			  			=> 07/08/2020 03:56 pm
	8.  GenerarAdmision(id,usuario)						=> Admitir Solicitud por SECRETARIA GENERAL	  			=> 07/08/2020 05:33 pm
	9.  GenerarObservacion(id,idarea,asunto,usuario)	=> Generar observación por SECRETARIA GENERAL 			=> 08/08/2020 01:00 am
	10. GenerarDerivacion()								=> Generar derivación de solicitud de un área a otra	=> 08/08/2020 01:18 am
    11. NotificarDemandado()                            => Notificar a demandado.                               => 08/08/2020 11:30 pm
    12. RegistrarRespuestaDemanda()                     => Registrar respuesta de demandada (DEMANDADO)         => 08/08/2020 08:47 pm

    13. RegistrarMedidaCautelar()                       => Registrar Medida cautelar                            => 10/08/2020 11:01 pm

    MESA DE PARTES
    --------------------------------------------------
    14. BuscarSolicitudRecepcionar()                    => Solicitudes pendientes de recepción                  => 16/08/2020 06:54 pm
    15. AsignarArbitro(idSol,idUsuario)                 => Asignar arbitros a proceso de solicitud              => 16/08/2020 08:11 pm

    ATENCION DE DOCUMENTO
    --------------------------------------------------
    16. Admitir()										=> Ventana modal de admisión de documento 				=> 20/08/2020 09:08 pm
    17. Observacion()									=> Ventana modal de observación 						=> 20/08/2020 09:09 pm
    18. derivarSolicitud()								=> Ventana modal de derivación de Solicitud 			=> 20/08/2020 09:09 pm
    19.  BuscarSolicitudArbitrajeAdmitidas(flgmsaprt)  	=> Buscar solicitud de arbitraje admitidas

*/
/* =============================================================
FUNCION : 01 BUSCAR SOLICITUD DE ARBITRAJE 
================================================================*/
function BuscarSolicitudArbitraje(flgmsaprt){
   
	var pnumSol = $('#NumSolArb').val();
	var pcodUsr = $('#idUsuario').val();

   $('#tblCasillaElectronica').DataTable({
   		"destroy":true,
		"ajax":{
			"url": "ajax/ajax-consulta.php",
			dataSrc: 'data',
			"data" : {
						"NumSolArb" : pnumSol,
						"flgmsaprt" : flgmsaprt,
						"idusuario" : pcodUsr
					},
			"type": "POST"
		},
		"columnDefs": [
						{"className": "dt-center", "targets": "_all"}
  					],
		columns : [
	    			{
	    				data : 'id',
	    				render:function(data){
	    					var html = '<a class="btn btn-info btnAccion" href="#" onclick="ModalTramiteListado('+ data +')"><i class="fa fa-envelope-o"></i></a>';
	    					return html
	    				}
	    			},
	    			{data : 'NumSol'},
	    			{data : 'FchCreSol'},
	    			{data : 'RazSocDem'},
	    			{data : 'RazSocDmd'},
	    			{
	    				data : 'desSit',
	    				render: function(data){
	    					if(data=='Por Firmar'){
								return '<span class="badge badge-warning btn-block">'+ data +'</span>'
	    					}else{
	    						return '<span class="badge badge-success btn-block">'+ data +'</span>'
	    					}
	    				}
	    			},
	    			{
	    				data : 'desEst',
	    				render: function(data){
	    					if(data == 'Pendiente'){
	    						return '<span class="badge badge-danger btn-block">'+ data +'</span>'

                            }else if(data == 'Recibido'){
                                return '<span class="badge badge-warning btn-block">'+ data +'</span>'

                            }else if(data == 'Admitido'){
                                return '<span class="badge badge-success btn-block">'+ data +'</span>'

	    					}else if(data == 'Observado'){
								return '<span class="badge badge-info btn-block">'+ data +'</span>'

	    					}
	    					
	    				}
	    			},
	    			{
	    				data : 'idSol',
	    				render: function(data){
	    					var data = data.split('-');
	    					var codSol = data[0];
	    					var desSit = data[1];

	    					var html  = '<a href="#" class="btn btn-info btnAccion" data-toggle="modal" data-target="#MdlHistorial" onclick="fnd_anexos('+ codSol +')">';
	   							html += '<i class="fa fa-files-o" aria-hidden="true" title="Historial de Anexos"></i> ANEXOS';
	   							html += '</a>';
	    					
	    					if(desSit == 'Por Firmar'){
	    						html += '<a href="edicionSolicitud.php?id='+ codSol +'" style="margin-left:2px;" class="btn btn-info btnAccion" id="btnEdicion">';
    							html += '<i aria-hidden="true" title="Editar Solicitud" class="fa fa-edit"></i> Editar';
    							html += '</a>';
	    					}else{
								html += '<a href="http://epsilon.pe/tramite/vistas/CrearCargoPdf.php?id='+ codSol +'" style="margin-left:2px;" class="btn btn-info btnAccion">';
    							html += '<i class="fa fa-download"></i> CARGO ';
			  					html += '</a>';

			  					html += '<a href="#" style="margin-left:2px;" class="btn btn-danger btnAccion" onclick="ModalTramiteRegistro('+ codSol +')">';
    							html += '<i class="fa fa-edit"></i> TRÁMITES ';
			  					html += '</a>';
	    					}        							
    							
	    					return html
	    				}
	    			}
				  ],
       	"language" : idioma_espanol,
  	  	"searching": false,
  	  	"ordering": false,
    	"lengthMenu": [[8, 15, 25, 35],[8, 15, 25, 35]]
	});

	/* limpiar cuadro de busqueda */
   	$('#NumSolArb').val('');
   	$('#NumMsaPrt').val('');
}
function BuscarSolicitudArbitrajeAdmitidas(flgmsaprt)
{
 
    var pnumSol = $('#NumSolArb').val();
	var pcodUsr = $('#idUsuario').val();

   $('#tblCasillaElectronicaAdmitidas').DataTable({
   		"destroy":true,
		"ajax":{
			"url": "ajax/ajax-consulta-solicitud-admitidas.php",
			dataSrc: 'data',
			"data" : {
						"NumSolArb" : pnumSol,
						"flgmsaprt" : flgmsaprt,
						"idusuario" : pcodUsr
					},
			"type": "POST"
		},
		"columnDefs": [
						{"className": "dt-center", "targets": "_all"}
  					],
		columns : [
	    		
	    			{data : 'NumSol'},
	    			{data : 'FchCreSol'},
	    			{data : 'RazSocDem'},
	    			{data : 'RazSocDmd'},
	    			
	    			{
	    				data : 'desEst',
	    				render: function(data){
	    					if(data == 'Pendiente'){
	    						return '<span class="badge badge-danger btn-block">'+ data +'</span>'

                            }else if(data == 'Recibido'){
                                return '<span class="badge badge-warning btn-block">'+ data +'</span>'

                            }else if(data == 'Admitido'){
                                return '<span class="badge badge-success btn-block">'+ data +'</span>'

	    					}else if(data == 'Observado'){
								return '<span class="badge badge-info btn-block">'+ data +'</span>'

	    					}
	    					
	    				}
	    			},
	    			{
	    				data : 'idSol',
	    				render: function(data){
	    					var data = data.split('-');
	    					var codSol = data[0];
	    					var desSit = data[1];
                            
	    					var html  = '<a href="#" class="btn btn-info btnAccion" data-toggle="modal" data-target="#MdlArbitro" onclick="ModalSolicitudId('+ codSol +')">';
	   							html += '<i class="fa fa-user"></i> ASIGNAR';
	   							html += '</a>';
	    					return html
	    				}
	    			}
				  ],
       	"language" : idioma_espanol,
  	  	"searching": false,
  	  	"ordering": false,
    	"lengthMenu": [[8, 15, 25, 35],[8, 15, 25, 35]]
	});

	/* limpiar cuadro de busqueda */
   	$('#NumSolArb').val('');
   	$('#NumMsaPrt').val('');
}

function ModalSolicitudId(id_solicitud)
{
    $("#id_solicitud").val(id_solicitud);
    /* =============================================================
    FUNCION : Para listar los arbitros asignados  con anterioridad 
    ================================================================*/
    ListadoArbitroAsignadas(id_solicitud);
}
 /* =============================================================
    FUNCION : Metodo Para listar los arbitros asignados con anterioridad 
    ================================================================*/
function ListadoArbitroAsignadas(id_solicitud)
{
    $('#tbListadoArbitroAsignada').DataTable({
        "destroy":true,
     "ajax":
        {
         "url": "ajax/ajax-listado-arbitro-asignado.php",
          dataSrc: 'data',
         "data" : {
                     "id_solicitud" : id_solicitud,
                 },
         "type": "POST"
        },
     "columnDefs": [
                     {"className": "dt-center", "targets": "_all"}
                   ],
     columns : [
               
                 {data : 'nombre'},
                 {data : 'direccion'},
                 {data : 'celular'},
                 {data : 'mail'},
                 {data : 'profesion'},
                 {data : 'n_colegiatura'},
                 {data : 'osce'},
                 {data : 'tipo_arbitro'},
                 {
                    data : 'id_solicitud',
                    render: function(data)
                    { 
                       return '<a href="#" class="btn btn-danger " onclick="eliminarArbitro('+ data +')"> Eliminar </a>';   
                    }
                },
                
               ],
        "language" : idioma_espanol,
         "searching": false,
         "ordering": false,
     "lengthMenu": [[8, 15, 25, 35],[8, 15, 25, 35]]
 });
}


/* =============================================================
FUNCION : Eliminar arbitros asignados
================================================================*/

function eliminarArbitro(id)
{
 //    $.ajax({
	// 	url: 'ajax/ajax-eliminar-arbitro.php',
	// 	type: 'POST',
	// 	dataType: 'html',
	// 	data: 
 //            {
 //                 id:id,
	// 		},
	// })
	// .done(function(respuesta) {
		
	// 	swal("Eliminar !", "Se eliminó correctamente!", "success");
 //        ListadoArbitroAsignadas(id);
	// })
}
/* =============================================================
FUNCION : 02 MODAL TRAMITE
================================================================*/
function ModalTramiteListado(idsolicitud){
	
	$.ajax({
		url: 'ajax/ajax-solicitud-tramite.php',
		type: 'POST',
		dataType: 'html',
		data: {
				Operacion:'ListarTramite',
				idsolicitud : idsolicitud
				},
	})
	.done(function(respuesta) {
		
		$('#ContenidoListadoTramites').html(respuesta);

		$('#MdlTramiteLista').modal('show');
	})
}
/* =============================================================
FUNCION : 03 MODAL TRAMITE
================================================================*/
function ModalTramiteRegistro(idsolicitud){
	
	/* Reseteo de campos */
	$('#idsolicitud').val(idsolicitud);
  	$('#idsumilla').val(0);
  	$('#nomtramite').val('');
  	$('#referencia').val('');
  	$('#detalle').val('');

	$('#MdlTramite').modal('show');
	$('#MdlTramite').on('shown.bs.modal', function () {

	})
}
/* =============================================================
FUNCION : 04 REGISTRAR TRAMITE
================================================================*/
function RegistrarTramite(){

	var idsumilla = $('#idsumilla').val();
	if(idsumilla == 0){
		alert("Seleccione la Sumilla del trámite");
		return false
	}

	var form 	 = $('#frmtramite')[0];
	var formData = new FormData(form);
	
	var fileImg  = document.getElementById("ArchivoAdjunto");
	var file 	 = fileImg.files[0];
	formData.append('Operacion','GenerarTramite');

	if(file != undefined){
		formData.append('ArchivoAdjunto',file.name);
	}
	
	$.ajax({
		url: 'ajax/ajax-solicitud-tramite.php',
		type: 'POST',
		dataType: 'html',
		data: formData,
		contentType: false,
        cache: false,
        processData:false,
	})
	.done(function(respuesta) {
		console.log(respuesta);
		$('#MdlTramite').modal('toggle');
		$('#MdlTramite').on('hidden.bs.modal', function (e) {
  			swal({
                title: "Trámite generado",
                text: "El registro de su trámite se generó satisfactoriamente",
                type: "success"
            });
		})
	})
	
}

/* =============================================================
FUNCION : 05 BUSCAR MEDIDA CAUTELAR
================================================================*/
function BuscarMedidaCautelar(){

    idUsuario = $('#idUsuario').val();

    $('#tblMedidaCautelar').DataTable({
        "destroy":true,
        "ajax":{
            "url": "ajax/ajax-solicitud.php",
            dataSrc: 'data',
            "data" : {
                        "Operacion" : "BuscarMedidaCautelar",                   
                        "idUsuario" : idUsuario
                    },
            "type": "POST"
        },
        "columnDefs": [
                        {"className": "dt-center", "targets": "_all"}
                    ],
        columns : [
                    {data : 'NumSol'},
                    {data : 'FchCreSol'},
                    {data : 'RazSocDem'},
                    {data : 'RazSocDmd'},
                    {
                        data : 'desSit',
                        render: function(data){
                            if(data=='Por Firmar'){
                                return '<span class="badge badge-warning btn-block">'+ data +'</span>'
                            }else{
                                return '<span class="badge badge-success btn-block">'+ data +'</span>'
                            }
                        }
                    },
                    {
                        data : 'desest',
                        render: function(data){
                            if(data == 'Pendiente'){
                                return '<span class="badge badge-warning btn-block">'+ data +'</span>'  
                            }else{
                                return '<span class="badge badge-success btn-block">'+ data +'</span>'  
                            }
                            
                        }
                    },
                    {
                        data : 'id',
                        render: function(data){
                            var mensaje = "'Ventana de Ejemplo'";
                            var html = '<a href="#" class="btn btn-info btnAccion" onclick="alert('+mensaje+');"><i class="fa fa-search"></i> CONSULTAR </a>';
                            return html;
                        }
                    }
                    ],
        "language" : idioma_espanol,
        "searching": false,
        "ordering": false,
        "lengthMenu": [[8, 15, 25, 35],[8, 15, 25, 35]] 
    });
}
/* =============================================================
FUNCION : 06 BUSCAR SOLICITUD PENDIENTE DE RESPUESTA POR USUARIO
================================================================*/
function BuscarSolicitudPendienteRespuesta(){

	idUsuario = $('#idUsuario').val();

	$('#tblSolicitudArbitralDem').DataTable({
		"destroy":true,
		"ajax":{
			"url": "ajax/ajax-solicitud-respuesta.php",
			dataSrc: 'data',
			"data" : {
						"Operacion" : "Consulta",					
						"idUsuario" : idUsuario
					},
			"type": "POST"
		},
		"columnDefs": [
						{"className": "dt-center", "targets": "_all"}
  					],
		columns : [
	    			{data : 'NumSol'},
	    			{data : 'fchCreSol'},
	    			{data : 'RazSocDem'},
	    			{data : 'RazSocDmd'},
	    			{
	    				data : 'desSit',
	    				render: function(data){
	    					if(data=='Por Firmar'){
								return '<span class="badge badge-warning btn-block">'+ data +'</span>'
	    					}else{
	    						return '<span class="badge badge-success btn-block">'+ data +'</span>'
	    					}
	    				}
	    			},
	    			{
	    				data : 'desEst',
	    				render: function(data){
	    					if(data == 'Pendiente'){
	    						return '<span class="badge badge-warning btn-block">'+ data +'</span>'	
	    					}else{
	    						return '<span class="badge badge-success btn-block">'+ data +'</span>'	
	    					}
	    					
	    				}
	    			},
	    			{
	    				data : 'id',
	    				render: function(data){
	    					var html = '<a href="respuesta.php?id='+ data +'" class="btn btn-info btnAccion"><i class="fa fa-edit"></i> RESPUESTA </a>';
	    					return html;
	    				}
	    			}
				  ],
       	"language" : idioma_espanol,
  	  	"searching": false,
  	  	"ordering": false,
    	"lengthMenu": [[8, 15, 25, 35],[8, 15, 25, 35]]		
	});
}
/* =============================================================
7. RECEPCIONAR SOLICITUD ENVIADA PARA ATENCION
==============================================================*/
function RecepcionarEnvio(idSol,idRut,idUsr){
	$.ajax({
		url: 'ajax/ajax-atencion.php',
		type: 'POST',
		dataType: 'html',
		data: {
				Operacion: 'Recepcionar',
				idSolicitud : idSol,
				idRuta : idRut,
				idUsuario : idUsr
		},
	})
	.done(function(response) {
		if(response == 1){
            swal({
                	title: "Recepcionado",
                	text: "Solicitud recepcionada correctamente",
                	icon: "success"
                }).then((value)=>{
            		location.reload();    	
                });
        }
	})
}
/* =============================================================
8. GENERAR ADMISION DE SOLICITUD (SECRETARIA GENERAL)
==============================================================*/
function GenerarAdmision(id,idarea,asunto,usuario){

 var InfAtencion = $('#InfAtencion').val();
 var vNomCarAdm = $("#NomCarAdm").val();
 var data = new FormData();

    /*==========================================
    VALIDACIONES
    ===========================================*/
    if(InfAtencion == ''){
        alert('Observación obligatoria');
        return false
    }
    if(vNomCarAdm == ''){
        alert('Debe adjuntar un archivo para el proceso de Admisión');
        return false
    }

    /*==========================================
    CARGANDO ARCHIVO
    ===========================================*/
    var inputFileImage  = document.getElementById("NomCarAdm");
    var file = inputFileImage.files[0];

    /*==========================================
    AGREGANDO VALORES
    ===========================================*/
    //data.append('NomCarAdm',file);
    data.append('NomArcReq',file);
    data.append('idSolicitud',id);
    data.append('idArea',idarea);
    data.append('Asunto',asunto);
    data.append('idEstado',3);
    data.append('desObservacion', InfAtencion);
    data.append('idUsuario',usuario);
   
   /*==========================================
    GENERAR ADMISION
    ===========================================*/
    $.ajax({
        url: 'ajax/ajax-solicitud-observacion.php',
        type: 'POST',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
    })
    .done(function(response) {

       if(response == '1'){       
            $('#mdlAdmitir').modal('toggle');
            swal({
                title: "Admitido !",
                text: "Solicitud Admitida, puedo continuar el proceso !",
                icon: "success"
            })
            .then((valor)=>{
            	if(valor){
            		location.href='atencion.php';	
            	}
            });
       }else{
           $('#mdlAdmitir').modal('toggle');
            swal({
                title: "Advertencia",
                text: "Esta Solicitud ya se encuentra Admitida",
                icon: "warning"
            });    
       }
    })
}
/* =============================================================
9. GENERAR OBSERVACION DE SOLICITUD (SECRETARIA GENERAL)
==============================================================*/
function GenerarObservacion(id,idarea,asunto,usuario){

    var detinfo = $('#detinfo').val();
    var vNomFilSol = $("#NomArcReq").val();
    var data = new FormData();
    /*==========================================
    VALIDACIONES
    ===========================================*/
    if(detinfo == ''){
        alert('falta observación');
        return false
    }
    if(vNomFilSol == ''){
        alert('falta cargar archivo');
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
    data.append('idSolicitud',id);
    data.append('idArea',idarea);
    data.append('Asunto',asunto);
    data.append('idEstado',4);
    data.append('desObservacion', detinfo);
    data.append('idUsuario',usuario);
    /*==========================================
    GENERAR OBSERVACION
    ===========================================*/
    $.ajax({
        url: 'ajax/ajax-solicitud-observacion.php',
        type: 'POST',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
    })
    .done(function(response) {
       if(response == '1'){
            $('#mdlObservacion').modal('toggle');
            swal({
                title: "Observado !",
                text: "Solicitud Observada !",
                icon: "success"
            }).then((valor)=>{
                location.href='atencion.php';
            });
       }else{

            $('#mdlObservacion').modal('toggle');

            swal({
                title: "Advertencia",
                text: "Esta Solicitud ya se encuentra observada",
                icon: "warning"
            });    
       }
    })
}
/* =============================================================
10. GENERAR DERIVACION DE SOLICITUD DE UN AREA A OTRA
==============================================================*/
function GenerarDerivacion(){
    
    var pidSolicitud    = $('#idSolicitud').val();
    var pareaorigen     = $('#areaOrigen').val();
    var pareadestino    = $('#areaDestino').val();
    var ptipoDocumento  = $('#tipoDocumento').val();
    var ppara           = $('#para').val();
    var pasunto         = $('#asunto').val();
    var preferencia     = $('#referencia').val();
    var pcontenido      = $('#contenido').val();
    var vNomFilSol      = $("#NomArcReq").val();
    var vUsuOrigen      = $("#usuarioOrigen").val();
    var data            = new FormData();
    
    if(pareadestino == 0){
        alert('seleccione una área válida');
        return false
    }else if(ptipoDocumento == 0){
        alert('seleccione un tipo de documento valido o la opción "SIN DOCUMENTO"');
        return false
    }else if(ppara == 0){
        alert('seleccione un usuario válido');
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
    data.append('idtipdoc',ptipoDocumento);
    data.append('asunto',pasunto);
    data.append('referencia',preferencia);
    data.append('contenido',pcontenido);
    data.append('para',ppara);
    data.append('idareaenvio',pareaorigen);
    data.append('idareadestino',pareadestino);
    data.append('idUsuario',vUsuOrigen);
    /* =====================================
        REGISTRO DE RUTA (DERIVAR SOLICITUD)
     =======================================*/
     $.ajax({
         url: 'ajax/ajax-envio-mesapartes.php',
         type: 'POST',
         dataType: 'html',
         data: data,
         contentType: false,
         cache: false,
         processData: false,
     })
     .done(function(response) {

        /* 1. Captura de datos de ventana Derivación a Resumen */
        var vAreaDestino   = $("#areaDestino option:selected").text();
        var vDocInterno    = $("#tipoDocumento option:selected").text();
            vDocInterno    = vDocInterno.toUpperCase() +' '+ response;

        var vDesAsunto     = $("#asunto").val();
        var vDesReferencia = $("#referencia").val();

        $('#rareadestino').val(vAreaDestino);
        $('#rnumdocint').val(vDocInterno);
        $('#rasunto').val(vDesAsunto);
        $('#rreferencia').val(vDesReferencia);

        /* 2. Ocultar ventana de derivación */
        $('#mdlDerivarSolicitud').modal('toggle');

        /* 3. Al ocultar la ventana Derivación mostrar ventana Resumen*/
        $('#mdlDerivarSolicitud').on('hidden.bs.modal', function () {
            
            $('#mdlResumen').modal('show');

            $('#mdlResumen').on('hidden.bs.modal', function () {

                location.reload();

            })
        })
    })
}
/* =============================================================
11. NOTIFICAR A DEMANDADO PARA GENERAR RESPUESTA
==============================================================*/
function NotificarDemandado(idSolicitud,idUsuario){
    
    swal({
        title: "Notificación",
        text: "¿Está seguro que desea notificar al demandado?",
        icon: "warning",
        buttons: ["No", "Si"],
    }).then((value) => {
        if(value){

            $.ajax({
                url: 'ajax/ajax-solicitud.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    Operacion: 'NotificarDemandante',
                    idSolicitud : idSolicitud,
                    idUsuario   : idUsuario,
                },
            })
            .done(function(respuesta) {

                swal({
                    title: "Notificación",
                    text: "Demandado notificado satisfactoriamente.",
                    icon: "success"
                }).then((valor)=>{
                    location.reload();                    
                });
            })
        }
    });
}
/* =============================================================
12. REGISTRAR RESPUESTA DE DEMANDA (DEMANDADO)
==============================================================*/
function RegistrarRespuestaDemanda(idRespuesta){
    /* ---------------------------------------
    Validaciones 
    ----------------------------------------*/
    var cntErr = 0;
    var msgErr = '';

    /* Pestaña 01: Demandado -------------------------------------------------------------------------------------------------*/
    if($('#DesDomRea').val() == ''){ cntErr ++; msgErr += '<li>Domicilio real es obligatorio</li>';}
    if($('#ValSegTok').val() == ''){ cntErr ++; msgErr += '<li>Valor Token de seguridad obligatorio</li>';}
    if($('#NomRepLeg').val() == ''){ cntErr ++; msgErr += '<li>Apellidos y nombres de representante legal obligatorio</li>';}
    if($('#TipDocRep').val() == ''){ cntErr ++; msgErr += '<li>Tipo de documento de representante legal obligatorio</li>';}
    if($('#txtNumDocRep').val() == ''){ cntErr ++; msgErr += '<li>Número de documento de representante legal obligatorio</li>';}
    if($('#txtNumTelRep').val() == ''){ cntErr ++; msgErr += '<li>Número telefónico de representante legal obligatorio</li>';}
    if($('#txtNumCelRep').val() == ''){ cntErr ++; msgErr += '<li>Número celular de representante legal obligatorio</li>';}
    if($('#txtDirEmaRep').val() == ''){ cntErr ++; msgErr += '<li>Email de representante legal obligatorio</li>';}

    /* Pestaña 02 : Designación de Arbitro -----------------------------------------------------------------------------------*/
    if(!$("#FlgPrtArb").prop('checked') && !$("#FlgUniArb").prop('checked')){
        if($("#txtApeNomArb").val() == ''){
            cntErr ++;
            msgErr += '<li> Tipo de designación de Árbitro ó nombre de Árbitro a designar obligatoria</li>';
        }
    }

    /* Pestaña 03: Información Adicional -------------------------------------------------------------------------------------*/
    if($('#detposdem').val() == ''){ cntErr ++; msgErr += '<li>Posición de demandado obligatorio</li>';}
    if($('#detprecon').val() == ''){ cntErr ++; msgErr += '<li>Detalle de pretensión de reconvención obligatorio</li>';}
    if($('#detcuacon').val() == ''){ cntErr ++; msgErr += '<li>Detalle de cuantía obligatorio</li>';}

    if(cntErr != 0){
        $('#bodyValidacionRespuesta').html(msgErr);
        $('#MdlValidacionRespuesta').modal('show');      
        return false;
    }

    /* Validar Token */
    $.ajax({
        url: 'ajax/ajax-solicitud.php',
        type: 'POST',
        dataType: 'html',
        data: { Operacion: 'ValidaToken',
                idRespuesta: idRespuesta,
                ValSegTok : $('#ValSegTok').val()
            },
    })
    .done(function(respuesta) {

        if(respuesta == '1'){

            /* ---------------------------------------
            Registro 
            ----------------------------------------*/
            var form     = $('#frmSolicitudRespuesta')[0];
            var formData = new FormData(form);
           
            /* agregar imagen 1*/ 
            var fileImg01  = document.getElementById("NomArcReq01");
            var file01       = fileImg01.files[0];
            if(file01 != undefined){ formData.append('NomArcReq01',file01.name);}

            /* agregar imagen 2*/ 
            var fileImg02  = document.getElementById("NomArcReq02");
            var file02       = fileImg02.files[0];
            if(file02 != undefined){ formData.append('NomArcReq02',file02.name);}

            /* agregar imagen 3*/ 
            var fileImg03  = document.getElementById("NomArcReq03");
            var file03       = fileImg03.files[0];
            if(file03 != undefined){ formData.append('NomArcReq03',file03.name);}

            formData.append('Operacion','GenerarRespuesta');
            formData.append('idRespuesta',idRespuesta);  
            
            $.ajax({
                url: 'ajax/ajax-solicitud.php',
                type: 'POST',
                dataType: 'html',
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
            })
            .done(function(response) {

            	console.log(response);

                if(response == '1'){
                    swal({
                        title: "Respuesta de Solicitud",
                        text: "Solicitud respondida con exito",
                        icon: "success"
                    }).then((value)=>{
                        location.href='consulta-respuesta.php';                
                    })
                }
            })

        }else{
            swal({
               title: "Clave de Seguridad (Token)",
                text: "Valor incorrecto, verifique el mensaje enviado a su bandeja de correo.",
                icon: "error"
            });
        }
        
    });

    return false;
     
    /* ---------------------------------------
    Registro 
    ----------------------------------------*/
    var form     = $('#frmSolicitudRespuesta')[0];
    var formData = new FormData(form);
   
    /* agregar imagen 1*/ 
    var fileImg01  = document.getElementById("NomArcReq01");
    var file01       = fileImg01.files[0];
    if(file01 != undefined){ formData.append('NomArcReq01',file01.name);}

    /* agregar imagen 2*/ 
    var fileImg02  = document.getElementById("NomArcReq02");
    var file02       = fileImg02.files[0];
    if(file02 != undefined){ formData.append('NomArcReq02',file02.name);}

    /* agregar imagen 3*/ 
    var fileImg03  = document.getElementById("NomArcReq03");
    var file03       = fileImg03.files[0];
    if(file03 != undefined){ formData.append('NomArcReq03',file03.name);}

    formData.append('Operacion','GenerarRespuesta');
    formData.append('idRespuesta',idRespuesta);  
    
    $.ajax({
        url: 'ajax/ajax-solicitud.php',
        type: 'POST',
        dataType: 'html',
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
    })
    .done(function(response) {

        if(response == '1'){
            swal({
                title: "Respuesta de Solicitud",
                text: "Solicitud respondida con exito",
                icon: "success"
            }).then((value)=>{
                location.href='consulta-respuesta.php';                
            })
        }
    })
    
}   
/* =============================================================
13. REGISTRAR MEDIDA CAUTELAR
==============================================================*/
function RegistrarMedidaCautelar(idUsuario){
    /* --------------------------------------
    VALIDACIONES
    -----------------------------------------*/

    var form = document.getElementById("frmmedidacautelar");    
    /* --------------------------------------
    REGISTRO DE PRETENSIONES
    -----------------------------------------*/
    var filPretension = $("#tbPretensiones tr");
    
    $.each(filPretension, function(i, v){
        if(i!=0){
          var fila = {};

          fila.pretencion = $(this).find("td").eq(0).html();
          var campo     = document.createElement("input");
          campo.type    = "hidden";
          campo.name    = "pretenciones[]";
          campo.value   = JSON.stringify(fila);

          form.appendChild(campo);
        }
    });
    /* --------------------------------------
    REGISTRO DE ANEXOS
    -----------------------------------------*/
    var filArc = $("#tbArchivos tr");
    //var frmArc = document.getElementById("arbitraje");

    $.each(filArc,function(i,v){
        if( i!= 0 ){
            var fila = {};

            fila.idtipo     = $(this).find("td").eq(2).html();
            fila.tipo       = $(this).find("td").eq(3).html();
            fila.Archivo    = $(this).find("td").eq(4).html();
            fila.esNuevo    = $(this).find("td").eq(6).html();

            var campo   = document.createElement("input");
            campo.type  = "hidden";
            campo.name  = "anexos[]";
            campo.value = JSON.stringify(fila);

            form.appendChild(campo);
        }
    });


    var formData = new FormData($('#frmmedidacautelar')[0]);
    formData.append('Operacion','GenerarMedidaCautelar');
    formData.append('idUsuario',idUsuario);

    $.ajax({
        url: 'ajax/ajax-solicitud.php',
        type: 'POST',
        dataType: 'html',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
    })
    .done(function(respuesta) {

        console.log(respuesta);
        
        if(respuesta){
            swal({
                title:"Medida Cautelar",
                text:"registro generado",
                icon:"success",
            }).then((value)=>{
                //location.href = 'consulta.php';
                console.log('registrado');
            });
        }
    })   
}
/* =============================================================
14. BUSCAR SOLICITUDES PENDIENTES DE RECEPCION
==============================================================*/
function BuscarSolicitudRecepcionar(){
        
        var pRazSoc = $('#RazSocDem').val()
        var pNroSol = $('#NumSol').val()
        var pEstSol = $('#cboEstsol').val()

        /*Razon Social*/
        if(pRazSoc == ''){pRazSoc = '%';}
        else{pRazSoc = '%'+pRazSoc+'%';}

        /*Nro de Solicitud*/
        if(pNroSol == ''){pNroSol = '%';}
        else{pNroSol = '%'+pNroSol+'%';}        

        $('#tblRecepcion').DataTable({
            "destroy":true,
            "ajax":{
                "url": "ajax/ajax-recepcion-consulta.php",
                "data" : {
                    "RazSoc" : pRazSoc,
                    "NroSol" : pNroSol,
                    "EstSol" : pEstSol  
                },
                "type": "POST",
            },
            "columnDefs": [
                            {"className": "dt-center", "targets": [0,1,2,6,7,8]}
                           ],
            columns : [
                        {data : 'row'},
                        {data : 'NumSol'},
                        {data : 'FchCreSol'},
                        {data : 'destipsol'},
                        {data : 'nomraz'},
                        {
                            data : 'desEst',
                            render: function(data){
                              if(data == 'Pendiente'){
                                return '<span class="badge badge-danger btn-block">'+ data +'</span>'
                                
                              }else if(data == 'Recibido'){
                                return '<span class="badge badge-warning btn-block">'+ data +'</span>'

                              }else if(data == 'Admitido'){
                                return '<span class="badge badge-success btn-block">'+ data +'</span>'

                              }else if(data == 'Observado'){
                                return '<span class="badge badge-info btn-block">'+ data +'</span>'
                              }
                            }
                        },
                        {
                            data : 'idSolEst',
                            render: function(data){

                                var data   = data.split('-');
                                var idSol  = data[0]; /* codigo de solicitud */
                                var desEst = data[1]; /* descripción de estado */
                                var NumEnv = data[2]; /* Numero de envios */
                                var tipsol = data[3]; /* Tipo de solicitud */

                                var html = '';

                                /* Detalle de solicitud */
                                if (tipsol == 1){

                                    html += '<a href="recepciondetalle.php?id='+idSol+'" class="btn btn-primary btnAccion" title="Detalle de Solicitud">';
                                    html += '<i class="fa fa-search" ></i>';
                                    html += '</a>';    

                                }else{
                                
                                    html += '<a href="detallemedidacautelar.php?id='+idSol+'" class="btn btn-primary btnAccion" title="Detalle de Solicitud">';
                                    html += '<i class="fa fa-search" ></i>';
                                    html += '</a>';    
                                }
                                
                                    
                                return html
                            }
                        },
                        {
                            data : 'idSolEst',
                            render: function(data){

                                var data   = data.split('-');
                                var idSol  = data[0]; /* codigo de solicitud */
                                var desEst = data[1]; /* Estado de solicitud */
                                var cntenv = data[2]; /* Numero de rutas o envios */
                                
                                /* Hoja de Ruta*/
                                var html = '<a href="envios.php?id='+idSol+'" class="btn btn-warning btnAccion" title="Hoja de Ruta" style="margin-left:2px;">';
                                    html += '<i class="fa fa-line-chart"></i>';
                                    html += '</a>';
                                    
                                    return html 
                            }
                        },
                        {
                            data : 'idSolEst',
                            render: function(data){

                                var data   = data.split('-');
                                var idSol  = data[0]; /* codigo de solicitud */
                                var desEst = data[1]; /* Estado de solicitud */
                                var cntenv = data[2]; /* Numero de rutas o envios */
                                var html   = '';

                                /* Derivar Solicitud */
                                if(desEst == 'Recibido' && cntenv == 0){
                                    html += '<a href="#" onclick="derivarSolicitud('+idSol+')" class="btn btn-danger btnAccion" title="Derivar Solicitud" style="margin-left:2px;" >';
                                    html += '<i class="fa fa-tags"></i> ';
                                    html += '</a>';
                                }
                                
                                return html 
                            }
                        }
                      ],
        "language" : idioma_espanol,
        "searching": false,
        "ordering": false,
        "lengthMenu": [[5, 10, 15, 20],[5, 10, 15, 20]]
        });
}
/* =============================================================
15. ASIGNAR ARBITRO
==============================================================*/
function AsignarArbitro(idSol,idUsuario){

    $.ajax({
        url: 'ajax/ajax-solicitud.php',
        type: 'POST',
        dataType: 'html',
        data: {
            Operacion: 'AsignarArbitro',
            idSolicitud : idSol
            },
    })
    .done(function(response) {
        
        $('#bodyAsignacionArbitro').html(response);

        $('#mdlAsignarArbitro').modal('show');
        
    })    
}
/* =============================================================
16. ADMITIR DOCUMENTO
==============================================================*/
function Admitir(){
        $('#InfAtencion').html('ADMITE SOLICITUD DE ARBITRAJE Y NOTIFICA A LAS PARTES');
        $('#mdlAdmitir').modal('show');    
   }

/* =============================================================
17. OBSERVAR DOCUMENTO
==============================================================*/
 function Observacion(){
        $('#detinfo').val('');
        $('#mdlObservacion').modal('show');
   }
/* =============================================================
18. DERIVAR SOLICITUD
==============================================================*/
function derivarSolicitud(id){
        $('#idSolicitud').val(id);
        $('#mdlDerivarSolicitud').modal('show');
   }