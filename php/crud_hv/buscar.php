<?php

//Carga el archivo que contiene la conexión a la bd y algunas funciones útiles.
require_once('../../db/utilities.php');

//Recibe la variable por método POST desde la función "editar" en el archivo funciones.js, a su vez esta variable llega desde los archivo cargarRegistros.php y buscar_tiempo_real.php
$id_hv_equipo = $_POST['id_hv_equipo'];

//Solicita una consulta en la bd, seleccionando todos los campos de la tabla hv_equipo de acuerdo al id de la hoja de vida desde el archivo cargarRegistro.php
$sql = "SELECT desc_equipo.id_desc_equipo, marca.nombre_marca as marca, clasf_equipo.nom_clasf_equipo AS nce, desc_equipo.nom_desc_equipo AS nde, hv_equipo.* FROM clasf_equipo, desc_equipo, hv_equipo, marca WHERE id_hv_equipo=$id_hv_equipo AND hv_equipo.id_desc_equipo=desc_equipo.id_desc_equipo AND clasf_equipo.id_clasf_equipo=desc_equipo.id_clasf_equipo AND hv_equipo.id_marca=marca.id_marca";

//Ejecuta la consulta anterior
$resultado = $conexion->query($sql);

//Obtiene el número de campos de la tabla
$num_campos = $conexion->field_count;

//Crea un array para guardar los campos de la bd
$valor_campo = array();

//Guarda en una variable un array asociativo los nombres de los campos de la tabla
$fila = $resultado->fetch_fields();

//Guarda en una variable un array asociativo el contenido de los campos de acuerdo al criterio de busqueda.
$fila2 = $resultado->fetch_array();

//Ciclo para tomar los nombres de los campos contenidos en el array asociativo fila y guardalos en otro array (info), se tiene en cuenta que dicho array que contiene los nombres de los campos permite obtener también los valores de los campos contenidos en el array fila2.
foreach ($fila as $valor) {
    $nom_campo = $valor->name;    
    $valor_campo[$nom_campo] = $fila2[$nom_campo];
}

//Ciclo para verificar que los valores de los campos fueron guardados en el array info
/*
foreach ($info as $val) {
    echo $val."<br>";
}
*/

//Codifica el array info en formato json y lo imprime.

echo json_encode($valor_campo);

//Cierra la consulta (No olvidar este paso, es muy importante)
$conexion->close();


?>