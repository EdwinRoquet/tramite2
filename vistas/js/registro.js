/*  =======================================
	Funcionalidades JavaScript
	---------------------------------------
	Autor : David Montenegro Sarmiento
	Fecha : 18/05/2020
	Hora  : 10:35 pm
    ======================================= */

$(document).ready(function(){

/*  =======================================
	AVANZAR TAB-PAGE
    ======================================= */
	$(".siguiente").click(function(){
   		$('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
    
  	});

/*  =======================================
	RETROCEDER TAB-PAGE
    ======================================= */
    $(".anterior").click(function(){
   		$('.nav-tabs > .nav-item > .active').parent().prev('li').find('a').trigger('click');
   
  	});

/*  =======================================
	EFECTO QUITAR CHECKED - CHK1
    ======================================= */
	$( "#FlgPrtArb" ).on( "click", function() {
	
	  	if($( "#FlgPrtArb:checked" ).val() == "Yes"){ $("#FlgUniArb").prop("checked", !this.checked);}

	  	if( $("#FlgPrtArb:checked").val() == "Yes" || $("#FlgUniArb:checked").val() == "Yes"){
	  		// desabilitar elementos
			$("#txtApeNomArb").prop( "disabled", true ); $("#txtApeNomArb").val('');
			$("#txtDesDirArb").prop( "disabled", true ); $("#txtDesDirArb").val('');
			$("#txtNumTelArb").prop( "disabled", true ); $("#txtNumTelArb").val('');
			$("#txtDirEmaArb").prop( "disabled", true ); $("#txtDirEmaArb").val('');
			$("#txtNomProArb").prop( "disabled", true ); $("#txtNomProArb").val('');
			$("#txtNumColArb").prop( "disabled", true ); $("#txtNumColArb").val('');
			// $("#FlgRegArb").prop( "disabled", true )   ; $("#FlgRegArb").prop("checked", !this.checked);
		
	  	}else{
	  		// habilitar elementos
			$("#txtApeNomArb").prop( "disabled", false );
			$("#txtDesDirArb").prop( "disabled", false );
			$("#txtNumTelArb").prop( "disabled", false );
			$("#txtDirEmaArb").prop( "disabled", false );
			$("#txtNomProArb").prop( "disabled", false );
			$("#txtNumColArb").prop( "disabled", false );
			$("#FlgRegArb").prop( "disabled", false );
	  	}
	});

/*  =======================================
	EFECTO QUITAR CHECKED - CHK1
    ======================================= */
	$( "#FlgUniArb" ).on( "click", function() {
		
  		if($( "#FlgUniArb:checked" ).val() == "Yes"){$("#FlgPrtArb").prop("checked", !this.checked);}
  		
  		if( $("#FlgPrtArb:checked").val() == "Yes" || $("#FlgUniArb:checked").val() == "Yes"){
	  		// desabilitar elementos
			$("#txtApeNomArb").prop( "disabled", true ); $("#txtApeNomArb").val(''); 
			$("#txtDesDirArb").prop( "disabled", true ); $("#txtDesDirArb").val('');
			$("#txtNumTelArb").prop( "disabled", true ); $("#txtNumTelArb").val('');
			$("#txtDirEmaArb").prop( "disabled", true ); $("#txtDirEmaArb").val('');
			$("#txtNomProArb").prop( "disabled", true ); $("#txtNomProArb").val('');
			$("#txtNumColArb").prop( "disabled", true ); $("#txtNumColArb").val('');
			$("#FlgRegArb").prop( "disabled", true )   ; $("#FlgRegArb").prop("checked", !this.checked);
		
	  	}else{
	  		// habilitar elementos
			$("#txtApeNomArb").prop( "disabled", false );
			$("#txtDesDirArb").prop( "disabled", false );
			$("#txtNumTelArb").prop( "disabled", false );
			$("#txtDirEmaArb").prop( "disabled", false );
			$("#txtNomProArb").prop( "disabled", false );
			$("#txtNumColArb").prop( "disabled", false );
			$("#FlgRegArb").prop( "disabled", false );
	  	}
	});

/*  ============================================================
	CONVERTIR NUMERO EN LETRAS (se quito funcionalidad 08062020)
    ============================================================ */
    /*
	$( "#ImpNCuant" ).keyup(function() {
		var nNum = $( "#ImpNCuant" ).val()
		var sNum = nn(nNum);
  		$( "#ImpLCuant" ).val(sNum);
	});
	*/
/*  =======================================
	CARGAR RUTA COMPLETA DE ARCHIVO A SUBIR
    ======================================= */
	$(".custom-file-input").on("change", function() {
  		/* mostrar : solo nombre de archivo*/
  		var fileName = $(this).val().split("\\").pop();
  		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});


/*  =======================================
	SELECCION DE COMBOBOX
    ======================================= */
    $("#MonCuant").css("display", "none");
	$("#ImpNCuant").css("display", "none");
	$("#ImpLCuant").css("display", "none");
	
/*	if ($('#TipCuant').val() == "1" || $('#TipCuant').val() == "2" || $('#TipCuant').val() == "Seleccione" || $('#TipCuant').val() == "Indeterminado" ){
	 	  	$("#MonCuant").css("display", "none");
	 	  	$("#ImpNCuant").css("display", "none");
	 	  	$("#ImpLCuant").css("display", "none");

	  }else{
			$("#MonCuant").css("display", "block");
			$("#ImpNCuant").css("display", "block");
	 	  	$("#ImpLCuant").css("display", "block");
	  }*/

/*  =======================================
	DECLARACION DE VARIABLES
    ======================================= */
  
	var url = window.location.href;
	var indice = url.split("/");
	var nomPag = indice[indice.length - 1];

/*  =======================================
	CONTROL DE VINCULOS ACTIVOS
    ======================================= */
	$("#lnkInicio").removeClass("active");
	$("#lnkConsulta").removeClass("active");
	$("#lnkSolicitud").removeClass("active");

	switch (nomPag) {
		case 'principal.php':
			$("#lnkInicio").addClass("active");
			break;

		case 'consulta.php':
			$("#lnkConsulta").addClass("active");
			break;
			
		case 'solicitud.php':
			$("#lnkSolicitud").addClass("active");
			break;
	}

/*  =====================================================
	SOLO NUMEROS (CASO TELEFONOS LIMITADO A 9 CARACTERES)
    ===================================================== */
	jQuery('.input_tel').keypress(function(tecla) {
        if(tecla.charCode < 48 || tecla.charCode > 57 || this.value.length == 9) return false;
    });

    jQuery('.input_num').keypress(function(tecla) {

       if(tecla.charCode >= 48 && tecla.charCode <= 57){
        	// permitir
        } else {
        	if(tecla.charCode == 46){
        		// permitir
        	}else{
        		return false;
        	}        
       	}
    });

/*  =======================================
	SELECCION DE TIPO DE CUANTIA
    ======================================= */
    $('#TipCuant').on('change', function() {
	  if (this.value == "0" || this.value == "1"){
	 	  	$("#MonCuant").css("display", "none");
	 	  	$("#ImpNCuant").css("display", "none");
	 	  	$("#ImpLCuant").css("display", "none");

	  }else{
			$("#MonCuant").css("display", "block");
			$("#ImpNCuant").css("display", "block");
	 	  	$("#ImpLCuant").css("display", "block");
	  }
	});


	/* TIPO DE DOCUMENTO DE IDENTIDAD DEMANDANTE */
	$("#TipDocDem").on("change",function(){
		ValidaComboTipDoc(this.value,$("#txtNumDocDem").val(),$("#msgval1"));
	})
	/*TIPO DE DOCUMENTO DE IDENTIDAD REPRESENTANTE*/
	$("#TipDocRep").on("change",function(){
		ValidaComboTipDoc(this.value,$("#txtNumDocRep").val(),$("#msgval2"));
	})
	/*TIPO DE DOCUMENTO DE IDENTIDAD DEMANDADO*/
	$("#TipDocDmd").on("change",function(){
		ValidaComboTipDoc(this.value,$("#txtNumDocDmd").val(),$("#msgval3"));
	})

	$("#txtNumDocDem").keyup(function(){
		ValidaComboTipDoc($("#TipDocDem").val(),$("#txtNumDocDem").val(),$("#msgval1"));
	})

	$("#txtNumDocRep").keyup(function(){
		ValidaComboTipDoc($("#TipDocRep").val(),$("#txtNumDocRep").val(),$("#msgval2"));
	})
	$("#txtNumDocDmd").keyup(function(){
		ValidaComboTipDoc($("#TipDocDmd").val(),$("#txtNumDocDmd").val(),$("#msgval3"));
	})
	
})
/*  ***************************************************************************************************************************** */
/* =================================
   FUNCIONES ADICIONALES
   =================================*/

   function ValidaComboTipDoc(cboTipdoc,txtNumDoc,msgErr){
	
		if(cboTipdoc == "1" && txtNumDoc.length != 8){
			msgErr.html("* Debe ingresar 8 digitos");
			msgErr.fadeIn("slow");

		}else if(cboTipdoc == "2" && txtNumDoc.length != 11){
			msgErr.html("* Debe ingresar 11 digitos");
			msgErr.fadeIn("slow");

		}else if(cboTipdoc == "3" && txtNumDoc.length != 8){
			msgErr.html("* Debe ingresar 8 digitos");
			msgErr.fadeIn("slow");
		
		}else if(cboTipdoc == "4" && txtNumDoc.length != 9){
			msgErr.html("* Debe ingresar 9 digitos");
			msgErr.fadeIn("slow");
		}else{
			msgErr.fadeOut();
		}

	}

   /* ======= Activar Ventana Modal ========== */
	$('#myModal').on('shown.bs.modal', function () {
  		$('#myInput').trigger('focus')
	});

	/* ============================================================================= 
	IMPORTANTE : para evitar un reenvío en los botones de actualización y retroceso 
	================================================================================ */
	if ( window.history.replaceState ) {
    	    window.history.replaceState( null, null, window.location.href );
    }  

	function ValidaEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}

