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
	   	  foreach($_SESSION["idm"] as $val)
		  { 
		  	 if($val==$idm)
			 { 
			 	//Este id ya esta en el carrito
			 	$sql = "SELECT * FROM maderas WHERE id_madera = ".$idm." LIMIT 1";
				$consulta = @mysql_query($sql);
				validar_consulta($consulta);
				$row = mysql_fetch_array($consulta);
				echo '<script> alert("'.$row["nombre"].', ya esta en la lista de compras!"); </script>';
				$err = 1;
				break;
			 }
		  }
		  //si no hay error, no esta incluido en el carrito entonces incluir
		  if($err==0) $_SESSION["idm"][] = $idm;
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
	   echo '<script> alert("Ahora en la lista de compras: '.$items.'"); </script>';
	   
			
?>
<?php if(isset($connection)){ mysql_close($connection); } ?>
<?php ob_end_flush(); ?>