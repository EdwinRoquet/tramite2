<?php 
/*  --------------------------- Componentes HTML --------------------------- */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';

    $idRespuesta = $_GET['id'];

    $MSolicitudRespuesta = $solicitudrespuesta->ObtenerRespuestaPendiente($idRespuesta);

 ?>
<div class="card m-3">
    <form method="POST" id="frmSolicitudRespuesta" enctype="multipart/form-data">
        <div class="card-body">
            <h2 class="titulo"> <i class="fa fa-comments"></i> Respuesta a Solicitud de demanda </h2>
            <p class="subtitulo">Complete la información solicitada en el siguiente formulario</p>

            <ul class="nav nav-tabs pnlRegistro">
                <li class="nav-item"> <a class="nav-link active show" data-toggle="pill" data-target="#tabDemandado"><i class="fa fa-arrow-right"></i> Demandado</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabArbitro"><i class="fa fa-arrow-right"></i> Designación de Árbitro</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabInfAdicional"><i class="fa fa-arrow-right"></i> Información Adicional</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabAnexos"><i class="fa fa-arrow-right"></i> Anexos</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade p-3 active show" id="tabDemandado">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Demandado
                                    <p class="m-0">Información de Demandado</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Nombre o Razón Social</label>
                                                <input class="form-control" id="RazSocDem" name="RazSocDem" value="<?php echo $MSolicitudRespuesta['RazSocDmd']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Tipo de Documento de Identidad</label>
                                                <select id="TipDocDem" name="TipDocDem" class="form-control cbo" disabled>
                                                <?php 
                                                    foreach ($MTipDoc as $key => $value) {
                                                        echo '<option value="'.$value["id"].'"';
                                                            if($value["id"] == $MSolicitudRespuesta["TipDocDmd"])
                                                            {
                                                                echo 'selected="selected"';
                                                            } 
                                                        echo '>';
                                                        echo $value["tipdoc"].'</option>';
                                                    }
                                                   ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Número de Documento</label>
                                                <input class="form-control input_num" id="NumDocDem" name="NumDocDem" maxlength="11" placeholder="Ingrese número de documento" value="<?php echo $MSolicitudRespuesta["NumDocDmd"] ?>" disabled>
                                                <div id="msgval1" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Domicilio real</label>
                                                <input class="form-control" id="DesDirDmd" name="DesDirDmd" value="<?php echo $MSolicitudRespuesta["DesDirDmd"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Correo electrónico</label>
                                                <input class="form-control" id="DesEma" name="DesEma" value="<?php echo $MSolicitudRespuesta["DirEmaDmd"]; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group"> <label style="color: #BE3922;"><i class="fa fa-lock"></i> Clave de Seguridad (Token)</label>
                                                <input class="form-control" id="ValSegTok" name="ValSegTok" placeholder="Por ejemplo : A9ZH1K" value="<?php echo $MSolicitudRespuesta["ValSegTok"] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Representante Legal
                                    <p class="m-0">Información de Representante Legal</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Apellidos y Nombres</label>
                                                    <input class="form-control" id="NomRepLeg" name="NomRepLeg" value="<?php echo $MSolicitudRespuesta['ApeNomLeg']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Tipo de Documento de Identidad</label>
                                                <select id="TipDocRep" name="TipDocRep" class="form-control cbo">
                                                    <option value="">Seleccionar</option>
                                                <?php 
                                                    foreach ($MTipDoc as $key => $value) {
                                                        // echo '<option value="'.$value["id"].'">'.$value["tipdoc"].'</option>';
                                                        if($value["id"]!= "3"){
                                                
                                                            echo '<option value="'.$value["id"].'"';

                                                            if($value["id"] == $MSolicitudRespuesta["TipDocRep"])
                                                                {
                                                                    echo 'selected="selected"';
                                                                } 
                                                                
                                                            echo '>';

                                                            echo $value["tipdoc"].'</option>';
                                                        }
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Número de Documento</label>
                                                <input class="form-control input_num" id="txtNumDocRep" name="txtNumDocRep" maxlength="11" placeholder="Ingrese número de documento" value="<?php echo $MSolicitudRespuesta['NumDocRep']; ?>">
                                                <div id="msgval2" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Cod. ciudad + Teléfono Fijo.</label>
                                                <input class="form-control input_tel" id="txtNumTelRep" name="NumTelRep" placeholder="Ejemplo: (51) 5701863" value="<?php echo $MSolicitudRespuesta['NumTelRep']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Celular</label>
                                                <input class="form-control input_tel" id="txtNumCelRep" name="NumCelRep" placeholder="Ejemplo: 999999999" value="<?php echo $MSolicitudRespuesta['NumCelRep']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Correo Electrónico</label>
                                                <input class="form-control" id="txtDirEmaRep" name="DirEmaRep" placeholder="Ejemplo: juan59@outlook.com" value="<?php echo $MSolicitudRespuesta['DirEmaRep']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div role="tabpanel" class="tab-pane fade p-3" id="tabArbitro"> 
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Designación de Árbitro
                                    <p class="m-0">Complete la información del árbitro propuesto que conformará el Tribunal Arbitral.</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">   
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>Nombre de Árbitro</label>
                                               <input class="form-control" id="txtApeNomArb" name="ApeNomArb" value="<?php echo $MSolicitudRespuesta['ApeNomArb']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>Dirección</label>
                                                <input class="form-control" id="txtDesDirArb" name="DesDirArb" placeholder="Dirección / Distrito" value="<?php echo $MSolicitudRespuesta['DesDirArb']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>Celular</label>
                                                <input class="form-control" id="txtNumTelArb" name="NumTelArb" value="<?php echo $MSolicitudRespuesta['NumTelArb']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>Correo Electrónico</label>
                                                <input class="form-control" id="txtDirEmaArb" name="DirEmaArb" value="<?php echo $MSolicitudRespuesta['DirEmaArb']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"><label>Profesión</label>
                                                <input type="text" class="form-control" id="txtNomProArb" name = "NomProArb" placeholder="Ingrese una profesión" value="<?php echo $MSolicitudRespuesta['NomProArb']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"><label>N° Colegiatura</label>
                                                <input type="text" class="form-control" id="txtNumColArb" name = "NumColArb" placeholder="Ingrese el número de colegiatura" value="<?php echo $MSolicitudRespuesta['NumColArb']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>¿Esta inscrito en Registro de Árbitros (OSCE)?</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="FlgRegArb" name ="FlgRegArb" value="Yes"
                                                    <?php if($MSolicitudRespuesta['FlgRegArb']=='1'){ echo 'checked';}?>>
                                                    <label class="form-check-label" for="FlgRegArb">
                                                        Si
                                                    </label>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <p>En caso no desee designar árbitro de parte, marque la siguiente opción: </p>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="FlgPrtArb" name ="FlgPrtArb" value="Yes"
                                                    <?php if($MSolicitudRespuesta['FlgPrtArb']=='1'){ echo 'checked';}?>>
                                                    <label class="form-check-label" for="FlgPrtArb">
                                                        El Centro de Arbitraje designe al árbitro de parte.
                                                    </label>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">    
                                                <p>En caso de Árbitro Único y no exista intención de acuerdo sobre la designación de Árbitro Único, marque la siguiente opción :</p>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="FlgUniArb" name ="FlgUniArb" value="Yes"
                                                    <?php if($MSolicitudRespuesta['FlgUniArb']=='1'){ echo 'checked';}?>>
                                                    <label class="form-check-label" for="FlgUniArb">
                                                        El Centro de Arbitraje designe al árbitro Único.
                                                    </label>
                                                </div>                            
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- fin card -->
                        </div> <!-- fin col-sm-6 -->
                    </div> <!-- fin form-row -->
                </div> <!-- fin tabpanel : tabArbitro -->

                <div role="tabpanel" class="tab-pane fade p-3" id="tabInfAdicional"> 
                    <div class="form-row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Posición de Parte Demandada
                                    <p class="m-0">Información por parte del demandado</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="detposdem" id="detposdem" cols="30" rows="6" placeholder="Detalle aqui la posición del demandado."><?php echo $MSolicitudRespuesta['PosPrtDmd']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Pretensión de Reconvención
                                    <p class="m-0">Pretensión de Reconvensión de ser el caso</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="detprecon" id="detprecon" cols="30" rows="6" placeholder="Detalle aqui la pretensión de Reconvensión."><?php echo $MSolicitudRespuesta['PreRecDmd']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Cuantía de Controversia
                                    <p class="m-0">Señalar las posibles pretensiones  y el monto involucrado, en cuanto sea cuantificable.</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="detcuacon" id="detcuacon" cols="30" rows="6" placeholder="Detalle de Cuantía."><?php echo $MSolicitudRespuesta['CuaCtrdmd']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade p-3" id="tabAnexos">
                    <div class="form-row">
                        <div class="col-sm-8">
                            <div class="card">
                                
                                <div class="card-header font-weight-bold">
                                    Anexos
                                    <p class="m-0">Información de Anexos</p>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="form-row">
                                        <div class="col-sm-3">
                                            <label>Copia de DNI</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="NomArcReq01" name="NomArcReq01" lang="es">
                                                <label class="custom-file-label" for="NomArcReq01">Seleccionar archivo</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <?php 
                                            if ($MSolicitudRespuesta['DirFil01'] != ''){
                                                echo '<a href="upload/'.$MSolicitudRespuesta['DirFil01'].'" class="btn btn-primary" download><i class="fa fa-download"></i> Descargar Adjunto</a>';
                                            }?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-3">
                                            <label>Acreditación del representante legal</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="NomArcReq02" name="NomArcReq02" lang="es">
                                                <label class="custom-file-label" for="NomArcReq02">Seleccionar archivo</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <?php 
                                            if ($MSolicitudRespuesta['DirFil02'] != ''){
                                                echo '<a href="upload/'.$MSolicitudRespuesta['DirFil02'].'" class="btn btn-primary" download><i class="fa fa-download"></i> Descargar Adjunto</a>';
                                            }?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-3">
                                            <label>Documentación que considere adjuntar</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="NomArcReq03" name="NomArcReq03" lang="es">
                                                <label class="custom-file-label" for="NomArcReq03">Seleccionar archivo</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <?php 
                                            if ($MSolicitudRespuesta['DirFil03'] != ''){
                                                echo '<a href="upload/'.$MSolicitudRespuesta['DirFil03'].'" class="btn btn-primary" download><i class="fa fa-download"></i> Descargar Adjunto</a>';
                                            }?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
    	    <div class="form-row">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-success" onclick="RegistrarRespuestaDemanda(<?php echo $idRespuesta; ?>);">
                        <i class="fa fa-exchange "></i> Registrar Respuesta 
                    </button>
                </div> 
            </div>
        </div>
    </form>
</div>
<!-- =======================================================
     MODAL : VALIDACION DE DATOS
     ======================================================== -->
<div class="modal fade" id="MdlValidacionRespuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Validación de Datos</h4>
            </div>
            <div class="modal-body" id="bodyValidacionRespuesta"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss = "modal"> Salir </button> 
            </div>
        </div>
    </div>
</div>
<?php 
    include_once 'componentes/footer.php';
 ?>