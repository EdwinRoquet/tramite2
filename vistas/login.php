<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mesa de Partes Virtual</title>

    <!-- REFERENCIAS A ESTILOS -->
    <link rel="stylesheet" href="vistas/css/plugins/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="vistas/css/plugins/aquamarine.css" type="text/css">
    <link rel="stylesheet" href="vistas/css/login.css" type="text/css">

</head>
<body>


<div id="fondo" class="align-items-center d-flex cover section-aquamarine py-5">
    
    <div class="container">
      <div class="row">
        <div class="col-lg-6 p-3 mx-auto">
          <form action="" method="post" class="p-4 bg-light" autocomplete="off">
            <?php
                if(isset($errorLogin)){
                    echo $errorLogin;
                }
            ?>
            <img src="vistas/img/img-log.jpeg" class="img-fluid mx-auto d-block mb-3" width="300">
            <h4 class="text-center titLogin">SISTEMA ELECTRÓNICO ARBITRAL</h4>
            <h5 class="text-center mb-4 StitLogin">SISTELAR</h5>

            <div class="form-group"> 
              <label for="username">Usuario</label>
              <input name="username" class="form-control" placeholder="Ejemplo : usuario@dominio.com"> 
            </div>
            
           <div class="form-group">
               <label for="password">Contraseña</label>
               <input name="password" type="password" class="form-control" placeholder="Ingresar contraseña">
           </div>
          

            <p class="resetPassword">
              <a href="vistas/recordarpsw.php">¿Olvidé mi contraseña? </a>
            </p>

            <button class="btn btn-block p-1 btn-primary" type="submit">
                Ingresar
            </button>
            
            <p class="registro">
              <a href="vistas/registro.php"> ¿No tienes cuenta? Regístrate </a>
            </p>

          </form>
          
        </div>
      </div>
    </div>
  </div>
</body>
</html>