<?php
/*  --------------------------- Componentes HTML --------------------------- */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb migas m-4">
        <li class="breadcrumb-item"><a href="consulta.php"><i class="fa fa-edit"></i> Mis Solicitudes</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Solicitud de Árbitraje Manual</li>
    </ol>
</nav>
<div class="card m-4">
    <div class="card-body">
        <h2 class="titulo"> <i class="fa fa-file"></i> Solicitud de Árbitraje</h2>
        <p class="subtitulo">Genere aqui su Solicitud para proceso de Árbitraje <strong>Manual</strong></p>

        <!-- ENCABEZADOS DE LISTA -->
        <ul class="nav nav-tabs pnlRegistro">
            <li class="nav-item"> 
            	<a class="nav-link active show" data-toggle="pill" data-target="#tabRegistro">
            		<i class="fa fa-file"></i> Registro de Solicitud Manual
            	</a>
            </li>
        </ul>
        <form method="POST" enctype="multipart/form-data" id="frmSolManual">
        	<div class="tab-content">
                <div role="tabpanel" class="tab-pane fade p-3 active show" id="tabRegistro">
                	<div class="form-row">
                		<div class="col-sm-12">
                			<div class="card">
                				<div class="card-header font-weight-bold">
                					Registro de Solicitud
                					<p class="m-0">Detalle de Solicitud</p>
                				</div>
                				<div class="card-body">
                					<div class="form-row">
                                        <input id="idUsuario" name="idUsuario" class="form-control" value="<?php echo $idUsuario; ?>" hidden>
                                        <input id="mailUsuario" name="mailUsuario" class="form-control" value="<?php echo $mailUsuario; ?>" hidden>
                						<!-- ---------------------------------------------------------------------------------------------------------------------- -->
                						<div class="col-sm-4">
                                            <div class="form-group"><label>Nombre o Razón Social de <strong>DEMANDANTE</strong></label>
                                                <input class="form-control" id="RazSocDem" name="RazSocDem" placeholder="Ejemplo: Juan Carlos Montenegro Vega">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Tipo de Doc. de Identidad</label>
                                                <select id="TipDocDem" name="TipDocDem" class="form-control cbo">
                                                	<option value="">Seleccionar</option>
                                                <?php 
                                                    foreach ($MTipDoc as $key => $value) {
                                                        echo '<option value="'.$value["id"].'">'.$value["tipdoc"].'</option>';
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group"> <label>Número de Documento</label>
                                                <input class="form-control input_num" id="txtNumDocDem" name="txtNumDocDem" maxlength="11" placeholder="Ingrese número de documento">
                                                <div id="msgval1" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <!-- ---------------------------------------------------------------------------------------------------------------------- -->
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>Nombre o Razón Social de <strong>DEMANDADO</strong></label>
                                                <input class="form-control" id="RazSocDmd" name="RazSocDmd" placeholder="Ejemplo: Juan Carlos Montenegro Vega">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Tipo de Doc. de Identidad</label>
                                                <select id="TipDocDmd" name="TipDocDmd" class="form-control cbo">
                                                	<option value="">Seleccionar</option>
                                                <?php 
                                                    foreach ($MTipDoc as $key => $value) {
                                                        echo '<option value="'.$value["id"].'">'.$value["tipdoc"].'</option>';
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group"> <label>Número de Documento</label>
                                                <input class="form-control input_num" id="txtNumDocDmd" name="txtNumDocDmd" maxlength="11" placeholder="Ingrese número de documento">
                                                <div id="msgval3" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Correo Electrónico </label>
                                                <input class="form-control" id="DirEmaDmd" name="DirEmaDmd" placeholder="Ejemplo: juan59@outlook.com">
                                            </div>
                                        </div>

                					</div>
                				</div>                                
                			</div> <!-- fin card-->
                		</div><!-- fin col-sm-12 -->
                		<div class="col-sm-12 mt-2">
                			<div class="card">
                				<div class="card-header font-weight-bold">
                					Formato de inicio de procedimiento
                					<p class="m-0">Descarge el siguiente formato de solicitud, complete la información, firme el documento y cargelo por la opción "Cargar Solicitud"</p>
                				</div>
                				<div class="card-body">
                					<div class="form-row">
                						<div class="col-sm-6">
                							<a href="formatos/Modelo-de-Solicitud-de-Arbitraje-CEAR-LATINOAMERICANO.docx" class="btn-link" target="_blank" download><i class="fa fa-link"></i> SOLICITUD DE INICIO DE PROCEDIMIENTO ARBITRAL</a>
                						</div>
                						<div class="col-sm-6">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="NomFilSolMan" name="NomFilSolMan" lang="es">
                                                <label class="custom-file-label" for="NomFilSolMan">Cargar Solicitud</label>
                                            </div>
                						</div>
                					</div>
                				</div>
                				<div class="card-footer">
                					<div class="form-row">
                                        <div class="col-sm-6">
                                            <label><span class="obligatorio"><i class="fa fa-check"></i> La información consignada en esta página es de carácter OBLIGATORIO.</span></label>
                                        </div>
                						<div class="col-sm-6 text-right">
                							<button type="button" class="btn btn-success"  id="btnGrabarSolicitudManual" >
                								<i class="fa fa-save"></i> Generar Solicitud de Árbitraje
                							</button>
                						</div>
                					</div>
                				</div>
                			</div>
                		</div>
                	</div>
                </div>
            </div>
        </form>
     </div>
 </div>

 <!-- ------------------------------- MODAL VALIDACIONES ---------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="mdlValidaSolicitudManual">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
	   	    <div class="modal-header">
		        <h5 class="modal-title"><i class="fa fa-warning"></i> Campos observados</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        	<span aria-hidden="true">&times;</span>
		        </button>
		    </div>
   
      		<div class="modal-body" id="MdlMensajeValidacion"></div>
      
      		<div class="modal-footer">
        		<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      		</div>
		</div>
  	</div>
</div>

<?php  
	include_once 'componentes/footer.php';
?>