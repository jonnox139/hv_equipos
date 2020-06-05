<?php 

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

require_once('credentials.php');

session_start();

$conexion = new mysqli(db_host,db_user,db_pass,db_name);

if($conexion->connect_errno) {
	echo "ERROR: ".$conexion->connect_error;
	exit();
}

function login($tabla_campos) {
	global $conexion;

	$user = $conexion->real_escape_string($user);
	$password = $conexion->real_escape_string($password);
	$sql = "SELECT * FROM $tabla_campos[0] WHERE nick_usuario='{$tabla_campos[1]}' AND contrasena_usuario='{$tabla_campos[2]}'";
	return $resultado = $conexion->query($sql);
}

function fecha() {
	global $hora, $dias, $meses;

	$salida = $dias[date('w')].' '.date('d').' de '.$meses[date('n')-1]. ' de '.date('Y');
	return $salida;
}

function seleccionar_db($campos,$tabla,$where) {
	global $conexion;

	$campos = implode(",", $campos);
    
    /*if (is_array($tabla)) {
        $tabla = implode(",", $tabla);
        $sql = "SELECT $campos FROM $tabla WHERE $where";
    } else {
        $tabla = $tabla;
        $sql = "SELECT $campos FROM $tabla $where";
    }
    */
    
	$sql = "SELECT $campos FROM $tabla $where";
	$resultado = $conexion->query($sql);
	return $resultado;
}

//Función para buscar tipo de equipo, usuarios y marcas en la base de datos
function buscar($nombre_campo,$tabla,$nom_camp,$numero) {
   
   global $conexion;
   
   $sql = "SELECT $nombre_campo FROM $tabla WHERE $nom_camp='".$numero."'";
   $resultado = $conexion->query($sql);
   
   $fila = $resultado->fetch_array();
   $total = $resultado->num_rows;
   
   $salida['nombre'] = $fila[$nombre_campo];
   $salida['numero'] = $total;
   
   return $salida;
}

?>