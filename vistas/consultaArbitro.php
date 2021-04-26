<?php
	/* Componentes HTML */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';
    $dataDesignacionArbitro = array();
    if(!empty($_POST)){
        // Registrar detalle de designaciones ---------------------------------
        if(isset($_POST["desiganacionArbitro"])){
            foreach($_POST["desiganacionArbitro"] as $p){
                $designacion= json_decode($p);
                array_push($dataDesignacionArbitro, $designacion);
            }    
        }

        if(isset($dataDesignacionArbitro)){
            // Agregar aqui todas las designaciones
            foreach ($dataDesignacionArbitro as $value) {  
                $id_solicitud     = $value->id_solicitud; 
                $nombre     = $value->nombre;
                $direccion  = $value->direccion;
                $celular    = $value->celular;
                $mail       = $value->mail;
                $profesion  = $value->profesion;
                $n_colegiatura = $value->n_colegiatura;
                $osce          = $value->osce;
                $tipo_arbitro  = $value->tipo_arbitro;
                $SolicitudAsignacionArbitro->NuevaSolicitudArbitral($id_solicitud,$nombre,$direccion,$celular,$mail,$profesion,$n_colegiatura,$osce,$tipo_arbitro);
            }
        }
    }
?>
<div class="card m-3">
    <div class="card-body">
        <h2 class="titulo"></i> Asignación de Arbitros</h2>
       
        <input type="text" value="<?php echo $idUsuario; ?>" hidden id="idUsuario" name="idUsuario">

        <!-- ENCABEZADOS DE LISTA -->
		<ul class="nav nav-tabs pnlRegistro"  id="myTab">
			<li class="nav-item"> <a class="nav-link active show" data-toggle="pill" data-target="#tabSol01"><i class="fa fa-search"></i> Asignación de Arbitros </a> </li>
	  	</ul>

	  	<div class="tab-content">
	  		<!-- Panel Casilla Electronica : Solicitudes de arbitraje -->
	  		<div role="tabpanel" class="tab-pane fade p-4 active show " id="tabSol01">
				<h5>Solicitud de Arbitraje</h5>
				
				
				<div class="form-row">
					<!-- =================================================================== -->
					<div class="form-group col-lg-3 col-12">
						<input type="text" class="form-control" placeholder="Ingrese N° de solicitud a buscar" id="NumSolArb" name ="NumSolArb">
					</div>
					<!-- =================================================================== -->
					<div class="form-group col-lg-2 col-12">
						<button type="button" class="btn btn-success btn-block" id="btnBuscarSolArbAdmitidas">
							<i class="fa fa-search"></i> Buscar
						</button>
					</div>
					<!-- =================================================================== -->				
				
				</div>
				<!-- *********************************************************************** -->
				<div class="form-row">
					<div class="form-group col-lg-12">
						<div class="table-responsive">
							<table class="table" id="tblCasillaElectronicaAdmitidas" style="width:100%">
								<thead>
									<tr class="text-center">
										
										<th>Nro. de Solicitud</th>
										<th>Fecha de Solicitud</th>
										<th>Demandante</th>
										<th>Demandando</th>
										<th>Estado</th>
										<th>Asignar</th>
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
			
            
		
	  	</div>
    </div>
</div>

<!-- =======================================================
     MODAL : ASIGNACION DE ARBITRO
     ======================================================== -->
<div class="modal fade" id="MdlArbitro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="width: 1204px;">
	        <div class="modal-header">
	            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-copy"></i>  Designación de Árbitro</h5>
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
            	</button>
            </div>
            
            <div class="modal-body">
            <form method="POST" id="formEnvioConsultaArbiro" action="consultaArbitro.php"  class="frmSolicitudArbitro">
                <div class="form-row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header font-weight-bold">
                                        Designación de Árbitro
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <input type="hidden" class="form-control" id="id_solicitud" name="id_solicitud">
                                                <input type="hidden" class="form-control" id="idDesArbitroEdit" name="idDesArbitroEdit">
                                                <div class="form-group"><label>Nombre de Árbitro</label>
                                                    <input type="text" class="form-control" id="txtApeNomArb" name = "ApeNomArb" placeholder="Ejemplo:Juan Carlos Montenegro Vega"></input>
                                                    <span style="color:red" id="errorNombre"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"><label>Dirección</label>
                                                    <input type="text" class="form-control" id="txtDesDirArb" name = "DesDirArb" placeholder="Ejemplo: Los Manzanos N° 125 - Residencial San Luis, distrito de San Borja,  provincia y región de Lima"></input>
                                                   
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group"><label>Celular</label>
                                                    <input type="text" class="form-control input_tel" id="txtNumTelArb" name = "NumTelArb" placeholder="Ejemplo: 999999999"></input>
                                                    <span style="color:red" id="errorCelular"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group"><label>Correo electrónico</label>
                                                    <input class="form-control" name = "DirEmaArb" id="txtDirEmaArb" placeholder="Ejemplo: juan59@outlook.com"></input>
                                                    <span style="color:red" id="errorCorreo"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group"><label>Profesión</label>
                                                    <input type="text" class="form-control" id="txtNomProArb" name = "NomProArb" placeholder="Ingrese una profesión"></input>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group"><label>N° Colegiatura</label>
                                                    <input type="text" class="form-control" id="txtNumColArb" name = "NumColArb" placeholder="Ingrese el número de colegiatura"></input>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group"><label>Tipo de Arbitro</label>
                                                    <select class="form-control" id="txtTipoArbitro"> 
                                                        <option value="Presidente Arbitral">Presidente Arbitral</option>
                                                        <option value="Arbitro">Arbitro</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <label>¿Esta inscrito en Registro de Árbitros (OSCE)?</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="FlgRegArb" name ="FlgRegArb" value="Yes">
                                                        <label class="form-check-label" for="FlgRegArb">
                                                            Si
                                                        </label>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="form-group col-lg-2 col-12">
                                                            <button type="button" style="margin-left: 300px;" class="btn btn-outline-success btn-block btnAgregarArbitro" id="btnAgregarAnxArbitro">
                                                                <i class="fa fa-plus"></i> Agregar 
                                                            </button>
                                            </div>

                                        </div>

                                        <table class="table" id="tbListadoArbitro">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre del Arbitro</th>
                                                    <th scope="col">Dirección</th>
                                                    <th scope="col">Tipo de Arbitro</th>
                                                    <th scope="col">Registro OSCE</th>
                                                    <th scope="col">Acciones</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    <!-- Peticion ajax del listado de arbitro designados temporales-->
                                                </tbody>
                                            </table>
                                            <div class="col-md-12 col-sm-12 text-center">
                                                <button type="submit" class="btn btn-success btnRegistrar">
                                                    <i class="fa fa-save"></i> Guardar
                                                </button>
                                            </div><br>
                                            <div class="card">
                                                <div class="card-header font-weight-bold">
                                                    Listado de Árbitro Asignados la solicitud 
                                                </div>
                                                    <div class="card-body">
                                                        <table class="table table-striped" id="tbListadoArbitroAsignada">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Nombre del Arbitro</th>
                                                                    <th scope="col">Dirección</th>
                                                                    <th scope="col">Celular</th>
                                                                    <th scope="col">Mail</th>
                                                                    <th scope="col">Profesión</th>
                                                                    <th scope="col">Colegiatura</th>
                                                                    <th scope="col">Registro OSCE</th>
                                                                    <th scope="col">Tipo de Arbitro</th>
                                                                    <th scope="col">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Peticion ajax del listado de arbitro designados-->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss = "modal"> Salir </button> 
            </div>
        </div>
    </div>
</div>


<?php 
include_once 'componentes/footer.php';
?>