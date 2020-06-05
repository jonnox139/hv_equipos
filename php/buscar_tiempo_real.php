<?php

require_once('../db/utilities.php');

if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';}

$buscar = $_POST['b'];

$sql = "SELECT clasf_equipo.nom_clasf_equipo, desc_equipo.id_desc_equipo, desc_equipo.nom_desc_equipo as nombre_equipo, hv_equipo.id_hv_equipo, hv_equipo.num_carpeta, hv_equipo.id_marca, hv_equipo.piso, hv_equipo.edificio, hv_equipo.modelo, hv_equipo.serie, marca.id_marca, marca.nombre_marca as marca FROM hv_equipo, clasf_equipo, desc_equipo, marca WHERE clasf_equipo.id_clasf_equipo=desc_equipo.id_clasf_equipo AND hv_equipo.id_marca=marca.id_marca AND desc_equipo.id_desc_equipo=hv_equipo.id_desc_equipo AND desc_equipo.id_desc_equipo=hv_equipo.id_desc_equipo AND (nom_desc_equipo LIKE '%".$buscar."%' OR id_hv_equipo LIKE '%".$buscar."%' OR num_carpeta LIKE '%".$buscar."%' OR modelo LIKE '%".$buscar."%' OR serie LIKE '%".$buscar."%')";

$resultado = $conexion->query($sql);

$contador = $resultado->num_rows;

if ($contador == 0) {
   echo "<p class='noResultado' style='font-size: 12px;'>No se encontraron resultados para <b>".strtoupper($buscar)."</b></p>";
} else {
   echo "
      <table id='tablaRegistros'>
         <thead>
            <th class='centrarCelda'>No.</th>
            <th class='centrarCelda'>Descripción</th>
            <th class='centrarCelda'>No. Carpeta</th>
            <th class='centrarCelda'>Marca</th>
            <th class='centrarCelda'>Modelo</th>
            <th class='centrarCelda'>Serie</th>
            <th class='centrarCelda'>Edificio</th>
            <th class='centrarCelda'>Piso</th>
            <th class='centrarCelda'></th>
            <th class='centrarCelda'></th>
            <th class='centrarCelda'></th>
            <th class='centrarCelda'></th>
         </thead>
         <tbody>         
         ";
         while ($fila = $resultado->fetch_array()) {
            echo "<tr>";
               echo utf8_encode("<td class='centrarCelda'>".$fila['id_hv_equipo']."</td>");
               echo utf8_encode("<td class='centrarCelda'>".$fila['nombre_equipo']."</td>");
               echo utf8_encode("<td class='centrarCelda'>".$fila['num_carpeta']."</td>");
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
               
                  echo "<td class='centrarCelda'><a href='reporte_uno_pdf.php?id_hv_equipo=".$fila['id_hv_equipo']."' target='_blank' class='btn btn-xs btn-primary'><img src='../img/icono_pdf.png' width='22px' title='Ver Hoja de Vida en PDF'></a></td>";
            echo "</tr>";
         }         
   echo "</tbody></table>";
}

$conexion->close();

?>