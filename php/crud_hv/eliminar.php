<?php

require_once('../../db/utilities.php');

$id_hv_equipo = $_POST['id_hv_equipo'];

$sql = "DELETE FROM hv_equipo WHERE id_hv_equipo='$id_hv_equipo';";
$resultado = $conexion->query($sql);

$conexion->close();


?>