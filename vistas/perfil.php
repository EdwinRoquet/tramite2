<?php
	/* Componentes HTML */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';

    $flgmodal = "N";
    $mensaje = "";

    if(isset($_POST['submit'])){
    	// Capturar valores
   	    $numtel = $_POST['numtel'];
        $passwd = $_POST['passwd'];
        $passwd = str_replace(' ', '', $passwd);
        if (strlen($passwd) > 0 and strlen($passwd) < 6) {
            $mensaje = "La contraseña debe ser igual o mayor a 6 caracteres.";
            $infoUser = $user ->getUserInf($idUsuario);
        }else{
          $user ->UpdInfo($id,$numtel,$passwd);
          $mensaje = "Cambios guardados con éxito";
          $infoUser = $user ->getUserInf($idUsuario);
        }
	    $flgmodal = "S";
    }else{
    	$infoUser = $user ->getUserInf($idUsuario);
    }
?>
<div class="card m-4">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="card-body">
            <h2 class="titulo"><i class="fa fa-user"></i> Perfil </h2>
            <p class="subtitulo">Aquí podras actualizar la información de tu perfil.</p>        
            <!-- ------------------------------------------------------------------------------- -->
            <div class="form-row">
                <div class="col-sm-3" style="display: none;">
                    <div class="form-group"> 
                        <label>Id</label>
                        <input class="form-control" id="idUsuario" name="idUsuario" value="<?php echo $infoUser["id"]; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group"> 
                        <label>Tipo de Documento</label>
                        <label class="form-control edit"><?php echo $infoUser["destipdoc"]; ?> </label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group"> 
                        <label>Numero de Documento</label>
                        <label class="form-control edit"><?php echo $infoUser["nrodoc"]; ?></label>
                    </div>
                </div>
            </div>
            <!-- ------------------------------------------------------------------------------- -->
            <div class="form-row">
                <div class="col-sm-6">
                    <div class="form-group"> 
                        <label>Nombre o Razón Social</label>
                        <label class="form-control edit"><?php echo $infoUser["nomraz"]; ?></label>
                    </div>
                </div>
            </div>
            <!-- ------------------------------------------------------------------------------- -->
            <div class="form-row">
                <div class="col-sm-6">
                    <div class="form-group"> 
                        <label>Correo Electrónico</label>
                        <label class="form-control edit"><?php echo $infoUser["direma"]; ?></label>
                    </div>
                </div>
            </div>
            <!-- ------------------------------------------------------------------------------- -->
            <div class="form-row">
                <div class="col-sm-3">
                    <div class="form-group"> 
                        <label>Celular</label>
                        <input class="form-control input_tel" id="numtel" name="numtel" value="<?php echo $infoUser["numtel"]; ?>" required>
                    </div>
                </div>
            </div>
            <!-- ------------------------------------------------------------------------------- -->
            <div class="form-row">
                <div class="col-sm-6">
                    <hr>
                    <p style="color: #00819f !important">Aquí podras actualizar tu contraseña.</p>
                </div>
            </div>
            <!-- ------------------------------------------------------------------------------- -->
            <div class="form-row">
                <div class="col-sm-3">
                    <div class="form-group"> 
                        <label>Nueva contraseña</label>
                        <input class="form-control edit" id="passwd" type="password" name="passwd" placeholder="Mínimo 6 caracteres">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-success" name="submit" value="Actualizar Datos">
        </div>
    </form>
</div>

<!-- =======================================================
     MODAL : VALIDACIONES
     ======================================================= -->
<div class="modal fade" id="mdlPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos de Perfil</h5>
          
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="btnCerrar" aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <p id="pMensaje"><?php echo $mensaje; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss = "modal"> Cerrar </button> 
            </div>
        </div>
    </div>
</div>
	
<?php 
if($mensaje != ""){
	if($flgmodal == "S"){
    if ($mensaje == "Cambios guardados con éxito" ) {
        echo "<script>
            $('#mdlPerfil').modal('show');
                  $('#mdlPerfil').on('hidden.bs.modal', function () {
                   location.href='consulta.php';
                 });
             </script>";
      }else{
          echo "<script>
            $('#mdlPerfil').modal('show');
            </script>";
      }
    }
}

	include_once 'componentes/footer.php';
?>