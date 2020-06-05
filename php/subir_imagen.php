<?php

if (isset($_FILES['file'])) {
   
   $file = $_FILES['file'];
   $nombre = $file['name'];
   $tipo = $file['type'];
   $ruta_provisional = $file['tmp_name'];
   $size = $file['size'];
   $dimensiones = getimagesize($ruta_provisional);
   $width = $dimensiones[0];
   $height = $dimensiones[1];
   $carpeta = '../imagenes/';
   
   if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif') {
      echo "Error, el archivo no es una imágen!!!";
   } else if ($size > 1024*1024) {
      echo "Error, el tamaño máximo permitido es 1MB!!!";
   } else {
      $src = $carpeta.$nombre;
      move_uploaded_file($ruta_provisional, $src);
      echo "<img src='$src' id='imagen_equipo'><input type='hidden' name='nombre_imagen' value='$src' id='nombre_imagen' class='requerido'>";
   }
   
}


?>