<?php

require_once('../db/utilities.php');

if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellido'])) {
	session_destroy();
	header('Location: ../');
   exit();
}

if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';}

$id_hv_equipo = $_POST['id_hv_equipo'];

$id_hv_equipo = $id_hv_equipo."/";

if (isset($_FILES['file'])) {
   
   $file = $_FILES['file'];
   $nombre = $file['name'];
   $tipo = $file['type'];
   $ruta_provisional = $file['tmp_name'];
   $size = $file['size'];
   $carpeta = "../reportes/";
   
   if ($tipo != 'application/pdf') {
      echo "Solo se permite subir archivos con extensión PDF!";
   } else if ($size > 102400*102400) {
      echo "El tamaño máximo del archivo permitido es 2MB";
   } else {
      $src = $carpeta.$id_hv_equipo.$nombre;
      move_uploaded_file($ruta_provisional, $src);
      echo "Archivo subido correctamente!";
   }
   
}

?>