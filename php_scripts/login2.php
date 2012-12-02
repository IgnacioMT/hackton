<? ob_start(); ?>
<? include("funciones.php"); ?>
<? include("coneccion.php");  ?>
<? include("sesion.php");  ?>
<? 
	   $login = strip_tags($_GET["login"]);
	   $pass = strip_tags($_GET["pass"]);
	   
	   $sql = "SELECT id_usr, name, email,fb_id FROM usr WHERE email = \"".$login."\" AND pass = \"".$pass."\" AND (validated = 1 OR validated = 2)  LIMIT 1";
	   $consulta = @mysql_query($sql);
	   $row = @mysql_fetch_array($consulta);
	   if(empty($row)) echo "<script>alert('Incorrect login or password, please try again.');</script>";
	   else
	   {
			$_SESSION["id"] = $row["id_usr"];
			$_SESSION["fb_id"] = $row["fb_id"];
			$_SESSION["name"] = $row["name"];
			$_SESSION["email"] = $row["email"];
	   }
	   exit;
?>
<?
  if(isset($connection)) 
  { 
     mysql_close($connection);
  }
?>
<? ob_end_flush(); ?>