<?php 
/* Componentes HTML */
include_once 'componentes/header.php';
include_once 'componentes/navbar.php';
?>
<nav aria-label="breadcrumb" class="m-4">
    <ol class="breadcrumb migas">
        <li class="breadcrumb-item"><a href="principal.php"><i class="fa fa-home"></i> Panel Principal</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Tarifa</li>
    </ol>
</nav>
<div class="card m-4">
    <div class="card-body">
        <div class="accordion" id="accordionTarifa">
        
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h4 class="mb-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne">
                        <i class="fa fa-plus"></i>Conozca nuestras tarifas</button>									
                    </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionTarifa">
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" id='menuArbitroUnico' href="#tabmenuArbitroUnico" style="font-weight: 700;">H. de Arbitro Unico</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" id="menuTribunalArbitral" href="#tabmenuTribunalArbitral" style="font-weight: 700;">H. de Tribunal Arbitral</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" id="menuSecretarioArbitral" href="#tbmenuSecretarioArbitral" style="font-weight: 700;">H. de secretaria Arbitral</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu3" style="font-weight: 700;">H. de Arbitro de Emergencia</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="tabmenuArbitroUnico" class="container tab-pane active"><br>
                                <table class="table  table-striped table-hover" id="tbHArbitroUnico">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="background: #f16501;">Monto de cuantia</th>
                                            <th scope="col" style="background: #f16501;">%</th>
                                            <th scope="col" style="background: #f16501;">Formula</th>
                                            <th scope="col" style="background: #f16501;">Monto Max. Sin IGB </th>
                                        </tr>
                                    </thead>
                                    <tbody id="contenidoArbitroUnico">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div id="tabmenuTribunalArbitral" class="container tab-pane fade"><br>
                                <table class="table table-striped  table-bordered" id="tbHTribulaArbitral">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="background: #f16501;">Monto de cuantia</th>
                                                <th scope="col" style="background: #f16501;">%</th>
                                                <th scope="col" style="background: #f16501;">Formula</th>
                                                <th scope="col" style="background: #f16501;">Monto Max. Sin IGB </th>
                                            </tr>
                                        </thead>
                                        <tbody id="contenidoTribulaArbitral">
                                        
                                        </tbody>
                                </table>
                            </div>
                            <div id="tbmenuSecretarioArbitral" class="container tab-pane fade"><br>
                                <table class="table table-striped  table-bordered" id="tbHSecretariaArbitral">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="background: #f16501;">Monto de cuantia</th>
                                                    <th scope="col" style="background: #f16501;">Formula</th>
                                                    <th scope="col" style="background: #f16501;">%</th>
                                                    <th scope="col" style="background: #f16501;">Monto Max. Sin IGB </th>
                                                </tr>
                                            </thead>
                                             <tbody id="contenidoSecretarioArbitral">
                                        
                                            </tbody>
                                    </table>
                            </div>
                            <div id="menu3" class="container tab-pane fade"><br>
                                    <table class="table table-bordered" id="tbHArbitroEmergencia">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="background: #f16501;">Monto de cuantia</th>
                                                    <th scope="col" style="background: #f16501;">Formula</th>
                                                    <th scope="col" style="background: #f16501;">%</th>
                                                    <th scope="col" style="background: #f16501;">Monto Max. Sin IGB </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                   
                                                </tr>
                                                
                                            </tbody>
                                    </table>
                            </div>
                        </div>
                          
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo">
                        <i class="fa fa-plus"></i> Acceder a la calculadora de gastos arbitrales</button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionTarifa">
                    <div class="card-body">
                        <a href="calculadoraTasa.php" class="btn btn-primary">Calculadora</a>
                    </div>
                </div>
            </div>
        
        </div>    

    </div>
</div>


<!-- ============================================ -->
 <?php 
	include_once 'componentes/footer.php';
    
?>
<script>
    $(document).ready(function(){
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>
<script src="js/tarifa.js" ></script>