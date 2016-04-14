<?php

require("../conexion.php");require ("restringir_acceso.php");
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$usuario = $_POST['usuario'];
$cargo = $_POST['cargo'];
$nivel = $_POST['nivel'];
$clave = $_POST['clave'];
$email = $_POST['email'];
$idusu = $_GET['idusu'];
$guardar = mysql_query("UPDATE usuarios SET
 
nombre_usu='$nombre',
apellido_usu='$apellido',
telefono_usu='$telefono',
nick_usu='$usuario',
cargo_usu='$cargo',
nivel_usu='$nivel',
email_usu='$email',
clave_usu='$clave'

WHERE id_usuario='$idusu'") or die(mysql_error());
header("location:../Form/Usuarios/listado_usuarios.php?idmsg=1");
?>