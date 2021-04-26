<?php 
/* Componentes HTML */
include_once 'componentes/header.php';
include_once 'componentes/navbar.php';
?>

<nav aria-label="breadcrumb" class="m-4">
    <ol class="breadcrumb migas">
        <li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-home"></i> Panel Principal</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Tasa</li>
    </ol>
</nav>
<div class="card m-4">
    <div class="card-body">
        <div class="form-row">
       
            <div class="form-group col-lg-2 col-12">
                <button class="btn btn-block btn-outline-danger" id="btnNuevoTasa">
                    <i class="fa fa-plus"></i> Nueva Tasa
                </button>
            </div>
        </div>

        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" id='menuArbitroUnico' href="#tabmenuArbitroUnico" style="font-weight: 700;">H. de Arbitro Unico</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" id="menuTribunalArbitral" href="#tabmenuTribunalArbitral" style="font-weight: 700;">H. de Tribunal Arbitral</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" id="menuSecretarioArbitral" href="#tbmenuSecretarioArbitral" style="font-weight: 700;">H. de secretaria Arbitral</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu3" style="font-weight: 700;">H. de Arbitro de Emergencia</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="tabmenuArbitroUnico" class="container tab-pane active"><br>
                               <div class="table-responsive">
                                    <table class="table TablaSistema" id="tblTasa" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">Registro</th>
                                                    <th width="5%">Cuantia Mínima</th>
                                                    <th width="5%">Cuantia Máxima</th>
                                                    <th width="5%">Porcentaje</th>
                                                    <th width="5%">Monto Mínimo</th>
                                                    <th width="5%">Monto Maximo</th>
                                                    <th width="5%">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablaContenidoArbitroUnico">
                                                <!-- CARGADO POR AJAX -->
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="tabmenuTribunalArbitral" class="container tab-pane fade"><br>
                                <div class="table-responsive">

                                  <table class="table TablaSistema" id="tblTasa" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">Registro</th>
                                                    <th width="5%">Cuantia Mínima</th>
                                                    <th width="5%">Cuantia Máxima</th>
                                                    <th width="5%">Porcentaje</th>
                                                    <th width="5%">Monto Mínimo</th>
                                                    <th width="5%">Monto Maximo</th>
                                                    <th width="5%">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablaContenidoTribunalArbitral">
                                                <!-- CARGADO POR AJAX -->
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="tbmenuSecretarioArbitral" class="container tab-pane fade"><br>
                                <div class="table-responsive">

                                  <table class="table TablaSistema" id="tblTasa" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">Registro</th>
                                                    <th width="5%">Cuantia Mínima</th>
                                                    <th width="5%">Cuantia Máxima</th>
                                                    <th width="5%">Porcentaje</th>
                                                    <th width="5%">Monto Mínimo</th>
                                                    <th width="5%">Monto Maximo</th>
                                                    <th width="5%">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablaContenidoSecretarioArbitral">
                                                <!-- CARGADO POR AJAX -->
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="menu3" class="container tab-pane fade"><br>
                                  sd   
                            </div>
                        </div>

        
    </div>
</div>

<!-- =========================================
MODAL : EDICION
============================================-->
<div class="modal fade" id="mdlEditarTasa">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
       <div class="modal-header">
                <h5 class="modal-title" id="mdlAreaTit"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST" id="frmTasa">

            <input type="text" class="form-control" id="idRegistro" name ="idRegistro" style="display: none;">                    
            <div class="form-row">
                
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <label>Cuantia Mínimo</label>
                        <input class="form-control" id="TextcuantiaMinima" name="TextcuantiaMinima" placeholder="Ingrese Cuantia Mínima">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <label>Cuantia Máxima</label>
                        <input class="form-control" id="TextcuantiaMaxima" name="TextcuantiaMaxima" placeholder="Ingrese Cuantia Máxima">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <label>Porcentaje</label>
                        <input class="form-control" id="textPorcentaje" name="textPorcentaje" placeholder="Ingrese Pordentaje">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <label>Monto Mínimo</label>
                        <input class="form-control" id="textMontoMinimo" name="textMontoMinimo" placeholder="Ingrese Monto Mínimo">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <label>Monto Maximo</label>
                        <input class="form-control" id="textMontoMaximo" name="textMontoMaximo" placeholder="Ingrese Monto Maximo">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <label>Tipo Calculo</label>
                        <select class="form-control" id="cbTipoCalculo" name="cbTipoCalculo">
                            <option value="Arbitro unico">Arbitro unico</option>
                            <option value="Tribunal arbitral">Tribunal arbitral</option>
                            <option value="Secretaria arbitral">Secretaria arbitral</option>
                        </select>
                    </div>
                </div>
        
            </div>
        </form>
      </div>

      <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnGuardarTasa">
                    <i class="fa fa-thumbs-o-up"></i> Guardar 
            </button> 
           <button type="button" class="btn btn-danger" data-dismiss = "modal">
            <i class="fa fa-sign-out"></i> Salir 
           </button> 
        </div>

    </div>
  </div>
</div>
<!-- ============================================ -->
 <?php 
	include_once 'componentes/footer.php';
    
?>
<!-- libreria para llamar a los procesos de mantenimiento tasa -->
<script src="js/tasa.js" ></script>