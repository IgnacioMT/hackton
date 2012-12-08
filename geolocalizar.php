<!DOCTYPE html>
<html>
  <head>
    <title>Geolocalizar</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <script type="text/javascript" src="js/funciones.js"></script>
    
    <meta charset="utf-8">
    <link href="https://google-developers.appspot.com/maps/documentation/javascript/examples/default.css" rel="stylesheet">
    <style>
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
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>

    <script>
      var map;
	  var infowindow = new google.maps.InfoWindow({});
	  var imgMarcador = new google.maps.MarkerImage('http://blackoutdal.net23.net/images/map/marcador.png', 
	  				    new google.maps.Size(28, 40), new google.maps.Point(0,0), new google.maps.Point(14, 40));
	  var imgSombra   = new google.maps.MarkerImage('http://blackoutdal.net23.net/images/map/sombra.png', 
				        new google.maps.Size(106, 83), new google.maps.Point(0,0), new google.maps.Point(36, 51));
	  

      function initialize() 
	  {
          var mapOptions = { zoom: 16, mapTypeId: google.maps.MapTypeId.ROADMAP };
          map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
          if(navigator.geolocation){ navigator.geolocation.getCurrentPosition(function(position)
		  {	  
              var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
              infowindow = new google.maps.InfoWindow({
                map: map,
                position: pos,
				scrollwheel: false,
                content: '<div class="marker"><span class="rojo">Usted se encuentra aqui!</span> <span class="verdana12 plomo">Esta ubicación se utilizará en la etapa de análisis.</span></div>'
              });

			  var marker = new google.maps.Marker({
				 position: pos,
				 map: map,
				 icon: imgMarcador, 
				 shadow: imgSombra,
				 draggable: true,
				 title: 'Su ubicacion'
			  });
			  
			  try{
				  parent.document.getElementById('markerLat').value = pos.lat();
				  parent.document.getElementById('markerLng').value = pos.lng();
				  parent.document.getElementById('geoPos').innerHTML = convertir_coordenadas(pos.lat(),pos.lng());
			  }catch(e){}
			  
			  google.maps.event.addListener(marker, 'dragend', function(event)
			  {				
				  try{
				  	setInfoWindow('Usted se encuentra aqui!','Esta ubicación se utilizará en la etapa de análisis.',event);							
				  
				  	parent.document.getElementById('markerLat').value = event.latLng.lat();
                  	parent.document.getElementById('markerLng').value = event.latLng.lng();
				  	parent.document.getElementById('geoPos').innerHTML = convertir_coordenadas(event.latLng.lat(),event.latLng.lng());			
				  }catch(e){};
			  });			
              map.setCenter(pos);
		}, function(){ handleNoGeolocation(true); });
        } else { /*Browser doesn't support Geolocation*/ handleNoGeolocation(false); }
		
      }
	  
	  function setInfoWindow(titulo, texto, event)
	  {
		  var pos;
		  
		  infowindow.setMap(null);
		  if(event==null) pos = new google.maps.LatLng(-16.505545540736644, -68.12635694973756); //coordenadas por defecto  
		  else pos = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
		  
		  infowindow = new google.maps.InfoWindow({
			  map: map,
			  position: pos,
			  content: '<div class="marker"><span class="rojo">'+titulo+'</span> <span class="verdana12 plomo">'+texto+'</span></div>'
		  });
	  }
	  
	  function handleNoGeolocation(errorFlag) {
        if (errorFlag) {
		  	  window.setTimeout(function() {
				  
				  setInfoWindow('Ups! no logramos geolocalizarlo!','<br />Arrastre el marcador hasta la ubicación de su preferencia.',null);
				  
				  pos = new google.maps.LatLng(-16.505545540736644, -68.12635694973756); //coordenadas por defecto  
				  var marker = new google.maps.Marker({
						position: pos,
						map: map,
						icon: imgMarcador, 
						shadow: imgSombra,
						draggable: true,
						title: 'Su ubicacion'
				  });
				  marker.setMap(map);
					
				  google.maps.event.addListener(marker, 'dragend', function(event)
				  {
					  try{
						  parent.document.getElementById('markerLat').value = event.latLng.lat();
						  parent.document.getElementById('markerLng').value = event.latLng.lng();
						  parent.document.getElementById('geoPos').innerHTML = convertir_coordenadas(event.latLng.lat(),event.latLng.lng());
						  
						  setInfoWindow('Usted se encuentra aqui!','Esta ubicación se utilizará en la etapa de análisis.',event);
					  }catch(e){}
				  });
					  
				  map.setCenter(pos);
				  map.setZoom(16);
				  
			  }, 2000);
		  
        } else {
          var content = 'Error: Su navegador no soporta esta tecnología.';
        }

        var options = {
            map: map,
            position: new google.maps.LatLng(60, 105),
            content: content
        };
        var infowindow = new google.maps.InfoWindow(options);
        map.setCenter(options.position);
		
      }

      google.maps.event.addDomListener(window, 'load', initialize);
	  
  </script>
  </head>
  <body>
    <div id="coord"></div> 
    <div id="map_canvas"></div>
  </body>
</html>