<?php

require_once('../../db/utilities.php');

if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';} 

if (empty($_POST['nick_usuario'])) {
   echo "Falta digitar el nick del usuario!!!";
} else if (empty($_POST['contrasena_usuario'])) {
   echo "Falta digitar la contraseña del usuario!!!";
} else if (empty($_POST['nombre_usuario'])) {
   echo "Falta digitar el nombre del usuario!!!";
} else if (empty($_POST['apellido_usuario'])) {
   echo "Falta digitar el apellido del usuario!!!";
} else {

   $nick_usuario = $_POST['nick_usuario'];
   $contrasena_usuario = md5($_POST['contrasena_usuario']);
   $nombre_usuario = $_POST['nombre_usuario'];
   $apellido_usuario = $_POST['apellido_usuario'];
   $privilegios = $_POST['privilegios'];

   $sql = "INSERT INTO usuarios(id_usuario, nick_usuario, contrasena_usuario, nombre_usuario, apellido_usuario, telefono_usuario, privilegios) VALUES(null, '$nick_usuario', '$contrasena_usuario', '$nombre_usuario', '$apellido_usuario', null, $privilegios);";

   $resultado = $conexion->query($sql);

   if ($resultado) {
      echo "Usuario creado con éxito!";
   } else {
      echo "Error al ingresar el usuario al sistema!!!";
   }

   $conexion->close();

}

?>