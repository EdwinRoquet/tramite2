
$(document).ready(function(){

	BuscarArea();

	/*  =======================================
		BUSCAR USUARIO
   		=======================================*/
		$("#btnBuscarArea").click(function(){
			BuscarArea();
		});

	/*	=================================================
  		NUEVO USUARIO
  		=================================================*/	
	  	$('#btnNuevoUsr').click(function(){
	  		$('#idArea').val('');
			$('#desarea').val('');
		
			

	  		// Abrir modal
	  		$('#mdlUsrTit').html('<i class="fa fa-user"></i> Nueva Area');
			$('#mdlEditarArea').modal('show');
	  	})

	/*	=================================================
  		GUARDAR USUARIO
  		=================================================*/	
	  	$('#btnGuardarArea').click(function(){
	  	
			var idArea = $('#idArea').val();
	  		/*==============================
	  		  VALIDACION DE DATOS
	  		  ==============================*/
				if($('#desarea').val() ==''){
					swal({ title : "", text : "Nombre, obligatorio",type : "warning"});
  					return
	  			}else{

				  }
	  		/*==============================*/
	  		$.ajax({
	  			url: 'ajax/ajax-area-grabar.php',
	  			type: 'POST',
	  			dataType: 'html',
	  			data: $('#frmArea').serialize(),
	  		})
	  		.done(function(response) {

	  			if(response == 0){
	  				alert('error al grabar');
	  			}else{
	  				// Cerrar ventana modal
	  				$("#mdlEditarArea").modal("toggle");

	  				var stitulo = '';
	  				var sdescripcion = '';

	  				if(idArea == ''){
						stitulo = 'Area Creado';
						sdescripcion = 'Area creado satisfactoriamente';
	  				}else{
						stitulo = 'Area Actualizado';
						sdescripcion = 'Area actualizado satisfactoriamente';
	  				}

					swal(stitulo, sdescripcion, "success");
					
					BuscarArea();

	  			}
	  		})
		})
})


	/*=================================================
  	BUSCAR AREA
  	=================================================*/
	function BuscarArea(){

		var desarea = $("#desareaB").val();
	

		$('#tblArea').DataTable({
   			"destroy":true,
   			"ajax":{
   				"url": "ajax/ajax-area-consulta.php",
   				"data" : {
							"desarea" : desarea,
						},
				"type": "POST",
   			},
   			"columnDefs": [
							{"className": "dt-center", "targets": [0]}
      					],
   			columns : [
		    			{data : 'row'},
		    			{data : 'desarea'},
		    			{
		    				data : 'id',
		    				render: function(data){	    					

		    					var html  = '<a href="#" id="btnEditar" onclick="editarArea('+ data +')" class="btn btn-block btn-outline-info btnAccion">';
		   							html += '<i class="fa fa-edit"></i> Editar';
		   							html += '</a>';	    					
	    						    							
	    						return html
		    				}
		    			}
		    		  ],
		    "language" : idioma_espanol,
	  	  	"searching": false,
	    	"lengthMenu": [[8, 15, 20, 25],[8, 15, 20, 25]]
   		})



} 	/********************************************************************************/
	/*=================================================
   	 	Eliminar Area
  	=================================================*/	
		function EliminarArea(idArea){
		
        $.ajax({
            url: 'ajax/ajax-eliminar-area.php',
            type: 'POST',
            dataType: 'html',
            data: { 
                    id: idArea
                   },
        })
        .done(function(response) {
            if(response == '1'){
                swal("Area!", "Eliminada!", "success");
				BuscarArea();    
            }
        })
        
    }

	/*=================================================
  	EDITAR AREA
  	=================================================*/
	function editarArea(idArea){

		$('#idArea').val(idArea);

		$.ajax({
			url: 'ajax/ajax-area.php',
			type: 'POST',
			dataType: 'html',
			data: {idArea: idArea},
		})
		.done(function(response) {
			var dataUsuario = JSON.parse(response);
            console.log(dataUsuario);
			$('#idArea').val(dataUsuario[0]);
			$('#desarea').val(dataUsuario[1]);

		})	

		// abrir modal
		$('#mdlUsrTit').html('<i class="fa fa-edit"></i> Editar Area');
		$('#mdlEditarArea').modal('show');

		$('#mdlEditarArea').on('shown.bs.modal', function () {
	  		$('#myInput').trigger('focus')
		})
	}
