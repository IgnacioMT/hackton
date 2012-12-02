<?php ob_start(); ?>
<?php include("funciones.php"); ?>
<?php include("coneccion.php");  ?>
<?php include("sesion.php");  ?>
<?php 
	   header("Content-Type: text/html; charset=iso-8859-1");
	   $idm = strip_tags($_GET["idm"]);
	   
	   if(!is_numeric($idm))
	   { 
	   	  if(isset($connection)){ mysql_close($connection); } 
		  echo '<script> alert("'.$idm.', no es un id valido!"); </script>';
		  exit; 
	   }
	   
	   $err = 0;
	   if(!empty($idm))
	   {
		  $sql = "SELECT * FROM maderas WHERE id_madera = ".$val." LIMIT 1";
		  $consulta = @mysql_query($sql);
		  $row = mysql_fetch_array($consulta);
		  $_SESSION["idm"] = array_diff($_SESSION["idm"], array($idm));
	   }
	   
	   $items = "";
	   foreach($_SESSION["idm"] as $val)
	   { 
		  $sql = "SELECT * FROM maderas WHERE id_madera = ".$val." LIMIT 1";
		  $consulta = @mysql_query($sql);
		  validar_consulta($consulta);
		  $row = mysql_fetch_array($consulta);
		  $items .= $row["nombre"].', '; 
	   }
	   $items = substr($items,0,-2); //Borrar el ultimo espacio y coma
	   //echo '<script> alert("Ahora en la lista de compras: '.$items.'"); </script>';
	   
			
?>
<?php if(isset($connection)){ mysql_close($connection); } ?>
<?php ob_end_flush(); ?>