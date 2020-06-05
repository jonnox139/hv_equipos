<?php

require_once('../db/utilities.php');

if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';}

$contador = 0;

if (empty($_POST['serie'])) {
   echo "Debe digitar un número de serie!!!";
} else {
   
   $serie = htmlspecialchars(trim(strtoupper($_POST['serie'])));

   $sql = "SELECT serie FROM hv_equipo";

   $resultado = $conexion->query($sql);

   while($fila = $resultado->fetch_array()) {
      if($fila['serie'] == $serie) {
          $contador++;
      } else {

      }
   }

   if ($contador == 0) {
      echo "El número de serie digitado no está registrado en la base de datos, puede ingresar el nuevo registro!";
   } else {
      echo "El número de serie digitado ya se encuentra registrado en la base de datos!!!";
   }

   $conexion->close();
}

?>