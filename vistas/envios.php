<?php 
/* --------------------------- Componentes HTML --------------------------- */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';

?>
<nav aria-label="breadcrumb" class="m-4">
  	<ol class="breadcrumb migas">
        <li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-edit"></i> Panel Principal</a></li>
        <li class="breadcrumb-item"><a href="recepcion.php"><i class="fa fa-envelope-o"></i> Mesa de Partes</a></li>
    	<li class="breadcrumb-item active" aria-current="page">Detalle de envío</li>
  	</ol>
</nav>

<div class="card m-4">
   	<div class="card-body">
        <input type="text" id="usuarioOrigen" name="usuarioOrigen" class="form-control" value="<?php echo $idUsuario; ?>" style="display: none;">
        <input type="text" id="areaOrigen" name="areaOrigen" class="form-control" value="<?php echo $idArea; ?>" style="display: none;">
		<?php 
			if(isset($_GET['id'])){
				if(is_numeric($_GET['id'])){   		 						
					$id = $_GET['id'];
					// Si la solicitud existe entonces se cargara los datos en el navegador
                    $idUsuario =  $user->getId();
                    $Solicitud = $Solicitud->EditarSolicitud_v2($id);	
					$MSolicitudRuta = $SolicitudRutas->ListarRutas($id);
				}
 			}
		 ?>
		<h5 class="card-title"><i class="fa fa-tags"></i> Detalle de envío</h5>
		<hr>
		<div class="form-row">
			<div class="col-sm-12">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="">Solicitud</label>
					<div class="col-sm-2">
						<input class="form-control" type="text" id="txtNumSol" name="txtNumSol" value="<?php echo $Solicitud["NumSol"]; ?>" disabled>
					</div>
					<div class="col-sm-2">
						<input class="form-control" type="text" id="txtFecSol" name="txtFecSol" value="<?php echo $Solicitud["FchCreSol"].' '.$Solicitud['HraCreSol']; ?>" disabled>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="">Tipo de Tramite</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" id="txtTipTra" name="txtTipTra" value="<?php echo $Solicitud["destipsol"]; ?>" disabled>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="table-responsive">
				<table class="table TablaSistema" id="tbrutas">
					<thead>
						<tr class="text-center">
							<th width="5%">Nro</th>
							<th width="20%">Área de Envio</th>
							<th width="10%">Fecha de Envio</th>
							<th width="10%">Hora de Envio</th>
							<th width="5%">Recepcionado</th>
							<th width="20%">Área de Destino</th>
							<th width="10%">Fecha de Recepción</th>
							<th width="10%">Hora de Recepción</th>
							<th width="5%">Consultar</th>
							<!--<th width="5%" class="ColOculto">Editar</th>-->
						</tr>
					</thead>
					<tbody>

						<?php 
							foreach ($MSolicitudRuta as $key => $value) {
								echo '<tr>
										<td class="text-center align-middle">'.$value['idruta'].'</td>
										<td class="text-left align-middle">'.$value['desareaenvio'].'</td>
										<td class="text-center align-middle">'.$value['fchenvio'].'</td>
										<td class="text-center align-middle">'.$value['hraenvio'].'</td>
										<td class="text-center align-middle">';
											if($value['flgrecepcion'] == 'S'){
												echo '<img src="img/checked.png" class="img-fluid" width="20" title="Recepcionado">';
											}else{
												echo '<img src="img/unchecked.png" class="img-fluid m-0 p-0" width="20" title="Recepción Pendiente">';
											}
								echo	'</td>
										<td class="text-left align-middle">'.$value['desareadestino'].'</td>
										<td class="text-center align-middle">'.$value['fchrecepcion'].'</td>
										<td class="text-center align-middle">'.$value['hrarecepcion'].'</td>
										<td class="text-center align-middle">
											<a href="#" class="btn btn-info" title="" onclick="ConsultaRuta('.$value['idSolicitud'].','.$value['idruta'].');">
                        					<i class="fa fa-search"></i>
                        					</a>
                        				</td>';
                        				//<td class="text-center align-middle ColOculto">';

                        				//if($value['flgrecepcion'] != 'S'){
                        			    //     echo ' <a href="#" class="btn btn-warning" title="" onclick="EditarRuta('.$value['idSolicitud'].','.$value['idruta'].');">
                        				//	           <i class="fa fa-pencil"></i>
                        				//	       </a>';
                        				//}

								//echo    '</td>';
								echo    '</tr>';
							}
						 ?>
						
					</tbody>
				</table>
			</div>
		</div>
    </div>
</div>
<!--============================================================
	MODAL : CONSULTA DE ENVIO (RUTA) 
	============================================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdlConsultaEnvio">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <!--============================ TITULO ============================-->
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-search"></i> Consulta de envio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <!--============================ CUERPO ============================-->
      <div class="modal-body">
        <div class="form-row">

            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Area de destino</label>
                    <div class="col-sm-8"><input type="text" class="form-control" id="txtAreDes" name="txtAreDes" disabled></div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tipo de Documento</label>
                    <div class="col-sm-8"><input type="text" class="form-control" id = "txtTipDoc" name = "txtTipDoc" disabled=""></div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Para</label>
                    <div class="col-sm-8"><input type="text" class="form-control" id = "txtDesPar" name = "txtDesPar" disabled=""></div>        
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Asunto</label>
                    <div class="col-sm-8"><input type="text" class="form-control" id = "txtDesAsu" name = "txtDesAsu" disabled=""></div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Referencia</label>
                    <div class="col-sm-8"><input type="text" class="form-control" id = "txtDesRef" name = "txtDesRef" disabled=""></div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Contenido</label>
                    <div class="col-sm-8"><textarea type="text" class="form-control" id = "txtDesCon" name = "txtDesCon" rows="3" disabled=""></textarea></div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Documento Adjunto</label>
                    <div class="col-sm-8" id="descargaAdjunto">
                    </div>
                </div>
            </div>

        </div>
      </div>

    </div>
  </div>
</div>
<!--============================================================
	MODAL : EDICION DE RUTA
	============================================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdlEditarEnvio">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <!--============================ TITULO ============================-->
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-tags"></i> Edición de Envio</h5>
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
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="idSolicitud" name="idSolicitud" readonly>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="idRuta" name="idRuta" readonly="">
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Area de destino</label>
                    <div class="col-sm-8">
                        <select name="areaDestino" id="areaDestino" class="form-control" disabled>
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
                        <select name="tipoDocumento" id="tipoDocumento" class="form-control" disabled>
                            <?php 
                                echo '<option value="0"> Seleccionar </option>';
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
        <button type="button" id="btnAnular" class="btn btn-success" onclick="AnularRuta()"> Anular Envio</button>
        <button type="button" id="btnGrabar" class="btn btn-success" onclick="ActualizarRuta()"> Grabar Cambios</button>
      </div>

    </div>
  </div>
</div>

<?php 
	include_once 'componentes/footer.php';
?>