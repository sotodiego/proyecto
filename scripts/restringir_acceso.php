<?php session_start(); 
if(!isset($_SESSION['nickusu']) || !isset($_SESSION['idusu']) || !isset($_SESSION['nivelusu'])){
	header("location:../login_index.php");

}
?>
