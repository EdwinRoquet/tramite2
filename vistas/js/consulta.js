$(document).ready(function(){

	/* Mostrar Solicitudes de Arbitraje por defecto */
	BuscarSolicitudArbitraje('N');
	BuscarMedidaCautelar();

	/* Buscar Solicitudes de Arbitraje*/
	$("#btnBuscarSolArb").click(function(){
		BuscarSolicitudArbitraje('N');
	});

	/*Buscar solicitudes de arbitraje por defecto admitidas*/
	BuscarSolicitudArbitrajeAdmitidas('N');
	/* Buscar Solicitudes de Arbitraje*/
	$("#btnBuscarSolArbAdmitidas").click(function(){
		BuscarSolicitudArbitrajeAdmitidas('N');
	});

	/* Nueva Solicitud */
	$('#btnNuevoSolArb').click(function(){

		swal({
			  title: "Modalidad de Registro",
			  text: "Indique la modalidad en que registrará su Solicitud",
			  icon: "warning",
			  buttons: ["Manual", "Electrónica"],
			  dangerMode: true,
			})
			.then((valor) => {
			  if (valor) {
			    location.href='solicitud.php';
			  } else {
			    location.href='solicitudmanual.php';
			  }
			});
	})

	/* Cambio dinamico en seleccion de sumilla */
	$('#idsumilla').on('change',function(){

		$("#divnomtra").css("display", "none");
		$("#divformato").css("display", "none");

		if($('#idsumilla').val() == "41"){
		 	  	$("#divnomtra").css("display", "block");
		}else if($('#idsumilla').val() == "45"){
				$("#divformato").css("display", "block");
		}
	});

});