<?php

require_once('../../db/utilities.php');

if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellido'])) {
	session_destroy();
	header('Location: ../../');
   exit();
}

if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';}

$sql = "SELECT id_usuario, nick_usuario, nombre_usuario, apellido_usuario, privilegios FROM usuarios ORDER BY id_usuario ASC";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Buscar - HV Equipos HOSDENAR</title>
	<meta charset="UTF-8">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/pepper-grinder/jquery-ui.css">
   <link rel="stylesheet" href="../../css/style2.css">
   <script src="//code.jquery.com/jquery-1.10.2.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script type="text/javascript" src="../../js/funciones.js"></script>
   <script type="text/javascript">
      $(function() {
         $("input[type=submit], button" )
            .button() 
      });
   </script>
</head>
<body>
   <div id="wrapper">

      <!-- ///////////// Cabecera-->
		<header id="cabecera">
			<div id="izquierda"><p>ADMINISTRACION DE USUARIOS</p></div>
			<div id="derecha"><p id="fecha"><?php echo $fecha_colombia; ?></p><br><br><p><span>Bienvenido(a) <?php echo strtoupper($_SESSION['nombre']); echo " ".strtoupper($_SESSION['apellido']); ?></span><span><a href="../logout.php"> Salir</a></span></p></div>
		</header>
		<div id="seleccionar">
           <span><button type="button" id="btn_crear_usuario">Crear Usuario</button></span>
            <div><a href="../menu.php">Regresar al menu</a></div>
         </div>
         <section id="listado_usuarios">
            <table id='tablaRegistros'>
              <thead>
                 <th class='centrarCelda'>No.</th>
                 <th class='centrarCelda'>Nombre</th>
                 <th class='centrarCelda'>Apellido</th>
                 <th class='centrarCelda'>Usuario</th>
                 <th class='centrarCelda'>Privilegios</th>
                 <th class='centrarCelda'></th>
                  <th class='centrarCelda'></th>
                  <th class='centrarCelda'></th>
              </thead>
              <tbody>
               <?php
                  while($fila = $resultado->fetch_array()) {
                     echo "<tr>";
                        echo utf8_encode("<td class='centrarCelda'>{$fila['id_usuario']}</td>");
                        echo utf8_encode("<td class='centrarCelda'>{$fila['nombre_usuario']}</td>");
                        echo utf8_encode("<td class='centrarCelda'>{$fila['apellido_usuario']}</td>");
                        echo utf8_encode("<td class='centrarCelda'>{$fila['nick_usuario']}</td>");
                        echo utf8_encode("<td class='centrarCelda'>{$fila['privilegios']}</td>");
                        echo "<td class='centrarCelda'><a href=''>Actualizar</a></td>";
                        echo "<td class='centrarCelda'><a href=''>Eliminar</a></td>";
                     echo "</tr>";
                  }
               ?>
               </tbody>
            </table>
         </section>
         <section id="nuevo_usuario">
            <form action="" method="post" name="frm_nuevo_usuario" id="frm_nuevo_usuario">
               <p>Nombre: <input type="text" name="nombre_usuario"></p>
               <p>Apellido: <input type="text" name="apellido_usuario"></p>
               <p>Nick: <input type="text" name="nick_usuario"></p>
               <p>Contraseña: <input type="text" name="contrasena_usuario"></p>
               <p>Privilegios: 
                  <select name="privilegios" id="">
                     <option value="1">Administrador</option>
                     <option value="2">Usuario</option>
                  </select>
               </p>
            </form>
            <p>
               <button type="button" id="btn_guardar_usuario">Guardar</button>
               <button type="button" id="btn_cancelar_usuario">Cancelar</button>
            </p>
         </section>
      </div>
   <?php
         include('../include/footer.inc.php');
         $conexion->close();
       ?>
</body>
</html>