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
              
              <div style="float:right; background-image: url(images/bglineas2.png); background-position:-10px -100px; background-repeat:no-repeat; text-align:left; background-color:#222; padding:20px 20px 20px 30px; margin-bottom:40px; color:#999; position:relative; z-index:9999;">
                    
					<?php if( !isset($_SESSION["id_usuario"]) ) { ?>		
						
                        <form action="php_scripts/login.php" method="post">
                        	
                            <div style="min-width:153px; height:40px; float:left; font-size:12px;" class="verde" > 
                            	<span style="opacity:0.7;"> Correo electr&oacute;nico </span><br />
                                <input id="logIn" type="text" name="login" style="width:145px; padding-left:3px; margin-right:5px; " />
                                
								<script>
									  //onfocus="busqCrecer()" onblur="busqDecrecer()"
                                      function busqCrecer(){ $('#logIn').animate({ 'width' : '180px' }); }
                                      function busqDecrecer(){ $('#logIn').animate({ 'width' : '145px' }); }												
                                </script>
                            </div> 
                            
                            <div style="min-width:145px; height:40px;  float:left; font-size:12px;" class="verde"> 
                            	<span style="opacity:0.7;">Contrase&ntilde;a</span> <br />
                                <input type="password" name="pass" style="width:145px; padding-left:3px; margin-right:5px;" />
                            </div>
                            
                            <div style="width:145px; height:40px;  float:left; font-size:12px;">
                            	<span style="opacity:0.7;">&nbsp;</span> <br />
                                <input type="submit" style="height:24px; font-family:Georgia; font-style:italic; margin-top:1px; cursor:pointer; border:#666 1px solid;" value="Iniciar sesi&oacute;n" />
                            </div>
                            
                        </form>
                        <br />
                        <a style="line-height:24px;" onclick="$('#registro').slideToggle(); $('#recup').slideUp();" > Registrarse </a> |
                        <a style="line-height:24px;" onclick="$('#recup').slideToggle(); $('#registro').slideUp();" > Olvido su contrase&ntilde;a? </a>
                        
                        <div id="registro" style="display:none; padding:10px 35px 10px 35px; margin-left:-30px; background-color:#eee; box-shadow:#666 1px 1px 8px; position:absolute; width:205px; height:290px; ">
                        	
                                <div id="reg" >
                                    <div style="height:20px;"></div>
                                    <span class="formTxt"> Nombre(s) </span>
                                    <input id="regnombre" type="text" name="regnombre" style="width:205px; border:#666 1px solid;  padding-left:3px;" />
                                    <span class="formTxt"> Apellidos </span>
                                    <input id="regapellido" type="text" name="regapellido" style="width:205px; border:#666 1px solid;  padding-left:3px;" />
                                    <span class="formTxt"> Correo Elect&oacute;nico </span>
                                    <input id="regcorreo" type="text" name="regcorreo" style="width:205px; border:#666 1px solid;  padding-left:3px;" />
                                    
                                    <span class="formTxt"> Contrase&ntilde;a </span>
                                    <input id="regpass1" type="password" name="regpass1" style="width:205px; border:#666 1px solid;  padding-left:3px;" />
                                    <span class="formTxt"> Repita su contrase&ntilde;a </span>
                                    <input id="regpass2" type="password" name="regpass2" style="width:205px; border:#666 1px solid;  padding-left:3px;" />
                                    
                                    <input type="button" onclick="registrarUsuario()" style="height:24px; cursor:pointer; margin:15px 0 0 0px; border:#666 1px solid;" value="Registrarse ahora!" />
                                    
                                    <script language="javascript"> 
										  function registrarUsuario()
										  {
											  var url = "registro.php?nom="+encodeURI($('#regnombre').val())+
											  			"&ap="+encodeURI($('#regapellido').val())+
														"&cor="+encodeURI($('#regcorreo').val())+
														"&pass1="+encodeURI($('#regpass1').val())+
														"&pass2="+encodeURI($('#regpass1').val())+
														"&r="+Math.random()*99999
											  
											  $("#reg").slideUp(500, function(){ $("#reg").load(url); $("#reg").slideDown(500); } );
											  //$(window).load(function(){ $("#reg").load(url); });
										  }
									</script>
                                    
                                    <input type="reset" onclick="$('#registro').slideUp();" style="height:24px; cursor:pointer; margin:15px 0 0 0px; border:#666 1px solid;" value="Cancelar" />
                                </div>
                                
                        </div>
                        
                        <div id="recup" style="display:none; padding:10px 35px 10px 35px; margin-left:80px; background-color:#eee; box-shadow:#666 1px 1px 8px; position:absolute; width:205px; height:220px; ">
                        	
                                <div style="height:20px;"></div>
                                
                                <span class="formTxt" style="color:#222;">Se le enviar&aacute;n instantaneamente las instrucciones a su correo electronico para recuperar el acceso a su cuenta.</span>
                                
                                <div style="height:10px;"></div>
                                <span class="formTxt">Correo Elect&oacute;nico</span>
                                <input type="text" name="regcorreo" style="width:205px; border:#666 1px solid;  padding-left:3px;" />
                                
                                <input type="button" onclick="recuperar();" style="height:24px; cursor:pointer; margin:10px 0 0 0px; border:#666 1px solid;" value="Recuperar contrase&ntilde;a" />
                                
                                <script language="javascript"> 
                                	function recuperar()
									{
										alert('En pocos segundos recibira las instrucciones de recuperacion, porfavor revise su correo electronico.');
										$('#recup').slideUp();
									}
                                </script>
                                
                                <input type="reset" onclick="$('#recup').slideUp();" style="height:24px; cursor:pointer; margin:10px 0 0 0px; border:#666 1px solid;" value="Cancelar" />
                            
                        </div>
                        
                    <?php if( isset($_GET["e"]) ) { ?> 
                    	
                        <br />
                    	<span class="georgiaIt14" style="color:#900; line-height:24px;"> Nombre de usuario y/o contrase&ntilde;a incorrectos. </span>
                    
                    <?php }} else { ?> 
                    	
                        <div style="margin:0 50px 0 0;">
                            <span class="verdana12">Bienvenido,</span> <span class="georgiaIt14" style="color:#999;"> <?= $_SESSION["nombre"]." ".$_SESSION["apellidos"] ?> </span>
                            <br /><a class="verdana12" href="php_scripts/logout.php"> Cerrar Sesi&oacute;n </a>
                        </div>
                    
					<?php } ?>
                        
              </div>
              
              <div style="clear:both; margin-top:30px; height:250px; width:950px; margin:20px 0 10px 0; ">
              		<img src="images/comofun.png" />
              </div>
              
              <!----------Filtros----------> 
              
              <form action="analizar.php" method="post" >
               
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
                </div>
            </div>
              
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