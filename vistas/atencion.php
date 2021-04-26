<?php 
/* --------------------------- Componentes HTML --------------------------- */
include_once 'componentes/header.php';
include_once 'componentes/navbar.php';

?>
<nav aria-label="breadcrumb" class="m-3">
    <ol class="breadcrumb migas">
        <li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-home"></i> Panel Principal</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Atención de Solicitud</li>
    </ol>
</nav>

 <div class="card m-3">
 	<div class="card-body">
        <h2 class="titulo"><i class="fa fa-edit"></i> Atención de Solicitudes</h2>
        <p class="subtitulo">Consulte aquí las solicitudes derivadas a su área</p>

        <input type="text" id="usuarioOrigen" name="usuarioOrigen" class="form-control" value="<?php echo $idUsuario ?>" style="display: none;">
        <input type="text" id="areaOrigen" name="areaOrigen" class="form-control" value="<?php echo $idArea ?>" style="display: none;">
 					
        <div class="form-row">
            <div class="form-group col-lg-2 col-12">
                <input type="text" class="form-control" placeholder="Nro de Solicitud" id="NumSol" name ="NumSol">
            </div>
            <div class="form-group col-lg-2 col-12">
                <select class="form-control" name="cboRecepcionado" id="cboRecepcionado">
                	<option value="N">PENDIENTE</option>
                	<option value="S">RECEPCIONADO</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-12">
                <button type="button" class="btn btn-success btn-block" id="btnBuscarDocPend">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
        </div>
        <div class="table-responsive">
        	<table class="table TablaSistema" id="tblAtencion" style="width: 100%">
				<thead>
 					<tr class="text-center">
 						<th width="5%">Nro.</th>
 						<th width="10%">Nro de Solicitud</th>
 						<th width="15%">Fecha y hora de Envio</th>
 						<th width="25%">Area Origen</th>
                        <th width="20%">Asunto</th>
                        <th width="10%">Estado</th>
                        <th width="5%">¿Recepcionado?</th>
                        <th width="5%">Acciones</th>
 					</tr>
				</thead>
				<tbody>
				<!-- CARGADO POR AJAX -->
				</tbody>
			</table>
        </div>
    </div>
</div> <!-- card -->

<?php 
	include_once 'componentes/footer.php';
?>