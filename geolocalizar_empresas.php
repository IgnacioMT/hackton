<?php ob_start(); ?>
<?php include('php_scripts/sesion.php'); ?>
<?php include('php_scripts/funciones.php'); ?>
<?php include("php_scripts/coneccion.php");  ?>

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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/funciones.js"></script>
<title>Geocode</title>
    <style>
		*{ margin: 0; padding: 0; }
		html, body, #map{
			width: 100%;
			height: 100%;
		}
		.marker
		{
			font-family:Georgia, "Times New Roman", Times, serif; 
			font-style:italic;
			width:200px;
		}
		.verdana12{ font-family:Verdana, Geneva, sans-serif; font-size:12px; }
		.rojo{ color:#bc0000; }
		.plomo{ color:222; }
    </style>
    
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=es"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/gmaps.js"></script>
    <script>
		$(document).ready(function() { load_map(); });
		 
		var map;		
		var infowindow = new google.maps.InfoWindow({});
		
		var imgMarcador = new google.maps.MarkerImage('http://blackoutdal.net23.net/images/map/marcador.png', 
	  				    new google.maps.Size(28, 40), new google.maps.Point(0,0), new google.maps.Point(14, 40));
		var imgMarcador2 = new google.maps.MarkerImage('http://blackoutdal.net23.net/images/map/marcador2.png', 
	  				    new google.maps.Size(28, 40), new google.maps.Point(0,0), new google.maps.Point(14, 40));
						
		
		var imgMarcador3 = new google.maps.MarkerImage('http://blackoutdal.net23.net/images/map/marcador3.png', 
	  				    new google.maps.Size(28, 40), new google.maps.Point(0,0), new google.maps.Point(14, 40));
		var imgMarcador4 = new google.maps.MarkerImage('http://blackoutdal.net23.net/images/map/marcador4.png', 
	  				    new google.maps.Size(28, 40), new google.maps.Point(0,0), new google.maps.Point(14, 40));
		
					
		
        var imgSombra   = new google.maps.MarkerImage('http://blackoutdal.net23.net/images/map/sombra.png', 
				        new google.maps.Size(106, 83), new google.maps.Point(0,0), new google.maps.Point(36, 51));
		
		function setInfoWindow(titulo, texto, lat, lng)
		{
			  var pos = new google.maps.LatLng(lat,lng);
			  infowindow.setMap(null);			  
			  infowindow = new google.maps.InfoWindow({
				  map: map,
				  position: pos,
				  content: '<div class="marker"><span class="rojo">'+titulo+'</span> <span class="verdana12 plomo">'+texto+'</span></div>'
			  });
		}
		 
		function load_map() {
			var myLatlng = new google.maps.LatLng( -16.49184425, -68.13570595);
			var myOptions = {
				zoom: 14,
				center: myLatlng,
				scrollwheel: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map($("#map_canvas").get(0), myOptions);
			geolocalizar();
		}
		
		function geolocalizar()
		{
			 if(navigator.geolocation)
			 { 
			 	navigator.geolocation.getCurrentPosition(function(position)
			 	{	  
				  //var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				  //var pos = new google.maps.LatLng(-16.505545540736644, -68.12635694973756);
				  
				  <?php
				  	  if(isset($_GET["lat"])&&!empty($_GET["lat"])) $lat = $_GET["lat"]; else $lat = -16.505545540736644;
				  	  if(isset($_GET["lng"])&&!empty($_GET["lng"])) $lng = $_GET["lng"]; else $lng = -68.12635694973756;					  
				  ?>
				  
				  var pos = new google.maps.LatLng(<?php echo $lat.' , '.$lng ?> );
				  
				  infowindow = new google.maps.InfoWindow({
					map: map,
					position: pos,
					scrollwheel: false,
					content: '<div class="marker"><span class="rojo">Usted se encuentra aqui!</span> <span class="verdana12 plomo">Se muestra un radio de 1500m a su alrededor.</span></div>'
				  });
	
				  var marker = new google.maps.Marker({
					 position: pos,
					 map: map,
					 icon: imgMarcador2, 
					 shadow: imgSombra,
					 title: 'Su ubicacion'
				  });
				  
				    var circOpt = {
						strokeColor: '#47458C',
						strokeOpacity: 0.3,
						strokeWeight: 1,
						fillColor: '#47458C',
						fillOpacity: 0.1,
						map: map,
						center: pos,
						radius: 1500
					};
					var circulo = new google.maps.Circle(circOpt);
					
					marker.setAnimation(google.maps.Animation.BOUNCE);
				  	map.setCenter(pos);
				});
			 }
		}
		

		<?php 
				if($_GET["id"]==2){
					
					$buscar = $_GET["b"];
					$sql="SELECT * FROM info_empresa WHERE LOWER(rubro) LIKE '%".$buscar."%' ";
					$consulta = mysql_query($sql);
					validar_consulta($consulta);
					$cont = 1;
					while($row = mysql_fetch_array($consulta))
					{
						echo 'setTimeout(function() {';
								$dir = specialcharsFix(arreglarDireccion($row["direccion"]));
								echo 'var address'.$row["id_empresa"].' = \''.$dir.', '.$row["ciudad"].', '.$row["departamento"].', '.$row["pais"].'\'; ';
								echo 'var geocoder'.$row["id_empresa"].' = new google.maps.Geocoder(); ';
								echo 'geocoder'.$row["id_empresa"].'.geocode({ \'address\': address'.$row["id_empresa"].' }, geocodeResult'.$row["id_empresa"].'); ';
						echo '},'.($cont*500).');';
						$cont++;					
					}
				}
				else if($_GET["id"]==1)
				{
					$buscar = $_GET["b"];
					$sql="SELECT * FROM info_empresa WHERE LOWER(rubro) LIKE '%".$buscar."%' ";
					$consulta = mysql_query($sql);
					validar_consulta($consulta);
					$cont = 1;
					while($row = mysql_fetch_array($consulta))
					{
						echo 'setTimeout(function() {';
								$dir = specialcharsFix(arreglarDireccion($row["direccion"]));
								echo 'var address'.$row["id_empresa"].' = \''.$dir.', '.$row["ciudad"].', '.$row["departamento"].', '.$row["pais"].'\'; ';
								echo 'var geocoder'.$row["id_empresa"].' = new google.maps.Geocoder(); ';
								echo 'geocoder'.$row["id_empresa"].'.geocode({ \'address\': address'.$row["id_empresa"].' }, geocodeResult'.$row["id_empresa"].'); ';
						echo '},'.($cont*500).');';
						$cont++;					
					}
				}
		?>

		 
		 <?php 
				if($_GET["id"]==2)
				{	
					$consulta = mysql_query($sql);
					validar_consulta($consulta);
					while($row = mysql_fetch_array($consulta))
					{
						echo "function geocodeResult".$row['id_empresa']."(results, status) {
								try{ 
									if (status == 'OK') {
										
										try{
											if( results[0].geometry.location.lat() == -16.4990099 && results[0].geometry.location.lng() == -68.14624800000001 ) 
											{
												parent.document.getElementById('listarEmprsas').innerHTML = parent.document.getElementById('listarEmprsas').innerHTML + '<img src=\"images/ncheck.png\" style=\"vertical-align:bottom\"/> ".ucfirst(strtolower(utf8_encode($row['nombre'])))."<br />';
												return;
											}
											
											parent.document.getElementById('listarEmprsas').innerHTML = parent.document.getElementById('listarEmprsas').innerHTML + '<img src=\"images/check.png\" style=\"vertical-align:bottom\"/> ".ucfirst(strtolower(utf8_encode($row['nombre'])))."<br />';
										}catch(e){};
										
										var circOpt = {
											strokeColor: '#222222',
											strokeOpacity: 0.2,
											strokeWeight: 1,
											fillColor: '#222222',
											fillOpacity: 0.05,
											map: map,
											center: results[0].geometry.location,
											radius: 500
										};
										var circulo = new google.maps.Circle(circOpt);
										
										var markerOptions = { /*draggable: true,*/ icon: imgMarcador, shadow: imgSombra, position: results[0].geometry.location };
										var marker".$row["id_empresa"]." = new google.maps.Marker(markerOptions);
										marker".$row["id_empresa"].".setMap(map);
										marker".$row["id_empresa"].".setAnimation(google.maps.Animation.DROP);
										
										/*google.maps.event.addListener(marker".$row["id_empresa"].", 'dragend', function(event)
										{				
											  setInfoWindow('Modificar esta dirección?<br /><br />".utf8_encode($row['nombre'])."<br /><br /> ','Lat: '+event.latLng.lat()+'<br />Lng: '+event.latLng.lng()+'<br /><br />".utf8_encode($row['nombre'])."<br /><br />".utf8_encode($row['direccion'])."',event.latLng.lat(),event.latLng.lng());								
										});*/
										
										google.maps.event.addListener(marker".$row["id_empresa"].", 'click', function(event)
										{ 
											setInfoWindow('Modificar esta dirección?<br /><br />".utf8_encode($row['nombre'])."<br /><br /> ','Lat: '+event.latLng.lat()+'<br />Lng: '+event.latLng.lng()+'<br /><br />".utf8_encode($row['nombre'])."<br /><br />".utf8_encode($row['direccion'])."',event.latLng.lat(),event.latLng.lng());
										});
										
									} else{}
								}catch(e){alert('Error 666: '+e)}
							}";
					}	
				}
				else if($_GET["id"]==1)
				{
					$consulta = mysql_query($sql);
					validar_consulta($consulta);
					while($row = mysql_fetch_array($consulta))
					{
						echo "function geocodeResult".$row['id_empresa']."(results, status) {
								try{ 
									if (status == 'OK') {
										
										try{
											if( results[0].geometry.location.lat() == -16.4990099 && results[0].geometry.location.lng() == -68.14624800000001 ) 
											{
												parent.document.getElementById('listarEmprsas').innerHTML = parent.document.getElementById('listarEmprsas').innerHTML + '<img src=\"images/ncheck.png\" style=\"vertical-align:bottom\"/> ".ucfirst(strtolower(utf8_encode($row['nombre'])))."<br />';
												return;
											}
											
											parent.document.getElementById('listarEmprsas').innerHTML = parent.document.getElementById('listarEmprsas').innerHTML + '<img src=\"images/check.png\" style=\"vertical-align:bottom\"/> ".ucfirst(strtolower(utf8_encode($row['nombre'])))."<br />';
										}catch(e){};
										
										var circOpt = {
											strokeColor: '#222222',
											strokeOpacity: 0.2,
											strokeWeight: 1,
											fillColor: '#222222',
											fillOpacity: 0.05,
											map: map,
											center: results[0].geometry.location,
											radius: 500
										};
										var circulo = new google.maps.Circle(circOpt);
										
										var markerOptions = { /*draggable: true,*/ icon: imgMarcador, shadow: imgSombra, position: results[0].geometry.location };
										var marker".$row["id_empresa"]." = new google.maps.Marker(markerOptions);
										marker".$row["id_empresa"].".setMap(map);
										marker".$row["id_empresa"].".setAnimation(google.maps.Animation.DROP);
										
										/*google.maps.event.addListener(marker".$row["id_empresa"].", 'dragend', function(event)
										{				
											  setInfoWindow('Modificar esta dirección?<br /><br />".utf8_encode($row['nombre'])."<br /><br /> ','Lat: '+event.latLng.lat()+'<br />Lng: '+event.latLng.lng()+'<br /><br />".utf8_encode($row['nombre'])."<br /><br />".utf8_encode($row['direccion'])."',event.latLng.lat(),event.latLng.lng());								
										});*/
										
										google.maps.event.addListener(marker".$row["id_empresa"].", 'click', function(event)
										{ 
											setInfoWindow('Modificar esta dirección?<br /><br />".utf8_encode($row['nombre'])."<br /><br /> ','Lat: '+event.latLng.lat()+'<br />Lng: '+event.latLng.lng()+'<br /><br />".utf8_encode($row['nombre'])."<br /><br />".utf8_encode($row['direccion'])."',event.latLng.lat(),event.latLng.lng());
										});
										
									} else{}
								}catch(e){alert('Error 666: '+e)}
							}";
					}	
					
				}
				
				
		?>

		
</script>
</head>
<body>
    <div id="map_canvas" style="width:100%; height:100%;"></div>
</body>
</html>
<?php
  if(isset($connection)) 
  { 
     mysql_close($connection);
  }
?>
<?php ob_end_flush(); ?>