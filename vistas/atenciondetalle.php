<?php 
/* --------------------------- Componentes HTML --------------------------- */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';

 ?>
<nav aria-label="breadcrumb" class="m-3">
	<ol class="breadcrumb migas">
		<li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-home"></i> Panel Principal</a></li>
		<li class="breadcrumb-item"><a href="atencion.php"><i class="fa fa-edit"></i> Atención de Solicitud</a></li>
		<li class="breadcrumb-item active" aria-current="page">Hoja de Ruta</li>
	</ol>
</nav>
<div class="card m-3">
	<div class="card-header font-weight-bold">
		<i class="fa fa-tags"></i> Información Solicitud
	</div>
	<div class="card-body">
		<input type="text" id="usuarioOrigen" name="usuarioOrigen" class="form-control" value="<?php echo $idUsuario; ?>" style="display: none;">
   		<input type="text" id="areaOrigen" name="areaOrigen" class="form-control" value="<?php echo $idArea; ?>" style="display: none;">
		<?php 
			//	Logica para obtener datos de la solicicitud y hoja de ruta
			$id    = explode("-", $_GET['id']);
			$idSol = $id[0];
			$idRut = $id[1];

			$solicitud = new Solicitud();
			$msolicitud = $solicitud->EditarSolicitud_v2($idSol);

			$solicitudrutas = new SolicitudRutas();
			$EdicionRuta = $solicitudrutas->EditarRuta($idSol,$idRut);
			
		?>
		<div class="form-row">
			<div class="col-sm-12">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="">Número y tipo de Solicitud</label>
					<div class="col-sm-2">
						<input class="form-control" type="text" value="<?php echo $EdicionRuta['NumSol'] ?>" disabled>
					</div>
					<div class="col-sm-3">
						<input class="form-control" type="text" value="<?php echo $EdicionRuta['destipsol'] ?>" disabled>
					</div>	
					<label class="col-sm-1 col-form-label" for="">Fecha y hora</label>
					<div class="col-sm-2">
						<input class="form-control" type="text" value="<?php echo $EdicionRuta['FchCreSol'] ?>" disabled>
					</div>
					<div class="col-sm-2">
						<input class="form-control" type="text" value="<?php echo $EdicionRuta['HraCreSol'] ?>" disabled>
					</div>
				</div>
				<div class="card m-3">
					<div class="card-header font-weight-bold">
						<i class="fa fa-tags"></i> Información Demandate
					</div>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for=""><strong>DEMANDANTE</strong></label>
							<div class="col-sm-5">
								<input class="form-control" type="text" value="<?php echo $EdicionRuta['RazSocDem'] ?>" disabled>
							</div>
							<label class="col-sm-1 col-form-label" for="">Doc. Indentidad</label>
							<div class="col-sm-2">
								<input class="form-control" type="text" value="<?php echo $EdicionRuta['DesDocDem'] ?>" disabled>
							</div>
							<div class="col-sm-2">
								<input class="form-control" type="text" value="<?php echo $EdicionRuta['NumDocDem'] ?>" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="card m-3">
					<div class="card-header font-weight-bold">
						<i class="fa fa-tags"></i> Información Demandado
					</div>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for=""><strong>DEMANDADO</strong></label>
							<div class="col-sm-5">
								<input class="form-control" type="text" value="<?php echo $EdicionRuta['RazSocDmd'] ?>" disabled>
							</div>
							<label class="col-sm-1 col-form-label" for="">Correo Electrónico</label>
							<div class="col-sm-4">
								<input class="form-control" type="text" value="<?php echo $EdicionRuta['DiremaDmd'] ?>" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card m-3">
	<div class="card-header font-weight-bold">
		<i class="fa fa-tags"></i> Contenido de atención solicitada
	</div>
	<div class="card-body">
		<div class="form-row">
			<div class="col-sm-12">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="">Area de Origen</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" value="<?php echo $EdicionRuta['desareaenvio'] ?>" disabled>
					</div>
				</div>
			</div>
		</div>

		<div class="form-row">
			<div class="col-sm-12">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="">Documento Interno</label>
					<div class="col-sm-3">
						<input class="form-control" type="text" value="<?php echo $EdicionRuta['destipdoc'] ?>" disabled>
					</div>
					<div class="col-sm-2">
						<input class="form-control" type="text" value="<?php echo $EdicionRuta['numdocint'] ?>" disabled>
					</div>
					<label class="col-sm-1 col-form-label" for="">Fecha de Envio</label>
					<div class="col-sm-2">
						<input class="form-control" type="text" value="<?php echo $EdicionRuta['fchenvio'] ?>" disabled>
					</div>
				</div>
			</div>
		</div>

		<div class="form-row">
			<div class="col-sm-12">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="">Asunto</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" value="<?php echo $EdicionRuta['asunto'] ?>" disabled>
					</div>

					<label class="col-sm-1 col-form-label" for="">Referencia</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" value="<?php echo $EdicionRuta['referencia'] ?>" disabled>
					</div>

				</div>
			</div>
		</div>
						
		<div class="form-row">
			<div class="col-sm-12">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="">Contenido</label>
					<div class="col-sm-10">
						<textarea type="text" class="form-control" id = "txtDesCon" name = "txtDesCon" rows="3" disabled><?php echo $EdicionRuta['contenido'] ?></textarea>
					</div>
				</div>
			</div>
		</div>
			
		<div class="form-row">
			<div class="col-sm-12">
				<div class="form-group row" id="msgRecepcion">
					<?php 
						if($EdicionRuta['flgrecepcion'] == 'N'){
						  echo '<label class="col-sm-2 col-form-label" for=""></label>
								<div class="col-sm-9">
									<div class="alert alert-warning" role="alert">
										<i class="fa fa-exclamation-triangle"></i> La presente solicitud se encuentra pendiente de <strong>Recepción</strong>.
									</div>
								</div>';
						}
					 ?>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="form-row">
			<div class="col-sm-5">
				<?php 
					if($msolicitud['flgNotDem'] == 'N'){
						echo '<div class="alert alert-danger m-0 p-2" role="alert">
								<i class="fa fa-exclamation-triangle"></i> <strong>NOTIFICACION PENDIENTE PARA RESPUESTA A SOLICITUD DE INICIO DE PROCEDIMIENTO ARBITRAL.</strong>
							  </div>';

					}else if ($msolicitud['flgSolRes'] == 'S'){
						echo '<div class="alert alert-success m-0 p-2" role="alert">
								<i class="fa fa-check"></i> <strong> Solicitud RESPONDIDA, <a href="#" class="alert-link" data-toggle="modal" data-target="#mdlRespuesta">click aquí </a>para visualizar la respuesta.</strong>
							  	</div>';
					}else{
						echo '<div class="alert alert-warning m-0 p-2" role="alert">
								<i class="fa fa-envelope"></i> <strong> Solicitud Notificada, respuesta a solicitud PENDIENTE.</strong>
							  </div>';
					}
					
				 ?>
			</div>
			<div class="col-sm-3 text-center">
				<!-- Botones para ver archivos adjuntos-->
				<button type="button" class="btn btn-info" id="btndocAnx" onclick=""><i class="fa fa-chain-broken"></i> Documentos Anexos</button>
				<button type="button" class="btn btn-info" id="btndocAdj" onclick=""><i class="fa fa-chain-broken"></i> Documentos Adjuntos</button>
			</div>
			<div class="col-sm-4 text-right">
				<!--============================ 
				BOTON : RECEPIONAR ENVIO 
				=============================-->
				<?php  
					if($EdicionRuta['flgrecepcion'] == 'N'){ 
						echo '<button type="button" class="btn btn-success" id="btnRecDoc" onclick="RecepcionarEnvio('.$idSol.','.$idRut.','.$idUsuario.')">
								<i class="fa fa-check "></i> Recepcionar
							</button>';
					}
				?>
			 	<!--============================================ 
				BOTON : ADMITIR (Solo admite SECRETARIA GENERAL)
				=============================================-->
				<?php 
					if($idArea == 8){
						if($EdicionRuta['flgrecepcion'] == 'S' && $msolicitud['desest'] == 'Recibido'){
							echo '<button type="button" class="btn btn-success" id="btnAdmitir" onclick="Admitir('.$idSol.');">
									<i class="fa fa-check"></i> Admitir
								</button>';
						}
					}
				 ?>
				 <!--============================================ 
				BOTON : OBSERVAR (Solo observa SECRETARIA GENERAL)
				===============================================-->
				<?php 
					if($idArea == 8){
						if($EdicionRuta['flgrecepcion'] == 'S' && $msolicitud['desest'] == 'Recibido'){
							echo '<button type="button" class="btn btn-danger" id="btnObservar" onclick="Observacion();">
									<i class="fa fa-exclamation-circle "></i> Observar
								</button>';
						}
					}
				 ?>
				<!--============================================ 
				BOTON : ATENDER DOCUMENTO (todas las areas)
				==============================================-->
				<?php 
					if($EdicionRuta['flgrecepcion'] == 'S' && $msolicitud['desest'] == 'Admitido'){
						echo '<button type="button" class="btn btn-warning" id="btnAteDoc">
								<i class="fa fa-gavel"></i> Atender
							</button>';
					}
				 ?>
				<!--============================================ 
				BOTON : NOTIFICAR A DEMANDADO (SECRETARIA GENERAL)
				==============================================-->
				<?php 
					if($EdicionRuta['flgrecepcion'] == 'S' && $msolicitud['desest'] == 'Admitido' && $msolicitud['flgNotDem'] == 'N'){
						echo '<button type="button" class="btn btn-primary" id="btnNotDmd" onclick="NotificarDemandado('.$idSol.','.$idUsuario.');">
								<i class="fa fa-envelope"></i> Notificar a demandado
							</button>';
					}
				 ?>
				 <!--============================================ 
				BOTON : ASIGNAR ARBITRO (SECRETARIA GENERAL), debe haber respuesta(consultar con DR)
				==============================================-->
				<?php 
					if($EdicionRuta['flgrecepcion'] == 'S' && $msolicitud['desest'] == 'Admitido' && $msolicitud['flgNotDem'] == 'S'){
						echo '<button type="button" class="btn btn-primary" id="btnAsigArb" onclick="AsignarArbitro('.$idSol.','.$idUsuario.');">
								<i class="fa fa-user-plus"></i> Designación de Arbitros
							</button>';
					}
				 ?>
			</div>
		</div>        		 
	</div>
</div>
<!--==============================================
	MODAL : ASIGNACION DE ARBITRO
===============================================-->
<div class="modal fade" id="mdlAsignarArbitro" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
		        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus"></i> Asignación de Arbitro</h4>
		    </div>
		    <div class="modal-body" id="bodyAsignacionArbitro">
				<!-- CARGA DINAMICA -->		    	
		    </div>
		    <div class="modal-footer">
		    	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		    	<button type="button" class="btn btn-primary">Guargar</button>
		    </div>
		</div>
	</div>
</div>
<!--==============================================
	MODAL : RESPUESTA DE SOLICITUD
===============================================-->
<div class="modal fade" id="mdlRespuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Respuesta de Solicitud Arbitral</h4>
      </div>

      <div class="modal-body">
        <p class="text-center"><i class="fa fa-exclamation"></i> En construcción.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!--==============================================
	MODAL : DOCUMENTOS ANEXOS
===============================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdldocumentosAnexos">
	<div class="modal-dialog modal-dialog-centered" role="document">
   		<div class="modal-content">
	      	<div class="modal-header">

	        	<h5 class="modal-title"><i class="fa fa-tags"></i> Documentos Anexos</h5>
				<!--==============================================
					UNIR PDF: SOLICITUD DE ARBITRAJE
				===============================================-->
				<?php 
				$id    = explode("-", $_GET['id']);
				$idSol = $id[0];
				if(isset($idSol)){
   		 			$pdf ='';
					$id = $_GET['id'];
					$DocAnexos = $SolicitudAnexo->ListarSolicitudAnexo($idSol);
						foreach ($DocAnexos as $key => $value) {
							$pdf.=$value['nomFileSer'].',';
						}
				
					echo '<a href="/tramite/vistas/upload/unirPdf.php/?id='.$pdf.'" class="btn btn-warning" target="_blank">
						<i class="fa fa-download"> DESCARGAR TODO</i> 
					</a>';
					
					
				}
				?>
	      	</div>
	      	<div class="modal-body">
	      		<table class="table table-bordered">
      				<thead>
      					<tr class="text-center">
	      					<th width="10%">Item</th>
	      					<th width="30%">Archivo</th>
	      					<th width="60%">Acción</th>	
      					</tr>		      					
      				</thead>
      				<tbody>
      					<?php
      					$DocAnexos = $SolicitudAnexo->ListarSolicitudAnexo($idSol);
      					foreach ($DocAnexos as $key => $value) {
      						echo '<tr>
      								<td>'.$value['idAnexo'].'</td>
      								<td>'.$value['desanx'].'</td>
      								<td>
      									<a href="upload/'.$value['nomFileSer'].'" class="btn btn-warning" target="_blank">
      										<i class="fa fa-download"></i> '.$value['nomFileLoc'].'
      									</a></td>
      							  </tr>';	
      					}
      					?>
      				</tbody>
      			</table>
	      	</div>
	    </div>
	</div>
</div>
<!--==============================================
	MODAL : (DOCUMENTOS ADJUNTOS)
===============================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdldocumentosAdjuntos">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
   		<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title"><i class="fa fa-tags"></i> Documentos Adjuntos</h5>
	      	</div>
	      	<div class="modal-body">
      			<table class="table table-bordered">
      				<thead>
      					<tr class="text-center">
	      					<th width="5%">Item</th>
	      					<th width="25%">Área de Origen</th>
	      					<th width="65%">Detalles del envío</th>
	      					<th width="5%">( <i class="fa fa-file-text"></i> ) Adjunto</th>	
      					</tr>		      					
      				</thead>
      				<tbody>
      					<?php
							$DocAdjuntos = $solicitudrutas->ListarRutas($idSol);
							foreach ($DocAdjuntos as $key => $value) {
							echo '<tr>
									<td class="align-middle text-center">'.$value['idruta'].'</td>
									<td class="align-middle"><strong>'.$value['desareaenvio'].'</strong></td>
									<td class="align-middle">
										<strong>'.$value['asunto'].'</strong>
										<p>'.$value['contenido'].'</p>
										<p>Documento de Atención: '.$value['destipdoc'].' - '.$value['numdocint'].'</p>
									</td>
									<td class="align-middle">
										<a href="upload/'.$value['nomFileSer'].'" class="btn btn-warning" target="_blank">
											<i class="fa fa-download"></i> Descargar
										</a>
									</td>
	      						</tr>';
							}
      					 ?>
      				</tbody>
      			</table>
	      	</div>
    	</div>
    </div>
</div>
<!--==============================================
	MODAL : ADMITIR (Cambio DMS - 22/07/2020)
===============================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdlAdmitir">
	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">

      		<div class="modal-header">
        		<h5 class="modal-title"><i class="fa fa-files-o"></i> Admisión</h5>
      		</div>
	        <div class="modal-body">
		        <div class="form-row">
		        	<div class="col-sm-12">
		        		<div class="form-group">
		        			<label for="detinfo">Comentarios de Admisión</label>
		        			<textarea class="form-control" name="InfAtencion" id="InfAtencion" rows="3">
							
							</textarea>
		        		</div>
		        	</div>
		        	<div class="col-sm-12">
		        		<div class="form-group">
		        			<label for="">Carta de Admisión</label>
		        			<div class="custom-file">
		                    	<input type="file" class="custom-file-input" id="NomCarAdm" lang="es">
		                    	<label class="custom-file-label" for="NomArcReq">Seleccionar archivo</label>
		                	</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
      		<div class="modal-footer">
      			<button type="button" class="btn btn-light" data-dismiss="modal">CANCELAR</button>
        		<button type="button" class="btn btn-primary" onclick="GenerarAdmision(<?php echo $idSol ?>,<?php echo $idArea ?>,'SOLICITUD ADMITIDA',<?php echo $idUsuario ?>);">ADMITIR</button>
      		</div>
    	</div>
  	</div>
</div>
<!--==============================================
	MODAL OBSERVACION
===============================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdlObservacion">
	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title"><i class="fa fa-files-o"></i> Observación</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
      		<div class="modal-body">
		        <div class="form-row">
		        	<div class="col-sm-12">
		        		<div class="form-group">
		        			<label for="detinfo">Información de la observación</label>
		        			<textarea class="form-control" name="detinfo" id="detinfo" rows="5" placeholder="Ingrese el detalle de la observación"></textarea>
		        		</div>
		        	</div>
		        	<div class="col-sm-12">
		        		<div class="form-group">
		        			<label for="">Detalle de lo observado</label>
		        			<div class="custom-file">
		                    	<input type="file" class="custom-file-input" id="NomArcReq" lang="es">
		                    	<label class="custom-file-label" for="NomArcReq">Seleccionar archivo</label>
		                	</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-success" onclick="GenerarObservacion(<?php echo $idSol ?>,<?php echo $idArea ?>,'SOLICITUD OBSERVADA',<?php echo $idUsuario ?>);">
        			<i class="fa fa-thumbs-o-up"></i> Guardar
        		</button>

        		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-sign-out "></i> Salir</button>
      		</div>
    	</div>
  	</div>
</div>

<!--==============================================
	MODAL : ATENDER
===============================================-->
	<div class="modal fade" tabindex="-1" role="dialog" id="mdlAtendersolicitud">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <!--============================ TITULO ============================-->
	      <div class="modal-header">
	        <h5 class="modal-title"><i class="fa fa-tags"></i> Atención de Solicitud</h5>
	      </div>
	      <!--============================ CUERPO ============================-->
	      <div class="modal-body">
	        <div class="form-row">

	            <div class="col-sm-12" style = "display:none;" >
	                <div class="form-group row">
	                    <label for="" class="col-sm-4 col-form-label">Solicitud</label>
	                    <div class="col-sm-8">
	                        <input type="text" class="form-control" id="idSolicitud" name="idSolicitud" readonly="" value="<?php echo $idSol; ?>">
	                    </div>
	                </div>
	            </div>
	            
	            <div class="col-sm-12">
	                <div class="form-group row">
	                    <label for="" class="col-sm-4 col-form-label">Area de destino</label>
	                    <div class="col-sm-8">
	                        <select name="areaDestino" id="areaDestino" class="form-control">
	                        	<option value="0">Seleccionar</option>
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
	                            <input type="file" class="custom-file-input" id="NomArcReq_atencion" lang="es">
	                            <label class="custom-file-label" for="NomArcReq_atencion">Seleccionar archivo</label>
	                        </div>
	                    </div>
	                </div>
	            </div>

	        </div>
	      </div>
	      <!--============================ HERRAMIENTAS ============================-->
	      <div class="modal-footer">
	        <button type="button" id="btnGenerarEnvio" class="btn btn-primary" onclick="">ATENDER</button>
	      </div>
	    </div>
	  </div>
	</div>


<!-- ============================================================================
MODAL : RESUMEN DE ENVIO
===============================================================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdlResumen">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
        
	        <div class="modal-header">
	            <h5 class="modal-title"> Derivar Solicitud</h5>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	        </div>
	        
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
    	</div>
	</div>
</div>
 <?php 
	include_once 'componentes/footer.php';
?>