<?php
require("../conexion.php");require ("restringir_acceso.php");
include ("funciones.php");
$nombre_bebe = $_POST['nombre_bebe'];
$apellido_bebe = $_POST['apellido_bebe'];
$partida_bebe = $_POST['partida_bebe'];
$sexo_bebe = $_POST['sexo_bebe'];
$fecha_bebe = $_POST['fecha_bebe'];
$edad_bebe = $_POST['edad_bebe'];
$meses_bebe = $_POST['meses_bebe'];
$id_paciente=$_GET['id_paciente'];

$guardar = mysql_query("INSERT INTO registro_bebes VALUES(
 '',
'$nombre_bebe',
'$apellido_bebe',
'$partida_bebe',
'$sexo_bebe',
'$fecha_bebe',
'$edad_bebe',
'$meses_bebe',
'$id_paciente'
)") or die(mysql_error());
header("location:../Form/Bebes/listado_bebes.php?idmsg=1");
