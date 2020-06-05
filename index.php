<?php

session_start();
//session_destroy();

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Admin - Sistemas de Registro de Equipos</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   <script type="text/javascript" src="js/funciones.js"></script>
   <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
   <div id="wrapper">
     
      <p><img src="img/logo2.png" alt="" width="70px;"> <span id="titulo">Sistema de Registro de Equipos</span></p>
      <div class="form-group">        
         <form id="frm-login" method="post">
            <p>Usuario: <input type="text" class="form-control" name="user" id="user" required></p>  
            <p>Contraseña: <input type="password" class="form-control" name="password" id="password" required></p>
            <button onclick="login();" id="btn-ingresar" class="btn btn-success btn-sm" type="button">Ingresar</button>
         </form>
      </div>
   </div>
   <footer><p><a href="http://www.leva.pw" target="_blank">HOSPITAL UNIVERSITARIO DEPARTAMENTAL DE NARIÑO</a><br>Dep. Gestión de La Información - <?php echo date('Y'); ?></p></footer>
</body>
</html>