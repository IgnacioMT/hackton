<?php ob_start(); ?>
<?php include('php_scripts/sesion.php'); ?>
<?php include('php_scripts/funciones.php'); ?>
<?php include("php_scripts/coneccion.php");  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hackton</title>

	<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
	
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
              
              <div style="clear:both; text-align:left; margin-top:30px; height:150px; width:950px; margin:20px 0 10px 0; ">
                    <img src="images/resultados.png" />
              </div>
              
              
              
              <!----------Caja 1----------> 
              <form onsubmit="cargarResultados(); return false;" >
              
              <div class="cajaPregunta" >
                     
                     <div style="color:#eee; text-shadow:#000 1px 1px 5px; width:380px; line-height:34px; vertical-align:middle;" class="georgiaIt12 titBusq" > 
                     		1. &iquest;A qu&eacute; quisieras dedicarte?
                     </div>
                     
                     	
                        <input class="inputBusq" id="buscar" name="buscar" x-webkit-speech type="search"  value="<?php if(!empty($_POST["buscar"])) echo $_POST["buscar"]; ?>" style="width:300px;" />
                        
                        <script>
							function seleccionar()
							{ 
								$("#buscar").val(document.getElementById('cajaSeleccionar').value);
							}
						</script>
                        <select class="selectBusq" id="cajaSeleccionar" >
                        <?php
						
                        $input = $buscar;
                        $words = array(); 
                        $sql = "SELECT rubro FROM info_empresa";
                        $consulta = mysql_query($sql);
                        validar_consulta($consulta);
                        while($row = mysql_fetch_array($consulta) )
                        {
                            $palabras = $row["rubro"];
                            $palabras = str_ireplace("."," ",$palabras);
                            $palabras = str_ireplace(","," ",$palabras);
                            $palabras = str_ireplace(";"," ",$palabras);
                            
                            $palabras = str_ireplace("("," ",$palabras);
                            $palabras = str_ireplace(")"," ",$palabras);
                            $palabras = explode(" ",$palabras);
                            foreach($palabras as $val) 
                            {
                                if(strlen($val)>2)
                                if(!in_array($val,$words))
                                {
                                    $words[] = $val;
                                    //echo ucfirst(strtolower($val))." * ";
                                }
                            }
                            
                        }
                                    
                        $shortest = -1;
                        $res = "";
                        
                        foreach ($words as $word) {
                            $lev = levenshtein($input, $word);
                            if ($lev == 0) {
                                $closest = $word;
                                $shortest = 0;
                                break;
                            }
                            if ($lev <= $shortest || $shortest < 0) {
                                $closest  = $word;
                                $shortest = $lev;
                            }
                            if($lev>6) $res[] = $word;
                        }
                       
					   sort($res); 
						
                       foreach ($res as $val)
						{
							if($cont!=0) echo ", ";
							$cont++;
							echo "<option>".ucfirst(strtolower($val))."</option>";
						}
						
                        ?>

                        </select>
                        
                     <div style="color:#eee; font-size:12px; height:17px; padding:5px;">
                     	Introduce palabras clave que desearias incluir en la b&uacute;squeda, como por ejemplo: Salud, Educaci&oacute;n, Transporte, Universidad, etc...
                     </div>
                     
              </div>
              
              <!------fin caja 1----------> 
              <!----------Caja 2----------> 
              
              <?php include("php_scripts/filtro_caja2.php"); ?>
              
              <!------fin caja 2----------> 
              <!----------Caja 3----------> 
              
              <div class="cajaPregunta3" >
                     <div style="color:#eee; text-shadow:#000 1px 1px 5px; width:420px; line-height:34px; vertical-align:middle;" class="georgiaIt12 titBusq" > 
                     		3. &iquest;Qu&eacute; tipo de an&aacute;lisis desea realizar?
                     </div>
                  	 
                     <input class="botonBusq" type="button" name="competitivo" value="An&aacute;lisis Competitivo" onclick="analisisCompetitivo();" style="width:200px;" />
        			 <input class="botonBusq" type="button" name="informativo" value="An&aacute;lisis Informativo" onclick="analisisInformativo();" style="width:200px;" />
                     
              </div>
              
              </form>
              <!------fin caja 3----------> 
              
              
              <div style="clear:both;"></div>
              <img src="images/separador.png" style="width:1024px; float:left; clear:both;" />
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
              
             <!----------------------------------------------------------------------------------------------------------------------->
              <div id="resultados" style="clear:both; margin:40px 0 30px 0; min-height:500px; width:960px; padding-left:10px;">
              		
                    <!--0-------------------------------------->
                    
                    <div id="cargando0" style="display:none;"></div>
                    <div id="cargarContenido0"></div>
                    <div style="clear:both;"></div>
                    
                    <!--1------------------------------------->
                    
                    <div id="cargando1" style="display:none;">
                    	<div class="animCargando"></div>
                        <img src="images/cargando_texto.png" />
                    </div>
                    <div id="cargarContenido1"></div>
                    <div style="clear:both;"></div>
                    
                    <!--2-------------------------------------->
                    
                    <div id="cargando2" style="display:none;"></div>
                    <div id="cargarContenido2"></div>
                    <div style="clear:both;"></div>
                    
                    <!--3-------------------------------------->
                    
                    <div id="cargando3" style="display:none;"></div>
                    <div id="cargarContenido3"></div>
                    <div style="clear:both;"></div>
                    
                    <!---------------------------------------->
                    
              </div>
              
             
                <?php header("Content-Type: text/html; charset=iso-8859-1"); ?> 
                         
				<script>
                    function analisisCompetitivo()
                    {
                        //document.getElementById('TipoAnalisis').innerHTML = '<img src="images/compet.png">';
						cargarDireccion();
						var lat = $("#markerLat").val();
						var lng = $("#markerLng").val();
						
						var url0 = "php_scripts/cargarmapa.php?lat="+lat+"&lng="+lng+"&id=1&buscar="+encodeURI($("#buscar").val()) + "&r=" + Math.random()*99999;
                        $('#cargarContenido0').slideUp(250, function(){ 
                            $('#cargando0').slideDown(250);
                            try{ $('html,body').animate({ scrollTop: ($("#resultados").offset().top-35) }, 600); }catch(e){}
                            $('#cargarContenido0').load(url0, function(){ 
                                try{ $('html,body').animate({ scrollTop: ($("#resultados").offset().top-35) }, 600); }catch(e){}
                                $('#cargando1').delay(1000).slideUp(250, function(){ 
                                    $('#cargarContenido0').slideDown(600);
                                }); 
                            })
                        });
						
						
						var url1 = "php_scripts/busq_emp.php?id=1&buscar="+encodeURI($("#buscar").val()) + "&r=" + Math.random()*99999;
                        $('#cargarContenido1').slideUp(250, function(){ 
                            $('#cargando1').slideDown(250);
                            try{ $('html,body').animate({ scrollTop: ($("#resultados").offset().top-35) }, 600); }catch(e){}
                            $('#cargarContenido1').load(url1, function(){ 
                                try{ $('html,body').animate({ scrollTop: ($("#resultados").offset().top-35) }, 600); }catch(e){}
                                $('#cargando1').delay(1000).slideUp(250, function(){ 
                                    $('#cargarContenido1').slideDown(600);
                                }); 
                            })
                        });
						
						var url2 = "php_scripts/busq_emp.php?id=2&buscar="+encodeURI($("#buscar").val()) + "&r=" + Math.random()*99999;
                        $('#cargarContenido2').slideUp(250, function(){ 
                            $('#cargando2').slideDown(250);
                            $('#cargarContenido2').load(url2, function(){ 
                                $('#cargando2').delay(1000).slideUp(250, function(){ 
                                    $('#cargarContenido2').slideDown(600);
                                }); 
                            })
                        });
						
						var url3 = "php_scripts/busq_emp.php?id=3&buscar="+encodeURI($("#buscar").val()) + "&r=" + Math.random()*99999;
                        $('#cargarContenido3').slideUp(250, function(){ 
                            $('#cargando3').slideDown(250);
                            $('#cargarContenido3').load(url3, function(){ 
                                $('#cargando3').delay(1000).slideUp(250, function(){ 
                                    $('#cargarContenido3').slideDown(600);
                                }); 
                            })
                        });
                        
                    }
					
					function analisisInformativo()
					{
						cargarDireccion();
						var lat = $("#markerLat").val();
						var lng = $("#markerLng").val();
						
						var url0 = "php_scripts/cargarmapa.php?lat="+lat+"&lng="+lng+"&id=2&buscar="+encodeURI($("#buscar").val()) + "&r=" + Math.random()*99999;
                        $('#cargarContenido0').slideUp(250, function(){ 
                            $('#cargando0').slideDown(250);
                            try{ $('html,body').animate({ scrollTop: ($("#resultados").offset().top-35) }, 600); }catch(e){}
                            $('#cargarContenido0').load(url0, function(){ 
                                try{ $('html,body').animate({ scrollTop: ($("#resultados").offset().top-35) }, 600); }catch(e){}
                                $('#cargando1').delay(1000).slideUp(250, function(){ 
                                    $('#cargarContenido0').slideDown(600);
                                }); 
                            })
                        });
						
						$('#cargarContenido1').slideUp(250);
						$('#cargarContenido2').slideUp(250);
						$('#cargarContenido3').slideUp(250);
					}
                </script>
              <!----------------------------------------------------------------------------------------------------------------------->
              
              
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
	<?php if(isset($_POST["buscar"])){ ?>
		<?php if(isset($_POST["competitivo"])) echo "<script> analisisCompetitivo(); </script>"; ?>
    	<?php if(isset($_POST["informativo"])) echo "<script> analisisInformativo(); </script>"; ?>
    <?php } ?>

</html>
<?php
  //if($_SESSION["url"]!=get_url()) $_SESSION["url"] = get_url();
  if(isset($connection)) 
  { 
     mysql_close($connection);
  }
?>
<?php ob_end_flush(); ?>