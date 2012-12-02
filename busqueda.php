<?php ob_start(); ?>
<?php include('php_scripts/sesion.php'); ?>
<?php include('php_scripts/funciones.php'); ?>
<?php include("php_scripts/coneccion.php");  ?>
<?php header("Content-Type: text/html; charset=iso-8859-1"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Barraca Midea</title>
    
    

    <link rel="stylesheet" href="css/formalize/formalize.css" />
    <script src="css/formalize/js/jquery.formalize.js"></script>

	<script type="text/javascript" src="js/jquery.min.js"></script>
	
	<!--script type="text/javascript"> 
	  $(window).load(function(){$('#cr-container').crotator(); document.getElementById("an").style.top = (pixelesDisponiblesY()-80) + 'px'; }); 
	  $(window).resize(function(){document.getElementById("an").style.top = (pixelesDisponiblesY()-80) + 'px'; }); 
      <a href="#" onclick="$('#caja').slideUp();">SlideUp</a>
    </script-->
    
    <script type="text/javascript" src="galeria/scripts/swfobject/swfobject.js"></script>
    
    <link rel="stylesheet" type="text/css" href="css/style.css" />
   
</head>
    
<body style="font-family:Arial, Helvetica, sans-serif; overflow-x:hidden; background-image:url(images/madera.jpg);" class="bgindex">
   <center>
       <div class="cajaTransp" style="width:1024px; margin-top:120px; min-height:798px;" >
              
              <div style="float:left; margin:-65px 0 0 -60px; ">
              		<a href="index.php"> <img src="images/logo3.png" width="238" height="175"  /></a>
              </div>
              
              <div style="float:right; text-align:left; margin:25px 10px 25px 25px; color:#666; position:relative; z-index:9999;">
              		
					<?php if( !isset($_SESSION["id_usr"]) ) { ?>		
						
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
                                <input type="submit" style="height:24px; cursor:pointer; border:#444 1px solid;" value="Iniciar sesi&oacute;n" />
                            </div>
                            
                        </form>
                        <br />
                        <a style="line-height:24px;" onclick="$('#registro').slideToggle(); $('#recup').slideUp();" > Registrarse </a> |
                        <a style="line-height:24px;" onclick="$('#recup').slideToggle(); $('#registro').slideUp();" > Olvido su contrase&ntilde;a? </a>
                        
                        <div id="registro" style="display:none; padding:35px; margin-left:-30px; background-image:url(images/bgmenu_registro.png); background-position:-10px 0 0 0; position:absolute; width:205px; height:290px; ">
                        	
                                <div id="reg" >
                                    <div style="height:20px;"></div>
                                    <span class="formTxt">Nombre(s) </span>
                                    <input id="regnombre" type="text" name="regnombre" style="width:205px; border:#444 1px solid;  padding-left:3px;" />
                                    <span class="formTxt">Apellidos</span>
                                    <input id="regapellido" type="text" name="regapellido" style="width:205px; border:#444 1px solid;  padding-left:3px;" />
                                    <span class="formTxt">Correo Elect&oacute;nico</span>
                                    <input id="regcorreo" type="text" name="regcorreo" style="width:205px; border:#444 1px solid;  padding-left:3px;" />
                                    
                                    <span class="formTxt">Contrase&ntilde;a</span>
                                    <input id="regpass1" type="password" name="regpass1" style="width:205px; border:#444 1px solid;  padding-left:3px;" />
                                    <span class="formTxt">Repita su contrase&ntilde;a</span>
                                    <input id="regpass2" type="password" name="regpass2" style="width:205px; border:#444 1px solid;  padding-left:3px;" />
                                    
                                    <input type="button" onclick="registrarUsuario()" style="height:24px; cursor:pointer; margin:15px 0 0 0px; border:#444 1px solid;" value="Registrarse ahora!" />
                                    
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
                                    
                                    <input type="reset" onclick="$('#registro').slideUp();" style="height:24px; cursor:pointer; margin:15px 0 0 0px; border:#444 1px solid;" value="Cancelar" />
                                </div>
                                
                        </div>
                        
                        <div id="recup" style="display:none; padding:35px; margin-left:80px; background-image:url(images/bgmenu_recup.png); background-position:-10px 0 0 0; position:absolute; width:205px; height:220px; ">
                        	
                                <div style="height:20px;"></div>
                                
                                <span class="formTxt" style="color:#222;">Se le enviar&aacute;n instantaneamente las instrucciones a su correo electronico para recuperar el acceso a su cuenta.</span>
                                
                                <div style="height:10px;"></div>
                                <span class="formTxt">Correo Elect&oacute;nico</span>
                                <input type="text" name="regcorreo" style="width:205px; border:#444 1px solid;  padding-left:3px;" />
                                
                                <input type="button" onclick="recuperar();" style="height:24px; cursor:pointer; margin:10px 0 0 0px; border:#444 1px solid;" value="Recuperar contrase&ntilde;a" />
                                
                                <script language="javascript"> 
                                	function recuperar()
									{
										alert('En pocos segundos recibira las instrucciones de recuperacion, porfavor revise su correo electronico.');
										$('#recup').slideUp();
									}
                                </script>
                                
                                <input type="reset" onclick="$('#recup').slideUp();" style="height:24px; cursor:pointer; margin:10px 0 0 0px; border:#444 1px solid;" value="Cancelar" />
                            
                        </div>
                        
                    <?php if( isset($_GET["e"]) ) { ?> 
                    	
                        <br />
                    	<span class="georgiaIt14" style="color:#900; line-height:24px;"> Nombre de usuario y/o contrase&ntilde;a incorrectos. </span>
                    
                    <?php }} else { ?> 
                    	
                        <div style="margin:0 50px 0 0;">
                        	<span class="verdana12">Bienvenido,</span> <span class="georgiaIt14" style="color:#999;"> <?= $_SESSION["nombre"]." ".$_SESSION["apellido"] ?> </span>
							<br /><a class="verdana12" href="php_scripts/logout.php"> Cerrar Sesi&oacute;n </a>
                        </div>
                    
					<?php } ?>
                        
              </div>
              
              
              <div style="clear:both; position:relative; float:left; margin:10px 10px 30px 50px; padding:10px; text-align:left; line-height:18px; z-index:999;">
                     <div style="margin:0 10px 0 0; float:left; font-family:Georgia, 'Times New Roman', Times, serif; font-size:24px; color:#111; text-shadow:#fff 0 0 40px;" > 
                     		&iquest;Qu&eacute; madera est&aacute; buscando? 
                     </div>
                     <form action="busqueda.php" method="post" style="float:left;">
                     	<img style="float:left; margin:-15px 0 0 10px; position:relative; z-index:1000;" src="images/iconos/lupa.png" />
                        <input id="buscar" name="buscar" type="search" x-webkit-speech style="float:left; width:240px; margin-top:-3px; margin-left:-18px; border:#444 1px solid; height:25px; padding-left:20px; opacity:0.6;" />
                  	 	<input type="button" value="Buscar" style="float:left;  height:24px; width:80px; margin:-2px 0 0 5px; cursor:pointer;" />
                     </form>
              </div>
              
              
              <!------------------------------------------------->
              
              <?php include('php_scripts/menu.php'); ?>
              
              <!------------------------------------------------->
              
              <div style="float:left; margin:0 30px 30px 0; padding:30px; min-height:400px; width:635px; border:#000 1px solid; text-align:left; line-height:18px; border-radius:10px;  background-color:#fff; opacity:0.7;">
              		
                     <div class="verde" style="margin:0 10px 0 0; float:left; font-family:Georgia, 'Times New Roman', Times, serif; font-size:24px; color:#111; text-shadow:#fff 0 0 40px;" > 
                     		Resultados de su b&uacute;squeda
                     </div>
                     
                	<?php
					
						$sql = "SELECT * FROM maderas WHERE nombre LIKE '%".strip_tags($_POST["buscar"])."%' or descripcion LIKE '%".strip_tags($_POST["buscar"])."%' ";
						$consulta = mysql_query($sql);
						validar_consulta($consulta);
					?>
                    
                    <div style="clear:both; margin:25px 10px 0 0; font-family:Georgia, 'Times New Roman', Times, serif; font-size:18px; color:#555;" > 
                     		 B&uacute;squeda: <?php if(empty($_POST["buscar"])) echo "Todas las maderas."; else echo strip_tags($_POST["buscar"]); ?>
                    </div>
                    <div id="estado_de_carrito" style="visibility:hidden;"></div>
                                        
                    <div style="clear:both; margin:25px 10px 0 0; color:#111; text-align:justify; text-justify:auto; " > 
                    <?php
						$q = strip_tags($_POST["buscar"]);
						if(mysql_num_rows($consulta)!=0)
						{
							while($row = mysql_fetch_array($consulta))
							{
					?>
                                <div style="clear:both; margin:25px 10px 10px 0; font-family:Georgia; font-size:18px; color:#111;" > <?= Resaltar($q,$row["nombre"]) ?> </div>
								
								<div style="clear:both; width:202px; height:202px; float:left; margin:0 20px 10px 0; border-radius:10px; background-color:#eee; box-shadow:#555 1px 1px 5px;" >
                                	<div style="width:194px; height:194px; margin:4px; background-image:url(images/maderas/<?= $row["img"] ?>); border-radius:8px; " ></div>
                                </div>
                                <div style="display:inline-block; width:390px; border:#ccc 1px solid; border-radius:5px; margin-bottom:5px; padding:5px;">
                                	<a href="">Comprar ahora!</a> - <a onclick="$('#estado_de_carrito').load('php_scripts/carrito.php?idm=<?= $row["id_madera"] ?>');">A&ntilde;adir a la lista de compras</a>
                                </div>
								<?= Resaltar($q,$row["descripcion"]) ?>
								
					<?php
                    		}
						}
						else 
						{
					?>
                    	<div style="clear:both; margin:40px 0 0 0; text-align:center; font-family:Georgia; font-size:24px; color:#111;" > 
                        	Su b&uacute;squeda no produjo ning&uacute;n resultado. 
                        </div>
                        <div style="clear:both; text-align:left; margin:10px 0 0 0; font-size:12px; text-align:center; color:#555;" > 
                        	Nota. Si no est&aacute; seguro como se escribe el nombre o caracter&iacute;stica de alguna<br /> madera, intente solamente con partes de la palabra que busca.
                            <br />Ej. Si usted estar&iacute;a buscando &quot;ochoo&quot; puede buscar solamente &quot;choo&quot;.
                        </div>
                        
					<?php	
						}
					?>
                    </div>
                    
              </div>
             
             <div style="float:right; text-align:right; font-size:12px; color:#555; padding:30px;">
                Jos&eacute; Ignacio Mart&iacute;nez Taboada<br />
                Proyecto de Metodolog&iacute;a de la Investigaci&oacute;n Sis350
             </div>
             
             <div style="clear:both;"></div>
                    
        </div> <!--Fin del contenedor 1024w-->
        
        <div style="color:#555; font-size:12px; margin-top:20px;">
        	Resoluci&oacute;n m&iacute;nima recomendada 1024px x 768px
        </div>
        
        
        
   </center>
</body>
</html>
<?php
  if($_SESSION["url"]!=get_url()) $_SESSION["url"] = get_url();
  if(isset($connection)){ @mysql_close($connection); }
?>
<?php ob_end_flush(); ?>