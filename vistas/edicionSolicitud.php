<?php 
    /* --------------------------- Componentes HTML --------------------------- */
    include_once 'componentes/header.php';
    include_once 'componentes/navbar.php';

    /* ------------------------- Librerias de Proyecto ------------------------- */
    include_once '../includes/tipdoc.php';
    include_once '../includes/tipoanexo.php';
    include_once '../includes/tipocomprobante.php';
    include_once '../includes/tipocuantia.php';
    include_once '../includes/moneda.php';
    include_once '../includes/solicitud.php';
    include_once '../includes/solicitudpretension.php';
    include_once '../includes/solicitudanexo.php';

    $TipDoc             = new TipDoc();
    $TipoAnexo          = new TipoAnexo();
    $TipoComprobante    = new TipoComprobante();
    $TipoCuantia        = new TipoCuantia();
    $Moneda             = new Moneda();

    $MTipDoc            = $TipDoc->listarTipdoc();
    $MTipoAnexo         = $TipoAnexo->listartipoAnexo();
    $MTipoComprobante   = $TipoComprobante->listartipoComprobante();
    $MTipoCuantia       = $TipoCuantia->listartipoCuantia();    
    $MMoneda            = $Moneda->listarMoneda();

    /*  =============================================
    EDITAMOS SOLICITUD
    ===============================================*/
      $MsgErr = '<div class="container-fluid p-4">
                    <div class="row">
                        <div class="col pt-3">
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">¡Lo Sentimos!</h4>
                                <p>La Solicitud que intenta editar no puede visualizarse posiblemente porque <strong>no existe</strong> o se encuentra en un <strong>estado</strong> que impide este proceso.</p>
                                <hr>
                                <p class="mb-0">Sugerimos usar la opción <strong>Casilla Electrónica</strong> para dar seguimiento a sus Solicitudes</p>
                            </div>
                        </div>
                    </div>
                </div>';
                
    if(isset($_GET['id']))
    {
      if(is_numeric($_GET['id']))
        {
            $id = $_GET['id'];
            // Edición de Solicitud, aqui
            $flgModal = 'N';
            $ValMsnRegistro = '0';
            $Solicitud = new Solicitud();

            // Si la solicitud existe entonces se cargara los datos en el navegador
            $idUsuario =  $user->getId();
            $Solicitud = $Solicitud->EditarSolicitud($id,$idUsuario);

            $SolicitudPretension = new SolicitudPretension();
            $MSolicitudPretension = $SolicitudPretension->ListarSolicitudPretension($id);

            $SolicitudAnexo = new SolicitudAnexo();
            $MSolicitudAnexo = $SolicitudAnexo->ListarSolicitudAnexo($id);

            if($Solicitud){
?>
<!-- ============================================================================ -->
<div class="container-fluid p-4 frmSolicitud">
    <div class="row">
        <div class="col pt-3">
            <h3 class="titPage">
                <i class="fa fa-edit icoLogo"></i> Solicitud de Arbitraje [Edición]
            </h3>
            <p>Modificación de datos de Solicitud</p>

            <!-- ================================================================  -->
            <ul class="nav nav-tabs pnlRegistro" id="pnlRegistro">
                <li class="nav-item"> <a class="nav-link active show" data-toggle="pill" data-target="#tabDemandante"><i class="fa fa-arrow-right"></i> Demandante</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabDemandado"><i class="fa fa-arrow-right"></i> Demandado</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabConvArbitral"><i class="fa fa-arrow-right"></i> Convenio</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabTipoArbitraje"><i class="fa fa-arrow-right"></i> Tipo de Arbitraje</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabNarracionHechos"><i class="fa fa-arrow-right"></i> Hechos</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabPretensiones"><i class="fa fa-arrow-right"></i> Pretensiones</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabInfoProcExtra"><i class="fa fa-arrow-right"></i> Medida cautelar</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabCuantia"><i class="fa fa-arrow-right"></i> Cuantía</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabDesigArbitro"><i class="fa fa-arrow-right"></i> Designación de Árbitro</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabAnexos"><i class="fa fa-arrow-right"></i> Anexos</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabEnviarSolicitud"><i class="fa fa-arrow-right"></i> Enviar Solicitud</a> </li>
            </ul>
            <!-- ================================================================  -->
            <form method="POST" id="arbitraje" action="grabarSolicitud.php"  enctype="multipart/form-data">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade p-4 active show " id="tabDemandante">
                    <!-- -------------------------------------------------------- -->
                    <h3>Demandante</h3>
                    <p>Información de Demandante</p>
                    
                    <input type="text" id="id" name="id" class="form-control col-sm-2" style="display: none;" value="<?php echo $id; ?>">
                    <input type="text" id="usr_nom" name="usr_nom" class="form-control col-sm-2" style="display: none;" value="<?php echo $user->getNombre();?>">
                    <input type="text" id="usr_ema" name="usr_ema" class="form-control col-sm-2" style="display: none;" value="<?php echo $user->getUserName();?>">

                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group"> <label>Nombre o Razón Social</label>
                                    <input class="form-control" id="txtRazSocDem" name="RazSocDem" placeholder="Ejemplo:Juan Carlos Montenegro Vega" value="<?php echo $Solicitud['RazSocDem']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"> <label>Tipo de Documento de Identidad</label>
                                    <select id="TipDocDem" name="TipDocDem" class="form-control cbo">
                                      <?php 
                                        foreach ($MTipDoc as $key => $value) {
                                            echo '<option value="'.$value["id"].'"';
                                                if($value["id"] == $Solicitud["TipDocDem"])
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
                            <div class="col-sm-3">
                                <div class="form-group"> <label>Número de Documento</label>
                                    <input class="form-control input_num" id="txtNumDocDem" name="NumDocDem" value="<?php echo $Solicitud['NumDocDem']; ?>" maxlength="11" placeholder="Ingrese número de documento">
                                    <div id="msgval1" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"> <label>Escritura Pública/Acta legalizada/Copia literal/ Copia de la vigencia de poder expedida de los registros públicos</label>
                                    <input class="form-control" name="EscPubDem" value="<?php echo $Solicitud['EscPubDem']; ?>" placeholder="Escriba el documento que adjuntara en el ítem de anexos, por ejemplo: la vigencia de poder.">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"> <label>Domicilio de la persona natural o jurídica</label>
                                    <input class="form-control" name="DesDirDem" placeholder="Ejemplo: Los Manzanos N° 125 - Residencial San Luis, distrito de San Borja,  provincia y región de Lima" value="<?php echo $Solicitud['DesDirDem']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <hr>
                                <h3>Representante Legal</h3>
                                <p>Información del Representante Legal</p>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"> <label>Nombre</label>
                                    <input class="form-control" id="txtApeNomLeg" name="ApeNomLeg" placeholder="Ejemplo:Juan Carlos Montenegro Vega" value="<?php echo $Solicitud['ApeNomLeg']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"> <label>Tipo de Documento</label>
                                    <select  id="TipDocRep" name="TipDocRep" class="form-control cbo">
                                        <?php 
                                        foreach ($MTipDoc as $key => $value) {
                                            if($value["id"]!= "3"){
                                                
                                                echo '<option value="'.$value["id"].'"';

                                                if($value["id"] == $Solicitud["TipDocRep"])
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
                            <div class="col-sm-3">
                                <div class="form-group"> <label>Número de Documento</label>
                                    <input class="form-control input_num" id="txtNumDocRep" name="NumDocRep" value="<?php echo $Solicitud['NumDocRep']; ?>" maxlength="11" placeholder="Ingrese número de documento">
                                    <div id="msgval2" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"> <label>cod. ciudad + Teléfono Fijo.</label>
                                    <input class="form-control input_tel" id="txtNumTelRep" name="NumTelRep" value="<?php echo $Solicitud['NumTelRep']; ?>" placeholder="Ejemplo: (51) 5701863">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"> <label>Celular</label>
                                    <input class="form-control input_tel" id="txtNumCelRep" name="NumCelRep" value="<?php echo $Solicitud['NumCelRep']; ?>" placeholder="Ejemplo: 999999999">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"> <label>Correo Electrónico</label>
                                    <input class="form-control" id="txtDirEmaRep" name="DirEmaRep" value="<?php echo $Solicitud['DirEmaRep']; ?>" id="txtDirEmaRep" placeholder="Ejemplo: juan59@outlook.com">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <hr>
                                <h3>Emisión de Comprobante</h3>
                                <p>La factura o boleta se deberá de emitir a nombre de:</p>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group"> <label>Tipo de Comprobante</label>
                                <select name="TipDocEmiCom" class="form-control cbo">
                                      <?php 
                                        foreach ($MTipoComprobante as $key => $value) {
                                            echo '<option value="'.$value["id"].'"';
                                            if($value["id"] == $Solicitud["TipDocEmiCom"])
                                              {
                                                echo 'selected="selected"';
                                              } 
                                            echo '?>';
                                            echo $value["destip"].'</option>';
                                        }
                                       ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Numero de Documento</label>
                                    <input class="form-control input_num" name="NumDocEmiCom" placeholder="DNI (para Boleta) ó RUC (para Factura)" value="<?php echo $Solicitud['NumDocEmiCom']; ?>" maxlength="11">
                                </div>
                          </div>
                          <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Razón Social</label>
                                    <input class="form-control" type="text" name="RazSocEmiCom" placeholder="Ejemplo:Juan Carlos Montenegro Vega" value="<?php echo $Solicitud['RazSocEmiCom']; ?>">
                                </div>
                          </div>

                          <div class="col-lg-12">
                            <button type="button" class="btn btn-success btnRegistrar p-2 pull-right siguiente">
                                <i class="fa fa-forward"></i> Siguiente 
                            </button>
                        </div>

                      </div>
                </div>
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabDemandado">
                    <!--=============================================
                        DEMANDADO
                        ============================================= -->
                        <h3>Demandado</h3>
                        <p>Información del Demandado</p>
                        <div class="form-row">

                            <!-- RAZON SOCIAL DE DEMANDADO-->
                            <div class="col-sm-6">
                                <div class="form-group"> <label>Nombre o Razón Social</label>
                                <input class="form-control" id="txtRazSocDmd" name="RazSocDmd" placeholder="Ejemplo:Juan Carlos Montenegro Vega" value="<?php echo $Solicitud['RazSocDmd']; ?>">
                              </div>
                            </div>

                            <!-- DOMICILIO -->
                            <div class="col-sm-6">
                              <div class="form-group"> <label>Domicilio</label>
                                <input class="form-control" id="txtDesDirDmd" name="DesDirDmd" placeholder="Ejemplo: Los Manzanos N° 125 - Residencial San Luis, distrito de San Borja,  provincia y región de Lima" value="<?php echo $Solicitud['DesDirDmd']; ?>">
                              </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group"> <label>Tipo de Documento</label>
                                    <select id="TipDocDmd" name="TipDocDmd" class="form-control cbo">
                                        <?php 
                                        foreach ($MTipDoc as $key => $value) {
                                            echo '<option value="'.$value["id"].'"';
                                            if($value["id"] == $Solicitud["TipDocDmd"])
                                              {
                                                echo 'selected="selected"';
                                              } 
                                            echo '?>';
                                            echo $value["tipdoc"].'</option>';
                                        }
                                       ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group"> <label>Número de Documento</label>
                                    <input class="form-control input_num" id="txtNumDocDmd" name="NumDocDmd" value="<?php echo $Solicitud['NumDocDmd']; ?>" maxlength="11" placeholder="Ingrese número de documento">
                                    <div id="msgval3" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                </div>
                            </div>

                            <!-- TELEFONO -->
                            <div class="col-sm-3">
                              <div class="form-group"> <label>cod. ciudad + Teléfono Fijo.</label>
                                <input class="form-control input_tel" name="NumTelDmd" value="<?php echo $Solicitud['NumTelDmd']; ?>" placeholder="Ejemplo: (51) 5701863">
                              </div>
                            </div>

                            <!-- CELULAR -->
                            <div class="col-sm-3">
                              <div class="form-group"> <label>Celular</label>
                                <input class="form-control input_tel" name="NumCelDmd" value="<?php echo $Solicitud['NumCelDmd']; ?>" placeholder="Ejemplo: 999999999">
                              </div>
                            </div>

                            <!-- EMAIL -->
                            <div class="col-sm-6">
                              <div class="form-group"> <label>Correo Electrónico</label>
                                <input class="form-control" name="DirEmaDmd" value="<?php echo $Solicitud['DirEmaDmd']; ?>" id="txtDirEmaDmd" placeholder="Ejemplo: juan59@outlook.com">
                              </div>
                            </div>

                            <!-- AUTORIDAD O REPRESENTANTE -->
                            <div class="col-sm-6">
                              <div class="form-group"> <label>Autoridad o representante</label>
                                <input class="form-control" name="AutRepDmd" id="txtAutRepDmd" value="<?php echo $Solicitud['AutRepDmd']; ?>" placeholder="Ingrese una autoridad o representante">
                              </div>
                            </div>

                            <!-- PRPOCURADOR PÚBLICO DE CORRESPONDER -->
                            <div class="col-sm-6">
                              <div class="form-group"> <label>Procurador público/abogado</label>
                                <input class="form-control" name="ProPubDmd" id="txtProPubDmd" value="<?php echo $Solicitud['ProPubDmd']; ?>" placeholder = "Ingrese Procurador público/abogado">
                              </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-success btnRegistrar p-2 pull-left anterior">
                                    <i class="fa fa-backward"></i> Anterior 
                                </button>
                            </div> 
                            <div class="col-sm-6">
                                    <button type="button" class="btn btn-success btnRegistrar p-2 pull-right siguiente">
                                        <i class="fa fa-forward"></i> Siguiente 
                                    </button>
                            </div> 
                        </div>
                        <!-- -------------------------------------------------------- -->
                </div>
                      <div role="tabpanel" class="tab-pane fade p-4"  id="tabConvArbitral">
                    <!-- -------------------------------------------------------- -->
                    <h3>Convenio Arbitral</h3>
                    <p>Indicar su interés que la controversia existente se organice y administre
                     a través del Centro de Arbitraje Latinoamericano e Investigaciones Jurídicas, 
                     o indicar la cláusula arbitral.</p>
                     <div class="form-row">
                         <div class="col-sm-12">
                             <div class="form-group">
                                 <textarea class="form-control" name = "DesConArb" rows="3" placeholder="“Todas las disputas o controversias, derivadas o relacionadas de este acto jurídico, serán resueltos mediante arbitraje, bajo la organización y administración del Centro de Arbitraje Latinoamericano e Investigaciones Jurídicas; conforme a su estatuto y reglamentos a los cuales las partes se someten incondicionalmente, señalando que el laudo que se emita en el proceso arbitral será inapelable y definitivo”."><?php echo $Solicitud['DesConArb']; ?></textarea>
                             </div>
                         </div>
                         <div class="col-lg-12">
                            <button type="button" class="btn btn-success btnRegistrar p-2 pull-right siguiente">
                                <i class="fa fa-forward"></i> Siguiente 
                            </button>
                        </div>
                     </div>                     
                    <!-- -------------------------------------------------------- -->
                    </div>
                    <div role="tabpanel" class="tab-pane fade p-4"  id="tabTipoArbitraje">
                        <h3>Tipo de Arbitraje</h3>
                        <p>Seleccione las casillas que considere aplicable a:</p>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Su controversia</label>
                                    <!-- ============================================= -->
                                    <div class="custom-control custom-checkbox chk">
                                        <input type="checkbox" class="custom-control-input" id="flgCtrDer" name="flgCtrDer" value="Yes" 
                                        <?php if($Solicitud['flgCtrDer']=='1'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="flgCtrDer">De Derecho</label>
                                    </div>
                                    <!-- ============================================= -->
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="flgCtrCon" name="flgCtrCon" value="Yes" 
                                        <?php if($Solicitud['flgCtrCon']=='1'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="flgCtrCon">De Conciencia</label>
                                    </div>
                                    <!-- ============================================= -->
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="flgCtrNac" name="flgCtrNac" value="Yes" 
                                        <?php if($Solicitud['flgCtrNac']=='1'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="flgCtrNac">Nacional</label>
                                    </div>
                                    <!-- ============================================= -->
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="flgCtrInt" name="flgCtrInt" value="Yes" 
                                        <?php if($Solicitud['flgCtrInt']=='1'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="flgCtrInt">Internacional</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Especialidad</label>
                                    <!-- ============================================= -->
                                    <div class="custom-control custom-checkbox chk">
                                        <input type="checkbox" class="custom-control-input" id="flgEspCtr" name="flgEspCtr" value="Yes"
                                        <?php if($Solicitud['flgEspCtr']=='1'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="flgEspCtr">Contratación Pública</label>
                                    </div>
                                    <!-- ============================================= -->
                                    <div class="custom-control custom-checkbox chk">
                                        <input type="checkbox" class="custom-control-input" id="flgEspCiv" name="flgEspCiv" value="Yes"
                                        <?php if($Solicitud['flgEspCiv']=='1'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="flgEspCiv">Civil</label>
                                    </div>
                                    <!-- ============================================= -->
                                    <div class="custom-control custom-checkbox chk">
                                        <input type="checkbox" class="custom-control-input" id="flgEspLey" name="flgEspLey" value="Yes"
                                        <?php if($Solicitud['flgEspLey']=='1'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="flgEspLey">Ley General de Sociedad</label>
                                    </div>
                                    <!-- ============================================= -->
                                    <div class="custom-control custom-checkbox chk">
                                        <input type="checkbox" class="custom-control-input" id="flgEspMin" name="flgEspMin" value="Yes"
                                        <?php if($Solicitud['flgEspMin']=='1'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="flgEspMin">Minero</label>
                                    </div>
                                    <!-- ============================================= -->
                                    <div class="custom-control custom-checkbox chk">
                                        <input type="checkbox" class="custom-control-input" id="flgEspCon" name="flgEspCon" value="Yes"
                                        <?php if($Solicitud['flgEspCon']=='1'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="flgEspCon">Concesiones</label>
                                    </div>
                                    <!-- ============================================= -->
                                    <div class="custom-control custom-checkbox chk">
                                        <input type="checkbox" class="custom-control-input" id="flgEspOtr" name="flgEspOtr" value="Yes"
                                        <?php if($Solicitud['flgEspOtr']=='1'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="flgEspOtr">Otros</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                            <button type="button" class="btn btn-success btnRegistrar p-2 pull-right siguiente">
                                <i class="fa fa-forward"></i> Siguiente 
                            </button>
                            </div>

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade p-4"  id="tabNarracionHechos">
                    <!-- -------------------------------------------------------- -->
                    <h3>Narración de los Hechos</h3>
                    <p>
                      Narración breve de los hechos que desee someter a arbitraje. <br>
                      (El solicitante debe hacer un resumen claro de los hechos que han generado la controversia)
                    </p>
                     <div class="form-row">
                         <div class="col-sm-12">
                             <div class="form-group">
                                 <textarea class="form-control" name = "DesNarHec" rows="3" placeholder="Ingrese un resumen claro de los hechos que han generado la controversia."><?php echo $Solicitud['DesNarHec']; ?>
                                 </textarea>
                             </div>
                         </div>

                         <div class="col-lg-12">
                            <button type="button" class="btn btn-success btnRegistrar p-2 pull-right siguiente">
                                <i class="fa fa-forward"></i> Siguiente 
                            </button>
                        </div>

                     </div>
                    <!-- -------------------------------------------------------- -->
                </div>
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabPretensiones">
                    <h3>Pretensiones</h3>
                    <p>El petitorio debe ser redactado con claridad y precisión</p>
                    <div class="form-row">
                        <div class="form-group col-lg-10 col-12">
                            <input type="hidden" class="form-control" id="idPretensionEdit" name="idPretensionEdit">
                            <input type="text" class="form-control" id="DesPretension" name="DesPretension" placeholder="Ingrese su pretensión">
                        </div>
                        <div class="form-group col-lg-2 col-12">
                            <button type="button" class="btn btn-outline-success btn-block btnAgregar" id="btnAgregar">
                                <i class="fa fa-search"></i>
                                Agregar
                            </button> 
                        </div>
                    </div>
                    <div class="table-responsive">
                            <table class="table" id="tbPretensiones">
                                <thead>
                                    <tr class="text-center">
                                        <th width="90%">Pretensión</th>
                                        <th width="10%" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($MSolicitudPretension as $key => $value) {
                                            echo '<tr>';
                                            echo '<tr id="fila'.$value["idPretension"].'">';

                                                echo '<td>'.$value["desPretension"].'</td>';
                                                echo '<td class="text-center">

                                                        <a href="#" class="btn btn-outline-info btnAccion" 
                                                           onclick="eliminarPretension('.$value["idPretension"].');">
                                                        <i class="fa fa-trash" aria-hidden="true" title="Eliminar Pretensión" ></i> Eliminar </a>

                                                        <a href="#" class="btn btn-outline-info btnAccion" 
                                                           onclick="editarPretension('.$value["idPretension"].');">
                                                        <i class="fa fa-trash" aria-hidden="true" title="Editar Pretensión" ></i> Editar </a>

                                                     </td>';
                                            echo "</tr>";
                                            }
                                     ?>
                                </tbody>
                            </table>
                    </div>
                
                    <div class="form-row">
                    <div class="col-lg-12">
                            <button type="button" class="btn btn-success btnRegistrar p-2 pull-right siguiente">
                                <i class="fa fa-forward"></i> Siguiente 
                            </button>
                    </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabInfoProcExtra">
                    <!-- -------------------------------------------------------- -->
                    <h3>Medida cautelar</h3>
                    <p>Información sobre procesos extra arbitrales interpuestos ante el Árbitro de Emergencia o ante el órgano jurisdiccional - Poder Judicial - sobre la materia en arbitraje: (cautelares).</p>
                     <div class="form-row">
                         <div class="col-sm-12">
                             <div class="form-group">
                                 <textarea class="form-control" name = "DesMedCau" rows="3" maxlength = 950 placeholder="Ingrese un resumen claro de los hechos que han generado controversia."><?php echo $Solicitud['DesMedCau']; ?>                                     
                                 </textarea>
                             </div>
                             <p class="text-muted">Máximo 950 caracteres</p>
                         </div>
                         <div class="col-lg-12">
                            <button type="button" class="btn btn-success btnRegistrar p-2 pull-right siguiente">
                                <i class="fa fa-forward"></i> Siguiente 
                            </button>
                    </div>
                     </div>
                    <!-- -------------------------------------------------------- -->
                </div>
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabCuantia">
                    <!-- -------------------------------------------------------- -->
                    <h3>Cuantía</h3>
                    <p>Se estima que el importe controvertido en el presente arbitraje asciende a:</p>

                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <select id="TipCuant" name="TipCuant" class="form-control cbo">
                                <?php 
                                    foreach ($MTipoCuantia as $key => $value) {
                                        echo '<option value="'.$value["id"].'"';
                                            if($value["id"] == $Solicitud["TipCuant"])
                                              {
                                                echo 'selected="selected"';
                                              } 
                                            echo '?>';
                                            echo $value["destip"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-2">
                            <select id="MonCuant" name="MonCuant" class="form-control cbo">
                                <?php 
                                    foreach ($MMoneda as $key => $value) {
                                        echo '<option value="'.$value["id"].'"';
                                            if($value["id"] == $Solicitud["MonCuant"])
                                              {
                                                echo 'selected="selected"';
                                              } 
                                            echo '?>';
                                            echo $value["DesMon"].'</option>';
                                    }
                                 ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-2">
                            <input type="text" class="form-control" id="ImpNCuant" name = "ImpNCuant" placeholder="Ingrese importe (Números )" value="<?php echo $Solicitud['ImpNCuant']; ?>"></input>
                        </div>

                        <div class="form-group col-lg-4">
                            <input type="text" class="form-control" id="ImpLCuant" name = "ImpLCuant" placeholder="Ingrese importe (Letras )" value="<?php echo $Solicitud['ImpLCuant']; ?>"></input>
                        </div>

                        <div class="col-lg-12">
                            <button type="button" class="btn btn-success btnRegistrar p-2 pull-right siguiente">
                                <i class="fa fa-forward"></i> Siguiente 
                            </button>
                        </div>

                    </div>
                    <!-- -------------------------------------------------------- -->
                </div>
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabDesigArbitro">
                    <!-- -------------------------------------------------------- -->
                    <h3>Designación de Árbitro</h3>
                    <p>De corresponder, complete la información del árbitro único propuesto o del árbitro que conformara el Tribunal Arbitral.</p>

                    <div class="form-row">

                         <div class="col-sm-6">
                            <div class="form-group"><label>Nombre de Árbitro</label>
                                <input type="text" class="form-control" name = "ApeNomArb" placeholder="Ejemplo:Juan Carlos Montenegro Vega" value="<?php echo $Solicitud['ApeNomArb']; ?>"></input>
                            </div>
                         </div>

                         <div class="col-sm-6">
                            <div class="form-group"><label>Dirección</label>
                                <input type="text" class="form-control" name = "DesDirArb" placeholder="Ejemplo: Los Manzanos N° 125 - Residencial San Luis, distrito de San Borja,  provincia y región de Lima" value="<?php echo $Solicitud['DesDirArb']; ?>"></input>
                            </div>
                         </div>

                         <div class="col-sm-4">
                            <div class="form-group"><label>Celular</label>
                                <input type="text" class="form-control input_tel" name = "NumTelArb" value="<?php echo $Solicitud['NumTelArb']; ?>" placeholder="Ejemplo: 999999999"></input>
                            </div>
                         </div>

                         <div class="col-sm-4">
                            <div class="form-group"><label>Correo electrónico</label>
                                <input type="text" class="form-control" name = "DirEmaArb" value="<?php echo $Solicitud['DirEmaArb']; ?>" id="txtDirEmaArb" placeholder="Ejemplo: juan59@outlook.com"></input>
                            </div>
                         </div>

                         <div class="col-sm-4">
                            <div class="form-group"><label>Profesión</label>
                                <input type="text" class="form-control" name = "NomProArb" value="<?php echo $Solicitud['NomProArb']; ?>" placeholder = "Ingrese una profesión"></input>
                            </div>
                         </div>

                         <div class="col-sm-4">
                            <div class="form-group"><label>N° Colegiatura</label>
                                <input type="text" class="form-control" name = "NumColArb" value="<?php echo $Solicitud['NumColArb']; ?>" placeholder = "Ingrese número de colegiatura"></input>
                            </div>
                         </div>

                         <div class="col-sm-8">
                            <div class="form-group">
                                <label>¿Esta inscrito en Registro de Árbitros (OSCE)?</label>
                                <!-- ================================================================================================ -->
                                <div class="custom-control custom-checkbox chk">
                                    <input type="checkbox" class="custom-control-input"  id="FlgRegArb" name ="FlgRegArb" value="Yes"
                                    <?php if($Solicitud['FlgRegArb']=='1'){ echo 'checked';}?>>
                                    <label class="custom-control-label" for="FlgRegArb">Si</label>
                                </div>
                            </div>    
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>En caso no desee designar árbitro de parte, marque la siguiente opción : </label>
                                <!-- ================================================================================================ -->
                                <div class="custom-control custom-checkbox chk">
                                    <input type="checkbox" class="custom-control-input" id="FlgPrtArb" name ="FlgPrtArb" value="Yes"
                                    <?php if($Solicitud['FlgPrtArb']=='1'){ echo 'checked';}?>>
                                    <label class="custom-control-label" for="FlgPrtArb">El Centro de Arbitraje designe al árbitro de parte.</label>
                                </div>
                            </div>    
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>En caso de Árbitro Único y no exista intención de acuerdo sobre la designación de Árbitro Único, marque la siguiente opción :</label>
                                <!-- ================================================================================================ -->
                                <div class="custom-control custom-checkbox chk">
                                    <input  type="checkbox" class="custom-control-input" id="FlgUniArb" name ="FlgUniArb"  value="Yes"
                                    <?php if($Solicitud['FlgUniArb']=='1'){ echo 'checked';}?>>
                                    <label class="custom-control-label" for="FlgUniArb">El Centro de Arbitraje designe al árbitro Único.</label>
                                </div>
                            </div>    
                        </div>

                        <div class="col-lg-12">
                            <button type="button" class="btn btn-success btnRegistrar p-2 pull-right siguiente">
                                <i class="fa fa-forward"></i> Siguiente 
                            </button>
                        </div>

                    </div>

                    <!-- -------------------------------------------------------- -->
                </div>
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabAnexos">
                  <!-- -------------------------------------------------------- -->
                    <h3>Anexos</h3>
                    <p>Información de Anexos</p>

                    <div class="form-row">
                        <div class="form-group col-lg-4 col-12">
                            <select id="tipdocReq" name="tipdocReq" class="form-control cbo">
                                <?php 
                                    foreach ($MTipoAnexo as $key => $value) {
                                        echo '<option value="'.$value["id"].'">'.$value["desanx"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-12">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="NomArcReq">
                                <label class="custom-file-label" for="NomArcReq">Seleccionar archivo</label>
                            </div>
                        </div>
                       
                        <div class="form-group col-lg-2 col-12">
                            <button type="button" class="btn btn-outline-success btn-block btnAgregar" id="btnAgregarAnx">
                            <i class="fa fa-search"></i>
                            Agregar
                            </button> 
                        </div>
                    </div>

                    <p>Lista de Anexos</p>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tbArchivos">
                            <thead>
                                <tr class="text-center">
                                    <th width="10%">Fila</th>
                                    <th width="10%" class="ColOculto">IdAnexo</th>
                                    <th width="10%" class="ColOculto">IdTipo</th>
                                    <th width="20%">Tipo</th>
                                    <th width="30%">Archivo</th>
                                    <th width="10%" class="fin">Acciones</th>
                                    <th width="10%" class="ColOculto">EsNuevo</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $vflag = "'N'";
                                $cnt = 0;
                                foreach ($MSolicitudAnexo as $key => $value) {
                                    $cnt++;
                                    echo '<tr id="fila'.$cnt.'">';
                                        echo '<td class="text-center">'. $cnt.'</td>';
                                        echo '<td class="text-center ColOculto">'. $value["idAnexo"].'</td>';
                                        echo '<td class="text-center ColOculto">'. $value["idTipo"].'</td>';
                                        echo '<td class="text-center">'. $value["desanx"].'</td>';
                                        echo '<td class="text-center">'. $value["nomFileLoc"].'</td>';
                                        echo '<td class="text-center fin">

                                                <a href="#" class="btn btn-outline-info btnAccion" 
                                                onclick="eliminarAnexo('.$cnt.','.$id.','.$value["idAnexo"].','.$vflag.');
                                                ">
                                               <i class="fa fa-trash" aria-hidden="true" title="Eliminar Anexo" ></i> Eliminar</a>
                                              </td>
                                              <td class="text-center ColOculto">N</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                        </table>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <hr>
                        </div>        
                    </div>

                    <div class="form-row">
                        
                        <div class="form-group col-xl-8 col-md-4 col-12"></div>

                        <div class="form-group col-xl-2 col-md-4 col-12">                      
                            <a href="https://www.visanetlink.pe/pagoseguro/CEARLATINOAMERICANO/446874" class="btn btn-block btn-success p-2" target="_blank">
                                <i class="fa fa-shopping-cart"></i> Pagar
                            </a>
                        </div>
                        
                        <div class="form-group col-xl-2 col-md-4 col-12">
                            <button type="submit" class="btn btn-block btn-warning btnRegistrar p-2">
                                <i class="fa fa-save"></i> Actualizar Solicitud
                            </button>    
                        </div>      

                    </div>  
                  <!-- -------------------------------------------------------- -->
                </div>
                
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabEnviarSolicitud">
                    <h3>Cargar archivo de solicitud</h3>
                    <p>Firme el documento descargado automaticámente</p>
                    <p>Una vez firmado el documento, proceda a cargarlo para luego generar el envio y concluir con la solicitud.</p>

                    <div class="form-row">
                        
                        <div class="form-group col-lg-6 col-12">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="NomFilSol" accept=".doc,.docx,.pdf">
                                <label class="custom-file-label" for="NomFilSol">Seleccionar archivo</label>
                            </div>
                        </div>
                       
                        <div class="form-group col-lg-2 col-12">
                            <button type="button" class="btn btn-outline-danger btnAgregar" id="btnCargarArchivo" onclick="fnd_carga_archivo();">
                            <i class="fa fa-save pull-left"></i>
                            Cargar archivo
                            </button> 
                        </div>

                    </div>

                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#pnlRegistro li:nth-child(11) a').tab('show') // Select third tab
</script>
<!-- ============================================================================ -->
<?php 
            }else{
                echo $MsgErr ;
            }
        }
    } else {
        echo  $MsgErr;
    }
  
?>

<!-- ================================================
     MODAL : VALIDACIONES
     ================================================ -->
<div class="modal fade" id="ModalValidaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
           <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Observaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="btnCerrar" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Se identificarón las siguientes observaciones al procesar su solicitud : </p>
                <p id="pMensaje"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss = "modal"> Cerrar </button> 
            </div>
        </div>
    </div>
</div>
<!-- ================================================
     MODAL : CONFIRMACION DE CARGA
     ================================================ -->
<div class="modal fade" id="MdlCargaExitosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Subir Solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="RespuestaCarga">
            <!--
                AQUI RESPUESTA DE METODO AJAX
            -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
      </div>
</div>


<?php include_once 'componentes/footer.php'; ?>
