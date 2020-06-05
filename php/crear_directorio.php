<?php

/*
require_once('../db/utilities.php');

if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellido'])) {
	session_destroy();
	header('Location: ../');
   exit();
}

if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';}

//mkdir("../reportes/felipe", 0777);


$sql = "SELECT id_hv_equipo FROM hv_equipo";
$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_array()) {
   if ($fila['id_hv_equipo'] == '') {
      continue;
   } else {
      mkdir("../reportes/".$fila['id_hv_equipo']."/", 0777);
   }
}


for ($i=661;$i<=5000;$i++) {
   mkdir("../reportes/".$i."/", 0755);   
}
*/
?>