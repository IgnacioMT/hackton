<?php
  //header("Content-Type:text/html; charset=utf-8");
  //header("Content-Type: text/html; charset=iso-8859-1");
  function get_url()
  {
	 $pageURL = 'http';
	 //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
  }
  
  function validar_consulta($resultado)
  {
	if(!$resultado) 
	{ 
	  die("Error al procesar su solicitud.<br />".mysql_error());
	}
  }
   
  function specialcharsFix( $value )
  {
	  $res = str_ireplace ("’","&rsquo;",$value);
	  $res = str_ireplace ("\"","&quot;",$res);
	  
	  return $res;
  }
  
  function arreglarQuery($query) {
    $argument = 0;
    
    for ($i = strpos($query, '%'); $i !== false; $i = strpos($query, '%', $i + strlen($replace))) {
      $value = func_get_arg(++$argument);
      
      switch (substr($query, $i + 1, 1)) {
        case '%': $replace = '%'; --$argument; break;
        case 's': $replace = mysql_real_escape_string($value); break;
        
        case 'S': $replace = mysql_real_escape_string($value); break;
        case 'q': $replace = format('"%S"', $value); break;
        case 'l': $replace = preg_replace('/([%_\\\'"])/', '\\\\1', $value); break;
        case 'd': $replace = mysql_real_escape_string($value); break;
        case 'n': $replace = (strlen($value) == 0 ? 'NULL' : format('%q', $value)); break;
        case 't': $replace = format('FROM_UNIXTIME(%n)', $value); break;
        
        default: $replace = '';
      }
      
      $query = substr_replace($query, $replace, $i, 2);
    }
    
    $result = mysql_query($query);
    
    $mysql_error_num = mysql_errno(self::$conn);
    $mysql_error = mysql_error(self::$conn);
    
    if ($result != 'true') {
      error_log('MYSQL QUERY: ' . var_export($query,1));
    }
	
    return $result;
  }
  
  function redireccionar_a( $pagina = NULL ) {
	if ($pagina != NULL) {
		header("Location: {$pagina}");
		exit;
	}
  }
  
  function arreglarDireccion($buscar)
  {
	  $aux = explode(" ", $buscar);
					
	  $dir = "";
	  $band = 0;
	  foreach( $aux as $val )
	  {
		if($band == 1) { $band = 0; continue; }
		if( strtolower($val) == "zona" || strtolower($val) == "z." ){ $band = 1; continue; }
		if( strtolower($val) == "v." ){ $band = 1; continue; }
		
		if( substr($val,-1) == "." && strtolower($val)!="av." ) continue;
		if( strrchr($val, '#') ) continue;
		if( strrchr($val, ',') ) continue;
		if( strrchr($val, '\'') ) continue;
		if( strrchr($val, '\"') ) continue;
		if( strrchr($val, ')') ) continue;
		if( strrchr($val, '(') ) continue;
		if( strtolower($val) == "esq.") break;
		if( strtolower($val) == "calle") continue;
		if( strtolower($val) == "torre") break;
		if( strtolower($val) == "torres") break;
		if( strtolower($val) == "mezanine") continue;
		if( strtolower($val) == "n") continue;
		if( strtolower($val[0]) == 'n' && strlen($val)<=3 ) continue;
		if( strtolower($val[0]) == 'n' && strtolower($val[2]) == '.' ) continue;
		
		$dir .= $val." ";
	  }
	  
	  return $dir;
  }
  
  function MiFecha($fecha)
  {
	$HORA = substr(substr($fecha,-8),0,5);
	$ANIO = substr($fecha,0,4);
	$DIAyMES = ltrim($fecha,$HORA);
	$DIAyMES = substr(ltrim($DIAyMES,$ANIO),1,5);
	$MES = substr($DIAyMES,0,2);
	$DIA = substr($DIAyMES,3);
	$SEGUNDOS = substr($fecha,-2);
	
	/*switch($MES)
	{
		case 01: case 1: $MES = "Enero"; break;
		case 02: case 2: $MES = "Febrero"; break;
		case 03: case 3: $MES = "Marzo"; break;
		case 04: case 4: $MES = "Abril"; break;
		case 05: case 5: $MES = "Mayo"; break;
		case 06: case 6: $MES = "Junio"; break;
		case 07: case 7: $MES = "Julio"; break;
		case 08: case 8: $MES = "Agosto"; break;
		case 09: case 9: $MES = "Septiembre"; break;
		case 10: $MES = "Octubre"; break;
		case 11: $MES = "Noviembre"; break;
		case 12: $MES = "Diciembre"; break;
	}
	switch($DIA)
	{
		case 01: $DIA = "1"; break;
		case 02: $DIA = "2"; break;
		case 03: $DIA = "3"; break;
		case 04: $DIA = "4"; break;
		case 05: $DIA = "5"; break;
		case 06: $DIA = "6"; break;
		case 07: $DIA = "7"; break;
		case 08: $DIA = "8"; break;
		case 09: $DIA = "9"; break;
	}*/
	
	//$Respuesta = $DIA." de ".$MES." de ".$ANIO." a las ".$HORA;
	
	$Respuesta = $DIA."/".$MES."/".$ANIO;
	return $Respuesta;
  }
  
  function timestamp($fecha)
  {
    
	list($date, $time) = explode(' ', $str);
    list($year, $month, $day) = explode('-', $date);
    list($hour, $minute, $second) = explode(':', $time);
    $timestamp = mktime ( (int)$hour, (int)$minute, (int)$second, (int)$month, (int)$day, (int)$year );
	
    return $timestamp;
  }
  
  function CuantoTiempoDesde($original) 
  {
	date_default_timezone_set("America/La_Paz");
	$fecha = strtotime($original);
	$ta = array(
	array(31536000, "Year", "Years"),
	array(2592000, "Month", "Months"),
	array(604800, "Week", "Weeks"),
	array(86400, "Day", "Days"),
	array(3600, "Hour", "Hours"),
	array(60, "Minute", "Minutes"),
	array(1, "Second", "Seconds")
	);
	$since = time() - $fecha ;
	$res = "";
	$lastkey = 0;
	for( $i=0; $i<count($ta); $i++ ){
	    $cnt = floor($since / $ta[$i][0]);
		if ($cnt != 0) {
		$since = $since - ($ta[$i][0] * $cnt);
		
		if($res == ""){
			$res .= ($cnt == 1) ? "1 {$ta[$i][1]}" : "{$cnt} {$ta[$i][2]}";
			$lastkey = $i;
		}
		else if ($ta[0] >= 60 && ($i - $lastkey) == 1 )
		{
			$res .= ($cnt == 1) ? " and 1 {$ta[$i][1]}" : " and {$cnt} {$ta[$i][2]}";
			break;
		} else { break; }
		}
    }
	if (trim($res) == "") $res = "one second ago.";
    return $res;
  }  
  
  function CuantoTiempoHasta($original) 
  {
	date_default_timezone_set("America/La_Paz");
	$fecha = strtotime($original);
	$ta = array(
	array(31536000, "A&ntilde;o", "A&ntilde;os"),
	array(2592000, "Mes", "Meses"),
	array(604800, "Semana", "Semanas"),
	array(86400, "D&iacute;a", "D&iacute;as"),
	array(3600, "Hora", "Horas"),
	array(60, "Minuto", "Minutos"),
	array(1, "Segundo", "Segundos")
	);
	$since = $fecha - time();
	$res = "";
	$lastkey = 0;
	for( $i=0; $i<count($ta); $i++ ){
	    $cnt = floor($since / $ta[$i][0]);
		if ($cnt != 0) {
		$since = $since - ($ta[$i][0] * $cnt);
		
		if($res == ""){
			$res .= ($cnt == 1) ? "1 {$ta[$i][1]}" : "{$cnt} {$ta[$i][2]}";
			$lastkey = $i;
		}
		else if ($ta[0] >= 60 && ($i - $lastkey) == 1 )
		{
			$res .= ($cnt == 1) ? " y 1 {$ta[$i][1]}" : " y {$cnt} {$ta[$i][2]}";
			break;
		} else { break; }
		}
    }
	if (substr($res,0,1) == "-") $res = "En este momento";
    return $res;
  }
  
  function Resaltar($Resaltar, $TextoCompleto)
   {
	  $tam = strlen($TextoCompleto);
	  
	  if($tam>40) substr($TextoCompleto,0,40);
	  if(strlen($Resaltar)>1)
	  {
		  $TextoCompleto = str_ireplace($Resaltar,"<span style=\"background-color:#ffa; color:#933;\">".$Resaltar."</span>",$TextoCompleto);
		  $PalabrasSeparadas = explode(' ', $Resaltar);
		  foreach ($PalabrasSeparadas as $v) { 
			 $TextoCompleto = str_ireplace($v,"<span style=\"background-color:#ffa; color:#933;\">".$v."</span>",$TextoCompleto);
		  }
	  }
	  return $TextoCompleto;
   }
  
?>
   
