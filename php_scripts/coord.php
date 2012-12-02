<?php ob_start(); ?>
<?php include("funciones.php"); ?>
<?php include("coneccion.php");  ?>
<?php include("sesion.php");  ?>
<?php 
	   header("Content-Type: text/html; charset=iso-8859-1");
	   $_SESSION["lat"] = strip_tags($_GET["lat"]);
	   $_SESSION["lng"] = strip_tags($_GET["lng"]);	   
?>
<?php if(isset($connection)){ mysql_close($connection); } ?>
<?php ob_end_flush(); ?>