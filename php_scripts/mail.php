<? ob_start(); ?>
<? include("funciones.php"); ?>
<? include("coneccion.php");  ?>
<? include("sesion.php");  ?>
<? 
        if(!isset($_POST["email"])&&!isset($_POST["name"])) { redireccionar_a("../"); exit; }
		if(empty($_POST["email"])||empty($_POST["name"])) { redireccionar_a("../"); exit; }
		
		header("Content-Type: text/html; charset=iso-8859-1");
		$email = specialcharsFix($_POST["email"]);
		$name = specialcharsFix($_POST["name"]);
		
		$sql = "SELECT * FROM usr WHERE email = '".$email."' ";
		$consulta = @mysql_query($sql);
		$rep = @mysql_num_rows($consulta);
		if($rep==0)
		{
			date_default_timezone_set("America/La_Paz");
		    $fecha = date("Y-m-d H:i:s");
			$pass = substr(sha1(($fecha.$email.$name)),0,5);
			$sql = "INSERT INTO usr(name, pass, date, email) VALUES (\"".$name."\", \"".$pass."\", \"".$fecha."\", \"".$email."\" )";
			$consulta = @mysql_query($sql);
			validar_consulta($consulta);
									
		    if($consulta)
			{
				$subject = 'World Wild Way';
				$message = '<html>
							<head>
								<title>World Wild Way</title>
							</head>
							<body>
								<img src="http://www.worldwildway.com/beta/images/etiq_logo.png"></img>
								<h3>'.$name.', bienvenido a www.worldwildway.com </h3>
								<b> Usuario: '.$email.'</b><br />
								<b> Contrase&ntilde;a: '.$pass.'</b><br />
								<br />
								<b> Confirmar: http://www.worldwildway.com/beta/activate.php?src='.sha1($email.$name.$pass).'</b>
							</body>
							</html>';
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				$headers .= 'To: '.$name.' <'.$email.'>'."\r\n";
				$headers .= 'From: World Wild Way <admin@worldwildway.com>'."\r\n";
				$headers .= 'Cc: admin@worldwildway.com'."\r\n";
				$headers .= 'Bcc: admin@worldwildway.com'."\r\n";
				
				if (mail($email, $subject, $message, $headers)) 
				{
					//echo "Mail enviado!! <br />"; echo $email."<br />"; echo $name."<br />";
					$url = "../?registered";
					redireccionar_a($url);
				}
			}
			else "<h1>Error</h1>";
			
		}
		else{ $url = "../?e=2"; redireccionar_a($url); }
?>
<? ob_end_flush(); ?>