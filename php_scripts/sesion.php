<?php ob_start() ?>
<?php session_start();
   function restringir_acceso()
   {
	   if (!isset($_SESSION["id"]))
	   {
		   $pagina = "index.php";
		   header("Location: {$pagina}");
	   }
   }   
?>
<?php ob_end_flush() ?>