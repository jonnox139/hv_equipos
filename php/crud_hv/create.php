<?php

require_once('../../db/utilities.php');


if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
   $ip_usuario = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
   $ip_usuario = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {          
   $ip_usuario = $_SERVER['REMOTE_ADDR'];
}

/* Obtener para contar el número de variables POST,los nombres de los campos del formulario, los valores de los campos y asignarlos mediante la reasignación de variable a variable
$numero = count($_POST);
$nombre_campo = array_keys($_POST);
$valor_campo = array_values($_POST);

for($i=0;$i<$numero;$i++) {
	$$nombre_campo[$i] = $valor_campo[$i];
}*/

//Con la función implode se separan todos los campos de texto
//provenientes de registrar_equipo.php guardados dentro del array $_POST

$contador = 0;

$serie_digitado = $_POST['serie'];

if (empty($serie_digitado)) {
   echo "El campo serie es obligatorio!!!"; 
} else {
   
   $sql4 = "SELECT serie FROM hv_equipo";
   $resultado4 = $conexion->query($sql4);

   while ($fila4 = $resultado4->fetch_array()) {
      if ($fila4['serie'] == $serie_digitado) {
         $contador++;
      }
   }

   if ($contador == 0) {

      $id_usuario = $_SESSION['id_usuario']; //Id de la tabla usuarios

      $nom_img = $_POST['nombre_imagen'];

      $sql = "INSERT INTO hv_equipo VALUES (null,'".implode("','", array_values($_POST))."',NOW(),'$hora', $id_usuario, '$ip_usuario');";

      $resultado = $conexion->query($sql);
      
      //$ultimo_id = $conexion->insert_id;
      //mkdir("../reportes/01/", 0777);

      $sql2 = "UPDATE hv_equipo SET serie = TRIM(serie);";

      $resultado2 = $conexion->query($sql2);

      $sql3 = "UPDATE hv_equipo SET serie = UPPER(serie);";

      $resultado3 = $conexion->query($sql3);

      if ($resultado) {
          echo "El registro fue guardado con éxito!";
      } else {
         echo "ERROR: El registro no pudo ser guardado!!! ".$conexion->error;
      }

   } else {
      echo "ERROR: El serial digitado ya se encuentra registrado!!!";
   }

   $conexion->close();
   
}



?>