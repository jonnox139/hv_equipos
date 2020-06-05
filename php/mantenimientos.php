<?php

require_once('../db/utilities.php');

if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellido'])) {
	session_destroy();
	header('Location: ../');
   exit();
}

if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';}

$fecha_colombia = fecha(); //Función que devuelve la fecha

$serie = $_GET['serie'];
$id_hv_equipo = $_GET['id_hv_equipo'];

$conexion2 = new mysqli('localhost','root','4dm1n15tr4t0r/2015*/p4st0','soporte_sistemas_2016');

$sql = "SELECT hesk_users.name as nombre_agente, hesk_users.id, hesk_tickets.*, hesk_replies.replyto, hesk_replies.message as tarea_realizada, hesk_replies.rating as calificacion FROM hesk_users, hesk_tickets, hesk_replies WHERE custom6='$serie' AND hesk_tickets.owner=hesk_users.id AND hesk_tickets.id=hesk_replies.replyto"; 

$resultado = $conexion2->query($sql);

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro de Mantenimientos</title>
	<meta charset="UTF-8">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/pepper-grinder/jquery-ui.css">
   <link rel="stylesheet" href="../css/style2.css">
   <script src="//code.jquery.com/jquery-1.10.2.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script type="text/javascript" src="../js/funciones.js"></script>
   <style type="text/css">
      table {
         width: 70%;
      }
      
      th {
         padding: 5px;
         background-color: cadetblue;
         text-align: center;
      }
      
      td {
         border: 1px solid gray;
         border-collapse: collapse;
      }
   </style>
   
   <script type="text/javascript">
      $(function() {
         $("input[name='file']").on("change", function() {
            var formData = new FormData($("#formulario")[0]);
            var ruta = "upload.php";
            $.ajax({
               url: ruta,
               type: "post",
               data: formData,
               contentType: false,
               processData: false,
               success: function(datos) {
                  //$("#respuesta").html(datos);
                  alert(datos);
                  window.location.reload();
               }
            });
         });
      });
   </script>
</head>
<body>
  
  <?php include('../include/menu.inc.php');  ?>
  
   <div id="wrapper">

      <!-- ///////////// Cabecera-->
		<header id="cabecera">
			<div id="izquierda">
			   <img src="../img/logo2.png" alt=""></div>
			<div id="centro">
               <span>REPORTE DE MANTENIMIENTOS POR EQUIPO</span>
			</div>
			<div id="derecha"><p id="fecha"><?php echo $fecha_colombia; ?></p><br><br><p><span>Bienvenido(a) <?php echo strtoupper($_SESSION['nombre']);?></span></p></div>
		</header>
		<div id="seleccionar">
            <label style="font-size: 15px; font-weight: 600;">Serial No. <?php echo $serie; ?></label> 
            <div><a href="buscar.php">Regresar al listado</a></div>
         </div>
         <div id="seleccionar">
            <p style="font-size: 15px; font-weight: 600; margin-bottom: 10px;">Agregar Reporte de Mantenimiento</p>
            <form action="" enctype="multipart/form-data" method="post" id="formulario">
               <input type="file" name="file">
               <input type="hidden" value="<?php echo $id_hv_equipo;?>" name="id_hv_equipo">
               <!--<input type="submit" style="margin-left: 10px; padding: 5px;" id="btn_ag_reg_mant" value="Guardar">-->
            </form>
         </div>
         
         <?php
      
            $listar = null;
            $directorio = opendir("../reportes/".$id_hv_equipo."/");
            $dir = "../reportes/".$id_hv_equipo."/";
            
            while ($elemento = readdir($directorio)) {  
               
               if ($elemento != '.' && $elemento != '..') {
                  if (is_dir("../reportes/".$elemento)) {
                     $listar .= "<tr><td><span style='font-size: 15px;'><a href='$dir$elemento' target='_blank'>$elemento/</a></span></td></tr>";
                  } else {
                     $listar .= "<tr><td style='padding: 8px 0px 2px 8px;'><span style='font-size: 15px;'><a href='$dir$elemento' target='_blank'><img src='../img/icono_pdf.png' width='22px' style='margin-right: 8px;'>$elemento</a></span></td></tr>";
                  } 
               }     
                           
            }
      
         ?>         
                 
         <table id='tablaRegistros' style="width: 800px;">
            <thead>
               <th class='centrarCelda success' colspan="2">REPORTES DIGITALIZADOS</th>
            </thead>
            <tbody>
               <?php echo $listar; ?>
            </tbody>
         </table>       
         
         <?php
            
         if ($resultado->num_rows>0) {
            
            //Tabla de mantenimientos
            echo "
                  <table id='tablaRegistros' style='margin-top: 20px;'>
                     <thead><th colspan=13 style='border-bottom: 1px solid white;'>REPORTES DESDE EL SISTEMA DE TICKETS</th></thead>
                     <thead>
                        <th class='centrarCelda success'>No. Ticket</th>
                        <th class='centrarCelda success'>Nombre Solicitante</th>
                        <th class='centrarCelda success'>Email Solicitante</th>
                        <th class='centrarCelda success'>Solicitud</th>
                        <th class='centrarCelda success'>Fecha Creación</th>
                        <th class='centrarCelda success'>Fecha Cierre</th>
                        <th class='centrarCelda success'>Agente</th>
                        <th class='centrarCelda success'>Tema de Ayuda</th>
                        <th class='centrarCelda success'>Area</th>
                        <th class='centrarCelda success'>Actividad</th>
                        <th class='centrarCelda success'>Resumen del problema</th>
                        <th class='centrarCelda success'>Tarea Realizada</th>
                        <th class='centrarCelda success'>Editar Incidente</th>
                     </thead>
                     <tbody>         
                     ";                        
                        while ($fila = $resultado->fetch_array()) {
                           echo "<tr>";
                              echo utf8_encode("<td class='centrarCelda'>".$fila['id']."</td>");
                              echo utf8_encode("<td>".$fila['name']."</td>");
                              echo utf8_encode("<td>".$fila['email']."</td>");
                              echo utf8_encode("<td>".$fila['message']."</td>");
                              echo utf8_encode("<td>".$fila['dt']."</td>");
                              echo utf8_encode("<td>".$fila['closedat']."</td>");
                              echo utf8_encode("<td>".$fila['nombre_agente']."</td>");
                              echo utf8_encode("<td>".$fila['custom1']."</td>");
                              echo utf8_encode("<td>".$fila['custom2']."</td>");
                              echo utf8_encode("<td>".$fila['custom3']."</td>");
                              echo utf8_encode("<td>".$fila['custom4']."</td>");
                              echo utf8_encode("<td>".$fila['tarea_realizada']."</td>");
                              echo utf8_encode("<td class='centrarCelda'><a href='editar_incidente.php?id=".$fila['id']."&serie=".$serie."' onclick=''><img src='../img/icono_editar.png' width='22px' title='Editar Incidente de Informatica'></a></td>"); 
                           echo "</tr>";
                        }                                                 
            echo "</tbody></table>";
            
         } else {
            echo "<h3 style='margin-top: 20px;'>No existen registros de mantenimiento asociados a este equipo desde el sistema de tickets!!!</h3>";
         }
         $conexion2->close();
         ?>

    </div>
   <?php
         include('../include/footer.inc.php');
       ?>
</body>
</html>