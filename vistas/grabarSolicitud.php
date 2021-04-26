<?php 
    /* --------------------------- Componentes HTML --------------------------- */
    include_once 'componentes/header.php';
    include_once 'componentes/navbar.php';
    
    include_once '../includes/tipdoc.php';
    include_once '../includes/tipoanexo.php';
    include_once '../includes/tipocomprobante.php';
    include_once '../includes/tipocuantia.php';
    include_once '../includes/moneda.php';
    include_once '../includes/solicitud.php';
    include_once '../includes/solicitudpretension.php';
    include_once '../includes/solicitudanexo.php';

/*  =================================================
    ACTUALIZAMOS CAMBIOS (GRABAR)
    =================================================*/
    if(!empty($_POST))
    {
        $idUsuario           = $user->getId();
        $id                  = $_POST['id'];
        $RazSocDem           = $_POST['RazSocDem'];
        $TipDocDem           = $_POST['TipDocDem'];
        $NumDocDem           = $_POST['NumDocDem'];
        $EscPubDem           = $_POST['EscPubDem'];
        $DesDirDem           = $_POST['DesDirDem'];
        $ApeNomLeg           = $_POST['ApeNomLeg'];
        $TipDocRep           = $_POST['TipDocRep'];
        $NumDocRep           = $_POST['NumDocRep'];
        $NumTelRep           = $_POST['NumTelRep'];
        $NumCelRep           = $_POST['NumCelRep'];
        $DirEmaRep           = $_POST['DirEmaRep'];
        $TipDocEmiCom        = $_POST['TipDocEmiCom'];
        $NumDocEmiCom        = $_POST['NumDocEmiCom'];
        $RazSocEmiCom        = $_POST['RazSocEmiCom'];
        $RazSocDmd           = $_POST['RazSocDmd'];
        $DesDirDmd           = $_POST['DesDirDmd'];
        $TipDocDmd           = $_POST['TipDocDmd'];
        $NumDocDmd           = $_POST['NumDocDmd'];
        $NumTelDmd           = $_POST['NumTelDmd'];
        $NumCelDmd           = $_POST['NumCelDmd'];
        $DirEmaDmd           = $_POST['DirEmaDmd'];
        $AutRepDmd           = $_POST['AutRepDmd'];
        $ProPubDmd           = $_POST['ProPubDmd'];
        $DesConArb           = $_POST['DesConArb'];
        $flgCtrDer           = (isset($_POST['flgCtrDer']) && $_POST['flgCtrDer'] == 'Yes') ? "1" : "0";
        $flgCtrCon           = (isset($_POST['flgCtrCon']) && $_POST['flgCtrCon'] == 'Yes') ? "1" : "0";
        $flgCtrNac           = (isset($_POST['flgCtrNac']) && $_POST['flgCtrNac'] == 'Yes') ? "1" : "0";
        $flgCtrInt           = (isset($_POST['flgCtrInt']) && $_POST['flgCtrInt'] == 'Yes') ? "1" : "0";       
        $flgEspCtr           = (isset($_POST['flgEspCtr']) && $_POST['flgEspCtr'] == 'Yes') ? "1" : "0";
        $flgEspCiv           = (isset($_POST['flgEspCiv']) && $_POST['flgEspCiv'] == 'Yes') ? "1" : "0";
        $flgEspLey           = (isset($_POST['flgEspLey']) && $_POST['flgEspLey'] == 'Yes') ? "1" : "0";
        $flgEspMin           = (isset($_POST['flgEspMin']) && $_POST['flgEspMin'] == 'Yes') ? "1" : "0";
        $flgEspCon           = (isset($_POST['flgEspCon']) && $_POST['flgEspCon'] == 'Yes') ? "1" : "0";
        $flgEspOtr           = (isset($_POST['flgEspOtr']) && $_POST['flgEspOtr'] == 'Yes') ? "1" : "0";
        $DesNarHec           = $_POST['DesNarHec'];
        $DesMedCau           = $_POST['DesMedCau'];
        $TipCuant            = $_POST['TipCuant'];
        $MonCuant            = $_POST['MonCuant'];
        $ImpNCuant           = $_POST['ImpNCuant'];
        $ImpLCuant           = $_POST['ImpLCuant'];
        $ApeNomArb           = $_POST['ApeNomArb'];
        $DesDirArb           = $_POST['DesDirArb'];
        $NumTelArb           = $_POST['NumTelArb'];
        $DirEmaArb           = $_POST['DirEmaArb'];
        $NomProArb           = $_POST['NomProArb'];
        $NumColArb           = $_POST['NumColArb'];
        $FlgRegArb           = (isset($_POST['FlgRegArb']) && $_POST['FlgRegArb'] == 'Yes') ? "1" : "0";
        $FlgPrtArb           = (isset($_POST['FlgPrtArb']) && $_POST['FlgPrtArb'] == 'Yes') ? "1" : "0";
        $FlgUniArb           = (isset($_POST['FlgUniArb']) && $_POST['FlgUniArb'] == 'Yes') ? "1" : "0";
        $idSit               = '1';
        $idEst               = '1';

        $Solicitud           = new Solicitud();
//        $SolicitudPretension = new SolicitudPretension();
//        $Solicitudanexo      = new SolicitudAnexo();

        /* =========================
          PROCESO DE ACTUALIZACION
        ============================*/
        $ValMsnRegistro = $Solicitud->ActualizaSolicitud($idUsuario,$id,$RazSocDem,$TipDocDem,$NumDocDem,$EscPubDem,$DesDirDem,$ApeNomLeg,$TipDocRep,$NumDocRep,
                        $NumTelRep,$NumCelRep,$DirEmaRep,$TipDocEmiCom,$NumDocEmiCom,$RazSocEmiCom,$RazSocDmd,$DesDirDmd,$TipDocDmd,$NumDocDmd,$NumTelDmd,
                        $NumCelDmd,$DirEmaDmd,$AutRepDmd,$ProPubDmd,$DesConArb,$flgCtrDer,$flgCtrCon,$flgCtrNac,$flgCtrInt,$flgEspCtr,$flgEspCiv,$flgEspLey,
                        $flgEspMin,$flgEspCon,$flgEspOtr,$DesNarHec,$DesMedCau,$TipCuant,$MonCuant,$ImpNCuant,$ImpLCuant,$ApeNomArb,$DesDirArb,$NumTelArb,
                        $DirEmaArb,$NomProArb,$NumColArb,$FlgRegArb,$FlgPrtArb,$FlgUniArb,$idSit,$idEst);

        if($ValMsnRegistro)
        {   
            // 1.  PRETENSIONES
            if(isset($_POST["pretenciones"]))
            {

                // Registrar detalle de Pretensiones
                   $dataPretenciones = array();

                // 1.1 Captura de datos vía POST
                    foreach($_POST["pretenciones"] as $p){
                       $prentecion = json_decode($p);
                       array_push($dataPretenciones, $prentecion);
                    }   

                    if(isset($dataPretenciones)){ //-------------------------------------2
                        // 1.2 Borrado de tabla
                            $SolicitudPretension->BorrarSolicitudPretension($id);

                            // 1.3 Inserción Masiva 
                            $idPretension  = 0;
                            
                            // ----------------------------------------------------------1
                            foreach ($dataPretenciones as $value){
                                if(isset($value->pretencion)){
                                    $idPretension  ++;
                                    $desPretension = $value->pretencion;
                                    $SolicitudPretension->NuevaSolicitudPretension($id,$idPretension,$desPretension);    
                                }
                            }
                            // ----------------------------------------------------------1
                    } //-----------------------------------------------------------------2
            }
            // 2. ANEXOS
            if(isset($_POST["anexos"]))
            {

                // Registrar detalle de Anexos
                $dataAnexos = array();

                // 2.1 Captura de datos vía POST
                  foreach ($_POST["anexos"] as $p) {
                      $anexo = json_decode($p);
                      array_push($dataAnexos, $anexo);
                  }

                  if(isset($dataAnexos)){ // ----------------------------------------------------------------------------
                    $cntfile  = 0;
                    
                    if(isset($_POST["fileAnexo"])){
                        $files = $_POST["fileAnexo"];
                        $itemFiles = 0;
                    }                   

                    foreach ($dataAnexos as $value) {

                        if($value->esNuevo == 'S'){
                            
                            $cntfile ++;

                            $idTipo         = $value->idtipo;
                            $nomFileLoc     = $value->Archivo;
                            $nomFilePrt     = explode(".", $nomFileLoc);
                            $nomfileSav     = end($nomFilePrt);
                            $nomFileSer     = "ANX_".date("Ymd")."_".date("His")."_".$cntfile.".".$nomfileSav;
                            $flgEliminado   = 'N';

                            $SolicitudAnexo->AgregarAnexo($id,$idTipo,$nomFileLoc,$nomFileSer,$flgEliminado);

                            // Escritura de archivo en servidor
                            if(isset($_POST["fileAnexo"])){
                                $filSvr = $_SERVER['DOCUMENT_ROOT'].'/tramite/vistas/upload/'.$nomFileSer;
                                file_put_contents($filSvr, base64_decode($files[$itemFiles]));
                                $itemFiles++;
                            }
                        }                        
                    }
                  }
            }

            $flgModal = 'S';       

        } 
    }
?>

<!--==================================================================================================================================================
    MODAL
    ================================================================================================================================================== -->
    <div class="modal fade" id="modal_exito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title text-center" id="exampleModalLabel">Solicitud de Arbitraje</h4>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="btnCerrar" aria-hidden="true">&times;</span>
              </button>

            </div>
            <div class="modal-body">
                
                <div class="alert alert-warning" role="alert">
                    <i class="fa fa-check"></i> 
                    ¡Solicitud de Arbitraje <strong>ACTUALIZADA</strong>!
                </div>
                
                <div class="alert alert-primary" role="alert">
                    <i class="fa fa-exclamation-circle"></i> 
                    Revise el documento que se acaba de descargar y fírmelo si es que todo esta correcto.
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss = "modal"> Continuar </button> 
            </div>
          </div>
        </div>
      </div>

<?php 
    if($flgModal == 'S'){
        // Redireccionamos a la pantalla de Solicitud.
        echo "<script>
                $('#modal_exito').modal('show');
                location.href='CrearPdf.php?id=".$id."';
                
                $('#modal_exito').on('hidden.bs.modal', function () {
                    
                    location.href='consulta.php';
                });
             </script>";
        }

    include_once 'componentes/footer.php';
?>
