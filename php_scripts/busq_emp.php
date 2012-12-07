<?php ob_start(); ?>
<?php include("funciones.php"); ?>
<?php include("coneccion.php");  ?>
<?php include("sesion.php");  ?>

<?php 
	
	function generarConsultaProveedores($rubro)
	{
		$res = array();
		$sql = "SELECT * FROM info_empresa ";
		
		switch ($rubro) {
			case "exportaciones": $res[]= "transporte"; break;
			case "importaciones": $res[]= "distribucion"; $res[]= "transporte"; break;
			case "muebles": $res[]= "madera"; $res[]= "transporte"; break;
			case "madera": $res[]= "transporte"; $res[]= "ventas"; break;
			case "transporte": $res[]= "importaciones"; break;
			case "educacion": $res[]= "material de escritorio"; $res[]= "papeleria"; $res[]= "libros"; break;
			case "hotel": $res[]= "transporte"; $res[]= "viajes"; break;
			case "textiles": $res[]= "ventas"; $res[]= "importaciones"; break;
			case "calzados": $res[]= "cuero"; $res[]= "ventas"; $res[]= "importacion"; break;
			case "eventos": $res[]= "alimentos"; $res[]= "panaderia"; $res[]= "cotillon"; $res[]= "reposteria"; $res[]= "pasteleria"; $res[]= "decoracion"; break;
			case "alimentos": $res[]= "pollos"; break;
			case "computacion":	$res[]= "importacion"; $res[]= "ventas"; break;
			case "artesania": $res[]= "madera"; $res[]= "metal"; break;
			case "prendas de vestir": $res[]= "cuero"; $res[]= "textiles"; break;
			case "confeccion": $res[]= "cuero"; $res[]= "textiles";
			case "construccion": $res[]= "metal"; $res[]= "madera"; $res[]= "cemento"; $res[]= "griferia"; break;
			case "salud": $res[]= "instrumentos medicos"; break;
			default: break;
		}
		
		if(!empty($res)) $sql .= " WHERE ";
		else $sql .= " WHERE 1=2";
		
		echo '<div style="text-align:left; margin:10px 10px 10px 20px; ">';
			
			echo "Puede que estas empresas sean de su inter&eacute;s: ";
			$primVal = 0;
			foreach($res as $val) {
				$sql .= " rubro LIKE '%".$val."%' or ";
				if($primVal!=0) echo ", ";
				echo '<span class="rojo">'.$val."</span>";
				$primVal=1;
			}
		echo "</div>";
		
		if(!empty($res)) return substr($sql,0,-4);
		return $sql;
	}
	
	function generarConsultaOportunidades($rubro)
	{
		$res = array();
		$sql = "SELECT * FROM info_empresa ";
		
		switch ($rubro) {
			case "transporte": $res[]= "exportaciones"; $res[]= "importaciones"; break;
			case "importaciones": $res[]= "distribucion"; $res[]= "transporte"; $res[]= "ventas"; break;
			case "madera": $res[]= "muebles"; $res[]= "exportaciones"; break;
			case "transporte": $res[]= "agencias de viajes"; break;
			case "hotel": $res[]= "agencias de viajes"; break;
			case "textiles": $res[]= "comercializacion de prendas de vestir"; break;
			case "confeccion": $res[]= "comercializacion de prendas de vestir"; break;
			case "alimentos": $res[]= "comida rapida"; break;
			case "artesania": $res[]= "feria artesania"; break;
			case "calzados": $res[]= "feria"; break;
			default: break;
		}
		
		if(!empty($res)) $sql .= " WHERE ";
		else { $sql .= " WHERE 1=2"; return $sql; }
		
		echo '<div style="text-align:left; margin:10px 10px 10px 20px; ">';
			
			echo "Puede que estas empresas sean de su inter&eacute;s: ";
			$primVal = 0;
			foreach($res as $val) {
				$sql .= " rubro LIKE '%".$val."%' or ";
				if($primVal!=0) echo ", ";
				echo '<span class="rojo">'.$val."</span>";
				$primVal=1;
			}
		echo "</div>";
		
		if(!empty($res)) return substr($sql,0,-4);
		return $sql;
	}

?>


<?php    				
		//header("Content-Type:text/html; charset=utf-8");
  		header("Content-Type: text/html; charset=iso-8859-1");
		
		$buscar = utf8_decode(strip_tags(strtolower($_GET["buscar"])));						
		$id = $_GET["id"];
		
		echo '<div style="clear:both; margin-top:50px; text-align:left; width:950px; margin:20px 0 10px 0; ">';
            if($id==1) echo '<img src="images/oportunidades.png" />';
			else if($id==2) echo '<img src="images/posibles.png" />';
			else if($id==3) echo '<img src="images/competencia.png" />';
        echo '</div>';

		
		echo '<div class="georgiaIt14" style="text-align:left; font-size:18px; margin:10px 0 10px 20px; " >';
					 
			if(!empty($buscar)) echo "Resultados de empresas con rubro o actividad: ".$buscar."<br />";
			else echo "Todos los resultados...";
		echo "</div>";
			
		if($id==1) $sql = generarConsultaOportunidades($buscar);
		if($id==2) $sql = generarConsultaProveedores($buscar);
		if($id==3) $sql = "SELECT * FROM info_empresa WHERE LOWER(rubro) like '%".$buscar."%' or LOWER(nombre) like '%".$buscar."%'";
			
		$consulta = mysql_query($sql);
		validar_consulta($consulta);
		
		$total = mysql_num_rows($consulta);
		$cont = 0;
		$contTotal = 0;
		
		
		if(mysql_num_rows($consulta) != 0 )
		{
			while ($row = mysql_fetch_array($consulta) )
			{ 				
				if($cont==0) echo '<div style="float:left; width:235px; ">';
				
				echo '<div id="caja'.$row["id_empresa"].'" class="cajaRes">';
				
				    //echo '<div style="float:right; border:#f00 1px dashed; width:32px; height:32px;"></div>';
					
					echo '<a title="Informaci&oacute;n adicional de la empresa. onclick="anim'.$row["id_empresa"].'(\'caja'.$row["id_empresa"].'\');" style="cursor:pointer;">';
						echo '<div class="georgiaIt12 cajaResTit">'.$row["nombre"]."</div>";
					echo '</a>';
					
					echo '<div class="georgiaIt12 cajaResSubTit">Rubro o actividad: </div>';
					echo '<div class="verdana12" style="text-align:left; margin:10px;">'.Resaltar($buscar,$row["rubro"])."</div>";
					
					echo '<div class="georgiaIt12 cajaResSubTit">Datos de contacto: </div>';
					
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
						if( strtolower($val) == "torre") break;
						if( strtolower($val) == "torres") break;
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
			$sql = "SELECT rubro FROM info_empresa ";
			$consulta = @mysql_query($sql);
			validar_consulta($consulta);
			while($row = @mysql_fetch_array($consulta) )
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
				$lev = levenshtein(strtolower($input), strtolower($word));
				if ($lev == 0) {
					$closest = $word;
					$shortest = 0;
					break;
				}
				if ($lev <= $shortest || $shortest < 0) {
					$closest  = $word;
					$shortest = $lev;
				}	
				
				similar_text(strtolower($word),strtolower($buscar),$porcent);
				if( $lev<5 && $lev>0 && $porcent>70 ) $res[] = $word;
			}
			
			echo '<div style="clear:both; margin-top:30px; ">';
				/*if ($shortest == 0) { echo "La b&uacute;squeda de ".$input." no obtuvo coincidencias.";}
				else*/ {
						echo "La b&uacute;squeda de ".$input." no obtuvo coincidencias.<br /><br />";
						
						if(!empty($closest))
						echo "<span class=\"rojo georgiaIt14\" style=\"font-size:16px;\">Talvez quizo decir:</span>
							  <span class=\"plomo georgiaIt14\" style=\"font-size:18px;\">".ucfirst(strtolower($closest))."</span>";
						echo "<br />";
						$cont = 0;
						
						echo "<span class=\"plomo georgiaIt14\" style=\"font-size:16px;\">";
							if(empty($res)) echo "No hay mas sugerencias para su b&uacute;squeda...";
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