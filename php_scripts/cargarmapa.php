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
			
			//echo "Puede que estas empresas sean de su inter&eacute;s: ";
			$primVal = 0;
			foreach($res as $val) {
				$sql .= " rubro LIKE '%".$val."%' or ";
				if($primVal!=0) //echo ", ";
				//echo '<span class="rojo">'.$val."</span>";
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
		
		if(isset($_GET["lat"])&&!empty($_GET["lat"])) $lat = $_GET["lat"]; else $lat = -16.505545540736644;
		if(isset($_GET["lng"])&&!empty($_GET["lng"])) $lng = $_GET["lng"]; else $lng = -68.12635694973756;
					
		$id = $_GET["id"];
		echo '<div style="clear:both; margin-top:50px; text-align:left; width:950px; margin:20px 0 10px 0; ">';
            if($id==1) echo '<img src="images/compet.png" />';
			if($id==2) echo '<img src="images/inform.png" />';
        echo '</div>';
		
		$sql = generarConsultaOportunidades($buscar);	
		$consulta = mysql_query($sql);
		validar_consulta($consulta);
		$total1=mysql_num_rows($consulta);
		
		$sql = generarConsultaProveedores($buscar);
		$consulta = mysql_query($sql);
		validar_consulta($consulta);
		$total2=mysql_num_rows($consulta);

		$sql = "SELECT * FROM info_empresa WHERE LOWER(rubro) like '%".$buscar."%' or LOWER(nombre) like '%".$buscar."%'";
		$consulta = mysql_query($sql);
		validar_consulta($consulta);
		$total3=mysql_num_rows($consulta);
		
		$cont = 0;
		$contTotal = 0;		
		
		/*Analisis */

		echo '<div style="width:100%;float:left;">';
		/*iframe mapa*/
		echo '<div style="float:left; width:577px; height:567px; background-repeat:no-repeat; background-align:left top; border-color:#900;">';
        	      if($id==1) echo '<iframe id="geolocalizar" src="./geolocalizar_empresas.php?id=1&lat='.$lat.'&lng='.$lng.'&b='.$buscar.'" scrolling="no" frameborder="0" style="border:0; width:560px; height:552px;"></iframe>';
				  else if($id==2) echo '<iframe id="geolocalizar" src="./geolocalizar_empresas.php?id=2&lat='.$lat.'&lng='.$lng.'&b='.$buscar.'" scrolling="no" frameborder="0" style="border:0; width:560px; height:552px;"></iframe>';
			      echo' <img src="./images/separador.png" width="560" >
			  </div>';
		
		echo '<div style="float:left;width:370px;height:566px; background-repeat:no-repeat; background-align:left top;background-image:url(./images/papel.png);">';
		echo"<br/>";
		echo"<br/>";
		
		//Diferencia inf de comp
        if($id==1){
						
			echo '<div class="georgiaIt14" style="margin:5px;width:320px;font-size:16px;margin:10px 0 10px 20px;text-align:left;">En tu ciudad:</br>';
			
			if(!empty($buscar)){
				  if ($total1==0) echo '<div class="georgiaIt14" style="height:35px; line-height:35px;width:290px;font-size:13px;margin:10px 0 10px 20px;text-align:left;">
											<img src="images/ncheck.png" style="vertical-align:middle"/>
											<a href="#oportunidades">Oportunidades</a>
										</div>';
				  else echo '<div class="georgiaIt14" style="margin:5px;width:290px;font-size:13px;margin:10px 0 10px 20px;text-align:left;">
								<img src="images/check.png" style="vertical-align:bottom"/>
								<a href="#oportunidades">Oportunidades</a>
								<img src="images/flec.png" style="vertical-align:bottom"/>
								'.$total1.' organizaciones o empresas con las que puedes relacionarte
							 </div>';
							 
				echo '<div id="listarEmprsas" style="text-align:left; display:none; line-height:30px; width:315px; margin-top:10px; height:370px; overflow-y:scroll;"></div>'; 
			}
	
			if(!empty($buscar)){			  
				  if ($total2==0) echo '<div class="georgiaIt14" style="height:35px; line-height:35px;width:290px;font-size:13px;margin:10px 0 10px 20px;text-align:left;">
											<img src="images/ncheck.png" style="vertical-align:bottom"/>
											<a href="#posibles">Proveedores</a>
										</div>';
				  else echo '<div class="georgiaIt14" style="margin:5px;width:290px;font-size:13px;margin:10px 0 10px 20px;text-align:left;">
								<img src="images/check.png" style="vertical-align:bottom"/>
								<a href="#posibles">Proveedores</a>
								<img src="images/flec.png" style="vertical-align:bottom"/>
								'.$total2.' organizaciones o empresas que podr&iacute;an ser tus proveedores
							</div>';
			}
				
			if(!empty($buscar)){			  
				  if ($total3==0) echo '<div class="georgiaIt14" style="height:35px; line-height:35px;width:290px;font-size:13px;margin:10px 0 10px 20px;text-align:left;"><img src="images/ncheck.png" style="vertical-align:bottom"/><a href="#competencia">Competencia</a></div>';
				  else echo '<div class="georgiaIt14" style="margin:5px;width:290px;font-size:13px;margin:10px 0 10px 20px;text-align:left;"><img src="images/check.png" style="vertical-align:bottom"/><a href="#competencia">Competencia</a><img src="images/flec.png" style="vertical-align:bottom"/>'.$total3.' organizaciones o empresas del mismo rubro</div>';
			}
			
			/*division*/
			echo '<div style=" padding-bottom:10px;padding-top:10px;"><img src="images/di.png" style="vertical-align:bottom"/></div>';
		}
			
			
			
			
			
		//Analisis informativo
		else if($id==2) {
		if(!empty($buscar)){			  
			  if ($total3==0) echo '<div class="georgiaIt14" style="height:35px; line-height:35px;width:290px;font-size:16px;margin:10px 0 10px 20px;text-align:left;">
			  							<img src="images/ncheck.png" style="vertical-align:bottom"/>
										No se encontraron coincidencias para su b&uacute;squeda
									</div>';
			  else 
			  {
				  echo '<div class="georgiaIt14" style="margin:5px;width:290px;font-size:16px;margin:10px 0 10px 20px;text-align:left;">
				  			<img src="images/flec.png" style="vertical-align:bottom"/>
							Se encontraron '.$total3.' organizaciones o empresas del actividad/rubro especificado
						</div>';
				  echo '<div id="listarEmprsas" style="text-align:left; line-height:30px; width:315px; margin-top:10px; height:370px; overflow-y:scroll;"></div>'; 
			  }
		}
		}
		echo '</div>';
?>
<?php if(isset($connection)){ mysql_close($connection); } ?>
<?php ob_end_flush(); ?>