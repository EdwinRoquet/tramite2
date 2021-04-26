<?php 
	include_once "../includes/user.php";
    include_once "componentes/header-sin-sesion.php"
 ?>
	<div id="fondo" class="align-items-center d-flex cover section-aquamarine py-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 p-3 mx-auto">
					<form action="recordarpsw.php" method="post" class="p-4 bg-light" id="frmRecordar">
						
						<img src="img/img-log.jpeg" class="img-fluid mx-auto d-block mb-3" width="300">
            			<h4 class="text-center titLogin">SISTEMA ELECTRÓNICO ARBITRAL</h4>
            			<h5 class="text-center mb-2 StitLogin">SISTELAR</h5>
                        <p class="text-center mb-4">Recuperación de Contraseña</p>

            			<div class="form-group"> 
              				<label for="username">Usuario</label>
              				<input type = "email" name="username" id="username" class="form-control" placeholder="Ejemplo : usuario@dominio.com"> 
            			</div>

            			<button class="btn btn-block p-1 btn-primary" type="submit">
                			Recuperar Contraseña
            			</button>
						<br>
            			<div class="alert alert-warning" role="alert">
  							<i class="fa fa-edit"></i> <strong>Enviaremos</strong> un correo electrónico con la información solicitada.
						</div>
						<p class="registro">
              				<a href="../index.php">Iniciar Sesión</a>.
            			</p>
           
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- =======================================================
     MODAL : VALIDACIONES
     ======================================================= -->
     <?php 
     	$mensaje  = "";
     	$flgModal = "N";
     	$flgErr   = "N";
     	
     	if(isset($_POST["username"]) && !empty($_POST["username"]) ){

     		// Capturar variables
     		$vUser = $_POST["username"];

     		// Obtener datos
     		$User = new User();

     		$usuario = $User->getPass($vUser);

			// Proceso de envio de contraseña.
			if(isset($usuario) && !empty($usuario)){

				/* Aqui enviamos la contraseña ------------------------------------------ */

        		$destino     = $vUser;

        		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

				$contenido   = "<p>¡Hola , solicitaste tu clave en nuestro Sistema.</p>
        						<p> no revele ni comparta esta información</p>
        						<p> Clave : ".$usuario["passwd"]. "</p>";
        						       						 
        		mail($destino,"Recuperación de Clave", $contenido,$cabeceras);

        		/* Aqui enviamos la contraseña ------------------------------------------ */
				$mensaje = "Enviamos un correo con los datos solicitados.";
				$flgModal = "S";
			}else{
				$mensaje = "Usuario no se encuentra registrado en nuestro sistema";
				$flgModal = "S";
				$flgErr = "S";
			}
		}
      ?>
     <div class="modal fade" id="mdlRecordar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Recordar contraseña</h4>
              
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

      <?php
      	if ($flgModal == "S"){
			echo "<script>

					$('#pMensaje').html('".$mensaje."');
                    $('#mdlRecordar').modal('show');

                    $('#mdlRecordar').on('hidden.bs.modal', function () {";
                    if($flgErr == "N"){
                       echo "location.href='../index.php'";
                    }
                    echo "});
                </script>";
      	}
	 ?>

	<?php include_once 'componentes/footer.php'; ?>
