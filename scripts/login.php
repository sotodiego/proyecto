<?php

session_start();
if (isset($_SESSION['idusu']) || isset($_SESSION['nickusu'])) {//para saber si existe la sesion
    header("location:../login_index.php");
    exit();
}
//conexion de la base de datos
require("../conexion.php");
$nick = $_POST['nick'];
$clave = $_POST['clave'];
$consulta_login = mysql_query("SELECT * FROM usuarios WHERE nick_usu='$nick' AND clave_usu='$clave'") or die(mysql_error());
// para preguntar si existe datos

$fila = mysql_fetch_array($consulta_login); //si exite datos en la consulta de la base de datos
if (mysql_num_rows($consulta_login) > 0) {
    $_SESSION['idusu'] = $fila['id_usuario'];
    $_SESSION['nickusu'] = $fila['nick_usu'];
    $_SESSION['nivelusu'] = $fila['nivel_usu'];
    header("location:../index.php");
} else {
    ?>
    <script>
        alert("Error con el nick o password");
        location.href = "../login_index.php";
    </script>
    <?php

}
?>