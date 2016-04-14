<?php 
require("../conexion.php");require ("restringir_acceso.php");
$idvac=$_GET['idvac'];
$eliminar=mysql_query("DELETE FROM vacunas WHERE id_vacuna='$idvac'") or die(mysql_error());
header("location:../Form/Vacunas/listado_vacunas.php");

?>