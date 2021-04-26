$(document).ready(function(){

    //Validar para que solo permita cargar formato pdf
	$('#NomArcReq1').on('change', function(){
		var ext = $('#NomArcReq1').val().split('.').pop();
		if ($('#NomArcReq1').val() != '') {
		  if(ext == "pdf"){
			
		  }
		  else
		  {
			alert("Extensión no permitida: " + ext);
			$('#NomArcReq1').val('');
			$("#labelNombreReq1").text("Seleccionar archivo");
		  }
		}
	  });
      $('#NomArcReq2').on('change', function(){
		var ext = $('#NomArcReq2').val().split('.').pop();
		if ($('#NomArcReq2').val() != '') {
		  if(ext == "pdf"){
			
		  }
		  else
		  {
			alert("Extensión no permitida: " + ext);
			$('#NomArcReq2').val('');
			$("#labelNombreReq2").text("Seleccionar archivo");
		  }
		}
	  });
      $('#NomArcReq3').on('change', function(){
		var ext = $('#NomArcReq3').val().split('.').pop();
		if ($('#NomArcReq3').val() != '') {
		  if(ext == "pdf"){
			
		  }
		  else
		  {
			alert("Extensión no permitida: " + ext);
			$('#NomArcReq3').val('');
			$("#labelNombreReq3").text("Seleccionar archivo");
		  }
		}
	  });
      $('#NomArcReq4').on('change', function(){
		var ext = $('#NomArcReq4').val().split('.').pop();
		if ($('#NomArcReq4').val() != '') {
		  if(ext == "pdf"){
			
		  }
		  else
		  {
			alert("Extensión no permitida: " + ext);
			$('#NomArcReq4').val('');
			$("#labelNombreReq4").text("Seleccionar archivo");
		  }
		}
	  });

      $('#NomArcReq').on('change', function(){
		var ext = $('#NomArcReq').val().split('.').pop();
		if ($('#NomArcReq').val() != '') {
		  if(ext == "pdf"){
			
		  }
		  else
		  {
			alert("Extensión no permitida: " + ext);
			$('#NomArcReq').val('');
			$("#labelNombreReq").text("Seleccionar archivo");
		  }
		}
	  });

})