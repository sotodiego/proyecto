<?php 
require("../conexion.php");require ("restringir_acceso.php");
$id_paciente=$_GET['id_paciente'];
$eliminar=mysql_query("DELETE FROM pacientes WHERE id_paciente='$id_paciente'") or die(mysql_error());
header("location:../Form/Pacientes/listado_pacientes.php");

?>