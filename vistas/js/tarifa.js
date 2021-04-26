
$(document).ready(function(){

	   var tipo_calculo = 'Arbitro unico';
	   BuscarTasaTipoCambio(tipo_calculo);
	   
	   $("#menuArbitroUnico" ).click(function() {
		   var tipo_calculo = 'Arbitro unico';
		   BuscarTasaTipoCambio(tipo_calculo);
		});
	/*  =======================================
		BUSCAR TASA POR TIPO DE CALCULO
   		=======================================*/
		$("#menuTribunalArbitral" ).click(function() {
			var tipo_calculo = 'Tribunal arbitral';
		  	BuscarTasaTipoCambio(tipo_calculo);
		});
		
		$("#menuSecretarioArbitral" ).click(function() {
			var tipo_calculo = 'Secretaria arbitral';
		  	BuscarTasaTipoCambio(tipo_calculo);
		});
		

		

	
})


	/*=================================================
  	BUSCAR TASA
  	=================================================*/
	function BuscarTasaTipoCambio(tipo_calculo,contenido)
	{

		
		console.log(tipo_calculo);
		 $.ajax({
            url: 'ajax/ajax-tasa-consulta-opcion.php',
            type: 'POST',
            dataType: 'html',
            dataType: "json",
            data: { 
                    tipo_calculo: tipo_calculo
                   },
        })
        .done(function(response) {
            
              if(tipo_calculo=='Arbitro unico')
              {
              	listarTarifaArbitroUnico(response);
              }
             if(tipo_calculo=='Tribunal arbitral')
              {
              	listarTribunalArbitral(response);
              }
              if(tipo_calculo=='Secretaria arbitral')
              {
              	listarSecretarioArbitral(response);
              }

        })    
   } 	
/********************************************************************************/
	/*=================================================
   	 	Llmar metodo para listar tabla
 =================================================*/	
	
function listarTarifaArbitroUnico(response)
{   
	$('#contenidoArbitroUnico').empty();
    $.each(response.data, function(idx, item) 
       {
       	 
       	  temCuantiaMinima=item.cuantia_minimo.replace('1.00','0.00');
          $('#contenidoArbitroUnico').append('<tr><td><span style="font-weight: bold;">'+(parseInt(idx)+1)+'</span>. De S/. ' + item.cuantia_minimo + ' a S/. '+ item.cuantia_maximo+'</td><td> ' + item.porcentaje + ' % </td><td>S/. ' + item.monto_minimo +' +'+item.porcentaje+ ' % Sombre la cantidad que exceda de S/ '+temCuantiaMinima+' </td><td>'+item.monto_maximo+ '</td><tr>');

	 });
}

function listarTribunalArbitral(response)
{   
	$('#contenidoTribulaArbitral').empty();

    $.each(response.data, function(idx, item) 
       {

       	  temCuantiaMinima=item.cuantia_minimo.replace('1.00','0.00');
          $('#contenidoTribulaArbitral').append('<tr><td> <span style="font-weight: bold;">'+(parseInt(idx)+1)+'</span>. De S/. ' + item.cuantia_minimo + ' a S/. '+ item.cuantia_maximo+'</td><td> ' + item.porcentaje + ' % </td><td>S/. ' + item.monto_minimo +' +'+item.porcentaje+ ' % Sombre la cantidad que exceda de S/ '+temCuantiaMinima+' </td><td>'+item.monto_maximo+ '</td><tr>');

	});
}

function listarSecretarioArbitral(response)
{   
	$('#contenidoSecretarioArbitral').empty();

    $.each(response.data, function(idx, item) 
       {

       	  temCuantiaMinima=item.cuantia_minimo.replace('1.00','0.00');
          $('#contenidoSecretarioArbitral').append('<tr><td> <span style="font-weight: bold;">'+(parseInt(idx)+1)+'</span>. De S/. ' + item.cuantia_minimo + ' a S/. '+ item.cuantia_maximo+'</td><td> ' + item.porcentaje + ' % </td><td>S/. ' + item.monto_minimo +' +'+item.porcentaje+ ' % Sombre la cantidad que exceda de S/ '+temCuantiaMinima+' </td><td>'+item.monto_maximo+ '</td><tr>');

	});
}


