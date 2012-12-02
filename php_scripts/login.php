<?php ob_start(); ?>
<?php include("funciones.php"); ?>
<?php include("coneccion.php");  ?>
<?php include("sesion.php");  ?>
<?php 
	   $login = strip_tags($_POST["login"]);
	   $pass = strip_tags($_POST["pass"]);
	   
	   echo "Usuario: ".$login."<br />";
	   echo "Pass: ".$pass."<br />";
	   
	   $sql = "SELECT id_usuario, nombre, apellidos, correo FROM usuarios WHERE correo = '".$login."' AND pass = '".$pass."' LIMIT 1";
	   
	   $consulta = mysql_query($sql);
	   $row = mysql_fetch_array($consulta);
	   if(empty($row)) redireccionar_a("../?e=1");
	   else
	   {
			$_SESSION["id_usuario"] = $row["id_usuario"];
			$_SESSION["nombre"] = $row["nombre"];
			$_SESSION["apellidos"] = $row["apellidos"];
			$_SESSION["correo"] = $row["correo"];
			redireccionar_a('../');
	   }
	   exit;
?>
<?php
  if(isset($connection)) 
  { 
     mysql_close($connection);
  }
?>
<?php ob_end_flush(); ?>