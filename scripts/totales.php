<?php

//require("../conexion.php");require ("restringir_acceso.php");
$total_vacunados = mysql_query("SELECT SUM(cantidad_salida) as total FROM salida_inventario") or die(mysql_error());
$fila1 = mysql_fetch_array($total_vacunados);


$total_vacunas=mysql_query("SELECT SUM(cantidad_entrada) as total_inventario FROM entrada_vacunas") or die(mysql_error());
$fila2 = mysql_fetch_array($total_vacunas);


$total_pacientes=mysql_query("SELECT COUNT(id_paciente) as total_pac FROM pacientes") or die(mysql_error());
$fila3 = mysql_fetch_array($total_pacientes);

$total_bebes=mysql_query("SELECT COUNT(id_bebe) as total_bebe FROM registro_bebes") or die(mysql_error());
$fila4 = mysql_fetch_array($total_bebes);

