$(document).ready(function(){

	buscarEnviados();

	/* ==========================================
	BUSCAR DOCUMENTOS ATENDIDOS
	=============================================*/	
	$('#btnBuscarEnviados').click(function(){	
		buscarEnviados();
	})

});


function buscarEnviados(){
	/* 1. Captura de datos */
		var numsol = $('#NumSolEnv').val();
		var codare = $('#areaOrigen').val();
		
		/*Nro de Solicitud*/
        if(numsol == ''){numsol = '%';}
        else{numsol = '%'+numsol+'%';}

		$('#tblEnviados').DataTable({
			"destroy":true,
            "ajax":{
                "url": "ajax/ajax-atencion.php",
                "data" : {
                	"Operacion" : 'BuscarEnviados',
                    "numsol" : numsol,
					"codare" : codare
                },
                "type": "POST",
            },
            "columnDefs": [
                            {"className": "dt-center", "targets": [0,1,2,5,6]}
                           ],
			 columns : [
                        {data : 'row'},
                        {
                        	data : 'Numsol',
                        	render: function(data){
                        		return '<a href="" class="btn btn-primary btnAccion"><i class="fa fa-search"></i> '+data+'</a>'
                        	}
                        },
                        {data : 'fchenvio'},
                        {data : 'desarea'},
                        {data : 'asunto'},
						{
							data : 'flgrecepcion',
							render: function(data){
								
								if(data=='N'){
									return '<span class="badge badge-danger btn-block"> Pendiente</span>'
								}else{
									return '<span class="badge badge-success btn-block"> Recepcionado</span>'
								}

							}
						},
						{	
							data : 'item',
							render: function(data){

								var data = data.split("-");

                                var html  = '<button class="btn btn-warning btnAccion" title="Editar" onclick="EditarAtencion('+data[0]+','+data[1]+')">';
                                    html += '<i class="fa fa-pencil" ></i>';
                                    html += '</button>';

                                    html += ' <button class="btn btn-danger btnAccion" title="Anular" onclick="AnularAtencion('+data[0]+','+data[1]+')">';
                                    html += '<i class="fa fa-close"></i>';
                                    html += '</button>';

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

function EditarAtencion(sol,rut){
	
	$('#idSolicitud').val(sol);
	$('#idRuta').val(rut);

	$.ajax({
			url: 'ajax/ajax-consulta-ruta.php',
			type: 'POST',
			dataType: "json",
			data: {
					idSolicitud: sol,
					idRuta: rut
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
			$('#mdlEditarEnvio').modal('show');

		})

}
function AnularAtencion(sol,rut){

		$.ajax({
			url: 'ajax/ajax-anular-ruta.php',
			type: 'POST',
			dataType: 'html',
			data: {
				    idSolicitud: sol,
				    idRuta: rut
			      },
		})
		.done(function(response) {

			if(response == 1){

				//$('#mdlEditarEnvio').modal('toggle');

	            /* 3. Al ocultar la ventana Derivación mostrar ventana Resumen*/
	            //$('#mdlEditarEnvio').on('hidden.bs.modal', function () {
	                
                swal({
                        title: "Envio Anulado",
                        text: "Se anuló el envio seleccionado",
                        type: "success"
                    },
                    function(){
                       // Actualizamos la página actual
                       location.reload();
                    });
	            //})
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

}