<?php

require_once('../db/utilities.php');
require_once('../include/dompdf/autoload.inc.php');

if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellido'])) {
	session_destroy();
	header('Location: ../');
   exit();
}

$id_hv_equipo = $_GET['id_hv_equipo'];

$sql = "SELECT clasf_equipo.nom_clasf_equipo, desc_equipo.nom_desc_equipo, hv_equipo.* FROM clasf_equipo, desc_equipo, hv_equipo WHERE clasf_equipo.id_clasf_equipo=desc_equipo.id_clasf_equipo AND desc_equipo.id_desc_equipo=hv_equipo.id_desc_equipo AND id_hv_equipo='$id_hv_equipo'";
$resultado = $conexion->query($sql);

$fila = $resultado->fetch_array();

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Ejemplo de PDF</title>
   <style type="text/css">
      @page { margin: 5px; }
      body { margin: 5px; padding: 0px; font-size: 10px; font-family: helvetica;}
      table { border-collapse: collapse; width: 100%; }
      td { border: 1px solid black; padding: 0px; text-align: center; }
      #encabezado { text-align: center; }
      #parte_1 td { height: 15px; }
   </style>
</head>
<body>
   <!--/************** ENCABEZADO ***************/-->
   <table id="encabezado" style="margin-bottom: 5px">
      <tr>
         <td rowspan="5" style="width: 100px;"><img src="../img/logo2.png" alt="" width="70px;"></td>
         <td rowspan="5"><strong><h3>HOJA DE VIDA EQUIPOS DE OPERACIÓN</h3></strong></td>
         <td style="width: 90px;">CÓDIGO</td>
         <td style="width: 170px;">FECHA DE ELABORACIÓN:</td>
         <td rowspan="5" style="width: 70px;"><img src="../img/logo-calidad.gif" alt="" width="50px;"></td>
      </tr>
      <tr>
         <td rowspan="2" style="width: 90px;">FR-MAN - 005</td>
         <td style="width: 170px;">15 DE NOVIEMBRE DE 2005</td>
      </tr>
      <tr>
         <td style="width: 170px;">FECHA DE ACTUALIZACIÓN:</td>
      </tr>
      <tr>
         <td style="width: 90px;">VERSIÓN:</td>
         <td style="width: 170px;">25 DE SEPTIEMBRE DE 2015</td>
      </tr>
      <tr>
         <td style="width: 90px;">03</td>
         <td style="width: 170px;">HOJA: 1 DE: 2</td>
      </tr>
   </table>
   <!--/------------- FIN ENCABEZADO -------------/-->
   
   <!--/************** 1. DESCRIPCION ***************/-->
   <table id="parte_1" style="font-size: 8px; width: 100%;">
      <tr>
         <td colspan="13" style="background-color: darkgray;"><strong>1. DESCRIPCIÓN Y CLASIFICACIÓN DEL EQUIPO</strong></td>
      </tr>
      <tr>
         <td>BIOMEDICO</td>
         <td>PREVENCIÓN</td>
         <td style="background-color: darkgray;"></td>
         <td>DIAGNOSTICO</td>
         <td style="background-color: darkgray;"></td>
         <td>TRATAMIENTO</td>
         <td style="background-color: darkgray;"></td>
         <td>REHABILITACION</td>
         <td style="background-color: darkgray;"></td>
         <td>MANTTO VIDA</td>
         <td style="background-color: darkgray;"></td>
         <td>DE LABORATORIO</td>
         <td style="background-color: darkgray;"></td>
      </tr>
      <tr>
         <td rowspan="2">EQUIPO INDUSTRIAL DE USO HOSPITALARIO</td>
         <td colspan="3">PLANTA ELECTRICA</td>
         <td style="background-color: darkgray;"></td>
         <td>EQ. LAVANDERIA</td>
         <td style="background-color: darkgray;"></td>
         <td>EQ. COCINA</td>
         <td style="background-color: darkgray;"></td>
         <td>CALDERA</td>
         <td style="background-color: darkgray;"></td>
         <td>BOMBA DE AGUA</td>
         <td style="background-color: darkgray;"></td>
      </tr>
      <tr>
         <td>AUTOCLAVE</td>
         <td style="background-color: darkgray;"></td>
         <td>EQ. DE SEGURIDAD</td>
         <td style="background-color: darkgray;"></td>
         <td>EQ. REFRIGERACION</td>
         <td style="background-color: darkgray;"></td>
         <td>EQ. AIRE ACONDICIONADO</td>
         <td style="background-color: darkgray;"></td>
         <td>EQ. APOYO HOSPITALA</td>
         <td style="background-color: darkgray;"></td>
         <td>OTROS</td>
         <td style="background-color: darkgray;"></td>
      </tr>
      <tr>
         <td>EQUIPO DE COMUNICACIONES E INFORMATICA</td>
         <td>COMPUTADOR ESCRITORIO</td>
         <td style="background-color: darkgray;"></td>
         <td>COMPUTADOR PORTATIL</td>
         <td style="background-color: darkgray;"></td>
         <td>IMPRESORA</td>
         <td style="background-color: darkgray;"></td>
         <td>ESCANER</td>
         <td style="background-color: darkgray;"></td>
         <td>OTROS</td>
         <td style="background-color: darkgray;"></td>
         <td></td>
         <td style="background-color: darkgray;"></td>
      </tr>
   </table>
   <!--/------------- FIN 1. DESCRIPCION -------------/-->
   
   <!--/************** 2. IDENTIFICACION ***************/-->
   <table>
      <tr>
         <td colspan="6">2. IDENTIFICACION</td>
      </tr>
      <tr>
         <td>INV/ACTIVO</td>
         <td></td>
         <td>RS(Registro Sanitario)</td>
         <td></td>
         <td>PC(Permiso de comercialización)</td>
         <td></td>
      </tr>
      <tr>
         <td>EDICIO</td>
         <td></td>
         <td>PISO</td>
         <td></td>
         <td>Nro. De Carpeta</td>
         <td></td>
      </tr>
   </table>
   <!--/------------- FIN 2. IDENTIFICACION -------------/-->
</body>
</html>
';

use Dompdf\Dompdf;

# Instanciamos un objeto de la clase DOMPDF.
$mipdf = new DOMPDF();

# Cargamos el contenido HTML.
$mipdf->loadHtml($html);

# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
$mipdf->set_paper("A4", "portrait");

# Renderizamos el documento PDF.
$mipdf->render();

# Enviamos el fichero PDF al navegador.
$mipdf->stream("nombre_archivo",array("Attachment"=>0));


?>



















