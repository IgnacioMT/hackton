<?php ob_start(); ?>
<?php include("php_scripts/funciones.php"); ?>
<?php include("php_scripts/coneccion.php");  ?>
<?php include("php_scripts/sesion.php");  ?>
<?php 
	   $nombre = strip_tags($_GET["nom"]);
	   $apellido = strip_tags($_GET["ap"]);
	   $correo = strip_tags($_GET["cor"]);
	   $pass1 = strip_tags($_GET["pass1"]);
	   $pass2 = strip_tags($_GET["pass2"]);
	   
	   echo '<div class="formTxt" style="color:#222; padding:20px 0 0 0px; ">';
	   
	   date_default_timezone_set("America/La_Paz");
	   $fecha = date("Y-m-d H:i:s");
	   
	   $sql = "INSERT INTO usuarios( nombre, apellidos, correo, pass, fecha_registro, estado ) VALUES ( \"".$nombre."\", \"".$apellido."\", \"".$correo."\", \"".$pass1."\", \"".$fecha."\", 1 )";
	   $consulta = mysql_query($sql);
	   validar_consulta($consulta);
	   
	   if($consulta) 
	   {
		   echo "<span class=\"formTxt\" >".$nombre."</span>, su registro ha sido completado exitosamente!<br /><br />";
		   echo "Ahora ya puede acceder al sistema utilizando los datos registrados:<br /><br />";
		   echo "Nombre completo:<br />";
		   echo "&nbsp;&nbsp;&nbsp;&nbsp; <span class=\"formTxt\" >".$nombre." ".$apellido."</span>";
		   echo "<br />Correo electr&oacute;nico: <br /> &nbsp;&nbsp;&nbsp;&nbsp; <span class=\"formTxt\" >".$correo."</span>";
		   
		   echo '<br /><br /><input type="button" onclick="$(\'#registro\').slideUp();" style="height:24px; cursor:pointer; margin:15px 0 0 0px; border:#444 1px solid;" value="Finalizar registro" />';
	   }
	   else echo "error al registrarse!";
	   
	   echo '</div>';
	   
?>
<?php
  if(isset($connection)) 
  { 
     mysql_close($connection);
  }
?>
<?php ob_end_flush(); ?>