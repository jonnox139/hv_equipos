<?php

require_once('../db/utilities.php');

if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellido'])) {
	session_destroy();
	header('Location: ../');
   exit();
}

if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';}

$fecha_colombia = fecha(); //Función que devuelve la fecha

$id_ticket = $_GET['id'];
$serie = $_GET['serie'];
   
$sql = "SELECT desc_equipo.nom_desc_equipo as tipo_equipo, hv_equipo.* FROM desc_equipo, hv_equipo WHERE serie='$serie' AND desc_equipo.id_desc_equipo=hv_equipo.id_desc_equipo";
$resultado = $conexion->query($sql);
$fila = $resultado->fetch_array();

$conexion2 = new mysqli('localhost','root','4dm1n15tr4t0r/2015*/p4st0','soporte_sistemas_2016');
$sql2 = "SELECT hesk_users.cargo as cargo, hesk_users.name as nombre_agente, hesk_users.id, hesk_tickets.*, hesk_replies.replyto, hesk_replies.message as tarea_realizada, hesk_replies.rating as calificacion FROM hesk_users, hesk_tickets, hesk_replies WHERE hesk_tickets.id='$id_ticket' AND hesk_tickets.owner=hesk_users.id AND hesk_tickets.id=hesk_replies.replyto"; 
$resultado2 = $conexion2->query($sql2);
$fila2 = $resultado2->fetch_array();

$sql3 = "SELECT id_hv_equipo FROM hv_equipo WHERE serie='$serie'"; 
$resultado3 = $conexion->query($sql3);
$fila3 = $resultado3->fetch_array();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
   <title>Buscar Equipo</title>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/pepper-grinder/jquery-ui.css">
   <link rel="stylesheet" href="../css/style2.css">
   <script src="//code.jquery.com/jquery-1.10.2.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script type="text/javascript" src="../js/funciones.js"></script>
   <script type="text/javascript">
      $.datepicker.regional['es'] = {
       closeText: 'Cerrar',
       prevText: '<Ant',
       nextText: 'Sig>',
       currentText: 'Hoy',
       monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
       monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
       dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
       dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
       dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
       weekHeader: 'Sm',
       dateFormat: 'dd/mm/yy',
       firstDay: 1,
       isRTL: false,
       showMonthAfterYear: false,
       yearSuffix: ''
       };
       $.datepicker.setDefaults($.datepicker.regional['es']);
      $(function() {        
         
          $( "#dialog" ).dialog({
            modal: true,
            buttons: {
              Ok: function() {
                $( this ).dialog( "close" );
              }
            }
          });
         
         $("#calendario").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:2016',
            dateFormat: 'yy-mm-dd'
         });
         $("#calendario2").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:2016',
            dateFormat: 'yy-mm-dd'
         });
         $("#calendario3").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:2016',
            dateFormat: 'yy-mm-dd'
         });
         $("#calendario4").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:2016',
            dateFormat: 'yy-mm-dd'
         });
         $("#accordion2").accordion({
            heightStyle: "content" //Altura no automática en cada contenedor del acordeón
         });

         $("input[type=submit], button" )
            .button()
      });
      
      function crear_anio(x,y) {
         var i;
         for (i=x; i<=y; i++) {
            document.write("<option value="+i+">"+i+"</option>");
         }
      }
            
   </script>
   
   <style type="text/css">
      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
      }
   </style>
</head>
<body>
     
     <?php include('../include/menu.inc.php');  ?>
  
   <div id="wrapper">
      
      <!-- ///////////// Cabecera-->
		<header id="cabecera">
			<div id="izquierda">
			   <img src="../img/logo2.png" alt="">
			</div>
			<div id="centro">
			   <span>EDITAR INCIDENTE</span>
			</div>
			<div id="derecha"><p id="fecha"><?php echo $fecha_colombia; ?></p><br><br><p><span>Bienvenido(a) <?php echo strtoupper($_SESSION['nombre']); ?></span></p></div>
		</header>
		<div id="seleccionar">
            <span id="span_buscar" style="font-size: 14px; font-weight: 600;">Incidente con número de ticket: <?php echo $id_ticket; ?></span>
            
            <span id="span_clase"><strong>Clase de Equipo</strong></span>
            <input name="seleccion-equipo" id="seleccion-equipo_input" disabled size="40">      
            <button type="button" id="btn_Editar">Editar</button><button type="button" id="btn_cancelar_edicion">Cancelar</button>
            
            <div>
               <?php
                  echo utf8_encode("<a href='mantenimientos.php?serie=".$serie."&id_hv_equipo=".$fila3['id_hv_equipo']."'>Regresar al reporte</a>");
               ?>
            </div>
         </div>
         
         <form action="">
            <table>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Número de Ticket</td>
                  <td class='centrarCelda'><?php echo $id_ticket; ?></td>
                  <td style="text-align: left; font-weight: bold;">Nombre del Usuario</td>
                  <td class='centrarCelda'><?php echo $fila2['name']; ?></td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Dependencia/Oficina</td>
                  <td class='centrarCelda'><?php echo $fila2['custom2']; ?></td>
                  <td style="text-align: left; font-weight: bold;">Correo Usuario</td>
                  <td class='centrarCelda'><?php echo $fila2['email']; ?></td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;" rowspan="2">Tipo de Equipo</td>
                  <td class='centrarCelda' rowspan="2"><?php echo $fila['tipo_equipo']; ?></td>
                  <td style="text-align: left; font-weight: bold;">No. Serie</td>
                  <td class='centrarCelda'><?php echo $serie; ?></td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Placa de Inventario</td>
                  <td class='centrarCelda'></td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Descripción del Problema:</td>
                  <td colspan="3">
                     <?php echo utf8_encode($fila2['message']); ?>
                  </td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Fecha y Hora de Emisión del Ticket</td>
                  <td><?php echo $fila2['dt']; ?></td>
                  <td colspan="2" style="text-align: center; font-weight: bold;">Ingeniero y/o técnico asignado</td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Fecha y hora de Inicio</td>
                  <td><?php echo $fila2['dt']; ?></td>
                  <td colspan="2"><strong>Nombre:</strong> <?php echo $fila2['nombre_agente']; ?></td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Fecha y Hora de finalización</td>
                  <td><?php echo $fila2['closedat']; ?></td>
                  <td colspan="2"><strong>Cargo: </strong><?php echo utf8_encode($fila2['cargo']); ?></td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Actividad</td>                  
                  <td colspan="4"><?php echo ucfirst(strtolower($fila2['custom3'])); ?></td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Tipo de falla</td>
                  <td colspan="4"><?php echo ucfirst(strtolower($fila2['custom4'])); ?></td>                 
               </tr>  
               <tr>
                  <td style="text-align: left; font-weight: bold;">Diagnóstico del incidente:</td>
                  <td colspan="3">
                     <textarea name="" id="" cols="100" rows="5" style="resize: none; font-size: 11px;"></textarea>
                  </td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Trabajo Realizado:</td>
                  <td colspan="3">
                     <textarea name="" id="" cols="100" rows="5" style="resize: none; font-size: 11px;"><?php $texto = utf8_encode($fila2['tarea_realizada']); echo str_replace('<br />','',$texto); ?></textarea>
                  </td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Observaciones:</td>
                  <td colspan="3">
                     <textarea name="" id="" cols="100" rows="5" style="resize: none; font-size: 11px;"></textarea>
                  </td>
               </tr>
               <tr>
                  <td style="text-align: center; font-weight: bold;" colspan="5">Estado del Servicio</td>
               </tr>
               <tr>
                  <td>Monitoreo</td>
                  <td>SI</td>
                  <td></td>
                  <td>NO</td>
                  <td></td>
               </tr>
               <tr>
                  <td>Espera Repuestos/Reparación/Garantía</td>
                  <td>SI</td>
                  <td></td>
                  <td>NO</td>
                  <td></td>
               </tr>
               <tr>
                  <td>Servicio Concluido</td>
                  <td>SI</td>
                  <td></td>
                  <td>NO</td>
                  <td></td>
               </tr>
               <tr>
                  <td style="text-align: left; font-weight: bold;">Duración de Trabajo (Horas):</td>
                  <td colspan="3"></td>
               </tr>        
            </table>
         </form>
   </div>
   <?php
         include('../include/footer.inc.php');
       ?>
</body>

</html>