$(document).ready(function(){
    
    BuscarDocumentoInterno();

    /*  =======================================
        BUSCAR DOCUMENTO INTERNO
        =======================================*/
        $("#btnBuscarDocInt").click(function(){
            BuscarDocumentoInterno();
        });

    /*  =================================================
        NUEVO DOCUMENTO INTERNO
        =================================================*/ 
        $('#btnNuevoDocInt').click(function(){
            $('#idDocInt').val('');
            $('#nomdocint').val('');
            
            // Abrir modal
            $('#mdlDocIntTit').html('<i class="fa fa-file-text-o"></i> Nuevo Documento Interno');
            $('#mdlEditardocumentoInterno').modal('show');
        })

    /*  =================================================
        GUARDAR DOCUMENTO INTERNO
        =================================================*/ 
        $('#btnGuardarDocInt').click(function(){
            /*--------------------*/
            var idDocInt = $('#idDocInt').val();
            var nomdocint = $('#nomdocint').val();

            /*==============================
              VALIDACION DE DATOS
              ==============================*/
              if(nomdocint == ''){
                  swal("Validación de Registro", "La descripción del documento es obligatoria", "warning");
                  return
              }
              
            /*==============================*/
            $.ajax({
                url: 'ajax/ajax-docint-grabar.php',
                type: 'POST',
                dataType: 'html',
                data: $('#frmDocumentoInterno').serialize(),
            })
            .done(function(response) {

                if(response == 0){
                    alert('error al grabar');
                }else{
                    // Cerrar ventana modal
                    $("#mdlEditardocumentoInterno").modal("toggle");

                    var stitulo = '';
                    var sdescripcion = '';

                    if(idDocInt == ''){
                        stitulo = 'Documento Interno Creado';
                        sdescripcion = 'Documento Interno creado satisfactoriamente';
                    }else{
                        stitulo = 'Documento Interno Actualizado';
                        sdescripcion = 'Documento Interno actualizado satisfactoriamente';
                    }

                    swal({
                        title: stitulo,
                        text: sdescripcion,
                        icon: "success",
                        button: "Aceptar",
                        },
                        function(){
                            // Actualizamos la lista de usuarios
                            BuscarDocumentoInterno();
                    });

                }
            })
            /*--------------------*/
        })

})

/*=================================================
  BUSCAR DOCUMENTO INTERNO
  =================================================*/
    function BuscarDocumentoInterno(){

        var nomdocint = $('#NomDocInt').val();
        
        $('#tblDocumentosInternos').DataTable({
            "destroy":true,
            "ajax":{
                "url": "ajax/ajax-docint-consulta.php",
                "data" : {
                            "nomdocint" : nomdocint,
                        },
                "type": "POST",
            },
            "columnDefs": [
                            {"className": "dt-center", "targets": [0,2,3,4]}
                        ],
            columns : [
                        {data : 'id'},
                        {data : 'desdocint'},
                        {
                            data : 'estdocint',
                            render: function(data){
                                if(data == 'H'){
                                    return '<span class="badge badge-success btn-block">HABILITADO</span>'
                                }else{
                                    return '<span class="badge badge-warning btn-block">DESABILITADO</span>'  
                                }
                            }
                        },
                        {
                            /*habilitar o desabilitar*/
                             data : 'est',
                             render: function(data){
                                var data = data.split('-');
                                var codSol = data[0];
                                var codEst = data[1];

                                var html = '';

                                if(codEst == 'H'){
                                    codEst = "'D'";
                                    html = '<a href="#" onclick="HabDesDocInt('+ codSol +','+ codEst +')" class="btn btn-block btn-danger btnAccion"><i class="fa fa-level-down"></i> Deshabilitar</a>';
                                }else{
                                    codEst = "'H'";
                                    html = '<a href="#" onclick="HabDesDocInt('+ codSol +','+ codEst +')" class="btn btn-block btn-success btnAccion"><i class="fa fa-level-up"></i> Habilitar</a>';
                                }

                                return html
                            }
                        },
                        {
                            data : 'id',
                            render: function(data){                         

                                var html  = '<a href="#" id="btnEditar" onclick="editarDocInt('+ data +')" class="btn btn-block btn-outline-info btnAccion">';
                                    html += '<i class="fa fa-edit"></i> Editar';
                                    html += '</a>';                         
                                                                
                                return html
                            }  
                        }
                    ],
            "language" : idioma_espanol,
            "searching": false,
            "lengthMenu": [[5, 10, 15, 20],[5, 10, 15, 20]]    
        })

    }

    /*=================================================
    HABILITAR O DESABILITAR DOCUMENTO INTERNO
    =================================================*/
    function HabDesDocInt(idSolicitud,indicador){

        $.ajax({
            url: 'ajax/ajax-habilitar-desabilitar.php',
            type: 'POST',
            dataType: 'html',
            data: { 
                    tabla: 'tra_tbdocumentosinternos',
                    campo: 'estdocint',
                    valor: indicador,
                    id: idSolicitud
                   },
        })
        .done(function(response) {
            if(response == '1'){
                BuscarDocumentoInterno();    
            }
        })
        
    }

    /*=================================================
    EDITAR DOCUMENTO INTERNO
    =================================================*/
    function editarDocInt(iddocint){

       $('#idDocInt').val(iddocint);

        $.ajax({
            url: 'ajax/ajax-docint.php',
            type: 'POST',
            dataType: 'html',
            data: {iddocint: iddocint},
        })
        .done(function(response) {
            var dataDocInt = JSON.parse(response);
            
            $('#idDocInt').val(dataDocInt[0]);
            $('#nomdocint').val(dataDocInt[1]);

        })  

        // abrir modal
        $('#mdlDocIntTit').html('<i class="fa fa-edit"></i> Editar documento interno');
        $('#mdlEditardocumentoInterno').modal('show');

        $('#mdlEditardocumentoInterno').on('shown.bs.modal', function () {
            // $('#myInput').trigger('focus')
        })
    }