<?php 
/* Componentes HTML */
include_once 'componentes/header.php';
include_once 'componentes/navbar.php';
?>
<nav aria-label="breadcrumb" class="m-4">
    <ol class="breadcrumb migas">
        <li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-home"></i> Panel Principal</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Usuarios</li>
    </ol>
</nav>
<div class="card m-4">
    <div class="card-body">
        <h2 class="titulo"><i class="fa fa-comment icoLogo"></i> Usuarios</h2>
        <p class="subtitulo">Relación de Usuarios con accesos al Sistema</p>
        
        <div class="form-row">
            <div class="form-group col-lg-2 col-12">
                <input type="text" class="form-control" placeholder="Ingrese el nombre del usuario" id="NomUsr" name ="NomUsr">
            </div>
            <div class="form-group col-lg-3 col-12">
                <input type="text" class="form-control" placeholder="Ingrese el Número de Documento de Identidad" id="NumDocIde" name ="NumDocIde">
            </div>
            <div class="form-group col-lg-2 col-12">
                <button type="button" class="btn btn-outline-success btn-block" id="btnBuscarUsr">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
            <div class="form-group col-lg-2 col-12">
                <button class="btn btn-block btn-outline-danger" id="btnNuevoUsr">
                    <i class="fa fa-plus"></i> Nuevo usuario 
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table TablaSistema" id="tblUsuarios" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th width="5%">Nro.</th>
                        <th width="25%">Área</th>
                        <th width="10%">Nombre</th>
                        <th width="12%">Apellido Paterno</th>
                        <th width="12%">Apellido Materno</th>
                        <th width="19%">Cargo</th>
                        <th width="5%">Estado</th>
                        <th width="7%">Alta</th>
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
<div class="modal fade" id="mdlEditarUsuario" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

	        <div class="modal-header">
	            <h5 class="modal-title" id="mdlUsrTit"></h5>

    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
            	</button>
            </div>

            <div class="modal-body">

                <form method="POST" id="frmUsuario">

                    <input type="text" class="form-control" id="idUsr" name ="idUsr" style="display: none;">                    
                	<div class="form-row">
                		<div class="col-sm-6">
                			<div class="form-group"> 
                             	<label>Número de Documento de Identidad</label>
                                <input class="form-control input_num" id="numdoi" name="numdoi" placeholder="Ejemplo: 47335689">
                            </div>
                		</div>
                		<div class="col-sm-6">
                			<div class="form-group"> 
                             	<label>Nombre</label>
                                <input class="form-control" id="nomusr" name="nomusr" placeholder="Ingrese su nombre">
                            </div>
                		</div>

                		<div class="col-sm-6">
                			<div class="form-group"> 
                             	<label>Apellido Paterno</label>
                                <input class="form-control" id="apepat" name="apepat" placeholder="Ingrese el apellido paterno">
                            </div>
                		</div>

                		<div class="col-sm-6">
                			<div class="form-group"> 
                             	<label>Apellido Materno</label>
                                <input class="form-control" id="apemat" name="apemat" placeholder="Ingrese el apellido materno">
                            </div>
                		</div>

    					<div class="col-sm-6">
                			<div class="form-group"> 
                             	<label>Correo</label>
                                <input class="form-control" id="direma" name="direma" placeholder="Ingrese el correo electrónico">
                            </div>
                		</div>
                        <div class="col-sm-6">
                			<div class="form-group"> 
                             	<label>Telefono</label>
                                <input class="form-control" id="numtel" name="numtel" placeholder="Ingrese su numero de teléfono">
                            </div>
                		</div>
                            <div class="col-sm-8">
                                <div class="form-group"> 
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Ingrese su contraseña">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group-append">
                                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()" style="margin-top: 25px;margin-left: -48px;"> <span class="fa fa-eye-slash icon"></span> </button>
                                </div>
                            </div>

                		<div class="col-sm-12">
                			<div class="form-group"> 
                             	<label>Área</label>                           
                                <select class="form-control" id="nomarea" name="nomarea" title="Seleccionar">
                                    <?php 
                                        foreach ($MArea as $key => $value) {
                                            echo '<option value="'.$value['id'].'">'.$value['desarea'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                		</div>            		

                		<div class="col-sm-12">
                			<div class="form-group"> 
                             	<label>Cargo</label>
    							<select class="form-control" id="nomcargo" name="nomcargo" title="Seleccionar">
                                	<?php 
                                        foreach ($MCargo as $key => $value) {
                                            echo '<option value="'.$value['id'].'">'.$value['descargo'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                		</div>
    					
    					<div class="col-sm-12">
                			<div class="form-group"> 
                             	<label>Perfil</label>
                                <select class="form-control" id="nomperfil" name="nomperfil" title="Seleccionar">
                                	<?php 
                                        foreach ($MPerfil as $key => $value) {
                                            echo '<option value="'.$value['id'].'">'.$value['desperfil'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                		</div>            		
                	</div>
                </form>
            </div>

            <div class="modal-footer">
	            <button type="button" class="btn btn-success" id="btnGuardarUsuario"><i class="fa fa-thumbs-o-up"></i> Guardar </button> 
				<button type="button" class="btn btn-danger" data-dismiss = "modal"><i class="fa fa-sign-out"></i> Salir </button> 
            </div>
        </div>
    </div>
</div>
<!-- ============================================ -->
 <?php 
	include_once 'componentes/footer.php';
?>