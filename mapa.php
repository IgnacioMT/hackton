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
		$(document).ready(function() {
			load_map();
		});
		 
		var map, marker;
		var infowindow = new google.maps.InfoWindow({});
		
		var imgMarcador = new google.maps.MarkerImage('http://blackoutdal.net23.net/images/map/marcador.png', 
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
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map($("#map_canvas").get(0), myOptions);
			cargar();
		}
		
		
		function cargar() {
			var address = '<?php echo $_GET["dir"]; ?>, <?php echo $_GET["ciudad"]; ?>, <?php echo $_GET["dep"]; ?>, <?php echo $_GET["pais"]; ?>';
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({ 'address': address}, geocodeResult);
		}
		 
		function geocodeResult(results, status) {
			if (status == 'OK') {
				// Si hay resultados encontrados, centramos y repintamos el mapa
				// esto para eliminar cualquier pin antes puesto
				var mapOptions = {
					center: results[0].geometry.location,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				map = new google.maps.Map($("#map_canvas").get(0), mapOptions);
				map.fitBounds(results[0].geometry.viewport);
						
				var markerOptions = { draggable: true, icon: imgMarcador, shadow: imgSombra, position: results[0].geometry.location };
				setInfoWindow('Encontramos tu direccion aproximada!','<br />Esta ubicación se utilizará en la etapa de análisis.',
							   results[0].geometry.location.lat(),results[0].geometry.location.lng());
				
				marker = new google.maps.Marker(markerOptions);
				marker.setMap(map);
				
				parent.document.getElementById('markerLat').value = results[0].geometry.location.lat();
			    parent.document.getElementById('markerLng').value = results[0].geometry.location.lng();
			    parent.document.getElementById('geoPos').innerHTML = convertir_coordenadas(results[0].geometry.location.lat(),results[0].geometry.location.lng());
				
				try{
					parent.document.getElementById('markerLat').value = results[0].geometry.location.lat();
                	parent.document.getElementById('markerLng').value = results[0].geometry.location.lng();
					
					google.maps.event.addListener(marker, 'dragend', function(event)
					{				
						  setInfoWindow('Usted se encuentra aqui!','Esta ubicación se utilizará en la etapa de análisis.',event.latLng.lat(),event.latLng.lng());							
						  try{
							   var url = "coord.php?lat="+event.latLng.lat()+"&lng="+event.latLng.lng();
							   $("#coord").load(url);
						  }catch(e){}
						
						  parent.document.getElementById('markerLat').value = event.latLng.lat();
						  parent.document.getElementById('markerLng').value = event.latLng.lng();
						  parent.document.getElementById('geoPos').innerHTML = convertir_coordenadas(event.latLng.lat(),event.latLng.lng());			
					});
				}catch(e){};

			} else {
				alert("Ups! Lo sentimos pero no pudimos localizar la zona requerida.");
			}
		}
		
</script>
</head>
<body>
    <div id="map_canvas" style="width:100%; height:100%;"></div>
</body>
</html>