<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include_once "verificar.php";
function login($user, $password, &$result){
    
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