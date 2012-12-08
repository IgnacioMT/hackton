<?php ob_start(); ?>
<?php include("funciones.php"); ?>
<?php include("coneccion.php");  ?>
<?php include("sesion.php");  ?>
<?php 
	   header("Content-Type: text/html; charset=iso-8859-1");
	   $_SESSION["lat"] = $_GET["lat"];
	   $_SESSION["lng"] = $_GET["lng"];
	   /*echo "<script> alert('Lat: ".$_SESSION["lat"]." Lng: ".$_SESSION["lng"]."'); </script>";	   */
?>
<?php if(isset($connection)){ mysql_close($connection); } ?>
<?php ob_end_flush(); ?>