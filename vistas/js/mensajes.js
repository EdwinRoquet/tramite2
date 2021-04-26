$(document).ready(function(){
	 $('#tblMensajes').DataTable({
	 	"destroy":true,
	 	"language" : idioma_espanol,
		    "ordering": true,
	  	  	"searching": true,
	    	"lengthMenu": [[5, 10, 15, 20],[5, 10, 15, 20]]
	 });
});

