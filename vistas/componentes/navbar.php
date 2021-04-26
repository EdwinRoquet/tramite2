<?php
/* Librerías de tablas generales */
   include_once '../includes/user.php';
   include_once '../includes/estado.php';
   include_once '../includes/area.php';
   include_once '../includes/Tasa.php';
   include_once '../includes/docint.php';
   include_once '../includes/tipdoc.php';
   include_once '../includes/tipoanexo.php';
   include_once '../includes/tiposolicitud.php';
   include_once '../includes/tipocomprobante.php';
   include_once '../includes/tipocuantia.php';
   include_once '../includes/moneda.php';
   include_once '../includes/cargo.php';
   include_once '../includes/perfil.php';

/* Librerías de Solicitud */
   include_once '../includes/solicitud.php';
   include_once '../includes/solicitudpretension.php';
   include_once '../includes/solicitudAsignacionArbitro.php';
   include_once '../includes/solicitudanexo.php';
   include_once '../includes/solicitudobservacion.php';
   include_once '../includes/solicitudrutas.php';
   include_once '../includes/solicitudrespuesta.php';

   $user                   = new User();
   $Estado                 = new Estado();
   $Area                   = new Area();
   $Tasa                   = new Tasa();
   $DocInt                 = new DocInt();
   $TipoSolicitud          = new TipSolicitud();
   $TipDoc                 = new TipDoc();
   $TipoAnexo              = new TipoAnexo();
   $TipoComprobante        = new TipoComprobante();
   $TipoCuantia            = new TipoCuantia();
   $Moneda                 = new Moneda();
   $Cargo                  = new Cargo();
   $Perfil                 = new Perfil();

   $Solicitud              = new Solicitud();
   $SolicitudPretension    = new SolicitudPretension();
   $SolicitudAsignacionArbitro    = new SolicitudAsignacionArbitro();
   $SolicitudAnexo         = new SolicitudAnexo();
   $SolicitudRutas         = new SolicitudRutas();
   $solicitudobservacion   = new SolicitudObservacion();
   $solicitudrespuesta     = new solicitudrespuesta();
   
   $user->setUser($userSession->getCurrentUser());

   /* datos de usuario */
   $idUsuario              = $user->getId();
   $mailUsuario            = $user->getUserName();
   $NomUsuario             = $user->getNombre();
   $TipUsuario             = $user->getflgTipUsr();
   $idArea                 = $user->getArea();
   $DesArea                = $user->getDesArea();
   $idPerfil               = $user->getPerfil();
   $datausuario            = $user->getUserInf($idUsuario);
    
   $MEstado                = $Estado ->listarEstado();
   $MArea                  = $Area ->listarArea();
   $MDocInt                = $DocInt->listarDocumentosInternos('%');
   $Msolicitudobservacion  = $solicitudobservacion->ListarObservacion($idUsuario);
   $MTipDoc                = $TipDoc->listarTipdoc();  
   $MTipoAnexo             = $TipoAnexo->listartipoAnexo();
   $MTipoComprobante       = $TipoComprobante->listartipoComprobante();   
   $MTipoCuantia           = $TipoCuantia->listartipoCuantia();      
   $MMoneda                = $Moneda->listarMoneda();    
   $MTipoSolicitud         = $TipoSolicitud->listarTipSol();
   $MCargo                 = $Cargo->listarCargo();
   $MPerfil                = $Perfil->listarPerfil();
 ?>
 <div class="wrapper">

    <nav id="sidebar" class="d-print-none">
        <div class="sidebar-header d-print-none">
            <img src="img/logo-cear.png" alt="" class="img-fluid">
            <hr>
            <h3 class="data1 text-uppercase"><i class="fa fa-user"></i> <?php echo $NomUsuario; ?></h3>
            <h3 class="data2"><i class="fa fa-phone"></i> <?php echo $datausuario['numtel']; ?> </h3>
            <h3 class="data3"><i class="fa fa-envelope-o"></i> <?php echo $datausuario['direma']; ?> </h3>
        </div>

        <ul class="list-unstyled components d-print-none">
            
            <?php 
                if($TipUsuario == 'E'){
                   echo '<p><i class="fa fa-home"></i> MENU DEMANDANTE</p>
                          <li><a href="consulta.php"><i class="fa fa-edit"></i> Mis Solicitudes </a></li>
                          <li><a href="respuesta-arbitraje.php"><i class="fa fa-edit"></i> Respuestas de Arbitraje </a></li>
                          <li><a href="mensajes.php"><i class="fa fa-envelope-o"></i> Casilla Electrónica </a></li>
                          <li><a href="perfil.php"><i class="fa fa-user"></i> Mi perfil </a></li>';

                    echo '<p><i class="fa fa-home"></i> MENU DEMANDADO</p>
                          <li><a href="consulta-respuesta.php"><i class="fa fa-users"></i> Procesos en Demanda </a></li>';
                    echo '<p><i class="fa fa-home"></i> MENU USUARIO</p>
                         <li><a href="usuarios.php"><i class="fa fa-user"></i> Usuario </a></li>';
                    echo '<p><i class="fa fa-home"></i> MANTENIMIENTO</p>
                         <li><a href="area.php"><i class="fa fa-align-justify"></i> Area </a></li>
                         <li><a href="documentoInterno.php"><i class="fa fa-file"></i> Documento Interno </a></li>
                        <li><a href="tarifas.php"><i class="fa fa-align-justify"></i> Calculadora Arbitraje </a></li>
                         <li><a href="tasa.php"><i class="fa fa-align-justify"></i> Tasa </a></li>';

                }else{
                    echo '<p><i class="fa fa-home"></i> MENU PRINCIPAL</p>
                          <li><a href="principal.php"><i class="fa fa-edit"></i> Panel Principal </a></li>
                          <li><a href="consultaArbitro.php"><i class="fa fa-users" aria-hidden="true"></i> Asignar Arbitro </a></li>';
                }
             ?>
            
        </ul>

        <ul class="list-unstyled CTAs d-print-none">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download"><i class="fa fa-download "></i>Manual de Usuario</a>
                </li>
                
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article"><i class="fa fa-download "></i>Manual de sistema</a>
                </li>
            
            </ul>

    </nav>
    
    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                
                <!-- BOTON MENU - ESCRITORIO -->
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fa fa-bars"></i>
                    <!--<span>Menú</span>-->
                </button>

                <div class="btn" id="HoraSistema"></div>
                
                <!-- BOTON MENU - MOVIL -->
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-align-justify"></i>
                </button>

                <!-- CERRAR SESION -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../includes/logout.php"> <i class="fa fa-sign-out"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>