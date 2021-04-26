<?php 
/* --------------------------- Componentes HTML --------------------------- */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';

?>
<nav aria-label="breadcrumb" class="mt-3 mr-3 ml-3 mb-0">
    <ol class="breadcrumb migas">
        <li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-edit"></i> Panel Principal</a></li>
        <li class="breadcrumb-item"><a href="recepcion.php"><i class="fa fa-envelope-o"></i> Mesa de Partes</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Detalle de Medida Cautelar</li>
    </ol>
</nav>

<div class="card mt-0 ml-3 mr-3">
   	<div class="card-body">
		<?php 
		if(isset($_GET['id'])){

			if(is_numeric($_GET['id'])){
   		 						
				$id = $_GET['id'];

		 		// Si la solicitud existe entonces se cargara los datos en el navegador
		        $Solicitud = $Solicitud->EditarSolicitud_v2($id);
		        $MSolicitudPretension = $SolicitudPretension->ListarSolicitudPretension($id);	        
		        $MSolicitudAnexo = $SolicitudAnexo->ListarSolicitudAnexo($id);
		    }
		}
		?>
		<input type="text" id="usuarioOrigen" name="usuarioOrigen" class="form-control" value="<?php echo $idUsuario; ?>" style="display: none;">
   		<input type="text" id="areaOrigen" name="areaOrigen" class="form-control" value="<?php echo $idArea; ?>" style="display: none;">

		<h2 class="titulo"> <i class="fa fa-book"></i> Medida Cautelar </h2>
		<br>
		<ul class="nav nav-tabs pnlRegistro">
            <li class="nav-item"> <a class="nav-link active show" data-toggle="pill" data-target="#tabPeticionante"><i class="fa fa-arrow-right"></i> Peticionante</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabDirDemanda"><i class="fa fa-arrow-right"></i> Dirección de la Demanda </a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabPretension"><i class="fa fa-arrow-right"></i> Pretensión Cautelar</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabValidez"><i class="fa fa-arrow-right"></i> Validez o Existencia</a></li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabEjecucion"><i class="fa fa-arrow-right"></i> Forma de Ejecución</a></li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabExcepcion"><i class="fa fa-arrow-right"></i> Excepción de conocimiento</a></li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabFundamento"><i class="fa fa-arrow-right"></i> Fundamento de Hechos</a></li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabPresupuesto"><i class="fa fa-arrow-right"></i> Presupuestos</a></li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabAdicionales"><i class="fa fa-arrow-right"></i> Presupuestos Adicionales</a></li>
            <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabAnexos"><i class="fa fa-arrow-right"></i> Anexos</a></li>
        </ul>
		<!-- ====================================================================== -->
		<div class="tab-content">
        		<div role="tabpanel" class="tab-pane fade p-3 active show" id="tabPeticionante">
        			<div class="form-row">
        				<div class="col-sm-5">
        					<div class="card">
        						<div class="card-header font-weight-bold">
                                    Datos de Peticionante
                                    <p class="m-0">Datos del peticionante del pedido cautelar.</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Nombre o Razón Social</label>
                                                <input class="form-control" id="RazSocDem" name="RazSocDem" value="<?php echo $Solicitud['RazSocDem']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Tipo de Documento de Identidad</label>
                                                <input id="TipDocDem" name="TipDocDem" class="form-control" value="<?php echo $Solicitud['DesTipDocDem']; ?>" readonly>
                                            </div>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="form-group"> <label>Número de Documento</label>
                                                <input class="form-control input_num" id="NumDocDem" name="NumDocDem" maxlength="11" value="<?php echo $Solicitud['NumDocDem']; ?>" readonly>
                                                <div id="msgval1" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Domicilio de la persona natural o jurídica</label>
                                                <input class="form-control" id="DesDirDem" name="DesDirDem" value="<?php echo $Solicitud['DesDirDem']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>La factura o boleta se deberá de emitir a nombre de:</label>
                                                <input class="form-control" id="RazSocEmiCom" name="RazSocEmiCom" value="<?php echo $Solicitud['RazSocEmiCom']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        					</div>
        				</div>
        				<div class="col-sm-7">
        					<div class="card">
        						<div class="card-header font-weight-bold">
                                    Representante Legal
                                    <p class="m-0">Datos del representante legal.</p>
                                </div>
                                <div class="card-body">
                                	<div class="form-row">
                                		<div class="col-sm-12">
                                            <div class="form-group"> <label>Representante legal</label>
                                                <input class="form-control" id="ApeNomLeg" name="ApeNomLeg" value="<?php echo $Solicitud['ApeNomLeg']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>N° DNI</label>
                                                <input class="form-control" id="NumDocRep" name="NumDocRep" value="<?php echo $Solicitud['NumDocRep']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>N° Teléfono</label>
                                                <input class="form-control" id="NumTelRep" name="NumTelRep" value="<?php echo $Solicitud['NumTelRep']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>N° Celular</label>
                                                <input class="form-control" id="NumCelRep" name="NumCelRep" value="<?php echo $Solicitud['NumCelRep']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Facultado según</label>
                                                <input class="form-control" id="EscPubDem" name="EscPubDem" value="<?php echo $Solicitud['EscPubDem']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Correo electrónico</label>
                                                <input class="form-control" id="DirEmaRep" name="DirEmaRep" value="<?php echo $Solicitud['DirEmaRep']; ?>" readonly>
                                            </div>
                                        </div>
                                	</div>
                                </div>
                                <div class="card-footer">
                                	<div class="form-row">
                                        <div class="col-sm-12 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        			</div>	
        		</div> <!-- fin panel : tabPeticionante -->
        		<div role="tabpanel" class="tab-pane fade p-3" id="tabDirDemanda">
        			<div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Dirección de la Demandada
                                    <p class="m-0">Detalles de Dirección</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                    	<div class="col-sm-6">
                                            <div class="form-group"> <label>Nombre o Razón Social</label>
                                            <input class="form-control" id="RazSocDmd" name="RazSocDmd" value="<?php echo $Solicitud['RazSocDmd']; ?>" readonly>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Domicilio</label>
                                            <input class="form-control" id="DesDirDmd" name="DesDirDmd" value="<?php echo $Solicitud['DesDirDmd']; ?>" readonly>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Teléfono</label>
                                            <input class="form-control" id="NumTelDmd" name="NumTelDmd" value="<?php echo $Solicitud['NumTelDmd']; ?>" readonly>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Celular</label>
                                            <input class="form-control" id="NumCelDmd" name="NumCelDmd" value="<?php echo $Solicitud['NumCelDmd']; ?>" readonly>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Correo Electrónico</label>
                                            <input class="form-control" id="DirEmaDmd" name="DirEmaDmd" value="<?php echo $Solicitud['DirEmaDmd']; ?>" readonly>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                	<div class="form-row">
	                                	<div class="col-sm-6">
	                                            <button type="button" class="btn btn-success anterior">
	                                                <i class="fa fa-backward"></i> Anterior 
	                                            </button>
	                                         </div> 
	                                	<div class="col-sm-6 text-right">
	                                        <button type="button" class="btn btn-success siguiente">
	                                            <i class="fa fa-forward"></i> Siguiente 
	                                        </button>
	                                    </div>
	                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
        		</div> <!-- fin panel : tabDirDemanda -->
        		<div role="tabpanel" class="tab-pane fade p-3" id="tabPretension">
        			 <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Pretensiones
                                    <p class="m-0">Aquí el interesado llenará los datos que considere apropiado</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-lg-12 col-12">
                                            <table class="table TablaSistema" id="tbPretensiones">
                                               <thead>
                                                    <tr class="text-center">
                                                        <th>Pretensión</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    foreach ($MSolicitudPretension as $key => $value) {
                                                        echo '<tr>
                                                                <td>'.$value['desPretension'].'</td>
                                                             </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                         </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        		</div><!-- fin panel : tabPretension -->
				<div role="tabpanel" class="tab-pane fade p-3" id="tabValidez">
					<div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Validez o existencia de convenio arbitral
                                    <p class="m-0">Detalle aqui la validez o existencia de convenio arbitral que conlleve a determinar la procedencia 
                                    				de dictarse una medida cautelar fuera de proceso arbitral  y objeto de la presente medida cautelar</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="desexicon" name = "desexicon" rows="3" readonly><?php echo $Solicitud['desexicon']; ?></textarea>
                                            </div>
                                        </div>         
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                        </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div><!-- fin panel : tabValidez -->
				<div role="tabpanel" class="tab-pane fade p-3" id="tabEjecucion">
					<div class="form-row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header font-weight-bold">
									Forma de ejecución de la medida cautelar
									<p class="m-0">La medida cautelar deberá ser ejecutada mediante la notificación con la Resolución que la conceda a la siguientes personas o entidad</p>
								</div>
								<div class="card-body">
									<div class="form-row">
				                        <div class="col-sm-6">
				                            <div class="card">
				                            	<div class="card-header font-weight-bold">
													Datos de la persona, entidad o empresa a notificar.
													<p class="m-0"></p>
				                            	</div>
				                            	<div class="card-body">
				                            		<div class="form-row">
				                            			<div class="col-sm-12">
				                            				<div class="form-group"><label for="">Nombre o Razón social</label>
				                            					<input type="text" class="form-control" id="frmejenomper" name="frmejenomper" value="<?php echo $Solicitud['frmejenomper']; ?>" readonly>
				                            				</div>
				                            			</div>
				                            			<div class="col-sm-12">
				                            				<div class="form-group"><label for="">Domicilio</label>
				                            					<input type="text" class="form-control" id="frmejedomper" name="frmejedomper" value="<?php echo $Solicitud['frmejedomper']; ?>" readonly>
				                            				</div>
				                            			</div>
				                            			<div class="col-sm-6">
				                            				<div class="form-group"><label for="">Teléfono</label>
				                            					<input type="text" class="form-control" id="frmejetelper" name="frmejetelper" value="<?php echo $Solicitud['frmejetelper']; ?>" readonly>
				                            				</div>
				                            			</div>
				                            			<div class="col-sm-6">
				                            				<div class="form-group"><label for="">Celular</label>
				                            					<input type="text" class="form-control" id="frmejecelper" name="frmejecelper" value="<?php echo $Solicitud['frmejecelper']; ?>" readonly>
				                            				</div>
				                            			</div>
														<div class="col-sm-12">
				                            				<div class="form-group"><label for="">Correo electrónico</label>
				                            					<input type="text" class="form-control" id="frmejeemaper" name="frmejeemaper" value="<?php echo $Solicitud['frmejeemaper']; ?>" readonly>
				                            				</div>
				                            			</div>
				                            		</div>
				                            	</div>
				                            	<div class="card-footer">
				                            		<div class="form-row">
				                                        <div class="col-sm-12">
				                                            <button type="button" class="btn btn-success anterior">
				                                                <i class="fa fa-backward"></i> Anterior 
				                                            </button>
				                                        </div>
				                                    </div>
				                            	</div>
				                            </div>
				                        </div>
				                        <div class="col-sm-6">
				                            <div class="card">
				                            	<div class="card-header font-weight-bold">
													Datos de la empresa aseguradora que mantiene en custodia las cartas fianzas.
				                            	</div>
				                            	<div class="card-body">
				                            		<div class="form-row">
				                            			<div class="form-row">
					                            			<div class="col-sm-12">
					                            				<div class="form-group"><label for="">Nombre o Razón social</label>
					                            					<input type="text" class="form-control" id="frmejenomemp" name="frmejenomemp" value="<?php echo $Solicitud['frmejenomemp']; ?>" readonly>
					                            				</div>
					                            			</div>
					                            			<div class="col-sm-12">
					                            				<div class="form-group"><label for="">Domicilio</label>
					                            					<input type="text" class="form-control" id="frmejedomemp" name="frmejedomemp" value="<?php echo $Solicitud['frmejedomemp']; ?>" readonly>
					                            				</div>
					                            			</div>
					                            			<div class="col-sm-6">
					                            				<div class="form-group"><label for="">Teléfono</label>
					                            					<input type="text" class="form-control" id="frmejetelemp" name="frmejetelemp" value="<?php echo $Solicitud['frmejetelemp']; ?>" readonly>
					                            				</div>
					                            			</div>
					                            			<div class="col-sm-6">
					                            				<div class="form-group"><label for="">Celular</label>
					                            					<input type="text" class="form-control" id="frmejecelemp" name="frmejecelemp" value="<?php echo $Solicitud['frmejecelemp']; ?>" readonly>
					                            				</div>
					                            			</div>
															<div class="col-sm-12">
					                            				<div class="form-group"><label for="">Correo electrónico</label>
					                            					<input type="text" class="form-control" id="frmejeemaemp" name="frmejeemaemp" value="<?php echo $Solicitud['frmejeemaemp']; ?>" readonly>
					                            				</div>
					                            			</div>
					                            		</div>
				                            		</div>
				                            	</div>
				                            	<div class="card-footer">
				                            		<div class="form-row">
				                                        <div class="col-sm-12 text-right">
				                                            <button type="button" class="btn btn-success anterior">
				                                                <i class="fa fa-forward"></i> Siguiente 
				                                            </button>
				                                        </div>
				                                    </div>
				                            	</div>
				                            </div>
				                        </div>
				                    </div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- fin panel : tabEjecucion -->
				<div role="tabpanel" class="tab-pane fade p-3" id="tabExcepcion">
					<div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Excepción de conocimiento
                                    <p class="m-0">De ser el caso, necesidad de que la demandada no tenga conocimiento 
                                    				de la solicitud de medida cautelar antes de la ejecución</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="desexpcon" name = "desexpcon" rows="3" readonly><?php echo $Solicitud['desexpcon']; ?></textarea>
                                            </div>
                                        </div>         
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                        </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div><!-- fin panel : tabExcepcion -->
				<div role="tabpanel" class="tab-pane fade p-3" id="tabFundamento">
					<div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Fundamentos
                                    <p class="m-0">Fundamentos de hechos que sustentan la medida cautelar</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="DesNarHec" name = "DesNarHec" rows="3" readonly><?php echo $Solicitud['DesNarHec']; ?></textarea>
                                            </div>
                                        </div>         
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                        </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div><!-- fin panel : tabFundamento -->
				<div role="tabpanel" class="tab-pane fade p-3" id="tabPresupuesto">
					<div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Presupuesto
                                    <p class="m-0">Presupuestos materiales para la implementación de la medida cautelar que deberá sustentar y desarrollar</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                    	<div class="col-sm-12">
                                    		<div class="form-group"> <label>1)	Verificación y comprobación del presupuesto material verosimilitud del derecho.</label>
                                        	    <input class="form-control" name="despre01" id="despre01" readonly value="<?php echo $Solicitud['despre01']; ?>">
                                        	</div>	
                                    	</div>
                                    	<div class="col-sm-12">
                                    		<div class="form-group"> <label>2)	Verificación y comprobación del presupuesto material peligro en la demora.</label>
                                        	    <input class="form-control" name="despre02" id="despre02" readonly value="<?php echo $Solicitud['despre02']; ?>">
                                        	</div>	
                                    	</div>
                                    	<div class="col-sm-12">
                                    		<div class="form-group"> <label>3)	Verificación y justificación del presupuesto material de contracautela.</label>
                                        	    <input class="form-control" name="despre03" id="despre03" readonly value="<?php echo $Solicitud['despre03']; ?>">
                                        	</div>	
                                    	</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                	<div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                        </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div><!-- fin panel : tabPresupuesto -->
				<div role="tabpanel" class="tab-pane fade p-3" id="tabAdicionales">
					<div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Presupuesto Adicionales
                                    <p class="m-0">Presupuestos adicionales correspondientes a la medida cuatelar de no innovar</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                    	<div class="col-sm-12">
                                    		<div class="form-group"> <label>a)	Inminencia de un perjuicio irreparable</label>
                                        	    <input class="form-control" name="despreadi01" id="despreadi01" readonly value="<?php echo $Solicitud['despreadi01']; ?>">
                                        	</div>	
                                    	</div>
                                    	<div class="col-sm-12">
                                    		<div class="form-group"> <label>b)	Que la medida se circunscribe a las personas y bienes comprendidos en el proceso</label>
                                        	    <input class="form-control" name="despreadi02" id="despreadi02" readonly value="<?php echo $Solicitud['despreadi02']; ?>">
                                        	</div>	
                                    	</div>
                                    	<div class="col-sm-12">
                                    		<div class="form-group"> <label>c)	No resulta aplicable otra medida cautelar prevista.</label>
                                        	    <input class="form-control" name="despreadi03" id="despreadi03" readonly value="<?php echo $Solicitud['despreadi03']; ?>">
                                        	</div>	
                                    	</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                	<div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                        </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<div role="tabpanel" class="tab-pane fade p-3" id="tabAnexos">
					<div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Anexos
                                    <p class="m-0">Información de Anexos</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">

                                        <div class="col-sm-12">
                                            <table class="table TablaSistema" id="tbAnexosMedCau">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="10%">Fila</th>
                                                        <th width="10%" class="ColOculto">IdAnexo</th>
                                                        <th width="20%">Medio Probatorio</th>
                                                        <th width="30%">Archivo</th>
                                                        <th width="10%" class="fin">Acciones</th>
                                                        <th width="10%" class="ColOculto">NuevoAnexo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $cnt = 0;
                                                        foreach ($MSolicitudAnexo as $key => $value) {
                                                            $cnt++;
                                                            echo '<tr id="fila'.$cnt.'">';
                                                               echo '<td class="text-center">'. $cnt.'</td>';
                                                               echo '<td class="text-center ColOculto">'. $value["idAnexo"].'</td>';
                                                               echo '<td class="text-center ColOculto">'. $value["idTipo"].'</td>';
                                                               echo '<td class="text-center">'. $value["desanx"].'</td>';
                                                               echo '<td class="text-center">'. $value["nomFileLoc"].'</td>';
                                                                   echo '<td class="text-center"><a href="upload/'.$value['nomFileSer'].'" class="btn btn-block btn-success" target="_blank"><i class="fa fa-download"></i> Descargar</a></td>';

                                                             echo '</tr>';
                                                        }
                                                     ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                	<div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                         </div> 

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
        	</div>
		<!-- ====================================================================== -->
	</div>
</div>
<?php 
	include_once 'componentes/footer.php';
?>