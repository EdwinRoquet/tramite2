$(document).ready(function(){

    BuscarSolicitudRecepcionar();

    /*==========================================
    BOTON BUSCAR SOLICITUDES
    ============================================*/
    $('#btnBuscarDocInt').click(function(){       
        BuscarSolicitudRecepcionar();
    })

    /*==========================================
    DERIVAR SOLICITUD
    ============================================*/
    $('#btnDerivar').click(function(){       
        GenerarDerivacion();
    })

    /*==========================================
    FILTRO DE USUARIOS POR SELECCION DE AREA
    ============================================*/
    $('#areaDestino').on('change',function(){
        if($('#areaDestino').val() != "1"){
            var idArea = $('#areaDestino').val();
            $.ajax({
                url: 'ajax/ajax-area-usuario.php',
                type: 'POST',
                dataType: 'html',
                data: {id: idArea},
            })
            .done(function(response) {
                if(response != ''){
                    $('#para').html(response);
                }else{
                    $('#para').html('<option value="0">No existen usuarios</option>');  
                }               
            })
        }else{
            $('#para').html('<option value="0">Seleccione área de destino</option>');  
        }
    });
})