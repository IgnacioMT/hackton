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