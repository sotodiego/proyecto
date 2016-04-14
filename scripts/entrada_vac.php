<?php

require("../conexion.php");require ("restringir_acceso.php");
$cantidad_entrada = $_POST['cantidad_entrada'];
$fecha_entrada = $_POST['fecha_entrada'];
$id_vacuna = $_POST['id_vacuna'];


$guardar = mysql_query("INSERT INTO entrada_vacunas VALUES(
 '',
'$cantidad_entrada',
'$fecha_entrada',
'$id_vacuna'
)") or die(mysql_error());
header("location:../Form/Pacientes/listado_pacientes.php");
