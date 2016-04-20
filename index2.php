<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include_once "conection.php";
function login($user, $password, &$result){
    if($user=='a' && $password==1){
        return 1;
    }else{
        return 0;
    }
}
/*Luego haremos una serie de condicionales que identificaran el momento en el boton de login es presionado y cuando este sea presionado llamaremos a la función verificar_login() pasandole los parámetros ingresados:*/

if(!isset($_SESSION['userid'])) //para saber si existe o no ya la variable de sesión que se va a crear cuando el usuario se logee
{ 
    if(isset($_POST['login'])) //Si la primera condición no pasa, haremos otra preguntando si el boton de login fue presionado
    { 
        if(login($_POST['user'],$_POST['password'],$result) == 1) //Si el boton fue presionado llamamos a la función verificar_login() dentro de otra condición preguntando si resulta verdadero y le pasamos los valores ingresados como parámetros.
        { 
            /*Si el login fue correcto, registramos la variable de sesión y al mismo tiempo refrescamos la pagina index.php.*/
            $_SESSION['userid'] = $result->idusuario; 
            header("location:conection.php"); 
        } 
        else 
        { 
            echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>'; //Si la función verificar_login() no pasa, que se muestre un mensaje de error.
        } 
    } 
}
 
?>
<body>
    <form>
       <ul>
           <li>
                <label for="usuario">Usuario: </label>
                <input type="text" name="nombre" placeholder="user" required maxlenght="50">
           </li>
           <li>
                <label for="contrasena">Contrase&ntilde;a: </label>
                <input type="password" name="password" required maxlenght="8">
           </li>
           <li>
                <button class="submit" type="submit" name="enviar">Acceder</button>
           </li>
        </ul>
    </form>
</body>