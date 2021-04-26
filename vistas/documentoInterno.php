<?php 
/* Componentes HTML */
include_once 'componentes/header.php';
include_once 'componentes/navbar.php';
?>
<nav aria-label="breadcrumb" class="m-4">
    <ol class="breadcrumb migas">
        <li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-home"></i> Panel Principal</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Documentos Internos</li>
    </ol>
</nav>
<div class="card m-4">
	<div class="card-body">	
	   <h2 class="titulo"><i class="fa fa-file-text-o icoLogo"></i> Documentos Internos</h2>
	   <p class="subtitulo">Relación de Documentos Internos</p>

    	<div class="form-row">
            <div class="form-group col-lg-2 col-12">
                <input type="text" class="form-control" placeholder="Ingrese el nombre del documento" id="NomDocInt" name ="NomDocInt">
            </div>
            <div class="form-group col-lg-2 col-12">
                <button type="button" class="btn btn-outline-success btn-block" id="btnBuscarDocInt">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
            <div class="form-group col-lg-2 col-12">
                <button class="btn btn-block btn-outline-danger" id="btnNuevoDocInt">
                    <i class="fa fa-plus"></i> Nuevo Documento Interno
                </button>
            </div>
        </div>

        <div class="table-responsive">
			<table class="table TablaSistema" id="tblDocumentosInternos" style="width: 100%">
				<thead>
					<tr>
						<th width="5%">Nro.</th>
						<th width="70%">Nombre de Documento Interno</th>
						<th width="5%">Estado</th>
                        <th width="10%">Alta</th>
						<th width="10%">Edición</th>
					</tr>
				</thead>
				<tbody>
				<!-- CARGADO POR AJAX -->
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- =========================================
MODAL : EDICION
============================================-->
<div class="modal fade" id="mdlEditardocumentoInterno" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">

	        <div class="modal-header">
	            <h5 class="modal-title" id="mdlDocIntTit"></h5>

    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
            	</button>
            </div>

            <div class="modal-body">

                <form method="POST" id="frmDocumentoInterno">

                    <input type="text" class="form-control" id="idDocInt" name ="idDocInt" style="display: none;">                    

                	<div class="form-row">
                		<div class="col-sm-12">
                			<div class="form-group"> 
                             	<label>Nombre de Documento Interno</label>
                                <input class="form-control" id="nomdocint" name="nomdocint" placeholder="Ingrese el nombre del documento interno">
                            </div>
                		</div>
                	</div>

                </form>
            </div>

            <div class="modal-footer">
	            <button type="button" class="btn btn-success" id="btnGuardarDocInt"><i class="fa fa-thumbs-o-up"></i> Guardar </button> 
				<button type="button" class="btn btn-danger" data-dismiss = "modal"><i class="fa fa-sign-out"></i> Salir </button> 
            </div>
        </div>
    </div>
</div>

 <?php 
	include_once 'componentes/footer.php';
?>