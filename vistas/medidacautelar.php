<?php 
/*  --------------------------- Componentes HTML --------------------------- */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';
 ?>
 <nav aria-label="breadcrumb">
    <ol class="breadcrumb migas m-4">
        <li class="breadcrumb-item"><a href="consulta.php"><i class="fa fa-edit"></i> Mis Solicitudes</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Medida Cautelar</li>
    </ol>
</nav>

<div class="card m-4">
    <form method="POST" id="frmmedidacautelar" enctype="multipart/form-data" class="frmmedidacautelar">
	   <div class="card-body">
		  <h2 class="titulo"> <i class="fa fa-book"></i> Medida Cautelar </h2>
            <p class="subtitulo">Genere aqui su Solicitud para Medida Cautelar</p>

            <!-- ENCABEZADOS DE LISTA -->
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
                                                <input class="form-control" id="RazSocDem" name="RazSocDem" placeholder="Ejemplo: Juan Carlos Montenegro Vega">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Tipo de Documento de Identidad</label>
                                                <select id="TipDocDem" name="TipDocDem" class="form-control cbo">
                                                <?php 
                                                    foreach ($MTipDoc as $key => $value) {
                                                        echo '<option value="'.$value["id"].'">'.$value["tipdoc"].'</option>';
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="form-group"> <label>Número de Documento</label>
                                                <input class="form-control input_num" id="NumDocDem" name="NumDocDem" maxlength="11" placeholder="Ingrese número de documento">
                                                <div id="msgval1" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Domicilio de la persona natural o jurídica</label>
                                                <input class="form-control" id="DesDirDem" name="DesDirDem" placeholder="Ejemplo: Los Manzanos N° 125 - Residencial San Luis, distrito de San Borja,  provincia y región de Lima">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>La factura o boleta se deberá de emitir a nombre de:</label>
                                                <input class="form-control" id="RazSocEmiCom" name="RazSocEmiCom" placeholder="Nombre o Razón Social">
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
                                                <input class="form-control" id="ApeNomLeg" name="ApeNomLeg" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>N° DNI</label>
                                                <input class="form-control" id="NumDocRep" name="NumDocRep" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>N° Teléfono</label>
                                                <input class="form-control" id="NumTelRep" name="NumTelRep" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group"> <label>N° Celular</label>
                                                <input class="form-control" id="NumCelRep" name="NumCelRep" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Facultado según</label>
                                                <input class="form-control" id="EscPubDem" name="EscPubDem" placeholder="(Datos del Testimonio de la Escritura Pública, o del acta legalizada o, de la copia literal de la vigencia de poder expedida por los Registros Públicos).">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label>Correo electrónico</label>
                                                <input class="form-control" id="DirEmaRep" name="DirEmaRep" placeholder="Ejemplo: usuario@mail.com">
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
                                            <input class="form-control" id="RazSocDmd" name="RazSocDmd" placeholder="Ejemplo:Juan Carlos Montenegro Vega">
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Domicilio</label>
                                            <input class="form-control" id="DesDirDmd" name="DesDirDmd" placeholder="">
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Teléfono</label>
                                            <input class="form-control" id="NumTelDmd" name="NumTelDmd" placeholder="">
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Celular</label>
                                            <input class="form-control" id="NumCelDmd" name="NumCelDmd" placeholder="">
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Correo Electrónico</label>
                                            <input class="form-control" id="DirEmaDmd" name="DirEmaDmd" placeholder="Ejemplo: usuario@mail.com">
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
                                        <div class="form-group col-lg-10 col-12">
                                            <input type="text" class="form-control" id="DesPretension" name="DesPretension" placeholder="Describa una pretensión">
                                        </div>
                                        <div class="form-group col-lg-2 col-12">
                                            <button type="button" class="btn btn-outline-success btn-block btnAgregar" id="btnAgregar">
                                            <i class="fa fa-search"></i> Agregar </button> 
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <table class="table TablaSistema" id="tbPretensiones">
                                               <thead>
                                                    <tr class="text-center">
                                                        <th width="90%">Pretensión</th>
                                                        <th width="10%" class="text-center">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
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
                                                <textarea class="form-control" id="desexicon" name = "desexicon" rows="3" placeholder="Ingrese detalle"></textarea>
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
				                            					<input type="text" class="form-control" id="frmejenomper" name="frmejenomper">
				                            				</div>
				                            			</div>
				                            			<div class="col-sm-12">
				                            				<div class="form-group"><label for="">Domicilio</label>
				                            					<input type="text" class="form-control" id="frmejedomper" name="frmejedomper">
				                            				</div>
				                            			</div>
				                            			<div class="col-sm-6">
				                            				<div class="form-group"><label for="">Teléfono</label>
				                            					<input type="text" class="form-control" id="frmejetelper" name="frmejetelper">
				                            				</div>
				                            			</div>
				                            			<div class="col-sm-6">
				                            				<div class="form-group"><label for="">Celular</label>
				                            					<input type="text" class="form-control" id="frmejecelper" name="frmejecelper">
				                            				</div>
				                            			</div>
														<div class="col-sm-12">
				                            				<div class="form-group"><label for="">Correo electrónico</label>
				                            					<input type="text" class="form-control" id="frmejeemaper" name="frmejeemaper">
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
					                            					<input type="text" class="form-control" id="frmejenomemp" name="frmejenomemp">
					                            				</div>
					                            			</div>
					                            			<div class="col-sm-12">
					                            				<div class="form-group"><label for="">Domicilio</label>
					                            					<input type="text" class="form-control" id="frmejedomemp" name="frmejedomemp">
					                            				</div>
					                            			</div>
					                            			<div class="col-sm-6">
					                            				<div class="form-group"><label for="">Teléfono</label>
					                            					<input type="text" class="form-control" id="frmejetelemp" name="frmejetelemp">
					                            				</div>
					                            			</div>
					                            			<div class="col-sm-6">
					                            				<div class="form-group"><label for="">Celular</label>
					                            					<input type="text" class="form-control" id="frmejecelemp" name="frmejecelemp">
					                            				</div>
					                            			</div>
															<div class="col-sm-12">
					                            				<div class="form-group"><label for="">Correo electrónico</label>
					                            					<input type="text" class="form-control" id="frmejeemaemp" name="frmejeemaemp">
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
                                                <textarea class="form-control" id="desexpcon" name = "desexpcon" rows="3" placeholder="Ingrese detalle"></textarea>
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
                                                <textarea class="form-control" id="DesNarHec" name = "DesNarHec" rows="3" placeholder="Ingrese detalle"></textarea>
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
                                        	    <input class="form-control" name="despre01" id="despre01" placeholder="">
                                        	</div>	
                                    	</div>
                                    	<div class="col-sm-12">
                                    		<div class="form-group"> <label>2)	Verificación y comprobación del presupuesto material peligro en la demora.</label>
                                        	    <input class="form-control" name="despre02" id="despre02" placeholder="">
                                        	</div>	
                                    	</div>
                                    	<div class="col-sm-12">
                                    		<div class="form-group"> <label>3)	Verificación y justificación del presupuesto material de contracautela.</label>
                                        	    <input class="form-control" name="despre03" id="despre03" placeholder="">
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
                                        	    <input class="form-control" name="despreadi01" id="despreadi01" placeholder="">
                                        	</div>	
                                    	</div>
                                    	<div class="col-sm-12">
                                    		<div class="form-group"> <label>b)	Que la medida se circunscribe a las personas y bienes comprendidos en el proceso</label>
                                        	    <input class="form-control" name="despreadi02" id="despreadi02" placeholder="">
                                        	</div>	
                                    	</div>
                                    	<div class="col-sm-12">
                                    		<div class="form-group"> <label>c)	No resulta aplicable otra medida cautelar prevista.</label>
                                        	    <input class="form-control" name="despreadi03" id="despreadi03" placeholder="">
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

                                    	<div class="form-group col-lg-4 col-12">
                                            <select id="tipdocReq" name="tipdocReq" class="form-control cbo">
                                                <option value="">Seleccione un tipo de documento</option>
                                                <?php 
                                                    foreach ($MTipoAnexo as $key => $value) {
                                                        echo '<option value="'.$value["id"].'">'.$value["desanx"].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                    	<div class="form-group col-lg-6 col-12">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="NomArcReq" lang="es">
                                                <label class="custom-file-label" for="NomArcReq">Seleccionar archivo</label>
                                            </div>
                                        </div> 	

                                        <div class="form-group col-lg-2 col-12">
	                                     	<button type="button" class="btn btn-outline-success btn-block btnAgregar" id="btnAgregarAnx" formenctype="multipart/form-data">
	                                            <i class="fa fa-plus"></i> Agregar 
	                                        </button>
                                        </div>

                                        <div class="col-sm-12">
                                            <table class="table TablaSistema" id="tbArchivos">
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
        </div> <!-- fin card-body -->
        <div class="card-footer">
            <div class="form-row">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-danger" id="btnRegistrarMedidaCautelar" onclick="RegistrarMedidaCautelar(<?php echo $idUsuario; ?>);">
                        <i class="fa fa-save"></i> Generar Medida Cautelar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

 <?php 
	include_once 'componentes/footer.php';
  ?>