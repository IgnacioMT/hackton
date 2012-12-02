<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps JavaScript API v3 Example: Map Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
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

      function initialize() {
        var mapOptions = {
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas'),
            mapOptions);

        // Try HTML5 geolocation
        if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = new google.maps.LatLng(position.coords.latitude,
                                             position.coords.longitude);

            var infowindow = new google.maps.InfoWindow({
              map: map,
              position: pos,
              content: '<div class="marker"><span class="rojo">Usted se encuentra aqui!</span> <span class="verdana12 plomo">Esta ubicación se utilizará para el análisis de oportunidades.</span></div>'
            });

			var marker = new google.maps.Marker({
				position: pos,
				map: map,
				draggable: true,
				title: 'Su ubicacion'
			});
			
			function truncate(n) { return n|0; }
			google.maps.event.addListener(marker, 'dragend', function(event) {
				
			  infowindow.setMap(null);
			  var pos = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
			  infowindow = new google.maps.InfoWindow({
              map: map,
              position: pos,
              content: '<div class="marker"><span class="rojo">Usted se encuentra aqui!</span> <span class="verdana12 plomo">Esta ubicación se utilizará para el análisis de oportunidades.</span></div>'
            });
			
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
				parent.document.getElementById('geoPos').innerHTML = nLat+"     "+nLng;
				
				var p = trunc(event.latLng.lat()*1000)/1000;
				p += "  ";
				p += (trunc(event.latLng.lng()*1000)/1000);
				parent.document.getElementById('geoPos2').innerHTML = p;
				
			});
			
            map.setCenter(pos);
          }, function() {
            handleNoGeolocation(true);
          });
        } else {
          // Browser doesn't support Geolocation
          handleNoGeolocation(false);
        }
      }

      function handleNoGeolocation(errorFlag) {
        if (errorFlag) {
          var content = 'Error: El servicio de geolocalización falló.';
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
    <div id="map_canvas"></div>
  </body>
</html>