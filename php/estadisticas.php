<?php

require_once('../db/utilities.php');

if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellido'])) {
	session_destroy();
	header('Location: ../');
   exit();
}

$fecha_colombia = fecha(); //Función que devuelve la fecha

//Varible de sesión que verifica si el usuario está logueado o no en el sistema
if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';} 

//Variable de sesión 
$area = $_SESSION['area'];

$sql = "SELECT id_hv_equipo FROM hv_equipo WHERE area='".$area."'";
//Ejecución de la consulta
$resultado = $conexion->query($sql);
//Obtener el total de registros de la tabla
$numRegistros = $resultado->num_rows;

if ($area == 'sterilize') {
   
   //Selecciona en la base de datos los equipos del area de sterilize
   $sql1 = "SELECT id_desc_equipo FROM hv_equipo WHERE id_desc_equipo>=1 AND id_desc_equipo<=6";
   $resultado1 = $conexion->query($sql1);
   $numRegistros1 = $resultado1->num_rows;
   
   //Selecciona en la base de datos los equipos del area de sterilize
   $sql2 = "SELECT id_desc_equipo FROM hv_equipo WHERE id_desc_equipo>=7 AND id_desc_equipo<=16";
   $resultado2 = $conexion->query($sql2);
   $numRegistros2 = $resultado2->num_rows;
   
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Estadísticas</title>
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
      
      ${demo.css}
      
      #seccion_est_por_equipos {
         height: 450px;
         padding: 10px 30px 0px 30px;
      }
      
      #seccion_est_por_usuarios {
         height: 400px;
         padding: 40px 30px 0px 30px;
      }
      
      #seccion_est_por_marca {
         height: 1150px;
         padding: 40px 30px 0px 30px;
      }
      
   </style>
  <script type="text/javascript">
      $(function () {
         
            //***********************************************************************
            $('#container').highcharts({
                 chart: {
                     plotBackgroundColor: null,
                     plotBorderWidth: null,
                     plotShadow: false,
                     // Edit chart spacing
                     spacingBottom: 0,
                     spacingTop: 0,
                     spacingLeft: 0,
                     spacingRight: 0,
                 },
                 title: {
                     text: ''
                 },
                 tooltip: {
                     pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                 },
                 plotOptions: {
                     pie: {
                         allowPointSelect: true,
                         cursor: 'pointer',
                         dataLabels: {
                             enabled: true,
                             format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                             style: {
                                 color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                             }
                         }
                     }
                 },
                 series: [{
                     type: 'pie',
                     name: 'Equipos',
                     data: [

                     <?php 
                        for ($i=17;$i<=29;$i++) {
                           $nombre = buscar('nom_desc_equipo','desc_equipo','id_desc_equipo',$i);
                           $numero = buscar('id_hv_equipo','hv_equipo','id_desc_equipo',$i);
                           if ($i == 25) { continue; } 
                     ?>

                     ['<?php echo $nombre['nombre']; ?>', <?php echo $numero['numero']; ?>],

                     <?php
                        }
                     ?>

                     ]
                 }],

                credits: {
                   position: {
                       align: 'left',
                       verticalAlign: 'bottom',
                       x: 10,
                       y: -10
                   }
               }

             });
            //***********************************************************************
         
         
            //***********************************************************************
            $('#container2').highcharts({
                 chart: {
                     plotBackgroundColor: null,
                     plotBorderWidth: null,
                     plotShadow: false,
                     // Edit chart spacing
                     spacingBottom: 0,
                     spacingTop: 0,
                     spacingLeft: 0,
                     spacingRight: 0,
                 },
                 title: {
                     text: ''
                 },
                 tooltip: {
                     pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                 },
                 plotOptions: {
                     pie: {
                         allowPointSelect: true,
                         cursor: 'pointer',
                         dataLabels: {
                             enabled: true,
                             format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                             style: {
                                 color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                             }
                         }
                     }
                 },
                 series: [{
                     type: 'pie',
                     name: 'Usuarios',
                     data: [

                     <?php
                        for ($i=0;$i<=7;$i++) {
                           $nombre = buscar('nombre_usuario','usuarios','id_usuario',$i+1);
                           $numero = buscar('id_hv_equipo','hv_equipo','id_usuario',$i+1);
                     ?>

                     ['<?php echo utf8_encode($nombre['nombre']); ?>', <?php echo $numero['numero']; ?>],

                     <?php
                        }
                     ?>

                     ]
                 }],

                credits: {
                   position: {
                       align: 'left',
                       verticalAlign: 'bottom',
                       x: 10,
                       y: -10
                   }
               }

             });
            //***********************************************************************
         
            //***********************************************************************
            $('#container3').highcharts({
                 chart: {
                     plotBackgroundColor: null,
                     plotBorderWidth: null,
                     plotShadow: false,
                     // Edit chart spacing
                     spacingBottom: 0,
                     spacingTop: 0,
                     spacingLeft: 0,
                     spacingRight: 0,
                 },
                 title: {
                     text: ''
                 },
                 tooltip: {
                     pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                 },
                 plotOptions: {
                     pie: {
                         allowPointSelect: true,
                         cursor: 'pointer',
                         dataLabels: {
                             enabled: true,
                             format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                             style: {
                                 color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                             }
                         }
                     }
                 },
                 series: [{
                     type: 'pie',
                     name: 'Usuarios',
                     data: [

                     <?php 
                        for ($i=1;$i<=35;$i++) {
                           $nombre = buscar('nombre_marca','marca','id_marca',$i);
                           $numero = buscar('id_hv_equipo','hv_equipo','id_marca',$i);
                     ?>

                     ['<?php echo utf8_encode($nombre['nombre']); ?>', <?php echo $numero['numero']; ?>],

                     <?php
                        }
                     ?>

                     ]
                 }],

                credits: {
                   position: {
                       align: 'left',
                       verticalAlign: 'bottom',
                       x: 10,
                       y: -10
                   }
               }

             });
            //***********************************************************************
      });
  </script>
</head>

<body>
 
   <script src="../highcharts/js/highcharts.js"></script>
   <script src="../highcharts/js/modules/exporting.js"></script>   
  
  <?php include('../include/menu.inc.php');  ?>
  
   <div id="wrapper">
     
      <!-- ///////////// Cabecera-->
		<header id="cabecera">
			<div id="izquierda">
			   <img src="../img/logo2.png" alt="">
			</div>
			<div id="centro">
			   <span>REPORTES ESTADISTICOS</span>
			</div>
			<div id="derecha"><p id="fecha"><?php echo $fecha_colombia; ?></p><br><br><p><span>Bienvenido(a) <?php echo strtoupper($_SESSION['nombre']); ?></span></p></div>
		</header>
		<div id="seleccionar">
           Tipo de reporte:
              <select name="" id="seleccion_tipo_reporte" onchange="escoger_reporte(this.value);">
                <option value="">Seleccione una opción</option>
                 <option value="1">Equipos por tipo</option>
                 <option value="2">Usuarios y hojas de vida ingresadas</option>
                 <option value="3">Equipos por marca</option>
                 <option value="4">Equipos por edificio y piso</option>
              </select>                 
            <div><a href="menu.php">Regresar al menu</a></div>
         </div>
         <div style="margin-bottom: 10px;">
            <p style='font-size: 14px; margin-top: 10px;'><strong>TOTAL HOJAS DE VIDA AREA <?php echo strtoupper($area);  ?>: </strong>
               <?php
                  echo "<span style='font-size: 12px; margin-bottom: 10px;'>".$numRegistros."</span></p>";
               ?>
         </div>
         <section id="seccion_est_por_equipos" style="margin-bottom: 10px; border: 1px solid gray; border-radius: 3px;">
            <div id="izq" style="width: 400px; float: left;">
               <p style="text-align:center; font-size: 16px; margin-bottom: 20px;"><strong>ESTADISTICA POR NUMERO DE EQUIPOS</strong></p>
                           
               <?php
                  if ($area == 'sterilize') {
                     echo '<h4>Total Hojas de Vida Equipo Biomédico: '.$numRegistros1.'</h4>';
                     echo '<h4>Total Hojas de Vida Equipo Industrial y de uso Hospitalario: '.$numRegistros2.'</h4>';
                  }
               
               ?>
                  <table style="font-size: 12px;">
                      <thead>
                        <tr>
                           <th>Tipo de Equipo</th>
                           <th>No. de Equipos</th>
                        </tr>                       
                      </thead>
                      <tbody>
                        <tr>
                           <?php
                              $sql = "SELECT id_desc_equipo FROM desc_equipo";
                              $resultado = $conexion->query($sql);
                              $total = $resultado->num_rows;
                              $total = $total+1;
                              for ($i=17;$i<=$total;$i++) {                                
                                 $nombre = buscar('nom_desc_equipo','desc_equipo','id_desc_equipo',$i);
                                 $numero = buscar('id_hv_equipo','hv_equipo','id_desc_equipo',$i);
                                 if ($i == 25) {
                                    continue;
                                 } 
                                    echo "<tr>";
                                    echo "<td>".$nombre['nombre']."</td>";                                    
                                    echo "<td>".$numero['numero']."</td>"; 
                                    echo "</tr>";
                                                                 
                              }
                           ?>
                        </tr>         
                      </tbody>                   
                  </table>
            </div>
            
            <div id="der" style="float: right;">
               <div id="container" style="width: 600px;"></div>
            </div>
         </section>
         
        <!--///////////////////////////////////////////////////////////////////////////////////////-->
         <section id="seccion_est_por_usuarios" style="padding: 10px; margin-bottom: 10px; border: 1px solid gray; border-radius: 3px;">
            <div id="izq" style="width: 400px; float: left;">
               <p style="text-align:center; font-size: 16px; margin-bottom: 20px;"><strong>ESTADISTICA POR USUARIOS</strong></p>
                 
                  <table style="font-size: 12px;">
                      <thead>
                        <tr>
                           <th>Nombre de Usuario</th>
                           <th>No. de Equipos Ingresados al sistema</th>
                        </tr>                       
                      </thead>
                      <tbody>                     
                           <?php
                              for ($i=0;$i<=7;$i++) {
                                 echo "<tr>";
                                 $nombre = buscar('nombre_usuario','usuarios','id_usuario',$i+1);
                                 echo "<td>".utf8_encode($nombre['nombre'])."</td>";
                                 $numero = buscar('id_hv_equipo','hv_equipo','id_usuario',$i+1); 
                                 echo "<td>".$numero['numero']."</td>"; 
                                 echo "</tr>";
                              }
                           ?>                       
                      </tbody>                   
                  </table>
            </div>
            
            <div id="der" style="float: right;">
               <div id="container2" style="width: 600px;"></div>
            </div>            
         </section>
         <!--///////////////////////////////////////////////////////////////////////////////////////-->
         
         
        <!--///////////////////////////////////////////////////////////////////////////////////////-->
         <section id="seccion_est_por_marca" style="padding: 10px; margin-bottom: 10px; border: 1px solid gray; border-radius: 3px;">
            <div id="izq" style="width: 400px; float: left;">
               <p style="text-align:center; font-size: 16px; margin-bottom: 20px;"><strong>ESTADISTICA POR MARCA DE EQUIPOS</strong></p>          
               
                  <table style="font-size: 12px;">
                      <thead>
                        <tr>
                           <th>Marca</th>
                           <th>No. de Equipos</th>
                        </tr>                       
                      </thead>
                      <tbody>
                           <?php
                              $sql = "SELECT id_marca FROM marca";
                              $resultado = $conexion->query($sql);
                              $total = $resultado->num_rows;
                              for ($i=1;$i<=$total;$i++) {
                                 echo "<tr>";
                                 $nombre = buscar('nombre_marca','marca','id_marca',$i);
                                 if ($nombre['nombre'] == 'N/A') {
                                    $nombre['nombre'] = "N/A (No Aplica)";
                                 }
                                 echo "<td>".$nombre['nombre']."</td>";
                                 $numero = buscar('id_hv_equipo','hv_equipo','id_marca',$i);
                                 echo "<td>".$numero['numero']."</td>";
                                 echo "</tr>";
                              }
                           ?>        
                      </tbody>                   
                  </table>
            </div>
            
            <div id="der" style="float: right;">
               <div id="container3" style="width: 600px;"></div>
            </div>
            
         </section>
        <!--///////////////////////////////////////////////////////////////////////////////////////-->
        
        
        <!--///////////////////////////////////////////////////////////////////////////////////////-->
         <section id="seccion_est_por_edificio_piso" style="padding: 10px; margin-bottom: 10px; border: 1px solid gray; border-radius: 3px;">
            <p style="text-align:center; font-size: 16px; margin-bottom: 20px;"><strong>ESTADISTICA EDIFICIO Y PISO</strong></p>
            
            <p>
               <table style="font-size: 12px; margin-bottom: 10px;">
                   <thead>
                     <tr>
                        <th colspan="3">UNIDAD COMPLEMENTARIA DE SERVICIOS</th>
                     </tr>
                     <tr>
                        <td style="font-weight: bold; text-align:center;">Piso</td>
                        <td style="font-weight: bold; text-align:center;">No. de Equipos</td>
                     </tr>                       
                   </thead>
                   <tbody>
                        <?php
                           $piso = array('Primero','Segundo','Tercero','Cuarto','Quinto');
                           for ($i=0;$i<=4;$i++) {
                              $sql = "SELECT id_hv_equipo FROM hv_equipo WHERE edificio='UNIDAD COMPLEMENTARIA DE SERVICIOS' AND piso='".$piso[$i]."'";
                              $resultado = $conexion->query($sql);
                              $total = $resultado->num_rows;
                              $suma = $suma+$total;
                              echo "<tr>";
                                 echo "<td>".$piso[$i]."</td>";
                                 echo "<td>".$total."</td>";
                              echo "</tr>";
                           }
                           echo "<tr><td colspan='3' style='font-weight: bold; text-align:center;'>TOTAL: ".$suma."</td></tr>";
                        ?>                        
                   </tbody>                   
               </table>
               
               <table style="font-size: 12px; margin-bottom: 10px;">
                   <thead>
                     <tr>
                        <th colspan="3">PRINCIPAL</th>
                     </tr>
                     <tr>
                        <td style="font-weight: bold; text-align:center;">Piso</td>
                        <td style="font-weight: bold; text-align:center;">No. de Equipos</td>
                     </tr>                 
                   </thead>
                   <tbody>
                        <?php
                           $piso = array('Primero','Segundo','Tercero','Cuarto','Quinto');
                           $suma = 0;
                           for ($i=0;$i<=4;$i++) {
                              $sql = "SELECT id_hv_equipo FROM hv_equipo WHERE edificio='PRINCIPAL' AND piso='".$piso[$i]."'";
                              $resultado = $conexion->query($sql);
                              $total = $resultado->num_rows;
                              $suma = $suma+$total;
                              echo "<tr>";
                                 echo "<td>".$piso[$i]."</td>";
                                 echo "<td>".$total."</td>";
                              echo "</tr>";
                           }
                           echo "<tr><td colspan='3' style='font-weight: bold; text-align:center;'>TOTAL: ".$suma."</td></tr>";
                        ?>                        
                   </tbody>                   
               </table>
               
               <table style="font-size: 12px;">
                   <thead>
                     <tr>
                        <th>N/A</th>
                     </tr>              
                   </thead>
                   <tbody>
                        <?php
                           $sql = "SELECT id_hv_equipo FROM hv_equipo WHERE edificio='N/A' AND piso='N/A'";
                           $resultado = $conexion->query($sql);
                           $total = $resultado->num_rows;
                           echo "<tr><td style='font-weight: bold; text-align:center;'>TOTAL: ".$total."</td></tr>";
                        ?>                        
                   </tbody>                   
               </table>
            </p>
            
         </section>
        <!--///////////////////////////////////////////////////////////////////////////////////////-->
    </div>
   <?php
         include('../include/footer.inc.php');
       ?>
</body>
</html>