<?php 
/* --------------------------- Componentes HTML --------------------------- */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';

?>
<nav aria-label="breadcrumb" class="mt-3 mr-3 ml-3 mb-0">
    <ol class="breadcrumb migas">
        <li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-edit"></i> Panel Principal</a></li>
        <li class="breadcrumb-item"><a href="recepcion.php"><i class="fa fa-envelope-o"></i> Mesa de Partes</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Detalle de Solicitud</li>
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

				/*	==========================
				SOLICITUD DE ARBITRAJE
				============================*/
				echo '<input type="text" id="usuarioOrigen" name="usuarioOrigen" class="form-control" value="'.$idUsuario.'" style="display: none;">
   					  <input type="text" id="areaOrigen" name="areaOrigen" class="form-control" value="'.$idArea.'" style="display: none;">';

				echo '<h2 class="titulo"> <i class="fa fa-book"></i> Solicitud de Arbitraje  </h2>
        			  <br>';
				echo '<ul class="nav nav-tabs pnlRegistro" id="pnlRegistro">
							              <li class="nav-item"> <a class="nav-link active show" data-toggle="pill" data-target="#tabDemandante"><i class="fa fa-arrow-right"></i> Demandante</a> </li>
							              <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabDemandado"><i class="fa fa-arrow-right"></i> Demandado</a> </li>
							              <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabConvArbitral"><i class="fa fa-arrow-right"></i> Convenio</a> </li>
							              <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabTipoArbitraje"><i class="fa fa-arrow-right"></i> Tipo de Arbitraje</a> </li>
							              <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabNarracionHechos"><i class="fa fa-arrow-right"></i> Hechos</a> </li>
							              <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabPretensiones"><i class="fa fa-arrow-right"></i> Pretensiones</a> </li>
							              <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabInfoProcExtra"><i class="fa fa-arrow-right"></i> Medida cautelar</a></li>
							              <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabCuantia"><i class="fa fa-arrow-right"></i> Cuantía</a> </li>
							              <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabDesigArbitro"><i class="fa fa-arrow-right"></i> Designación de Árbitro</a> </li>
							              <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabAnexos"><i class="fa fa-arrow-right"></i> Anexos</a> </li>
							          </ul>';
							    echo'<div class="tab-content">
									    <div role="tabpanel" class="tab-pane fade p-4 active show " id="tabDemandante">
	                    					<div class="form-row">
	                    						<div class="col-sm-6">
													<div class="card">
														<div class="card-header font-weight-bold">
															Demandante                
                                    						<p class="m-0">Información de Demandante</p>
														</div>
														<div class="card-body">
															<div class="form-row">

																<div class="col-sm-4">
																	<div class="form-group">
																		<label>Nombre o Razón Social</label>
				                                    					<input class="form-control" id="txtRazSocDem" name="RazSocDem" value="'.$Solicitud['RazSocDem'].'" disabled>
				                                					</div>
																</div>

																<div class="col-sm-5">
																	<div class="form-group">
			                                							<label>Tipo de Documento de Identidad</label>
			                                    						<input id = "TipDocDem" name="TipDocDem" class="form-control" value="'.$Solicitud["DesTipDocDem"].'" disabled>
			                                      					</div>	
																</div>
																
																<div class="col-sm-3">
																	<div class="form-group"> 
				                                						<label>Número de Documento</label>
				                                    					<input class="form-control" id="txtNumDocDem" name="NumDocDem" value="'.$Solicitud['NumDocDem'].'" disabled>
				                                    				</div>
																</div>

																<div class="col-sm-12">
																	<div class="form-group">
					                                					<label>Escritura Pública/Acta legalizada/Copia literal/ Copia de la vigencia de poder expedida de los registros públicos</label>
					                                    				<input class="form-control" name="EscPubDem" value="'.$Solicitud['EscPubDem'].'" disabled>
					                                				</div>
																</div>

																<div class="col-sm-12">
					                                				<div class="form-group"> 
					                                					<label>Domicilio de la persona natural o jurídica</label>
					                                    				<input class="form-control" name="DesDirDem" value="'.$Solicitud['DesDirDem'].'" disabled>
					                                				</div>
																</div>

															</div>
															
														</div>
													</div>
	                                       		</div>

	                                       		<div class="col-sm-6">
													<div class="card">
														<div class="card-header font-weight-bold">
						                                    Representante Legal
						                                    <p class="m-0">Información del Representante Legal</p>
						                                </div>
														<div class="card-body">
															<div class="form-row">

																<div class="col-sm-4">
					                                				<div class="form-group">
					                                					<label>Nombre</label>
					                                    				<input class="form-control" id="txtApeNomLeg" name="ApeNomLeg" value="'.$Solicitud['ApeNomLeg'].'" disabled>
					                                				</div>
					                            				</div>

					                            				<div class="col-sm-5">
					                                				<div class="form-group">
					                                					<label>Tipo de Documento</label>
					                                    			    <input id="TipDocRep" name="TipDocRep" class="form-control" value="'.$Solicitud["DesTipDocRep"].'" disabled>                                        
					                                				</div>
					                                			</div>

					                                			<div class="col-sm-3">
				                                					<div class="form-group">
				                                						<label>Número de Documento</label>
				                                    					<input class="form-control input_num" id="txtNumDocRep" name="NumDocRep" value="'.$Solicitud['NumDocRep'].'" disabled>
																	</div>
				                            					</div>

				                            					<div class="col-sm-6">
					                                				<div class="form-group">
					                                					<label>cod. ciudad + Teléfono Fijo.</label>
					                                    				<input class="form-control" id="txtNumTelRep" name="NumTelRep" value="'.$Solicitud['NumTelRep'].'" disabled>
					                                				</div>
					                            				</div>
					                            				<div class="col-sm-6">
					                                				<div class="form-group">
					                                					<label>Celular</label>
					                                    				<input class="form-control input_tel" id="txtNumCelRep" name="NumCelRep" value="'.$Solicitud['NumCelRep'].'" disabled>
					                                				</div>
					                            				</div>

					                            				<div class="col-sm-12">
					                                				<div class="form-group"> 
					                                					<label>Correo Electrónico</label>
					                                    				<input class="form-control" id="txtDirEmaRep" name="DirEmaRep" value="'.$Solicitud['DirEmaRep'].'" disabled>
					                                				</div>
					                            				</div>

															</div>
														</div>
													</div>
	                                       		</div>

	                                       		<div class="col-sm-12">
	                                       			<div class="card mt-2">
	                                       				<div class="card-header font-weight-bold">
						                                    Emisión de Comprobante
						                                    <p class="m-0">La factura o boleta se deberá de emitir a nombre de:</p>
						                                </div>
	                                       				<div class="card-body">
	                                       					<div class="form-row">

	                                       						<div class="col-sm-3">
			                                						<div class="form-group">
			                                							<label>Tipo de Comprobante</label>
			                                							<input name="TipDocEmiCom" class="form-control" value = "'.$Solicitud["DesTipDocEmiCom"].'" disabled>
			                                						</div>
			                            						</div>

			                            						<div class="col-sm-3">
			                                						<div class="form-group">
			                                    						<label>Numero de Documento</label>
			                                    						<input class="form-control" name="NumDocEmiCom" value="'.$Solicitud['NumDocEmiCom'].'" disabled>
			                                						</div>
			                          							</div>

			                          							<div class="col-sm-6">
										                            <div class="form-group">
										                                <label>Razón Social</label>
										                                <input class="form-control" name="RazSocEmiCom" value="'.$Solicitud['RazSocEmiCom'].'" disabled>
										                            </div>
										                        </div>
																
	                                       					</div>
	                                       				</div>
	                                       			</div>
	                                       		</div>
	                                       	</div>
                  						</div>';

            				  echo '<div role="tabpanel" class="tab-pane fade p-4"  id="tabDemandado">
										<div class="row">
											<div class="col-sm-12">
												<div class="card ">
													<div class="card-header font-weight-bold">
					                                    Demandado
					                                    <p class="m-0">Información de Demandado</p>
					                                </div>
													<div class="card-body">
														<div class="form-row">

															<div class="col-sm-12">
								                                <div class="form-group"> <label>Nombre o Razón Social</label>
								                                <input class="form-control" id="txtRazSocDmd" name="RazSocDmd" value="'.$Solicitud['RazSocDmd'].'" disabled>
								                              </div>
								                            </div>

								                            <div class="col-sm-12">
								                              	<div class="form-group"> <label>Domicilio</label>
								                                	<input class="form-control" id="txtDesDirDmd" name="DesDirDmd" value="'.$Solicitud['DesDirDmd'].'" disabled>
								                              	</div>
								                            </div>

								                            <div class="col-sm-3">
								                                <div class="form-group"> 
								                                	<label>Tipo de Documento</label>
								                                    <input id="TipDocDmd" name="TipDocDmd" class="form-control" value="'.$Solicitud["DesTipDocDmd"].'" disabled>
								                                </div>
								                            </div>

								                            <div class="col-sm-3">
								                                <div class="form-group">
								                                	<label>Número de Documento</label>
								                                    <input class="form-control" id="txtNumDocDmd" name="NumDocDmd" value="'.$Solicitud['NumDocDmd'].'" disabled>
								                                </div>
								                            </div>

								                            <div class="col-sm-3">
								                              	<div class="form-group">
								                              		<label>cod. ciudad + Teléfono Fijo.</label>
								                                	<input class="form-control" name="NumTelDmd" value="'.$Solicitud['NumTelDmd'].'" disabled>
								                              	</div>
								                            </div>

								                            <div class="col-sm-3">
								                              	<div class="form-group">
								                              		<label>Celular</label>
								                                	<input class="form-control" name="NumCelDmd" value="'.$Solicitud['NumCelDmd'].'" disabled>
								                              	</div>
								                            </div>

								                            <div class="col-sm-6">
								                              	<div class="form-group">
								                              		<label>Correo Electrónico</label>
								                                	<input class="form-control" name="DirEmaDmd" value="'.$Solicitud['DirEmaDmd'].'" id="txtDirEmaDmd" disabled>
								                              	</div>
								                            </div>

								                            <div class="col-sm-6">
								                            	<div class="form-group">
								                              		<label>Autoridad o representante</label>
								                                	<input class="form-control" name="AutRepDmd" id="txtAutRepDmd" value="'.$Solicitud['AutRepDmd'].'" disabled>
								                              	</div>
								                            </div>

								                            <div class="col-sm-6">
								                              	<div class="form-group">
								                              		<label>Procurador público/abogado</label>
								                                	<input class="form-control" name="ProPubDmd" id="txtProPubDmd" value="'.$Solicitud['ProPubDmd'].'" disabled>
								                              	</div>
								                            </div>

														</div>
													</div>
												</div>
											</div>
										</div>                           
                    				</div>
                    				<!-- ------------------------------------------------------------------------------------- -->
									<div role="tabpanel" class="tab-pane fade p-4"  id="tabConvArbitral">
										<div class="row">
											<div class="col-sm-12">
												<div class="card ">
													<div class="card-header font-weight-bold">
					                                    Convenio Arbitral
					                                    <p class="m-0">Indicar su interés que la controversia existente se organice y administre
					                                    a través del Centro de Arbitraje Latinoamericano e Investigaciones Jurídicas, 
					                                    o indicar la cláusula arbitral.</p>
					                                </div>
													<div class="card-body">
				                    					<div class="form-row">
				                         					<div class="col-sm-12">
				                             					<div class="form-group">
				                                 					<textarea class="form-control" name = "DesConArb" rows="3" disabled>'.$Solicitud['DesConArb'].'</textarea>
				                             					</div>
				                         					</div>
				                        				</div>
				                     				</div>
            									</div>
            								</div>
            							</div>
            						</div>
            						<!-- ------------------------------------------------------------------------------------- -->
									<div role="tabpanel" class="tab-pane fade p-4"  id="tabTipoArbitraje">
										<div class="row">
											<div class="col-sm-12">
												<div class="card">
													<div class="card-header font-weight-bold">
					                                    Tipo de Arbitraje
					                                    <p class="m-0">Seleccione las casillas que considere aplicable a:</p>
					                                </div>
													<div class="card-body">
				                    					<div class="form-row">
				                         					<div class="col-sm-6">
				                             					<div class="form-group">
				                                 					<label>Su controversia</label>
								                                    
								                                    <div class="custom-control custom-checkbox chk">
								                                        <input type="checkbox" class="custom-control-input" id="flgCtrDer" name="flgCtrDer" value="Yes" ';
								                                        if($Solicitud['flgCtrDer']=='x'){ echo 'checked';}
								                                        echo' disabled>
								                                        <label class="custom-control-label" for="flgCtrDer">De Derecho</label>
								                                    </div>
								                                    
								                                    <div class="custom-control custom-checkbox">
								                                        <input type="checkbox" class="custom-control-input" id="flgCtrCon" name="flgCtrCon" value="Yes" ';
								                                        if($Solicitud['flgCtrCon']=='x'){ echo 'checked';}
								                                        echo' disabled>
								                                        <label class="custom-control-label" for="flgCtrCon">De Conciencia</label>
								                                    </div>
								                                    
								                                    <div class="custom-control custom-checkbox">
								                                        <input type="checkbox" class="custom-control-input" id="flgCtrNac" name="flgCtrNac" value="Yes" ';
								                                        if($Solicitud['flgCtrNac']=='x'){ echo 'checked';}
								                                        echo ' disabled>
								                                        <label class="custom-control-label" for="flgCtrNac">Nacional</label>
								                                    </div>
								                                    
								                                    <div class="custom-control custom-checkbox">
								                                        <input type="checkbox" class="custom-control-input" id="flgCtrInt" name="flgCtrInt" value="Yes" ';
								                                        if($Solicitud['flgCtrInt']=='x'){ echo 'checked';}
								                                        echo ' disabled>
								                                        <label class="custom-control-label" for="flgCtrInt">Internacional</label>
								                                    </div>
				                             					</div>
				                         					</div>

				                         					<div class="col-sm-6">
								                                <div class="form-group">
								                                    <label>Especialidad</label>
								                                    
								                                    <div class="custom-control custom-checkbox chk">
								                                        <input type="checkbox" class="custom-control-input" id="flgEspCtr" name="flgEspCtr" value="Yes" ';
								                                        if($Solicitud['flgEspCtr']=='x'){ echo 'checked';}
								                                        echo ' disabled>
								                                        <label class="custom-control-label" for="flgEspCtr">Contratación Pública</label>
								                                    </div>
								                                    
								                                    <div class="custom-control custom-checkbox chk">
								                                        <input type="checkbox" class="custom-control-input" id="flgEspCiv" name="flgEspCiv" value="Yes" ';
								                                        if($Solicitud['flgEspCiv']=='x'){ echo 'checked';}
								                                        echo ' disabled>
								                                        <label class="custom-control-label" for="flgEspCiv">Civil</label>
								                                    </div>
								                                    
								                                    <div class="custom-control custom-checkbox chk">
								                                        <input type="checkbox" class="custom-control-input" id="flgEspLey" name="flgEspLey" value="Yes" ';
								                                        if($Solicitud['flgEspLey']=='x'){ echo 'checked';}
								                                        echo ' disabled>
								                                        <label class="custom-control-label" for="flgEspLey">Ley General de Sociedad</label>
								                                    </div>
								                                    
								                                    <div class="custom-control custom-checkbox chk">
								                                        <input type="checkbox" class="custom-control-input" id="flgEspMin" name="flgEspMin" value="Yes" ';
								                                        if($Solicitud['flgEspMin']=='x'){ echo 'checked';}
								                                        echo ' disabled>
								                                        <label class="custom-control-label" for="flgEspMin">Minero</label>
								                                    </div>
								                                    
								                                    <div class="custom-control custom-checkbox chk">
								                                        <input type="checkbox" class="custom-control-input" id="flgEspCon" name="flgEspCon" value="Yes" ';
								                                        if($Solicitud['flgEspCon']=='x'){ echo 'checked';}
								                                        echo ' disabled>
								                                        <label class="custom-control-label" for="flgEspCon">Concesiones</label>
								                                    </div>
								                                    
								                                    <div class="custom-control custom-checkbox chk">
								                                        <input type="checkbox" class="custom-control-input" id="flgEspOtr" name="flgEspOtr" value="Yes" ';
								                                        if($Solicitud['flgEspOtr']=='x'){ echo 'checked';}
								                                        echo ' disabled>
								                                        <label class="custom-control-label" for="flgEspOtr">Otros</label>
								                                    </div>
								                                </div>
								                            </div>
				                        				</div>
				                     				</div>
            									</div>
            								</div>
            							</div>
            						</div>
									<!-- ------------------------------------------------------------------------------------- -->
									<div role="tabpanel" class="tab-pane fade p-4"  id="tabNarracionHechos">
										<div class="row">
											<div class="col-sm-12">
												<div class="card">
													<div class="card-header font-weight-bold">
					                                    Narración de los Hechos
					                                    <p class="m-0">Narración breve de los hechos que desee someter a arbitraje. <br>
					                                                  (El solicitante debe hacer un resumen claro de los hechos que han generado la controversia)</p>
					                                </div>
													<div class="card-body">
				                    					<div class="form-row">

					                                        <div class="col-sm-12">
									                            <div class="form-group">
									                                <textarea class="form-control" name = "DesNarHec" rows="3" disabled>'.$Solicitud['DesNarHec'].'</textarea>
									                            </div>
									                        </div>

														</div>
					                				</div>
					                			</div>
					                		</div>
					                	</div>
					                </div>
									<!-- ------------------------------------------------------------------------------------- -->
									<div role="tabpanel" class="tab-pane fade p-4"  id="tabPretensiones">
										<div class="row">
											<div class="col-sm-12">
												<div class="card">
													<div class="card-header font-weight-bold">
					                                    Pretensiones
					                                    <p class="m-0">El petitorio debe ser redactado con claridad y precisión</p>
					                                </div>
													<div class="card-body">
														<div class="form-row">
															<div class="table-responsive">
									                            <table class="table TablaSistema" id="tbPretensiones">
									                                <thead>
									                                    <tr class="text-center">
																		    <th>Fila</th>
									                                        <th>Pretensión</th>
									                                    </tr>
									                                </thead>
									                                <tbody>';								                                     
								                                        foreach ($MSolicitudPretension as $key => $value) {							                                            
								                                            echo '<tr class="text-center" id="fila'.$value["idPretension"].'">';
																					echo '<td>'.$value["idPretension"].'</td>';	
																					echo '<td>'.$value["desPretension"].'</td>';
								                                            echo "</tr>";
								                                            }
									                           echo '</tbody>
									                            </table>
									                    	</div>
									                    </div>
													</div>
												</div>
											</div>
										</div>			                    
					                </div>
									<!-- ------------------------------------------------------------------------------------- -->
									 <div role="tabpanel" class="tab-pane fade p-4"  id="tabInfoProcExtra">
					                    <div class="row">
					                    	<div class="col-sm-12">
												<div class="card">
													<div class="card-header font-weight-bold">
					                                    Medida cautelar
					                                    <p class="m-0">Información sobre procesos extra arbitrales interpuestos ante el Árbitro de Emergencia 
					                                                   o ante el órgano jurisdiccional - Poder Judicial - sobre la materia en arbitraje: (cautelares).</p>
					                                </div>
													<div class="card-body">													
														<div class="form-row">
									                        <div class="col-sm-12">
									                            <div class="form-group">
									                                <textarea class="form-control" name = "DesMedCau" rows="3" disabled>'.$Solicitud['DesMedCau'].'</textarea>
									                            </div>
									                        </div>
								                        </div>
													</div>
												</div>
					                    	</div>
					                    </div>
					                </div>
									<!-- ------------------------------------------------------------------------------------- -->
									 <div role="tabpanel" class="tab-pane fade p-4"  id="tabCuantia">
									 	<div class="row">
									 		<div class="col-sm-6">
									 			<div class="card">
									 				<div class="card-header font-weight-bold">
					                                    Cuantía
					                                    <p class="m-0">Se estima que el importe controvertido en el presente arbitraje asciende a:</p>
					                                </div>
									 				<div class="card-body">
														<div class="form-row">
									                        <div class="form-group col-lg-4">
									                            <input type="text" id="TipCuant" name="TipCuant" class="form-control" value="'.$Solicitud["desTipCuant"].'" disabled>
									                        </div>

									                        <div class="form-group col-lg-2">
									                            <input type="text" id="MonCuant" name="MonCuant" class="form-control" value="'.$Solicitud["DesMon"].'" disabled>						                                
									                        </div>

									                        <div class="form-group col-lg-2">
									                            <input type="text" id="ImpNCuant" name = "ImpNCuant" class="form-control"  value="'.$Solicitud['ImpNCuant'].'" disabled>
									                        </div>

									                        <div class="form-group col-lg-4">
									                            <input type="text" id="ImpLCuant" name = "ImpLCuant" class="form-control" value="'.$Solicitud['ImpLCuant'].'" disabled>
									                        </div>

									                    </div>
									 				</div>
									 			</div>
									 		</div>
									 	</div>
					                </div>
									<!-- ------------------------------------------------------------------------------------- -->
									<div role="tabpanel" class="tab-pane fade p-4"  id="tabDesigArbitro">
										<div class="row">
											<div class="col-sm-12">
												<div class="card">
													<div class="card-header font-weight-bold">
					                                    Designación de Árbitro
					                                    <p class="m-0">De corresponder, complete la información del árbitro único propuesto o del árbitro que conformara el Tribunal Arbitral.</p>
					                                </div>
													<div class="card-body">
														<div class="form-row">
						                         			<div class="col-sm-6">
									                            <div class="form-group">
									                            	<label>Nombre de Árbitro</label>
									                                <input type="text" class="form-control" name = "ApeNomArb" value="'.$Solicitud['ApeNomArb'].'" disabled>
									                            </div>
									                         </div>

								                         <div class="col-sm-6">
								                            <div class="form-group">
								                            	<label>Dirección</label>
								                                <input type="text" class="form-control" name = "DesDirArb" value="'.$Solicitud['DesDirArb'].'" disabled>
								                            </div>
								                         </div>

								                         <div class="col-sm-2">
								                            <div class="form-group">
								                            	<label>Celular</label>
								                                <input type="text" class="form-control" name = "NumTelArb" value="'.$Solicitud['NumTelArb'].'" disabled>
								                            </div>
								                         </div>

								                         <div class="col-sm-4">
								                            <div class="form-group">
								                            	<label>Correo electrónico</label>
								                                <input type="text" class="form-control" name = "DirEmaArb" value="'.$Solicitud['DirEmaArb'].'" disabled>
								                            </div>
								                         </div>

								                         <div class="col-sm-3">
								                            <div class="form-group">
								                            	<label>Profesión</label>
								                                <input type="text" class="form-control" name = "NomProArb" value="'.$Solicitud['NomProArb'].'" disabled>
								                            </div>
								                         </div>

								                         <div class="col-sm-3">
								                            <div class="form-group">
								                            	<label>N° Colegiatura</label>
								                                <input type="text" class="form-control" name = "NumColArb" value="'.$Solicitud['NumColArb'].'" disabled>
								                            </div>
								                         </div>

								                         <div class="col-sm-8">
								                            <div class="form-group">
								                                <label>¿Esta inscrito en Registro de Árbitros (OSCE)?</label>
								                                <div class="custom-control custom-checkbox chk">
								                                    <input type="checkbox" class="custom-control-input"  id="FlgRegArb" name ="FlgRegArb" value="Yes"';
								                                    if($Solicitud['FlgRegArb']=='1'){
								                                     echo 'checked';
								                                 	}
								                                 	echo ' disabled><label class="custom-control-label" for="FlgRegArb">Si</label>
								                                </div>
								                            </div>    
								                        </div>
								                        
								                        <div class="col-sm-12">
								                            <div class="form-group">
								                                <label>En caso no desee designar árbitro de parte, marque la siguiente opción : </label>
								                                <div class="custom-control custom-checkbox chk">
								                                    <input type="checkbox" class="custom-control-input" id="FlgPrtArb" name ="FlgPrtArb" value="Yes"';
								                                    if($Solicitud['FlgPrtArb']=='1'){ 
								                                    	echo 'checked';
								                                    }
								                                    echo ' disabled><label class="custom-control-label" for="FlgPrtArb">El Centro de Arbitraje designe al árbitro de parte.</label>
								                                </div>
								                            </div>    
								                        </div>

								                        <div class="col-sm-12">
								                            <div class="form-group">
								                                <label>En caso de Árbitro Único y no exista intención de acuerdo sobre la designación de Árbitro Único, marque la siguiente opción :</label>
								                                <!-- ================================================================================================ -->
								                                <div class="custom-control custom-checkbox chk">
								                                    <input  type="checkbox" class="custom-control-input" id="FlgUniArb" name ="FlgUniArb"  value="Yes"';
								                                    if($Solicitud['FlgUniArb']=='1'){
								                                    	echo 'checked';
								                                	}
								                                	echo ' disabled><label class="custom-control-label" for="FlgUniArb">El Centro de Arbitraje designe al árbitro Único.</label>
								                                </div>
								                            </div>    
								                        </div>

								                    </div>

													</div>
												</div>
											</div>
										</div>
					                </div>
									<!-- ------------------------------------------------------------------------------------- -->
									<div role="tabpanel" class="tab-pane fade p-4"  id="tabAnexos">
              							<div class="row">
											<div class="col-sm-12">
												<div class="card">
													<div class="card-header font-weight-bold">
					                                    Anexos
					                                    <p class="m-0">Información de Anexos</p>
					                                </div>
													<div class="card-body">
                										<div class="form-row">
										                    <div class="table-responsive">
										                        <table class="table TablaSistema" id="tbArchivos">
										                            <thead>
										                                <tr class="text-center">
										                                    <th width="10%">Item</th>
										                                    <th width="10%" class="ColOculto">IdAnexo</th>
										                                    <th width="10%" class="ColOculto">IdTipo</th>
										                                    <th width="30%">Tipo</th>
										                                    <th width="30%">Archivo</th>
										                                    <th width="10%">Descargar</th>
										                                </tr>
										                            </thead>
										                            <tbody>';
										                            
										                            $vflag = "'N'";
										                            $cnt = 0;
										                            foreach ($MSolicitudAnexo as $key => $value) {
										                                $cnt++;
										                                echo '<tr id="fila'.$cnt.'">';
										                                   echo '<td class="text-center">'. $cnt.'</td>';
										                                   echo '<td class="text-center ColOculto">'. $value["idAnexo"].'</td>';
										                                   echo '<td class="text-center ColOculto">'. $value["idTipo"].'</td>';
										                                   echo '<td class="text-center">'. $value["desanx"].'</td>';
										                                   echo '<td class="text-center">'. $value["nomFileLoc"].'</td>';
																			   echo '<td class="text-center">
																			   			<a href="upload/'.$value['nomFileSer'].'" class="btn btn-block btn-success" download>
																			   				<i class="fa fa-download"></i> Descargar
																			   			</a>
																			   		</td>';
										                                 echo '</tr>';
										                                }

										                        echo '</tbody>
								                        </table>
								                    </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<!-- ------------------------------------------------------------------------------------- -->
            		</div>'; 
				}	/* Fin isnumeric */
   		 	} /* Fin isset*/
		?>
    </div> <!-- card-body -->
    <div class="card-footer">
    	<div class="col-sm-12 text-center">
	    	<button type="button" class="btn btn-info" id="btndocAnx" onclick=""><i class="fa fa-chain-broken"></i> Documentos Anexos</button>
			<button type="button" class="btn btn-info" id="btndocAdj" onclick=""><i class="fa fa-chain-broken"></i> Documentos Adjuntos</button>
		</div>
    </div>
</div> <!-- card -->
<!--==============================================
	MODAL : DOCUMENTOS ANEXOS
===============================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdldocumentosAnexos">
	<div class="modal-dialog modal-dialog-centered" role="document">
   		<div class="modal-content">
	      	<div class="modal-header">
			 
	        	<h5 class="modal-title"><i class="fa fa-tags"></i> Documentos Anexos </h5>
				<!--==============================================
					UNIR PDF: SOLICITUD DE ARBITRAJE
				===============================================-->
				<?php 
				if(isset($_GET['id'])){

					if(is_numeric($_GET['id'])){
   		 			$pdf ='';
					$id = $_GET['id'];
					$DocAnexos = $SolicitudAnexo->ListarSolicitudAnexo($id);
						foreach ($DocAnexos as $key => $value) {
							$pdf.=$value['nomFileSer'].',';
						}
				
					echo '<a href="/tramite/vistas/upload/unirPdf.php/?id='.$pdf.'" class="btn btn-warning" target="_blank">
						<i class="fa fa-download"> DESCARGAR TODO</i> 
					</a>';
					
					}
				}
				?>
				
	      	</div>
	      	<div class="modal-body">
	      		<table class="table table-bordered">
      				<thead>
      					<tr class="text-center">
	      					<th width="10%">Item</th>
	      					<th width="30%">Archivo</th>
	      					<th width="60%">Acción</th>	
      					</tr>		      					
      				</thead>
      				<tbody>
      					<?php
      					$DocAnexos = $SolicitudAnexo->ListarSolicitudAnexo($id);
						 
      					foreach ($DocAnexos as $key => $value) {
      						echo '<tr>
      								<td>'.$value['idAnexo'].'</td>
      								<td>'.$value['desanx'].'</td>
      								<td>
      									<a href="upload/'.$value['nomFileSer'].'" class="btn btn-warning" target="_blank">
      										<i class="fa fa-download"></i> '.$value['nomFileLoc'].'
      									</a></td>
      							  </tr>';	
      					}
      					?>
      				</tbody>
      			</table>
	      	</div>
	    </div>
	</div>
</div>
<!--==============================================
	MODAL : (DOCUMENTOS ADJUNTOS)
===============================================-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdldocumentosAdjuntos">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
   		<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title"><i class="fa fa-tags"></i> Documentos Adjuntos</h5>
	      	</div>
	      	<div class="modal-body">
      			<table class="table table-bordered">
      				<thead>
      					<tr class="text-center">
	      					<th width="5%">Item</th>
	      					<th width="25%">Área de Origen</th>
	      					<th width="65%">Detalles del envío</th>
	      					<th width="5%">( <i class="fa fa-file-text"></i> ) Adjunto</th>	
      					</tr>		      					
      				</thead>
      				<tbody>
      					<?php
							$DocAdjuntos = $SolicitudRutas->ListarRutas($id);
							foreach ($DocAdjuntos as $key => $value) {
							echo '<tr>
									<td class="align-middle text-center">'.$value['idruta'].'</td>
									<td class="align-middle"><strong>'.$value['desareaenvio'].'</strong></td>
									<td class="align-middle">
										<strong>'.$value['asunto'].'</strong>
										<p>'.$value['contenido'].'</p>
										<p>Documento de Atención: '.$value['destipdoc'].' - '.$value['numdocint'].'</p>
									</td>
									<td class="align-middle">
										<a href="upload/'.$value['nomFileSer'].'" class="btn btn-warning" target="_blank">
											<i class="fa fa-download"></i> Descargar
										</a>
									</td>
	      						</tr>';
							}
      					 ?>
      				</tbody>
      			</table>
	      	</div>
    	</div>
    </div>
</div>
<?php 
	include_once 'componentes/footer.php';
?>