<?php 
/* --------------------------- Componentes HTML --------------------------- */
include_once 'componentes/header.php';
include_once 'componentes/navbar.php';
?>
<nav aria-label="breadcrumb" class="m-3">
    <ol class="breadcrumb migas">
        <li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-edit"></i> Panel Principal</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Mesa de Partes</li>
    </ol>
</nav>

<div class="card m-3">
    <div class="card-body">
        <h2 class="titulo"><i class="fa fa-envelope-o"></i> Mesa de Partes</h2>    
        <p class="subtitulo">Aquí podras consultar todos los mensajes referentes a tus Solicitudes.</p>

        <input type="text" id="usuarioOrigen" name="usuarioOrigen" class="form-control" value="<?php echo $idUsuario; ?>" style="display: none;">
        <input type="text" id="areaOrigen" name="areaOrigen" class="form-control" value="<?php echo $idArea; ?>" style="display: none;">

        <div class="form-row">

            <div class="form-group col-lg-3 col-12">
                <input type="text" class="form-control" placeholder="Nombre o razón social de demandante" id="RazSocDem" name ="RazSocDem">
            </div>

            <div class="form-group col-lg-2 col-12">
                <input type="text" class="form-control" placeholder="Nro de Solicitud" id="NumSol" name ="NumSol">
            </div>

            <div class="form-group col-lg-2 col-12">
                <select class="form-control" name="cboEstsol" id="cboEstsol">
                    <?php 
                            echo '<option value="%"> Todos </option>';
                        foreach ($MEstado as $key => $value) {
                            echo '<option value="'.$value['id'].'">'.$value['desest'].'</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group col-lg-2 col-12">
                <button type="button" class="btn btn-success btn-block" id="btnBuscarDocInt">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table" id="tblRecepcion" style="width: 100%">
                <thead>
                    <tr class="text-center">
                        <th width="5%">Nro.</th>
                        <th width="10%">Nro. de Trámite</th>
                        <th width="15%">Fecha de registro</th>
                        <th width="30%">Tipo de Solicitud</th>
                        <th width="20%">Solicitante</th>
                        <th width="5%">Estado</th>
                        <th width="5%">Solicitud</th>
                        <th width="5%">Envios</th>
                        <th width="5%">Derivar</th>
                    </tr>
                </thead>
                <tbody>
                <!-- CARGADO POR AJAX -->
                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- ============================================================================
    MODAL : RESUMEN DE ENVIO
===============================================================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdlResumen">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <!--============================ TITULO ============================-->
        <div class="modal-header">
            <h5 class="modal-title"> Derivar Solicitud</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!--============================ CUERPO ============================-->
        <div class="modal-body">
            <p> <i class="fa fa-check-square-o fa-lg"></i> Se derivo la Solicitud Correctamente</p>
            <div class="form-row">

                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label text-right">Área de Destino</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="rareadestino" name="rareadestino" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label text-right">Documento Interno</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="rnumdocint" name="rnumdocint" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label text-right">Asunto</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="rasunto" name="rasunto" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label text-right">Referencia</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="rreferencia" name="rreferencia" disabled>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--============================ HERRAMIENTAS ============================-->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal"> Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- ============================================================================
    MODAL : DERIVAR SOLICITUD
===============================================================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdlDerivarSolicitud">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <!--============================ TITULO ============================-->
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-tags"></i> Derivar Solicitud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--============================ CUERPO ============================-->
      <div class="modal-body">
        <div class="form-row">

            <div class="col-sm-12" style = "display:none;" >
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Solicitud</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="idSolicitud" name="idSolicitud" readonly="">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Area de destino</label>
                    <div class="col-sm-8">
                        <select name="areaDestino" id="areaDestino" class="form-control">
                            <option value="">Seleccionar</option>
                            <?php 
                                foreach ($MArea as $key => $value) {
                                    echo '<option value="'.$value['id'].'">'.$value['desarea'].'</option>';
                                }
                             ?>
                        </select>
                    </div>        
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tipo de Documento</label>
                    <div class="col-sm-8">
                        <select name="tipoDocumento" id="tipoDocumento" class="form-control">
                            <?php 
                                
                                echo '<option value="0"> Seleccionar </option>';
                                echo '<option value="99"> Sin Documento </option>';

                                foreach ($MDocInt as $key => $value) {
                                    echo '<option value="'.$value['id'].'">'.$value['desdocint'].'</option>';
                                }
                             ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Para</label>
                    <div class="col-sm-8">
                        <select name="para" id="para" class="form-control">
                            <option value="0">Selecione área de destino</option>                            
                        </select>
                    </div>        
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Asunto</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="asunto" name="asunto" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Referencia</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="referencia" name="referencia" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Contenido</label>
                    <div class="col-sm-8">
                        <textarea type="text" class="form-control" id="contenido" name="contenido" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Documento Adjunto</label>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="NomArcReq" lang="es">
                            <label class="custom-file-label" for="NomArcReq">Seleccionar archivo</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!--============================ HERRAMIENTAS ============================-->
      <div class="modal-footer">
        <button type="button" id="btnDerivar" class="btn btn-success" onclick=""><i class="fa fa-paper-plane "></i> Derivar</button>
      </div>

    </div>
  </div>
</div>


<?php 
	include_once 'componentes/footer.php';
?>