<?php 
/* Componentes HTML */
include_once 'componentes/header.php';
include_once 'componentes/navbar.php';
?>
<div class="card m-3">
	<div class="card-body">
		<h2 class="titulo"><i class="fa fa-envelope-o"></i> Casilla Electrónica</h2>	
		<p class="subtitulo">Aquí podras consultar todos los mensajes referentes a tus Solicitudes.</p>
			
			<div class="table-responsive">
	 		<table class="table TablaSistema" id="tblMensajes">
	 			<thead>
		 			<tr>
		 				<th></th>
		 				<th>De</th>
		 				<th>Contenido del mensaje</th>
		 				<th>Fecha de Envío</th>
		 				<th>Fecha de Lectura</th>
		 				<th class="text-center">Documento Adjunto</th>
		 			</tr>
	 			</thead>
	 			<tbody>
					<?php 
					$item = 0;
					foreach ($Msolicitudobservacion as $key => $value) {
						$item ++;
						echo '<tr>
								<td class="align-middle text-center"><i class="fa fa-envelope-o"></i></td>
 								<td class="align-middle">'.$value['desarea'].'</td>
 								<td class="align-middle">
 								<strong class="text-uppercase">'.$value['numsol'].' '.$value['asunto'].'</strong>
 								<p class="font-italic">'.$value['desObservacion'].'</p>
 							</td>
 							<td class="align-middle">'.$value['fchCreacion'].' '.$value['hraCreacion'].'</td>
 							<td class="align-middle">'.$value['fchCreacion'].' '.$value['hraCreacion'].'</td>
 							<td class="align-middle text-center p-0">
 								<a href="upload/'.$value['nomFileSer'].'" class="btn btn-info">
 									<i class="fa fa-download" data-toggle="tooltip" target="_blank" title = "'.$value['nomFileLoc'].'"></i> Descargar 
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

<?php 
	include_once 'componentes/footer.php';
?>