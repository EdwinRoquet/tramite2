<?php
	/* Componentes HTML */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';
?>
<div class="card m-3">
    <div class="card-body">

        <h2 class="titulo"><i class="fa fa-users"></i> Procesos en Demanda</h2>
        <p class="subtitulo">Aquí podrás realizar un seguimiento de los procesos en demanda asociados.</p>
        <input type="text" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario; ?>" hidden>

        <!-- ENCABEZADOS DE LISTA -->
		<ul class="nav nav-tabs pnlRegistro">
			<li class="nav-item"> <a class="nav-link active show" data-toggle="pill" data-target="#tabSol01"><i class="fa fa-search"></i> Solicitud de Arbitraje </a> </li>
	  	</ul>

	  	<div class="tab-content">
	  		<!-- Panel Casilla Electronica : Solicitudes de arbitraje -->
	  		<div role="tabpanel" class="tab-pane fade p-4 active show " id="tabSol01">
				<h5>Procesos en Demanda (Solicitudes de Arbitraje)</h5>
				<p>Lista de Procesos en Demanda.</p>
				
				<div class="form-row">
					<!-- =================================================================== -->
					<div class="form-group col-sm-2 col-12">
						<input type="text" class="form-control" placeholder="Ingrese N° de solicitud a buscar" id="NumSolArbDem" name ="NumSolArbDem">
					</div>
					<!-- =================================================================== -->
					<div class="form-group col-sm-2 col-12">
						<button type="button" class="btn btn-outline-success btn-block" id="btnBuscarSolArbDem" onclick="BuscarSolicitudPendienteRespuesta();">
							<i class="fa fa-search"></i> Buscar
						</button>
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
							<table class="table" id="tblSolicitudArbitralDem"  style="width:100%">
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
								<tbody class="respuestaBuscarSolArbDem">
									<!-- CONTENIDO AJAX -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div> <!-- fin Panel -->
		</div>
    </div>
</div>
<?php 
include_once 'componentes/footer.php';
?>