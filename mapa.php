<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Geocode</title>
    <style>
    *{ margin: 0; padding: 0; }
    html, body, #map{
        width: 100%;
        height: 100%;
    }
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=es"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/gmaps.js"></script>
    <script>
		$(document).ready(function() {
			load_map();
		});
		 
		var map, marker, infowindow;
		 
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
			// Obtenemos la dirección y la asignamos a una variable
			var address = '<?php echo $_GET["dir"]; ?>, La Paz, La Paz, Bolivia';
			// Creamos el Objeto Geocoder
			var geocoder = new google.maps.Geocoder();
			// Hacemos la petición indicando la dirección e invocamos la función
			// geocodeResult enviando todo el resultado obtenido
			geocoder.geocode({ 'address': address}, geocodeResult);
		}
		 
		function geocodeResult(results, status) {
			// Verificamos el estatus
			if (status == 'OK') {
				// Si hay resultados encontrados, centramos y repintamos el mapa
				// esto para eliminar cualquier pin antes puesto
				var mapOptions = {
					center: results[0].geometry.location,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				map = new google.maps.Map($("#map_canvas").get(0), mapOptions);
				// fitBounds acercará el mapa con el zoom adecuado de acuerdo a lo buscado
				map.fitBounds(results[0].geometry.viewport);
				// Dibujamos un marcador con la ubicación del primer resultado obtenido
						
				var markerOptions = { <?php if($_GET["d"]==1) echo " draggable: true, "; ?> position: results[0].geometry.location; }
				
				marker = new google.maps.Marker(markerOptions);
				
				<?php if($_GET["d"]==1) { ?>
					parent.document.getElementById('markerLat').value = results[0].geometry.location.lat();
                	parent.document.getElementById('markerLng').value = results[0].geometry.location.lng();
					
					google.maps.event.addListener(marker, 'dragend', function(event){
						
						   try{
								lat = Math.abs(event.latLng.lat());
								lng = Math.abs(event.latLng.lng());
							}catch(e){}
							try{
								g = truncate(lat); 
								m = Math.abs(truncate((lat-g)*60));
								s = (Math.abs(lat-g)*60-m)*60;
								NS = (event.latLng.lat()<0)? ' S' : ' N';
								nLat = g+String.fromCharCode(176)+' '+m+'\' '+s.toFixed(3)+'\'\''+NS;
							}catch(e){}
							try{
								g = truncate(lng); 
								m = Math.abs(truncate((lng-g)*60));
								s = (Math.abs(lng-g)*60-m)*60;
								NS = (event.latLng.lng()<0)? ' O' : ' E';
								nLng = g+String.fromCharCode(176)+' '+m+'\' '+s.toFixed(3)+'\'\''+NS;
							}catch(e){}
							
							parent.document.getElementById('markerLat').value = event.latLng.lat();
							parent.document.getElementById('markerLng').value = event.latLng.lng();
					});
				<?php } ?>

			} else {
				// En caso de no haber resultados o que haya ocurrido un error
				// lanzamos un mensaje con el error
				alert("Ups! Lo sentimos pero no pudimos localizar la zona de la empresa requerida.");
			}
		}
		
</script>
</head>
<body>
    <div id="map_canvas" style="width:100%; height:100%;"></div>
</body>
</html>