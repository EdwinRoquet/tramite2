<?php 
/* Componentes HTML */
include_once 'componentes/header-sin-sesion.php';
// include_once 'componentes/navbar-sin-sesion.php';
?>  

<style>

.titulo{
  font-size: 25px!important;
}
</style>
<div class="card m-4 ">
<div class="jumbotron mt-5  d-print-none">
      <h1  class="display-3">Calculadora de Gastos Arbitrales</h1>
      <hr class="my-2">
      <p>Permite calcular los costos arbitrales respecto de las pretensiones determinadas e indeterminadas
que someta a controversia ante un Árbitro Único o Tribunal Arbitral, así como el costo de la
organización y administración del proceso por parte del Centro de Arbitraje Latinoamericano.
        </p> 
    </div>

    <div class="row d-print-block  d-none ">
    <h2 class="text-center">CALCULADORA DE GASTOS ARBITRALES - CEAR LATINOAMERICANO</h2>
    </div>

    <div class="card-body d-print-none">
        <!-- <div  class=""> -->

         <div class=" d-flex  flex-column align-items-center  align-content-center justify-content-center">
                 
                 <table class="border-0  col-md-6">
                
                 <tbody>
                 <tr>
                    <td>
                       <h3 class="titulo"> Pretensiones Determinadas</h3>
                    </td>
                 </tr>
                 <tr>
                    <td><h3>Monto de la cuantía (S/ ):</h3></td>
                    <td>  <input type="text" name="txtMonto" id="txtMonto" class="form-control">
                          <input type="hidden"  id="tipoDeCalculo"  value="determinada">
                    </td>
                 </tr>
                 <tr>
                    <td>
                       <h3 class="titulo"> Pretensiones Indeterminadas</h3>
                    </td>
                 </tr>
                 <tr>
                    <td><h3>Monto del contrato original (S/):</h3></td>
                    <td>  <input type="text"  id="montoContrato"   class="form-control mb-2"></td>
                 </tr>
                 <tr>
                    <td><h3>Número de pretensiones indeterminada: (S/):</h3></td>
                    <td> <input type="number"  id="numPretenciones" class="form-control"></td>
                 </tr>


                 </tbody>
                 </table>

          
                 <br>
            <div class="col-sm-9 d-flex justify-content-around divCajaMonto ml-5  d-print-none" style="display:none!important;" >
               <div class="row d-print-none">
               <div class="col-sm-6">
              <h3 class="mb-4">Monto de la cuantía resultante por pretensiones indeterminadas</h3>
               
                   <h3 class=""> Importante</h3>
                   <p>
                   El cálculo se realizará en base al monto total de la cuantia por pretensiones indeterminadas resultante
                   </p>
                   <p class="mb-2">
                   Monto a utilizar para el cálculo de honorarios de árbitro(s) por pretensión(es) indeterminada(s)
                   </p>
                   <p class="mb-2">
                   Monto a utilizar para el cálculo de gastos administrativos de Secretaría Arbitral por pretensión(es) indeterminada(s)
                   </p>

               </div>
               <div class="col-sm-3 pb-3 d-flex flex-column align-content-center align-items-center justify-content-end ">
              
             
               <div class="mt-5 mb-4 dataMontoUno">	6.20</div>
               <div class=" dataMontoDos">	6.20</div>

               </div>
               </div>
            </div>




        </div>




        <hr>
        <div class="d-flex justify-content-center">
          
            <div class="col-sm-3 d-flex justify-content-center">
              <button class="btn btn-success  " id="btnCalculo"> Realizar Cálculo</button>
            </div>
          
            
            
        </div>

    </div>
    <div id="calculoOptenido">
         <div class=" viewPdf">
         <style>
          @media print {
            .table{
               border: gray 1px solid;
            }
          }
         
         </style>
        <div class="card-body tablauno  ">
            <div class="row">
                <div class="col-sm-6">
                    <h2 style="font-size: 18px;font-weight: 600;">Monto de la Cuantía por Pretensiones Determinadas </h2>
                </div>
                <div class="col-sm-3">
                    Monto Cuantía
                </div>
                <div class="col-sm-3" id="montoCuantia">

                </div>
             </div>
            <hr>
            <h2 style="font-size: 20px;font-weight: 600;">Resultado obtenido </h2>
            <h2 style="font-size: 18px;color: #035fa0;font-weight: 600;">Para Árbitro Único</h2>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table" id="tablaArbitroUnico" width="100%">
                      <thead class="thead-light">
                        <tr>
                          <th class="text-center" scope="col"><strong>CONCEPTO</strong></th>
                          <th class="text-center" scope="col"><strong>CUANTÍA DETERMINADA (S/)</strong>  </th>
                          <th class="text-center" scope="col" style="display: none;"><strong>CUANTÍA DETERMINADA (S/)</strong>  </th>
                          <th class="text-center" scope="col"><strong>CUANTÍA INDETERMINADA (S/)</strong>    </th>
                          <th class="text-center" scope="col"><strong>TOTAL (S/) </strong></th>
                          <th class="text-center" scope="col" style="display: none;"><strong>TOTAL (S/) </strong></th>
                          <th class="text-center" scope="col" style="display: none;"><strong>TOTAL con IGV (S/)</strong> </th>
                          <th class="text-center" scope="col"><strong>TOTAL con IGV (S/)</strong> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td class="text-center">Servicio de Administración de Arbitraje</td>
                            <td class="text-center" id="honorarioSecretariaNuevo"></td>
                            <td class="text-center" id="honorarioSecretaria" style="display: none;"></td>
                            <td class="text-center" id="honorarioSecretariaNuevoInde">0</td>
                            <td class="text-center" id="honorarioSecretaria1Nuevo"></td>
                            <td class="text-center" id="honorarioSecretaria1" style="display: none;"></td>
                            <td class="text-center" id="totalIgv" style="display: none;"></td>
                            <td class="text-center" id="totalIgvNuevo"></td>
                        </tr>

                        <tr>
                            <td class="text-center" >Honorarios Arbitro Único (*)</td>
                            <td class="text-center"  id="honorarioArbitroUnicoNuevo"></td>
                            <td class="text-center"  id="honorarioArbitroUnico" style="display: none;"></td>
                            <td class="text-center"  id="honorarioArbitroUnicoNuevoInde">0</td>
                            <td class="text-center"  id="honorarioArbitroUnico1Nuevo"></td>
                            <td class="text-center"  id="honorarioArbitroUnico1" style="display: none;"></td>
                            <td class="text-center"  style="display: none;"></td>
                            <td class="text-center" ></td>
                        </tr>
                     
                        <tr>
                            <td class="text-center" >Total</td>
                            <td class="text-center" ></td>
                            <td class="text-center" ></td>
                            <td class="text-center"  id="totalSuma"></td>
                            <td class="text-center"  id="TotalArbritroUnicoSecretario" style="display: none;"></td>
                            <td class="text-center"  ></td>
                            
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-body">
            <h2 style="font-size: 18px;color: #035fa0;font-weight: 600;">Para Tribunal Arbitral (3 Árbitros)</h2>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table" id="tablaTribunalArbitral" width="100%">
                      <thead class="thead-light">
                        <tr>
                          <th class="text-center" scope="col"><strong>CONCEPTO</strong></th>
                          <th class="text-center" scope="col"><strong>CUANTÍA DETERMINADA (S/)</strong>  </th>
                          <th class="text-center" scope="col"><strong>CUANTÍA INDETERMINADA (S/)</strong>    </th>
                          <th class="text-center" scope="col" style="display: none;"><strong>TOTAL (S/) </strong></th>
                          <th class="text-center" scope="col"><strong>TOTAL (S/) </strong></th>
                          <th class="text-center" scope="col"><strong>TOTAL con IGV (S/)</strong> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td class="text-center">Servicio de Administración de Arbitraje</td>
                            <td class="text-center" id="honorarioSecretaria3Arbitros"></td>
                            <td class="text-center" id="honorarioSecretaria3ArbitrosInde">0</td>
                            <td class="text-center" id="honorarioSecretaria3Arbitros1" style="display: none;"></td>
                            <td class="text-center" id="total"></td>
                            <td class="text-center" id="totalIgv2"></td>
                
                        </tr>
                        <tr>
                            <td class="text-center">Honorario de Tribunal Arbitral (*)</td>
                            <td class="text-center" id="honorarioTribunalUnico"></td>
                            <td class="text-center" id="honorarioTribunalUnicoInde">0</td>
                            <td class="text-center" id="honorarioTribunalUnico1" style="display: none;"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                   
                        </tr>
                   
                        <tr>
                            <td class="text-center">  Total  </td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center" id="totalCuentaDeterminada"></td>
                            <td class="text-center"></td>
                        </tr>
                      </tbody>
                    </table>
                </div>


                <div class="col-sm-12">
                    <table class="table" width="100%">
                      <thead class="thead-light">
                        <tr>
                          <th class="text-center" scope="col"><strong>CONCEPTO</strong></th>
                          <th class="text-center" scope="col"><strong>CUANTÍA DETERMINADA (S/)</strong>  </th>
                          <th class="text-center" scope="col"><strong>CUANTÍA INDETERMINADA (S/)</strong>    </th>
                          <th class="text-center" scope="col" style="display: none;"><strong>TOTAL (S/) </strong></th>
                          <th class="text-center" scope="col"><strong>TOTAL (S/) </strong></th>
                          <th class="text-center" scope="col"><strong>TOTAL CON RENTA (8%)</strong> </th>
                        </tr>
                      </thead>
                      <tbody>
                      
                        <tr>
                            <td class="text-center">  Honorarios Árbitro 1  </td>
                            <td></td>
                            <td></td>
                            <td class="text-center" id="honorarioArbitro1_1" style="display: none;"></td>
                            <td class="text-center" id="arbitro1"></td>
                            <td class="text-center" id="arbitro1Renta"></td>
                        </tr>
                        <tr>
                            <td class="text-center">  Honorarios Árbitro 2  </td>
                            <td></td>
                            <td></td>
                            <td class="text-center" id="honorarioArbitro1_2" style="display: none;"></td>
                            <td class="text-center" id="arbitro2"></td>
                            <td class="text-center" id="arbitro2Renta"></td>
                        </tr>
                        <tr>
                            <td class="text-center">  Honorarios Árbitro 3  </td>
                            <td></td>
                            <td></td>
                            <td class="text-center" id="honorarioArbitro1_3" style="display: none;"></td>
                            <td class="text-center" id="arbitro3"></td>
                            <td class="text-center"  id="arbitro3Renta"></td>
                        </tr>
                      
                      </tbody>
                    </table>
                </div>


            </div>
            (*) Monto Neto
         
        </div>
    </div>

    <div class=" d-flex justify-content-center mb-3 mb-3 d-print-none">
       
        <div class="col-sm-4 d-flex justify-content-center ">
            <input type="submit"  value="Descargar Archivo PDF" class="btn btnDescargarPDF btn-success">   
        </div>
        <div class="col-sm-4 d-flex justify-content-center ">
            <input type="submit"  value="Realizar Otro Cálculo" class="btn btnNuevo btn-success">   
        </div>
    </div>

    

    </div>
      
    
</div>


<!-- ============================================ -->
 <?php 
	include_once 'componentes/footer.php';
    
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="js/calculadoraTasa.js" ></script>