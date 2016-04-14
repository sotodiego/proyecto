<?php

require("../conexion.php");require ("restringir_acceso.php");
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$usuario = $_POST['usuario'];
$cargo = $_POST['cargo'];
$nivel = $_POST['nivel'];
$clave = $_POST['clave'];
$email= $_POST['email'];

$guardar = mysql_query("INSERT INTO usuarios VALUES(
    '',
'$nombre',
'$apellido',
'$telefono',
'$usuario',
'$cargo',
'$nivel',
'$email',
'$clave'
)") or die(mysql_error());
header("location:../Form/Usuarios/listado_usuarios.php?idmsg=1");
?>