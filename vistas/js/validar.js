/*  =======================================
	Funcionalidades JavaScript
	---------------------------------------
	Nombre : validar.js
	Autor  : David Montenegro Sarmiento
	Fecha  : 23/05/2020
	Hora   : 11:30 pm
    ======================================= */
$(document).ready(function(){

/*  =================================================
	VALIDAR FORMULARIO : CREACION DE CUENTA
	================================================= */
	$("#frmRegistro").submit(function(){
		
		// Captura de inputs
			var tipdoc = $('#cbotipdoc').val();
			var pass1  = $('#txtpasswd').val();
			var pass2  = $('#txtpasswd2').val();

 		// 1. Validación de Tipo de Documento
 			if (tipdoc == "0"){
 				$('#ModalValidaciones').modal('show');
				return false;
  			}
	});
/*  =================================================
	VALIDAR FORMULARIO : ENVIO DE DESIGNACION DE ARBITRO
	================================================= */
	$("#formEnvioConsultaArbiro").submit(function(){
		// event.preventDefault();
		
		/* =========================================== 
		   2. LECTURA DE TABLA DETALLE DE DESIGNACION DE ARBITROS
		   =========================================== */
		   var filas = $("#tbListadoArbitro tr");
		   var form = document.getElementById("formEnvioConsultaArbiro");

		   $.each(filas, function(i, v){
			   if(i!=0){
				   var fila = {};

				   fila.id_solicitud 	=  $("#id_solicitud").val();
				   fila.nombre 			=  $(this).find("td").eq(0).html();
				   fila.direccion 		=  $(this).find("td").eq(1).html();
				   fila.celular 		=  $(this).find("td").eq(2).html();
				   fila.mail 			=  $(this).find("td").eq(3).html();
				   fila.profesion 		=  $(this).find("td").eq(4).html();
				   fila.n_colegiatura 	=  $(this).find("td").eq(5).html();
				   fila.tipo_arbitro 	=  $(this).find("td").eq(6).html();
				   fila.osce 			=  $(this).find("td").eq(7).html();

				   var campo = document.createElement("input");
				   campo.type="hidden";
				   campo.name="desiganacionArbitro[]";
				   campo.value=JSON.stringify(fila);
				   console.log( campo.value);
				   form.appendChild(campo);
			   }
		   });
	});

/*  =================================================
	VALIDAR FORMULARIO : SOLICITUD (NUEVO Y EDICION)
	================================================= */
	$("#arbitraje").submit(function(){
		
		var ObsVal = '';

		/* ============================== 
		   1. Validaciones 
		   ==============================*/
		   /* 
		   	Pestaña : Demandante 
		   		- Nombre o Razón Social 
				- Número de Documento
				- Nombre de representante legal y su numero de documento
				- numero de celular
				- correo elecronico
		   */	
		   var RazSocDem = $('#txtRazSocDem').val();
		   var NumDocDem = $('#txtNumDocDem').val();
		   var ApeNomLeg = $('#txtApeNomLeg').val();
		   var NumDocRep = $('#txtNumDocRep').val();
		   var NumCelRep = $('#txtNumCelRep').val();
		   var DirEmaRep = $('#txtDirEmaRep').val();

		   if (RazSocDem == "") { ObsVal += "<li> [ Demandante ] - Nombre o Razón Social incompleto. </li>";}
		   if (NumDocDem == "") { ObsVal += "<li> [ Demandante ] - Número de Documento incompleto. </li>";}
		   if (ApeNomLeg == "") { ObsVal += "<li> [ Demandante ] - Nombre de representante legal incompleto. </li>";}
		   if (NumDocRep == "") { ObsVal += "<li> [ Demandante ] - N° de Documento de representante legal incompleto. </li>";}
		   if (NumCelRep == "") { ObsVal += "<li> [ Demandante ] - Celular de representante legal incompleto. </li>";}
	       if (DirEmaRep == '') { ObsVal += "<li> [ Demandante ] - Email de representante legal incompleto. </li>";}
	       else{
		   if(!ValidaEmail(DirEmaRep)){ObsVal += "<li> [ Demandante ] - Formato de Correo de representante legal invalido. </li>";}}

		   /*
			Pestaña : Demandado
				- Nombre o razon social
				- domicilio 
				- autoridad o representante
				- correo electronico
		   */
		   var RazSocDmd = $('#txtRazSocDmd').val();
		   var DesDirDmd = $("#txtDesDirDmd").val();
		   var AutRepDmd = $("#txtAutRepDmd").val();
		   var DirEmaDmd = $("#txtDirEmaDmd").val();
		   
		   if (RazSocDmd == "") {ObsVal += "<li> [ Demandado ] - Nombre o Razón Social incompleto. </li>";}
		   if (DesDirDmd == "") {ObsVal += "<li> [ Demandado ] - Domicilio incompleto. </li>";}
		   if (AutRepDmd == "") {ObsVal += "<li> [ Demandado ] - Autoridad o representante incompleto. </li>";}
		   if (DirEmaDmd == "") {ObsVal += "<li> [ Demandado ] - Email incompleto. </li>";}
		   else{
           if(!ValidaEmail(DirEmaDmd)) {ObsVal += "<li> [ Demandado ] - Formato de Correo invalido. </li>";}}

		   /*
			Pestaña : Tipo de Arbitraje
				- controversia
		   */
		   if(!$("#flgCtrDer").prop('checked') &&
			  !$("#flgCtrCon").prop('checked') &&
			  !$("#flgCtrNac").prop('checked') &&
			  !$("#flgCtrInt").prop('checked'))
			  {ObsVal += "<li> [ Tipo de Arbitraje ] - Debe seleccionar tipo de controversia. </li>";}
		   /*
			Pestaña : Hechos
				- Narración
		   */
			var DesNarHec = $("#txtDesNarHec").val();
		   if (DesNarHec == ""){ ObsVal += "<li> [ Hechos ] - Narración incompleta. </li>"; }
		   /*
			Pestaña : Pretensiones
				- Lista de pretensiones
		   */
		   var NumPretensiones = $("#tbPretensiones tr").length;
		   if(NumPretensiones <= 1){ObsVal += "<li> [ Pretensiones ] - Debe ingresar por lo menos una(1) pretensión. </li>"; }
		   /*
			Pestaña : Cuantia
				- Tipo
		   */
		   var TipCuant = $("#TipCuant").val();
		   if(TipCuant == "0"){ObsVal += "<li> [ Cuantia ] - Debe seleccionar un tipo de Cuantía. </li>";}

		   /*
			Pestaña : Designación de Arbitro
				- Opción
		   */
		   if(!$("#FlgPrtArb").prop('checked') && !$("#FlgUniArb").prop('checked'))
		   {
		   		if($("txtApeNomArb").val() == ""){
		   			// Si estan en blanco entonces validar contra el nombre de arbitro designado
		   	  		ObsVal += "<li> [ Designación de Árbitro ] - Debe indicar un tipo de designación. </li>";		
		   		}
		   }

        	var DirEmaArb = $("#txtDirEmaArb").val();

			/* Valida formato de correo de Arbitro*/
			if(DirEmaArb != ''){
        	if(!ValidaEmail(DirEmaArb)) {
 				ObsVal += "<li> [ Designación de Árbitro ] - Formato de Correo invalido. </li>";
        	}}
           /* ----------------------------------------------------------------------------- */
           /* Validación de documentos de identidad*/
			/*
				1 Seleccionar
				2 DOCUMENTO NACIONAL DE IDENTIDAD
				3 REGISTRO ÚNICO DE CONTRIBUYENTE
				4 CARNET DE EXTRANJERÍA
				5 PASAPORTE
			*/
			/*
			var TipDocDem = $("#TipDocDem").val();
			var TipDocRep = $("#TipDocRep").val();
			var TipDocDmd = $("#TipDocDmd").val();
			*/

		   /* ----------------------------------------------------------------------------- */
		   /* Resumen */
		   if(ObsVal != ''){
				$('#pMensaje').html('<ol>'+ObsVal+'</ol>');
		   		$('#ModalValidaciones').modal('show');
				return false;	
		   }
		   
		/* =========================================== 
		   2. LECTURA DE TABLA DETALLE DE PRETENSIONES
		   =========================================== */
			var filas = $("#tbPretensiones tr");
			var form = document.getElementById("arbitraje");

			$.each(filas, function(i, v){
				if(i!=0){
					var fila = {};

					fila.pretencion =  $(this).find("td").eq(1).html();

					var campo = document.createElement("input");
					campo.type="hidden";
					campo.name="pretenciones[]";
					campo.value=JSON.stringify(fila);

					form.appendChild(campo);
				}
			});

		/* ===========================================
		   3. LECTURA DE TABLA DETALLE DE ANEXOS
		   ===========================================*/
		   var filArc = $("#tbArchivos tr");
		   var frmArc = document.getElementById("arbitraje");

		   $.each(filArc,function(i,v){
		   	if( i!= 0 ){
		   		var fila = {};

				fila.idtipo 	= $(this).find("td").eq(2).html();
		   		fila.tipo 		= $(this).find("td").eq(3).html();
		   		fila.Archivo 	= $(this).find("td").eq(4).html();
		   		fila.esNuevo 	= $(this).find("td").eq(6).html();

		   		var campo   = document.createElement("input");
				campo.type  = "hidden";
				campo.name  = "anexos[]";
				campo.value = JSON.stringify(fila);

				frmArc.appendChild(campo);
		   	}
		   });
	});
});