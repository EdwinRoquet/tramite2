
$(document).ready(function(){

	buscarAtencion();

	$('#btnBuscarDocPend').click(function(){	
		buscarAtencion();
	})

	$('#btnAteDoc').click(function(){	
		$('#mdlAtendersolicitud').modal('show');
	})

    $('#btndocAnx').click(function(){   
        $('#mdldocumentosAnexos').modal('show');
    })

	$('#btndocAdj').click(function(){	
		$('#mdldocumentosAdjuntos').modal('show');
	})  
    
	$('#btnGenerarEnvio').click(function(){
        /* =====================================
           VALIDACIONES 
         =======================================*/
        var pidSolicitud    = $('#idSolicitud').val();
        var pareaorigen     = $('#areaOrigen').val();
        var pareadestino    = $('#areaDestino').val();
        var ptipoDocumento  = $('#tipoDocumento').val();
        var ppara           = $('#para').val();
        var pasunto         = $('#asunto').val();
        var preferencia     = $('#referencia').val();
        var pcontenido      = $('#contenido').val();
        var vNomFilSol      = $("#NomArcReq_atencion").val();

        var vUsuOrigen      = $("#usuarioOrigen").val();

        var data            = new FormData();

        if(pareadestino == 0){
            alert('seleccione una área valida');
            return false
        }else if(ptipoDocumento == 0){
            alert('seleccione un tipo de documento');
            return false
        }else if(ppara == 0){
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
        var inputFileImage  = document.getElementById("NomArcReq_atencion");
        var file = inputFileImage.files[0];

        /*==========================================
        AGREGANDO VALORES
        ===========================================*/
        data.append('NomArcReq_atencion',file);
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
             url: 'ajax/ajax-solicitud-envio.php',
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
            $('#mdlAtendersolicitud').modal('toggle');

            /* 3. Al ocultar la ventana Derivación mostrar ventana Resumen*/
            $('#mdlAtendersolicitud').on('hidden.bs.modal', function () {
                
                // copiar resumen
                $('#mdlResumen').modal('show');

                $('#mdlResumen').on('hidden.bs.modal', function () {
                	
                    location.href='atencion.php';

                })

            })

         })        

	})

})

/* ====================================================================================================
FUNCIONES
=======================================================================================================*/

/* ========================================
1. BUSCAR SOLICITUD PENDIENTE DE ATENCION
===========================================*/
function buscarAtencion(){
		
		/* 1. Captura de datos */
		var numsol = $('#NumSol').val();
		var recsol = $('#cboRecepcionado').val();
        var codare = $('#areaOrigen').val();

		/*Nro de Solicitud*/
        if(numsol == ''){numsol = '%';}
        else{numsol = '%'+numsol+'%';}

		$('#tblAtencion').DataTable({
			"destroy":true,
            "ajax":{
                "url": "ajax/ajax-atencion.php",
                "data" : {
                	"Operacion" : 'Buscar',
                    "numsol" : numsol,
                    "recsol" : recsol,
                    "codare" : codare
                },
                "type": "POST",
            },
            "columnDefs": [
                            {"className": "dt-center", "targets": [0,1,2,5,6]}
                           ],
			 columns : [
                        {data : 'row'},
                        {data : 'NumSol'},
                        {data : 'fchenvio'},
                        {
                            data : 'desarea'
                        },
                        {data : 'asunto'},
                        {
                            data : 'desest',
                            render: function(data){
                                if(data == 'Pendiente'){
                                    return '<span class="badge badge-warning btn-block">'+ data +'</span>'  
                                }else if(data == 'Observado'){
                                    return '<span class="badge badge-info btn-block">'+ data +'</span>'  
                                }else{
                                    return '<span class="badge badge-success btn-block">'+ data +'</span>'  
                                }
                            }
                        },
						{
							data : 'flgrecepcion',
							render: function(data){
								
								if(data=='N'){
									return '<span class="badge badge-danger btn-block">Pendiente</span>'
								}else{
									return '<span class="badge badge-success btn-block">Recepcionado</span>'
								}
							}
						},
						{	
							data : 'item',
							render: function(data){
                                data = data.split('-');
                                var idSolicitud = data[0];
                                var idRuta      = data[1];
                                var flgrecibido = data[2];
                                var parametro   = idSolicitud +'-'+idRuta;
 
                                    html = '<a href="atenciondetalle.php?id='+parametro+'" class="btn btn-primary btnAccion" title="Detalle de Solicitud">';
                                    html += '<i class="fa fa-search" ></i>';
                                    html += '</a>';

                                    return html
							}
						}

                       ],
            "language" : idioma_espanol,
        	"searching": false,
            "ordering":false,
        	"lengthMenu": [[5, 10, 15, 20],[5, 10, 15, 20]]           
		});
}