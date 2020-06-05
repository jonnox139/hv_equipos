<?php

require_once('../db/utilities.php');

$tabla = 'usuarios';
$user = trim(htmlspecialchars($_POST['user']));
$password = md5($_POST['password']);

$tabla_campos = array($tabla,$user,$password);

$resultado = login($tabla_campos);

if (!empty($user) && !empty($password)) {   
   $fila = $resultado->fetch_array();
   if ($user === $fila['nick_usuario'] && $password === $fila['contrasena_usuario']) {
      $privilegios = $fila['privilegios'];
      $_SESSION['nombre'] = $fila['nombre_usuario'];
      $_SESSION['apellido'] = $fila['apellido_usuario'];
      $_SESSION['id_usuario'] = $fila['id_usuario'];
      $_SESSION['privilegios'] = $fila['privilegios'];
      $_SESSION['area'] = $fila['area_usuario'];
      $_SESSION['id_usuario'] = $fila['id_usuario'];
      
      switch ($privilegios) {
          case '1':				
              $_SESSION['login'] = "yes";
              echo 'true';
              break;

          case '2':
              $_SESSION['login'] = "no";
              echo 'true';
              break;
      }
   } else {
      session_destroy();
      echo "Usuario o contraseña incorrectos!!!";
      exit();
   }
      $conexion->close();    
} else {
   echo "Debe llenar los dos campos!!!";  
}

?>