<?php 
/* Componentes HTML */
include_once 'componentes/header.php';
include_once 'componentes/navbar.php';
?>
<nav aria-label="breadcrumb" class="m-4">
    <ol class="breadcrumb migas">
        <li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-home"></i> Panel Principal</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Area</li>
    </ol>
</nav>
<div class="card m-4">
    <div class="card-body">
        <h2 class="titulo"><i class="fa fa-comment icoLogo"></i> Area</h2>        
        <div class="form-row">
            <div class="form-group col-lg-2 col-12">
                <input type="text" class="form-control" placeholder="Ingrese el nombre del area" id="desareaB" name ="desareaB">
            </div>
            <div class="form-group col-lg-2 col-12">
                <button type="button" class="btn btn-outline-success btn-block" id="btnBuscarArea">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
            <div class="form-group col-lg-2 col-12">
                <button class="btn btn-block btn-outline-danger" id="btnNuevoUsr">
                    <i class="fa fa-plus"></i> Nueva Area
                </button>
            </div>
        </div>

        <div class="table-responsive">
        <table class="table TablaSistema" id="tblArea" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th width="5%">Nro.</th>
                        <th width="50%">Área</th>
                        <th width="5%">Edición</th>
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
<div class="modal fade" id="mdlEditarArea" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

	        <div class="modal-header">
	            <h5 class="modal-title" id="mdlUsrTit"></h5>

    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
            	</button>
            </div>

            <div class="modal-body">

                <form method="POST" id="frmArea">

                    <input type="text" class="form-control" id="idArea" name ="idArea" style="display: none;">                    
                	<div class="form-row">
                		
                		<div class="col-sm-12">
                			<div class="form-group"> 
                             	<label>Nombre</label>
                                <input class="form-control" id="desarea" name="desarea" placeholder="Ingrese nombre del area">
                            </div>
                		</div>
          		
                	</div>
                </form>
            </div>

            <div class="modal-footer">
	            <button type="button" class="btn btn-success" id="btnGuardarArea"><i class="fa fa-thumbs-o-up"></i> Guardar </button> 
				<button type="button" class="btn btn-danger" data-dismiss = "modal"><i class="fa fa-sign-out"></i> Salir </button> 
            </div>
        </div>
    </div>
</div>
<!-- ============================================ -->
 <?php 
	include_once 'componentes/footer.php';
    
?>
<!-- libreria para llamar a los procesos de mantenimiento area -->
<script src="js/area.js" ></script>