<?php

require_once('../db/utilities.php');
require('../include/fpdf/fpdf.php');

if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellido'])) {
	session_destroy();
	header('Location: ../');
   exit();
}

$id_hv_equipo = $_GET['id_hv_equipo'];

$sql = "SELECT clasf_equipo.nom_clasf_equipo, desc_equipo.nom_desc_equipo, hv_equipo.* FROM clasf_equipo, desc_equipo, hv_equipo WHERE clasf_equipo.id_clasf_equipo=desc_equipo.id_clasf_equipo AND desc_equipo.id_desc_equipo=hv_equipo.id_desc_equipo AND id_hv_equipo='$id_hv_equipo'";
$resultado = $conexion->query($sql);

$fila = $resultado->fetch_array();

class PDF extends FPDF {
// Cabecera de página
   function Header() {
       // Logo
       $this->Image('../img/logo2.png',10,8,33);
       // Arial bold 15
       $this->SetFont('Arial','B',15);
       // Movernos a la derecha
       $this->Cell(80);
       // Título
       $this->Cell(30,10,'Title',1,0,'C');
       // Salto de línea
       $this->Ln(20);
   }

   // Pie de página
   function Footer() {
       // Posición: a 1,5 cm del final
       $this->SetY(-15);
       // Arial italic 8
       $this->SetFont('Arial','I',8);
       // Número de página
       $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
   }
}

$pdf = new FPDF('P','mm','Letter');

$pdf->AddPage();

$pdf->Image('../img/logo2.png',15,8,20);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(210,5,utf8_decode('HOSPITAL UNIVERSITARIO DEPARTAMENTAL DE NARIÑO'),0,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(210,10,utf8_decode('SISTEMA DE REGISTRO - HOJAS DE VIDA EQUIPOS'),0,1,'C');

$pdf->SetFont('Arial','',11);
$pdf->Cell(0,7,'Hoja de Vida No. '.$fila['id_hv_equipo'],0,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'CLASE DE EQUIPO: ',1,1,'L',true);
$pdf->SetFont('Arial','',5);
$pdf->Cell(0,3,''.$fila['nom_clasf_equipo'],1,0,'L');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'DESCRIPCION EQUIPO: ',1,1,'L',true);
$pdf->SetFont('Arial','',5);
$pdf->Cell(0,3,''.$fila['nom_desc_equipo'],1,0,'L');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'IDENTIFICACION: ',1,1,'L',true);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Inv/Activo: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(30,3,''.$fila['inv_activo'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Registro Sanitario: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(30,3,''.$fila['reg_sanit'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(45.79,3,utf8_decode('Permiso de Comercialización: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(30,3,''.$fila['perm_comerc'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Edificio: ',1);
$pdf->SetFont('Arial','',4.5);
$pdf->Cell(35,3,''.$fila['edificio'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Piso: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(35,3,''.$fila['piso'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'No. de Carpeta: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(35.8,3,''.$fila['num_carpeta'],1,0,'C');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'EQUIPO: ',1,1,'L',true);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Marca: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(35,3,''.$fila['marca'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Modelo: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(35,3,''.$fila['modelo'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Serie: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(35.8,3,''.$fila['serie'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Servicio: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(35,3,''.$fila['servicio'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Ubicacion: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(35,3,''.$fila['ubicacion'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Equipo: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(35.8,3,''.$fila['rd_equipo'],1,0,'C');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'REGISTRO HISTORICO: ',1,1,'L',true);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,utf8_decode('Fecha Adquisición: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(23,3,''.$fila['fec_adquis'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(42.8,3,'No. Orden compra o contrato: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(35,3,''.$fila['num_ord_comp'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'No. Factura: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(35,3,''.$fila['num_fact'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,utf8_decode('No. Acta Técnica: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(30,3,''.$fila['num_act_tec'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(48,3,utf8_decode('Fecha entrega/Instalación inicial: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(26.5,3,''.$fila['fec_ent_inst'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,3,utf8_decode('Fecha inicio operación: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(26.3,3,''.$fila['fec_inic_oper'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(42,3,'Fecha vencimiento garantia: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(20,3,''.$fila['fec_venc_gar'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,utf8_decode('Año de fabricación: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(12,3,''.$fila['anio_fabr'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(23,3,'Costo (Pesos): ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(30,3,''.$fila['costo'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,3,utf8_decode('Vida Util (Años): '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(13.8,3,''.$fila['vida_util'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,'Proveedor: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(40,3,''.$fila['proveed'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,3,'Tel. Proveedor: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(32,3,''.$fila['telf_proveed'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Email Proveedor: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(48.8,3,''.$fila['email_proveed'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(23,3,'Representante: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(37,3,''.$fila['represent'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(28,3,'Tel. Representante: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(29,3,''.$fila['telf_represent'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Email Representante: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(48.8,3,''.$fila['email_represent'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,'Fabricante: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(40,3,''.$fila['fabric'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,3,'Tel. Fabricante: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(32,3,''.$fila['telf_fabric'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(30,3,'Email Fabricante: ',1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(48.8,3,''.$fila['email_fabric'],1,0,'C');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'FORMA DE ADQUISICION: ',1,1,'L',true);
$pdf->SetFont('Arial','',5);
$pdf->Cell(0,3,''.$fila['rd_form_adquis'],1,0,'L');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'REGISTRO TECNICO DE INSTALACION Y FUNCIONAMIENTO: ',1,1,'L',true);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,3,utf8_decode('Fuente de Alimentación: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(23,3,''.$fila['fue_alim'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(28,3,utf8_decode('Tec. Predominante: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(23,3,''.$fila['tec_predom'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(23,3,utf8_decode('Voltaje Máximo: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(20,3,''.$fila['vol_max'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(23,3,utf8_decode('Voltaje Mínimo: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(20.8,3,''.$fila['vol_min'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,3,utf8_decode('Corriente Máxima: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(23,3,''.$fila['cor_max'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(28,3,utf8_decode('Corriente Mínima: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(23,3,''.$fila['cor_min'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(23,3,utf8_decode('Potencia: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(20,3,''.$fila['potencia'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(23,3,utf8_decode('Velocidad: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(20.8,3,''.$fila['velocidad'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,3,utf8_decode('Peso: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(23,3,''.$fila['peso'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(28,3,utf8_decode('Temperatura: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(23,3,''.$fila['temp'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(23,3,utf8_decode('Presión: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(20,3,''.$fila['presion'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(23,3,utf8_decode('Otro: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(20.8,3,''.$fila['reg_tec_otro'],1,0,'C');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'REGISTRO DE APOYO TECNICO: ',1,1,'L',true);
$pdf->Cell(0,3,'No. de Manuales',1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(37,3,utf8_decode('Operación: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(28,3,''.$fila['operacion'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(37,3,utf8_decode('Mantenimiento: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(28,3,''.$fila['mantenimiento'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(37,3,utf8_decode('Partes: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(28.8,3,''.$fila['partes'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(0,3,'No. de Planos',1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(18,3,utf8_decode('Eléctricos: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(22,3,''.$fila['electricos'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,utf8_decode('Electrónicos: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(22,3,''.$fila['electronicos'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(18,3,utf8_decode('Hidráulicos: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(19,3,''.$fila['hidraulicos'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(19,3,utf8_decode('Neumáticos: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(19,3,''.$fila['neumaticos'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(18,3,utf8_decode('Mecánicos: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(20.8,3,''.$fila['mecanicos'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(0,3,utf8_decode('Clasificación del Riesgo'),1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,utf8_decode('Clase I: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(29,3,''.$fila['clase_i'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,utf8_decode('Clase IIA: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(29,3,''.$fila['clase_iia'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,utf8_decode('Clase IIB: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(29,3,''.$fila['clase_iib'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,utf8_decode('Clase III: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(28.8,3,''.$fila['clase_iii'],1,0,'C');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'ACCESORIOS: ',1,1,'L',true);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,utf8_decode('Nombre: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(50,3,''.$fila['acce_nom1'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(100.8,3,''.$fila['acce_obs1'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,utf8_decode('Nombre: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(50,3,''.$fila['acce_nom2'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(100.8,3,''.$fila['acce_obs2'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,utf8_decode('Nombre: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(50,3,''.$fila['acce_nom3'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(100.8,3,''.$fila['acce_obs3'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,utf8_decode('Nombre: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(50,3,''.$fila['acce_nom4'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(100.8,3,''.$fila['acce_obs4'],1,1,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(20,3,utf8_decode('Nombre: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(50,3,''.$fila['acce_nom5'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(100.8,3,''.$fila['acce_obs5'],1,0,'C');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'MANTENIMIENTO: ',1,1,'L',true);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(46,3,utf8_decode('Periodicidad del Mantenimiento: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(24,3,''.$fila['per_mant'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(37,3,utf8_decode('¿Requiere Calibración?: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(22,3,''.$fila['req_calib'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(40,3,utf8_decode('Periodicidad de Calibración: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(26.8,3,''.$fila['per_calib'],1,0,'C');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'LISTA DE CHEQUEO DE DOCUMENTOS, SOPORTES, ANEXOS A LA HOJA DE VIDA: ',1,1,'L',true);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Copia Registro Sanitario: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_cop_reg_san'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_cop_reg_san'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Copia permiso de comercialización: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_cop_perm_comerc'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_cop_perm_comerc'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Copia registro importación o declaración: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_cop_reg_imp'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_cop_reg_imp'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Copia factura: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_cop_fact'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_cop_fact'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Copia de ingreso a almacén o activos fijos: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_cop_ing_alm'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_cop_ing_alm'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Acta de entrega del proveedor: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_act_ent'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_act_ent'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Manual usuario-servicio español y original: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_man_usu'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_man_usu'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Cronograma mantenimiento tiempo garantia: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_cron_mant'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_cron_mant'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Guía rápida de operación: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_guia_rap'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_guia_rap'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Copia de acta técnica del HUDN: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_cop_act_tec'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_cop_act_tec'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Estimativo costo accesorios y consumibles: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_est_cost_acces'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_est_cost_acces'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Carta de garantía: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_car_garant'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_car_garant'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Soporte técnico por mínimo 5 años: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_sop_tec'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_sop_tec'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Capacitaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_capacit'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_capacit'],1,1,'C');

$pdf->SetFont('Arial','B',7);
$pdf->Cell(55,3,utf8_decode('Calibración: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(17,3,''.$fila['rd_calib'],1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(21,3,utf8_decode('Observaciones: '),1);
$pdf->SetFont('Arial','',5);
$pdf->Cell(102.8,3,''.$fila['obs_calib'],1,0,'C');

$pdf->Cell(0,7,'',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(0,3,'USO: ',1,1,'L',true);
$pdf->SetFont('Arial','',5);
$pdf->Cell(0,3,''.$fila['rd_uso'],1,0,'L');

$pdf->Cell(0,15,'',0,1);

$pdf->SetFont('Arial','B',6);
$pdf->Cell(0,3,'Derechos Reservados HOSDENAR - 2016',0,0,'C');

$pdf->Output();

?>