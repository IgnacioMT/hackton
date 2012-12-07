
function pixelesDisponiblesY() {
	var myHeight = 0;
	if( typeof( window.innerWidth ) == 'number' ) {
		myHeight = window.innerHeight;
	} else if( document.documentElement && document.documentElement.clientHeight ) {
		myHeight = document.documentElement.clientHeight;
	} else if( document.body && document.body.clientHeight ) {
		myHeight = document.body.clientHeight;
	}
	return myHeight;
}

function pixelesDisponiblesX() {
	var myWidth = 0;
	if( typeof( window.innerWidth ) == 'number' ) {
		myWidth = window.innerWidth;
	} else if( document.documentElement && document.documentElement.clientWidth ) {
		myWidth = document.documentElement.clientWidth;
	} else if( document.body && document.body.clientWidth ) {
		myWidth = document.body.clientWidth;
	}
	return myWidth;
}

function truncate(n) { return n|0; }
function convertir_coordenadas(LAT, LNG)
{
	var nLat = '', nLng = '';
	var lat, lng;
	try{
		lat = Math.abs(LAT);
		lng = Math.abs(LNG);
	}catch(e){}
	try{
		g = truncate(lat); 
		m = Math.abs(truncate((lat-g)*60));
		s = (Math.abs(lat-g)*60-m)*60;
		NS = (LAT<0)? ' S' : ' N';
		nLat = g+String.fromCharCode(176)+' '+m+'\' '+s.toFixed(3)+'\'\''+NS;
	}catch(e){}
	try{
		g = truncate(lng); 
		m = Math.abs(truncate((lng-g)*60));
		s = (Math.abs(lng-g)*60-m)*60;
		NS = (LNG<0)? ' O' : ' E';
		nLng = g+String.fromCharCode(176)+' '+m+'\' '+s.toFixed(3)+'\'\''+NS;
	}catch(e){}
	
	return nLat + "   " + nLng;
}