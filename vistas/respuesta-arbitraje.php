<?php
	/* Componentes HTML */
	include_once 'componentes/header.php';
	include_once 'componentes/navbar.php';
?>

<div class="card m-3">
    <div class="card-body">
        <h2 class="titulo"><i class="fa fa-edit icoLogo"></i> Respuestas de Arbitraje</h2>
        <p class="subtitulo">Aquí podras realizar el seguimiento de tu Tramite.</p>

               <!-- ENCABEZADOS DE LISTA -->
		<ul class="nav nav-tabs pnlRegistro"  id="myTab">
			    <li class="nav-item"> <a class="nav-link active show" data-toggle="pill" data-target="#tabDemandado"><i class="fa fa-arrow-right"></i>&nbsp;Demandado</a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabNarracionHechos"><i class="fa fa-arrow-right"></i>Posición de Hechos</a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabPretensiones"><i class="fa fa-arrow-right"></i> Pretensiones</a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabCuantia"><i class="fa fa-arrow-right"></i> Cuantía</a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="pill" data-target="#tabDesigArbitro"><i class="fa fa-arrow-right"></i> Designación de Árbitro</a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="pill" id="TabAnexoMostar" data-target="#tabAnexos"><i class="fa fa-arrow-right"></i> Anexos</a> </li>
	  </ul>

          <div class="tab-content">

	  		<!-- Tab uno -->
        <div role="tabpanel" class="tab-pane  active show fade p-3"  id="tabDemandado">
                     <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Demandado
                                    <p class="m-0">Información de Demandado</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Nombre o Razón Social</label>
                                            <input class="form-control" id="txtRazSocDmd" name="RazSocDmd" placeholder="Ejemplo:Juan Carlos Montenegro Vega">
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Domicilio</label>
                                                <input class="form-control" id="txtDesDirDmd" name="DesDirDmd" placeholder="Ejemplo: Los Manzanos N° 125 - Residencial San Luis, distrito de San Borja,  provincia y región de Lima">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Tipo de Documento</label>
                                                <select id="TipDocDmd" name="TipDocDmd" class="form-control cbo">
                                                    <option value="1">DOCUMENTO NACIONAL DE IDENTIDAD</option><option value="2">REGISTRO ÚNICO DE CONTRIBUYENTE</option><option value="3">CARNET DE EXTRANJERÍA</option><option value="4">PASAPORTE</option>                                                </select>
                                            </div>
                                        </div>
                                         <div class="col-sm-3">
                                            <div class="form-group"> <label>Número de Documento</label>
                                                <input class="form-control input_num" id="txtNumDocDmd" name="NumDocDmd" maxlength="11" placeholder="Ingrese número de documento">
                                                <div id="msgval3" class="errores"> Para este tipo de documento debe ingresar 0 digitos </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>cod. ciudad + Teléfono Fijo.</label>
                                                <input class="form-control input_tel" name="NumTelDmd" placeholder="Ejemplo: (51) 5701863">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Celular</label>
                                                <input class="form-control input_tel" name="NumCelDmd" placeholder="Ejemplo: 999999999">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Correo Electrónico</label>
                                                <input class="form-control" name="DirEmaDmd" id="txtDirEmaDmd" placeholder="Ejemplo:juan59@outlook.com">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"> <label>Autoridad o representante</label>
                                                <input class="form-control" name="AutRepDmd" id="txtAutRepDmd" placeholder="Ingrese la autoridad o representante">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> <label>Procurador público/abogado</label>
                                                <input class="form-control" name="ProPubDmd" id="txtProPubDmd" placeholder="Ingrese el procurador público/abogado">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success p-2 anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                        </div> 
                                        <div class="col-sm-6 text-right">
                                            <button type="button" class="btn btn-success p-2 siguiente">
                                                <i class="fa fa-forward"></i> Siguiente 
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabDemandado -->
  

              <div role="tabpanel" class="tab-pane fade p-4"  id="tabNarracionHechos">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Posición de los Hechos
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                        <div class="form-group">                                     
                                            <label>Que, negamos y contradecimos la posición de:</label>
                                            <input class="form-control input_tel" name="NumCelDmd" placeholder="La parte Demandante">
                                            <p>a que declaremos/procedamos/cumplamos/con</p>
                                        </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="txtDesNarHec" name = "DesNarHec" rows="6" placeholder="Ingrese un resumen claro de los hechos que han generado la controversia."></textarea>
                                            </div>
                                            <p>Que en tal sentido corresponde que un Tribunal Arbitral (ó Arbitro Único), proceda a resolver las controversias que mantenemos con nuestra contraparte</p>
                                            <div class="form-group">
                                                <textarea class="form-control" id="txtDesNarHec" name = "DesNarHec" rows="6" placeholder="Ingrese un resumen claro de los hechos que han generado la controversia."></textarea>
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
             </div><!-- fin tabpanel : tabNarracionHechos -->

                   <!-- PRETENSIÓN DE RECONVENCIÓN -->
             <div role="tabpanel" class="tab-pane fade p-4"  id="tabPretensiones">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    PRETENSIÓN DE RECONVENCIÓN
                                    <p>Que el Tribunal Arbitral (o Árbitro Único) declare Nulo y sin efecto legal la solicitud del</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="txtPretensiones" name = "DesNarHec" rows="6" placeholder="Ingrese un resumen claro de los hechos que han generado la controversia."></textarea>
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
                </div><!-- fin tabpanel : PRETENCION DE RECONVENCIÓN -->

                <!--  CUANTÍA DE LA RECONVENCIÓN -->

                <div role="tabpanel" class="tab-pane fade p-4"  id="tabCuantia">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    CUANTÍA DE LA RECONVENCIÓN
                                    <p class="m-0">Señalar las posibles pretensiones y el monto involucrado, en cuanto sea cuantificable. <br>
                                                 </p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="txtCuantia" name = "DesNarHec" rows="6" placeholder=""></textarea>
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
                </div><!-- fin tabpanel :  CUANTÍA DE LA RECONVENCIÓN -->

                <!-- DESIGNACIÓN DE ÁRBITRO. DE CORRESPONDER -->

                <div role="tabpanel" class="tab-pane fade p-4"  id="tabDesigArbitro">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Designación de Árbitro
                                    <p class="m-0">De corresponder, complete la información del árbitro único propuesto o del árbitro que conformara el Tribunal Arbitral.</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="form-group"><label>Nombre de Árbitro</label>
                                                <input type="text" class="form-control" id="txtApeNomArb" name = "ApeNomArb" placeholder="Ejemplo:Juan Carlos Montenegro Vega"></input>
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
                                            </div>
                                         </div>

                                         <div class="col-sm-4">
                                            <div class="form-group"><label>Correo electrónico</label>
                                                <input class="form-control" name = "DirEmaArb" id="txtDirEmaArb" placeholder="Ejemplo: juan59@outlook.com"></input>
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

                                         <div class="col-sm-8">
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
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <p>En caso no desee designar árbitro de parte, marque la siguiente opción: </p>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="FlgPrtArb" name ="FlgPrtArb" value="Yes">
                                                    <label class="form-check-label" for="FlgPrtArb">
                                                        El Centro de Arbitraje designe al árbitro de parte.
                                                    </label>
                                                </div>
                                            </div>    
                                        </div>
                                       
                                        <div class="col-sm-12">
                                            <div class="form-group">    
                                                <p>En caso de Árbitro Único y no exista intención de acuerdo sobre la designación de Árbitro Único, marque la siguiente opción :</p>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="FlgUniArb" name ="FlgUniArb" value="Yes">
                                                    <label class="form-check-label" for="FlgUniArb">
                                                        El Centro de Arbitraje designe al árbitro Único.
                                                    </label>
                                                </div>                            
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
                </div><!-- fin tabpanel : tabDesigArbitro -->

                <div role="tabpanel" class="tab-pane fade p-4"  id="tabAnexos">
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
                                            <option value="0">Seleccione tipo de documento</option>
                                            <option value="1">Comprobante de Pago</option><option value="2">Copia de DNI</option><option value="3">Copia de Poder de Representante</option><option value="4">Copia de Contrato de Arbitraje</option><option value="5">Copia de Contrato de Consorcio</option><option value="6">Copia de Documentos relacionados</option><option value="7">Copia de Actuados Judiciales</option><option value="8">Escritura pública</option><option value="9">Acta legalizada</option><option value="10">Copia literal de registros públicos</option><option value="11">Vigencia de poder de registros públicos</option><option value="12">Copia de la ficha ruc de la empresa</option><option value="13">Copia de los documentos relacionados a la controversia</option><option value="14">Copia de la ficha ruc de la empresa</option><option value="15">Copia de contrato/orden compra/orden de servicio</option><option value="16">Otros documentos</option>                                                    </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="NomArcReq" lang="es">
                                            <label class="custom-file-label" id="labelNombreReq" for="NomArcReq">Seleccionar archivo</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-2 col-12">
                                        <button type="button" class="btn btn-outline-success btn-block btnAgregar" id="btnAgregarAnxOtros" formenctype="multipart/form-data">
                                            <i class="fa fa-plus"></i> Agregar 
                                        </button>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                        <div class="col-lg-12 col-12">
                                            <table class="table TablaSistema" id="tbArchivos">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="10%" style="cursor: pointer;"><i class="fa fa-arrows-v" aria-hidden="true"></i> Fila</th>
                                                        <th width="10%" class="ColOculto">IdAnexo</th>
                                                        <th width="10%" class="ColOculto">IdTipo</th>
                                                        <th width="20%" style="cursor: pointer;"><i class="fa fa-arrows-v" aria-hidden="true"></i> Tipo</th>
                                                        <th width="30%" style="cursor: pointer;"><i class="fa fa-arrows-v" aria-hidden="true"></i> Archivo</th>
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
                                        <div class="col-md-6 col-sm-12 mb-1 text-left">
                                            <button type="button" class="btn btn-success anterior">
                                                <i class="fa fa-backward"></i> Anterior 
                                            </button>
                                         </div> 

                                        <div class="col-md-3 col-sm-12 mb-1">
                                            <!-- <a href="https://www.visanetlink.pe/pagoseguro/CEARLATINOAMERICANO/446874" class="btn btn-success" target="_blank">
                                                <i class="fa fa-shopping-cart"></i> Pagar
                                            </a> -->
                                        </div>

                                        <div class="col-md-3 col-sm-12 text-right">
                                            <button type="submit" class="btn btn-success btnRegistrar">
                                                <i class="fa fa-save"></i> Generar Solicitud de Arbitraje 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- fin tabpanel : tabAnexos -->
               

          </div>
          </div>
	  	</div>










<?php 
include_once 'componentes/footer.php';
?>