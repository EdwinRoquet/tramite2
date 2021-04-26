
$(document).ready(function(){
	   BuscarTasa();

	/*  =======================================
		BUSCAR TASA POR TIPO DE CALCULO
   		=======================================*/

	
		
	/*	=================================================
  		NUEVO TASA
  		=================================================*/	
	  
		$("#btnNuevoTasa").click(function() {
			
			$('#TextcuantiaMinima').val("");
			$('#TextcuantiaMaxima').val("");
			$('#textPorcentaje').val("");
			$('#textMontoMinimo').val("");
			$('#textMontoMaximo').val("");
			$('#tipo_calculo').val("");

			$('#mdlAreaTit').html('<i class="fa fa-user"></i> Nueva tasa');
			$("#mdlEditarTasa").modal("show");

		});
	/*	=================================================
  		GUARDAR TASA
  		=================================================*/	
	  	$('#btnGuardarTasa').click(function(){
	  	
			var idRegistro = $('#idRegistro').val();
	  		/*==============================
	  		  VALIDACION DE DATOS
	  		  ==============================*/
				if($('#TextcuantiaMinima').val() ==''){
					swal({ title : "", text : "Cuantia Mínima, obligatorio",type : "warning"});
  					return
	  			}else if($('#TextcuantiaMaxima').val() =='')
	  			{
	  				swal({ title : "", text : "Cuantia Máxima, obligatorio",type : "warning"});
  					return
	  			}
	  			else if($('#textPorcentaje').val() =='')
	  			{
	  				swal({ title : "", text : "Porcentaje, obligatorio",type : "warning"});
  					return
	  			}else if($('#textMontoMinimo').val() =='')
	  			{
	  				swal({ title : "", text : "Monto Mínimo, obligatorio",type : "warning"});
  					return
	  			}else if($('#textMontoMaximo').val() =='')
	  			{
	  				swal({ title : "", text : "Monto máximo, obligatorio",type : "warning"});
  					return
	  			}else if($('#cbTipoCalculo').val() =='')
	  			{
	  				swal({ title : "", text : "Tipo Cambio, obligatorio",type : "warning"});
  					return
	  			}
	  		/*==============================*/
	  		$.ajax({
	  			url: 'ajax/ajax-tasa-grabar.php',
	  			type: 'POST',
	  			dataType: 'html',
	  			data: $('#frmTasa').serialize(),
	  		})
	  		.done(function(response) {

	  			if(response == 0){
	  				alert('error al grabar');
	  			}else{
	  				// Cerrar ventana modal
	  				$("#mdlEditarTasa").modal("toggle");

	  				var stitulo = '';
	  				var sdescripcion = '';

	  				if(idRegistro == ''){
						stitulo = 'Tasa Creada';
						sdescripcion = 'Tasa creada satisfactoriamente';
	  				}else{
						stitulo = 'Tasa Actualizado';
						sdescripcion = 'Tasa actualizado satisfactoriamente';
	  				}

					swal(stitulo, sdescripcion, "success");
					
					BuscarTasa();

	  			}
	  		})

		})
})


	/*=================================================
  	BUSCAR TASA
  	=================================================*/
	function BuscarTasa(){

		console.log("hola22");
		var tasa = '';
		var cont1=0;
		var cont2=0;
		var cont3=0;
		var cont4=0;
		$('#tablaContenidoArbitroUnico').empty();
		$('#tablaContenidoTribunalArbitral').empty();
		$('#tablaContenidoSecretarioArbitral').empty();

		$.ajax({
	            url: 'ajax/ajax-tasa-consulta.php',
	            type: 'POST',
	            dataType: 'html',
                dataType: 'json',
	            data :{
						tasa : tasa,
					  },
	            
	        })
	        .done(function(response) {	
	        	
		             $.each(response.data, function(idx, item) 
          			 {
          				if(item.tipo_calculo=='Arbitro unico')
          				{	cont1=parseInt(cont1)+1;
          					$('#tablaContenidoArbitroUnico').append('<tr><td><span style="font-weight: bold;">'+cont1 +'</td><td> ' + item.cuantia_minimo + '</td><td>' + item.cuantia_maximo +' </td><td>'+item.porcentaje+ '</td><td>'+item.monto_minimo+'</td><td>'+item.monto_maximo+'</td><td><a href="#"  class="btn btn-outline-info" onclick="editarTasa('+ item.id_registro +')"> <i class="fa fa-edit"></i> Editar</a> </td><tr>');
          				}
          				if(item.tipo_calculo=='Tribunal arbitral')
          				{	cont2=parseInt(cont2)+1;
          					$('#tablaContenidoTribunalArbitral').append('<tr><td><span style="font-weight: bold;">'+cont2 +'</td><td> ' + item.cuantia_minimo + '</td><td>' + item.cuantia_maximo +' </td><td>'+item.porcentaje+ '</td><td>'+item.monto_minimo+'</td><td>'+item.monto_maximo+'</td><td><a href="#"  class="btn btn-outline-info" onclick="editarTasa('+ item.id_registro +')"> <i class="fa fa-edit"></i> Editar</a> </td><tr>');
          				}
          				if(item.tipo_calculo=='Secretaria arbitral')
          				{	
          					cont3=parseInt(cont3)+1;
          					$('#tablaContenidoSecretarioArbitral').append('<tr><td><span style="font-weight: bold;">'+cont3 +'</td><td> ' + item.cuantia_minimo + '</td><td>' + item.cuantia_maximo +' </td><td>'+item.porcentaje+ '</td><td>'+item.monto_minimo+'</td><td>'+item.monto_maximo+'</td><td><a href="#"  class="btn btn-outline-info" onclick="editarTasa('+ item.id_registro +')"> <i class="fa fa-edit"></i> Editar</a> </td><tr>');
          				}

          			});
	        })   

	

} 	/********************************************************************************/
	/*=================================================
   	 	Eliminar Area
  	=================================================*/	
	function EliminarTasa(id_registro)
	{
		
        $.ajax({
            url: 'ajax/ajax-eliminar-tasa.php',
            type: 'POST',
            dataType: 'html',
            data: { 
                    id_registro: id_registro
                   },
        })
        .done(function(response) {
            if(response == '1'){
                swal("Tasa!", "Eliminada!", "success");
				BuscarTasa();    
            }
        })
        
    }

	/*=================================================
  	EDITAR TASA
  	=================================================*/
	function editarTasa(id){

		$('#idRegistro').val(id);

		$.ajax({
			url: 'ajax/ajax-tasa.php',
			type: 'POST',
			dataType: 'html',
			data: {id_registro: id},
		})
		.done(function(response) {
			var dataTasa = JSON.parse(response);
           
			$('#TextcuantiaMinima').val(dataTasa[1]);
			$('#TextcuantiaMaxima').val(dataTasa[2]);
			$('#textPorcentaje').val(dataTasa[3]);
			$('#textMontoMinimo').val(dataTasa[4]);
			$('#textMontoMaximo').val(dataTasa[5]);
			$('#cbTipoCalculo').val(dataTasa[6]);

			console.log(dataTasa[6]);

		})	

		// abrir modal
		$('#mdlAreaTit').html('<i class="fa fa-edit"></i> Editar Tasa');
		$("#mdlEditarTasa").modal("show");

		$('#mdlEditarTasa').on('shown.bs.modal', function () {
	  		$('#myInput').trigger('focus')
		})
	}
