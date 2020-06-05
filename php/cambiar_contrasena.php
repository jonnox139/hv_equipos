<?php

require_once('../db/utilities.php');

$ca = md5($_POST['ca']);
$cn = md5($_POST['cn']);
$rcn = md5($_POST['rcn']);
$idu = $_POST['idu'];

if (empty($ca) || empty($cn) || empty($rcn)) {
  echo "Falta ingresar uno o más campos!!!";
} else {

  $sql = "SELECT contrasena_usuario FROM usuarios WHERE contrasena_usuario='".$ca."';";
  $resultado = $conexion->query($sql);
  $fila = $resultado->fetch_array();

  if ($ca != $fila['contrasena_usuario']) {
      echo "Su contraseña actual no es correcta, verifiquela!!!";
  } else if ($cn != $rcn) {
      echo "Las contraseñas nuevas no coinciden!!!";
  } else {
      $sql2 = "UPDATE usuarios SET contrasena_usuario='".$cn."' WHERE id_usuario='".$idu."'";
      $resultado2 = $conexion->query($sql2);
      echo "Contraseña actualizada con éxito!";
  }

  $conexion->close();
}


?>