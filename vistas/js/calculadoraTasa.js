

/*=================================================
Boton de recarga
=================================================*/

document.querySelector('.btnNuevo').addEventListener('click', function(e) {
   window.location.reload();
})

/*=================================================
Boton de descarga
=================================================*/

document.querySelector('.btnDescargarPDF').addEventListener('click', function(e) {
  descargarPdf();
})


function  descargarPdf() {
  window.print();   
}

/*=================================================
Pretensiones Indeterminadas
=================================================*/

if(document.querySelector('.divCajaMonto')){
  //Creación del evento en el input
  document.querySelector('#numPretenciones').addEventListener('blur',function (e) {
    //llamado a la funcion
   calcularMontos();
  
  });
  //Creación del evento en el input
  document.querySelector('#montoContrato').addEventListener('blur',function (e) {
    //llamado a la funcion
   calcularMontos();
  
  });



/*=================================================
 Funcion que realiza el calculo
=================================================*/
 function calcularMontos() {
  let montoContrato = document.querySelector('#montoContrato');
  let numPretenciones = document.querySelector('#numPretenciones');

   if (!numPretenciones.value == '' && !montoContrato.value == '') {
     let calculoPretension =   montoContrato.value * ( 0.031 * numPretenciones.value );
     let calculoGastoAdministrativo =  montoContrato.value * ( 0.031 * numPretenciones.value );
     document.querySelector('.divCajaMonto').style.display="block";
     document.querySelector('.dataMontoUno').textContent = calculoPretension.toFixed(2);
     document.querySelector('.dataMontoDos').textContent = calculoGastoAdministrativo.toFixed(2);
     
     document.querySelector('#txtMonto').value = calculoGastoAdministrativo.toFixed(2);
     document.querySelector('#tipoDeCalculo').value = 'indeterminada';
     // console.log(' hay datos')
   }else{
        // alert('los dos campos son obligatorios');
   }
 }

}










$(document).ready(function(){

    $('#calculoOptenido').hide();
    $("#btnCalculo" ).click(function() {
   

     var montoCuantiaDiv=parseFloat($('#txtMonto').val(), 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero
     $("#montoCuantia").html('S/. '+montoCuantiaDiv);
           
       var tipo_calculo = 'Arbitro unico';
       BuscarTasaTipoCambio(tipo_calculo);

     var tipo_calculo = 'Secretaria arbitral';
     BuscarTasaTipoCambio(tipo_calculo);

     var tipo_calculo = 'Tribunal arbitral';
     BuscarTasaTipoCambio(tipo_calculo);

     $('#calculoOptenido').show();


  });


})


/*=================================================
BUSCAR TASA PARA REALIZAR EL CALCULO Gastos Arbitrales del OSCE
=================================================*/
function BuscarTasaTipoCambio(tipo_calculo,contenido)
{


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
        
        //Envio de los tres tipos de cambio para realizar el calculo
        if(tipo_calculo=='Arbitro unico')
        {
            listarTarifaArbitroUnico(response);

        }

        if(tipo_calculo=='Secretaria arbitral')
        {
          listarTarifaSecretarioArbitral(response);
        }

        if(tipo_calculo=='Tribunal arbitral')
        {
          listarTarifaTribunalArbitral(response);
        }



  });

   

} 	
/********************************************************************************/
/*=================================================
      Llmar metodo para listar tabla
=================================================*/
//Metodo para el calculo de Honorarios Arbitro Único (*)    	
let montosTempTasa=[];
// Variable para poder sumar los totales de Secretaría SNA-OSCE y  Honorarios Arbitro Único (*)
let totalArbitroUnico;
let totalSecretariaOsce;
//Total para Tribunal Arbitral (3 Árbitros)(TOTAL con IGV (S/))+ Honorarios Árbitro 1
let totalIgvTemp;
//Almacenando totales de Secretaría SNA-OSCE y Honorarios Arbitro Único (*)
let SecretariaTotal;
let HonArbitroUnico;
function listarTarifaArbitroUnico(response)
{   
var txtMonto=$('#txtMonto').val();
if(parseFloat(txtMonto)>36001)
{
  $.each(response.data, function(idx, item) 
     {
          
          
            nuCuantia_minimo=item.cuantia_minimo.replace('.00','')
            nuCuantia_minimoD=nuCuantia_minimo.replace(/[, ]+/g,'').trim();

            nuCuantia_maximo=item.cuantia_maximo.replace('.00','')
            nuCuantia_maximoD=nuCuantia_maximo.replace(/[, ]+/g,'').trim();

            nuMonto_minimo=item.monto_minimo.replace('.00','')
            nuMonto_minimoD=nuMonto_minimo.replace(/[, ]+/g,'').trim();

            nuMonto_maximo=item.monto_maximo.replace('.00','')
            nuMonto_maximoD=nuMonto_maximo.replace(/[, ]+/g,'').trim();  

            
            //PARA MONTOS DE QUE SE ENCUENTRA EN EL INTERVALO
            if(parseFloat(txtMonto)>=nuCuantia_minimoD && parseFloat(txtMonto)<=nuCuantia_maximoD)
            {
              
                // montosTempTasa[0] Cuantia minima
                // montosTempTasa[1] Cuantia maxima
                // montosTempTasa[2] monto minimo
                // montosTempTasa[3] monto maximo
                console.log( nuCuantia_minimoD+' > '+parseFloat(txtMonto) +' < '+nuCuantia_maximoD);
                // console.log(montosTempTasa[1]+' '+montosTempTasa[2]);
                var restoExedente=(parseFloat(txtMonto)-(montosTempTasa[1]))*(item.porcentaje)/100;
               
                var honorarioCuantia=parseFloat(montosTempTasa[3])+parseFloat(restoExedente);
                //Para el calcular el total de arbitro
                totalArbitroUnico=parseFloat(honorarioCuantia);
                    
                 restoExedente=parseFloat(restoExedente, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero
                 honorarioCuantia=parseFloat(honorarioCuantia, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero

                $("#honorarioArbitroUnico").html(honorarioCuantia);
                $("#honorarioArbitroUnico1").html(honorarioCuantia);


            }else
            {
              //PARA MONTOS  QUE SUPERAN EL RANGO, ES DECIR MONTOS GRANDES 
               if(parseFloat(txtMonto)>=nuCuantia_minimoD && nuCuantia_maximoD =='+')
                {
                  
                    // montosTempTasa[0] Cuantia minima
                    // montosTempTasa[1] Cuantia maxima
                    // montosTempTasa[2] monto minimo
                    // montosTempTasa[3] monto maximo
                    console.log( nuCuantia_minimoD+' > '+parseFloat(txtMonto) +' < '+nuCuantia_maximoD);
                    // console.log(montosTempTasa[1]+' '+montosTempTasa[2]);
                    var restoExedente=(parseFloat(txtMonto)-(montosTempTasa[1]))*(item.porcentaje)/100;
                    

                    var honorarioCuantia=parseFloat(montosTempTasa[3])+parseFloat(restoExedente);
                     //Para el calcular el total de arbitro
                     totalArbitroUnico=parseFloat(honorarioCuantia);

                     restoExedente=parseFloat(restoExedente, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero
                     honorarioCuantia=parseFloat(honorarioCuantia, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero

                     
                    $("#honorarioArbitroUnico").html(honorarioCuantia);
                    $("#honorarioArbitroUnico1").html(honorarioCuantia);
                }

                montosTempTasa[0]=nuCuantia_minimoD;
                montosTempTasa[1]=nuCuantia_maximoD;
                montosTempTasa[2]=nuMonto_minimoD;
                montosTempTasa[3]=nuMonto_maximoD;

            }
                                

       
   });
}else
{

   totalArbitroUnico=3819;

  //PARA MONTOS  PEQUEÑOS MENORES DE CUANTIA A 3,819.00
   $("#honorarioArbitroUnico").html('3,819.00');
   $("#honorarioArbitroUnico1").html('3,819.00');

}


}
//Metodo para el calculo de  Secretaría SNA-OSCE    

let montosTempTasa1=[];
function listarTarifaSecretarioArbitral(response)
{
var txtMonto=$('#txtMonto').val();
 if(parseFloat(txtMonto)>36001)
{   
  $.each(response.data, function(idx, item) 
     {
       
        nuCuantia_minimo=item.cuantia_minimo.replace('.00','')
        nuCuantia_minimoD=nuCuantia_minimo.replace(/[, ]+/g,'').trim();

        nuCuantia_maximo=item.cuantia_maximo.replace('.00','')
        nuCuantia_maximoD=nuCuantia_maximo.replace(/[, ]+/g,'').trim();

        nuMonto_minimo=item.monto_minimo.replace('.00','')
        nuMonto_minimoD=nuMonto_minimo.replace(/[, ]+/g,'').trim();

        nuMonto_maximo=item.monto_maximo.replace('.00','')
        nuMonto_maximoD=nuMonto_maximo.replace(/[, ]+/g,'').trim();  

        //PARA MONTOS DE QUE SE ENCUENTRA EN EL INTERVALO
        if(parseFloat(txtMonto)>=nuCuantia_minimoD && parseFloat(txtMonto)<=nuCuantia_maximoD)
        {
          
            // montosTempTasa1[0] Cuantia minima
            // montosTempTasa1[1] Cuantia maxima
            // montosTempTasa1[2] monto minimo
            // montosTempTasa1[3] monto maximo
            var restoExedente=(parseFloat(txtMonto)-montosTempTasa1[1])*item.porcentaje/100;
            var honorarioCuantia=parseFloat(montosTempTasa1[3])+parseFloat(restoExedente);
            var honorarioCuantiaTem=honorarioCuantia;
          
             totalSecretariaOsce=parseFloat(honorarioCuantia);
             //Variable para almacenar el total Secretaría SNA-OSCE y poder utilizar de manera global
             SecretariaTotal=honorarioCuantia;
            
             restoExedente=parseFloat(restoExedente, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero
             honorarioCuantia=parseFloat(honorarioCuantia, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero

            $("#honorarioSecretaria").html(honorarioCuantia);
            $("#honorarioSecretaria1").html(honorarioCuantia);


           //TOTAL con IGV (S/)  Secretaría SNA-OSCE
            var totalIgv=parseFloat(honorarioCuantiaTem)*1.18;
            //Para guardar temporalmente el valor y sumar Honorarios Árbitro 1
            totalIgvTemp=totalIgv;
            totalIgv=parseFloat(totalIgv, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero
            $("#totalIgv").html(totalIgv);
            $("#totalIgv1").html(totalIgv);
            

             //Para tabla de Tribunal Arbitral (3 Árbitros)

            // $("#honorarioSecretaria3Arbitros").html(honorarioCuantia);
            $("#honorarioSecretaria3Arbitros1").html(honorarioCuantia);

            recalculandoTribunalArbitral();

          

        }else
        {
            //PARA MONTOS  QUE SUPERAN EL RANGO, ES DECIR MONTOS GRANDES 
            if(parseFloat(txtMonto)>=nuCuantia_minimoD && nuCuantia_maximoD =='+')
                {
                    var restoExedente=(parseFloat(txtMonto)-montosTempTasa1[1])*item.porcentaje/100;
                    var honorarioCuantia=parseFloat(montosTempTasa1[3])+parseFloat(restoExedente);
                    var honorarioCuantiaTem=honorarioCuantia;
                    totalSecretariaOsce=parseFloat(honorarioCuantia);

                    //Variable para almacenar el total Secretaría SNA-OSCE y poder utilizar de manera global
                    SecretariaTotal=honorarioCuantia;
                  
                     restoExedente=parseFloat(restoExedente, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero
                     honorarioCuantia=parseFloat(honorarioCuantia, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero

                    $("#honorarioSecretaria").html(honorarioCuantia);
                    $("#honorarioSecretaria1").html(honorarioCuantia);


                   //TOTAL con IGV (S/)  Secretaría SNA-OSCE
                    var totalIgv=parseFloat(honorarioCuantiaTem)*1.18;
                   //Para guardar temporalmente el valor y sumar Honorarios Árbitro 1
                    totalIgvTemp=totalIgv;

                    totalIgv=parseFloat(totalIgv, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero
                    $("#totalIgv").html(totalIgv);
                    $("#totalIgv1").html(totalIgv);
                    

                     //Para tabla de Tribunal Arbitral (3 Árbitros)

                    $("#honorarioSecretaria3Arbitros").html(honorarioCuantia);
                    $("#honorarioSecretaria3Arbitros1").html(honorarioCuantia);
                    recalculandoTribunalArbitral();
            }

            montosTempTasa1[0]=nuCuantia_minimoD;
            montosTempTasa1[1]=nuCuantia_maximoD;
            montosTempTasa1[2]=nuMonto_minimoD;
            montosTempTasa1[3]=nuMonto_maximoD;
            console.log('=>'+nuCuantia_maximoD);
        }

       
   });
}else
{
  //Para guardar temporalmente el valor y sumar Honorarios Árbitro 1
  totalIgvTemp=2115.74;

  totalSecretariaOsce=1793;
   //PARA MONTOS  PEQUEÑOS MENORES DE CUANTIA A 3,819.00

  //Variable para almacenar el total Secretaría SNA-OSCE y poder utilizar de manera global
  SecretariaTotal=1793;

  $("#honorarioSecretaria").html('1,793.00');
  $("#honorarioSecretaria1").html('1,793.00');

  $("#totalIgv").html('2,115.74');
  $("#totalIgv1").html('2,115.74');
  $("#honorarioSecretaria3Arbitros").html('1,793.00');
  $("#honorarioSecretaria3Arbitros1").html('1,793.00');

  recalculandoTribunalArbitral();
}

// Sumando los totales de Secretaría SNA-OSCE y  Honorarios Arbitro Único (*)
var totalesSecHorArbUni=parseFloat(totalArbitroUnico)+parseFloat(totalSecretariaOsce);
$("#TotalArbritroUnicoSecretario").html(parseFloat(totalesSecHorArbUni,20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());


}

//Metodo para el calculo de  Honorarios Arbitro Único (*)
let montosTempTasa2=[];
function listarTarifaTribunalArbitral(response)
{
var txtMonto=$('#txtMonto').val();
if(parseFloat(txtMonto)>36001)
{
  $.each(response.data, function(idx, item) 
     {
       
        nuCuantia_minimo=item.cuantia_minimo.replace('.00','')
        nuCuantia_minimoD=nuCuantia_minimo.replace(/[, ]+/g,'').trim();

        nuCuantia_maximo=item.cuantia_maximo.replace('.00','')
        nuCuantia_maximoD=nuCuantia_maximo.replace(/[, ]+/g,'').trim();

        nuMonto_minimo=item.monto_minimo.replace('.00','')
        nuMonto_minimoD=nuMonto_minimo.replace(/[, ]+/g,'').trim();

        nuMonto_maximo=item.monto_maximo.replace('.00','')
        nuMonto_maximoD=nuMonto_maximo.replace(/[, ]+/g,'').trim();         

          //PARA MONTOS DE QUE SE ENCUENTRA EN EL INTERVALO
        if(parseFloat(txtMonto)>=nuCuantia_minimoD && parseFloat(txtMonto)<=nuCuantia_maximoD)
        {
          
            // montosTempTasa2[0] Cuantia minima
            // montosTempTasa2[1] Cuantia maxima
            // montosTempTasa2[2] monto minimo
            // montosTempTasa2[3] monto maximo
            var restoExedente=(parseFloat(txtMonto)-montosTempTasa2[1])*item.porcentaje/100;
            var honorarioCuantia=parseFloat(montosTempTasa2[3])+parseFloat(restoExedente);
            var honorarioCuantiaTem=honorarioCuantia;

            //Variable para almacenar el total de Tribunal Arbitral
            HonArbitroUnico=honorarioCuantia;
            recalculandoTribunalArbitral();
          
             restoExedente=parseFloat(restoExedente, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero
             honorarioCuantia=parseFloat(honorarioCuantia, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero

            // $("#honorarioTribunalUnico").html(honorarioCuantia);
            $("#honorarioTribunalUnico1").html(honorarioCuantia);

            
            var honorarioArbitro1=parseFloat(honorarioCuantiaTem)/3;
            $("#honorarioArbitro1_1").html(honorarioArbitro1.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#honorarioArbitro1_2").html(honorarioArbitro1.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#honorarioArbitro1_3").html(honorarioArbitro1.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

            //Para sumar Honorarios Árbitro 1 + TOTAL con IGV (S/)
            totalIgvTempHonoraioUninco=parseFloat(totalIgvTemp)+parseFloat(honorarioArbitro1);
            $("#totalIgvTempHonorario1").html(totalIgvTempHonoraioUninco.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

            setTimeout(function()
              {
                   recalculandoTablaArbitroUnico();
              },1000); 
          

        }else
        {    //PARA MONTOS  QUE SUPERAN EL RANGO, ES DECIR MONTOS GRANDES 
           if(parseFloat(txtMonto)>=nuCuantia_minimoD && nuCuantia_maximoD =='+')
              {
                var restoExedente=(parseFloat(txtMonto)-montosTempTasa2[1])*item.porcentaje/100;
                var honorarioCuantia=parseFloat(montosTempTasa2[3])+parseFloat(restoExedente);
                var honorarioCuantiaTem=honorarioCuantia;
              
                 //Variable para almacenar el total de Tribunal Arbitral
                 HonArbitroUnico=honorarioCuantia;
                 recalculandoTribunalArbitral();

                 restoExedente=parseFloat(restoExedente, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero
                 honorarioCuantia=parseFloat(honorarioCuantia, 20).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();//formateo del numero

                $("#honorarioTribunalUnico").html(honorarioCuantia);
                $("#honorarioTribunalUnico1").html(honorarioCuantia);

                
                var honorarioArbitro1=parseFloat(honorarioCuantiaTem)/3;
                $("#honorarioArbitro1_1").html(honorarioArbitro1.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
                $("#honorarioArbitro1_2").html(honorarioArbitro1.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
                $("#honorarioArbitro1_3").html(honorarioArbitro1.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

                //Para sumar Honorarios Árbitro 1 + TOTAL con IGV (S/)
                totalIgvTempHonoraioUninco=parseFloat(totalIgvTemp)+parseFloat(honorarioArbitro1);
                $("#totalIgvTempHonorario1").html(totalIgvTempHonoraioUninco.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

                setTimeout(function()
                  {
                      recalculandoTablaArbitroUnico();
                    
                  },1000); 

            }
            montosTempTasa2[0]=nuCuantia_minimoD;
            montosTempTasa2[1]=nuCuantia_maximoD;
            montosTempTasa2[2]=nuMonto_minimoD;
            montosTempTasa2[3]=nuMonto_maximoD;

        }

       
   });
}else
{
  //Variable para almacenar el total de Tribunal Arbitral
   HonArbitroUnico=6219.00;

   // console.log("hola3 "+HonArbitroUnico);
   recalculandoTribunalArbitral();
  //Para sumar Honorarios Árbitro 1 + TOTAL con IGV (S/)
   totalIgvTempHonoraioUninco=parseFloat(totalIgvTemp)+2073;
   $("#totalIgvTempHonorario1").html(totalIgvTempHonoraioUninco.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());


  //PARA MONTOS  PEQUEÑOS MENORES DE CUANTIA A 3,819.00
   $("#honorarioTribunalUnico").html('6,219.00');
   $("#honorarioTribunalUnico1").html('6,219.00');

  $("#honorarioArbitro1_1").html('2,073.00');
  $("#honorarioArbitro1_2").html('2,073.00');
  $("#honorarioArbitro1_3").html('2,073.00');
  setTimeout(function()
  {
       recalculandoTablaArbitroUnico();
  },1000); 
  
}
}


function recalculandoTablaArbitroUnico()
{

let totArbritroUnicoSecretario;
$('#tablaArbitroUnico tbody tr').each(function() {
           
  totArbritroUnicoSecretario = $(this).find("#TotalArbritroUnicoSecretario").html();  
}); 

var honorarioSecretariaNuevo=parseFloat(totArbritroUnicoSecretario.replace(/[, ]+/g,'').trim())/2;

if (document.querySelector('#tipoDeCalculo').value === 'indeterminada') {
  // CUANTÍA INDETERMINADA (S/) Para la tabla Árbitro Único
$("#honorarioSecretariaNuevoInde").html(honorarioSecretariaNuevo.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString())
$("#honorarioArbitroUnicoNuevoInde").html(honorarioSecretariaNuevo.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString())
$("#honorarioSecretariaNuevo").html(0);
$("#honorarioArbitroUnicoNuevo").html(0);

} if (document.querySelector('#tipoDeCalculo').value === 'determinada') {
  // CUANTÍA DETERMINADA (S/) Para la tabla Árbitro Único
$("#honorarioSecretariaNuevo").html(honorarioSecretariaNuevo.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString())
$("#honorarioArbitroUnicoNuevo").html(honorarioSecretariaNuevo.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString())
$("#honorarioSecretariaNuevoInde").html(0);
$("#honorarioArbitroUnicoNuevoInde").html(0);
}

// TOTAL (S/) Para la tabla Árbitro Único
$("#honorarioSecretaria1Nuevo").html(honorarioSecretariaNuevo.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString())
$("#honorarioArbitroUnico1Nuevo").html(honorarioSecretariaNuevo.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString())
$("#totalSuma").html((honorarioSecretariaNuevo*2).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString())

var totalIgvNuevo=parseFloat(honorarioSecretariaNuevo)*1.18;
$("#totalIgvNuevo").html(totalIgvNuevo.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString())


}

function recalculandoTribunalArbitral()
{

var total=parseFloat(SecretariaTotal)+parseFloat(HonArbitroUnico);
var cuanSecretaríaSnaOsce=total*0.35;
var cuanHonorariosArbitroUnico=total*0.65;

var totalIgv = cuanSecretaríaSnaOsce*1.18;

if (document.querySelector('#tipoDeCalculo').value === 'determinada') {
  // CUANTÍA DETERMINADA (S/) 
$("#honorarioSecretaria3Arbitros").html(cuanSecretaríaSnaOsce.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
$("#honorarioTribunalUnico").html(cuanHonorariosArbitroUnico.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

}

if (document.querySelector('#tipoDeCalculo').value === 'indeterminada') {
  // CUANTÍA INDETERMINADA (S/) Para la tabla Árbitro Único
  $("#honorarioSecretaria3ArbitrosInde").html(cuanSecretaríaSnaOsce.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
  $("#honorarioTribunalUnicoInde").html(cuanHonorariosArbitroUnico.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
  $("#honorarioTribunalUnico").html(0);
  $("#honorarioSecretaria3Arbitros").html(0);
}



$("#totalCuentaDeterminada").html((cuanHonorariosArbitroUnico + cuanSecretaríaSnaOsce ).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

var arbitro=(cuanHonorariosArbitroUnico)/3;
$("#arbitro1").html(arbitro.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
$("#arbitro2").html(arbitro.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
$("#arbitro3").html(arbitro.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

$("#total").html(cuanSecretaríaSnaOsce.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
$("#totalIgv2").html(totalIgv.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

//Total con renta (%8)
let totalRenta = arbitro * 1.08;
$("#arbitro1Renta").html(totalRenta.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
$("#arbitro2Renta").html(totalRenta.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
$("#arbitro3Renta").html(totalRenta.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

}

