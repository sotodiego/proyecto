<?php

require("../conexion.php");require ("restringir_acceso.php");
$codigo_vac = $_POST['codigo_vac'];
$nombre_vac = $_POST['nombre_vac'];
$abreviatura_vac = $_POST['abreviatura_vac'];
$frecuencia_vac = $_POST['frecuencia_vac'];
$cantidad_ref = $_POST['cantidad_ref'];
$observacion_vac = $_POST['observacion_vac'];
$idvac = $_GET['idvac'];
$guardar = mysql_query("UPDATE vacunas SET
 codigo_vac='$codigo_vac',
nombre_vac='$nombre_vac',
abreviatura_vac='$abreviatura_vac',
frecuencia_vac='$frecuencia_vac',
cantidad_ref='$cantidad_ref',
observacion_vac='$observacion_vac'
 WHERE id_vacuna='$idvac'") or die(mysql_error());
header("location:../Form/Vacunas/listado_vacunas.php?idmsg=1");
