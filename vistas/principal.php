<?php  
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';
?>
<nav aria-label="breadcrumb" class="m-3">
    <ol class="breadcrumb migas">
        <li class="breadcrumb-item">Panel Principal</li>
    </ol>
</nav>
<div class="card m-3">
	<div class="card-body">
		<h2 class="titulo"><i class="fa fa-home"></i> Panel Principal </h2>
		<p class="subtitulo">Opciones principales</p>
		<div class="form-row">
		
		<!-- ============================================================================== -->
		<?php 
		
		/* --------------------------- Administración de Usuarios--------------------------- */	  
		if($datausuario['flgusuario']=='S'){
		echo '<div class="col-12 col-md-6 col-lg-4">
					<div class="card-body">
						<h5 class="card-title titPage"><i class="fa fa-user icoLogo"></i> Usuarios</h5>
						<p class="card-text">Crear y Editar información de usuarios con accesos al sistema...</p>
					</div>
					<div class="card-footer">
						<a href="usuarios.php" class="btn btn-danger pull-right">
							<i class="fa fa-check-circle-o"></i> Administrar
						</a>
					</div>
			 </div>';
		}
		/* ------------------------- Administración de Doc internos ------------------------- */
		if($datausuario['flgdocinterno']=='S'){
		echo '<div class="col-12 col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title titPage"><i class="fa fa-file-text-o icoLogo"></i> Documentos internos</h5>
						<p>Crear y Editar información de tipos de documentos.</p>
					</div>
					<div class="card-footer">
						<a href="documentoInterno.php" class="btn btn-success pull-right">
							<i class="fa fa-check-circle-o"></i> Administrar
						</a>
					</div>
				</div>
			 </div>';
		}
		/* --------------------------------- Mesa de Partes --------------------------------- */
		if($datausuario['flgmesapartes']=='S'){
		echo '<div class="col-12 col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title titPage"><i class="fa fa-recycle icoLogo"></i> Mesa de Partes</h5>
						<p>Recepcione aqui solicitudes generadas por el sistema.</p>					
					</div>
					<div class="card-footer">
						<a href="recepcion.php" class="btn btn-danger pull-right">
							<i class="fa fa-check-circle-o"></i> Administrar
						</a>
					</div>
				</div>
			</div>';
		  }
		/* ------------------------------ Atención de Solicitud ------------------------------ */
		if($datausuario['flgatencion']=='S'){
		echo '<div class="col-12 col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title titPage"><i class="fa fa-edit icoLogo"></i> Atención de solicitud</h5>
						<p>Atienda aqui solicitudes generadas por el sistema.</p>
					</div>
					<div class="card-footer">
						<a href="atencion.php" class="btn btn-warning pull-right">
							<i class="fa fa-check-circle-o"></i> Administrar
						</a>
					</div>
				</div>
		   </div>';
		  }
		/* ------------------------------------ Atendidos ------------------------------------ */
		if($datausuario['flgatendidos']=='S'){
		echo '<div class="col-12 col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title titPage"><i class="fa fa-graduation-cap icoLogo"></i> Solicitudes atendidas</h5>
						<p>Verifique aqui las solicitudes atendidas por su area.</p>
					</div>
					<div class="card-footer">
						<a href="atendidos.php" class="btn btn-success pull-right"><i class="fa fa-check-circle-o"></i> Administrar</a>
					</div>
				</div>
			</div>';
		  }
 		?>
 		</div>
	</div>
</div>

<?php 
	include_once 'componentes/footer.php';
?>
