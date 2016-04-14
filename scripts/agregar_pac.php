<?php
require("../conexion.php");require ("restringir_acceso.php");
$nombre_pac = $_POST['nombre_pac'];
$apellido_pac = $_POST['apellido_pac'];
$cedula_pac = $_POST['cedula_pac'];
$sexo_pac = $_POST['sexo_pac'];
$fecha_pac = $_POST['fecha_pac'];
$edad_pac = $_POST['edad_pac'];
$telefono_pac = $_POST['telefono_pac'];
$direccion_pac = $_POST['direccion_pac'];
$observacion_pac = $_POST['observacion_pac'];

$guardar = mysql_query("INSERT INTO pacientes VALUES(
 '',
'$nombre_pac',
'$apellido_pac',
'$cedula_pac',
'$sexo_pac',
'$fecha_pac',
'$edad_pac',
'$telefono_pac',
'$direccion_pac',
'$observacion_pac'
)") or die(mysql_error());
header("location:../Form/Pacientes/listado_pacientes.php?idmsg=1");
