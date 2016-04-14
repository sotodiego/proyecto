<?php 
foreach($_GET as $nombre_campo => $valor){
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
   eval($asignacion);
} 

foreach($_POST as $nombre_campo2 => $valor2){
   $asignacion2 = "\$" . $nombre_campo2 . "='" . $valor2 . "';";
   eval($asignacion2);
} 
?>