<?php

require_once('../../db/utilities.php');

$id_hv_equipo = $_POST['id_hv_equipo'];
//$id_desc_equipo = $_POST['id_desc_equipo'];

/* Obtener para contar el número de variables POST,los nombres de los campos del formulario, los valores de los campos y asignarlos mediante la reasignación de variable a variable
*/

$numero = count($_POST);
$nombre_campo = array_keys($_POST);
$valor_campo = array_values($_POST);
$nombre = array();

/*for($i=0;$i<$numero;$i++) {
    echo $valor_campo[$i]."<//>";
}*/

for($i=1;$i<=$numero;$i++) {
    
    if ($valor_campo[$i] == "") {
        continue; 
    }    
    $sql = "UPDATE hv_equipo SET ".$nombre_campo[$i]."='".$valor_campo[$i]."' WHERE id_hv_equipo=$id_hv_equipo";
    $resultado = $conexion->query($sql);
}

if(!$sql) {
	echo "Ha ocurrido un error al ingresar el registro!";
} else {
	echo "El registro se actualizó correctamente!";
}

$conexion->close();


?>