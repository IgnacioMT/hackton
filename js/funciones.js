
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