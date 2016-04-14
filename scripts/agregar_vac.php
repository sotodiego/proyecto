<?php
require("../conexion.php");require ("restringir_acceso.php");
$codigo_vac = $_POST['codigo_vac'];
$nombre_vac = $_POST['nombre_vac'];
$abreviatura_vac = $_POST['abreviatura_vac'];
$frecuencia_vac = $_POST['frecuencia_vac'];
$cantidad_ref = $_POST['cantidad_ref'];
$observacion_vac = $_POST['observacion_vac'];


$guardar = mysql_query("INSERT INTO vacunas VALUES(
    '',
'$codigo_vac',
'$nombre_vac',
'$abreviatura_vac',
'$frecuencia_vac',
'$cantidad_ref',
'$observacion_vac'
)") or die(mysql_error());

mysql_query("INSERT INTO entrada_vacunas VALUES('','0','')") or die(mysql_error());
header("location:../Form/Vacunas/listado_vacunas.php?msg=1");
