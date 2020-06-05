<?php

require_once('../db/utilities.php');

if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellido'])) {
	session_destroy();
	header('Location: ../');
   exit();
}

$fecha_colombia = fecha(); //Función que devuelve la fecha

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Registrar Equipo</title>
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
         $("#accordion").accordion({
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
</head>

<body>
  
   <div id="dialog-confirm" title="INFORMACION" style="display: none;">
      <p style="font-size:13px;">Puede guardar el formulario y editarlo más adelante sin perder los cambios. <br>
      Desea guardar el registro?      
      </p>
   </div>
  
     <?php include('../include/menu.inc.php');  ?>
  
   <div id="wrapper">

      <!-- ///////////// Cabecera-->
		<header id="cabecera">
			<div id="izquierda">
			   <img src="../img/logo2.png" alt="">
			</div>
			<div id="centro">
			   <span>REGISTRO DE EQUIPO DE OPERACION</span>
			</div>
			<div id="derecha"><p id="fecha"><?php echo $fecha_colombia; ?></p><br><br><p><span>Bienvenido(a) <?php echo strtoupper($_SESSION['nombre']); ?></span></p></div>
		</header>
      <!-- ************* Fin Cabecera -->

      <!-- ///////////// Seleccionar-->
      <div id="seleccionar">
        <span id="post_verificacion">
         <span><strong>Clase de Equipo</strong></span>
         <select name="seleccion-equipo" id="seleccion-equipo" onchange="cambiar_tipo_equipo(this.value)">
            <option value="0">Seleccione una opción</option>
            <?php  
             
               $campos = array('id_clasf_equipo','nom_clasf_equipo');
                $tabla = 'clasf_equipo';
                $where = '';
                
             
               $result = seleccionar_db($campos,$tabla,$where);
             
               while ($row = $result->fetch_array()) {
                  echo utf8_encode("<option value='".$row['id_clasf_equipo']."'>".$row['nom_clasf_equipo']."</option>");
               }
            ?>
         </select>
         <button type="button" id="btn_Agregar">Agregar Registro</button>
         <div><a href="menu.php">Regresar al menu</a></div>
         </span>
      </div>
      <!-- ************* Fin Seleccionar -->

      <!-- ///////////// INICIO ACORDEON-->
      <div id="accordion">

         <!-- ///////////// Parte 1. Descripción-->
         
            <h3>1. DESCRIPCION</h3>
            <div id="descripcion">  
               <form action="" method="post" id="frm_hoja_de_vida" enctype="multipart/form-data">
               <div id="descrip">
               
               </div>
            </div>
            <!-- ************* Fin Parte 1. -->
            
            <!-- ///////////// Parte 2. Identificación-->
            <h3>2. IDENTIFICACION</h3>
            <div id="identificacion">
               <table>
                  <tr>
                     <td>Inv/Activo:</td>
                     <td><input type="text" name="inv_activo" id="inv_activo" class="requerido"></td>
                     <td>RS (Registro Sanitario):</td>
                     <td><input type="text" name="reg_sanit" id="reg_sanit" class="requerido"></td>
                     <td>PC (Permiso de Comercialización):</td>
                     <td><input type="text" name="perm_comerc" id="perm_comerc" class="requerido"></td>
                  </tr>
                  <tr>
                     <td>Edificio:</td>
                     <td>
                        <!--<input type="text" name="edificio" id="" class="requerido">-->
                        <select name="edificio" id="edificio">
                             <option value="N/A">N/A</option>
                           <option value="UNIDAD COMPLEMENTARIA DE SERVICIOS">UNIDAD COMPLEMENTARIA DE SERVICIOS</option>
                           <option value="PRINCIPAL">PRINCIPAL</option>
                        </select>
                     </td>
                     <td>Piso:</td>
                     <td>
                        <!--<input type="text" name="piso" id="" class="requerido">-->
                        <select name="piso" id="piso">
                          <option value="N/A">N/A</option>
                           <option value="PRIMERO">PRIMERO</option>
                           <option value="SEGUNDO">SEGUNDO</option>
                           <option value="TERCERO">TERCERO</option>
                           <option value="CUARTO">CUARTO</option>
                           <option value="QUINTO">QUINTO</option>
                        </select>
                     </td>
                     <td>No. de Carpeta:</td>
                     <td><input type="text" name="num_carpeta" id="" class="requerido"></td>
                  </tr>
               </table>
            </div>
            <!-- ************* Fin Parte 2. -->
            
            <!-- ///////////// Parte 3. Equipo-->
            <h3>3. EQUIPO</h3>
            <div id="equipo">                 
               <div id="equipo-izquierda">
                  <div id="subir">
                    Subir Imágen: <input type="file" name="file" id="file">  
                  </div>
                  <div id="imagen"></div>
               </div>
               <div id="equipo-derecha">
                  <table>
                    <tr>
                        <td>Equipo:</td>
                        <td><input type="text" name="descripcion_equipo" id="" class="requerido"></td>
                     </tr>
                     <tr>
                        <td>Marca:</td>
                        <td>
                           <!--<input type="text" name="marca" id="" class="requerido">-->
                           <select name="id_marca" id="">
                             
                             <option value="22">N/A</option>
                              <?php  

                                 $campos = array('id_marca','nombre_marca');
                                  $tabla = 'marca';
                                  $where = 'order by nombre_marca';


                                 $result = seleccionar_db($campos,$tabla,$where);

                                 while ($row = $result->fetch_array()) {
                                    echo utf8_encode("<option value='".$row['id_marca']."'>".$row['nombre_marca']."</option>");
                                 }
                              ?>
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <td>Modelo:</td>
                        <td><input type="text" name="modelo" id="" class="requerido"></td>
                        <td>Serie:</td>
                        <td><input type="text" name="serie" id="serie" class="requerido" style="text-transform: uppercase;"></td>
                     </tr>
                     <tr>
                        <td>Servicio:</td>
                        <td><input type="text" name="servicio" id="" class="requerido"></td>
                        <td>Ubicación:</td>
                        <td><input type="text" name="ubicacion" id="" class="requerido"></td>
                     </tr>
                     <tr>
                        <td>Equipo:</td>
                        <td><input type="radio" name="rd_equipo" id="" value="movil" checked class=""> Móvil</td>
                        <td><input type="radio" name="rd_equipo" id="" value="fijo" class=""> Fijo</td>
                     </tr>
                  </table>
               </div>
            </div>
            <!-- ************* Fin Parte 3. -->
            
            <!-- ///////////// Parte 4. Registro Histórico-->
            <h3>4. REGISTRO HISTORICO</h3>
            <div id="registro-historico">
               <table>
                  <tr>
                     <td>Fecha Adquisición (Fecha orden de compra o contrato):</td>
                     <td><input type="text" name="fec_adquis" id="" class="" placeholder="aaaa-mm-dd"></td>
                     <td>Número de órden de compra o contrato:</td>
                     <td><input type="text" name="num_ord_comp" id="" class=""></td>
                  </tr>
                  <tr>
                     <td>Número de factura:</td>
                     <td><input type="text" name="num_fact" id="" class=""></td>
                     <td>Número de acta técnica:</td>
                     <td><input type="text" name="num_act_tec" id="" class=""></td>
                  </tr>
                  <tr>
                     <td>Fecha entrega/Instalación inicial:</td>
                     <td><input type="text" name="fec_ent_inst" id="" class="" placeholder="aaaa-mm-dd"></td>
                     <td>Fecha inicio de operación:</td>
                     <td><input type="text" name="fec_inic_oper" id="" class="" placeholder="aaaa-mm-dd"></td>
                  </tr>
                  <tr>
                     <td>Fecha vencimiento garantia:</td>
                     <td><input type="text" name="fec_venc_gar" id="" class="" placeholder="aaaa-mm-dd"></td>
                     <td>Año de fabricación:</td>
                     <td><input type="text" name="anio_fabr" id="" class="" placeholder="">
                     </td>
                  </tr>
                  <tr>
                     <td>Costo (Pesos):</td>
                     <td><input type="text" name="costo" id="" class="" placeholder=""></td>
                     <td>Vida Util (Años):</td>
                     <td><!--<input type="text" name="vida_util" id="" class="" placeholder="">-->
                        <select name="vida_util" id="" style="width: 203px; height: 24px;">
                           <script type="text/javascript">
                              crear_anio(1,30);
                           </script>
                        </select>
                     </td>
                  </tr>
               </table>
               <table>
                  <tr>
                     <td>Proveedor:</td>
                     <td><input type="text" name="proveed" id="" class=""></td>
                     <td>Teléfono:</td>
                     <td><input type="text" name="telf_proveed" id="" class="" placeholder=""></td>
                     <td>Email:</td>
                     <td><input type="text" name="email_proveed" id="" class=""></td>
                  </tr>
                  <tr>
                     <td>Representante:</td>
                     <td><input type="text" name="represent" id="" class=""></td>
                     <td>Teléfono:</td>
                     <td><input type="text" name="telf_respresent" id="" class="" placeholder=""></td>
                     <td>Email:</td>
                     <td><input type="text" name="email_represent" id="" class=""></td>
                  </tr>
                  <tr>
                     <td>Fabricante:</td>
                     <td><input type="text" name="fabric" id="" class=""></td>
                     <td>Teléfono:</td>
                     <td><input type="text" name="telf_fabric" id="" class="" placeholder=""></td>
                     <td>Email:</td>
                     <td><input type="text" name="email_fabric" id="" class=""></td>
                  </tr>
               </table>
            </div>
            <!-- ************* Fin Parte 4. -->
            
            <!-- ///////////// Parte 5. Forma de adquisición-->
            <h3>5. FORMA DE ADQUISICION</h3>
            <div id="forma-adquisicion">
               <table>
                   <tr>
                      <td><input type="radio" name="rd_form_adquis" id="" value="Compra Directa" checked> Compra Directa</td>
                      <td><input type="radio" name="rd_form_adquis" value="Comodato" id="" > Comodato</td>
                      <td><input type="radio" name="rd_form_adquis" value="Donacion" id="" > Donación</td>
                      <td><input type="radio" name="rd_form_adquis" value="Leasing" id="" > Leasing</td>
                   </tr>
                   <input type="hidden" name="txt_otro_form_adquis" id="" value="null" >
                   <!--<tr>                   
                      <td colspan=4><input type="radio" name="rd_form_adquis" id="" > Otro(¿Cual?): <input type="text" name="txt_otro_form_adquis" id="" ></td>
                      <input type="hidden" name="txt_otro_form_adquis" id="" >
                   </tr>-->
                </table> 
            </div>
            <!-- ************* Fin Parte 5. -->
            
            <!-- ///////////// Parte 6. Registro Técnico de instalación y de funcionamiento-->
            <h3>6. REGISTRO TECNICO DE INSTALACION Y DE FUNCIONAMIENTO</h3>
            <div id="registro-tecnico">
               <table>
                  <tr>
                     <td>Fuente de Alimentación:</td>
                     <td><input type="text" name="fue_alim" id="" value="No Aplica" placeholder="" ></td>
                     <td>Tec. Predominante:</td>
                     <td><input type="text" name="tec_predom" id="" value="No Aplica" placeholder="" ></td>
                     <td>Voltaje Máximo:</td>
                     <td><input type="text" name="vol_max" id="" value="No Aplica" placeholder="" class="numero_entero"></td>
                     <td>Voltaje Mínimo:</td>
                     <td><input type="text" name="vol_min" id="" value="No Aplica" placeholder="" class="numero_entero"></td>
                  </tr>
                  <tr>
                     <td>Corriente Máxima:</td>
                     <td><input type="text" name="cor_max" id="" value="No Aplica" placeholder="" class="numero_entero"></td>
                     <td>Corriente Mínima:</td>
                     <td><input type="text" name="cor_min" id="" value="No Aplica" placeholder="" class="numero_entero"></td>
                     <td>Potencia:</td>
                     <td><input type="text" name="potencia" id="" value="No Aplica" placeholder="" class="numero_entero"></td>
                     <td>Velocidad:</td>
                     <td><input type="text" name="velocidad" id="" value="No Aplica" placeholder="" class="numero_entero"></td>
                  </tr>
                  <tr>
                     <td>Peso:</td>
                     <td><input type="text" name="peso" id="" value="No Aplica" placeholder="" class="numero_entero"></td>
                     <td>Temperatura:</td>
                     <td><input type="text" name="temp" id="" value="No Aplica" placeholder="" class="numero_entero"></td>
                     <td>Presión:</td>
                     <td><input type="text" name="presion" id="" value="No Aplica" placeholder="" class="numero_entero"></td>
                     <td>Otro:</td>
                     <td><input type="text" name="reg_tec_otro" id="" value="No Aplica" placeholder=""></td>
                     <!--<input type="hidden" name="reg_tec_otro" value="null">-->
                  </tr>
               </table>
            </div>
            <!-- ************* Fin Parte 6. -->
            
            <!-- ///////////// Parte 7. Registro de Apoyo Técnico-->
            <h3>7. REGISTRO DE APOYO TECNICO</h3>
            <div id="registro-apoyo">
               <table>
                  <tr>
                     <td><strong>MANUALES</strong></td>
                     <td><strong>CANTIDAD</strong></td>
                     <td><strong>PLANOS</strong></td>
                     <td><strong>CANTIDAD</strong></td>
                     <td colspan=2><strong>CLASIFICACION DEL RIESGO</strong></td>
                  </tr>
                  <tr>
                     <td>Operación:</td>
                     <td><!--<input type="text" name="operacion" id="" value="No Aplica" placeholder="" class="numero_entero">-->
                        <select name="operacion" id="" style="width: 203px; height: 24px;">
                           <script type="text/javascript">
                              crear_anio(0,30);
                           </script>
                        </select>
                     </td>
                     <td>Eléctricos:</td>
                     <td><!--<input type="text" name="electricos" id="" value="No Aplica" placeholder="" class="numero_entero">-->
                        <select name="electricos" id="" style="width: 203px; height: 24px;">
                           <script type="text/javascript">
                              crear_anio(0,30);
                           </script>
                        </select>
                     </td>
                     <td>Clase I</td>
                     <td><input type="text" name="clase_i" id="" value="No Aplica" placeholder=""></td>
                  </tr>
                  <tr>
                     <td>Mantenimiento:</td>
                     <td><!--<input type="text" name="mantenimiento" id="" value="No Aplica" placeholder="" class="numero_entero">-->
                        <select name="mantenimiento" id="" style="width: 203px; height: 24px;">
                           <script type="text/javascript">
                              crear_anio(0,30);
                           </script>
                        </select>
                     </td>
                     <td>Electrónicos:</td>
                     <td><!--<input type="text" name="electronicos" id="" value="No Aplica" placeholder="" class="numero_entero">-->
                        <select name="electronicos" id="" style="width: 203px; height: 24px;">
                           <script type="text/javascript">
                              crear_anio(0,30);
                           </script>
                        </select>
                     </td>
                     <td>Clase IIA</td>
                     <td><input type="text" name="clase_iia" id="" value="No Aplica" placeholder=""></td>
                  </tr>
                  <tr>
                     <td>Partes:</td>
                     <td><!--<input type="text" name="partes" id="" value="No Aplica" placeholder="" class="numero_entero">-->
                        <select name="partes" id="" style="width: 203px; height: 24px;">
                           <script type="text/javascript">
                              crear_anio(0,30);
                           </script>
                        </select> 
                     </td>
                     <td>Hidráulicos:</td>
                     <td><!--<input type="text" name="hidraulicos" id="" value="No Aplica" placeholder="" class="numero_entero">-->
                        <select name="hidraulicos" id="" style="width: 203px; height: 24px;">
                           <script type="text/javascript">
                              crear_anio(0,30);
                           </script>
                        </select>  
                     </td>
                     <td>Clase IIB</td>
                     <td><input type="text" name="clase_iib" id="" value="No Aplica" placeholder=""></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td>Neumáticos:</td>
                     <td><!--<input type="text" name="neumaticos" id="" value="No Aplica" placeholder="" class="numero_entero">-->
                        <select name="neumaticos" id="" style="width: 203px; height: 24px;">
                           <script type="text/javascript">
                              crear_anio(0,30);
                           </script>
                        </select>
                     </td>
                     <td>Clase III</td>
                     <td><input type="text" name="clase_iii" id="" value="No Aplica" placeholder=""></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td>Mecánicos:</td>
                     <td><!--<input type="text" name="mecanicos" id="" value="No Aplica" placeholder="" class="numero_entero">-->
                        <select name="mecanicos" id="" style="width: 203px; height: 24px;">
                           <script type="text/javascript">
                              crear_anio(0,30);
                           </script>
                        </select>
                     </td>
                     <td></td>
                     <td></td>
                  </tr>
               </table>
            </div>
            <!-- ************* Fin Parte 7. -->
            
            <!-- ///////////// Parte 8. Accesorios-->
            <h3>8. ACCESORIOS</h3>
            <div id="accesorios">
               <table>
                  <tr>
                     <td><strong>NOMBRE</strong></td>
                     <td><strong>OBSERVACIONES</strong></td>
                  </tr>
                  <tr>
                     <td class="accesorios-nombre"><input type="text" name="acce_nom1" id="" value="No Aplica" placeholder=""></td>
                     <td><input type="text" name="acce_obs1" id="" value="No Aplica" placeholder=""></td>
                  </tr>
                  <tr>
                     <td class="accesorios-nombre"><input type="text" name="acce_nom2" id="" value="No Aplica" placeholder=""></td>
                     <td><input type="text" name="acce_obs2" id="" value="No Aplica" placeholder=""></td>
                  </tr>
                  <tr>
                     <td class="accesorios-nombre"><input type="text" name="acce_nom3" id="" value="No Aplica" placeholder=""></td>
                     <td><input type="text" name="acce_obs3" id="" value="No Aplica" placeholder=""></td>
                  </tr>
                  <tr>
                     <td class="accesorios-nombre"><input type="text" name="acce_nom4" id="" value="No Aplica" placeholder=""></td>
                     <td><input type="text" name="acce_obs4" id="" value="No Aplica" placeholder=""></td>
                  </tr>
                  <tr>
                     <td class="accesorios-nombre"><input type="text" name="acce_nom5" id="" value="No Aplica" placeholder=""></td>
                     <td><input type="text" name="acce_obs5" id="" value="No Aplica" placeholder=""></td>
                  </tr>
               </table>
            </div>
            <!-- ************* Fin Parte 8. -->
            
            <!-- ///////////// Parte 9. Mantenimiento-->
            <h3>9. MANTENIMIENTO</h3>
            <div id="mantenimiento">
               <table>
                  <tr>
                     <td>Periodicidad del Mantenimiento:</td>
                     <td><input type="text" name="per_mant" id="" value="No Aplica" placeholder="">
                     </td>
                     <td>¿Requiere Calibración?</td>
                     <td><input type="text" name="req_calib" id="" value="No Aplica" placeholder="">
                     </td>
                     <td>Periodicidad de Calibración:</td>
                     <td><input type="text" name="per_calib" id="" value="No Aplica" placeholder="">
                     </td>
                  </tr>
               </table>
            </div>
            <!-- ************* Fin Parte 9. -->
            
            <!-- ///////////// Parte 10. Lista de chequeo-->
            <h3>10. LISTA DE CHEQUEO DE DOCUMENTOS SOPORTES ANEXOS A LA HOJA DE VIDA</h3>
            <div id="lista-chequeo">
               <table>
                  <tr>
                     <td><strong>No.</strong></td>
                     <td><strong>Documento</strong></td>
                     <td><strong>Anexo</strong></td>
                     <td><strong>No Anexo</strong></td>
                     <td><strong>No Aplica</strong></td>
                     <td><strong>Observaciones</strong></td>
                  </tr>
                  <tr>
                     <td>1</td>
                     <td>Copia registro sanitario</td>
                     <td><input type="radio" name="rd_cop_reg_san" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_cop_reg_san" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_cop_reg_san" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_cop_reg_san" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>2</td>
                     <td>Copia permiso de comercialización</td>
                     <td><input type="radio" name="rd_cop_perm_comerc" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_cop_perm_comerc" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_cop_perm_comerc" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_cop_perm_comerc" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>3</td>
                     <td>Copia registro de importación o declaración </td>
                     <td><input type="radio" name="rd_cop_reg_imp" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_cop_reg_imp" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_cop_reg_imp" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_cop_reg_imp" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>4</td>
                     <td>Copia factura</td>
                     <td><input type="radio" name="rd_cop_fact" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_cop_fact" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_cop_fact" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_cop_fact" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>5</td>
                     <td>Copia de ingreso a almacén o activos fijos</td>
                     <td><input type="radio" name="rd_cop_ing_alm" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_cop_ing_alm" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_cop_ing_alm" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_cop_ing_alm" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>6</td>
                     <td>Acta de entrega del proveedor</td>
                     <td><input type="radio" name="rd_act_ent" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_act_ent" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_act_ent" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_act_ent" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>7</td>
                     <td>Manuales de usuario y servicio en español y original</td>
                     <td><input type="radio" name="rd_man_usu" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_man_usu" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_man_usu" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_man_usu" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>8</td>
                     <td>Cronograma de mantenimiento por el tiempo de garantia</td>
                     <td><input type="radio" name="rd_cron_mant" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_cron_mant" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_cron_mant" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_cron_mant" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>9</td>
                     <td>Guía rápida de operación</td>
                     <td><input type="radio" name="rd_guia_rap" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_guia_rap" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_guia_rap" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_guia_rap" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>10</td>
                     <td>Copia de acta técnica del HUDN</td>
                     <td><input type="radio" name="rd_cop_act_tec" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_cop_act_tec" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_cop_act_tec" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_cop_act_tec" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>11</td>
                     <td>Estimativo de costo de accesorios y consumibles (Entregado por el proveedor)</td>
                     <td><input type="radio" name="rd_est_cost_acces" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_est_cost_acces" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_est_cost_acces" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_est_cost_acces" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>12</td>
                     <td>Carta de garantía</td>
                     <td><input type="radio" name="rd_car_garant" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_car_garant" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_car_garant" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_car_garant" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>13</td>
                     <td>Soporte técnico por mínimo 5 años</td>
                     <td><input type="radio" name="rd_sop_tec" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_sop_tec" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_sop_tec" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_sop_tec" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>14</td>
                     <td>Capacitaciones</td>
                     <td><input type="radio" name="rd_capacit" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_capacit" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_capacit" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_capacit" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
                  <tr>
                     <td>15</td>
                     <td>Calibración</td>
                     <td><input type="radio" name="rd_calib" id="" value="anexo" ></td>
                     <td><input type="radio" name="rd_calib" id="" value="no_anexo" ></td>
                     <td><input type="radio" name="rd_calib" id="" value="no_aplica" checked></td>
                     <td><input type="text" name="obs_calib" id="" value="Sin Observaciones" placeholder="Sin Observaciones"></td>
                  </tr>
               </table>
            </div>
            <!-- ************* Fin Parte 10. -->
            
            <!-- ///////////// Uso-->
            <h3>USO</h3>
            <div id="uso">
               <table>
                  <tr>
                     <td><input type="radio" name="rd_uso" id="" checked value="apoyo" > Apoyo</td>
                     <td><input type="radio" name="rd_uso" id="" value="basico" > Básico</td>
                     <td><input type="radio" name="rd_uso" id="" value="medico" > Médico</td>
                     <td><input type="radio" name="rd_uso" id="" value="no_definido" > No definido</td>
                  </tr>
               </table>
            </div>
         </form>
         <!-- ************* Fin Uso -->

      </div>
      <!-- ************* FIN ACORDEON -->
   </div>
   <?php
         include('../include/footer.inc.php');
       ?>
       
   <div id="dialogo_verificacion" title="VERIFICAR NÚMERO DE SERIE">
     <p>
        <p style="font-size: 15px;">Antes de ingresar la hoja de vida, verifique el número de serie del equipo:</p>
        <p><input type="text" name="verificar_serie" id="verificar_serie" style="text-transform: uppercase;"></p>
        <div id="resultado_buscar_serial"></div>
     </p>
   </div>
</body>
</html>