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
	<title>Cambiar Contraseña de Usuario</title>
	<meta charset="UTF-8">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/pepper-grinder/jquery-ui.css">
   <link rel="stylesheet" href="../css/style2.css">
   <script src="//code.jquery.com/jquery-1.10.2.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script type="text/javascript" src="../js/funciones.js"></script>
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
			   <span>CAMBIAR CONTRASEÑA DE USUARIO</span>
			</div>
			<div id="derecha"><p id="fecha"><?php echo $fecha_colombia; ?></p><br><br><p></p></div>
		</header>
		<div id="seleccionar">
            <span style="font-size: 15px; font-weight: 700;">Usuario: <?php echo strtoupper($_SESSION['nombre']); ?></span>
            <div><a href="menu.php">Regresar al menu</a></div>
         </div>
         <section id="" style="font-size: 12px; padding-left: 10px; padding-top: 10px;">
                <form action="" method="post" id="frmCambiarContrasena">
                    <p style="padding: 10px;">
                        <label for="">Ingrese contraseña actual: </label>
                        <input type="password" name="ca" id="ca" style="height: 24px;">
                    </p>
            
                    <p style="padding: 10px;">
                        <label for="">Ingrese contraseña nueva: </label>
                        <input type="password" name="cn" id="cn" style="height: 24px;">
                    </p>
            
                    <p style="padding: 10px;">
                        <label for="">Repita contraseña nueva: </label>
                        <input type="password" name="rcn" id="rcn" style="height: 24px;">
                    </p>
                    <p style="padding: 10px;"><button type="button" id="btnCambiarContrasena" style="height: 30px; width: 150px;">Cambiar Contraseña</button></p>
                    <input type="hidden" name="idusuario" id="idu" value="<?php echo $_SESSION['id_usuario']; ?>">
                </form>
         </section>
      </div>
   <?php
         include('../include/footer.inc.php');
       ?>
</body>
</html>