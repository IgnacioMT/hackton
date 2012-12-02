<?php ob_start(); ?>
<?php include("funciones.php"); ?>
<?php include("coneccion.php");  ?>
<?php include("sesion.php");  ?>
<?php    				
		//header("Content-Type:text/html; charset=utf-8");
  		header("Content-Type: text/html; charset=iso-8859-1");
		
		$buscar = utf8_decode($_GET["buscar"]);
		
		echo '<div class="georgiaIt14" style="text-align:left; margin:10px 0 10px 20px; " >
			 	 <div class="plomo" style="text-shadow:#999 1px 1px 5px; font-size:24px; width:380px; line-height:34px; vertical-align:middle;" class="georgiaIt12 titBusq" > 
                 	An&aacute;lisis de oportunidades: 
              	 </div>
		    </div>';
		
		echo '<div class="georgiaIt14" style="text-align:left; font-size:18px; margin:10px 0 10px 20px; " >';
					 
			if(!empty($buscar)) echo "Resultados de empresas con rubro o actividad: ".$buscar."<br />";
			else echo "Todos los resultados...";
		echo "</div>";
		$sql = "SELECT * FROM info_empresa WHERE rubro like '%".$buscar."%' or nombre like '%".$buscar."%' ";
		$consulta = mysql_query($sql);
		validar_consulta($consulta);
		
		$total = mysql_num_rows($consulta);
		$cont = 0;
		
		
		if(mysql_num_rows($consulta) != 0 )
		{
			while ($row = mysql_fetch_array($consulta) )
			{ 
				if($cont==0) echo '<div style="float:left; width:235px; ">';
				
				echo '<div id="caja'.$row["id_empresa"].'" class="cajaRes">';
				
				    echo '<div style="float:right; border:#f00 1px dashed; width:32px; height:32px;"></div>';
					
					echo '<div class="georgiaIt12" style="margin:10px; text-align:left;"><a title="Informaci&oacute;n adicional de la empresa." class="deNegroARojoOver" onclick="anim'.$row["id_empresa"].'(\'caja'.$row["id_empresa"].'\');" style="cursor:pointer;">'.$row["nombre"]."</a></div>";
					
					echo '<div class="georgiaIt12 rojo" style="text-align:left; margin:10px;">Rubro o actividad: </div>';
					echo '<div class="verdana12" style="text-align:left; margin:10px;">'.Resaltar($buscar,$row["rubro"])."</div>";
					
					echo '<div class="georgiaIt12 rojo" style="text-align:left; margin:10px;">Datos de contacto: </div>';
					
					echo '<div class="georgiaIt12 plomo" style="text-align:left; margin:5px 5px 5px 10px;">Contacto: </div>';
					echo '<div class="verdana12" style="text-align:left; margin:5px 5px 5px 10px; color:#222;">'.$row["contacto"]."</div>";
					
					echo '<div class="georgiaIt12 plomo" style="text-align:left; margin:5px 5px 5px 10px;">Direcci&oacute;n: </div>';
					echo '<div class="verdana12" style="text-align:left; margin:5px 5px 5px 10px; color:#222;">'.$row["direccion"]."</div>";
					
					$aux = explode(" ", $row["direccion"]);
					
					$dir = "";
					$band = 0;
					foreach( $aux as $val )
					{
						if($band == 1) { $band = 0; continue; }
						if( strtolower($val) == "zona" || strtolower($val) == "z." ){ $band = 1; continue; }
						if( strtolower($val) == "v." ){ $band = 1; continue; }
						
						if( substr($val,-1) == "." && strtolower($val)!="av." ) continue;
						if( strrchr($val, '#') ) continue;
						if( strtolower($val) == "esq.") break;
						if( strtolower($val) == "calle") continue;
						if( strtolower($val) == "mezanine") continue;
						if( strtolower($val) == "n") continue;
						if( strtolower($val[0]) == 'n' && strlen($val)<=3 ) continue;
						if( strtolower($val[0]) == 'n' && strtolower($val[2]) == '.' ) continue;
						//if( strtolower($val[1]) == '.' ) continue;
						
						$dir .= $val." ";
					}
					
					echo '<div style="margin:5px 0 10px 0;">';
						echo '<a onclick="openBox(\'mapa.php?dir='.$dir.'\');">Geolocalizar Zona (Adivinar)</a>';
					echo '</div>';
					
				echo "</div>";
				
				echo '<script>
						var ac_caja'.$row["id_empresa"].' = 0; 
						function anim'.$row["id_empresa"].'(ide)
						{
							  if(ac_caja'.$row["id_empresa"].'==0) { crecer(ide); ac_caja'.$row["id_empresa"].'=1;  } 
							  else { decrecer(ide); ac_caja'.$row["id_empresa"].'=0; }
						}
					 </script>';
				
				$cont++;
				if($cont==round($total/4)) { echo '</div>'; $cont=0; }
			}
			
		}
		else 
		{
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
				
				echo "Shortest: ".$shortest." -> ".$closest."<br />";
				
			}
			
			echo '<div style="clear:both; margin-top:30px; ">';
				if ($shortest == 0) {
				echo "La búsqueda de ".$input." no obtuvo coincidencias.";
			} else {
				echo "<span class=\"rojo georgiaIt14\" style=\"font-size:16px;\">Talvez quizo decir:</span>
				      <span class=\"plomo georgiaIt14\" style=\"font-size:18px;\">".ucfirst(strtolower($closest)).">>>".$lev."<<< </span>";
				echo "<br />";
				$cont = 0;
				
				echo "<span class=\"plomo georgiaIt14\" style=\"font-size:16px;\">";
					if(empty($res)) echo "...";
					else 
					{
						echo "<span class=\"rojo georgiaIt14\" style=\"font-size:16px;\">Sugerencias: </span>";
						foreach ($res as $val)
						{
							if($cont!=0) echo ", ";
							$cont++;
							echo ucfirst(strtolower($val));
						}
					}
				echo "</span>";
			}
			echo "</div>";
		}		
		
?>
<?php if(isset($connection)){ mysql_close($connection); } ?>
<?php ob_end_flush(); ?>