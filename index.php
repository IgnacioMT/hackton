<?php ob_start(); ?>
<?php include('php_scripts/sesion.php'); ?>
<?php include('php_scripts/funciones.php'); ?>
<?php include("php_scripts/coneccion.php");  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hackathon</title>

	<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
	
	<!--script type="text/javascript"> 
	  $(window).load(function(){$('#cr-container').crotator(); document.getElementById("an").style.top = (pixelesDisponiblesY()-80) + 'px'; }); 
	  $(window).resize(function(){document.getElementById("an").style.top = (pixelesDisponiblesY()-80) + 'px'; }); 
      <a href="#" onclick="$('#caja').slideUp();">SlideUp</a>
    </script-->
    <script>
	   function close_popBox() { /*$("#popBox_content").html('');*/ $("#popBoxBG").fadeOut(500); $("#popBox").fadeOut(500); }
	   function popBox(w,h){
			var posY = $(window).scrollTop()+20;
			var posX = Math.floor((pixelesDisponiblesX() - w)/2)-10; 
			if(posY<30) posY = 30;
			if(posX<30) posX = 30;
			document.getElementById("popBox").style.width = w + 'px';
			$('#popBox').animate({'top':posY+'px', 'left':posX+'px'});
	   }
	   
	  function openBox(url)
	   { 
		  var url2 = url + '&r=' + Math.random()*99999;
		  document.getElementById('ifr').src = '';
		  document.getElementById('ifr').src = url2;
		  $("#popBoxBG").fadeIn(500);
		  $("#popBox").fadeIn(500, popBox(1024,700) );
	   }
	</script>
    
    <link rel="stylesheet" type="text/css" href="css/style.css" />
   
</head>
    
<body>
   <center>
       <div class="cajaPrincipal" >
              
              <img src="images/logo2.png" style="float:left; margin:-46px 0 0 -38px;" />
              
              <?php include("php_scripts/formulario_login.php"); ?>
              
              <div style="clear:both; margin-top:30px; height:250px; width:950px; margin:20px 0 10px 0; ">
              		<img src="images/comofun.png" />
              </div>
              
              <!----------Filtros----------> 
              
              <form action="analizar.php" method="post" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
               
				  <?php include("php_scripts/filtro_caja1.php"); ?>
                  <?php include("php_scripts/filtro_caja2.php"); ?>
                  <?php include("php_scripts/filtro_caja3.php"); ?>
              
              </form>
              <!--------Fin-Filtros---------> 
              
              
              <div style="clear:both;"></div>
              
              <script>					 
				  function crecer(ide)
				  { 
				  	   var id = '#'+ide;
					   var h = document.getElementById(ide).scrollHeight+100;
					   $(id).clearQueue();
					   $(id).animate({'height': h+'px' },400);
				  }
				  function decrecer(ide)
				  { 
				  	  var id = '#'+ide;
					  var h = document.getElementById(ide).scrollHeight-100;
					  $(id).clearQueue();
					  $(id).animate({'height': h+'px' },400); 
				  }
			  </script>
              
             <!----aqui-era-la-busqueda---------------->
              
              
            <div id="popBoxBG" class="anularBg" ></div>
            <div id="popBox" class="popBox" >
                <div onclick="close_popBox()" class="cerrarPopBox" ></div>
                <div id="popBox_content" style="margin:10px; overflow:hidden;">
                	<iframe id="ifr" src="" frameborder="0" style="border:0; border-radius:10px; width:1008px; float:left; height:675px;" scrolling="no" ></iframe>
                    <div style="clear:both;"></div>
                </div>
            </div>
            <img src="images/separador.png" style="width:1024px; float:left; clear:both;" />
              
              <!----------------------------------------------------------------------------------------------------------------------->
              
             <div style="clear:both; float:right; text-align:right; font-size:12px; color:#555; padding:30px;">
                Blackout<br />
                Hackton 2012
             </div>
             
             <div style="clear:both;"></div>
                    
        </div> <!--Fin del contenedor 1024w-->
        
        <div style="color:#555; font-size:12px; margin-top:20px; margin-bottom:100px;">
        	Resoluci&oacute;n m&iacute;nima recomendada 1024px x 768px
        </div>
        
        
        
   </center>
</body>

</html>
<?php
  //if($_SESSION["url"]!=get_url()) $_SESSION["url"] = get_url();
  if(isset($connection)) 
  { 
     mysql_close($connection);
  }
?>
<?php ob_end_flush(); ?>