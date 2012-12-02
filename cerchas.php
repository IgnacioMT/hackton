<?php ob_start(); ?>
<?php include('php_scripts/sesion.php'); ?>
<?php include('php_scripts/funciones.php'); ?>
<?php include("php_scripts/coneccion.php");  ?>
<?php header("Content-Type: text/html; charset=iso-8859-1"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Barraca Midea - C&aacute;lculo de cerchas</title>
    
    

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
              		
                     <div style="margin:0 10px 0 0; font-family:Georgia, 'Times New Roman', Times, serif; font-size:24px; color:#111; text-shadow:#fff 0 0 40px;" > 
                     		Cerchas - c&aacute;lculo estructural
                     </div>
                     <div style="font-size:12px; margin-top:5px;">
                     	Complete el siguiente formulario para calcular los materiales necesarios
                     </div>
                     
                     <div style="margin-top:30px;" class="georgiaIt14">Introduzca los siguientes datos:</div>
                     <div style="background-image:url(images/cerchas.png); width:640px; height:480px; margin:10px 0 10px -3px; font-size:12px; "></div>
                     
                     <form id="calc">
                     
                     <div style="padding:10px; border:#666 1px dashed; border-radius:10px; margin:20px 0 20px 0; ">
                     
                     	 <div class="verde" style="margin:10px 10px 20px 10px; font-family:Georgia, 'Times New Roman', Times, serif; font-size:24px; color:#111; text-shadow:#fff 0 0 40px;" > 
                     		Datos de entrada
                         </div>
                         
                         <div style="clear:both; margin:20px 10px 10px 10px; line-height:22px;">
                              Madera para construcci&oacute;n: 
								 
                                 <?php
                                    $sql = "SELECT precio FROM maderas WHERE nombre = 'Almendrillo' LIMIT 1";
                                    $consulta = mysql_query($sql);
                                    $row1 = mysql_fetch_array($consulta);
                                    $sql = "SELECT precio FROM maderas WHERE nombre = 'Verdolago' LIMIT 1";
                                    $consulta = mysql_query($sql);
                                    $row2 = mysql_fetch_array($consulta);
                                    $sql = "SELECT precio FROM maderas WHERE nombre like '%Curupau%' LIMIT 1";
                                    $consulta = mysql_query($sql);
                                    $row3 = mysql_fetch_array($consulta);
                                ?>		
                            
                              <select id="madera" style="width:200px;" >
                                 <option>Almendrillo <?= $row1["precio"]?> Bs/ft. </option>
                                 <option>Verdolago <?= $row2["precio"]?> Bs/ft. </option>
                                 <option>Curupa&uacute; / Cebil <?= $row3["precio"]?> Bs/ft.</option>
                             </select>
                         </div>
                         
                        <div style="margin:10px; line-height:22px;"><div style="width:100px; display:inline-block;">Alto A1(mm):</div> <input type="text" value="150.00" id="a1" /> </div> 
                        <div style="margin:10px; line-height:22px;"><div style="width:100px; display:inline-block;">Ancho B1(mm):</div> <input type="text" value="50.00" id="b1" /> </div>
                        <div style="margin:10px; line-height:22px;"><div style="width:100px; display:inline-block;">Alto A2(mm):</div> <input type="text" value="150.00" id="a2" /> </div> 
                        <div style="margin:10px; line-height:22px;"><div style="width:100px; display:inline-block;">Ancho B2(mm):</div> <input type="text" value="50.00" id="b2" /> </div>
                        <div style="margin:10px; line-height:22px;"><div style="width:100px; display:inline-block;">Alto A3(mm):</div> <input type="text" value="150.00" id="a3" /> </div> 
                        <div style="margin:10px; line-height:22px;"><div style="width:100px; display:inline-block;">Ancho B3(mm):</div> <input type="text" value="50.00" id="b3" /> </div>
                        <div style="margin:10px; line-height:22px;"><div style="width:100px; display:inline-block;">Alto A4(mm):</div> <input type="text" value="100.00" id="a4" /> </div> 
                        <div style="margin:10px; line-height:22px;"><div style="width:100px; display:inline-block;">Ancho B4(mm):</div> <input type="text" value="50.00" id="b4" /> </div>
                        <div style="margin:10px; line-height:22px;"><div style="width:100px; display:inline-block;">Alto A5(mm):</div> <input type="text" value="50.00"  id="a5" /> </div> 
                        <div style="margin:10px; line-height:22px;"><div style="width:100px; display:inline-block;">Ancho B5(mm):</div> <input type="text" value="50.00" id="b5" /> </div>
                                            
                        
                        <div style="margin:10px; line-height:22px;"><div style="width:120px; display:inline-block;">Luz (metros): </div> <input type="text" value="6.00" id="luz" /> </div>
                        <div style="margin:10px; line-height:22px;"><div style="width:120px; display:inline-block;">&Aacute;ngulo fald&oacute;n (&deg;): </div> <input type="text" value="30.00" id="angulo" /> </div>
                        
                        <div style="margin:10px; line-height:22px;"><div style="width:120px; display:inline-block;">Separaci&oacute;n (m): </div> <input type="text" value="0.8" id="sep" /> </div>
                        <div style="font-size:10px; margin-left:135px; color:#666; margin-top:-5px;">Para cubierta de calamina se recomienda 1.2m de separaci&oacute;n, para teja 0.8m</div>
                        
                        <div style="margin:10px; line-height:22px;"><div style="width:140px; display:inline-block;">Cantidad de cerchas: </div> <input type="text" value="5" id="n" /> </div>
                        <div style="margin:10px; line-height:22px;"><div style="width:185px; display:inline-block;">Long. arriostramiento t.(mm): </div> <input type="text" value="450" id="la" /> </div>
                    
                    </div>
                    
                    <div style="margin:10px; line-height:22px;">
                    	
                        <script type="text/javascript">
							function formReset()
							{
								document.getElementById("calc").reset();
							}
						</script>

                    	<div style="padding:10px; border:#666 1px dashed; width:616px; border-radius:10px; margin:20px 0 20px -10px; ">
                            <input type="button" onclick="calcular();" value="Calcular cantidades y precios" />
                            <input type="button" onclick="formReset();" value="Limpiar todos los campos">
                        </div>
                        
                        <div style="padding:10px; border:#666 1px dashed; width:616px; border-radius:10px; margin:20px 0 20px -10px; ">
                            
                            <div class="verde" style="margin:10px 10px 20px 10px; font-family:Georgia, 'Times New Roman', Times, serif; font-size:24px; color:#111; text-shadow:#fff 0 0 40px;" > 
                                Resultados de los c&aacute;lculos
                            </div>
                            <div style="margin:10px; line-height:22px;"><div style="width:220px; display:inline-block;">Madera total requerida(ft3): </div> <input type="text" value="" id="totalMaderaUsada" /> </div>
                            <div style="margin:10px; line-height:22px;"><div style="width:220px; display:inline-block;">Precio total de la madera(Bs.): </div> <input type="text" value="" id="PrecioTotalMadera" /> </div>
                            <div style="margin:10px; line-height:22px;"><div style="width:220px; display:inline-block;">Plancha metalica req(m2): </div> <input type="text" value="" id="planchaMetal" /> </div>
                            <div style="margin:10px; line-height:22px;"><div style="width:220px; display:inline-block;">Precio plancha metalica(Bs.): </div> <input type="text" value="" id="precioPlanchaMetal" /> </div>
                            <div style="margin:10px; line-height:22px;"><div style="width:220px; display:inline-block;">Pernos/tuercas requeridas: </div> <input type="text" value="" id="pernos" /> </div>
                            <div style="margin:10px; line-height:22px;"><div style="width:220px; display:inline-block;">Precio total pernos y tuercas(Bs.): </div> <input type="text" value="" id="precio_prenos" /> </div>
                            <div style="margin:10px; line-height:22px;"><div style="width:220px; display:inline-block;">Cantidad de clavos req(Kg): </div> <input type="text" value="" id="cantClavos" /> </div>
                            <div style="margin:10px; line-height:22px;"><div style="width:220px; display:inline-block;">Precio aprox de clavos(Bs.): </div> <input type="text" value="" id="precioClavos" /> </div>
                            
                            <div style="margin:10px; line-height:22px;"><div style="width:220px; display:inline-block;">Precio Total(Bs.): </div> <input type="text" value="" id="total" /> </div>
                        </div>
                        
                        <div style="padding:10px; border:#666 1px dashed; width:616px; border-radius:10px; margin:20px 0 20px -10px; ">
                            <input type="button" onclick="calcular();" value="Comprar ahora!" />
                        </div>
                        
                    </div>
                    
                    </form>
                    
                    <script>
						function calcular()
						{
							var f = 39.37/1000;
							/*f -> factor de conversion de mm a in*/
							
							var a1 = $("#a1").val()*f;
							var b1 = $("#b1").val()*f;
							var a2 = $("#a2").val()*f;
							var b2 = $("#b2").val()*f;
							var a3 = $("#a3").val()*f;
							var b3 = $("#b3").val()*f;
							var a4 = $("#a4").val()*f;
							var b4 = $("#b4").val()*f;
							var a5 = $("#a5").val()*f;
							var b5 = $("#b5").val()*f;
							
							var luz = $("#luz").val()*39.3700;
							var angulo = $("#angulo").val()*Math.PI/180;
							var n = $("#n").val();
							var sep = $("#sep").val();
							var la = $("#la").val();
							
							<?php
								$sql = "SELECT precio FROM maderas WHERE nombre = 'Almendrillo' LIMIT 1";
								$consulta = mysql_query($sql);
								$row1 = mysql_fetch_array($consulta);
								$sql = "SELECT precio FROM maderas WHERE nombre = 'Verdolago' LIMIT 1";
								$consulta = mysql_query($sql);
								$row2 = mysql_fetch_array($consulta);
								$sql = "SELECT precio FROM maderas WHERE nombre like '%Curupau%' LIMIT 1";
								$consulta = mysql_query($sql);
								$row3 = mysql_fetch_array($consulta);
							?>		
												
							var precioPieTablar;
							if( $("#madera").val() == "Almendrillo" ) precioPieTablar = <?= $row1["precio"]?>;
							else if( $("#madera").val() == "Verdolago" ) precioPieTablar = <?= $row2["precio"]?>;
							else precioPieTablar = <?= $row3["precio"]?>;
							
							var h = Math.tan(angulo)*0.5*luz;
							var b = h/Math.sin(angulo);
							var a = Math.sqrt(Math.pow(0.5*luz,2)+Math.pow(0.5*b,2)-2*(0.5*b)*(0.5*luz)*Math.cos(angulo));
							
							var totalMaderaUsada = ( 2*a/12*(a2*b2) + 2*b/12*(a3*b3)/12 + luz/12*(a1*b1)/12 + h/12*(a2*b2)/12 )*n;
							$('#totalMaderaUsada').val(totalMaderaUsada*0.0833333);
							var PrecioTotalMadera = totalMaderaUsada*precioPieTablar/8;
							$('#PrecioTotalMadera').val(PrecioTotalMadera);
							
							var planchaMetal = 0.20*0.30*5*n;
							var precioPlanchaMetal = planchaMetal*250; /*(240Bs/m2)*/
							$('#planchaMetal').val(planchaMetal);
							$('#precioPlanchaMetal').val(precioPlanchaMetal);
							
							var cantClavos = 0.01*50*n;
							var precioClavos = cantClavos*22;
							$('#cantClavos').val(cantClavos);
							$('#precioClavos').val(precioClavos);
							
							var cant_pernos = n*(6+6+10+4+4+6);
							var costo_pernos = cant_pernos*(0.6)+cant_pernos*(0.3);
							
							$('#pernos').val(cant_pernos);
							$('#precio_prenos').val(costo_pernos);
							
							var total = costo_pernos + precioClavos + precioPlanchaMetal + PrecioTotalMadera;
							$('#total').val(total);
							
						}
					</script>
                    
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