<?php
  include_once '../includes/user.php';
  include_once '../includes/tipdoc.php';
  require_once '../vendor/autoload.php';


  /*CODIGO reCAPTcha*/
  include_once 'componentes/header-sin-sesion.php'; 
  
  if(isset($_POST['g-recaptcha-response'])){

    //La respuesta del recaptcha
    $respuesta=$_POST['g-recaptcha-response'];
    //La ip del usuario
    $ipuser=$_SERVER['REMOTE_ADDR'];
    //Tu clave secretra de recaptcha
    $clavesecreta='6LfR6v0UAAAAAMRABVNX1B1Hj8blSZHX74PFIUH8';
    //La url preparada para enviar
    $urlrecaptcha="https://www.google.com/recaptcha/api/siteverify?secret=$clavesecreta&response=$respuesta&remoteip=$ipuser";

    //Leemos la respuesta (suele funcionar solo en remoto)
    $respuesta = file_get_contents($urlrecaptcha) ;

    //Comprobamos el success
    $dividir=explode('"success":',$respuesta);
    $obtener=explode(',',$dividir[1]);

    //Obtenemos el estado
    $estado=trim($obtener[0]);

}
/*FIN DE reCAPTCHAR*/

  $flgmodal = 'N';
      
  if(!empty($_POST))
  {
    
    $tipdoc  = $_POST['tipdoc'];
    $nrodoc  = $_POST['nrodoc'];
    $nomraz  = $_POST['nomraz'];
    $direma  = $_POST['direma'];
    $numtel  = $_POST['numtel'];
    $passwd  = '';

    /* ==============================
        GENERAR CONTRASEÑA ALEATORIA
       ============================== */
       //Carácteres para la contraseña
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";

        //Reconstruimos la contraseña segun la longitud que se quiera
        for($i=0; $i<6 ; $i++) {
            //obtenemos un caracter aleatorio escogido de la cadena de caracteres
            $passwd .= substr($str,rand(0,62),1);
        }
           
    $flgter  = (isset($_POST['flgter']) && $_POST['flgter'] == 'Yes') ? "1" : "0";

    $user    = new User();

    $mensaje = "";

    if($flgter != "1"){
        $mensaje = '<div class="alert alert-danger" alert-dismissible fade show role="alert">
                        Debe aceptar los Términos y Condiciones.
                    </div>';
        unset($_POST);

    }else if($user->mailExists($direma)){
        $mensaje = '<div class="alert alert-danger" alert-dismissible fade show role="alert">
                        El correo ingresado ya fue registrado previamente.
                    </div>';
        unset($_POST);

    }else if ($user->nrodocExists($tipdoc,$nrodoc)) {
        $mensaje = '<div class="alert alert-danger" alert-dismissible fade show role="alert">
                        El documento de identidad '.$nrodoc.' ya fue registrado previamente.
                    </div>';
        unset($_POST);

    }/*else if ($estado=='false'){
        $mensaje = '<div class="alert alert-danger" alert-dismissible fade show role="alert">
                        Debe marcar la casilla de no soy robot para continuar.
                    </div>';
        unset($_POST);
    }*/else{

        $flgmodal = 'S';

        $user->newUser($tipdoc,$nrodoc,$nomraz,$direma,$numtel,$passwd);
        $mensaje = '<div class="alert alert-success" alert-dismissible fade show role="alert">
                        ¡Gracias por registrarte! te enviamos un correo con toda tu información.
                    </div>';

        /* ==============================================================================================
           ENVIO DE CORREO
           ==============================================================================================*/
        
            $nombre      = $_POST["nomraz"];
            $destino     = $_POST["direma"];
            $correo      = $_POST["direma"];
            $pass        = $passwd;
            $rutaSistema = "http://epsilon.pe/tramite/index.php";
        
            $transport = (new Swift_SmtpTransport('mail.epsilon.pe', 465,'ssl'))
            ->setUsername('dmontenegro@epsilon.pe')
            ->setPassword(')84aqKv;MaE7');

            $mailer = new Swift_Mailer($transport);
            $html = '<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding:40px">
                        <div style="margin:auto; width:600px; background:white; padding:20px">
                            <center>
                                <img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">
                                <h3 style="font-weight:100; color:#999">Hola '.strtoupper($nombre).'</h3>
                                <hr style="border:1px solid #ccc; width:80%">
                            </center>
                            <h4 style="font-weight:100; color:#999; padding:0 20px">
                                Gracias por registrarte en la Mesa de Partes Virtual del Centro de Arbitraje Latinoamericano e Investigaciones Jurídicas.<br>
                                para acceder inicia sesión con tu usuario y contraseña : <br><br>
                                
                                Usuario : '.$correo.'<br>
                                Contraseña : '.$pass.'
                            </h4>
                            <center>
                                <br>
                                <hr style="border:1px solid #ccc; width:80%">
                                <h5 style="font-weight:100; color:#999">
                                    Recuerda que puedes acceder a nuestra Mesa de Partes Virtual a travéz del siguiente enlace: <a href="'.$rutaSistema.'">'.$rutaSistema.'</a>
                                </h5>
                            </center>
                        </div>  
                    </div>';

            // Creación de mensaje
            $message = (new Swift_Message('Registro de Usuario'))
            ->setFrom(['montenegro.sarmiento.david@gmail.com' => 'Sistema Electrónico Arbitral - SISTELAR'])
            ->setTo([$destino,$destino => 'Registro'])
            ->setBody($html,'text/html');
            // Envio de mensaje
            $result = $mailer->send($message);
        /*==============================================================================================*/
}

 } else{
        $mensaje = "";
  }

//  include_once 'componentes/header-sin-sesion.php';
?>
<!--=================================================== 
    REGISTRO DE SOLICITUD
=======================================================-->
<form method="POST" id="frmRegistro" action="registro.php" class="frmRegistro mx-auto">
    <div class="form-row">
        <div class="col">
            <img src="img/img-log.jpeg" class="img-fluid mx-auto d-block mt-3" width="300">
            <h4 class="text-center p-4">Creación de Cuenta</h4>
        </div>
        <?php echo $result; ?>
    </div>
    <!--========================
    FILA 1
    ======================== -->
     <div class="form-row">
        <!-- ================================ -->
        <div class="form-group col-md-6">
            <label class="control-label">Tipo de Documento</label>
            <select id="cbotipdoc" name="tipdoc" class="form-control cbo">
                <option value="0">Seleccione Tipo de Documento</option>
                <?php 
                    $otipdoc = new TipDoc();
                    $ArrTipDoc = $otipdoc->listarTipdoc();

                    foreach ($ArrTipDoc as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["tipdoc"].'</option>';
                   }
                ?>
            </select>    
        </div>    
        <!-- ================================ -->
        <div class="form-group col-md-6">
            <label>Nro. de Documento</label>
            <input type="text"  name="nrodoc" class="form-control input_num" placeholder="Ingrese número de documento" maxlength="11" required>
        </div>    
    </div>
    <!--========================
    FILA 2
    ======================== -->
    <div class="form-row">
        <!-- ================================ -->
        <div class="form-group col-md-12">
            <label>Nombre o Razón Social</label>
            <input name="nomraz" class="form-control" placeholder="Ejemplo:Juan Carlos Montenegro Vega" required>
        </div>
    </div>
    <!--========================
    FILA 3
    ======================== -->
    <div class="form-row">
        <!-- ================================ -->
        <div class="form-group col-md-6">
            <label>Correo Electrónico</label>
            <input type = "email" name="direma" class="form-control" placeholder="Ejemplo: juan59@outlook.com" required>
        </div>
        <!-- ================================ -->
        <div class="form-group col-md-6">
            <label>Celular</label>
            <input name="numtel" class="form-control input_tel" placeholder="Ejemplo: 515701863" required>
        </div>
    </div>
    <!--========================
    FILA 4
    ======================== -->
    <!--
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Contraseña (Mínimo 6 caracteres)</label>
            <input type="password" id="txtpasswd" name="passwd" class="form-control" placeholder="Ingrese contraseña" required>
        </div>
        <div class="form-group col-md-6">
            <label>Repita contraseña</label>
            <input type="password" id="txtpasswd2" name="passwd2" class="form-control" placeholder="Repita contraseña" required>
        </div>
    </div>
    -->
    <!--========================
    FILA 5
    ======================== -->
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="flgter" id="flgter" value="Yes">
                    <span class="text-muted">Declaro que he leído y acepto los 
                        <a href="#" data-toggle="modal" data-target="#myModal">Términos y Condiciones</a>.
                    </span>
                </label>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
           <div class="g-recaptcha" data-sitekey="6LfR6v0UAAAAACYKslGFce83sMs-4Dram-RWhBKd"></div>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success btn-block btnRegistrar">Registrarse</button>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12 text-center">
            <label>
                <span class="text-muted" >Si ya estas registrado. 
                    <a href="../index.php">Iniciar Sesión</a>.
                </span>
            </label>
        </div>
    </div>

    <?php  
        //echo $mensaje;
    ?> 

</form>

<!-- =======================================================
     MODAL : TERMINOS Y CONDICIONES
     ======================================================== -->
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Términos y condiciones</h4>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="btnCerrar" aria-hidden="true">&times;</span>
              </button>

            </div>
            <div class="modal-body">
              <p> Al aceptar, autoriza que la presente información sea conservada y aceptada
                     por el Centro de Arbitraje Latinoamericano e Investigaciones Jurídicas para creación de cuenta de usuario. </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss = "modal"> Cerrar </button> 
            </div>
          </div>
        </div>
      </div>


<!-- =======================================================
     MODAL : VALIDACIONES
     ======================================================= -->
     <div class="modal fade" id="ModalValidaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Validaciones</h4>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="btnCerrar" aria-hidden="true">&times;</span>
              </button>

            </div>
            <div class="modal-body">
              <p id="pMensaje"> Olvido seleccionar <span class="font-weight-bold">Tipo de Documento</span> </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss = "modal"> Cerrar </button> 
            </div>
          </div>
        </div>
      </div>

<!--========================================================= 
    MODAL : CONFIRMACION DE REGISTRO
    =========================================================-->
    <div class="modal fade" id="ModalConfirmacion" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                     <h4 class="modal-title" id="exampleModalLabel">Creación de la Cuenta</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="btnCerrar" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php  echo $mensaje;?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
            
        </div>
    </div>
    <?php 
        /* validamos aqui si se muestra modal */
        if($mensaje != ""){

            if($flgmodal == 'S'){

                echo "<script>
                        
                        $('#ModalConfirmacion').modal('show');

                        $('#ModalConfirmacion').on('hidden.bs.modal', function () {
                    
                        location.href='../index.php';
                    });
                    </script>";
            }else{
                echo "<script>
                    $('#ModalConfirmacion').modal('show');
                </script>";    
            }          
        }
     ?>


<?php include_once 'componentes/footer.php'; ?>
  
