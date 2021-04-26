
$(document).ready(function(){

	BuscarUsuario();

	/*  =======================================
		BUSCAR USUARIO
   		=======================================*/
		$("#btnBuscarUsr").click(function(){
			BuscarUsuario();
		});

	/*	=================================================
  		NUEVO USUARIO
  		=================================================*/	
	  	$('#btnNuevoUsr').click(function(){
	  		$('#idUsr').val('');
			$('#numdoi').val('');
			$('#nomusr').val('');
			$('#apepat').val('');
			$('#apemat').val('');
			$('#direma').val('');
			$('#numtel').val('');
			$('#passwd').val('');
			
			// $("#nomarea option[value=1]").attr("selected",true);
			// $("#nomcargo option[value=1]").attr("selected",true);
			// $("#nomperfil option[value=1]").attr("selected",true);

	  		// Abrir modal
	  		$('#mdlUsrTit').html('<i class="fa fa-user"></i> Nuevo Usuario');
			$('#mdlEditarUsuario').modal('show');
	  	})

	/*	=================================================
  		GUARDAR USUARIO
  		=================================================*/	
	  	$('#btnGuardarUsuario').click(function(){
	  		
	  		var idusr = $('#idUsr').val();
	  		var email = $("#direma").val();

	  		/*==============================
	  		  VALIDACION DE DATOS
	  		  ==============================*/
	  		  	var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

				if($('#numdoi').val() ==''){
					swal({ title : "", text : "DOCUMENTO DE IDENTIDAD, obligatorio",type : "warning"});
  					return
	  			}else if($('#nomusr').val() ==''){
	  				swal({ title : "",text : "NOMBRE DE USUARIO, obligatorio",type : "warning"});
  					return
	  			}else if($('#apepat').val() ==''){
	  				swal({ title : "",text : "APELLIDO PATERNO, obligatorio",type : "warning"});
  					return
	  			}else if($('#apemat').val() ==''){
	  				swal({ title : "",text : "APELLIDO MATERNO, obligatorio",type : "warning"});
  					return
	  			}else if($('#direma').val() ==''){
	  				swal({ title : "",text : "CORREO, obligatorio",type : "warning"});
  					return
				}else if(!expresion.test(email)){
					swal({ title : "",text : "FORMATO DE CORREO INVALIDO, verifique",type : "warning"});
  					return
				}
  				// }else if($('#nomarea').val() == '1'){
  				// 	swal({ title : "",text : "AREA, obligatoria",type : "warning"});
  				// 	return
  				// }else if($('#nomcargo').val() == '1'){
				// 	  alert($('#nomcargo').val());
  				// 	swal({ title : "",text : "CARGO, obligatoria",type : "warning"});
  				// 	return
  				// }else if($('#nomperfil').val() == '1'){
  				// 	swal({ title : "",text : "PERFIL, obligatoria",type : "warning"});
  				// 	return
  				// }

	  		/*==============================*/
	  		$.ajax({
	  			url: 'ajax/ajax-usuario-grabar.php',
	  			type: 'POST',
	  			dataType: 'html',
	  			data: $('#frmUsuario').serialize(),
	  		})
	  		.done(function(response) {

	  			if(response == 0){
	  				alert('error al grabar');
	  			}else{
	  				// Cerrar ventana modal
	  				$("#mdlEditarUsuario").modal("toggle");

	  				var stitulo = '';
	  				var sdescripcion = '';

	  				if(idusr == ''){
						stitulo = 'Usuario Creado';
						sdescripcion = 'Usuario creado satisfactoriamente';
	  				}else{
						stitulo = 'Usuario Actualizado';
						sdescripcion = 'Usuario actualizado satisfactoriamente';
	  				}

					swal(stitulo, sdescripcion, "success");
					
					BuscarUsuario();

	  			}
	  		})
		})
})


	/*=================================================
  	BUSCAR USUARIO
  	=================================================*/
	function BuscarUsuario(){

		var nomusu = $('#NomUsr').val();
		var doiusr = $('#NumDocIde').val();
		

		$('#tblUsuarios').DataTable({
   			"destroy":true,
   			"ajax":{
   				"url": "ajax/ajax-usuario-consulta.php",
   				"data" : {
							"nomusu" : nomusu,
							"doiusr" : doiusr,
						},
				"type": "POST",
   			},
   			"columnDefs": [
							{"className": "dt-center", "targets": [0]}
      					],
   			columns : [
		    			{data : 'row'},
		    			{data : 'desarea'},
		    			{data : 'nombre'},
		    			{data : 'apepat'},
		    			{data : 'apemat'},
		    			{data : 'descargo'},
		    			{
		    				data : 'desestreg',
		    				render: function(data){
		    					if(data == 'Habilitado'){
		    						return '<span class="badge badge-success btn-block">'+ data +'</span>'	
		    					}else{
		    						return '<span class="badge badge-warning btn-block">'+ data +'</span>'	
		    					}
		    					
		    				}
		    			},
		    			{
		    				data : 'est',
		    				render: function(data){
		    					var data = data.split('-');
                                var codUsr = data[0];
                                var codEst = data[1];

		    					var html = '';

		    					if(codEst == 'H'){
		    						codEst = "'D'";
		    						html = '<a href="#" onclick="HabDesDocUsuario('+ codUsr +','+ codEst +')" class="btn btn-block btn-danger btnAccion"><i class="fa fa-level-down"></i> Deshabilitar</a>';
		    					}else{
		    						codEst = "'H'";
									html = '<a href="#" onclick="HabDesDocUsuario('+ codUsr +','+ codEst +')" class="btn btn-block btn-success btnAccion"><i class="fa fa-level-up"></i> Habilitar</a>';
		    					}

		    					return html
		    				}
		    			},
		    			{
		    				data : 'id',
		    				render: function(data){	    					

		    					var html  = '<a href="#" id="btnEditar" onclick="editarUsuario('+ data +')" class="btn btn-block btn-outline-info btnAccion">';
		   							html += '<i class="fa fa-edit"></i> Editar';
		   							html += '</a>';	    					
	    						    							
	    						return html
		    				}
		    			}
		    		  ],
		    "language" : idioma_espanol,
	  	  	"searching": false,
	    	"lengthMenu": [[8, 15, 20, 25],[8, 15, 20, 25]]
   		})



} 	/********************************************************************************/
	/*=================================================
  	HABILITAR O DESABILITAR USUARIO
  	=================================================*/	
		function HabDesDocUsuario(idUsuario,indicador){

        $.ajax({
            url: 'ajax/ajax-habilitar-desabilitar.php',
            type: 'POST',
            dataType: 'html',
            data: { 
                    tabla: 'tra_tbusuario',
                    campo: 'idest',
                    valor: indicador,
                    id: idUsuario
                   },
        })
        .done(function(response) {
            if(response == '1'){
                BuscarUsuario();    
            }
        })
        
    }

	/*=================================================
  	EDITAR USUARIO
  	=================================================*/
	function editarUsuario(idusuario){

		$('#idUsr').val(idusuario);

		$.ajax({
			url: 'ajax/ajax-usuario.php',
			type: 'POST',
			dataType: 'html',
			data: {idusuario: idusuario},
		})
		.done(function(response) {
			var dataUsuario = JSON.parse(response);
            console.log(dataUsuario);
			$('#idUsr').val(dataUsuario[0]);
			$('#numdoi').val(dataUsuario[2]);
			$('#nomusr').val(dataUsuario[9]);
			$('#apepat').val(dataUsuario[10]);
			$('#passwd').val(dataUsuario[6]);
			$('#apemat').val(dataUsuario[11]);
			$('#numtel').val(dataUsuario[5]);
			
			$('#direma').val(dataUsuario[4]);
			$("#nomarea option[value="+ dataUsuario[8] +"]").attr("selected",true);
			$("#nomcargo option[value="+ dataUsuario[12] +"]").attr("selected",true);
			$("#nomperfil option[value="+ dataUsuario[13] +"]").attr("selected",true);

		})	

		// abrir modal
		$('#mdlUsrTit').html('<i class="fa fa-edit"></i> Editar Usuario');
		$('#mdlEditarUsuario').modal('show');

		$('#mdlEditarUsuario').on('shown.bs.modal', function () {
	  		$('#myInput').trigger('focus')
		})
	}
/*=================================================
  	MOSTRAR Y OCULTAR CONTRASEÑAS
  	=================================================*/
	function mostrarPassword(){
		var cambio = document.getElementById("passwd");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 