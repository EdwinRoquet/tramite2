<?php 

include_once '../../includes/solicitudanexo.php';

$salida = '';

if (isset($_POST['consulta'])) {
	
	$id = $_POST['consulta'];

	$SolicitudAnexo = new SolicitudAnexo();
    $MSolicitudAnexo = $SolicitudAnexo->ListarSolicitudAnexo($id);

	if(isset($MSolicitudAnexo)){

		if(count($MSolicitudAnexo)> 0){

			$salida = '<table class="table table-bordered table-striped">
					<tr class="text-center">
              			<th style="display:none;">Nro°</th>
              			<th>Archivo</th>
              			<th>Descargar</th>
              		</tr>';

					foreach ($MSolicitudAnexo as $key => $value) 
					{
			          $salida .= '<tr>
			            			<td style="display:none;">'.$value["idAnexo"].'</td>
			                		<td>'.$value["nomFileLoc"].'</td>
			                		<td class="text-center">
			                			<a href="upload/'.$value["nomFileSer"].'" class="btn btn-outline-dark btnAccion" id="btnDescargaAnexo" target="_blank">
											<i aria-hidden="true" title="descargar anexo" class="fa fa-download"></i>
										</a>
			                    	</td>
			            		</tr>';
			        }
         
         	$salida .= '</table>';

		} else{
			$salida = '<div class="alert alert-danger" role="alert">
  						<i class="fa fa-warning"></i> ¡No existen <strong>anexos</strong> registrados para esta solicitud!
					  </div>';
		}

	} else{
		$salida = '<div class="alert alert-danger" role="alert">
  						<i class="fa fa-warning"></i> ¡No existen <strong>anexos</strong> registrados para esta solicitud!
				</div>';
	}
}
	echo $salida;
?>