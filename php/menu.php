<?php

require_once('../db/utilities.php');

if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellido'])) {
	session_destroy();
	header('Location: ../');
   exit();
}

if(isset($_SESSION['login'])) {} else {$_SESSION['login'] = 'no';} 

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Menu Principal - HV Equipos HOSDENAR</title>
	<meta charset="UTF-8">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/pepper-grinder/jquery-ui.css">
   <link rel="stylesheet" href="../css/style2.css">
   <script src="//code.jquery.com/jquery-1.10.2.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script type="text/javascript" src="../js/funciones.js"></script>
</head>
<body>
	<div id="wrapper" style="padding: 10px;">
      <header id="cabecera">
         <div id="titulo_principal">
		    <span>SISTEMA DE REGISTRO DE EQUIPOS HOSDENAR</span>
         </div>
		</header>
	   <div id="contenedor_menu" style="border: 1px solid #BDBDBD;
   border-radius: 3px; width: 1078px; height: 250px;">
	      <section>
            <h4 style="text-align:center; margin-bottom: 10px; margin-top: 20px;">MENU PRINCIPAL</h4>
	         <article><a href="registrar.php" id="link_menu"><img src="../img/icono_registrar.png" alt="">Registrar Equipo</a></article>
	         <article><a href="buscar.php" style="padding-right: 15px;"><img src="../img/icono_buscar.png" alt="">Buscar Equipo</a></article>
	         <article><a href="estadisticas.php" style="padding-right: 25px;"><img src="../img/icono_estadisticas.png" alt="">Estadisticas</a></article>
	         <article><a href="usuario.php" style="padding-right: 25px;"><img src="../img/icono_usuario.png" alt="">Usuario</a></article>
	         <article><a href="logout.php" style="padding-right: 87px;"><img src="../img/icono_salir.png" alt="">Salir</a></article>
	         
	         <?php             
                if ($_SESSION['login'] == 'yes') {
                  echo '
                     <article><a href="admin_usuarios/administrar_usuario.php" style="padding-right: 25px;"><img src="../img/icono_usuario.png" alt="">Administrar</a></article>
                  ';
                } else {}	                        
             ?>
	      </section>
	   </div>
	</div>
	<?php
         include('../include/footer.inc.php');
       ?>
</body>
</html>