<?php
require("../conexion.php");require ("restringir_acceso.php");
$fecha = date("Y-m-d");
$id_vacuna=$_GET['id_vacuna'];
$id_paciente = $_GET['id_paciente'];
$guardar = mysql_query("UPDATE refuerzo_vacunas SET
 vacunado='1'
 WHERE id_paciente='$id_paciente' AND id_vacuna='$id_vacuna' AND fecha_refuerzo='$fecha'") or die(mysql_error());
header("location:../index.php?idmsg=1");
