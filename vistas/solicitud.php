<?php
/*  --------------------------- Componentes HTML --------------------------- */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';

/* ===================================
   GRABAMOS AQUI REGISTRO DE SOLICITUD
   ===================================*/
    $flgModal = 'N';
    $ValMsnRegistro = '0';
    $dataPretenciones = array();
    $dataAnexos = array();

  if(!empty($_POST)){

    $idUsuario      = $user->getId();
    $RazSocDem      = $_POST['RazSocDem'];
    $TipDocDem      = $_POST['TipDocDem'];
    $NumDocDem      = $_POST['NumDocDem'];
    $EscPubDem      = $_POST['EscPubDem'];
    $DesDirDem      = $_POST['DesDirDem'];
    $ApeNomLeg      = $_POST['ApeNomLeg'];
    $TipDocRep      = $_POST['TipDocRep'];
    $NumDocRep      = $_POST['NumDocRep'];
    $NumTelRep      = $_POST['NumTelRep'];
    $NumCelRep      = $_POST['NumCelRep'];
    $DirEmaRep      = $_POST['DirEmaRep'];
    $TipDocEmiCom   = $_POST['TipDocEmiCom'];
    $NumDocEmiCom   = $_POST['NumDocEmiCom'];
    $RazSocEmiCom   = $_POST['RazSocEmiCom'];
    $RazSocDmd      = $_POST['RazSocDmd'];
    $DesDirDmd      = $_POST['DesDirDmd'];
    $TipDocDmd      = $_POST['TipDocDmd'];
    $NumDocDmd      = $_POST['NumDocDmd'];
    $NumTelDmd      = $_POST['NumTelDmd'];
    $NumCelDmd      = $_POST['NumCelDmd'];
    $DirEmaDmd      = $_POST['DirEmaDmd'];
    $AutRepDmd      = $_POST['AutRepDmd'];
    $ProPubDmd      = $_POST['ProPubDmd'];
    $DesConArb      = $_POST['DesConArb'];
    $flgCtrDer      = (isset($_POST['flgCtrDer']) && $_POST['flgCtrDer'] == 'Yes') ? "1" : "0";
    $flgCtrCon      = (isset($_POST['flgCtrCon']) && $_POST['flgCtrCon'] == 'Yes') ? "1" : "0";
    $flgCtrNac      = (isset($_POST['flgCtrNac']) && $_POST['flgCtrNac'] == 'Yes') ? "1" : "0";
    $flgCtrInt      = (isset($_POST['flgCtrInt']) && $_POST['flgCtrInt'] == 'Yes') ? "1" : "0";
    $flgEspCtr      = (isset($_POST['flgEspCtr']) && $_POST['flgEspCtr'] == 'Yes') ? "1" : "0";
    $flgEspCiv      = (isset($_POST['flgEspCiv']) && $_POST['flgEspCiv'] == 'Yes') ? "1" : "0";
    $flgEspLey      = (isset($_POST['flgEspLey']) && $_POST['flgEspLey'] == 'Yes') ? "1" : "0";
    $flgEspMin      = (isset($_POST['flgEspMin']) && $_POST['flgEspMin'] == 'Yes') ? "1" : "0";
    $flgEspCon      = (isset($_POST['flgEspCon']) && $_POST['flgEspCon'] == 'Yes') ? "1" : "0";
    $flgEspOtr      = (isset($_POST['flgEspOtr']) && $_POST['flgEspOtr'] == 'Yes') ? "1" : "0";
    $DesNarHec      = $_POST['DesNarHec'];
    $DesMedCau      = $_POST['DesMedCau'];
    $TipCuant       = $_POST['TipCuant'];
    $MonCuant       = $_POST['MonCuant'];
    $ImpNCuant      = $_POST['ImpNCuant'];
    $ImpLCuant      = $_POST['ImpLCuant'];
    $ApeNomArb      = (isset($_POST['ApeNomArb'])) ? $_POST['ApeNomArb'] : "" ;
    $DesDirArb      = (isset($_POST['DesDirArb'])) ? $_POST['DesDirArb'] : "" ;
    $NumTelArb      = (isset($_POST['NumTelArb'])) ? $_POST['NumTelArb'] : "" ;
    $DirEmaArb      = (isset($_POST['DirEmaArb'])) ? $_POST['DirEmaArb'] : "" ;
    $NomProArb      = (isset($_POST['NomProArb'])) ? $_POST['NomProArb'] : "" ;
    $NumColArb      = (isset($_POST['NumColArb'])) ? $_POST['NumColArb'] : "" ;
    $FlgRegArb      = (isset($_POST['FlgRegArb']) && $_POST['FlgRegArb'] == 'Yes') ? "1" : "0";
    $FlgPrtArb      = (isset($_POST['FlgPrtArb']) && $_POST['FlgPrtArb'] == 'Yes') ? "1" : "0";
    $FlgUniArb      = (isset($_POST['FlgUniArb']) && $_POST['FlgUniArb'] == 'Yes') ? "1" : "0";
    $idSit          = '1';
    $idEst          = '1';
    
    $Solicitud      = new Solicitud();

/*  ============================
    PROCESO DE REGISTRO
    ============================ */
    $ValMsnRegistro = $Solicitud->NuevaSolicitud($idUsuario,$RazSocDem,$TipDocDem,$NumDocDem,$EscPubDem,$DesDirDem,$ApeNomLeg,$TipDocRep,$NumDocRep,
                    $NumTelRep,$NumCelRep,$DirEmaRep,$TipDocEmiCom,$NumDocEmiCom,$RazSocEmiCom,$RazSocDmd,$DesDirDmd,$TipDocDmd,$NumDocDmd,$NumTelDmd,
                    $NumCelDmd,$DirEmaDmd,$AutRepDmd,$ProPubDmd,$DesConArb,$flgCtrDer,$flgCtrCon,$flgCtrNac,$flgCtrInt,$flgEspCtr,$flgEspCiv,$flgEspLey,
                    $flgEspMin,$flgEspCon,$flgEspOtr,$DesNarHec,$DesMedCau,$TipCuant,$MonCuant,$ImpNCuant,$ImpLCuant,$ApeNomArb,$DesDirArb,$NumTelArb,
                    $DirEmaArb,$NomProArb,$NumColArb,$FlgRegArb,$FlgPrtArb,$FlgUniArb,$idSit,$idEst);

    if($ValMsnRegistro != '0'){
        // usar este script luego de grabar los datos de la solicitud
        $flgModal  = 'S';

        // Registrar detalle de Anexos ---------------------------------------
            if(isset($_POST["anexos"])){
                foreach($_POST["anexos"] as $p){
                    $anexos = json_decode($p);
                    array_push($dataAnexos, $anexos);                   
                }
            }
      

            if(isset($dataAnexos)){ // ----------------------------------------------------------------------------
                $cntfile  = 0;

                if(isset($_POST["fileAnexo"])){
                    $files = $_POST["fileAnexo"];
                    $itemFiles = 0;
                }

                foreach ($dataAnexos as $value) {

                    $cntfile ++;
                    
                    $idTipo         = $value->idtipo;
                    $idSolicitud    = $ValMsnRegistro;
                    $nomFileLoc     = $value->Archivo;

                    $nomFilePrt     = explode(".", $nomFileLoc);
                    $nomfileSav     = end($nomFilePrt);
                    $nomFileSer     = "ANX_".date("Ymd")."_".date("His")."_".$cntfile.".".$nomfileSav;
                    $flgEliminado   = 'N';

                     $SolicitudAnexo->AgregarAnexo($idSolicitud,$idTipo,$nomFileLoc,$nomFileSer,$flgEliminado);

                    // Escritura de archivo en servidor
                    if(isset($_POST["fileAnexo"])){
                        $filSvr = $_SERVER['DOCUMENT_ROOT'].'/tramite/vistas/upload/'.$nomFileSer;
                        file_put_contents($filSvr, base64_decode($files[$itemFiles]));
                        $itemFiles++;
                    }
                }
            }

        // Registrar detalle de Pretensiones ---------------------------------
            if(isset($_POST["pretenciones"])){
                foreach($_POST["pretenciones"] as $p){
                    $prentecion = json_decode($p);
                    array_push($dataPretenciones, $prentecion);
                }    
            }

            if(isset($dataPretenciones)){
                // Agregar aqui todas las pretenciones
                $idPretension  = 0;
                foreach ($dataPretenciones as $value) {
                    $idSolicitud   = $ValMsnRegistro;
                    $idPretension  ++;
                    $desPretension = $value->pretencion;
                    $SolicitudPretension->NuevaSolicitudPretension($idSolicitud,$idPretension,$desPretension);
                }
            }
    }else{
       // No se pudo grabar Solicitud
          $flgModal = 'M';
    }
}
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb migas m-4">
        <li class="breadcrumb-item"><a href="consulta.php"><i class="fa fa-edit"></i> Mis Solicitudes</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Solicitud de Arbitraje Electrónica</li>
    </ol>
</nav>

<div class="card m-4">
    <div class="card-body">
        <h2 class="titulo"> <i class="fa fa-book"></i> Solicitud de Arbitraje </h2>
        <p class="subtitulo">Genere aqui su Solicitud para proceso de Arbitraje <strong>Electrónica</strong></p>

        <!-- ENCABEZADOS DE LISTA -->
        <ul class="nav nav-tabs pnlRegistro">
            <li class="nav-item"> <a class="nav-link active show" data-toggle="pill" data-target="#tabDemandante"><i class="fa fa-arrow-right"></i>&nbsp;Demandante</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabDemandado"><i class="fa fa-arrow-right"></i>&nbsp;Demandado</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabConvArbitral"><i class="fa fa-arrow-right"></i> Convenio</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabTipoArbitraje"><i class="fa fa-arrow-right"></i> Tipo de Arbitraje</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabNarracionHechos"><i class="fa fa-arrow-right"></i> Hechos</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabPretensiones"><i class="fa fa-arrow-right"></i> Pretensiones</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabInfoProcExtra"><i class="fa fa-arrow-right"></i> Medida cautelar</a></li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabCuantia"><i class="fa fa-arrow-right"></i> Cuantía</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabDesigArbitro"><i class="fa fa-arrow-right"></i> Designación de Árbitro</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" id="TabAnexoMostar" data-target="#tabAnexos"><i class="fa fa-arrow-right"></i> Anexos</a> </li>
        </ul>
        <form method="POST" id="arbitraje" action="solicitud.php" enctype="multipart/form-data" class="frmSolicitud">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade p-3 active show" id="tabDemandante">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Demandante                
                                    <p class="m-0">Información de Demandante</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Nombre o Razón Social</label>
                                                <input class="form-control" id="txtRazSocDem" name="RazSocDem" placeholder="Ejemplo: Juan Carlos Montenegro Vega">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Tipo de Doc. de Identidad</label>
                                                <select id="TipDocDem" name="TipDocDem" class="form-control cbo">
                                                <?php 
                                                    foreach ($MTipDoc as $key => $value) {
                                                        echo '<option value="'.$value["id"].'">'.$value["tipdoc"].'</option>';
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Número de Documento</label>
                                                <input class="form-control input_num" id="txtNumDocDem" name="NumDocDem" maxlength="11" placeholder="Ingrese número de documento">
                                                <div id="msgval1" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Escritura Pública/Acta legalizada/Copia literal/ Copia de la vigencia de poder expedida de los registros públicos</label>
                                                <input class="form-control" name="EscPubDem" placeholder="Escriba el documento que adjuntara en el ítem de anexos, por ejemplo: la vigencia de poder.">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Domicilio de la persona natural o jurídica</label>
                                                <input class="form-control" name="DesDirDem" placeholder="Ejemplo: Los Manzanos N° 125 - Residencial San Luis, distrito de San Borja,  provincia y región de Lima">
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
                                    <p class="m-0">Información del Representante Legal</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Apellidos y Nombres</label>
                                                <input class="form-control" id="txtApeNomLeg" name="ApeNomLeg" placeholder="Ejemplo: Juan Carlos Montenegro Vega">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Tipo de Doc. de Identidad</label>
                                                <select id="TipDocRep" name="TipDocRep" class="form-control cbo">
                                                    <?php 
                                                    foreach ($MTipDoc as $key => $value) {
                                                        if($value["id"]!= "3"){
                                                            echo '<option value="'.$value["id"].'">'.$value["tipdoc"].'</option>';
                                                        }
                                                    }
                                                   ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Número de Documento</label>
                                                <input class="form-control input_num" id="txtNumDocRep" name="NumDocRep" maxlength="11" placeholder="Ingrese número de documento">
                                                <div id="msgval2" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Cod. ciudad + Teléfono Fijo.</label>
                                                <input class="form-control input_tel" id="txtNumTelRep" name="NumTelRep" placeholder="Ejemplo: (51) 5701863">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Celular</label>
                                                <input class="form-control input_tel" id="txtNumCelRep" name="NumCelRep" placeholder="Ejemplo: 999999999">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Correo Electrónico</label>
                                                <input class="form-control" id="txtDirEmaRep" name="DirEmaRep" placeholder="Ejemplo: juan59@outlook.com">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card mt-2">
                                <div class="card-header font-weight-bold">
                                    Emisión de Comprobante
                                    <p class="m-0">La factura o boleta se deberá de emitir a nombre de:</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Tipo de Comprobante</label>
                                            <select name="TipDocEmiCom" class="form-control cbo">
                                                  <?php 
                                                    foreach ($MTipoComprobante as $key => $value) {
                                                        echo '<option value="'.$value["id"].'">'.$value["destip"].'</option>';
                                                    }
                                                   ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Número de Documento</label>
                                                <input class="form-control input_num" name="NumDocEmiCom" placeholder="DNI (para Boleta) ó RUC (para Factura)" maxlength="11">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Razón Social</label>
                                                <input class="form-control" type="text" name="RazSocEmiCom" placeholder="Ejemplo:Juan Carlos Montenegro Vega">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-12 text-right">
                                            <button type="button" class="btn btn-success btnRegistrar siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- fin tabpanel : tabDemandante -->
                <div role="tabpanel" class="tab-pane fade p-3"  id="tabDemandado">
                     <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Demandado
                                    <p class="m-0">Información de Demandado</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Nombre o Razón Social</label>
                                            <input class="form-control" id="txtRazSocDmd" name="RazSocDmd" placeholder="Ejemplo:Juan Carlos Montenegro Vega">
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Domicilio</label>
                                                <input class="form-control" id="txtDesDirDmd" name="DesDirDmd" placeholder="Ejemplo: Los Manzanos N° 125 - Residencial San Luis, distrito de San Borja,  provincia y región de Lima">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Tipo de Documento</label>
                                                <select id="TipDocDmd" name="TipDocDmd" class="form-control cbo">
                                                    <?php 
                                                    foreach ($MTipDoc as $key => $value) {
                                                        echo '<option value="'.$value["id"].'">'.$value["tipdoc"].'</option>';
                                                    }
                                                   ?>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="col-sm-3">
                                            <div class="form-group"> <label>Número de Documento</label>
                                                <input class="form-control input_num" id="txtNumDocDmd" name="NumDocDmd" maxlength="11" placeholder="Ingrese número de documento">
                                                <div id="msgval3" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>cod. ciudad + Teléfono Fijo.</label>
                                                <input class="form-control input_tel" name="NumTelDmd" placeholder="Ejemplo: (51) 5701863">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Celular</label>
                                                <input class="form-control input_tel" name="NumCelDmd" placeholder="Ejemplo: 999999999">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Correo Electrónico</label>
                                                <input class="form-control" name="DirEmaDmd" id="txtDirEmaDmd" placeholder="Ejemplo:juan59@outlook.com">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Autoridad o representante</label>
                                                <input class="form-control" name="AutRepDmd" id="txtAutRepDmd" placeholder="Ingrese la autoridad o representante">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Procurador público/abogado</label>
                                                <input class="form-control" name="ProPubDmd" id="txtProPubDmd" placeholder="Ingrese el procurador público/abogado">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success p-2 anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                        </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success p-2 siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabDemandado -->

                <div role="tabpanel" class="tab-pane fade p-4"  id="tabConvArbitral">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Convenio Arbitral
                                    <p class="m-0">Indicar su interés que la controversia existente se organice y administre
                                    a través del Centro de Arbitraje Latinoamericano e Investigaciones Jurídicas, 
                                    o indicar la cláusula arbitral.</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                         <div class="col-sm-12">
                                             <div class="form-group">
                                                 <textarea class="form-control" name = "DesConArb" rows="3" placeholder="“Todas las disputas o controversias, derivadas o relacionadas de este acto jurídico, serán resueltos mediante arbitraje, bajo la organización y administración del Centro de Arbitraje Latinoamericano e Investigaciones Jurídicas; conforme a su estatuto y reglamentos a los cuales las partes se someten incondicionalmente, señalando que el laudo que se emita en el proceso arbitral será inapelable y definitivo”."></textarea>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success p-2 anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success p-2 siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabConvArbitral -->

                <div role="tabpanel" class="tab-pane fade p-4"  id="tabTipoArbitraje">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Tipo de Arbitraje
                                    <p class="m-0">Seleccione las casillas que considere aplicable a:</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Su controversia</label>
                                                <!-- ============================================= -->
                                                <div class="custom-control custom-checkbox chk">
                                                    <input type="checkbox" class="custom-control-input" id="flgCtrDer" name="flgCtrDer" value="Yes">
                                                    <label class="custom-control-label" for="flgCtrDer">De Derecho</label>
                                                </div>
                                                <!-- ============================================= -->
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="flgCtrCon" name="flgCtrCon" value="Yes">
                                                    <label class="custom-control-label" for="flgCtrCon">De Conciencia</label>
                                                </div>
                                                <!-- ============================================= -->
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="flgCtrNac" name="flgCtrNac" value="Yes">
                                                    <label class="custom-control-label" for="flgCtrNac">Nacional</label>
                                                </div>
                                                <!-- ============================================= -->
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="flgCtrInt" name="flgCtrInt" value="Yes">
                                                    <label class="custom-control-label" for="flgCtrInt">Internacional</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Especialidad</label>
                                                <!-- ============================================= -->
                                                <div class="custom-control custom-checkbox chk">
                                                    <input type="checkbox" class="custom-control-input" id="flgEspCtr" name="flgEspCtr" value="Yes">
                                                    <label class="custom-control-label" for="flgEspCtr">Contratación Pública</label>
                                                </div>
                                                <!-- ============================================= -->
                                                <div class="custom-control custom-checkbox chk">
                                                    <input type="checkbox" class="custom-control-input" id="flgEspCiv" name="flgEspCiv" value="Yes">
                                                    <label class="custom-control-label" for="flgEspCiv">Civil</label>
                                                </div>
                                                <!-- ============================================= -->
                                                <div class="custom-control custom-checkbox chk">
                                                    <input type="checkbox" class="custom-control-input" id="flgEspLey" name="flgEspLey" value="Yes">
                                                    <label class="custom-control-label" for="flgEspLey">Ley General de Sociedad</label>
                                                </div>
                                                <!-- ============================================= -->
                                                <div class="custom-control custom-checkbox chk">
                                                    <input type="checkbox" class="custom-control-input" id="flgEspMin" name="flgEspMin" value="Yes">
                                                    <label class="custom-control-label" for="flgEspMin">Minero</label>
                                                </div>
                                                <!-- ============================================= -->
                                                <div class="custom-control custom-checkbox chk">
                                                    <input type="checkbox" class="custom-control-input" id="flgEspCon" name="flgEspCon" value="Yes">
                                                    <label class="custom-control-label" for="flgEspCon">Concesiones</label>
                                                </div>
                                                <!-- ============================================= -->
                                                <div class="custom-control custom-checkbox chk">
                                                    <input type="checkbox" class="custom-control-input" id="flgEspOtr" name="flgEspOtr" value="Yes">
                                                    <label class="custom-control-label" for="flgEspOtr">Otros</label>
                                                </div>
                                            </div>
                                        </div>                 
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                        </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabTipoArbitraje -->
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabNarracionHechos">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Narración de los Hechos
                                    <p class="m-0">Narración breve de los hechos que desee someter a arbitraje. <br>
                                                  (El solicitante debe hacer un resumen claro de los hechos que han generado la controversia)</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="txtDesNarHec" name = "DesNarHec" rows="6" placeholder="Ingrese un resumen claro de los hechos que han generado la controversia."></textarea>
                                            </div>
                                        </div>         
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                        </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabNarracionHechos -->
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabPretensiones">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Pretensiones
                                    <p class="m-0">El petitorio debe ser redactado con claridad y precisión</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-lg-10 col-12">
                                            <input type="hidden" class="form-control" id="idPretensionEdit" name="idPretensionEdit">
                                            <input type="text" class="form-control" id="DesPretension" name="DesPretension" placeholder="Describa una pretensión">
                                        </div>
                                        <div class="form-group col-lg-2 col-12">
                                            <button type="button" class="btn btn-outline-success btn-block btnAgregar" id="btnAgregar">
                                            <i class="fa fa-plus"></i> Agregar </button> 
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <table class="table TablaSistema" id="tbPretensiones">
                                               <thead>
                                                    <tr class="text-center">
                                                        <th width="10%">Fila</th>
                                                        <th width="10%">Pretensión</th>
                                                        <th width="10%" class="text-center">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                         </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabPretensiones -->
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabInfoProcExtra">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Medida cautelar
                                    <p class="m-0">Información sobre procesos extra arbitrales interpuestos ante el Árbitro de Emergencia 
                                                   o ante el órgano jurisdiccional - Poder Judicial - sobre la materia en arbitraje: (cautelares).</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name = "DesMedCau" rows="6" maxlength = 950 placeholder="Ingrese un resumen claro de los hechos que han generado controversia."></textarea>
                                             </div>
                                             <p class="text-muted">Máximo 950 caracteres</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                         </div> 
                                         <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabInfoProcExtra -->
                <div role="tabpanel" class="tab-pane fade p-4" id="tabCuantia">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Cuantía
                                    <p class="m-0">Se estima que el importe controvertido en el presente arbitraje asciende a:</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-lg-4">
                                            <select id="TipCuant" name="TipCuant" class="form-control cbo">
                                                <option value="0">Seleccione un Tipo de Cuantía</option>
                                                <?php 
                                                    foreach ($MTipoCuantia as $key => $value) {
                                                       echo '<option value="'.$value["id"].'">'.$value["destip"].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <select id="MonCuant" name="MonCuant" class="form-control cbo">
                                                <?php 
                                                    foreach ($MMoneda as $key => $value) {
                                                        echo '<option value="'.$value["id"].'">'.$value["DesMon"].'</option>';
                                                    }
                                                 ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <input type="text" class="form-control input_num" id="ImpNCuant" name = "ImpNCuant" placeholder="Ingrese importe (Números )"></input>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <input type="text" class="form-control" id="ImpLCuant" name = "ImpLCuant" placeholder="Ingrese importe (Letras )"></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                         </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabCuantia -->
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabDesigArbitro">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Designación de Árbitro
                                    <p class="m-0">De corresponder, complete la información del árbitro único propuesto o del árbitro que conformara el Tribunal Arbitral.</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="form-group"><label>Nombre de Árbitro</label>
                                                <input type="text" class="form-control" id="txtApeNomArb" name = "ApeNomArb" placeholder="Ejemplo:Juan Carlos Montenegro Vega"></input>
                                            </div>
                                         </div>
                                         <div class="col-sm-6">
                                            <div class="form-group"><label>Dirección</label>
                                                <input type="text" class="form-control" id="txtDesDirArb" name = "DesDirArb" placeholder="Ejemplo: Los Manzanos N° 125 - Residencial San Luis, distrito de San Borja,  provincia y región de Lima"></input>
                                            </div>
                                         </div>

                                         <div class="col-sm-2">
                                            <div class="form-group"><label>Celular</label>
                                                <input type="text" class="form-control input_tel" id="txtNumTelArb" name = "NumTelArb" placeholder="Ejemplo: 999999999"></input>
                                            </div>
                                         </div>

                                         <div class="col-sm-4">
                                            <div class="form-group"><label>Correo electrónico</label>
                                                <input class="form-control" name = "DirEmaArb" id="txtDirEmaArb" placeholder="Ejemplo: juan59@outlook.com"></input>
                                            </div>
                                         </div>

                                         <div class="col-sm-3">
                                            <div class="form-group"><label>Profesión</label>
                                                <input type="text" class="form-control" id="txtNomProArb" name = "NomProArb" placeholder="Ingrese una profesión"></input>
                                            </div>
                                         </div>

                                         <div class="col-sm-3">
                                            <div class="form-group"><label>N° Colegiatura</label>
                                                <input type="text" class="form-control" id="txtNumColArb" name = "NumColArb" placeholder="Ingrese el número de colegiatura"></input>
                                            </div>
                                         </div>

                                         <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>¿Esta inscrito en Registro de Árbitros (OSCE)?</label>
                                                   <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="FlgRegArb" name ="FlgRegArb" value="Yes">
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
                                                    <input class="form-check-input" type="checkbox" id="FlgPrtArb" name ="FlgPrtArb" value="Yes">
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
                                                    <input class="form-check-input" type="checkbox" id="FlgUniArb" name ="FlgUniArb" value="Yes">
                                                    <label class="form-check-label" for="FlgUniArb">
                                                        El Centro de Arbitraje designe al árbitro Único.
                                                    </label>
                                                </div>                            
                                            </div>    
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                         </div> 

                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabDesigArbitro -->
                <div role="tabpanel" class="tab-pane fade p-4"  id="tabAnexos">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Anexos
                                    <p class="m-0">Información de Anexos</p>
                                </div>
                                <div class="card-body">
                                <div class="card">
                                    <div class="card-header font-weight-bold">
                                        DOCUMENTOS OBLIGATORIOS
                                    </div>
                                    <div class="card-body">
                                                <div class="form-row" id="filaDocumento1">
                                                    <div class="form-group col-lg-4 col-12">
                                                        <select id="tipdocReq1" name="tipdocReq1" class="form-control cbo">
                                                            <option value="2">COPIA DE DNI</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-12">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="NomArcReq1" lang="es">
                                                            <label class="custom-file-label" id="labelNombreReq1" for="NomArcReq1">Seleccionar archivo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row" id="filaDocumento2">
                                                    <div class="form-group col-lg-4 col-12">
                                                            <select id="tipdocReq2" name="tipdocReq2" class="form-control cbo">
                                                                <option value="11">VIGENCIA DE PODER</option>
                                                            </select>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-12">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="NomArcReq2" lang="es">
                                                            <label class="custom-file-label" id="labelNombreReq2" for="NomArcReq2">Seleccionar archivo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row" id="filaDocumento3">
                                                    <div class="form-group col-lg-4 col-12">
                                                            <select id="tipdocReq3" name="tipdocReq3" class="form-control cbo">
                                                                <option value="15">COPIA DEL CONTRATO, ORDEN DE COMPRA / SERVICIO (NATURAL / JURIDICA)</option>
                                                            </select>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-12">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="NomArcReq3" lang="es">
                                                            <label class="custom-file-label" id="labelNombreReq3" for="NomArcReq3">Seleccionar archivo</label>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-row" id="filaDocumento4">
                                                    <div class="form-group col-lg-4 col-12">
                                                            <select id="tipdocReq4" name="tipdocReq4" class="form-control cbo">
                                                                <option value="5">COPIA DE CONTRATO DE CONSORICIO (JURIDICAS)</option>
                                                            </select>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-12">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="NomArcReq4" lang="es">
                                                            <label class="custom-file-label" id="labelNombreReq4" for="NomArcReq4">Seleccionar archivo</label>
                                                        </div>
                                                    </div>
                                                    
                                                </div> 
                                                <div class="form-group col-lg-2 col-12" >
                                                        <button type="button" style="margin-left: 300px;"class="btn btn-outline-success btn-block btnAgregar" id="btnAgregarAnx" formenctype="multipart/form-data">
                                                            <i class="fa fa-plus"></i> Agregar 
                                                        </button>
                                                </div>
                                       
                                        </div> 
                                    </div> 

                                    <div class="card">
                                        <div class="card-header font-weight-bold">
                                            OTROS DOCUMENTOS
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-lg-4 col-12">
                                                    <select id="tipdocReq" name="tipdocReq" class="form-control cbo">
                                                        <option value="0">Seleccione tipo de documento</option>
                                                        <?php 
                                                            foreach ($MTipoAnexo as $key => $value) {
                                                                echo '<option value="'.$value["id"].'">'.$value["desanx"].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-6 col-12">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="NomArcReq" lang="es">
                                                        <label class="custom-file-label" id="labelNombreReq" for="NomArcReq">Seleccionar archivo</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-2 col-12">
                                                    <button type="button" class="btn btn-outline-success btn-block btnAgregar" id="btnAgregarAnxOtros" formenctype="multipart/form-data">
                                                        <i class="fa fa-plus"></i> Agregar 
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg-12 col-12">
                                            <table class="table TablaSistema" id="tbArchivos">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="10%" style="cursor: pointer;"><i class="fa fa-arrows-v" aria-hidden="true"></i> Fila</th>
                                                        <th width="10%" class="ColOculto">IdAnexo</th>
                                                        <th width="10%" class="ColOculto">IdTipo</th>
                                                        <th width="20%" style="cursor: pointer;"><i class="fa fa-arrows-v" aria-hidden="true"></i> Tipo</th>
                                                        <th width="30%" style="cursor: pointer;"><i class="fa fa-arrows-v" aria-hidden="true"></i> Archivo</th>
                                                        <th width="10%" class="fin">Acciones</th>
                                                        <th width="10%" class="ColOculto">NuevoAnexo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-md-6 col-sm-12 mb-1 text-left">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                         </div> 

                                        <div class="col-md-3 col-sm-12 mb-1">
                                            <a href="https://www.visanetlink.pe/pagoseguro/CEARLATINOAMERICANO/446874" class="btn btn-success" target="_blank">
                                                <i class="fa fa-shopping-cart"></i> Pagar
                                            </a>
                                        </div>

                                        <div class="col-md-3 col-sm-12 text-right">
                                            <button type="submit" class="btn btn-success btnRegistrar">
                                                <i class="fa fa-save"></i> Generar Solicitud de Arbitraje 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabAnexos -->
            </div> <!-- fin tab-content -->
        </form>
    </div> <!-- fin card-body -->
</div> <!-- fin card -->				    
<!-- =========================================
    MODAL
    ========================================= -->
<div class="modal fade" id="modal_exito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title text-center" id="exampleModalLabel">Solicitud de Arbitraje</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="btnCerrar" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check"></i> Solicitud enviada correctamente.
                </div>
                <div class="alert alert-primary" role="alert">
                    <i class="fa fa-exclamation-circle"></i> Revise el documento que se acaba de descargar y fírmelo si es que todo esta correcto
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss = "modal"> Continuar </button> 
            </div>
        </div>
    </div>
</div>

<!-- =======================================================
    MODAL : VALIDACIONES
    ======================================================== -->
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
                <p id="pMensaje"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss = "modal"> Cerrar </button> 
            </div>
        </div>
    </div>
</div>
<!-- ======================================================= -->


<?php 
    if($flgModal == 'S'){
        // Redireccionamos a la pantalla de Solicitud.
        echo "<script>
                $('#modal_exito').modal('show');

                    location.href='CrearPdf.php?id=".$ValMsnRegistro."';
                
                $('#modal_exito').on('hidden.bs.modal', function () {

                       location.href='edicionSolicitud.php?id=".$ValMsnRegistro."';

                });

            </script>";        
    }
    include_once 'componentes/footer.php';
?>

