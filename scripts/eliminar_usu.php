<?php 
require("../conexion.php");require ("restringir_acceso.php");
$idusu=$_GET['idusu'];
$eliminar=mysql_query("DELETE FROM usuarios WHERE id_usuario='$idusu'") or die(mysql_error());
header("location:../Form/Usuarios/listado_usuarios.php");

?>