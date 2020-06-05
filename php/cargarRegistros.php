<?php

require_once('../db/utilities.php');

if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';} 

$area = $_SESSION['area'];

$limite = $_POST['limite'];
//Consulta a la base de datos, solo el campo serie
$sql = "SELECT id_hv_equipo FROM hv_equipo WHERE area='".$area."'";
//Ejecución de la consulta
$resultado = $conexion->query($sql);
//Obtener el total de registros de la tabla
$numRegistros = $resultado->num_rows;
//Número de páginas a mostrar
$numPaginasMostrar = 10;
//Calcular la última página
$ultimaPagina = floor($numRegistros / $numPaginasMostrar);
$up = $ultimaPagina*10;

//Consulta a la base de datos para mostrar campos en la tabla
$sql = "SELECT clasf_equipo.nom_clasf_equipo, desc_equipo.id_desc_equipo, desc_equipo.nom_desc_equipo as nombre_equipo, hv_equipo.id_hv_equipo, hv_equipo.num_carpeta, hv_equipo.id_marca, hv_equipo.modelo, hv_equipo.edificio, hv_equipo.piso, hv_equipo.serie, hv_equipo.area, marca.id_marca, marca.nombre_marca as marca FROM hv_equipo, clasf_equipo, desc_equipo, marca WHERE clasf_equipo.id_clasf_equipo=desc_equipo.id_clasf_equipo AND hv_equipo.id_marca=marca.id_marca AND desc_equipo.id_desc_equipo=hv_equipo.id_desc_equipo AND hv_equipo.area='".$area."'  ORDER BY id_hv_equipo ASC LIMIT $limite, 10";

$sql2 = "SELECT hv_equipo.id_hv_equipo, clasf_equipo.nom_clasf_equipo, desc_equipo.nom_desc_equipo, hv_equipo.num_carpeta, hv_equipo.id_marca, hv_equipo.modelo, hv_equipo.serie, hv_equipo.area FROM hv_equipo, clasf_equipo, desc_equipo WHERE clasf_equipo.id_clasf_equipo=desc_equipo.id_clasf_equipo AND desc_equipo.id_desc_equipo=hv_equipo.id_desc_equipo ORDER BY id_hv_equipo ASC LIMIT $limite, 10";
//Ejecución de la consulta anterior

if ($area == 'sistemas' || $area == 'sterilize') {
   $resultado = $conexion->query($sql);
} else {
   $resultado = $conexion->query($sql2);
}

//Tabla con los oficios
echo "
      <table id='tablaRegistros'>
         <thead>
            <th class='centrarCelda success'>No.</th>
            <th class='centrarCelda success'>Descripción</th>
            <th class='centrarCelda success'>No. Carpeta</th>
            <th class='centrarCelda success'>Marca</th>
            <th class='centrarCelda success'>Modelo</th>
            <th class='centrarCelda success'>Serie</th>
            <th class='centrarCelda success'>Edificio</th>
            <th class='centrarCelda success'>Piso</th>
            <th class='centrarCelda success'></th>
            <th class='centrarCelda success'></th>
            <th class='centrarCelda success'></th>
            <th class='centrarCelda success'></th>
         </thead>
         <tbody>         
         ";
         if ($resultado->num_rows>0) {
            while ($fila = $resultado->fetch_array()) {
               echo "<tr>";
                  echo utf8_encode("<td class='centrarCelda'>".$fila['id_hv_equipo']."</td>");
                  echo utf8_encode("<td class='centrarCelda'>".$fila['nombre_equipo']."</td>");
                  echo utf8_encode("<td v>".$fila['num_carpeta']."</td>");
                  echo utf8_encode("<td class='centrarCelda'>".$fila['marca']."</td>");
                  echo utf8_encode("<td class='centrarCelda'>".$fila['modelo']."</td>");
                  echo utf8_encode("<td class='centrarCelda'>".$fila['serie']."</td>");
                  echo utf8_encode("<td class='centrarCelda'>".$fila['edificio']."</td>");
                  echo utf8_encode("<td class='centrarCelda'>".$fila['piso']."</td>");
                  echo utf8_encode("<td class='centrarCelda'><a href='#' onclick='editar_registro(".$fila['id_hv_equipo'].")'><img src='../img/icono_editar.png' width='22px' title='Editar Hoja de Vida'></a></td>");
                  echo utf8_encode("<td class='centrarCelda'><a href='mantenimientos.php?serie=".$fila['serie']."&id_hv_equipo=".$fila['id_hv_equipo']."' onclick=''><img src='../img/icono_carpeta_mantenimiento.png' width='22px' title='Ver Registro de Mantenimientos'></a></td>");
               
                  if ($_SESSION['login'] == 'yes') {
                     echo "<td class='centrarCelda'><a href='#' onclick='eliminar_registro(".$fila['id_hv_equipo'].")' >Eliminar</a></td>";
                  } else {
                     echo "<td style='border: none;'></td>";
                  }                 
               
                  echo "<td class='centrarCelda'><a href='reporte_uno_pdf.php?id_hv_equipo=".$fila['id_hv_equipo']."' target='_blank'><img src='../img/icono_pdf.png' width='22px' title='Ver Hoja de Vida en PDF'></a></td>";
               echo "</tr>";
            }
         }
echo "</tbody></table>";

echo "<div id='contenedorBotonera'>";
echo "<div id='botonera'>";

//Botón Primero
if ($limite > 0) {
	$limit = ceil($ultimaPagina/100)-1;
	echo "<button class='btn-nav' id='anterior' onclick='cargarRegistros(".$limit.")' title='Ir a la primera página'>Primero</button>";
} else {
	//echo "<button></button>";
}

//Botón Anterior
if ($limite > 0) {
	$limit = $limite-10;
	echo "<button class='btn-nav' id='anterior' onclick='cargarRegistros(".$limit.")' title='Ir a la anterior página'>Anterior</button>";
} else {
	//echo "<button></button>";
}

//Botón Ultimo
if ($limite < $up) {
	echo "<button class='btn-nav' id='ultimo' onclick='cargarRegistros(".$up.")' title='Ir a la útlima página'>Ultimo</button>";
} else {
	//echo "<button></button>";
}

//Botón Siguiente
if ($limite < $numRegistros-10) {
	$limit = $limite+10;
	echo "<button class='btn-nav' id='siguiente' onclick='cargarRegistros(".$limit.")' title='Ir a la siguiente página'>Siguiente</button>";
} else {
	//echo "<button></button>";
}

echo "</div>";
echo "</div>";

$conexion->close();

?>