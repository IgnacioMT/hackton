<? ob_start(); ?>
<? include('php_scripts/sesion.php'); ?>
<? include('php_scripts/funciones.php'); ?>
<? include("php_scripts/coneccion.php");  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hackton</title>
    
	<script type="text/javascript" src="js/jquery.min.js"></script>
	
	<!--script type="text/javascript"> 
	  $(window).load(function(){$('#cr-container').crotator(); document.getElementById("an").style.top = (pixelesDisponiblesY()-80) + 'px'; }); 
	  $(window).resize(function(){document.getElementById("an").style.top = (pixelesDisponiblesY()-80) + 'px'; }); 
    </script-->
    
    <link rel="stylesheet" type="text/css" href="css/style.css" />
   
</head>
    
<body style="font-family:Arial, Helvetica, sans-serif; overflow-x:hidden;" class="bgindex">
   <center>
       <div style="width:1024px; border:#666 1px dashed;" >
              
              <div id="contenido" style="width:100%; height:100%;">
                  <script language="javascript"> $("#contenido").load("contenido1.php?r="+Math.random()*99999); </script>
              </div>
              
              <h1> contenido de prueba </h1>
             
        </div> <!--Fin del contenedor 1024w-->
   </center>
</body>
</html>
<?
  if($_SESSION["url"]!=get_url()) $_SESSION["url"] = get_url();
  if(isset($connection)) 
  { 
     mysql_close($connection);
  }
?>
<? ob_end_flush(); ?>