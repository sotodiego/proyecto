<?php

require("../conexion.php");require ("restringir_acceso.php");
$cantidad_nueva = $_POST['cantidad_entrada'];
$fecha_entrada = $_POST['fecha_entrada'];
$id_vacuna = $_GET['idvac'];
// Traemos la cantidad actual
$consulta=  mysql_query("SELECT * FROM entrada_vacunas WHERE id_entrada='$id_vacuna'") or die(mysql_error());
$fila=  mysql_fetch_array($consulta);
//Sumamos la cantidad actual y la nueva
$total=$fila['cantidad_entrada']+$cantidad_nueva;
//Guardamos en el historial de entrada
$historial= mysql_query("INSERT INTO historial_entrada VALUES('','$cantidad_nueva','$fecha_entrada','$id_vacuna')") or die(mysql_error());
//Editamos la cantidad actual con la suma de las canidades
$editar = mysql_query("UPDATE entrada_vacunas SET 
 
cantidad_entrada='$total',
fecha_entrada='$fecha_entrada'
WHERE id_entrada='$id_vacuna'
    
") or die(mysql_error());
header("location:../Form/Inventario/listado_cantidad.php?idmsg=1");
