<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<style>
th {
    display: table-cell;
    vertical-align: inherit;
    font-weight: normal!important;
}
</style>
<?php
  include_once 'includes/Tasa.php';
  $Tasa = new Tasa();

?>
   <div class="container">

 


    <div class="jumbotron mt-5">
      <h1  class="display-3">Calculadora de Gastos Arbitrales</h1>
      
      <hr class="my-2">
      <p>Permite calcular los costos arbitrales respecto de las pretensiones determinadas e indeterminadas
que someta a controversia ante un Árbitro Único o Tribunal Arbitral, así como el costo de la
organización y administración del proceso por parte del Centro de Arbitraje Latinoamericano.
        </p> 
    </div>
    
     <p class="block-help">HAGA CLICK AQUI PARA CALCULAR LOS GASTOS ARBITRALES</p>
   <a href="../calculadoraTasa-user.php" class="btn btn-danger mt-1">CALCULADORA DE GASTOS ARBITRALES</a>
   </div>
  <div class="container d-flex flex-column justify-content-center mb-1">

  <button class="accordion mt-5">TASAS ADMINISTRATIVAS</button>
    <div class="accordion-content">
         
    <div class="col-md-12 mb-3 mt-3">
  <div class="card ">
  <P class="card-header text-center">TASAS ADMINISTRATIVAS</P>
    <div class="card-body">     
    <table class="table table-responsive table-bordered ">
       <thead class="" style="background-color: rgba(0,0,0,.03);">
         <tr>
           <th>ÍTEM</th>
           <th>CEAR LATINOAMERICANO</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td>SOLICITUD ARBITRAJE</td>
           <td>SOLICITUD   S/ 300.00 (Incluye I.G.V)</td>
         </tr>
         <tr>
           <td>SOLICITUD ARBITRAJE MENOR CUANTÍA</td>
           <td>SOLICITUD   S/ 250.00 (Incluye I.G.V)</td>
         </tr>
         <tr>
           <td>DESIGNACIÓN DE ÁRBITROS</td>
           <td>S/ 590.00 (Incluye I.G.V)</td>
         </tr>
         <tr>
           <td>RECUSACIÓN DE ÁRBITROS</td>
           <td>S/ 3000.00  (Incluye I.G.V)  </td>
         </tr>
         <tr>
           <td>COPIA CERTIFICADA</td>
           <td>S/ 1.00 (Por Hoja) (Incluye I.G.V)</td>
         </tr>
         <tr>
           <td>COPIA DE VIDEO</td>
           <td>S/ 100.00 (Incluye I.G.V)</td>
         </tr>
         <tr>
           <td>COPIA DE AUDIO</td>
           <td>S/ 50.00 (Incluye I.G.V)</td>
         </tr>



       </tbody>
     </table>
   
    </div>
  </div>
  </div>

    </div>


    <button class="accordion">TARIFAS</button>
    <div class="accordion-content">

    <div class="card mt-3 mb-3">
           
           <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionTarifa">
               <div class="card-body">
                   <ul class="nav nav-tabs" role="tablist">
                       <li class="nav-item">
                           <a class="nav-link active" data-toggle="tab" id='menuArbitroUnico' href="#tabmenuArbitroUnico" style="font-weight: 700;">Honorarios de Árbitro Único</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" id="menuTribunalArbitral" href="#tabmenuTribunalArbitral" style="font-weight: 700;">Honorarios de Tribunal Arbitral</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" id="menuSecretarioArbitral" href="#tbmenuSecretarioArbitral" style="font-weight: 700;">Honorarios de Secretaria Arbitral</a>
                       </li>
                       <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu3" style="font-weight: 700;">Honorarios de Árbitro de Emergencia</a>
                        </li>
                   </ul>

                   <!-- Tab panes -->
                   <div class="tab-content">
                       <div id="tabmenuArbitroUnico" class="container tab-pane active"><br>
                           <table class="table  table-bordered" id="tbHArbitroUnico">
                               <thead class="" style="background-color: rgba(0,0,0,.03);">
                                   <tr>
                                       <th>Monto de cuantia</th>
                                       <th>%</th>
                                       <th>Formula</th>
                                       <th>Monto Max. Sin IGB </th>
                                   </tr>
                               </thead>
                               <tbody id="contenidoArbitroUnico">
                                   
                               </tbody>
                           </table>
                       </div>
                       <div id="tabmenuTribunalArbitral" class="container tab-pane fade"><br>
                           <table class="table table-bordered " id="tbHTribulaArbitral">
                           <thead class=""style="background-color: rgba(0,0,0,.03);" >
                                   <tr>
                                       <th>Monto de cuantia</th>
                                       <th>%</th>
                                       <th>Formula</th>
                                       <th>Monto Max. Sin IGB </th>
                                   </tr>
                               </thead>
                                   <tbody id="contenidoTribulaArbitral">
                                   
                                   </tbody>
                           </table>
                       </div>
                       <div id="tbmenuSecretarioArbitral" class="container tab-pane fade"><br>
                           <table class="table table-bordered" id="tbHSecretariaArbitral">
                           <thead class="" style="background-color: rgba(0,0,0,.03);" >
                                   <tr>
                                       <th>Monto de cuantia</th>
                                       <th>%</th>
                                       <th>Formula</th>
                                       <th>Monto Max. Sin IGB </th>
                                   </tr>
                               </thead>
                                        <tbody id="contenidoSecretarioArbitral">
                                   
                                       </tbody>
                               </table>
                       </div>

                       <div id="menu3" class="container tab-pane fade"><br>
                                    <table class="table table-bordered" id="tbHArbitroEmergencia">
                                            <thead  style="background-color: rgba(0,0,0,.03);" >
                                                <tr>
                                                    <th >Monto de cuantia</th>
                                                    <th >Formula</th>
                                                    <th >%</th>
                                                    <th >Monto Max. Sin IGB </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                </tr>
                                                
                                            </tbody>
                                    </table>
                            </div>
                    
                   </div>
                     
               </div>
           </div>
       </div>

    
    </div>


    <button class="accordion">ARBITRAJE MENOR CUANTÍA</button>
    <div class="accordion-content">
        
    <div class="col-md-12">
  <div class="card mt-5">
  <!-- <h3 class="card-header text-center"> ARANCELES</h3> -->
  <p class="card-header text-center">ARANCELES</p>
    <div class="card-body">     
    <table class="table table-responsive table-bordered">
       <thead class="" style="background-color: rgba(0,0,0,.03);">
         
       </thead>
       <tbody>
         <tr>
           <td>PETICIÓN DE ARBITRAJE</td>
           <td>S/ 250.00</td>
           <td>INCLUIDO IGV</td>
         </tr>
         <tr>
           <td>DESIGNACIÓN DE  ARBITRAJE</td>
           <td>  S/ 250.00</td>
           <td>INCLUIDO IGV</td>
         </tr>
       </tbody>
     </table>
   
    </div>
  </div>
  </div>


  <div class="col-md-12">
  <div class="card mt-2">
  <!-- <h3 class="card-header text-center"> ARANCELES</h3> -->
  <p class="card-header text-center">ÁRBITRO ÚNICO</p>
    <div class="card-body">     
    <table class="table table-responsive table-bordered">
       <thead  style="background-color: rgba(0,0,0,.03);">
         <tr>
           <th>RANGO DE CUENTA</th>
           <th>FÓRMULA</th>
           <th>MONTOS SIN IMPUESTOS</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td>HASTA S/ 36,000</td>
           <td> </td>
           <td>2700.00</td>
         </tr>
         <tr>
           <td>HASTA S/ 36,001 A S/72,000</td>
           <td>  S/ 2700.00 + 5 % SOBRE LA CANTIDAD QUE EXCEDA DE S/36,000 </td>
           <td> 2700.00</td>
         </tr>
         <tr>
           <td>HASTA S/ 72,001 A S/108,000</td>
           <td>  S/ 4500.00 + 3.5 % SOBRE LA CANTIDAD QUE EXCEDA DE S/72,000 </td>
           <td> 5760.00</td>
         </tr>
       </tbody>
     </table>
   
    </div>
    <div class="card-footer">
      NOTA: LOS GASTOS ARBITRALES PODRÁN SER RELIQUIADOS POR EL CENTRO DE ACUERDO A LA COMPLEJIDAD DEL CASO
      Y/O OTRAS CIRCUNSTANCIAS QUE LO AMERITEN.
    </div>
  </div>
  </div>


  <div class="col-md-12 mb-4">
  <div class="card mt-2">
  <!-- <h3 class="card-header text-center"> ARANCELES</h3> -->
  <p class="card-header text-center">SERVICIO DE ADMINISTRACIÓN DE ARBITRAJE</p>
    <div class="card-body">     
    <table class="table table-responsive table-bordered">
       <thead style="background-color: rgba(0,0,0,.03);">
         <tr>
           <th>RANGO DE CUENTA</th>
           <th>FÓRMULA</th>
           <th>MONTOS SIN IMPUESTOS</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td>HASTA S/ 36,000</td>
           <td> </td>
           <td>1220.40</td>
         </tr>
         <tr>
           <td>HASTA S/ 36,001 A S/72,000</td>
           <td>  S/ 1220.40 + 3 % SOBRE LA CANTIDAD QUE EXCEDA DE S/36,000 </td>
           <td> 2300.40</td>
         </tr>
         <tr>
           <td>HASTA S/ 72,001 A S/108,000</td>
           <td>  S/ 1300.40+ 2 % SOBRE LA CANTIDAD QUE EXCEDA DE S/72,000 </td>
           <td> 3020.00</td>
         </tr>
       </tbody>
     </table>
   
    </div>
    <div class="card-footer">
      NOTA: LOS GASTOS ARBITRALES PODRÁN SER RELIQUIADOS POR EL CENTRO DE ACUERDO A LA COMPLEJIDAD DEL CASO
      Y/O OTRAS CIRCUNSTANCIAS QUE LO AMERITEN.
    </div>
  </div>
  </div>
    
    </div>
  </div>
        
  




  
  </div>
<script src="js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js" integrity="sha512-suUtSPkqYmFd5Ls30Nz6bjDX+TCcfEzhFfqjijfdggsaFZoylvTj+2odBzshs0TCwYrYZhQeCgHgJEkncb2YVQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="js/plugins/jquery.tablesorter.min.js"></script>
<script src="js/tasa.js"></script>
</body>
</html>