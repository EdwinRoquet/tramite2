<?php
	/* Componentes HTML */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';
?>
<div class="card m-3">
    <div class="card-body">
        <h2 class="titulo"><i class="fa fa-edit icoLogo"></i> Mis Solicitudes</h2>
        <p class="subtitulo">Aquí podras realizar el seguimiento de tu Tramite.</p>

		
        <input type="text" value="<?php echo $idUsuario; ?>" hidden id="idUsuario" name="idUsuario">

        <!-- ENCABEZADOS DE LISTA -->
		<ul class="nav nav-tabs pnlRegistro"  id="myTab">
			<li class="nav-item"> <a class="nav-link active show" data-toggle="pill" data-target="#tabSol01"><i class="fa fa-search"></i> Solicitud de Arbitraje </a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabSol02"><i class="fa fa-search"></i> Medida Cautelar</a> </li>
	  	</ul>

	  	<div class="tab-content">
	  		<!-- Panel Casilla Electronica : Solicitudes de arbitraje -->
	  		<div role="tabpanel" class="tab-pane fade p-4 active show " id="tabSol01">
				<h5>Solicitud de Arbitraje</h5>
				<p>Aquí podras realizar el seguimiento de tu Solicitud de Arbitraje.</p>
				
				<div class="form-row">
					<!-- =================================================================== -->
					<div class="form-group col-lg-3 col-12">
						<input type="text" class="form-control" placeholder="Ingrese N° de solicitud a buscar" id="NumSolArb" name ="NumSolArb">
					</div>
					<!-- =================================================================== -->
					<div class="form-group col-lg-2 col-12">
						<button type="button" class="btn btn-success btn-block" id="btnBuscarSolArb">
							<i class="fa fa-search"></i> Buscar
						</button>
					</div>
					<!-- =================================================================== -->				
					<div class="form-group col-lg-2 col-12">
						<button class="btn btn-block btn-danger" id="btnNuevoSolArb">
							<i class="fa fa-plus"></i> Nueva Solicitud de Arbitraje 
						</button>
					</div>
				</div>
				<!-- *********************************************************************** -->
				<div class="form-row">
					<div class="form-group col-lg-12">
						<div class="table-responsive">
							<table class="table" id="tblCasillaElectronica" style="width:100%">
								<thead>
									<tr class="text-center">
										<th>Trámites</th>
										<th>Nro. de Solicitud</th>
										<th>Fecha de Solicitud</th>
										<th>Demandante</th>
										<th>Demandando</th>
										<th>Situación</th>
										<th>Estado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody class="respuestaBuscarSolArb">
									<!-- CONTENIDO AJAX -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div> <!-- fin Panel -->
			
			<div role="tabpanel" class="tab-pane fade p-4" id="tabSol02">
			<!-- Panel Medida Cautelar -->
				<h5>Medida Cautelar</h5>
				<p>Aquí podras realizar el seguimiento de tu Solicitud de Medida Cautelar.</p>
				<div class="form-row">
					<!-- =================================================================== -->
					<div class="form-group col-lg-2 col-12">
						<input type="text" class="form-control" placeholder="Ingrese N° de solicitud a buscar" id="NumMedCau" name ="NumMedCau">
					</div>
					<!-- =================================================================== -->
					<div class="form-group col-lg-2 col-12">
						<button type="button" class="btn btn-outline-success btn-block" id="btnBuscarMedCau">
							<i class="fa fa-search"></i> Buscar
						</button>
					</div>
					<!-- =================================================================== -->				
					<div class="form-group col-lg-2 col-12">
						<a href="medidacautelar.php" class="btn btn-block btn-outline-danger" id="btnNuevoMedCau">
						<i class="fa fa-plus"></i> Nueva Medida Cautelar </a>
					</div>
				</div>
				<!-- *********************************************************************** -->
				<div class="form-row">
					<div class="col">
						<hr>
					</div>
				</div>
				<!-- *********************************************************************** -->
				<div class="form-row">
					<div class="form-group col-lg-12">
						<div class="table-responsive">
							<table class="table " id="tblMedidaCautelar" style="width:100%">
								<thead>
									<tr class="text-center">
										<th>Nro. de Solicitud</th>
										<th>Fecha de Solicitud</th>
										<th>Demandante</th>
										<th>Demandando</th>
										<th>Situación</th>
										<th>Estado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody class="respuestaBuscarMedCau">
									<!-- CONTENIDO AJAX -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
	  	</div>
    </div>
</div>

<!-- =======================================================
     MODAL : HISTORIAL DE ANEXOS
     ======================================================== -->
<div class="modal fade" id="MdlHistorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
	        <div class="modal-header">
	            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-copy"></i> Anexos</h5>
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
            	</button>
            </div>
            <div class="modal-body" id="bodyAnexos"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss = "modal"> Salir </button> 
            </div>
        </div>
    </div>
</div>
<!-- =======================================================
     MODAL : REGISTRO DE TRAMITE
     ======================================================== -->
<div class="modal fade" id="MdlTramite" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        	<form method="POST" id="frmtramite" enctype="multipart/form-data">

				<!-- modal header -->
				<div class="modal-header">
		            <h5 class="modal-title"><i class="fa fa-copy"></i> Nuevo Tramite</h5>
	    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	            	</button>
	            </div>

	            <!-- modal body -->
		        <div class="modal-body">
	            	<p>Registra aqui un tramite asociado a tu solicitud.</p>
	            	<div class="form-row">
	            		<!-- ------------------------------------------------------------------------------- -->
	            		<div class="col-sm-12" style="display: none;">
	            			<div class="form-group">
			            		<label for="">Id Solicitud</label>
			            		<input class="form-control" type="text" id="idsolicitud" name="idsolicitud" readonly>
			            	</div>
	            		</div>
	            		<div class="col-sm-12">
			            	<div class="form-group">
			            		<label for="">Sumilla</label>
			            		<select class="form-control" name="idsumilla" id="idsumilla">
								<option value="0">Seleccione Sumilla</option>
								<?php  
								foreach ($MTipoSolicitud as $key => $value) {
									echo '<option value="'.$value['id'].'">'.$value['destipsol'].'</option>';
								}
								?>
			            		</select>
			            	</div>	
			            </div>
			            <!-- ------------------------------------------------------------------------------- -->
	            		<div class="col-sm-12">
	            			<div class="form-group" id="divformato" style="display: none;">
	            				<label for="">Formato de Registro</label>
	            				<a href="formatos/Formato_Respuesta_Solicitud_Arbitraje.pdf" class="btn btn-outline-info btn-block" download="Formato_Respuesta_Solicitud_Arbitraje"><i class="fa fa-download"></i> descargar</a>
	            			</div>	

	            			<div class="form-group" id="divnomtra" style="display: none;">
	            				<label for="">Nombre de Tramite</label>
	            				<input class="form-control" type="text" id="nomtramite" name="nomtramite" placeholder="Ingrese el nombre del Tramite">
	            			</div>	
	            		</div>
	            		<!-- ------------------------------------------------------------------------------- -->
	            		<div class="col-sm-12">
	            			<div class="form-group">
	            				<label for="">Referencia</label>
	            				<input class="form-control" type="text" id="referencia" name="referencia">
	            			</div>
	            		</div>
	            		<!-- ------------------------------------------------------------------------------- -->
	            		<div class="col-sm-12">
	            			<div class="form-group">
	            				<label for="detalle">Detalle</label>
	            				<textarea class="form-control" name="detalle" id="detalle" cols="30" rows="5"></textarea>
	            			</div>	
	            		</div>
	            		<!-- ------------------------------------------------------------------------------- -->
	            		<div class="col-sm-12">
	            			<label for="">Adjuntar Archivo</label>
	            		</div>
	            		<!-- ------------------------------------------------------------------------------- -->
	            		<div class="col-sm-12">
	            			<div class="form-group">
	            				<div class="custom-file">
                                	<input type="file" class="custom-file-input" id="ArchivoAdjunto" name ="ArchivoAdjunto" lang="es">
                                	<label class="custom-file-label" for="ArchivoAdjunto">Seleccionar archivo</label>
                            	</div>
	            			</div>
	            		</div>
            			<!-- ------------------------------------------------------------------------------- -->
            		</div>
	            </div>
		        <div class="modal-footer">
	            	<button type="button" onclick="RegistrarTramite();" id="btnRegistrarTramite" class="btn btn-danger"> Registrar Trámite </button>
	            </div>
		    </form>
        </div>
    </div>
</div>
<!-- =======================================================
     MODAL : LISTADO DE TRAMITES
     ======================================================== -->
<div class="modal fade" id="MdlTramiteLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
	        <div class="modal-header">
	            <h5 class="modal-title"><i class="fa fa-envelope-o"></i> Listado de Trámites</h5>
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
            	</button>
            </div>
            <div class="modal-body" id="ContenidoListadoTramites">
            	
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss = "modal"> Salir </button> 
            </div>
        </div>
    </div>
</div>

<?php 
include_once 'componentes/footer.php';
?>