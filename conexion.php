<?php 
$servidor="localhost";
$basedatos="vacunas";
$usuariobd="root";
$clave="root";
$conexion= mysql_connect($servidor,$usuariobd,$clave) or die(mysql_error());
mysql_select_db($basedatos);

?>
