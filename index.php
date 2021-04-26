<?php
include_once 'includes/user_session.php';
include_once 'includes/user.php';

$userSession = new UserSession();
$user = new User();

/* Evaluamos si existe sesión activa */
if(isset($_SESSION['user'])){
   
    /* Si tiene una sesión activa lo direccionamos a la ventana consulta.php*/
    $user->setUser($userSession->getCurrentUser());
    header("location:vistas/consulta.php");
}
/* Validamos si el usuario ingreso usuario y password*/
else if(isset($_POST['username']) && isset($_POST['password'])){
    
    // Capturamos los datos ingresados por el usuario
    $userForm = $_POST['username'];
    $passForm = $_POST['password'];
    $user = new User();

    /* Validamos las credenciales */
    if($user->userExists($userForm, $passForm)){
        
        //$userSession->setCurrentUser($user["id"],$userForm);
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        /* 
            Si el tipo de usuario es EXTERNO, cargamos la pantalla de consulta, caso
            contrario cargamos la pantalla principal.
        */
            if($user->getflgTipUsr() == 'E'){
                header("location:vistas/consulta.php");
            }else{
                header("location:vistas/principal.php");
            }

        
    }else{

        $errorLogin = '<div class="alert alert-danger">
                        <strong>Adventencia!</strong> Nombre de usuario y/o password incorrecto.
                      </div>';

        include_once 'vistas/login.php';
    }
}
/* lo devolvemos a la venta a de Login*/
else{
    include_once 'vistas/login.php';
}
?>